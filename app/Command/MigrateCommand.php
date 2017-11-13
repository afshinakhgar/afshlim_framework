<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/13/17
 * Time: 3:45 PM
 */

namespace App\Command;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;



class MigrateCommand extends Command
{
    private $_MIGRATIONS_PATH = 'database/migrations';

    protected function configure()
    {
        $this
            ->setName('migrate')
            ->setDescription('Migration Execution')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $files = glob($this->_MIGRATIONS_PATH.'/*.php');
        $this->_run($files);
        $output->writeln("Class migration already Exists!");
    }


    public function _run($files)
    {
        $namespace = 'Database\\Migration\\';
//        echo " \n";
        foreach ($files as $file) {
            if(!file_exists($file)) {
                continue;
            }
            $class = explode('_',basename($file, '.php'));
            $class = $namespace.$class[count($class)-1];
            echo $class .' ++++ MIGRATION RUN ++++' .PHP_EOL;


            if(isset($class)){
                $obj = new $class.'()';
            }
            $obj->up();
        }
    }

}
