<?php
/**
 * File: Timer.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Model;

use MSlwk\ReactPhpPlayground\Api\TimerInterface;
use MSlwk\ReactPhpPlayground\Exception\TimerException;

/**
 * Class Timer
 * @package MSlwk\ReactPhpPlayground\Model
 */
class Timer implements TimerInterface
{
    /**
     * @var float
     */
    private $timeStart = 0.0;

    /**
     * @var float
     */
    private $timeStop = 0.0;

    /**
     * @return void
     */
    public function startTimer(): void
    {
        $this->timeStart = microtime(true);
    }

    /**
     * @return void
     * @throws TimerException
     */
    public function stopTimer(): void
    {
        if (!$this->timeStart) {
            throw new TimerException('Timer not started');
        }
        $this->timeStop = microtime(true);
    }

    /**
     * @return float
     * @throws TimerException
     */
    public function getExecutionTimeInSeconds(): float
    {
        if (!$this->timeStart || !$this->timeStop) {
            throw new TimerException('Execution time cannot be calculated');
        }
        $executionTime = $this->timeStop - $this->timeStart;
        $this->timeStart = 0.0;
        $this->timeStop = 0.0;
        return $executionTime;
    }
}
