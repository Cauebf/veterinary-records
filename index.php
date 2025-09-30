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
        <div class="animalCard">
            <a href="treatment.php">
                <img src="images/rico.png">
                <div>
                    <h1>Animal 1</h1>
                    <p>Species 1</p>
                </div>
            </a>
        </div>
    </section>
</body>

</html>