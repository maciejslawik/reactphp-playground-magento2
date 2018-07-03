<?php
declare(strict_types=1);

/**
 * File: ReportGenerator.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Model\Report;

use MSlwk\ReactPhpPlayground\Api\Report\ReportGeneratorInterface;

/**
 * Class ReportGenerator
 * @package MSlwk\ReactPhpPlayground\Model\Report
 */
class ReportGenerator implements ReportGeneratorInterface
{
    /**
     * @param int $customerId
     * @return string
     */
    public function generateReport(int $customerId): string
    {
        /**
         * Report is being generated
         */
        sleep(1);
        return '';
    }
}
