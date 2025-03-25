<?php
session_start();
include "../config/connection.php";

// Get generate_id from the URL
if (isset($_GET["generate_id"])) {
    $genrate_id = $_GET["generate_id"];

    // Check if the record exists
    $checkQuery = "SELECT * FROM `generated_recipes` WHERE `generate_id` = '$genrate_id'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Delete query
        $deleteQuery = "DELETE FROM `generated_recipes` WHERE `generate_id` = '$genrate_id'";

        if (mysqli_query($conn, $deleteQuery)) {
            $_SESSION["success"] = "Item deleted successfully!";
        } else {
            $_SESSION["error"] = "Error deleting item: " . mysqli_error($conn);
        }
    } else {
        $_SESSION["error"] = "Record not found!";
    }
} else {
    $_SESSION["error"] = "Invalid request!";
}

// Redirect back
echo "<script>window.location = 'index.php';</script>";
?>
