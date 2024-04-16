<?php
include 'db.php';

// Start the session
session_start();

// Get the employee ID from the session data
$employee_id = $_SESSION['employee_id'];

$vehicle_id = $_POST['vehicle'];

$sql = "UPDATE Vehicles SET InUse = 1 WHERE VehicleID = :vehicle_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':vehicle_id', $vehicle_id);
$stmt->execute();

// Get the form data
$client_id = $_POST['client'];
$comment = $_POST['commentaire'];
$date = date('Y-m-d H:i:s'); // current date and time

// SQL query to insert the intervention
$sql = "INSERT INTO Interventions (EmployeeID, ClientID, VehicleID, Date, Comment) VALUES (:employee_id, :client_id, :vehicle_id, :date, :comment)";

// Prepare statement
$stmt = $pdo->prepare($sql);

// Bind parameters
$stmt->bindParam(':employee_id', $employee_id);
$stmt->bindParam(':client_id', $client_id);
$stmt->bindParam(':vehicle_id', $vehicle_id);
$stmt->bindParam(':date', $date);
$stmt->bindParam(':comment', $comment);

// Execute the query
$stmt->execute();
header('Location: index.php');
?>