<?php
declare(strict_types=1);

/**
 * File: TimerInterface.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Api;

use MSlwk\ReactPhpPlayground\Exception\TimerException;

/**
 * Interface TimerInterface
 * @package MSlwk\ReactPhpPlayground\Api
 */
interface TimerInterface
{
    /**
     * @return void
     */
    public function startTimer(): void;

    /**
     * @return void
     * @throws TimerException
     */
    public function stopTimer(): void;

    /**
     * @return float
     * @throws TimerException
     */
    public function getExecutionTimeInSeconds(): float;
}
