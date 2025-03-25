<?php
include "../config/connection.php";
include "../component/header.php";
include "../component/sidebar.php";
?>

<div class="content-wrapper p-2">
    <div class="card">
        <div class="card-header">
            <div class="text-center p-3">
                <h3 class="font-weight-bold">Generated Recipes</h3>
            </div>
            <form action="">
                <div class="row justify-content-end">
                    <div class="col-2 font-weight-bold">
                        Recipe Name
                        <input type="search" name="recipe_name" value="<?= isset($_GET["recipe_name"]) ? $_GET["recipe_name"] : "" ?>" class="form-control font-weight-bold" placeholder="Recipe Name">
                    </div>
                    <div class="col-1 font-weight-bold">
                        <br>
                        <button type="submit" class="shadow btn w-100 btn-info font-weight-bold"> <i class="fas fa-search"></i> &nbsp;Find</button>
                    </div>
                    <!-- <div class="col-2 font-weight-bold">
                        <br>
                        <a href="create.php" class="font-weight-bold w-100 shadow btn btn-success"> <i class="fas fa-plus"></i>&nbsp; Add Recipe</a>
                    </div> -->
                </div>
            </form>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Recipe Name</th>
                        <th>Instructions</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $count = 0;
                    $limit = 10;
                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $offset = ($page - 1) * $limit;
                    $countQuery = "SELECT COUNT(*) as total FROM generated_recipes";
                    $selectQuery = "SELECT * FROM generated_recipes LIMIT $limit OFFSET $offset";

                    if (isset($_GET["generate_name"])) {
                        $recipe_name = mysqli_real_escape_string($conn, $_GET["generate_name"]);
                        $countQuery = "SELECT COUNT(*) as total FROM generated_recipes WHERE recipe_name LIKE '%$recipe_name%'";
                        $selectQuery = "SELECT * FROM generated_recipes WHERE recipe_name LIKE '%$recipe_name%' LIMIT $limit OFFSET $offset";
                    }

                    $countResult = mysqli_query($conn, $countQuery);
                    $totalRecords = mysqli_fetch_assoc($countResult)['total'];
                    $totalPages = ceil($totalRecords / $limit);

                    $result = mysqli_query($conn, $selectQuery);
                    while ($data = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?= ++$count ?></td>
                            <!-- <td><img src="../uploads/recipes/<?= $data['recipe_image'] == null ? "no_img.png" : $data['recipe_image'] ?>" width="100" height="100" alt="Recipe Image"></td> -->
                            <td><?= $data["generate_name"] ?></td>
                            <td><?= $data["generate_instructions"] ?></td>
                            <td><?= $data["generate_status"]== 1 ? 'Active' : 'Inactive' ?></td>

                            <td>

                                <a href="delete.php?generate_id=<?= $data['generate_id'] ?>"
                                    onclick="return confirm('Are you sure you want to delete this item?');"
                                    class="btn btn-sm shadow btn-danger">
                                    <i class="fa fa-trash"></i> 
                                </a>


                            </td>
                        </tr>
                    <?php
                    }
                    if ($count == 0) {
                    ?>
                        <tr>
                            <td colspan="7" class="font-weight-bold text-center">
                                <span class="text-danger">No Recipes Found.</span>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-center">
                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a class="btn btn-sm btn-outline-info ml-2" href="?page=<?php echo $page - 1; ?>&recipe_name=<?php echo isset($recipe_name) ? $recipe_name : ''; ?>">Previous</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a class="btn btn-sm <?= $page == $i ? "btn-info" : "btn-outline-info" ?> ml-2 shadow" href="?page=<?php echo $i; ?>&recipe_name=<?php echo isset($recipe_name) ? $recipe_name : ''; ?>"><?php echo $i; ?></a>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages): ?>
                        <a class="btn btn-sm btn-outline-info ml-2" href="?page=<?php echo $page + 1; ?>&recipe_name=<?php echo isset($recipe_name) ? $recipe_name : ''; ?>">Next</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "../component/footer.php";
?>