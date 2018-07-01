<?php
declare(strict_types=1);

/**
 * File:TimerTest.php
 *
 * @author Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * @copyright Copyright (C) 2018 Lizard Media (http://lizardmedia.pl)
 */

namespace MSlwk\ReactPhpPlayground\Test\Unit\Model;

use MSlwk\ReactPhpPlayground\Exception\TimerException;
use MSlwk\ReactPhpPlayground\Model\Timer;
use PHPUnit\Framework\TestCase;

/**
 * Class TimerTest
 * @package MSlwk\ReactPhpPlayground\Test\Unit\Model
 */
class TimerTest extends TestCase
{
    /**
     * @var Timer
     */
    private $timer;

    /**
     * @return void
     */
    protected function setUp()
    {
        $this->timer = new Timer();
    }

    /**
     * @test
     * @throws TimerException
     */
    public function testTimerCalculatesEexecutionTime()
    {
        $this->timer->startTimer();
        $this->timer->stopTimer();

        $this->assertGreaterThan(0.0, $this->timer->getExecutionTimeInSeconds());
    }

    /**
     * @test
     * @throws TimerException
     */
    public function testCannotStopTimerWithoutStarting()
    {
        $this->expectException(TimerException::class);
        $this->timer->stopTimer();
    }

    /**
     * @test
     * @throws TimerException
     */
    public function testCannotCalculateTimeWithoutStartingTimer()
    {
        $this->expectException(TimerException::class);
        $this->timer->getExecutionTimeInSeconds();
    }

    /**
     * @test
     * @throws TimerException
     */
    public function testCannotCalculateTimeWithoutStoppingTimer()
    {
        $this->expectException(TimerException::class);
        $this->timer->startTimer();
        $this->timer->getExecutionTimeInSeconds();
    }
}
