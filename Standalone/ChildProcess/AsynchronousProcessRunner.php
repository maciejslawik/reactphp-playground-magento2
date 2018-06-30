<?php
/**
 * File: AsynchronousProcessRunner.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Standalone\ChildProcess;

use MSlwk\ReactPhpPlayground\Api\Data\ProcessInterface;
use MSlwk\ReactPhpPlayground\Model\Adapter\ReactPHP\ProcessFactory;
use MSlwk\TypeSafeArray\ObjectArray;
use React\EventLoop\LoopInterface;

/**
 * Class AsynchronousProcessRunner
 * @package MSlwk\ReactPhpPlayground\Standalone\ChildProcess
 */
class AsynchronousProcessRunner implements ProcessRunnerInterface
{
    /**
     * @var LoopInterface
     */
    private $loop;

    /**
     * @var ProcessFactory
     */
    private $processFactory;

    /**
     * AsynchronousProcessRunner constructor.
     * @param LoopInterface $loop
     * @param ProcessFactory $processFactory
     */
    public function __construct(
        LoopInterface $loop,
        ProcessFactory $processFactory
    ) {
        $this->loop = $loop;
        $this->processFactory = $processFactory;
    }

    /**
     * @param ObjectArray $processes
     * @return void
     */
    public function runProcesses(ObjectArray $processes): void
    {
        /** @var ProcessInterface $process */
        foreach ($processes as $process) {
            $reactProcess = $this->processFactory->create($process->getCommand());
            $reactProcess->start($this->loop);

            $reactProcess->stdout->on('data', function ($chunk) {
                echo $chunk;
            });
        }
        $this->loop->run();
    }
}
