<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 12/22/17
 * Time: 1:41 PM
 */

namespace Core\Services;


class Image
{
	/**
     * Instance of the Imagine package
     * @var Imagine\Gd\Imagine
     */
    protected $imagine;
 
    /**
     * Type of library used by the service
     * @var string
     */
    protected $library;

     /**
     * black list for pasting watermark on an specefic image size 
     * @var array
     */
    protected $balackListWatermark = array('m','thumb');
 
    /**
     * Initialize the image service
     * @return void
     */
    public function __construct()
    {
        if ( ! $this->imagine)
        {
            $this->library = Config::get('image.library', 'gd');

            // Now create the instance
            if     ($this->library == 'imagick') $this->imagine = new \Imagine\Imagick\Imagine();
            elseif ($this->library == 'gmagick') $this->imagine = new \Imagine\Gmagick\Imagine();
            elseif ($this->library == 'gd')      $this->imagine = new \Imagine\Gd\Imagine();
            else                                 $this->imagine = new \Imagine\Gd\Imagine();
        }
    }

}