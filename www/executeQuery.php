<?php
// Function to execute a SQL query with optional parameters

function executeQuery($query, $params = [])
{
    // Database configuration
    $dbHost = 'db'; // Changed from '127.0.0.1'
    $dbName = 'mydatabase';
    $dbUser = 'root';
    $dbPass = 'rootpassword';
    // Attempt to connect and execute the query
    try {
        // Create a new PDO instance with error handling mode
        $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

        // Prepare the SQL statement
        $stmt = $pdo->prepare($query);

        // Execute the statement with parameters
        $stmt->execute($params);

        // Check if the query is a SELECT statement
        if (stripos($query, 'SELECT') === 0) {
            // Return the results for SELECT queries
            return $stmt->fetchAll();
        } else {
            // For other types of queries, return the number of affected rows
            return $stmt->rowCount();
        }
    } catch (PDOException $e) {
        // Log error message to error log in PHP
        error_log("Error: " . $e->getMessage());

        // Return a custom error object or message for the caller to handle
        return [
            'error' => true,
            'message' => "Database query error: " . $e->getMessage()
        ];
    }
}