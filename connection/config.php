<?php
// Database credentials
$host = "localhost"; // Change this to your database host (e.g., "localhost" or IP address)
$database = "db_lms"; // Change this to your database name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password

// PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // You can also set other PDO attributes here if needed
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
