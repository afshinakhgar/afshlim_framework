<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/13/17
 * Time: 3:45 PM
 */

namespace App\Command;
use Core\Interfaces\_Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Question\Question;

class MakeMigration extends _Command
{
    protected function configure()
    {
        $this
            ->setName('make:migration')
            ->setDescription('Generate Migration Class')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'Model name to Generate'
            )
            ->addArgument(
                'column',
                InputArgument::IS_ARRAY,
                'column name (column:type) '
            )
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $names   = $input->getArgument('name');
        $column = $input->getArgument('column');
        $map ="";
        $directory = 'database/migrations/';
        $file = file_get_contents("core/resources/templates/create_migration.txt");
        $explodedArrName = explode('_',$names);
        $classNameNew ='';
        foreach($explodedArrName as $parted_names){
            $classNameNew .= ucfirst($parted_names);
        }


        $file = str_replace("!name", ucfirst($classNameNew).'Migration', $file);
        $file = str_replace("?name", strtolower($classNameNew), $file);
        foreach ($column as $c) {
            $entity = explode(":", $c);
            $name   = $entity[0];
            $type   = $entity[1];
            //$map    .= "$table->".$type."('".$name."');".'\r\n';
            $map    .= '$table->'.$type.'("'.$name.'");'."\n";
        }
        $file = str_replace("!table", $map, $file);
        $explodedArrName = explode('_',$names);
        $fileNameNew ='';
        foreach($explodedArrName as $parted_names){
            $fileNameNew .= ucfirst($parted_names).'_';
        }
        if (!file_exists($directory.date('YmdHis')."_".ucfirst($fileNameNew)."Migration.php")) {
            $fh = fopen($directory .date('YmdHis')."_". ucfirst($fileNameNew) . "Migration.php", "w");
            fwrite($fh, $file);
            fclose($fh);
            $className = ucfirst($fileNameNew) . "Migration.php";
            $output->writeln("Created $className Migration in migrations");
        } else {
            $output->writeln("Class migration already Exists!");
        }

    }
}
