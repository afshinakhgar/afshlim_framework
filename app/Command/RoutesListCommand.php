<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/27/17
 * Time: 12:16 PM
 */

namespace App\Command;

use Slim\App;
use Slim\Router;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RoutesListCommand extends Command
{
    private $app ;
    public function __construct($name = null ,App $app)
    {
        $this->app = $app;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setName('route:list')
            ->setDescription('get list of routes')
            ->addArgument(
                'path',
                InputArgument::OPTIONAL,
                'path of test'
            )
        ;
    }



    public function execute(InputInterface $input , OutputInterface $output)
    {

// And then iterate over $routes
        $routes = $this->app->getContainer()->getRoutes();
        dd($routes);
        foreach ($routes as $route) {
            echo $route->getPattern(), "<br>";
        }
    }
}