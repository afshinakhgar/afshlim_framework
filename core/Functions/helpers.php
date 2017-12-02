<?php



function url(string $name ,array $params = [])
{
    $url = new \Core\Helpers\Url($GLOBALS['container']);
    return $url->get($name , $params);
}

// translate
function trans($key , $replace = []){
    $container = $GLOBALS['container'];
    return $container->translator->trans($key,$replace);
}

function public_path(string $uri = '') {
    $container = $GLOBALS['container'];
    $settings = $container->settings;
    $request = $container->request;

    $url = new \Core\Helpers\Url($container);

    $url_asset = $url->getBaseRoutePath($request) .'/'. $uri;
    return $url_asset;
}

function asset(string $uri = '') {
    $url = public_path();
    $url_asset = $url.'assets/'.$uri;
    return $url_asset;
}

