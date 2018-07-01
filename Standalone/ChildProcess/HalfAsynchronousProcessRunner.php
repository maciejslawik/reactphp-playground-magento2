<?php
declare(strict_types=1);

/**
 * File:HalfAsynchronousProcessRunner.php
 *
 * @author Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * @copyright Copyright (C) 2018 Lizard Media (http://lizardmedia.pl)
 */


namespace MSlwk\ReactPhpPlayground\Standalone\ChildProcess;

use MSlwk\ReactPhpPlayground\Api\Data\ProcessInterface;
use MSlwk\ReactPhpPlayground\Model\Adapter\ReactPHP\ProcessFactory;
use MSlwk\TypeSafeArray\ObjectArray;
use React\EventLoop\LoopInterface;

/**
 * Class HalfAsynchronousProcessRunner
 * @package MSlwk\ReactPhpPlayground\Standalone\ChildProcess
 */
class HalfAsynchronousProcessRunner implements ProcessRunnerInterface
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
        for ($i = 0; $i < ($processes->count() / 2); $i++) {
            $this->createProcessDefinition($processes->offsetGet($i));
        }
        $this->loop->run();

        for ($i; $i < ($processes->count()); $i++) {
            $this->createProcessDefinition($processes->offsetGet($i));
        }
        $this->loop->run();
    }

    /**
     * @codeCoverageIgnore
     * @param ProcessInterface $process
     * @return void
     */
    protected function createProcessDefinition(ProcessInterface $process): void
    {
        $reactProcess = $this->processFactory->create($process->getCommand());
        $reactProcess->start($this->loop);

        $reactProcess->stdout->on('data', function ($chunk) {
            echo $chunk;
        });
    }
}
