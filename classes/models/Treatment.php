<?php

class Treatment
{
    public $id;
    public $name;
    public $description;

    public function __construct($id = null, $name = null, $description = null)
    {
        // If id, name and description are provided, set them, otherwise set them to null
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }
}
