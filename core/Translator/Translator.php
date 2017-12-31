<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/19/17
 * Time: 5:24 PM
 */

namespace Core\Translator;

use Interop\Container\ContainerInterface;

class Translator extends _TranslateHandler
{
    /**
     * @var ContainerInterface $setting
     *
    */
    public function init()
    {
        $setting = $this->settings['app']['translation'];
        $this->local = $setting['default_lang'];

    }

    private function _loadkey(string $key , array $replace = [])
    {
        list($namespace,$group) = explode('.',$key);
        $t_dir = $this->getTranslation_dirs();

        if(in_array($this->local,$t_dir)){
            $translationBaseFolder = $this->settings['app']['translation']['translations_path'].$this->local;
            $translationBaseFile = $translationBaseFolder.'/'.$namespace.'.php';
            if(file_exists($translationBaseFile)){
                $lang = include ($translationBaseFile);
            }else{
                return  $key;
            }
        }else{
        }
        $keyArr = explode('.',$key);
        unset($keyArr[0]);
        $keyArr = array_values($keyArr);
        $lang_new = $this->getDataFromTranslation($lang,$keyArr);

        if(count($replace) > 0){
            foreach($replace as $key=>$replace_item){
                if(strpos($lang_new,'%') != 0){
                    str_replace($key,$replace_item,$lang_new);
                }
            }
        }else{
            return $lang_new;
        }
    }


    public function getDataFromTranslation( $data, $keyArr){
        $arrayFound  = isset($data[$keyArr[0]]) ? $data[$keyArr[0]] : '';
        if($arrayFound){
            unset($keyArr[0]);
            $keyArr = array_values($keyArr);
            if(isset($keyArr[0])){
                return $this->getDataFromTranslation($arrayFound,$keyArr);
            }
        }
        return $arrayFound ;
    }





    public function trans(string $key, array $replace = [])
    {
        return $this->_loadkey($key,$replace);
    }



    public function getTranslation_dirs()
    {
        $dir = scandir($this->settings['app']['translation']['translations_path']);
        $ex_folders = array('..', '.');



        return array_diff($dir,$ex_folders);
    }

}