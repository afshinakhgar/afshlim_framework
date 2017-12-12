<?php
namespace App\Module\Hello;

use MartynBiz\Slim3Module\AbstractModule;

class Module extends AbstractModule
{
    public function initRoutes(\Slim\App $app)
    {
        $app->get('/hello/{name}', function ($request, $response) {
            return $this->view->render($response, 'index');
        });
    }
}