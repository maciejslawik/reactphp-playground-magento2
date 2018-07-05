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
use MSlwk\ReactPhpPlayground\Api\Report\ReportManagerInterface;
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
    const ARGUMENT_CUSTOMER_IDS = 'customer-ids';

    /**
     * @var Json
     */
    private $jsonHandler;

    /**
     * @var ReportManagerInterface
     */
    private $reportManager;

    /**
     * GenerateReports constructor.
     * @param Json $jsonHandler
     * @param ReportManagerInterface $reportManager
     * @param null $name
     */
    public function __construct(
        Json $jsonHandler,
        ReportManagerInterface $reportManager,
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
            ->setDescription('Generate reports for customers with IDs supplied')
            ->addArgument(
                self::ARGUMENT_CUSTOMER_IDS,
                InputArgument::REQUIRED
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $customerIds = $this->jsonHandler->unserialize($input->getArgument(self::ARGUMENT_CUSTOMER_IDS));
        $this->reportManager->generateAndSendReportForCustomers($customerIds);
    }
}
