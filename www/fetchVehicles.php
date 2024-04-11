<?php
require_once 'executeQuery.php';

$query = "SELECT * FROM Vehicles";
$result = executeQuery($query);

echo json_encode($result);