<?php
require_once 'config.php';

try {
    // ServiceController expects $_GET['id'] to exist (per earlier constructor)
    $serviceController = new ServiceController();
} catch (Exception $e) {
    // if id missing, stop and show a clear message
    die("Animal id is required in query string. Example: service.php?id=1");
}

$treatmentController = new TreatmentController();
$view = new ServiceView();

$flash = null; // for success/error messages

// Handle form POST (Save)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    // Basic validation/sanitization
    $treatmentId = isset($_POST['treatment_id']) ? (int)$_POST['treatment_id'] : null;
    $serviceDate = isset($_POST['service_date']) ? trim($_POST['service_date']) : null;
    $observation = isset($_POST['observation']) ? trim($_POST['observation']) : '';

    if (!$treatmentId || !$serviceDate) {
        $flash = [
            'message' => 'Please choose a treatment and a date.',
            'class' => 'flash error'
        ];
    } else {
        // Ensure date storage format matches DB. If type=datetime-local produces "YYYY-MM-DDTHH:MM",
        // convert to "YYYY-MM-DD HH:MM:SS"
        if (strpos($serviceDate, 'T') !== false) {
            // if user sent "2025-09-01T09:00" -> "2025-09-01 09:00:00"
            $serviceDate = str_replace('T', ' ', $serviceDate) . ':00';
        }

        // Create service record and check success or failure for flash message display
        $ok = $serviceController->createServiceRecord($treatmentId, $serviceDate, $observation);
        if ($ok) {
            $flash = [
                'message' => 'Service record saved.',
                'class' => 'flash'
            ];
        } else {
            $flash = [
                'message' => 'Failed to save service record.',
                'class' => 'flash error'
            ];
        }
    }
}

// Fetch data for rendering
$animal = $serviceController->getAnimal();
if (!$animal) {
    die("Animal not found.");
}

$treatments = $treatmentController->list();
$services = $serviceController->list();

$view->render($animal, $treatments, $services, $flash);
