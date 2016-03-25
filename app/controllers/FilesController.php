<?php
namespace App\Controller;

use App\Models\Files;
use App\DataBase\DB;

class FilesController extends BaseController{

    public function listAction(){
        $file = $this->getModel('Files');
        $rec =$file->fetchAll();
        //print_r($rec);
        foreach($rec as $r){
            print_r($r->getId());
        }
    }

}