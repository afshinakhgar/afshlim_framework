<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/17/17
 * Time: 3:33 PM
 */

namespace App\Command;


use Core\Interfaces\_Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeMiddleware extends _Command
{
    protected function configure()
    {
        $this
            ->setName('make:middleware')
            ->setDescription('Create a Middleware Class')
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

        $directory = "app/Middleware/";
        $file = file_get_contents("core/resources/templates/create_middleware.txt");
        $file = str_replace("!name", $name, $file);
        if (is_dir($directory) && !is_writable($directory)) {
            $output->writeln('The "%s" directory is not writable');
            return;
        }
        if (!is_dir($directory)) {

            $helper = $this->getHelper('question');
            $question = new Question('<question>Directory doesn\'t exist. Would you like to try to create it?</question>');
            // $question->setHidden(true);
            // $question->setHiddenFallback(false);
            // $question->setMaxAttempts(2);
            $q = $helper->ask($input, $output, $question);

            if ($q) {
                @mkdir($directory);
            }

            if (!is_dir($directory)) {
                $output->writeln('<error>Couldn\'t create directory.</error>');
                return;
            }
        }
        if (!file_exists($directory.$name."Middleware.php")) {
            $fh = fopen($directory . $name . "Middleware.php", "w");
            fwrite($fh, $file);
            fclose($fh);
            $className = $name . "Middleware.php";
            $output->writeln("Created $className in App\\Middleware");
        } else {
            $output->writeln("Class already Exists!");
        }
    }
}