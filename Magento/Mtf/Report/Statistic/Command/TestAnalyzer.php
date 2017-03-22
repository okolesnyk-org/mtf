<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Mtf\Report\Statistic\Command;

use Magento\Mtf\Report\Converter\Csv\Basic;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Mtf\Report\Statistic\Manager;

class TestAnalyzer extends \Symfony\Component\Console\Command\Command
{
    /**
     * Path to CSV report file.
     */
    const CSV_REPORT_PATH = MTF_BP . '/var/log/variations_data.csv';

    /**
     * @var Manager
     */
    private $manager;

    /**
     * @var Basic
     */
    private $converter;

    /**
     * @param Manager $manager
     * @param Basic $converter
     */
    public function __construct(
        Manager $manager,
        Basic $converter
    ) {
        parent::__construct();
        $this->manager = $manager;
        $this->converter = $converter;
    }

    /**
     * Configure command.
     *
     * @return void
     */
    protected function configure()
    {
        parent::configure();
        $this->setName('statistic:get-variation-data')
            ->setDescription('Retrieve test variations statistic.');
    }

    /**
     * Execute command.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Collecting test variation stats...");
        $now = microtime();
        $this->converter->saveTo($this->manager->getData(), self::CSV_REPORT_PATH);
        $output->writeln("Test statistic preparation finished in: " . microtime() - $now);
    }
}
