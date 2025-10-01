<?php

class AnimalController
{
    private $pdo;

    // When creating AnimalController, get the PDO connection from Database singleton
    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function list()
    {
        $animals = [];

        try {
            $stmt = $this->pdo->prepare("
                SELECT 
                    a.id_animal, 
                    a.name_animal,
                    s.id_species, 
                    s.name_species
                FROM animal a
                JOIN species s ON a.id_species = s.id_species
            ");
            $stmt->execute();

            // Fetch each row as associative array and loop through them
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $species = new Species($row['id_species'], $row['name_species']); // Create a Species instance
                $animal = new Animal($row['id_animal'], $row['name_animal'], $species); // Create an Animal instance

                array_push($animals, $animal); // Add the Animal instance to the $animals list
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return $animals;
    }

    public function search($name)
    {
        $animals = [];

        try {
            // Prepare the SQL with LIKE clause to search by name
            $stmt = $this->pdo->prepare("
                SELECT 
                    a.id_animal, 
                    a.name_animal,
                    s.id_species, 
                    s.name_species
                FROM animal a
                JOIN species s ON a.id_species = s.id_species
                WHERE a.name_animal LIKE :name
            ");
            $likeName = '%' . $name . '%'; // Add wildcard characters to the name
            $stmt->bindParam(':name', $likeName); // Bind the parameter to prevent SQL injection
            $stmt->execute();

            // Fetch each matching animal and create objects
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $species = new Species($row['id_species'], $row['name_species']); // Create a Species instance
                $animal = new Animal($row['id_animal'], $row['name_animal'], $species); // Create an Animal instance

                array_push($animals, $animal); // Add the Animal instance to the list
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return $animals;
    }
}
