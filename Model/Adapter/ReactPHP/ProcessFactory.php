<?php
declare(strict_types=1);

/**
 * File: ProcessFactory.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Model\Adapter\ReactPHP;

use React\ChildProcess\Process;

/**
 * Class ProcessFactory
 * @package MSlwk\ReactPhpPlayground\Model\Adapter\ReactPHP
 */
class ProcessFactory
{
    /**
     * @param string $command
     * @return Process
     */
    public function create(string $command): Process
    {
        return new Process($command);
    }
}
