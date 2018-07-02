<?php
/**
 * File: ReportGeneratorInterface.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Api\Report;

/**
 * Interface ReportGeneratorInterface
 * @package MSlwk\ReactPhpPlayground\Api\Report
 */
interface ReportGeneratorInterface
{
    /**
     * @param int $customerId
     * @return string
     */
    public function generateReport(int $customerId): string;
}
