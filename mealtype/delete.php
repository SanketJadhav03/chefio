<?php
session_start();
include "../config/connection.php";

// Get mealtype_id from the URL
$mealtype_id = $_GET["mealtype_id"];

// Fetch the current status of the mealtype
$statusQuery = "SELECT mealtype_status FROM `tbl_mealtype` WHERE `mealtype_id` = '$mealtype_id'";
$statusResult = mysqli_query($conn, $statusQuery);
$mealtype = mysqli_fetch_assoc($statusResult);

// Toggle the status
$new_status = ($mealtype['mealtype_status'] == 1) ? 2 : 1;  // If 1, change to 2; if 2, change to 1

// Update query to change the status
$updateQuery = "UPDATE `tbl_mealtype` SET `mealtype_status` = '$new_status' WHERE `mealtype_id` = '$mealtype_id'";

if (mysqli_query($conn, $updateQuery)) {
    $_SESSION["success"] = "Mealtype status updated successfully!";
    echo "<script>window.location = 'index.php';</script>";
} else {
    $_SESSION["error"] = "Error updating mealtype status: " . mysqli_error($conn);
    echo "<script>window.location = 'index.php';</script>";
}
?>
