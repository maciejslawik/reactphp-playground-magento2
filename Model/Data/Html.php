<?php
declare(strict_types=1);

/**
 * File: Html.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Model\Data;

use MSlwk\ReactPhpPlayground\Api\Data\HtmlInterface;

/**
 * Class Html
 * @package MSlwk\ReactPhpPlayground\Model\Data
 */
class Html implements HtmlInterface
{
    /**
     * @var string
     */
    private $html;

    /**
     * Html constructor.
     * @param string $html
     */
    public function __construct(string $html)
    {
        $this->html = $html;
    }

    /**
     * @return string
     */
    public function getHtml(): string
    {
        return $this->html;
    }
}
