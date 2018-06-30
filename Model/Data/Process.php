<?php
/**
 * File: Process.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */


namespace MSlwk\ReactPhpPlayground\Model\Data;

use MSlwk\ReactPhpPlayground\Api\Data\ProcessInterface;

/**
 * Class Process
 * @package MSlwk\ReactPhpPlayground\Model\Data
 */
class Process implements ProcessInterface
{
    /**
     * @var string
     */
    private $command;

    /**
     * Process constructor.
     * @param string $command
     */
    public function __construct(string $command)
    {
        $this->command = $command;
    }

    /**
     * @return string
     */
    public function getCommand(): string
    {
        return $this->command;
    }
}
