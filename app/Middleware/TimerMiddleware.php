<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/24/17
 * Time: 12:43 PM
 */

namespace App\Middleware;


use Core\Interfaces\_Middleware;
use Monolog\Logger;
use Slim\Container;

class TimerMiddleware extends _Middleware
{
    /**
     * Timer middleware invokable class
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke($request, $response, $next) {
        $timePre = microtime(true);
        $response = $next($request, $response);
        $timePost = microtime(true);
        if($this->settings['app']['log_timer']){
            $this->logger->info("Render time:" . ($timePost - $timePre));
        }
        return $response;

    }
}