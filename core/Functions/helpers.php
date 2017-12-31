<?php



function route(string $name ,array $params = [])
{
    $url = new \Core\Helpers\Url($GLOBALS['container']);
    return $url->get($name , $params);
}

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

    $url_asset = $url->getBasePath($request) .'/'. $uri;
    return $url_asset;
}

function asset(string $uri = '') {
    $url = public_path();
    $url_asset = $url.'assets/'.$uri;
    return $url_asset;
}

function get_gravatar( $email, $s = 380, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}