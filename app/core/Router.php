<?php

class Router{

    private $routes;

    public function __construct($routes){
        $this->routes = $routes;
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
        foreach ($this->routes as $url => $path) {
            if(preg_match("/\{[a-zA-z]+\}/",$url)){
                $url = preg_replace("/\/\{[a-zA-z]+\}/",'',$url);
                echo $url.'<br>';
            }elseif(preg_match("~$url~",$uri)){
                echo $url;
            }
        }

    }

}