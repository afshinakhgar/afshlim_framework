<?php



function url(string $name ,array $params)
{
    $url = new \Core\Helpers\Url($GLOBALS['container']);
    return $url->get($name , $params);
}

// translate


function trans($key , $replace = []){
    $container = $GLOBALS['container'];
    return $container->translator->trans($key,$replace);
}