<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/10/17
 * Time: 3:13 PM
 */

namespace Core\Interfaces;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class _Controller
{
    protected $container;

    function __construct($container)
    {
        $this->container = $container;
    }

    public function __get($property)
    {
        if ($this->container->{$property}) {
            return $this->container->{$property};
        }
    }

    public function _getBasePath(Request $request)
    {
        $protocol = $request->getUri()->getScheme();
        $baseHost = $request->getUri()->getHost();
        $port = $request->getUri()->getPort() ? ':' . $request->getUri()->getPort() : '';
        $baseUrl = $protocol . '://' . $baseHost . $port;
        return $baseUrl;
    }

    public function _getBaseRoutePath(Request $request)
    {
        $protocol = $request->getUri()->getScheme();
        $baseHost = $request->getUri()->getHost();
        $path = $request->getUri()->getPath();
        $pathArr = explode('/',$path);
        unset($pathArr[count($pathArr)-1]);
        $path = implode('/',$pathArr);
        $port = $request->getUri()->getPort() ? ':' . $request->getUri()->getPort() : '';
        $baseUrl = $protocol . '://' . $baseHost . $port . $path;
        return $baseUrl;
    }


}