<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/10/17
 * Time: 3:24 PM
 */
namespace App\Controller;

use Core\Interfaces\_Controller;
use Respect\Validation\Validator as v;
use Slim\Http\Request;
use Slim\Http\Response;

class Controller extends _Controller
{
//    protected $classMethods = [];
//    protected $calledClassName = '';
//    protected $currentFullClassName = '';
//    public function __invoke(Request $request,Response $response)
//    {
//        $this->calledClassName = get_called_class();
//        $classMethodsArr = get_class_methods($this->calledClassName);
//
//        $this->routeParser($classMethodsArr);
//
//        $this->currentFullClassName =  get_class($this);
//
//
//        $this->routeActionParser();
//    }
//
//
//    public function routeParser(array $classMethodsArr)
//    {
//        foreach($classMethodsArr as $route){
//            $realRoute = $route;
//            if(strpos($route,'_Action') !== false){
//                list($method,$route)=explode('_',$route);
//                $this->classMethods[$this->calledClassName][$route][$method] = $realRoute;
//            }
//        }
//    }

//
//    public function routeActionParser()
//    {
//        foreach($this->classMethods[$this->calledClassName] as $route=>$methodArr){
//            $methodsNewArr = [];
//            $routePath = '';
//            foreach($methodArr as $method=>$realRoute){
//                $methodsNewArr[] = $method;
//                $routePath = $realRoute;
//            }
//
//
//            $class = $this->currentFullClassName ;
//            $classArr = explode('\\',$class);
//
//            unset($classArr[count($classArr)-1]);
//
//            $methods = '';
//            $routeAddr = str_replace('\\','/',strtolower(str_replace('Controller','',$this->calledClassName)));
//            $routeAddr = str_replace('//','/',$routeAddr);
//            $routeAddr = str_replace('app/','',$routeAddr);
//            if(count($methodsNewArr) > 0){
//                $methods[''.$routeAddr.'/'. $this->currentFullClassName.':'.$routePath] = $methodsNewArr;
////                $this->map($methodsNewArr, ''.$routeAddr.'/', $this->currentFullClassName.':'.$routePath);
//            }
//        }
//
//        dd($methods);

//    }

}