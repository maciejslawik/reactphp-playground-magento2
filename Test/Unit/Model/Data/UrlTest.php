<?php
declare(strict_types=1);

/**
 * File:UrlTest.php
 *
 * @author Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * @copyright Copyright (C) 2018 Lizard Media (http://lizardmedia.pl)
 */

namespace MSlwk\ReactPhpPlayground\Test\Unit\Model\Data;

use MSlwk\ReactPhpPlayground\Model\Data\Url;
use PHPUnit\Framework\TestCase;

/**
 * Class UrlTest
 * @package MSlwk\ReactPhpPlayground\Test\Unit\Model\Data
 */
class UrlTest extends TestCase
{
    /**
     * @test
     */
    public function testGetUrl()
    {
        $url = 'https://magento.com';
        $urlObject = new Url($url);

        $this->assertEquals($url, $urlObject->getUrl());
    }
}
