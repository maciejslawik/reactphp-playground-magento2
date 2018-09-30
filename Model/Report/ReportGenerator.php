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
     * @codeCoverageIgnore
     */
    public function generateReport(int $customerId): string
    {
        /**
         * Report is being generated
         */
        $loopSize = 31500;

        $primes = [];

        for ($i = 2; $i < $loopSize; $i++) {
            for ($j = 2; $j < $i; $j++) {
                if ($i % $j == 0) {
                    break;
                }
            }
            if ($i === $j) {
                $primes[] = $i;
            }
        }

        return '';
    }
}
