<?php
include "../config/connection.php";

// Set the response format to JSON
header('Content-Type: application/json');

// Check if customer_id is provided
if (!isset($_GET["customer_id"]) || empty($_GET["customer_id"])) {
    echo json_encode(["success" => false, "message" => "Missing customer_id"]);
    exit;
}

$customer_id = mysqli_real_escape_string($conn, $_GET["customer_id"]);

// Define base URL for image path
$baseImageUrl = "http://localhost/chefio/uploads/racipes"; // 👈 update this to your real image folder URL

// Query to fetch wishlist data for a specific customer
$query = "
    SELECT w.wishlist_id, w.wishlist_genrate_resipe_id, w.wishlist_customer_id, 
           r.generate_name, r.generate_image,
           c.customer_name
    FROM tbl_wishlist w
    JOIN generated_recipes r ON w.wishlist_genrate_resipe_id = r.generate_id
    JOIN tbl_customer c ON w.wishlist_customer_id = c.customer_id
    WHERE w.wishlist_customer_id = '$customer_id'
";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $wishlist = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $row["generate_image"] = $baseImageUrl . $row["generate_image"];
        $wishlist[] = $row;
    }

    echo json_encode(["success" => true, "data" => $wishlist]);
} else {
    echo json_encode(["success" => false, "message" => "No wishlist found for this customer."]);
}
?>
