<?php

class Species
{
    public $Code;
    public $Name;

    public function __construct($code = null, $name = null)
    {
        // If code and name are provided, set them, otherwise set them to null
        $this->Code = $code;
        $this->Name = $name;
    }
}
