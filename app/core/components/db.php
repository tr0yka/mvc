<?php

class DB{

    public function __construct($config){
        $db = new PDO("mysql:host={$config['host']};dbname={$config['db']}", $config['user'], $config['password']);
        return $db;
    }
}