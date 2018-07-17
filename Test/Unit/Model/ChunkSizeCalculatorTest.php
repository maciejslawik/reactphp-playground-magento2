<?php
declare(strict_types=1);

/**
 * File: ChunkSizeCalculatorTest.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Test\Unit\Model;

use MSlwk\ReactPhpPlayground\Model\ChunkSizeCalculator;
use PHPUnit\Framework\TestCase;

/**
 * Class ChunkSizeCalculatorTest
 * @package MSlwk\ReactPhpPlayground\Test\Unit\Model
 */
class ChunkSizeCalculatorTest extends TestCase
{
    /**
     * @test
     * @param array $elements
     * @param int $numberOfThreads
     * @param int $expected
     * @dataProvider chunksDataProvider
     */
    public function testCalculateNumberOfChunks(array $elements, int $numberOfThreads, int $expected)
    {
        $calculator = new ChunkSizeCalculator();

        $this->assertEquals($expected, $calculator->calculateChunkSize($elements, $numberOfThreads));
    }

    /**
     * @return array
     */
    public function chunksDataProvider()
    {
        return [
            [
                [
                    1,
                    2,
                    3,
                    4,
                    5,
                    6,
                    7
                ],
                3,
                3
            ],
            [
                [
                    1,
                    2,
                    3,
                    4,
                    5,
                    6
                ],
                5,
                2
            ],
            [
                [
                    1,
                    2,
                    3
                ],
                5,
                1
            ]
        ];
    }
}
