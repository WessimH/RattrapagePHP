<?php
// Database connection parameters
$servername = "localhost";
$username = "Wessim";
$password = "";
$dbname = "mydatabase";

// Get the form data
$client_first_name = $_POST['client_first_name'];
$client_last_name = $_POST['client_last_name'];
$client_email = $_POST['client_email'];
$client_phone = $_POST['client_phone'];
$client_address = $_POST['client_address'];
$description = $_POST['description'];

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL query to check if the client already exists
    $sql = "SELECT * FROM Clients WHERE Email = :email";
    // Prepare statement
    $stmt = $conn->prepare($sql);
    // Bind parameters
    $stmt->bindParam(':email', $client_email);
    // Execute the query
    $stmt->execute();

    // Fetch all
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // If the client does not exist in the database, insert them
    if (count($result) === 0) {
        // SQL query to insert the client
        $sql = "INSERT INTO Clients (LastName, FirstName, Email, PhoneNumber, Address) VALUES (:last_name, :first_name, :email, :phone, :address)";
        // Prepare statement
        $stmt = $conn->prepare($sql);
        // Bind parameters
        $stmt->bindParam(':last_name', $client_last_name);
        $stmt->bindParam(':first_name', $client_first_name);
        $stmt->bindParam(':email', $client_email);
        $stmt->bindParam( ':phone', $client_phone);
        $stmt->bindParam(':address', $client_address);
        // Execute the query
        $stmt->execute();
    }

    // Continue with the rest of your code to handle the intervention request...

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>