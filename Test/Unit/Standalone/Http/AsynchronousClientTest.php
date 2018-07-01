<?php
declare(strict_types=1);

/**
 * File:AsynchronousClientTest.php
 *
 * @author Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * @copyright Copyright (C) 2018 Lizard Media (http://lizardmedia.pl)
 */

namespace MSlwk\ReactPhpPlayground\Test\Unit\Standalone\Http;

use MSlwk\ReactPhpPlayground\Api\Data\HtmlInterface;
use MSlwk\ReactPhpPlayground\Api\Data\UrlInterface;
use MSlwk\ReactPhpPlayground\Model\Adapter\ReactPHP\ClientFactory;
use MSlwk\ReactPhpPlayground\Model\Data\Url;
use MSlwk\ReactPhpPlayground\Standalone\Http\AsynchronousClient;
use MSlwk\TypeSafeArray\ObjectArray;
use MSlwk\TypeSafeArray\ObjectArrayFactory;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;
use React\EventLoop\LoopInterface;
use React\HttpClient\Client;
use React\HttpClient\Request;

/**
 * Class AsynchronousClientTest
 * @package MSlwk\ReactPhpPlayground\Test\Unit\Standalone\Http
 */
class AsynchronousClientTest extends TestCase
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
     * @var AsynchronousClient
     */
    private $asynchronousClient;

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

        $this->asynchronousClient = new AsynchronousClient(
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
                    'objects' => [new Url('url')]
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
        $this->clientFactory->expects($this->once())
            ->method('create')
            ->with($this->loop)
            ->willReturn($client);
        $request = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->willReturn($request);
        $request->expects($this->once())
            ->method('end');
        $request->expects($this->once())
            ->method('on');
        $this->loop->expects($this->once())
            ->method('run');

        $result = $this->asynchronousClient->getContent($urlObjectArray);

        $this->assertInstanceOf(ObjectArray::class, $result);
    }
}
