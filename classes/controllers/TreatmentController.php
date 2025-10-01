<?php

class TreatmentController
{
    private $pdo;

    // When creating TreatmentController, get the PDO connection from Database singleton
    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function list()
    {
        $treatments = [];

        try {
            $stmt = $this->pdo->prepare("
                SELECT 
                    id_treatment,
                    name_treatment,
                    description_treatment
                FROM treatment
            ");
            $stmt->execute();

            // Fetch each row as associative array and loop through them
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $treatment = new Treatment($row['id_treatment'], $row['name_treatment'], $row['description_treatment']);

                array_push($treatments, $treatment); // Add the Treatment instance to the $treatments list
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return $treatments;
    }
}
