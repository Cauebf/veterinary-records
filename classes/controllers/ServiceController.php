<?php

class ServiceController
{
    private $pdo;
    private $animalId;

    // When creating ServiceController, get the PDO connection from Database singleton and check if id is provided in URL
    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();

        // If id is not provided in URL, throw an exception
        if (!isset($_GET['id'])) {
            throw new Exception("Animal ID not provided.");
        }

        $this->animalId = $_GET['id']; // Get id from URL
    }

    public function getAnimal()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT id_animal, name_animal FROM animal WHERE id_animal = :id");
            $stmt->bindParam(':id', $this->animalId, PDO::PARAM_INT); // Bind the parameter to prevent SQL injection
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the first row as an associative array
            // If no row is returned, return null
            if (!$row) {
                return null;
            }
            // Return the id and name of the animal as an associative array
            return [
                'id' => $row['id_animal'],
                'name' => $row['name_animal']
            ];
        } catch (PDOException $e) {
            // In production, log error instead of echo
            echo "Error getting animal: " . $e->getMessage();
            return null;
        }
    }

    public function list()
    {
        $services = [];

        try {
            $stmt = $this->pdo->prepare("
                SELECT 
                    s.id_treatment, s.service_date, s.observation, t.name_treatment, t.description_treatment
                FROM service_record s
                JOIN treatment t ON s.id_treatment = t.id_treatment
                WHERE s.id_animal = :animalId
                ORDER BY s.service_date DESC
            ");
            $stmt->bindParam(':animalId', $this->animalId, PDO::PARAM_INT); // Bind the parameter to prevent SQL injection
            $stmt->execute();

            // Fetch each row as associative array and loop through them
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $treatment = new Treatment($row['id_treatment'], $row['name_treatment'], $row['description_treatment']); // Create a Treatment instance
                $service = new ServiceRecord( // Create a ServiceRecord instance
                    $row['service_date'],
                    $row['observation'],
                    $treatment
                );

                array_push($services, $service); // Add the ServiceRecord instance to the $services list
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return $services;
    }

    public function createServiceRecord($treatmentId, $serviceDate, $observation)
    {
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO service_record (id_animal, id_treatment, service_date, observation)
                VALUES (:id_animal, :id_treatment, :service_date, :observation)
            ");
            $stmt->bindParam(':id_animal', $this->animalId, PDO::PARAM_INT);
            $stmt->bindParam(':id_treatment', $treatmentId, PDO::PARAM_INT);
            $stmt->bindParam(':service_date', $serviceDate);
            $stmt->bindParam(':observation', $observation);

            return $stmt->execute();
        } catch (PDOException $e) {
            // In production log error
            error_log("Error inserting service_record: " . $e->getMessage());
            return false;
        }
    }
}
