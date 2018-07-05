<?php
declare(strict_types=1);

/**
 * File: CliReportManager.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Model\Report;

use MSlwk\ReactPhpPlayground\Api\Report\ReportGeneratorInterface;
use MSlwk\ReactPhpPlayground\Api\Report\CliReportManagerInterface;
use MSlwk\ReactPhpPlayground\Api\Report\ReportSenderInterface;

/**
 * Class CliReportManager
 * @package MSlwk\ReactPhpPlayground\Model\Report
 */
class CliReportManager implements CliReportManagerInterface
{
    /**
     * @var ReportGeneratorInterface
     */
    private $reportGenerator;

    /**
     * @var ReportSenderInterface
     */
    private $reportSender;

    /**
     * CliReportManager constructor.
     * @param ReportGeneratorInterface $reportGenerator
     * @param ReportSenderInterface $reportSender
     */
    public function __construct(
        ReportGeneratorInterface $reportGenerator,
        ReportSenderInterface $reportSender
    ) {
        $this->reportGenerator = $reportGenerator;
        $this->reportSender = $reportSender;
    }

    /**
     * @param int[] $customerIds
     * @return void
     */
    public function generateAndSendReportForCustomers(array $customerIds): void
    {
        foreach ($customerIds as $customerId) {
            $report = $this->reportGenerator->generateReport($customerId);
            $this->reportSender->sendReport($report);
            echo "Reporting process finished for customer: {$customerId}\n";
        }
    }
}
