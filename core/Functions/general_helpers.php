<?php

function getDirFiles($path)
{
    $dir = scandir($path);
    $ex_folders = array('..', '.');

    return array_diff($dir,$ex_folders);
}


/*folder*/
function getImageDirName($photoid, $type = 'user_photo' ,$collectionNum =1000)
{
    $folderName = null;
    switch ($type) {
        case 'user_photo':
            $folderName = (int) ($photoid / $collectionNum);
            $folderName++;
            $dir = 'user_photo/'.$folderName.'/';
            break;
    }

    if ($folderName) {
        $folderName = $dir;
    }else{
        $folderName = (int) ($photoid / $collectionNum);
        $folderName++;
        $folderName = $type.'/'.$folderName.'/';
    }

    return $folderName;
}

function getImageFileName($photoid,$fileType='l',$type='user_photo')
{
    $fileName = null;

    switch ($type) {
        case 'user_photo':
            $fileName = 'user'.(int)$photoid.'-'.$fileType;
        break;
        case 'category_photo':
            $fileName = 'category'.(int)$photoid.'-'.$fileType;
        break;
    }


    return $fileName;
}

