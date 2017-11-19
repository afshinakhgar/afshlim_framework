<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/19/17
 * Time: 5:24 PM
 */

namespace Core;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;

class TranslationHandler
{
    protected $container ;
    protected $translator ;


    function __construct($container)
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


    public function init()
    {
        $settings = $this->container['settings']['translation'];
        $loader = new FileLoader(new Filesystem(), $settings['translations_path']);
        // Register the Persian translator (set to "en" for English)
        $this->translator = new Translator($loader, $settings['default_lang']);
        return $this->translator;
    }

}