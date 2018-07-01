<?php
declare(strict_types=1);

/**
 * File:ClientFactoryTest.php
 *
 * @author Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * @copyright Copyright (C) 2018 Lizard Media (http://lizardmedia.pl)
 */

namespace MSlwk\ReactPhpPlayground\Test\Unit\Model\Adapter\ReactPHP;

use MSlwk\ReactPhpPlayground\Model\Adapter\ReactPHP\ClientFactory;
use PHPUnit\Framework\TestCase;
use React\EventLoop\LoopInterface;
use React\HttpClient\Client;

/**
 * Class ClientFactoryTest
 * @package MSlwk\ReactPhpPlayground\Test\Unit\Model\Adapter\ReactPHP
 */
class ClientFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function testFactoryReturnsCorrectObject()
    {
        $loop = $this->getMockBuilder(LoopInterface::class)
            ->getMock();
        $factory = new ClientFactory();

        $result = $factory->create($loop);

        $this->assertInstanceOf(Client::class, $result);
    }
}
