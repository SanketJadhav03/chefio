<?php
session_start();
include "../config/connection.php";

// Set JSON response header
header('Content-Type: application/json; charset=utf-8');

// Check if generate_id is set
if (isset($_GET["generate_id"])) {
    $generate_id = $_GET["generate_id"];

    // Check if the record exists
    $checkQuery = "SELECT * FROM `generated_recipes` WHERE `generate_id` = ?";
    $stmt = mysqli_prepare($conn, $checkQuery);
    mysqli_stmt_bind_param($stmt, "s", $generate_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // Delete query using prepared statements
        $deleteQuery = "DELETE FROM `generated_recipes` WHERE `generate_id` = ?";
        $stmt = mysqli_prepare($conn, $deleteQuery);
        mysqli_stmt_bind_param($stmt, "s", $generate_id);

        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(["success" => true, "message" => "Item deleted successfully!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Error deleting item: " . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Record not found!"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request!"]);
}

mysqli_close($conn);
?>
