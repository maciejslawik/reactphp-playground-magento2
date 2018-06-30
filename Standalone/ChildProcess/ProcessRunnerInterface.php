<?php
/**
 * File: ProcessRunnerInterface.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Standalone\ChildProcess;

use MSlwk\TypeSafeArray\ObjectArray;

/**
 * Interface ProcessRunnerInterface
 * @package MSlwk\ReactPhpPlayground\Standalone\ChildProcess
 */
interface ProcessRunnerInterface
{
    /**
     * @param ObjectArray $processes
     * @return void
     */
    public function runProcesses(ObjectArray $processes): void;
}
