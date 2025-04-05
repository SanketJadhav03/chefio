<?php
include "../config/connection.php";

// Set JSON response header
header('Content-Type: application/json');

// Only allow POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["error" => "Invalid request method!"]);
    exit;
}

// Read JSON input or fallback to POST form
$data = json_decode(file_get_contents("php://input"), true) ?? $_POST;

// Required fields
$required_fields = ["wishlist_genrate_resipe_id", "wishlist_customer_id"];

foreach ($required_fields as $field) {
    if (!isset($data[$field]) || empty($data[$field])) {
        echo json_encode(["error" => "Missing or empty field: $field"]);
        exit;
    }
}

// Sanitize input
$recipe_id = mysqli_real_escape_string($conn, $data["wishlist_genrate_resipe_id"]);
$customer_id = mysqli_real_escape_string($conn, $data["wishlist_customer_id"]);

// Insert into wishlist
$insertQuery = "INSERT INTO tbl_wishlist (wishlist_genrate_resipe_id, wishlist_customer_id)
                VALUES ('$recipe_id', '$customer_id')";

if (mysqli_query($conn, $insertQuery)) {
    echo json_encode(["success" => "Wishlist item added successfully!"]);
} else {
    echo json_encode(["error" => "Error saving wishlist: " . mysqli_error($conn)]);
}
?>
