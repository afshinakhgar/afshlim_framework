<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/11/17
 * Time: 1:50 PM
 */

namespace Core;

use Psr\Http\Message\ResponseInterface;
use Slim\Views\PhpRenderer as  rend;

class phpRenderer extends rend
{
    protected $layout;

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function render(ResponseInterface $response, $template, array $data = [])
    {
        if ($this->layout){
            $viewOutput = $this->fetch($template, $data);
            $layoutOutput = $this->fetch($this->layout, array('content' => $viewOutput));
            $response->getBody()->write($layoutOutput);
        } else {
            $output = parent::render($response, $template, $data);
            $response->getBody()->write($output);
        }
        return $response;
    }
}
