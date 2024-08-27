<?php include "partials/head.php"; ?>
<?php include "partials/nav.php"; ?>
<?php

    include "options/database.php";

    $categoriesQuery = $connection->prepare("select * from categories");
    $categoriesQuery->execute();
    $categories = $categoriesQuery->fetchAll(PDO::FETCH_ASSOC);
    $totalCategories = $categoriesQuery->rowCount();
?>

<div class="row py-5">
    <div class="col-3 mx-auto">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title text-center">Categories</h1>
                </div>

                <div class="card-body">
                    <form action="../functions/addCategory.php" method="post" class="row gy-2 gx-3 align-items-center justify-content-center">
                        <div class="col-auto">
                            <input type="text" class="form-control" name="categoryName" id="categoryName" placeholder="Category Name...">
                        </div>

                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary btn-sm">Add Category</button>
                        </div>
                    </form>

                    <hr class="w-50 mx-auto my-3">

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                foreach ($categories as $category) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $category['id']; ?></th>
                                        <td><?= $category['name']; ?></td>
                                        <td>
                                            <form action="../functions/editCategory.php?eid=<?= $category['id'] ?>" method="post">
                                                <div class="container text-center">
                                                    <button type="submit" class="btn btn-sm btn-primary">Edit</button>
                                                    <a href="../functions/deleteCategory.php?did=<?= $category['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <span>Total Categories: <?= $totalCategories; ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "partials/footer.php"; ?>