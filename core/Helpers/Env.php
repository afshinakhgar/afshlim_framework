<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/11/17
 * Time: 2:57 PM
 */

namespace Core\Helpers;
use Dotenv\Dotenv;

class Env
{
    public function __invoke($filePath ,$key, $default = null)
    {
        if (file_exists($filePath . '.env')) {
            $_dotenv = new Dotenv($filePath );
            $_dotenv->load();
            unset($_dotenv);
        }else {
            return '';
        }
        $value = getenv($key);

        if ($value === false) {
            return $default;
        }
        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return null;
        }
        $strLen = strlen($value);

        if ($strLen > 1 && $value[0] === '"' && $value[$strLen - 1] === '"') {
            return substr($value, 1, -1);
        }
        return $value;
    }
}