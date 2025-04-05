<?php
include "../config/connection.php";
header('Content-Type: application/json');

// Query to fetch all wishlist items with recipe details
$query = "
    SELECT 
        w.wishlist_id,
        w.wishlist_customer_id,
        w.wishlist_genrate_resipe_id,
        r.generate_id,
        r.generate_name,
        r.generate_preparation_time,
        r.generate_kcal
    FROM tbl_wishlist w
    JOIN generated_recipes r 
        ON w.wishlist_genrate_resipe_id = r.generate_id
    ORDER BY w.wishlist_id DESC
";


$result = mysqli_query($conn, $query);

if (!$result) {
    echo json_encode([
        "success" => false,
        "message" => "Database query error: " . mysqli_error($conn)
    ]);
    exit;
}

$wishlist = [];

while ($row = mysqli_fetch_assoc($result)) {
    $wishlist[] = $row;
}

echo json_encode([
    "success" => true,
    "wishlist" => $wishlist
]);
?>
