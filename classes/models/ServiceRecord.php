<?php

class ServiceRecord
{
    public $date;
    public $observation;
    public $treatment;
    public $animal;

    public function __construct($date = null, $observation = null, ?Treatment $treatment = null, ?Animal $animal = null,)
    {
        $this->date = $date;
        $this->observation = $observation;

        // If treatment is provided, set it, otherwise set an empty Treatment instance
        if ($treatment !== null) {
            $this->treatment = $treatment;
        } else {
            $this->treatment = new Treatment();
        }

        // If animal is provided, set it, otherwise set an empty Animal instance
        if ($animal !== null) {
            $this->animal = $animal;
        } else {
            $this->animal = new Animal();
        }
    }
}
