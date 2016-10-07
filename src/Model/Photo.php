<?php

namespace Model;

class Photo
{
    private $id;
    private $fileName;

    public function __construct()
    {
        # code...
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFileName()
    {
        return $this->fileName;
    }
}
