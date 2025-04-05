<?php
include "../config/connection.php";
header('Content-Type: application/json');

// Get values from query params
$customer_id = $_GET["customer_id"] ?? null;
$recipe_id = $_GET["recipe_id"] ?? null;

// Validate inputs
if (empty($customer_id) || empty($recipe_id)) {
    echo json_encode(["success" => false, "message" => "Missing customer_id or recipe_id"]);
    exit;
}

// Sanitize input
$customer_id = mysqli_real_escape_string($conn, $customer_id);
$recipe_id = mysqli_real_escape_string($conn, $recipe_id);

// SQL to check existence in wishlist
$query = "
    SELECT 1 FROM tbl_wishlist 
    WHERE wishlist_customer_id = '$customer_id' 
      AND wishlist_genrate_resipe_id = '$recipe_id'
    LIMIT 1
";

$result = mysqli_query($conn, $query);

// Return result
if (mysqli_num_rows($result) > 0) {
    echo json_encode(["exists" => true]);
} else {
    echo json_encode(["exists" => false]);
}
?>
