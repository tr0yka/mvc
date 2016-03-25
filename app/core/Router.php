<?php
namespace App\Router;

use App\Controller;

class Router{

    private $routes;
    private $root;

    public function __construct($routes,$root){
        $this->routes = $routes;
        $this->root = $root;
    }

    private function getURL(){
        $uri = $_SERVER['REQUEST_URI'];
        if(!empty($uri)){
            $uri = trim($uri,'/');
        }
        return $uri;
    }

    public function run(){
        $uri = $this->getURL();
        $class = '';
        $method = '';
        foreach ($this->routes as $pattern => $path) {
            if(preg_match("~$pattern~",$uri)){
                $segments = explode('/',$path);
                $controllerName = ucfirst(array_shift($segments)).'Controller';
                $actionName = array_shift($segments).'Action';
                //echo $controllerName;
                if(file_exists($this->root.'/app/controllers/'.$controllerName.'.php')){
                  include_once $this->root.'/app/controllers/'.$controllerName.'.php';
                }else{
                    throw new \Exception('Отсутствует файл контроллера');
                }
                $class = "\\App\\Controller\\$controllerName";
                $controller = new $class($this->root);
                $res = $controller->$actionName();
                if($res != null){
                    break;
                }

            }
        }

    }

}