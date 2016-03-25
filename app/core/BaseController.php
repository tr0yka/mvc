<?php
namespace App\Controller;

use App\DataBase\DB;
use App\Router\Router;
use App\Models;

class BaseController{

    public $db;
    public $root;
    public $config;
    //public $model;

    public function __construct($root){
        $this->root = $root;
    }

    public function run(){
        $dbClassPath = $this->root.'/app/core/db.php';
        $dbConfigPath = $this->root.'/app/core/config/dbconfig.php';
        $routerPath = $this->root.'/app/core/Router.php';
        $appconfigPath = $this->root.'/app/core/config/appconfig.php';
        $routesPath = $this->root.'/app/core/config/routes.php';

        if(file_exists($dbClassPath) || file_exists($dbConfigPath)){
            require_once $dbClassPath;
            $dbconfig = require_once $dbConfigPath;
            $this->db = new DB($dbconfig);
        }else{
            throw new Exception('Класс или настройки БД не найдены');
        }
        if(file_exists($routerPath) || file_exists($routesPath)){
            require_once $routerPath;
            $routes  = require_once $routesPath;
            $router = new Router($routes,$this->root);
            $router->run();
        }else{
            throw new Exception('Файл роутинга не найден - '.$routerPath);
        }
        if(file_exists($appconfigPath)){
            $this->config = require_once $appconfigPath;
        }else{
            throw new Exception('Файл конфигурации не найден');
        }

    }

    public function getModel($name){
        $modelPath = $this->root.'/app/models/'.$name.'.php';
        if(file_exists($modelPath)){
            require_once $modelPath;
            $model = "\\App\\Models\\$name";
            return new $model($this->config);
        }else{
            throw new \Exception('Файл модели '.$name.' не нйден');
        }
    }


}