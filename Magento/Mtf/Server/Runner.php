<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Mtf\Server;

use Magento\Mtf\ObjectManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Runner extends Command
{
    /**
     * Hostname.
     *
     * @var string
     */
    private $hostname;

    /**
     * Port.
     *
     * @var string
     */
    private $port;

    /**
     * Object manager instance.
     *
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @param ObjectManagerInterface $objectManager
     * @param string $hostname
     * @param string $port
     * @param null $name
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        $hostname = 'localhos',
        $port = '8000',
        $name = null
    ) {
        parent::__construct($name);

        $this->hostname = $hostname;
        $this->port = $port;
        $this->objectManager = $objectManager;
    }

    /**
     * Configure command.
     *
     * @return void
     */
    protected function configure()
    {
        parent::configure();
        $this->setName('server:run')
            ->setDescription('Run local php server.');
    }

    /**
     * Run local php server.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output = $this->objectManager->create(
            \Magento\Mtf\Console\Output::class,
            ['output' => $output]
        );
        $path =  __DIR__. '/../../../web';
        exec("php -S "
            . escapeshellarg($this->hostname) . ':'
            . escapeshellarg($this->port) . ' -t '
            . escapeshellarg($path) . '  2>&1',
            $error
        );
        if ($error) {
            $output->outputMessages(['error' => $error]);
        }
    }
}