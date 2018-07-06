<?php
declare(strict_types=1);

/**
 * File: FakeCustomerIdsProviderTest.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Test\Unit\Model;

use MSlwk\ReactPhpPlayground\Model\FakeCustomerIdsProvider;
use PHPUnit\Framework\TestCase;

/**
 * Class FakeCustomerIdsProviderTest
 * @package MSlwk\ReactPhpPlayground\Test\Unit\Model
 */
class FakeCustomerIdsProviderTest extends TestCase
{
    /**
     * @test
     */
    public function testProviderReturnsArrayOfInts()
    {
        $idsProvider = new FakeCustomerIdsProvider();
        $result = $idsProvider->getCustomerIds();

        foreach ($result as $id) {
            $this->assertInternalType('int', $id);
        }
    }
}
