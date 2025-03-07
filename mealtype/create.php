<?php 
include "../config/connection.php";
include "../component/header.php";
include "../component/sidebar.php";

// Check if the form is submitted
if (isset($_POST["register_mealtype"])) { 
    $mealtype_name = mysqli_real_escape_string($conn, $_POST["mealtype_name"]); 

    $mealtype_status = 1;  
    // Validate required fields
    if (empty($mealtype_name) ) {
        $_SESSION["error"] = "Please fill in all required fields!";
    }  else { 
            // Insert query with image path
            $insertQuery = "INSERT INTO `tbl_mealtype` (`mealtype_name`, `mealtype_status`) 
                            VALUES ('$mealtype_name','$mealtype_status')";
            if (mysqli_query($conn, $insertQuery)) {
                $_SESSION["success"] = "Mealtype added successfully!";
                echo "<script>window.location = 'index.php';</script>";
            } else {
                $_SESSION["error"] = "Error registering mealtype: " . mysqli_error($conn);
            }  
        }
}
?>

<div class="content-wrapper p-2">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card">
            <div class="card-header">
                <div class="d-flex p-2 justify-content-between">
                    <div class="h5 font-weight-bold">Create Mealtype</div>
                    <a href="index.php" class="btn btn-info shadow font-weight-bold">
                        <i class="fa fa-eye"></i>&nbsp; Mealtype List
                    </a>
                </div>
            </div>
            <div class="card-body">
                <!-- Display error or success messages -->
                <?php
                if (isset($_SESSION["error"])) {
                    echo "<p style='color: red;'>".$_SESSION["error"]."</p>";
                    unset($_SESSION["error"]);
                }
                if (isset($_SESSION["success"])) {
                    echo "<p style='color: green;'>".$_SESSION["success"]."</p>";
                    unset($_SESSION["success"]);
                }
                ?>
                
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-5">
                        <label for="mealtype_name">Mealtype Name <span class="text-danger">*</span></label>
                        <input type="text" placeholder="Mealtype name" class="form-control font-weight-bold" name="mealtype_name" id="mealtype_name" >
                    </div>
                    
                </div>
            </div>

            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <button name="register_mealtype" type="submit" class="btn btn-primary shadow font-weight-bold">
                        <i class="fa fa-save"></i>&nbsp; Register Mealtype
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
