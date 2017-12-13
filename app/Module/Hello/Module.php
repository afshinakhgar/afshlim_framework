<?php
namespace App\Module\Hello;


use Core\App;
use Core\Interfaces\AbstractModule;

class Module extends AbstractModule
{
    public function initRoutes(App $app)
    {
        $app->get('/hello/{name}', function ($request, $response) {
            return $this->view->render($response, '.index');
        })->setName('module.hello');
    }
}