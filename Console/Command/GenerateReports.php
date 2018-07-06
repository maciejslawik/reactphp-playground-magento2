<?php
declare(strict_types=1);

/**
 * File: GenerateReports.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Console\Command;

use Magento\Framework\Serialize\Serializer\Json;
use MSlwk\ReactPhpPlayground\Api\Report\CliReportManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GenerateReports
 * @package MSlwk\ReactPhpPlayground\Console\Command
 */
class GenerateReports extends Command
{
    const COMMAND_NAME = 'mslwk:generate-reports';
    const COMMAND_DESCRIPTION = 'Generate reports for customers with IDs supplied';
    const ARGUMENT_CUSTOMER_IDS = 'customer-ids';

    /**
     * @var Json
     */
    private $jsonHandler;

    /**
     * @var CliReportManagerInterface
     */
    private $reportManager;

    /**
     * GenerateReports constructor.
     * @param Json $jsonHandler
     * @param CliReportManagerInterface $reportManager
     * @param null $name
     */
    public function __construct(
        Json $jsonHandler,
        CliReportManagerInterface $reportManager,
        $name = null
    ) {
        parent::__construct($name);
        $this->jsonHandler = $jsonHandler;
        $this->reportManager = $reportManager;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName(self::COMMAND_NAME)
            ->setDescription(self::COMMAND_DESCRIPTION)
            ->addArgument(
                self::ARGUMENT_CUSTOMER_IDS,
                InputArgument::REQUIRED
            );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $customerIds = $this->jsonHandler->unserialize($input->getArgument(self::ARGUMENT_CUSTOMER_IDS));
        $this->reportManager->generateAndSendReportForCustomers($customerIds);
    }
}
