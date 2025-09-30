<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinary Record</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <section id="search">
        <input type="text" placeholder="Insert animal name">
        <button>Search</button>
    </section>

    <section id="records">
        <?php
        $animalView = new AnimalView();
        $animalView->RenderAnimals();
        ?>
    </section>
</body>

</html>