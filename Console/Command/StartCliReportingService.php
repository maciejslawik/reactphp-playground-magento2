<?php
declare(strict_types=1);

/**
 * File: StartCliReportingService.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Console\Command;

use MSlwk\ReactPhpPlayground\Api\CustomerIdsProviderInterface;
use MSlwk\ReactPhpPlayground\Api\TimerInterface;
use MSlwk\ReactPhpPlayground\Model\Adapter\ReactPHP\ProcessFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\Serialize\Serializer\Json;
use React\EventLoop\Factory;

/**
 * Class StartCliReportingService
 * @package MSlwk\ReactPhpPlayground\Console\Command
 */
class StartCliReportingService extends Command
{
    const COMMAND_NAME = 'mslwk:cli-reporting-start';
    const COMMAND_DESCRIPTION = 'Start asynchronous CLI reporting service';
    const ARGUMENT_NUMBER_OF_THREADS = 'threads';

    /**
     * @var TimerInterface
     */
    private $timer;

    /**
     * @var CustomerIdsProviderInterface
     */
    private $customerIdsProvider;

    /**
     * @var LoopInterface
     */
    private $loop;

    /**
     * @var ProcessFactory
     */
    private $processFactory;

    /**
     * @var Json
     */
    private $jsonHandler;

    /**
     * StartCliReportingService constructor.
     * @param TimerInterface $timer
     * @param CustomerIdsProviderInterface $customerIdsProvider
     * @param Factory $loopFactory
     * @param ProcessFactory $processFactory
     * @param Json $jsonHandler
     * @param null $name
     */
    public function __construct(
        TimerInterface $timer,
        CustomerIdsProviderInterface $customerIdsProvider,
        Factory $loopFactory,
        ProcessFactory $processFactory,
        Json $jsonHandler,
        $name = null
    ) {
        parent::__construct($name);
        $this->timer = $timer;
        $this->customerIdsProvider = $customerIdsProvider;
        $this->loop = $loopFactory::create();
        $this->processFactory = $processFactory;
        $this->jsonHandler = $jsonHandler;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName(self::COMMAND_NAME)
            ->setDescription(self::COMMAND_DESCRIPTION)
            ->addArgument(
                self::ARGUMENT_NUMBER_OF_THREADS,
                InputArgument::REQUIRED,
                'Number of threads for running the export process'
            );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $numberOfThreads = (int)$input->getArgument(self::ARGUMENT_NUMBER_OF_THREADS);
        $customerIds = $this->customerIdsProvider->getCustomerIds();

        $this->timer->startTimer();

        $this->startProcesses($customerIds, $numberOfThreads);

        $this->timer->stopTimer();

        $output->writeln("<info>Process finished after {$this->timer->getExecutionTimeInSeconds()} seconds</info>");
    }

    /**
     * @param int[] $customerIds
     * @param int $numberOfThreads
     */
    protected function startProcesses(array $customerIds, int $numberOfThreads): void
    {
        $numberOfChunks = $this->calculateNumberOfChunksForThreads($customerIds, $numberOfThreads);
        $threadedCustomerIds = array_chunk($customerIds, $numberOfChunks);
        foreach ($threadedCustomerIds as $customerIdsForSingleThread) {
            $this->createProcessDefinition($this->getFullCommand($customerIdsForSingleThread));
        }
        $this->loop->run();
    }

    /**
     * @param string $command
     */
    protected function createProcessDefinition(string $command): void
    {
        $reactProcess = $this->processFactory->create($command);
        $reactProcess->start($this->loop);

        $reactProcess->stdout->on('data', function ($chunk) {
            echo $chunk;
        });
    }

    /**
     * @param int[] $customerIds
     * @return string
     */
    protected function getFullCommand(array $customerIds): string
    {
        return PHP_BINARY
            . sprintf(
                ' %s/bin/magento %s %s',
                BP,
                GenerateReports::COMMAND_NAME,
                $this->jsonHandler->serialize($customerIds)
            );
    }

    /**
     * @param int[] $customerIds
     * @param int $numberOfThreads
     * @return int
     */
    protected function calculateNumberOfChunksForThreads(array $customerIds, int $numberOfThreads): int
    {
        $numberOfChunks = (int)(count($customerIds) / $numberOfThreads);
        return $numberOfChunks > 0 ? $numberOfChunks : 1;
    }
}
