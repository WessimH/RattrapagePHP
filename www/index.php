<?php
phpinfo();

require_once 'executeQuery.php';
var_dump(executeQuery("SELECT * FROM Clients"));