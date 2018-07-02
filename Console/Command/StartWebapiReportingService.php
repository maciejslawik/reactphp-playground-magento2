<?php
/**
 * File: StartWebapiReportingService.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\ReactPhpPlayground\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class StartWebapiReportingService
 * @package MSlwk\ReactPhpPlayground\Console\Command
 */
class StartWebapiReportingService extends Command
{
    const COMMAND_NAME = 'mslwk:webapi-reporting-start';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName(self::COMMAND_NAME)
            ->setDescription('Start asynchronous WebAPI reporting service');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

    }
}
