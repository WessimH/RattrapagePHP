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

    // User input
    $enteredLastName = $_POST['lastName']; // Replace with the actual input field name
    $enteredPassword = $_POST['password']; // Replace with the actual input field name

    // SQL query to fetch the user
    $sql = "SELECT * FROM Employees WHERE LastName = :lastName";
    // Prepare statement
    $stmt = $pdo->prepare($sql);
    // Bind parameters
    $stmt->bindParam(':lastName', $enteredLastName);
    // Execute the query
    $stmt->execute();

    // Fetch the user
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the user exists and the password is correct
    // Check if the user exists and the password is correct
if ($user && $enteredPassword == $user['password']) {
    // Start a new session and set the user name
    session_start();
    $_SESSION['employeeName'] = $user['FirstName']; // Assuming 'FirstName' is the column name in your database

    // Redirect to the index page
    header("Location: index.php");
    exit;
} else {
    // Authentication failed
    echo "Invalid username or password.";
}

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>