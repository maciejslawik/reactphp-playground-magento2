<?php
declare(strict_types=1);

/**
 * File:HtmlTest.php
 *
 * @author Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * @copyright Copyright (C) 2018 Lizard Media (http://lizardmedia.pl)
 */

namespace MSlwk\ReactPhpPlayground\Test\Unit\Model\Data;

use MSlwk\ReactPhpPlayground\Model\Data\Html;
use PHPUnit\Framework\TestCase;

/**
 * Class HtmlTest
 * @package MSlwk\ReactPhpPlayground\Test\Unit\Model\Data
 */
class HtmlTest extends TestCase
{
    /**
     * @test
     */
    public function testGetHtml()
    {
        $html = '<body></body>';
        $htmlObject = new Html($html);

        $this->assertEquals($html, $htmlObject->getHtml());
    }
}
