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
use Symfony\Component\Console\Helper\ProcessHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class RunTestCommand extends _Command
{
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('test:api')
            ->setDescription('Test Api Run')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {


        $dir = $this->getPath();

        foreach($dir as $testFile){
            $process = new Process('./vendor/bin/phpunit '. __APP_ROOT__.'/test/api/'.$testFile);
            $process->setTimeout(3600);
            $process->run();

            if (!$process->isSuccessful()) {
                throw new RuntimeException($process->getErrorOutput());
            }

            print $process->getOutput();

        }






    }


    public function getPath()
    {
        $dir = scandir(__APP_ROOT__.'/test/api');
        $ex_folders = array('..', '.');

        return array_diff($dir,$ex_folders);
    }


}