<?php
include "../config/connection.php";

// Set JSON response header
header('Content-Type: application/json');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["error" => "Invalid request method!"]);
    exit;
}

// Read input data (handles both JSON & form data)
$data = json_decode(file_get_contents("php://input"), true) ?? $_POST;

// Check if all required fields exist
$required_fields = [
    "generate_name", "generate_customer_id", "generate_cuisines", "generate_meal_type",
    "generate_cooking_difficulty", "generate_preparation_time", "generate_servings_count",
    "generate_description", "generate_ingredients", "generate_instructions", "generate_nutritions",
    "generate_image", "generate_kcal"
];

foreach ($required_fields as $field) {
    if (!isset($data[$field]) || empty($data[$field])) {
        echo json_encode(["error" => "Missing or empty field: $field"]);
        exit;
    }
}

// Sanitize inputs
$generate_name = mysqli_real_escape_string($conn, $data["generate_name"]);
$generate_customer_id = mysqli_real_escape_string($conn, $data["generate_customer_id"]);
$generate_cuisines = mysqli_real_escape_string($conn, $data["generate_cuisines"]);
$generate_meal_type = mysqli_real_escape_string($conn, $data["generate_meal_type"]);
$generate_cooking_difficulty = mysqli_real_escape_string($conn, $data["generate_cooking_difficulty"]);
$generate_preparation_time = mysqli_real_escape_string($conn, $data["generate_preparation_time"]);
$generate_servings_count = mysqli_real_escape_string($conn, $data["generate_servings_count"]);
$generate_desired_products = isset($data["generate_desired_products"]) ? mysqli_real_escape_string($conn, $data["generate_desired_products"]) : "";
$generate_unwanted_products = isset($data["generate_unwanted_products"]) ? mysqli_real_escape_string($conn, $data["generate_unwanted_products"]) : "";
$generate_description = mysqli_real_escape_string($conn, $data["generate_description"]);
$generate_ingredients = mysqli_real_escape_string($conn, $data["generate_ingredients"]);
$generate_instructions = mysqli_real_escape_string($conn, $data["generate_instructions"]);
$generate_nutritions = mysqli_real_escape_string($conn, $data["generate_nutritions"]);
$generate_image = mysqli_real_escape_string($conn, $data["generate_image"]);
$generate_kcal = mysqli_real_escape_string($conn, $data["generate_kcal"]);
$generate_status = 1; // Default status

// Insert query
$insertQuery = "INSERT INTO generated_recipes (generate_name, generate_customer_id, generate_cuisines, generate_meal_type, generate_cooking_difficulty, generate_preparation_time, generate_servings_count, generate_desired_products, generate_unwanted_products, generate_description, generate_ingredients, generate_instructions, generate_nutritions, generate_image, generate_kcal, generate_status) 
                VALUES ('$generate_name', '$generate_customer_id', '$generate_cuisines', '$generate_meal_type', '$generate_cooking_difficulty', '$generate_preparation_time', '$generate_servings_count', '$generate_desired_products', '$generate_unwanted_products', '$generate_description', '$generate_ingredients', '$generate_instructions', '$generate_nutritions', '$generate_image', '$generate_kcal', '$generate_status')";

if (mysqli_query($conn, $insertQuery)) {
    echo json_encode(["success" => "Recipe saved successfully!"]);
} else {
    echo json_encode(["error" => "Error saving recipe: " . mysqli_error($conn)]);
}
?>
