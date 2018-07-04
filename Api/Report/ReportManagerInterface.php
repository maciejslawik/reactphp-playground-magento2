<?php
declare(strict_types=1);

/**
 * File: ReportManagerInterface.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Api\Report;

/**
 * Interface ReportManagerInterface
 * @package MSlwk\ReactPhpPlayground\Api\Report
 */
interface ReportManagerInterface
{
    /**
     * @param int[] $customerIds
     * @return void
     */
    public function generateAndSendReportForCustomers(array $customerIds): void;
}
