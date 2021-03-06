<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/13/17
 * Time: 3:45 PM
 */

namespace App\Command;
use Phpmig\Console\Command\StatusCommand;
use Symfony\Component\Console\Command\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;


class MigrationStatusCommand extends StatusCommand
{
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('migration:status')
            ->setDescription('Migration Status')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        parent::execute( $input,  $output);
    }

}
