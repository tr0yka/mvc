<?php

class BaseController{

    public $db;
    public $root;
    public $config;

    public function __construct($root){
        $this->root = $root;
    }

    public function run(){
        $dbClassPath = $this->root.'/app/core/components/db.php';
        $dbConfigPath = $this->root.'/app/core/config/dbconfig.php';
        $routerPath = $this->root.'/app/core/Router.php';
        $appconfigPath = $this->root.'/app/core/config/appconfig.php';

        if(file_exists($dbClassPath) && file_exists($dbConfigPath)){
            require_once $dbClassPath;
            $dbconfig = require_once $dbConfigPath;
            $this->db = new DB($dbconfig);
        }else{
            throw new Exception('Класс или настройки БД не найдены');
        }
        if(file_exists($routerPath)){
            require_once $routerPath;
            $router = new Router();
            $router->run();
        }else{
            throw new Exception('Файл роутинга не найден - '.$routerPath);
        }
        if(file_exists($appconfigPath)){
            $this->config = require_once $appconfigPath;
        }

    }

}