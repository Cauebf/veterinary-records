<?php

class AnimalView
{
    public function RenderAnimalCard($animal)
    {
        $animalName = $animal->Name;
        $speciesName = $animal->Species->Name;
        $imagePath = "images/{$animalName}.png";

        // Check if the image file exists and use a placeholder image if it doesn't
        if (!file_exists($imagePath)) {
            $imagePath = "images/placeholder.png";
        }

        // Display the animal card with the image, name, and species
        echo "<div class='animalCard'>
                    <a href='service.php'>
                        <img src='{$imagePath}' alt='{$animalName}'>
                        <div>
                            <h1>{$animalName}</h1>
                            <p>{$speciesName}</p>
                        </div>
                    </a>
                </div>";
    }

    public function RenderAnimals()
    {
        $AnimalController = new AnimalController();
        $animals = $AnimalController->List(); // Get the list of animals from the controller

        // Loop through the animals in the list and display them
        for ($i = 0; $i < count($animals); $i++) {
            $this->RenderAnimalCard($animals[$i]);
        }
    }

    public function RenderAnimalsByName($name)
    {
        $AnimalController = new AnimalController();
        $animals = $AnimalController->SearchByName($name); // Get the list of animals by name from the controller

        if (count($animals) == 0) {
            echo "<p class='no-animals'>No animals found.</p>";
            return;
        }

        // Loop through the animals in the list and display them
        for ($i = 0; $i < count($animals); $i++) {
            $this->RenderAnimalCard($animals[$i]);
        }
    }
}
