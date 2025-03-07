<?php
include "../config/connection.php";
include "../component/header.php";
include "../component/sidebar.php";

// Get the unwantedproduct ID from the URL
$unwantedproduct_id = $_GET['unwantedproduct_id'];

// Fetch unwantedproduct details
$unwantedproductQuery = "SELECT * FROM tbl_unwantedproduct WHERE unwantedproduct_id = $unwantedproduct_id";
$unwantedproductResult = mysqli_query($conn, $unwantedproductQuery);
$unwantedproduct = mysqli_fetch_assoc($unwantedproductResult);

// Check if the form is submitted
if (isset($_POST["unwantedproduct_update"])) {
    // Sanitize and get form data
    $unwantedproduct_name = mysqli_real_escape_string($conn, $_POST["unwantedproduct_name"]);  

    

    // Update query
    $updateQuery = "UPDATE tbl_unwantedproduct SET 
        unwantedproduct_name = '$unwantedproduct_name'
        WHERE unwantedproduct_id = $unwantedproduct_id";

    if (mysqli_query($conn, $updateQuery)) {
        $_SESSION["success"] = "Profile Updated Successfully!";
        echo "<script>window.location = 'index.php';</script>"; // Redirect to profile page
    } else {
        $_SESSION["error"] = "Error updating profile: " . mysqli_error($conn);
    }
}
?>

<div class="content-wrapper p-2">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card">
            <div class="card-header">
                <div class="d-flex p-2 justify-content-between">
                    <div class="h5 font-weight-bold">Edit Unwantedproduct</div>
                    <a href="index.php" class="btn btn-info shadow font-weight-bold">
                        <i class="fa fa-eye"></i>&nbsp; View Unwantedproducts
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">

                    </div>
                    <div class="col-5">
                        <label for="unwantedproduct_name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control font-weight-bold" name="unwantedproduct_name" id="unwantedproduct_name" value="<?= $unwantedproduct['unwantedproduct_name'] ?>" required>
                    </div> 
                </div>
            </div>

            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <button name="unwantedproduct_update" type="submit" class="btn btn-primary shadow font-weight-bold">
                        <i class="fa fa-save"></i>&nbsp; Update Profile
                    </button>
                    &nbsp;
                    <button type="reset" class="btn btn-danger shadow font-weight-bold">
                        <i class="fas fa-times"></i>&nbsp; Clear
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php include "../component/footer.php"; ?>