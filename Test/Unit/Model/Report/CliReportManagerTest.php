<?php
declare(strict_types=1);

/**
 * File: CliReportManagerTest.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Test\Unit\Model\Report;

use MSlwk\ReactPhpPlayground\Api\Report\ReportGeneratorInterface;
use MSlwk\ReactPhpPlayground\Api\Report\ReportSenderInterface;
use MSlwk\ReactPhpPlayground\Model\Report\CliReportManager;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * Class CliReportManagerTest
 * @package MSlwk\ReactPhpPlayground\Test\Unit\Model\Report
 */
class CliReportManagerTest extends TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject|ReportGeneratorInterface
     */
    private $reportGenerator;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject|ReportSenderInterface
     */
    private $reportSender;

    /**
     * @var CliReportManager
     */
    private $reportManager;

    /**
     * @return void
     */
    protected function setUp()
    {
        $this->reportGenerator = $this->getMockBuilder(ReportGeneratorInterface::class)
            ->getMock();
        $this->reportSender = $this->getMockBuilder(ReportSenderInterface::class)
            ->getMock();

        $this->reportManager = new CliReportManager(
            $this->reportGenerator,
            $this->reportSender
        );
    }

    /**
     * @test
     */
    public function testSendAndGenerateReports()
    {
        $customerIds = [
            1,
            2,
            3
        ];
        $report = 'report';
        $this->reportGenerator->expects($this->exactly(3))
            ->method('generateReport')
            ->withConsecutive([1], [2], [3])
            ->willReturn($report);
        $this->reportSender->expects($this->exactly(3))
            ->method('sendReport')
            ->with($report);

        $this->reportManager->generateAndSendReportForCustomers($customerIds);
    }
}
