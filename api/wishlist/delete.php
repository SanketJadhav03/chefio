<?php
include "../config/connection.php";
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["error" => "Invalid request method!"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true) ?? $_POST;

if (!isset($data['wishlist_genrate_resipe_id']) || !isset($data['wishlist_customer_id'])) {
    echo json_encode(["error" => "Missing recipe or customer ID"]);
    exit;
}

$recipe_id = mysqli_real_escape_string($conn, $data["wishlist_genrate_resipe_id"]);
$customer_id = mysqli_real_escape_string($conn, $data["wishlist_customer_id"]);

$query = "DELETE FROM tbl_wishlist WHERE wishlist_genrate_resipe_id='$recipe_id' AND wishlist_customer_id='$customer_id'";

if (mysqli_query($conn, $query)) {
    echo json_encode(["success" => "Removed from wishlist"]);
} else {
    echo json_encode(["error" => "Failed to remove: " . mysqli_error($conn)]);
}
?>
