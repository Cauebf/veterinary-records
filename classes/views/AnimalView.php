<?php

class AnimalView
{
    public function renderAnimalCard($animal)
    {
        $animalId = $animal->id;
        $animalName = $animal->name;
        $speciesName = $animal->species->name;
        $imagePath = "images/{$animalName}.png";

        // Check if the image file exists and use a placeholder image if it doesn't
        if (!file_exists($imagePath)) {
            $imagePath = "images/placeholder.png";
        }

        // Display the animal card with the image, name, and species
        echo "<div class='animalCard'>
                    <a href='service.php?id={$animalId}'>
                        <img src='{$imagePath}' alt='{$animalName}'>
                        <div>
                            <h1>{$animalName}</h1>
                            <p>{$speciesName}</p>
                        </div>
                    </a>
                </div>";
    }

    public function renderAnimals()
    {
        $AnimalController = new AnimalController();
        $animals = $AnimalController->list(); // Get the list of animals from the controller

        // Loop through the animals in the list and display them
        for ($i = 0; $i < count($animals); $i++) {
            $this->renderAnimalCard($animals[$i]);
        }
    }

    public function renderAnimalsByName($name)
    {
        $AnimalController = new AnimalController();
        $animals = $AnimalController->search($name); // Get the list of animals by name from the controller

        if (count($animals) == 0) {
            echo "<p class='no-animals'>No animals found.</p>";
            return;
        }

        // Loop through the animals in the list and display them
        for ($i = 0; $i < count($animals); $i++) {
            $this->renderAnimalCard($animals[$i]);
        }
    }
}
