<?php
namespace App\DataBase;

class DB{

    private $db;

    public function __construct($config){

        try{
            $connection = new \PDO("mysql:host=127.0.0.1;dbname=file_uploads",'root','');
            $this->db = $connection;
        }catch(\PDOException $e){

            echo $e->getMessage();
            exit;
        }

    }

    public function fetchAll(){
        $sql = "SELECT * FROM {$this->_table}";
        $pd = $this->db->prepare($sql);
        $pd->execute();
        $records = array();
        $res = $pd->fetchAll();
        foreach($res as $info){
            $tmp = new $this($this->db);
            $this->setOptions($info);
            $records[] = $tmp;
        }
        //print_r($records);
        return $records;
    }

    public function setOptions($options){
        $methods = get_class_methods($this);

        foreach ($options as $key => $value){
            $method = 'set'.ucfirst($key);
            if(in_array($method,$methods)){
                $this->$method($value);
            }
        }
    }
}