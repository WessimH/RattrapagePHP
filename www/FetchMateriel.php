<?php

require_once 'executeQuery.php';
$result = executeQuery("SELECT * FROM equipment");

echo json_encode($result);