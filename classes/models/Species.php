<?php

class Species
{
    public $id;
    public $name;

    public function __construct($id = null, $name = null)
    {
        // If id and name are provided, set them, otherwise set them to null
        $this->id = $id;
        $this->name = $name;
    }
}
