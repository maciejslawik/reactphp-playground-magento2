<?php
/**
 * File: ReportSenderInterface.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Api\Report;

/**
 * Interface ReportSenderInterface
 * @package MSlwk\ReactPhpPlayground\Api\Report
 */
interface ReportSenderInterface
{
    /**
     * @param string $report
     * @return void
     */
    public function sendReport(string $report): void;
}
