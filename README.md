# AfshlimFramework
a Slim framework boilerplate in my Way

- [PSR-7](http://www.php-fig.org/psr/psr-7/ "PHP Framework Interop Group")
- [PSR-4](http://www.php-fig.org/psr/psr-4/ "PHP Framework Interop Group")
- PHP 7.0
- Namespaced


<br><br>
+ Helpers
+ Services
+ Blade Views
+ Flash Messages
+ Symfony VarDumper
+ Logging with Monolog
+ Environment variables with Dotenv
+ Translation And Localizations
+ Core Interfaces
+ MVC Pattern
+ Command Line Tool For Better and Easy Developing
+ Database Migration With PhpMig
+ Violin Validation

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






