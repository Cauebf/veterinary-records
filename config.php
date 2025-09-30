<?php

// spl_autoload_register() is a PHP function that registers an autoloader.
// This autoloader is automatically called whenever a class is used (instantiated or referenced) 
// but has not been included yet, helping avoid manually writing multiple require or include statements.
// The class name is passed as the first parameter to the callback function.
spl_autoload_register(function ($className) {
    $classesFolder = 'classes/';

    $possibleFolderPaths = [
        $classesFolder,
        $classesFolder . 'models/',
        $classesFolder . 'controllers/',
        $classesFolder . 'views/',
    ];

    // Check if the class file exists in any of the possible folder paths
    foreach ($possibleFolderPaths as $folderPath) {
        $fileName = $folderPath . $className . '.php'; // Path to the class file (e.g., classes/Animal.php)
        // If the class file exists, include it and break the loop to prevent further checks
        if (file_exists($fileName)) {
            require_once $fileName;
            break;
        }
    }
});
