<?php
session_start();
include "../config/connection.php";

// Get cuisines_id from the URL
$cuisines_id = $_GET["cuisines_id"];

// Fetch the current status of the cuisines
$statusQuery = "SELECT cuisines_status FROM `tbl_cuisines` WHERE `cuisines_id` = '$cuisines_id'";
$statusResult = mysqli_query($conn, $statusQuery);
$cuisines = mysqli_fetch_assoc($statusResult);

// Toggle the status
$new_status = ($cuisines['cuisines_status'] == 1) ? 2 : 1;  // If 1, change to 2; if 2, change to 1

// Update query to change the status
$updateQuery = "UPDATE `tbl_cuisines` SET `cuisines_status` = '$new_status' WHERE `cuisines_id` = '$cuisines_id'";

if (mysqli_query($conn, $updateQuery)) {
    $_SESSION["success"] = "Cuisines status updated successfully!";
    echo "<script>window.location = 'index.php';</script>";
} else {
    $_SESSION["error"] = "Error updating cuisines status: " . mysqli_error($conn);
    echo "<script>window.location = 'index.php';</script>";
}
?>
