<?php

function getDirFiles($path)
{
    $dir = scandir($path);
    $ex_folders = array('..', '.');

    return array_diff($dir,$ex_folders);
}
