<?php
require_once 'config.php';

$search = false;
$value = "";

// Check if the searchValue parameter is set
if (isset($_GET['searchValue'])) {
    $search = true;

    // Check if the searchValue parameter is not empty and store its value
    if (!empty($_GET['searchValue'])) {
        $value = $_GET['searchValue'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinary Records</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1 class="main-title">Veterinary Records System</h1>

    <form id="search" action="index.php" method="get">
        <input type="text" name="searchValue" placeholder="Insert animal name">
        <button>Search</button>
    </form>

    <section id="records">
        <?php
        // If the search parameter is set, render the animal cards
        if ($search) {
            $animalView = new AnimalView();

            // If the searchValue parameter is empty, render all the animals otherwise render the animals by name
            if (empty($value)) {
                $animalView->RenderAnimals();
            } else {
                $animalView->RenderAnimalsByName($value);
            }
        }
        ?>
    </section>
</body>

</html>