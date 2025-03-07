<?php 
include "../config/connection.php";
include "../component/header.php";
include "../component/sidebar.php";

// Check if the form is submitted
if (isset($_POST["register_cookingdifficulty"])) { 
    $cookingdifficulty_name = mysqli_real_escape_string($conn, $_POST["cookingdifficulty_name"]); 

    $cookingdifficulty_status = 1;  
    // Validate required fields
    if (empty($cookingdifficulty_name) ) {
        $_SESSION["error"] = "Please fill in all required fields!";
    }  else { 
            // Insert query with image path
            $insertQuery = "INSERT INTO `tbl_cookingdifficulty` (`cookingdifficulty_name`, `cookingdifficulty_status`) 
                            VALUES ('$cookingdifficulty_name','$cookingdifficulty_status')";
            if (mysqli_query($conn, $insertQuery)) {
                $_SESSION["success"] = "Cookingdifficulty added successfully!";
                echo "<script>window.location = 'index.php';</script>";
            } else {
                $_SESSION["error"] = "Error registering cookingdifficulty: " . mysqli_error($conn);
            }  
        }
}
?>

<div class="content-wrapper p-2">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card">
            <div class="card-header">
                <div class="d-flex p-2 justify-content-between">
                    <div class="h5 font-weight-bold">Create Cookingdifficulty</div>
                    <a href="index.php" class="btn btn-info shadow font-weight-bold">
                        <i class="fa fa-eye"></i>&nbsp; Cookingdifficulty List
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
                        <label for="cookingdifficulty_name">Cookingdifficulty Name <span class="text-danger">*</span></label>
                        <input type="text" placeholder="Cookingdifficulty name" class="form-control font-weight-bold" name="cookingdifficulty_name" id="cookingdifficulty_name" >
                    </div>
                    
                </div>
            </div>

            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <button name="register_cookingdifficulty" type="submit" class="btn btn-primary shadow font-weight-bold">
                        <i class="fa fa-save"></i>&nbsp; Register Cookingdifficulty
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
