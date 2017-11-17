<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/17/17
 * Time: 3:05 PM
 */

namespace App\Command;
use Core\Interfaces\_Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
class MakeModel extends _Command
{
    protected function configure()
    {
        $this
            ->setName('make:model')
            ->setDescription('Generate Model Class')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'Name of the Class to Create'
            )
        ;
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $directory = "app/Model/";
        $file = file_get_contents("core/resources/templates/create_model.txt");
        $hasNamespace = false;

        if(strpos($name,'/') != 0){
            $hasNamespace = true;
            $modelArr = explode('/',$name);
            $name = $modelArr[count($modelArr)-1];
            unset($modelArr[count($modelArr)-1]);
            $model_path = '';
            $namespace = '';
            foreach($modelArr as $item){
                $model_path .= ucfirst($item).'/';
                $namespace .= ucfirst($item).'\\';
            }
            $directory .= $model_path;

            $namespace = rtrim($namespace,'\\');


            $file = str_replace("!namespace", "App\\Model\\{$namespace}", $file);


        }else{

            $file = str_replace("!namespace", "App\\Model", $file);
        }

        $file = str_replace("!name", ucfirst($name), $file);

        if (is_dir($directory) && !is_writable($directory)) {
            $output->writeln('The "%s" directory is not writable');
            return;
        }


        if (!is_dir($directory)) {
//            $dialog = $this->getHelperSet()->get('dialog');
//            if (!$dialog->askConfirmation($output, '<question>Directory doesn\'t exist. Would you like to try to create it?</question>')) {
//                return;
//            }
            @mkdir($directory);
            if (!is_dir($directory)) {
                $output->writeln('<error>Couldn\'t create directory.</error>');
                return;
            }
        }



        if (!file_exists($directory.ucfirst($name).".php")) {
            $fh = fopen($directory . ucfirst($name) . ".php", "w");
            fwrite($fh, $file);
            fclose($fh);
            $className = ucfirst($name) . ".php";
            if($hasNamespace){
                $output->writeln("Created $className in App\\Model\\{$namespace}");

            }else{
                $output->writeln("Created $className in App\\Model");

            }
        } else {
            $output->writeln("Class Action already Exists!");
        }


    }
}