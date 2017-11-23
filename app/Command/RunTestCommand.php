<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/20/17
 * Time: 2:41 PM
 */

namespace App\Command;


use Core\Interfaces\_Command;
use SebastianBergmann\GlobalState\RuntimeException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Console\Input\InputArgument;

class RunTestCommand extends _Command
{
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('test')
            ->setDescription('Test Api Run')
            ->addArgument(
                'path',
                InputArgument::OPTIONAL,
                'path of test'
            )
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $validPaths = [
            'app','api'
        ];



        $path = $input->getArgument('path');
        $path = isset($path) ? $path : 'app';
        $dir = $this->getPath($path);


        if(!in_array($path,$validPaths)){
            $output->writeln('Problem With Path');
            return;
        }

        foreach($dir as $testFile){
            $process = new Process('./vendor/bin/phpunit '. __APP_ROOT__.'/tests/'.$path.'/'.$testFile);
            $process->setTimeout(3600);


            $process->run();

            if (!$process->isSuccessful()) {
                throw new RuntimeException($process->getErrorOutput());
            }

            print $process->getOutput();

        }


        $output->writeln(PHP_EOL.'Test Completed');
        return;

    }


    public function getPath($path)
    {
        $dir = scandir(__APP_ROOT__.'/tests/'.$path);
        $ex_folders = array('..', '.');

        return array_diff($dir,$ex_folders);
    }


}