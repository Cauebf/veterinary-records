<?php

class AnimalView
{

    public function RenderAnimals()
    {
        $AnimalController = new AnimalController();
        $animals = $AnimalController->List();

        for ($i = 0; $i < count($animals); $i++) {
            $animalName = $animals[$i]->Name;
            $speciesName = $animals[$i]->Species->Name;
            $imagePath = "images/{$animalName}.png";

            if (!file_exists($imagePath)) {
                $imagePath = "images/placeholder.png";
            }

            echo "<div class='animalCard'>
                    <a href='treatment.php'>
                        <img src='{$imagePath}' alt='{$animalName}'>
                        <div>
                            <h1>{$animalName}</h1>
                            <p>{$speciesName}</p>
                        </div>
                    </a>
                </div>";
        }
    }
}
