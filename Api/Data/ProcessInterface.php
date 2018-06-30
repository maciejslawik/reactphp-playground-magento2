<?php
/**
 * File: ProcessInterface.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Api\Data;

/**
 * Interface ProcessInterface
 * @package MSlwk\ReactPhpPlayground\Api\Data
 */
interface ProcessInterface
{
    /**
     * @return string
     */
    public function getCommand(): string;
}
