<?php
declare(strict_types=1);

/**
 * File:SynchronousProcessRunnerTest.php
 *
 * @author Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * @copyright Copyright (C) 2018 Lizard Media (http://lizardmedia.pl)
 */

namespace MSlwk\ReactPhpPlayground\Test\Unit\Standalone\ChildProcess;

use MSlwk\ReactPhpPlayground\Api\Data\ProcessInterface;
use MSlwk\ReactPhpPlayground\Model\Data\Process;
use MSlwk\ReactPhpPlayground\Standalone\ChildProcess\SynchronousProcessRunner;
use MSlwk\TypeSafeArray\ObjectArray;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * Class SynchronousProcessRunnerTest
 * @package MSlwk\ReactPhpPlayground\Test\Unit\Standalone\ChildProcess
 */
class SynchronousProcessRunnerTest extends TestCase
{
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
                    'objects' => [new Process('process')]
                ]
            )
            ->setMethods(null)
            ->getMock();
        /** @var PHPUnit_Framework_MockObject_MockObject|SynchronousProcessRunner $synchronousRunner */
        $synchronousRunner = $this->getMockBuilder(SynchronousProcessRunner::class)
            ->disableOriginalConstructor()
            ->setMethods(['execWrapper'])
            ->getMock();
        $synchronousRunner->expects($this->once())
            ->method('execWrapper')
            ->with('process')
            ->willReturn('');

        $synchronousRunner->runProcesses($processArray);
    }
}
