<?php

class Treatment
{
    public $Code;
    public $Name;
    public $Description;

    public function __construct($code = null, $name = null, $description = null)
    {
        // If code, name and description are provided, set them, otherwise set them to null
        $this->Code = $code;
        $this->Name = $name;
        $this->Description = $description;
    }
}
