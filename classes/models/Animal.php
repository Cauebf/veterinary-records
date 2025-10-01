<?php

class Animal
{
    public $id;
    public $name;
    public $species;

    public function __construct($id = null, $name = null, ?Species $species = null)
    {
        // If id and name are provided, set them, otherwise set them to null
        $this->id = $id;
        $this->name = $name;
        // If species is provided, set it, otherwise set an empty Species instance
        if ($species !== null) {
            $this->species = $species;
        } else {
            $this->species = new Species();
        }
    }
}
