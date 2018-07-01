<?php
declare(strict_types=1);

/**
 * File:ProcessTest.php
 *
 * @author Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * @copyright Copyright (C) 2018 Lizard Media (http://lizardmedia.pl)
 */

namespace MSlwk\ReactPhpPlayground\Test\Unit\Model\Data;

use MSlwk\ReactPhpPlayground\Model\Data\Process;
use PHPUnit\Framework\TestCase;

/**
 * Class ProcessTest
 * @package MSlwk\ReactPhpPlayground\Test\Unit\Model\Data
 */
class ProcessTest extends TestCase
{
    /**
     * @test
     */
    public function testGetCommand()
    {
        $command = 'ps aux';
        $commandObject = new Process($command);

        $this->assertEquals($command, $commandObject->getCommand());
    }
}
