<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/19/17
 * Time: 5:24 PM
 */

namespace Core\Translator;

class Translator extends _TranslateHandler
{

    public function init()
    {
        $setting = $this->settings['translation'];
        $this->local = $setting['default_lang'];

    }


    private function _loadkey(string $key , array $replace = [])
    {
        list($namespace,$group) = explode('.',$key);
        $t_dir = $this->getTranslation_dirs();

        if(in_array($this->local,$t_dir)){

            $translationBaseFolder = $this->settings['translation']['translations_path'].$this->local;
            $translationBaseFile = $translationBaseFolder.'/'.$namespace.'.php';

            if(file_exists($translationBaseFolder)){
                $lang= include_once ($translationBaseFile);
            }else{

            }
        }else{

        }


        if(count($replace) > 0){
            foreach($replace as $key=>$replace_item){
                if(strpos($lang[$group],'%') != 0){
                    str_replace($key,$replace_item,$lang[$group]);
                }
            }
        }else{
            return $lang[$group];
        }
    }

    public function trans(string $key, array $replace = [])
    {
        return $this->_loadkey($key,$replace);
    }



    public function getTranslation_dirs()
    {
        $dir = scandir($this->settings['translation']['translations_path']);
        $ex_folders = array('..', '.');



        return array_diff($dir,$ex_folders);
    }

}