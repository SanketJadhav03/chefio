<?php
include "../config/connection.php";
include "../component/header.php";
include "../component/sidebar.php";

// Get the preparetime ID from the URL
$preparetime_id = $_GET['preparetime_id'];

// Fetch preparetime details
$preparetimeQuery = "SELECT * FROM tbl_preparetime WHERE preparetime_id = $preparetime_id";
$preparetimeResult = mysqli_query($conn, $preparetimeQuery);
$preparetime = mysqli_fetch_assoc($preparetimeResult);

// Check if the form is submitted
if (isset($_POST["preparetime_update"])) {
    // Sanitize and get form data
    $preparetime_name = mysqli_real_escape_string($conn, $_POST["preparetime_name"]);  

    

    // Update query
    $updateQuery = "UPDATE tbl_preparetime SET 
        preparetime_name = '$preparetime_name'
        WHERE preparetime_id = $preparetime_id";

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
                    <div class="h5 font-weight-bold">Edit Preparetime</div>
                    <a href="index.php" class="btn btn-info shadow font-weight-bold">
                        <i class="fa fa-eye"></i>&nbsp; View Preparetimes
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">

                    </div>
                    <div class="col-5">
                        <label for="preparetime_name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control font-weight-bold" name="preparetime_name" id="preparetime_name" value="<?= $preparetime['preparetime_name'] ?>" required>
                    </div> 
                </div>
            </div>

            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <button name="preparetime_update" type="submit" class="btn btn-primary shadow font-weight-bold">
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