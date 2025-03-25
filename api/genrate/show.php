<?php
include "../config/connection.php";

// Set the response format to JSON
header('Content-Type: application/json');

// Fetch customer_id from the request
$customer_id = isset($_GET["customer_id"]) ? mysqli_real_escape_string($conn, $_GET["customer_id"]) : "";

// Validate customer_id
if (empty($customer_id)) {
    echo json_encode(["success" => false, "message" => "Customer ID is required."]);
    exit;
}

// Query to fetch recipes based on generate_customer_id
$query = "SELECT * FROM generated_recipes WHERE generate_customer_id = '$customer_id'";

$result = mysqli_query($conn, $query);

// Check if data exists
if ($result && mysqli_num_rows($result) > 0) {
    $recipes = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $recipes[] = $row;
    }
    echo json_encode(["success" => true, "data" => $recipes]);
} else {
    echo json_encode(["success" => false, "message" => "No recipes found for this customer."]);
}
?>
