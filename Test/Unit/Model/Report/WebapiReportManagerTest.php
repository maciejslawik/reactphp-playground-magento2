<?php
declare(strict_types=1);

/**
 * File: WebapiReportManagerTest.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Test\Unit\Model\Report;

use MSlwk\ReactPhpPlayground\Api\Report\ReportGeneratorInterface;
use MSlwk\ReactPhpPlayground\Api\Report\ReportSenderInterface;
use MSlwk\ReactPhpPlayground\Model\Report\WebapiReportManager;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * Class WebapiReportManagerTest
 * @package MSlwk\ReactPhpPlayground\Test\Unit\Model\Report
 */
class WebapiReportManagerTest extends TestCase
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
     * @var WebapiReportManager
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

        $this->reportManager = new WebapiReportManager(
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

        $result = $this->reportManager->generateAndSendReportForCustomers($customerIds);

        $this->assertEquals(3, count($result));
    }
}
