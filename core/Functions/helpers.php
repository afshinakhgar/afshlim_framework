<?php



function url(string $name ,array $params)
{
    $url = new \Core\Helpers\Url($GLOBALS['container']);
    return $url->get($name , $params);
}

url('admin.user.list',[]);