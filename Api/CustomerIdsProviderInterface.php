<?php
declare(strict_types=1);

/**
 * File: CustomerIdsProviderInterface.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Api;

/**
 * Interface CustomerIdsProviderInterface
 * @package MSlwk\ReactPhpPlayground\Api
 */
interface CustomerIdsProviderInterface
{
    /**
     * @return int[]
     */
    public function getCustomerIds(): array;
}
