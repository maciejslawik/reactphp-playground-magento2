<?php
/**
 * File: Url.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Model\Data;

use MSlwk\ReactPhpPlayground\Api\Data\UrlInterface;

/**
 * Class Url
 * @package MSlwk\ReactPhpPlayground\Model\Data
 */
class Url implements UrlInterface
{
    /**
     * @var string
     */
    private $url;

    /**
     * Url constructor.
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}
