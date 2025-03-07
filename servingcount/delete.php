<?php
session_start();
include "../config/connection.php";

// Get servingcount_id from the URL
$servingcount_id = $_GET["servingcount_id"];

// Fetch the current status of the servingcount
$statusQuery = "SELECT servingcount_status FROM `tbl_servingcount` WHERE `servingcount_id` = '$servingcount_id'";
$statusResult = mysqli_query($conn, $statusQuery);
$servingcount = mysqli_fetch_assoc($statusResult);

// Toggle the status
$new_status = ($servingcount['servingcount_status'] == 1) ? 2 : 1;  // If 1, change to 2; if 2, change to 1

// Update query to change the status
$updateQuery = "UPDATE `tbl_servingcount` SET `servingcount_status` = '$new_status' WHERE `servingcount_id` = '$servingcount_id'";

if (mysqli_query($conn, $updateQuery)) {
    $_SESSION["success"] = "Servingcount status updated successfully!";
    echo "<script>window.location = 'index.php';</script>";
} else {
    $_SESSION["error"] = "Error updating servingcount status: " . mysqli_error($conn);
    echo "<script>window.location = 'index.php';</script>";
}
?>
