<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/23/17
 * Time: 10:27 PM
 */

namespace App\Command;


use Core\Interfaces\_Command;
use SebastianBergmann\GlobalState\RuntimeException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Console\Input\InputArgument;

class ServeCommand extends _Command
{
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('serve')
            ->setDescription('Serve A server php built in')
            ->addArgument(
                'port',
                InputArgument::OPTIONAL,
                'path of test'
            )
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {

        $port = $input->getArgument('port');
        $port = isset($port) ? $port : 8000;

        $output->writeln(PHP_EOL.'Served On localhost:'.$port);

        $process = new Process('php -S localhost:'.$port.' -t public');
        $process->run();

        if (!$process->isSuccessful()) {
            throw new RuntimeException($process->getErrorOutput());
        }

        print $process->getOutput();

        $output->writeln(PHP_EOL.'Served On localhost:'.$port);
        return;

    }
}