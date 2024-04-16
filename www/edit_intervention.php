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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Prepare the SQL UPDATE statement
    $sql = "UPDATE Interventions SET EmployeeID = :employee_id, ClientID = :client_id, VehicleID = :vehicle_id, Comment = :comment, Date = :date WHERE InterventionID = :intervention_id";

    // Prepare the statement
    $stmt = $pdo->prepare($sql);

    // Bind the parameters
    $stmt->bindParam(':employee_id', $_POST['employee_id']);
    $stmt->bindParam(':client_id', $_POST['client_id']);
    $stmt->bindParam(':vehicle_id', $_POST['vehicle_id']);
    $stmt->bindParam(':comment', $_POST['comment']);
    $stmt->bindParam(':date', $_POST['date']);
    $stmt->bindParam(':intervention_id', $intervention_id);

    // Execute the statement
    $stmt->execute();

    // Redirect to the index page
    header("Location: index.php");
    exit();
} else {
    // Prepare the SQL SELECT statement
    $sql = "SELECT * FROM Interventions WHERE InterventionID = :intervention_id";

    // Prepare the statement
    $stmt = $pdo->prepare($sql);

    // Bind the intervention_id parameter
    $stmt->bindParam(':intervention_id', $intervention_id);

    // Execute the statement
    $stmt->execute();

    // Fetch the result
    $intervention = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<form method="post">
    <div class="form-group">
        <label for="employee_id">Employee ID:</label>
        <input type="text" class="form-control" id="employee_id" name="employee_id" value="<?php echo htmlspecialchars($intervention['EmployeeID']); ?>" required>
    </div>
    <div class="form-group">
        <label for="client_id">Client ID:</label>
        <input type="text" class="form-control" id="client_id" name="client_id" value="<?php echo htmlspecialchars($intervention['ClientID']); ?>" required>
    </div>
    <div class="form-group">
        <label for="vehicle_id">Vehicle ID:</label>
        <input type="text" class="form-control" id="vehicle_id" name="vehicle_id" value="<?php echo htmlspecialchars($intervention['VehicleID']); ?>" required>
    </div>
    <div class="form-group">
        <label for="comment">Comment:</label>
        <textarea class="form-control" id="comment" name="comment"><?php echo htmlspecialchars($intervention['Comment']); ?></textarea>
    </div>
    <div class="form-group">
        <label for="date">Date:</label>
        <input type="date" class="form-control" id="date" name="date" value="<?php echo htmlspecialchars($intervention['Date']); ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Intervention</button>
</form>