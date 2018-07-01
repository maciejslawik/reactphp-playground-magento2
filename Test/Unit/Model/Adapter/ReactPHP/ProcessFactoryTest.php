<?php
declare(strict_types=1);

/**
 * File:ProcessFactoryTest.php
 *
 * @author Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * @copyright Copyright (C) 2018 Lizard Media (http://lizardmedia.pl)
 */

namespace MSlwk\ReactPhpPlayground\Test\Unit\Model\Adapter\ReactPHP;

use MSlwk\ReactPhpPlayground\Model\Adapter\ReactPHP\ProcessFactory;
use PHPUnit\Framework\TestCase;
use React\ChildProcess\Process;

/**
 * Class ProcessFactoryTest
 * @package MSlwk\ReactPhpPlayground\Test\Unit\Model\Adapter\ReactPHP
 */
class ProcessFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function testFactoryReturnsCorrectObject()
    {
        $command = 'ps aux';
        $factory = new ProcessFactory();

        $result = $factory->create($command);

        $this->assertInstanceOf(Process::class, $result);
    }
}
