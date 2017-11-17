<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/17/17
 * Time: 3:33 PM
 */

namespace App\Command;


use Core\Interfaces\_Command;

class MakeMiddlewate extends _Command
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

        $directory = "app/src/Middleware/";
        $file = file_get_contents("core/resources/templates/create_middleware.txt");
        $file = str_replace("!name", $name, $file);
        if (is_dir($directory) && !is_writable($directory)) {
            $output->writeln('The "%s" directory is not writable');
            return;
        }
        if (!is_dir($directory)) {
            $dialog = $this->getHelperSet()->get('dialog');
            if (!$dialog->askConfirmation($output, '<question>Directory doesn\'t exist. Would you like to try to create it?</question>')) {
                return;
            }
            @mkdir($directory);
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