<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // SQL query to insert the client
    // Assuming that ClientID is auto-incremented, it is omitted from the INSERT statement
    $sql = "INSERT INTO Clients (LastName, FirstName, Email, PhoneNumber, Address) VALUES (:lastname, :firstname, :email, :phone, :address)";

    // Prepare statement
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':address', $address);

    // Execute the query
    $stmt->execute();

    // Redirect to the index page or confirmation page
    header('Location: index.php');
    exit();
}
?>


<form action="add_client.php" method="post">
    <label for="firstname">First Name:</label>
    <input type="text" id="firstname" name="firstname" required>

    <label for="lastname">Last Name:</label>
    <input type="text" id="lastname" name="lastname" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="phone">Phone:</label>
    <input type="tel" id="phone" name="phone" required>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required>

    <input type="submit" value="Add Client">
</form>
