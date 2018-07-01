<?php
declare(strict_types=1);

/**
 * File:UrlProviderTest.php
 *
 * @author Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * @copyright Copyright (C) 2018 Lizard Media (http://lizardmedia.pl)
 */

namespace MSlwk\ReactPhpPlayground\Test\Unit\Standalone\Http;

use MSlwk\ReactPhpPlayground\Api\Data\UrlInterface;
use MSlwk\ReactPhpPlayground\Standalone\Http\UrlProvider;
use MSlwk\TypeSafeArray\ObjectArray;
use MSlwk\TypeSafeArray\ObjectArrayFactory;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * Class UrlProviderTest
 * @package MSlwk\ReactPhpPlayground\Test\Unit\Standalone\Http
 */
class UrlProviderTest extends TestCase
{
    /**
     * @test
     */
    public function testGetUrls()
    {
        /** @var PHPUnit_Framework_MockObject_MockObject|ObjectArrayFactory $objectArrayFactory */
        $objectArrayFactory = $this->getMockBuilder(ObjectArrayFactory::class)
            ->disableOriginalConstructor()
            ->getMock();
        $urlProvider = new UrlProvider($objectArrayFactory);

        $objectArray = $this->getMockBuilder(ObjectArray::class)
            ->setConstructorArgs(
                [
                    'type' => UrlInterface::class
                ]
            )
            ->setMethods(null)
            ->getMock();

        $objectArrayFactory->expects($this->once())
            ->method('create')
            ->willReturn($objectArray);

        $result = $urlProvider->getUrls();

        $this->assertInstanceOf(ObjectArray::class, $result);
        $this->assertEquals(6, $result->count());
    }
}
