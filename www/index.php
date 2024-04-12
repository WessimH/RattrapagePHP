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
</div>

</body>
</html>
