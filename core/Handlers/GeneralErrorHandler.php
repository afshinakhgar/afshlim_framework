<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/20/17
 * Time: 6:55 PM
 */

namespace Core\Handlers;


use Core\Interfaces\_ErrorHandler;

class GeneralErrorHandler extends _ErrorHandler
{
    public function __invoke($request, $response, $exception) {
        return $response
            ->withStatus(500)
            ->withHeader('Content-Type', 'text/html')
            ->write('Something went wrong!');
    }
}

