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

            $stmt = $pdo->prepare("SELECT id_animal, name_animal, id_species FROM animal");
            $stmt->execute();

            // Fetch the results and loop through them to create Animal instances
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $code = $row['id_animal'];
                $name = $row['name_animal'];

                $animal = new Animal($code, $name);
                array_push($animals, $animal); // Add the Animal instance to the list
            }
            $pdo = null; // Close the database connection
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return $animals;
    }
}
