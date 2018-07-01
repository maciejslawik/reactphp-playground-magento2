<?php
declare(strict_types=1);

/**
 * File:SynchronousClientTest.php
 *
 * @author Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * @copyright Copyright (C) 2018 Lizard Media (http://lizardmedia.pl)
 */

namespace MSlwk\ReactPhpPlayground\Test\Unit\Standalone\Http;

use MSlwk\ReactPhpPlayground\Api\Data\HtmlInterface;
use MSlwk\ReactPhpPlayground\Api\Data\UrlInterface;
use MSlwk\ReactPhpPlayground\Model\Data\Url;
use MSlwk\ReactPhpPlayground\Standalone\Http\SynchronousClient;
use MSlwk\TypeSafeArray\ObjectArray;
use MSlwk\TypeSafeArray\ObjectArrayFactory;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * Class SynchronousClientTest
 * @package MSlwk\ReactPhpPlayground\Test\Unit\Standalone\Http
 */
class SynchronousClientTest extends TestCase
{
    /**
     * @test
     */
    public function testRun()
    {
        /** @var PHPUnit_Framework_MockObject_MockObject|ObjectArrayFactory $objectArrayFactory */
        $objectArrayFactory = $this->getMockBuilder(ObjectArrayFactory::class)
            ->disableOriginalConstructor()
            ->getMock();
        $htmlObjectArray = $this->getMockBuilder(ObjectArray::class)
            ->setConstructorArgs(
                [
                    'type' => HtmlInterface::class
                ]
            )
            ->setMethods(null)
            ->getMock();
        $objectArrayFactory->expects($this->once())
            ->method('create')
            ->with(HtmlInterface::class)
            ->willReturn($htmlObjectArray);
        /** @var PHPUnit_Framework_MockObject_MockObject|ObjectArray $urls */
        $urls = $this->getMockBuilder(ObjectArray::class)
            ->setConstructorArgs(
                [
                    'type' => UrlInterface::class,
                    'objects' => [
                        new Url('')
                    ]
                ]
            )
            ->setMethods(null)
            ->getMock();

        /** @var PHPUnit_Framework_MockObject_MockObject|SynchronousClient $runner */
        $runner = $this->getMockBuilder(SynchronousClient::class)
            ->setConstructorArgs(
                [
                    'objectArrayFactory' => $objectArrayFactory
                ]
            )
            ->setMethods(['fileGetContentsWrapper'])
            ->getMock();
        $runner->expects($this->once())
            ->method('fileGetContentsWrapper')
            ->willReturn('');

        $result = $runner->getContent($urls);
        $this->assertEquals(1, $result->count());
    }
}
