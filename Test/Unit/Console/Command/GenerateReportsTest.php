<?php
declare(strict_types=1);

/**
 * GenerateReportsTest *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Test\Unit\Console\Command;

use MSlwk\ReactPhpPlayground\Console\Command\GenerateReports;
use PHPUnit\Framework\TestCase;
use Magento\Framework\Serialize\Serializer\Json;
use MSlwk\ReactPhpPlayground\Api\Report\CliReportManagerInterface;
use ReflectionClass;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * Class GenerateReportsTest
 * @package MSlwk\ReactPhpPlayground\Test\Unit\Console\Command
 */
class GenerateReportsTest extends TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject|Json
     */
    private $jsonHandler;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject|CliReportManagerInterface
     */
    private $reportManager;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject|InputInterface
     */
    private $input;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject|OutputInterface
     */
    private $output;

    /**
     * @var GenerateReports
     */
    private $command;

    /**
     * @return void
     */
    protected function setUp()
    {
        $this->jsonHandler = $this->getMockBuilder(Json::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->reportManager = $this->getMockBuilder(CliReportManagerInterface::class)
            ->getMock();
        $this->input = $this->getMockBuilder(InputInterface::class)
            ->getMock();
        $this->output = $this->getMockBuilder(OutputInterface::class)
            ->getMock();

        $this->command = new GenerateReports(
            $this->jsonHandler,
            $this->reportManager
        );
    }

    /**
     * @test
     */
    public function testCommandHasCorrectName()
    {
        $this->assertEquals(GenerateReports::COMMAND_NAME, $this->command->getName());
    }

    /**
     * @test
     */
    public function testCommandHasCorrectDescription()
    {
        $this->assertEquals(GenerateReports::COMMAND_DESCRIPTION, $this->command->getDescription());
    }

    /**
     * @test
     */
    public function testExecute()
    {
        $customerIds = [1, 2];
        $this->input->expects($this->once())
            ->method('getArgument')
            ->with(GenerateReports::ARGUMENT_CUSTOMER_IDS)
            ->willReturn('json');
        $this->jsonHandler->expects($this->once())
            ->method('unserialize')
            ->with('json')
            ->willReturn($customerIds);
        $this->reportManager->expects($this->once())
            ->method('generateAndSendReportForCustomers')
            ->with($customerIds);

        $reflection = new ReflectionClass(get_class($this->command));
        $method = $reflection->getMethod('execute');
        $method->setAccessible(true);
        $method->invokeArgs($this->command, [$this->input, $this->output]);

    }
}
