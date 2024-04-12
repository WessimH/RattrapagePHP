<?php
// Database connection parameters
$servername = "localhost";
$username = "Wessim";
$password = "";
$dbname = "mydatabase";

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Employee data
    $lastName = 'Lastname1';
    $firstName = 'Firstname1';
    $employeePassword = 'password'; // Replace with the actual password

    // Hash the password
    $hashedPassword = password_hash($employeePassword, PASSWORD_DEFAULT);

    // SQL query to insert the employee
    $sql = "INSERT INTO Employees (LastName, FirstName, Password) VALUES (:lastName, :firstName, :password)";
    // Prepare statement
    $stmt = $pdo->prepare($sql);
    // Bind parameters
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':password', $hashedPassword);
    // Execute the query
    $stmt->execute();

    echo "Employee account created successfully.";

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>