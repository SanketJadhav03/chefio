<?php
session_start();
include "../config/connection.php";

// Get preparetime_id from the URL
$preparetime_id = $_GET["preparetime_id"];

// Fetch the current status of the preparetime
$statusQuery = "SELECT preparetime_status FROM `tbl_preparetime` WHERE `preparetime_id` = '$preparetime_id'";
$statusResult = mysqli_query($conn, $statusQuery);
$preparetime = mysqli_fetch_assoc($statusResult);

// Toggle the status
$new_status = ($preparetime['preparetime_status'] == 1) ? 2 : 1;  // If 1, change to 2; if 2, change to 1

// Update query to change the status
$updateQuery = "UPDATE `tbl_preparetime` SET `preparetime_status` = '$new_status' WHERE `preparetime_id` = '$preparetime_id'";

if (mysqli_query($conn, $updateQuery)) {
    $_SESSION["success"] = "Preparetime status updated successfully!";
    echo "<script>window.location = 'index.php';</script>";
} else {
    $_SESSION["error"] = "Error updating preparetime status: " . mysqli_error($conn);
    echo "<script>window.location = 'index.php';</script>";
}
?>
