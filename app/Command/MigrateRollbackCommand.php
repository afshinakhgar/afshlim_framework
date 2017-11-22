<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/13/17
 * Time: 3:45 PM
 */

namespace App\Command;
use Core\Interfaces\_MigrateCommand;
use Phpmig\Console\Command\RollbackCommand;
use Symfony\Component\Console\Command\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;


class MigrateRollbackCommand extends RollbackCommand
{
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('migrate:rollback')
            ->setDescription('Migration Down Execution')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        parent::execute( $input,  $output);
    }

}
