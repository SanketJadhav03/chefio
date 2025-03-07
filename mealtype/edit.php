<?php
include "../config/connection.php";
include "../component/header.php";
include "../component/sidebar.php";

// Get the mealtype ID from the URL
$mealtype_id = $_GET['mealtype_id'];

// Fetch mealtype details
$mealtypeQuery = "SELECT * FROM tbl_mealtype WHERE mealtype_id = $mealtype_id";
$mealtypeResult = mysqli_query($conn, $mealtypeQuery);
$mealtype = mysqli_fetch_assoc($mealtypeResult);

// Check if the form is submitted
if (isset($_POST["mealtype_update"])) {
    // Sanitize and get form data
    $mealtype_name = mysqli_real_escape_string($conn, $_POST["mealtype_name"]);  

    

    // Update query
    $updateQuery = "UPDATE tbl_mealtype SET 
        mealtype_name = '$mealtype_name'
        WHERE mealtype_id = $mealtype_id";

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
                    <div class="h5 font-weight-bold">Edit Mealtype</div>
                    <a href="index.php" class="btn btn-info shadow font-weight-bold">
                        <i class="fa fa-eye"></i>&nbsp; View Mealtypes
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">

                    </div>
                    <div class="col-5">
                        <label for="mealtype_name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control font-weight-bold" name="mealtype_name" id="mealtype_name" value="<?= $mealtype['mealtype_name'] ?>" required>
                    </div> 
                </div>
            </div>

            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <button name="mealtype_update" type="submit" class="btn btn-primary shadow font-weight-bold">
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