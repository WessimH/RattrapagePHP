<?php
session_start();
if (!isset($_SESSION['employeeName'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>Welcome</h1>
    <p>You are logged in as: <?php echo htmlspecialchars($_SESSION['employeeName']); ?></p>
    <a href="logout.php" class="btn btn-danger">Logout</a>
    <a href="add_client.php" class="btn btn-info">Add New Client</a>
</div>
<?php
$query = "SELECT * FROM Interventions";
$stmt = $pdo->query($query);
$interventions = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($interventions)) {
    ?>
    <h2>No interventions found. Add a new one:</h2>
    <form action="add_intervention.php" method="post">
        <?php
        $query = "SELECT * FROM Clients";
        $stmt = $pdo->query($query);
        $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <label for="client">Client:</label>
        <select name="client">
            <?php foreach ($clients as $client): ?>
                <option value="<?php echo htmlspecialchars($client['ClientID']); ?>">
                    <?php echo htmlspecialchars($client['FirstName'] . ' ' . $client['LastName']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <div class="form-group">
            <?php
            $query = "SELECT * FROM Vehicles WHERE InUse = 0";
            $stmt = $pdo->query($query);
            $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <label for="vehicle">Vehicle:</label>
            <select name="vehicle">
                <?php foreach ($vehicles as $vehicle): ?>
                    <option value="<?php echo htmlspecialchars($vehicle['VehicleID']); ?>">
                        <?php echo htmlspecialchars($vehicle['Brand'] . ' ' . $vehicle['Model']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="equipment">Equipment:</label>
            <?php
            $query = "SELECT * FROM Equipment WHERE InUse = 0";
            $stmt = $pdo->query($query);
            $equipment = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <select name="equipment">
                <?php foreach ($equipment as $item): ?>
                    <option value="<?php echo htmlspecialchars($item['EquipmentID']); ?>">
                        <?php echo htmlspecialchars($item['Label'] . ' ' . $item['Brand'] . ' ' . $item['Model']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="commentaire">Commentaire:</label>
            <textarea class="form-control" id="commentaire" name="commentaire"></textarea>
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Intervention</button>
    </form>
    <?php
}
?>

<?php
$query = "
    SELECT
        Interventions.InterventionID,
        Interventions.EmployeeID,
        Interventions.ClientID,
        Interventions.Comment,
        Interventions.Date,
        Vehicles.Brand AS VehicleBrand,
        Vehicles.Model AS VehicleModel
    FROM
        Interventions
    LEFT JOIN
        Vehicles ON Interventions.VehicleID = Vehicles.VehicleID
";
$stmt = $pdo->query($query);
$interventions = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- Rest of your HTML code -->

<?php
$query = "
    SELECT
        Interventions.InterventionID,
        Interventions.EmployeeID,
        Interventions.ClientID,
        Vehicles.Brand AS VehicleBrand,
        Vehicles.Model AS VehicleModel,
        Interventions.Comment,
        Interventions.Date
    FROM
        Interventions
    LEFT JOIN
        Vehicles ON Interventions.VehicleID = Vehicles.VehicleID
";
$stmt = $pdo->query($query);
$interventions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Rest of your HTML code -->

<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Intervenant</th>
        <th>Client</th>
        <th>Véhicule</th>
        <th>Commentaire</th>
        <th>Date</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($interventions as $intervention): ?>
        <tr>
            <td><?php echo htmlspecialchars($intervention['InterventionID']); ?></td>
            <td><?php echo htmlspecialchars($intervention['EmployeeID']); ?></td>
            <td><?php echo htmlspecialchars($intervention['ClientID']); ?></td>
            <td><?php echo htmlspecialchars($intervention['VehicleBrand'] . ' ' . $intervention['VehicleModel']); ?></td>
            <td><?php echo htmlspecialchars($intervention['Comment']); ?></td>
            <td><?php echo htmlspecialchars($intervention['Date']); ?></td>
            <td>
                <a href="edit_intervention.php?intervention_id=<?php echo $intervention['InterventionID']; ?>"
                   class="btn btn-warning">Edit</a>
                <a href="delete_intervention.php?intervention_id=<?php echo $intervention['InterventionID']; ?>"
                   class="btn btn-success">Done ✔</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
