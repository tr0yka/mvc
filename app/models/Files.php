<?php
namespace App\Models;
use App\DataBase\DB;

class Files extends DB{

    public $_table = 'files_info';

    private $id;
    private $fileName;
    private $originalName;
    private $fileType;
    private $fileSize;
    private $comment;
    private $description;
    private $added;

    public function __construct($config)
    {
        parent::__construct($config);
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    public function getOriginalName()
    {
        return $this->originalName;
    }

    public function setOriginalName($originalName)
    {
        $this->originalName = $originalName;
    }

    public function getFileType()
    {
        return $this->fileType;
    }

    public function setFileType($fileType)
    {
        $this->fileType = $fileType;
    }

    public function getFileSize()
    {
        return $this->fileSize;
    }

    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function getDecription()
    {
        return $this->decription;
    }

    public function setDecription($decription)
    {
        $this->decription = $decription;
    }

    public function getAdded()
    {
        return $this->added;
    }

    public function setAdded($added)
    {
        $this->added = $added;
    }



}