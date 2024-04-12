<?php
// Database connection parameters
$servername = "localhost";
$username = "Wessim";
$password = "";
$dbname = "mydatabase";

try {
    // Create a new PDO instance
    $GLOBALS['pdo'] = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $GLOBALS['pdo']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>