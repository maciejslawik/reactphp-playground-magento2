<?php
declare(strict_types=1);

/**
 * File: ReportManager.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Model\Report;

use MSlwk\ReactPhpPlayground\Api\Report\ReportGeneratorInterface;
use MSlwk\ReactPhpPlayground\Api\Report\ReportManagerInterface;
use MSlwk\ReactPhpPlayground\Api\Report\ReportSenderInterface;

/**
 * Class ReportManager
 * @package MSlwk\ReactPhpPlayground\Model\Report
 */
class ReportManager implements ReportManagerInterface
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
     * ReportManager constructor.
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
        }
    }
}
