<?php
/**
 * File: UrlInterface.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Api\Data;

/**
 * Interface UrlInterface
 * @package MSlwk\ReactPhpPlayground\Api\Data
 */
interface UrlInterface
{
    /**
     * @return string
     */
    public function getUrl(): string;
}
