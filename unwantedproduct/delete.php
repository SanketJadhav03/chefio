<?php
session_start();
include "../config/connection.php";

// Get unwantedproduct_id from the URL
$unwantedproduct_id = $_GET["unwantedproduct_id"];

// Fetch the current status of the unwantedproduct
$statusQuery = "SELECT unwantedproduct_status FROM `tbl_unwantedproduct` WHERE `unwantedproduct_id` = '$unwantedproduct_id'";
$statusResult = mysqli_query($conn, $statusQuery);
$unwantedproduct = mysqli_fetch_assoc($statusResult);

// Toggle the status
$new_status = ($unwantedproduct['unwantedproduct_status'] == 1) ? 2 : 1;  // If 1, change to 2; if 2, change to 1

// Update query to change the status
$updateQuery = "UPDATE `tbl_unwantedproduct` SET `unwantedproduct_status` = '$new_status' WHERE `unwantedproduct_id` = '$unwantedproduct_id'";

if (mysqli_query($conn, $updateQuery)) {
    $_SESSION["success"] = "Unwantedproduct status updated successfully!";
    echo "<script>window.location = 'index.php';</script>";
} else {
    $_SESSION["error"] = "Error updating unwantedproduct status: " . mysqli_error($conn);
    echo "<script>window.location = 'index.php';</script>";
}
?>
