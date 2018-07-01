<?php
declare(strict_types=1);

/**
 * File:HalfAsynchronousProcessRunnerTest.php
 *
 * @author Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * @copyright Copyright (C) 2018 Lizard Media (http://lizardmedia.pl)
 */

namespace MSlwk\ReactPhpPlayground\Test\Unit\Standalone\ChildProcess;

use MSlwk\ReactPhpPlayground\Api\Data\ProcessInterface;
use MSlwk\ReactPhpPlayground\Model\Adapter\ReactPHP\ProcessFactory;
use MSlwk\ReactPhpPlayground\Model\Data\Process;
use MSlwk\ReactPhpPlayground\Standalone\ChildProcess\HalfAsynchronousProcessRunner;
use MSlwk\TypeSafeArray\ObjectArray;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;
use React\EventLoop\LoopInterface;

/**
 * Class HalfAsynchronousProcessRunnerTest
 * @package MSlwk\ReactPhpPlayground\Test\Unit\Standalone\ChildProcess
 */
class HalfAsynchronousProcessRunnerTest extends TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject|LoopInterface
     */
    private $loop;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject|ProcessFactory
     */
    private $processFactory;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject|HalfAsynchronousProcessRunner
     */
    private $halfAsynchronousRunner;

    /**
     * @return void
     */
    protected function setUp()
    {
        $this->loop = $this->getMockBuilder(LoopInterface::class)
            ->getMock();
        $this->processFactory = $this->getMockBuilder(ProcessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->halfAsynchronousRunner = $this->getMockBuilder(HalfAsynchronousProcessRunner::class)
            ->setConstructorArgs(
                [
                    'loop' => $this->loop,
                    'processFactory' => $this->processFactory
                ]
            )
            ->setMethods(['createProcessDefinition'])
            ->getMock();
    }

    /**
     * @test
     */
    public function testRunProcesses()
    {
        /** @var PHPUnit_Framework_MockObject_MockObject|ObjectArray $processArray */
        $processArray = $this->getMockBuilder(ObjectArray::class)
            ->setConstructorArgs(
                [
                    'type' => ProcessInterface::class,
                    'objects' => [new Process('process'), new Process('process')]
                ]
            )
            ->setMethods(null)
            ->getMock();

        $this->halfAsynchronousRunner->expects($this->exactly(2))
            ->method('createProcessDefinition');
        $this->loop->expects($this->exactly(2))
            ->method('run');

        $this->halfAsynchronousRunner->runProcesses($processArray);
    }
}
