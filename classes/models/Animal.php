<?php

class Animal
{
    public $Code;
    public $Name;
    public $Species;

    public function __construct($code = null, $name = null, ?Species $species = null)
    {
        // If code and name are provided, set them, otherwise set them to null
        $this->Code = $code;
        $this->Name = $name;
        // If species is provided, set it, otherwise set an empty Species instance
        if ($species !== null) {
            $this->Species = $species;
        } else {
            $this->Species = new Species();
        }
    }
}
