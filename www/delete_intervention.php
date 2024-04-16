<?php
// Start the session
session_start();

// Include the database connection file
include 'db.php';

// Check if the intervention_id is set in the GET array
if (!isset($_GET['intervention_id'])) {
    // Redirect to the index page
    header("Location: index.php");
    exit();
}

// Get the intervention_id from the GET array
$intervention_id = $_GET['intervention_id'];

// Prepare the SQL DELETE statement
$sql = "DELETE FROM Interventions WHERE InterventionID = :intervention_id";

// Prepare the statement
$stmt = $pdo->prepare($sql);

// Bind the intervention_id parameter
$stmt->bindParam(':intervention_id', $intervention_id);

// Execute the statement
$stmt->execute();

// Redirect to the index page
header("Location: index.php");
exit();
?>