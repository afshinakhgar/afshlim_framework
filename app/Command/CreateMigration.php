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


class CreateMigration extends Command
{
    protected function configure()
    {
        $this
            ->setName('create:migration')
            ->setDescription('Generate Model Class')
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
        $file = file_get_contents("core/resources/migration.template.txt");
        $file = str_replace("!name", ucfirst($names), $file);
        $file = str_replace("?name", strtolower($names), $file);
        foreach ($column as $c) {
            $entity = explode(":", $c);
            $name   = $entity[0];
            $type   = $entity[1];
            //$map    .= "$table->".$type."('".$name."');".'\r\n';
            $map    .= '$table->'.$type.'("'.$name.'");'."\n";
        }
        $file = str_replace("!table", $map, $file);
        if (!file_exists($directory.date('Y-m-d-His')."_".ucfirst($names)."Migration.php")) {
            $fh = fopen($directory .date('Y-m-d-His')."_". ucfirst($names) . "Migration.php", "w");
            fwrite($fh, $file);
            fclose($fh);
            $className = ucfirst($names) . "Migration.php";
            $output->writeln("Created $className in migrations");
        } else {
            $output->writeln("Class migration already Exists!");
        }

    }
}
