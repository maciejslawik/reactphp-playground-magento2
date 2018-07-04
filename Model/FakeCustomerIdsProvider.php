<?php
declare(strict_types=1);

/**
 * File: FakeCustomerIdsProvider.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Model;

use MSlwk\ReactPhpPlayground\Api\CustomerIdsProviderInterface;

/**
 * Class FakeCustomerIdsProvider
 * @package MSlwk\ReactPhpPlayground\Model
 */
class FakeCustomerIdsProvider implements CustomerIdsProviderInterface
{
    /**
     * @return int[]
     */
    public function getCustomerIds(): array
    {
        return [
            1,
            2,
            3,
            4,
            5,
            6,
            7,
            8
        ];
    }
}
