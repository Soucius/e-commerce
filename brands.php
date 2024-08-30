<?php include "partials/head.php"; ?>
<?php include "partials/nav.php"; ?>
<?php

    include "options/database.php";

    $brandsQuery = $connection->prepare("select * from brands");
    $brandsQuery->execute();
    $brands = $brandsQuery->fetchAll(PDO::FETCH_ASSOC);
    $totalBrands = $brandsQuery->rowCount();
?>

<div class="container-fluid">
    <div class="row py-5">
        <div class="col-3 mx-auto">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title text-center">Brands</h1>
                    </div>
    
                    <div class="card-body">
                        <form action="../functions/addBrand.php" method="post" class="row gy-2 gx-3 align-items-center justify-content-center">
                            <div class="col-auto">
                                <input type="text" class="form-control" name="brandName" id="brandName" placeholder="Brand Name...">
                            </div>
    
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary btn-sm">Add Brand</button>
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
                                    foreach ($brands as $brand) {
                                        ?>
                                        <tr>
                                            <th scope="row"><?= $brand['id']; ?></th>
                                            <td><?= $brand['name']; ?></td>
                                            <td>
                                                <form action="../functions/editBrand.php?eid=<?= $brand['id'] ?>" method="post">
                                                    <div class="container text-center">
                                                        <button type="submit" class="btn btn-sm btn-primary">Edit</button>
                                                        <a href="../functions/deleteBrand.php?did=<?= $brand['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
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
                        <span>Total Brands: <?= $totalBrands; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "partials/footer.php"; ?>