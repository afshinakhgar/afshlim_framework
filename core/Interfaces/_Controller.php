<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/10/17
 * Time: 3:13 PM
 */

namespace Core\Interfaces;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Blade;

abstract class _Controller
{
    protected $container;

    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __get($property)
    {
        if ($this->container->{$property}) {
            return $this->container->{$property};
        }
    }




    /**
     * Get Slim Container
     *
     * @return ContainerInterface
     */
    protected function getContainer()
    {
        return $this->container;
    }
    /**
     * Get Service From Container
     *
     * @param string $service
     * @return mixed
     */
    protected function getService($service)
    {
        return $this->container->{$service};
    }
    /**
     * Get Request
     *
     * @return Request
     */
    protected function getRequest()
    {
        return $this->container->request;
    }
    /**
     * Get Response
     *
     * @return Response
     */
    protected function getResponse()
    {
        return $this->container->response;
    }
    /**
     * Get Twig Engine
     *
     * @return Blade
     */
    protected function getView()
    {
        return $this->container->view;
    }
    /**
     * Render view
     *
     * @param string $template
     * @param array $data
     * @return string
     */
    protected function render($template, $data = [])
    {
        return $this->getView()->render($this->getResponse(), $template, $data);
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