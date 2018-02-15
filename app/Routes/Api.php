<?php
$route->get('/api/v1/test', \App\Controller\Api\V1\Test\TestController::class.':index')->setName('api_test');
