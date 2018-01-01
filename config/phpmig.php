<?php

date_default_timezone_set("Asia/Tehran");
require_once 'vendor/autoload.php';
use Phpmig\Adapter;
use Illuminate\Database\Capsule\Manager as Capsule;
$env = new \Core\Helpers\Env();
$config = include 'databases.php';
$capsule   = new Capsule;
$capsule->addConnection($config['databases']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();
$container = new ArrayObject();
$container['phpmig.adapter'] = new Adapter\Illuminate\Database($capsule, 'migrations');
$container['phpmig.migrations_path'] =  'database/migrations';
$container['phpmig.migrations_template_path'] = 'core/resources/templates/create_migration.txt';
return $container;