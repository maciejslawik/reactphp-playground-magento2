<?php
declare(strict_types=1);

/**
 * File: StartWebapiReportingServiceTest.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Test\Unit\Console\Command;

use Magento\Store\Model\StoreManagerInterface;
use MSlwk\ReactPhpPlayground\Api\ChunkSizeCalculatorInterface;
use MSlwk\ReactPhpPlayground\Console\Command\StartWebapiReportingService;
use MSlwk\ReactPhpPlayground\Model\Adapter\ReactPHP\ClientFactory;
use PHPUnit\Framework\TestCase;
use Magento\Framework\Serialize\Serializer\Json;
use PHPUnit_Framework_MockObject_MockObject;
use MSlwk\ReactPhpPlayground\Api\CustomerIdsProviderInterface;
use MSlwk\ReactPhpPlayground\Api\TimerInterface;
use React\EventLoop\Factory;

/**
 * Class StartWebapiReportingServiceTest
 * @package MSlwk\ReactPhpPlayground\Test\Unit\Console\Command
 */
class StartWebapiReportingServiceTest extends TestCase
{
    /**
     * @var StartWebapiReportingService
     */
    private $command;

    /**
     * @return void
     */
    protected function setUp()
    {
        /** @var PHPUnit_Framework_MockObject_MockObject|TimerInterface $timer */
        $timer = $this->getMockBuilder(TimerInterface::class)
            ->getMock();
        /** @var PHPUnit_Framework_MockObject_MockObject|CustomerIdsProviderInterface $customerIdsProvider */
        $customerIdsProvider = $this->getMockBuilder(CustomerIdsProviderInterface::class)
            ->getMock();
        $loopFactory = new Factory();
        /** @var PHPUnit_Framework_MockObject_MockObject|ClientFactory $clientFactory */
        $clientFactory = $this->getMockBuilder(ClientFactory::class)
            ->disableOriginalConstructor()
            ->getMock();
        /** @var PHPUnit_Framework_MockObject_MockObject|Json $jsonHandler */
        $jsonHandler = $this->getMockBuilder(Json::class)
            ->disableOriginalConstructor()
            ->getMock();
        /** @var PHPUnit_Framework_MockObject_MockObject|StoreManagerInterface $storeManager */
        $storeManager = $this->getMockBuilder(StoreManagerInterface::class)
            ->getMock();
        /** @var PHPUnit_Framework_MockObject_MockObject|ChunkSizeCalculatorInterface $chunkSizeCalculator */
        $chunkSizeCalculator = $this->getMockBuilder(ChunkSizeCalculatorInterface::class)
            ->getMock();

        $this->command = new StartWebapiReportingService(
            $timer,
            $customerIdsProvider,
            $loopFactory,
            $clientFactory,
            $jsonHandler,
            $storeManager,
            $chunkSizeCalculator
        );
    }

    /**
     * @test
     */
    public function testCommandHasCorrectName()
    {
        $this->assertEquals(StartWebapiReportingService::COMMAND_NAME, $this->command->getName());
    }

    /**
     * @test
     */
    public function testCommandHasCorrectDescription()
    {
        $this->assertEquals(StartWebapiReportingService::COMMAND_DESCRIPTION, $this->command->getDescription());
    }
}
