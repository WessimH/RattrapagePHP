<?php
function executeQuery($query, $params = [])
{
    // Database configuration
    $dbHost = 'localhost';
    $dbPort = '3307';
    $dbName = 'mydatabase';
    $dbUser = 'Wessim';
    $dbPass = '';

    try {
        // Create a new PDO instance
        $pdo = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement
        $stmt = $pdo->prepare($query);

        // Execute the statement with parameters
        $stmt->execute($params);

        // Check if the query is a SELECT statement
        if (stripos($query, 'SELECT') === 0) {
            // Fetch all results and return them
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            // Return the number of affected rows
            return $stmt->rowCount();
        }
    } catch (PDOException $e) {
        // Log the error message
        error_log("Database query error: " . $e->getMessage());

        // Return an error message
        return [
            'error' => true,
            'message' => "Database query error: " . $e->getMessage()
        ];
    }
}