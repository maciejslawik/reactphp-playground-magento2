<?php
declare(strict_types=1);

/**
 * File: WebapiReportManager.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Model\Report;

use MSlwk\ReactPhpPlayground\Api\Report\ReportGeneratorInterface;
use MSlwk\ReactPhpPlayground\Api\Report\WebapiReportManagerInterface;
use MSlwk\ReactPhpPlayground\Api\Report\ReportSenderInterface;

/**
 * Class WebapiReportManager
 * @package MSlwk\ReactPhpPlayground\Model\Report
 */
class WebapiReportManager implements WebapiReportManagerInterface
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
     * WebapiReportManager constructor.
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
     * @return string[]
     */
    public function generateAndSendReportForCustomers(array $customerIds): array
    {
        $messages = [];
        foreach ($customerIds as $customerId) {
            $report = $this->reportGenerator->generateReport($customerId);
            $this->reportSender->sendReport($report);
            $messages[] = "Reporting process finished for customer: {$customerId}\n";
        }
        return $messages;
    }
}
