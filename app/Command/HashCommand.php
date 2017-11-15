<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/13/17
 * Time: 3:30 PM
 */

namespace App\Command;

use Core\Interfaces\_Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

use Core\Helpers\Hash;

class HashCommand extends _Command {

    protected function configure(){
        $this->setName("hash")
            ->setDescription("Hashes a given string using Bcrypt.")
            ->addArgument('Password', InputArgument::REQUIRED, 'What do you wish to hash)');
    }

    protected function execute(InputInterface $input, OutputInterface $output){
        $hash = new Hash();
        $input = $input->getArgument('Password');
        $result = $hash->hash($input);
        $output->writeln('Your password hashed: ' . $result);
    }

}