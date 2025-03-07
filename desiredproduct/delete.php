<?php
session_start();
include "../config/connection.php";

// Get desiredproduct_id from the URL
$desiredproduct_id = $_GET["desiredproduct_id"];

// Fetch the current status of the desiredproduct
$statusQuery = "SELECT desiredproduct_status FROM `tbl_desiredproduct` WHERE `desiredproduct_id` = '$desiredproduct_id'";
$statusResult = mysqli_query($conn, $statusQuery);
$desiredproduct = mysqli_fetch_assoc($statusResult);

// Toggle the status
$new_status = ($desiredproduct['desiredproduct_status'] == 1) ? 2 : 1;  // If 1, change to 2; if 2, change to 1

// Update query to change the status
$updateQuery = "UPDATE `tbl_desiredproduct` SET `desiredproduct_status` = '$new_status' WHERE `desiredproduct_id` = '$desiredproduct_id'";

if (mysqli_query($conn, $updateQuery)) {
    $_SESSION["success"] = "Desiredproduct status updated successfully!";
    echo "<script>window.location = 'index.php';</script>";
} else {
    $_SESSION["error"] = "Error updating desiredproduct status: " . mysqli_error($conn);
    echo "<script>window.location = 'index.php';</script>";
}
?>
