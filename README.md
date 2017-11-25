[![Build Status](https://travis-ci.org/afshinpersian/afshlim_framework.svg?branch=master)](https://travis-ci.org/afshinpersian/afshlim_framework)

# AfshlimFramework
a Slim framework boilerplate in my Way
- [PSR-7](http://www.php-fig.org/psr/psr-7/ "PHP Framework Interop Group")
- [PSR-4](http://www.php-fig.org/psr/psr-4/ "PHP Framework Interop Group")
- PHP 7.0
- Namespaced

<br><br>

* Helpers
* Services
* Symfony VarDumper
* Environment variables with Dotenv
* Translation And Localizations
* Core Interfaces
* MVC Pattern
* DataAccess Repository Pattern
* Command Line Tool For Better and Easy Developing 
* [Facade Pattern slim-facades](https://github.com/zhshize/slim-facades)
* [Logging with Monolog](https://github.com/Seldaek/monolog)
* [Blade View](https://github.com/rubellum/Slim-Blade-View)
* [slim/csrf](https://github.com/slimphp/Slim-Csrf)
* [slim/Flash](https://github.com/slimphp/Slim-Flash)
* [symfony command](https://github.com/symfony/console/blob/master/Command/Command.php)
* [Database Migration With PhpMig](https://github.com/davedevelopment/phpmig)

## How to install
Run this command from the directory in which you want to install
```bash
    composer create-project afshinpersian/afshlim_framework
```

create mysql database

copy .env_example file

```bash
    cp .env_example .env
```
run migration with this command
```bash
    php afsh migrate
```
it's done

## CLI Tools
* Currently there are some supported commands:
* `php afsh make:controller MyControllerClassName`
* `php afsh make:middleware MyMiddlewareClassName`
* `php afsh make:model MyModelClassName`
* `php afsh make:migration MymigrationClassName`
* `php afsh list` // list of commnads
* `php afsh migrate` // run migrations
* `php afsh migrate:rollback`// rollback migrations
* `php afsh migration:status` // checking status of migrations


