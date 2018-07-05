<?php
declare(strict_types=1);

/**
 * File: CliReportManagerInterface.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Api\Report;

/**
 * Interface CliReportManagerInterface
 * @package MSlwk\ReactPhpPlayground\Api\Report
 */
interface CliReportManagerInterface
{
    /**
     * @param int[] $customerIds
     * @return void
     */
    public function generateAndSendReportForCustomers(array $customerIds): void;
}
