<?php
require_once '../connection/config.php'; // Include your database configuration file

if (isset($_GET['phone_number'])) {
    $phone_number = $_GET['phone_number'];

    try {
        // Prepare a SQL query to select a user based on the phone number
        $query = "SELECT * FROM borrower WHERE contact_no = :phone_number";
        $statement = $pdo->prepare($query);
        
        // Bind the parameter
        $statement->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
        
        // Execute the query
        $statement->execute();
        
        // Fetch the user data
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // User found
                header("Location:../loan.php?contact_no=" . $phone_number);
        } else {
            // User not found
            header("Location:../register.php?phone_number=" . $phone_number);
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>

