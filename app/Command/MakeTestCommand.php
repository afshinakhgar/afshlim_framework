<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/20/17
 * Time: 1:39 PM
 */

namespace App\Command;


use Core\Interfaces\_Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeTestCommand extends _Command
{
    protected function configure()
    {
        $this
            ->setName('make:test')
            ->setDescription('Generate Test Class')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'Name of the Class to Create'
            )->addArgument(
                'path',
                InputArgument::OPTIONAL,
                'Name of the Class to Create'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $validPaths = [
            'app','api'
        ];



        $name = $input->getArgument('name');



        $path = $input->getArgument('path');
        $path = isset($path) ? $path : 'app';


        if(!in_array($path,$validPaths)){
            $output->writeln('Problem With Path');
            return;
        }
        $directory = "tests/".$path.'/';

        $file = file_get_contents("core/resources/templates/create_{$path}_test.txt");
        $hasNamespace = true;

        if ($hasNamespace || strpos($name, '/') != 0) {
            $hasNamespace = true;
            $modelArr = explode('/', $name);
            $name = $modelArr[count($modelArr) - 1];
            unset($modelArr[count($modelArr) - 1]);
            $model_path = '';
            $namespace = '';
            foreach ($modelArr as $item) {
                $model_path .= ucfirst($item) . '/';
                $namespace .= ucfirst($item) . '\\';
            }
            $directory .= $model_path;

            $namespace = ucfirst(ucfirst($path)).'\\'.rtrim($namespace, '\\');
            $namespace = trim($namespace,'\\');
            $file = str_replace("!namespace", "Test\\{$namespace}", $file);


        } else {

            $file = str_replace("!namespace", "Test", $file);
        }

        $file = str_replace("!name", ucfirst($name).'Test', $file);

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


        if (!file_exists($directory . ucfirst($name) . "Test.php")) {
            $fh = fopen($directory . ucfirst($name) . "Test.php", "w");
            fwrite($fh, $file);
            fclose($fh);
            $className = ucfirst($name) . "Test.php";
            if ($hasNamespace) {
                $output->writeln("Created $className in Test\\{$namespace}");

            } else {
                $output->writeln("Created $className in Test");

            }
        } else {
            $output->writeln("Class Action already Exists!");
        }

    }
}