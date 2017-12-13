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
use Symfony\Component\Console\Helper\Table;
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
        $allRoutes = [];

// And then iterate over $routes
        $routes = $this->app->getContainer()->get('router')->getRoutes();
        foreach ($routes as $route){
            foreach($route->getMethods() as $methods){

                if(!is_callable($route->getCallable()) ){
                    $allRoutes['routes']['list'][] = [
                        'pattern' => $route->getPattern(),
                        'callable' => $route->getCallable(),
                        'name' => $route->getName(),
                        'method' => $methods,
                    ];
                }else{
                    $allRoutes['routes']['modules'][] = [
                        'pattern' => $route->getPattern(),
                        'callable' => '__CLASS__',
                        'name' => $route->getName(),
                        'method' => $methods,
                    ];
                }

            }

        }



        $table = new Table($output);
        $table
            ->setHeaders(array('patern','callable', 'name','methods'))
            ->setRows(
               $allRoutes['routes']['list']
            )
        ;
        $table->render();

        echo '+ Module Routes'."\n";

        $table = new Table($output);

        $table
            ->setHeaders(array('patern','callable', 'name','methods'))
            ->setRows(
                $allRoutes['routes']['modules']
            )
        ;


        $table->render();

    }
}