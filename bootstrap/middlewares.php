<?php
$app->add(new RunTracy\Middlewares\TracyMiddleware($app));
$appMiddleWare = new \App\Middleware\AppMiddleware();
$app->add($appMiddleWare);
