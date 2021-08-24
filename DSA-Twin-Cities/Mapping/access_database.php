<?php

    require_once('C:/xampp/php/TwinCities/DSA-Twin-Cities/includes/configuration.php');

    // Connects to the database
    try
    {
        // Access the database information
        $host = DATABASE['HOST'];
        $db_name = DATABASE['DB'];
        $user_name = DATABASE['USERNAME'];
        $password = DATABASE['PASSWORD'];
        
        // Uses PDO to access the database using the database name, username and password
        $database = new PDO('mysql:host='. $host . ';dbname=' . $db_name . ';charset=utf8', $user_name, $password);
        
        // Sets attributes on the database handle
        // Sets the attribute ATTR_ERRMODE to handle error reporting
        // Sets the attribute ERRMODE_EXCEPTION to handle any exceptions that may be thrown
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Sets the attribute ATTR_EMULATE_PREPARES and sets it to false, 
        // in order to try to use native prepared statements
        $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
    catch(PDOException $e)
    {
        // Avoids the PDOExecption error and outputs a useful error message
        die("<h3>Connection Unsuccessful</h3>". $e->getMessage());
    }
?>