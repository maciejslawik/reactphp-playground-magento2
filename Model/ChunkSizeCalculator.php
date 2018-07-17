<?php
declare(strict_types=1);

/**
 * File: ChunkSizeCalculator.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Model;

use MSlwk\ReactPhpPlayground\Api\ChunkSizeCalculatorInterface;

/**
 * Class ChunkSizeCalculator
 * @package MSlwk\ReactPhpPlayground\Model
 */
class ChunkSizeCalculator implements ChunkSizeCalculatorInterface
{
    /**
     * @param array $elements
     * @param int $numberOfParts
     * @return int
     */
    public function calculateChunkSize(array $elements, int $numberOfParts): int
    {
        $numberOfChunks = (int)ceil(count($elements) / $numberOfParts);
        return $numberOfChunks > 0 ? $numberOfChunks : 1;
    }
}
