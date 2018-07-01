<?php
declare(strict_types=1);

/**
 * File:HalfHalfAsynchronousClientTest.php
 *
 * @author Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * @copyright Copyright (C) 2018 Lizard Media (http://lizardmedia.pl)
 */

namespace MSlwk\ReactPhpPlayground\Test\Unit\Standalone\Http;

use MSlwk\ReactPhpPlayground\Api\Data\HtmlInterface;
use MSlwk\ReactPhpPlayground\Api\Data\UrlInterface;
use MSlwk\ReactPhpPlayground\Model\Adapter\ReactPHP\ClientFactory;
use MSlwk\ReactPhpPlayground\Model\Data\Url;
use MSlwk\ReactPhpPlayground\Standalone\Http\HalfAsynchronousClient;
use MSlwk\TypeSafeArray\ObjectArray;
use MSlwk\TypeSafeArray\ObjectArrayFactory;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;
use React\EventLoop\LoopInterface;
use React\HttpClient\Client;
use React\HttpClient\Request;

/**
 * Class HalfHalfAsynchronousClientTest
 * @package MSlwk\ReactPhpPlayground\Test\Unit\Standalone\Http
 */
class HalfHalfAsynchronousClientTest extends TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject|LoopInterface
     */
    private $loop;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject|ClientFactory
     */
    private $clientFactory;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject|ObjectArrayFactory
     */
    private $objectArrayFactory;

    /**
     * @var HalfAsynchronousClient
     */
    private $halfHalfAsynchronousClient;

    /**
     * @return void
     */
    protected function setUp()
    {
        $this->loop = $this->getMockBuilder(LoopInterface::class)
            ->getMock();
        $this->clientFactory = $this->getMockBuilder(ClientFactory::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->objectArrayFactory = $this->getMockBuilder(ObjectArrayFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->halfHalfAsynchronousClient = new HalfAsynchronousClient(
            $this->loop,
            $this->clientFactory,
            $this->objectArrayFactory
        );
    }

    /**
     * @test
     */
    public function testGetContent()
    {
        /** @var PHPUnit_Framework_MockObject_MockObject|ObjectArray $htmlObjectArray */
        $htmlObjectArray = $this->getMockBuilder(ObjectArray::class)
            ->setConstructorArgs(
                [
                    'type' => HtmlInterface::class
                ]
            )
            ->setMethods(null)
            ->getMock();
        /** @var PHPUnit_Framework_MockObject_MockObject|ObjectArray $urlObjectArray */
        $urlObjectArray = $this->getMockBuilder(ObjectArray::class)
            ->setConstructorArgs(
                [
                    'type' => UrlInterface::class,
                    'objects' => [new Url('url'), new Url('url')]
                ]
            )
            ->setMethods(null)
            ->getMock();
        $this->objectArrayFactory->expects($this->once())
            ->method('create')
            ->willReturn($htmlObjectArray);
        $client = $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->clientFactory->expects($this->exactly(2))
            ->method('create')
            ->with($this->loop)
            ->willReturn($client);
        $request = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->exactly(2))
            ->method('request')
            ->willReturn($request);
        $request->expects($this->exactly(2))
            ->method('end');
        $request->expects($this->exactly(2))
            ->method('on');
        $this->loop->expects($this->exactly(2))
            ->method('run');

        $result = $this->halfHalfAsynchronousClient->getContent($urlObjectArray);

        $this->assertInstanceOf(ObjectArray::class, $result);
    }
}
