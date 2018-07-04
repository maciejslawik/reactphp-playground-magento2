<?php
declare(strict_types=1);

/**
 * File: StartWebapiReportingService.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Console\Command;

use MSlwk\ReactPhpPlayground\Api\CustomerIdsProviderInterface;
use MSlwk\ReactPhpPlayground\Api\TimerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class StartWebapiReportingService
 * @package MSlwk\ReactPhpPlayground\Console\Command
 */
class StartWebapiReportingService extends Command
{
    const COMMAND_NAME = 'mslwk:webapi-reporting-start';
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
     * StartWebapiReportingService constructor.
     * @param TimerInterface $timer
     * @param CustomerIdsProviderInterface $customerIdsProvider
     * @param null $name
     */
    public function __construct(
        TimerInterface $timer,
        CustomerIdsProviderInterface $customerIdsProvider,
        $name = null
    ) {
        parent::__construct($name);
        $this->timer = $timer;
        $this->customerIdsProvider = $customerIdsProvider;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName(self::COMMAND_NAME)
            ->setDescription('Start asynchronous WebAPI reporting service')
            ->addArgument(
                self::ARGUMENT_NUMBER_OF_THREADS,
                InputArgument::REQUIRED,
                'Number of threads for running the export process'
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $numberOfThreads = (int)$input->getArgument(self::ARGUMENT_NUMBER_OF_THREADS);
        $this->timer->startTimer();
        $customerIds = $this->customerIdsProvider->getCustomerIds();

        $this->timer->stopTimer();

        $output->writeln("Process finished after {$this->timer->getExecutionTimeInSeconds()} seconds");
    }
}
