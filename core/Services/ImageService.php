<?php
namespace Core\Services;

use Gregwar\Image\Image as GImage;
use Core\Interfaces\_Service;

class ImageService extends _Service
{

    public function cropResize($src,$destUrl, $width, $height, $quality = 80,$fileExt  = 'jpg')
    {
        $image = GImage::open($src);
        $image->cropResize($width, $height);
        $destUrl = $destUrl.'.'.$fileExt;
        $image->save($destUrl, $fileExt = 'jpg', $quality );


        return $image;
    }

    public function scaleResize($src,$destUrl, $width, $height, $quality = 80,$fileExt  = 'jpg')
    {
        $image = GImage::open($src);
        $image->scaleResize($width, $height);
        $destUrl = $destUrl.'.'.$fileExt;
        $image->save($destUrl, $fileExt = 'jpg', $quality );


        return $image;
    }

    public function resize($src,$destUrl, $width, $height, $quality = 80,$fileExt  = 'jpg')
    {
        $image = GImage::open($src);
        $image->resize($width, $height);
        $destUrl = $destUrl.'.'.$fileExt;
        $image->save($destUrl, $fileExt = 'jpg', $quality );


        return $image;
    }

    public function zoomCrop($src,$destUrl, $width, $height, $quality = 80,$fileExt  = 'jpg')
    {


        $image = GImage::open($src);
        $image->zoomCrop($width, $height);
        $destUrl = $destUrl.'.'.$fileExt;
        $image->save($destUrl, $fileExt = 'jpg', $quality );
        return $image;
    }

    public function createPhotos($src,$photoid,$type='user_photo', $dimensions = false)
    {

        // Get default dimensions
        $dest = realpath('.'.$GLOBALS['settings']['image']['upload_path']);
        $defaultDimensions = $dimensions ? $dimensions : $GLOBALS['settings']['image'][$type]['dimensions'];
        foreach ($defaultDimensions as $keys=>$dimension)
        {
            if(!isset($dimension[2])) $dimension[2] = 100; // quality
            if(!isset($dimension[4])) $dimension[4] = 'jpg'; // quality

            $destUrl = $dest.'/'.getImageDirName($photoid,$type).getImageFileName($photoid,$keys,$type);
            if(isset($dimension[3]) && $dimension[3] == true){
                $image = $this->zoomCrop($src,trim($destUrl),$dimension[0], $dimension[1], $dimension[2],$dimension[4]);
            }else {
                $image = $this->cropResize($src,trim($destUrl),$dimension[0], $dimension[1], $dimension[2],$dimension[4]);
            }
            // $image = $this->cropResize($src,trim($destUrl),$dimension[0], $dimension[1], $dimension[2],$dimension[4]);

            if($image ){
                $cropedArr[$keys] = $src;
            }
        }
    }



}