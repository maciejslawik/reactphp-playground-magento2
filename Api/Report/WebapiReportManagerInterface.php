<?php
declare(strict_types=1);

/**
 * File: WebapiReportManagerInterface.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Api\Report;

/**
 * Interface WebapiReportManagerInterface
 * @package MSlwk\ReactPhpPlayground\Api\Report
 */
interface WebapiReportManagerInterface
{
    /**
     * @param int[] $customerIds
     * @return string[]
     */
    public function generateAndSendReportForCustomers(array $customerIds): array;
}
