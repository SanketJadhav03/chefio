<?php
include "../config/connection.php";

// Set the response format to JSON
header('Content-Type: application/json');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Extract the POST data
    $customer_id = mysqli_real_escape_string($conn, $_POST["customer_id"]);
    $customer_name = mysqli_real_escape_string($conn, $_POST["customer_name"]);
    $customer_email = mysqli_real_escape_string($conn, $_POST["customer_email"]);
    $customer_phone = mysqli_real_escape_string($conn, $_POST["customer_phone"]);
    $customer_address = mysqli_real_escape_string($conn, $_POST["customer_address"]);
    $customer_status = mysqli_real_escape_string($conn, $_POST["customer_status"]);
    $new_password = isset($_POST["customer_password"]) ? trim($_POST["customer_password"]) : "";

    // Validate required fields
    if (empty($customer_id) || empty($customer_name) || empty($customer_email) || empty($customer_phone) || empty($customer_address)) {
        echo json_encode(["error" => "Please fill in all required fields!"]);
        exit;
    }

    // Check if the customer exists
    $checkCustomerQuery = "SELECT * FROM tbl_customer WHERE customer_id = '$customer_id'";
    $checkCustomerResult = mysqli_query($conn, $checkCustomerQuery);
    
    if (mysqli_num_rows($checkCustomerResult) == 0) {
        echo json_encode(["error" => "Customer not found!"]);
        exit;
    }
    
    // Fetch existing customer details
    $customerData = mysqli_fetch_assoc($checkCustomerResult);
    $existing_password = $customerData["customer_password"];

    // Image upload processing
    $image_path = "";
    if (isset($_FILES["customer_image"])) {
        $customer_image = $_FILES["customer_image"]["name"];
        $customer_image_temp = $_FILES["customer_image"]["tmp_name"];

        // Set the target directory
        $target_dir = "../../uploads/customers/";
        $target_file = $target_dir . basename($customer_image);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an image
        $check = getimagesize($customer_image_temp);
        if ($check === false) {
            echo json_encode(["error" => "File is not an image!"]);
            exit;
        }

        // Check file size (limit: 5MB)
        if ($_FILES["customer_image"]["size"] > 5000000) {
            echo json_encode(["error" => "File is too large!"]);
            exit;
        }

        // Allow only JPG, JPEG, PNG
        if (!in_array($imageFileType, ["jpg", "jpeg", "png"])) {
            echo json_encode(["error" => "Only JPG, JPEG, & PNG files allowed!"]);
            exit;
        }

        // Move uploaded file
        if (move_uploaded_file($customer_image_temp, $target_file)) {
            $image_path = $customer_image;
        } else {
            echo json_encode(["error" => "Error uploading image!"]);
            exit;
        }
    }

    // Handle password update
    if (!empty($new_password)) {
        // Check if the new password is different from the old one
        if (!password_verify($new_password, $existing_password)) {
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        } else {
            $hashed_password = $existing_password; // Keep the same if unchanged
        }
    } else {
        $hashed_password = $existing_password; // Keep old password if empty
    }

    // Update customer details
    $updateQuery = "UPDATE tbl_customer SET 
                    customer_name = '$customer_name', 
                    customer_email = '$customer_email', 
                    customer_phone = '$customer_phone', 
                    customer_address = '$customer_address', 
                    customer_status = '1', 
                    customer_password = '$hashed_password'";

    // Include the image path if updated
    if (!empty($image_path)) {
        $updateQuery .= ", customer_image = '$image_path'";
    }

    $updateQuery .= " WHERE customer_id = '$customer_id'";

    if (mysqli_query($conn, $updateQuery)) {
        echo json_encode(["success" => "Customer updated successfully!"]);
    } else {
        echo json_encode(["error" => "Error updating customer: " . mysqli_error($conn)]);
    }
} else {
    echo json_encode(["error" => "Invalid request method!"]);
}
?>
