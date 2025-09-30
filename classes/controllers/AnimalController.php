<?php

class AnimalController
{
    public function List()
    {
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $dbname = "veterinary_record";
        $animals = [];

        try {
            $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exceptions

            $stmt = $pdo->prepare("
                SELECT 
                    a.id_animal, 
                    a.name_animal,
                    s.id_species, 
                    s.name_species
                FROM animal a
                JOIN species s ON a.id_species = s.id_species
            ");
            $stmt->execute();

            // Fetch the results and loop through them to create Animal instances
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $specieCode = $row['id_species'];
                $specieName = $row['name_species'];

                $species = new Species($specieCode, $specieName); // Create a Species instance

                $animalCode = $row['id_animal'];
                $animalName = $row['name_animal'];

                $animal = new Animal($animalCode, $animalName, $species); // Create an Animal instance
                array_push($animals, $animal); // Add the Animal instance to the list
            }
            $pdo = null; // Close the database connection
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return $animals;
    }

    public function SearchByName($name)
    {
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $dbname = "veterinary_record";
        $animals = [];

        try {
            $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exceptions

            $stmt = $pdo->prepare("
                SELECT 
                    a.id_animal, 
                    a.name_animal,
                    s.id_species, 
                    s.name_species
                FROM animal a
                JOIN species s ON a.id_species = s.id_species
                WHERE a.name_animal LIKE :name
            ");
            $stmt->bindParam(':name', $name);
            $stmt->execute();

            // Fetch the results and loop through them to create Animal instances
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $specieCode = $row['id_species'];
                $specieName = $row['name_species'];

                $species = new Species($specieCode, $specieName); // Create a Species instance

                $animalCode = $row['id_animal'];
                $animalName = $row['name_animal'];

                $animal = new Animal($animalCode, $animalName, $species); // Create an Animal instance
                array_push($animals, $animal); // Add the Animal instance to the list
            }
            $pdo = null; // Close the database connection
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return $animals;
    }
}
