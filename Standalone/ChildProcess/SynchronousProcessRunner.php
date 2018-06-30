<?php
/**
 * File: SynchronousProcessRunner.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Standalone\ChildProcess;

use MSlwk\ReactPhpPlayground\Api\Data\ProcessInterface;
use MSlwk\TypeSafeArray\ObjectArray;

/**
 * Class SynchronousProcessRunner
 * @package MSlwk\ReactPhpPlayground\Standalone\ChildProcess
 */
class SynchronousProcessRunner implements ProcessRunnerInterface
{
    /**
     * @param ObjectArray $processes
     * @return void
     */
    public function runProcesses(ObjectArray $processes): void
    {
        /** @var ProcessInterface $process */
        foreach ($processes as $process) {
            $output = exec($process->getCommand());
            echo $output . PHP_EOL;
        }
    }
}
