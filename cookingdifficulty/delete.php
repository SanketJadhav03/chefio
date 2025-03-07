<?php
session_start();
include "../config/connection.php";

// Get cookingdifficulty_id from the URL
$cookingdifficulty_id = $_GET["cookingdifficulty_id"];

// Fetch the current status of the cookingdifficulty
$statusQuery = "SELECT cookingdifficulty_status FROM `tbl_cookingdifficulty` WHERE `cookingdifficulty_id` = '$cookingdifficulty_id'";
$statusResult = mysqli_query($conn, $statusQuery);
$cookingdifficulty = mysqli_fetch_assoc($statusResult);

// Toggle the status
$new_status = ($cookingdifficulty['cookingdifficulty_status'] == 1) ? 2 : 1;  // If 1, change to 2; if 2, change to 1

// Update query to change the status
$updateQuery = "UPDATE `tbl_cookingdifficulty` SET `cookingdifficulty_status` = '$new_status' WHERE `cookingdifficulty_id` = '$cookingdifficulty_id'";

if (mysqli_query($conn, $updateQuery)) {
    $_SESSION["success"] = "Cookingdifficulty status updated successfully!";
    echo "<script>window.location = 'index.php';</script>";
} else {
    $_SESSION["error"] = "Error updating cookingdifficulty status: " . mysqli_error($conn);
    echo "<script>window.location = 'index.php';</script>";
}
?>
