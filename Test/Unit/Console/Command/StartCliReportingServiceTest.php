<?php
declare(strict_types=1);

/**
 * File: StartCliReportingServiceTest.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Test\Unit\Console\Command;

use MSlwk\ReactPhpPlayground\Api\ChunkSizeCalculatorInterface;
use MSlwk\ReactPhpPlayground\Console\Command\StartCliReportingService;
use PHPUnit\Framework\TestCase;
use Magento\Framework\Serialize\Serializer\Json;
use PHPUnit_Framework_MockObject_MockObject;
use MSlwk\ReactPhpPlayground\Api\CustomerIdsProviderInterface;
use MSlwk\ReactPhpPlayground\Api\TimerInterface;
use MSlwk\ReactPhpPlayground\Model\Adapter\ReactPHP\ProcessFactory;
use React\EventLoop\Factory;

/**
 * Class StartCliReportingServiceTest
 * @package MSlwk\ReactPhpPlayground\Test\Unit\Console\Command
 */
class StartCliReportingServiceTest extends TestCase
{
    /**
     * @var StartCliReportingService
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
        /** @var PHPUnit_Framework_MockObject_MockObject|ProcessFactory $processFactory */
        $processFactory = $this->getMockBuilder(ProcessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();
        /** @var PHPUnit_Framework_MockObject_MockObject|Json $jsonHandler */
        $jsonHandler = $this->getMockBuilder(Json::class)
            ->disableOriginalConstructor()
            ->getMock();
        /** @var PHPUnit_Framework_MockObject_MockObject|ChunkSizeCalculatorInterface $chunkSizeCalculator */
        $chunkSizeCalculator = $this->getMockBuilder(ChunkSizeCalculatorInterface::class)
            ->getMock();

        $this->command = new StartCliReportingService(
            $timer,
            $customerIdsProvider,
            $loopFactory,
            $processFactory,
            $jsonHandler,
            $chunkSizeCalculator
        );
    }

    /**
     * @test
     */
    public function testCommandHasCorrectName()
    {
        $this->assertEquals(StartCliReportingService::COMMAND_NAME, $this->command->getName());
    }

    /**
     * @test
     */
    public function testCommandHasCorrectDescription()
    {
        $this->assertEquals(StartCliReportingService::COMMAND_DESCRIPTION, $this->command->getDescription());
    }
}
