<?php
declare(strict_types=1);

/**
 * File: ChunkSizeCalculatorInterface.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Api;

/**
 * Interface ChunkSizeCalculatorInterface
 * @package MSlwk\ReactPhpPlayground\Api
 */
interface ChunkSizeCalculatorInterface
{
    /**
     * @param array $elements
     * @param int $numberOfParts
     * @return int
     */
    public function calculateChunkSize(array $elements, int $numberOfParts): int;
}
