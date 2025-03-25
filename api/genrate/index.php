<?php
include "../config/connection.php";

// Set the response format to JSON
header('Content-Type: application/json');

// Fetch search parameters if provided
$search = isset($_GET["search"]) ? mysqli_real_escape_string($conn, $_GET["search"]) : "";

// Query to fetch generated recipes
$query = "SELECT * FROM generated_recipes";
if (!empty($search)) {
    $query .= " WHERE generate_name LIKE '%$search%'";
}

$result = mysqli_query($conn, $query);

// Check if data exists
if (mysqli_num_rows($result) > 0) {
    $recipes = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $recipes[] = $row;
    }
    echo json_encode(["success" => true, "data" => $recipes]);
} else {
    echo json_encode(["success" => false, "message" => "No recipes found."]);
}
?>