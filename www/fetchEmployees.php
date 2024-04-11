<?php
require_once 'executeQuery.php';
$result = executeQuery("SELECT * FROM Employees");

echo json_encode($result);