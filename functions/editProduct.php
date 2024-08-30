<?php

    include "../partials/head.php";
    include "../partials/nav.php";
    include "../options/database.php";

    if (isset($_GET['uid'])) {
        $productId = $_GET['uid'];
    }

    $productQuery = $connection->prepare('select * from products where id = :productId');
    $productQuery->execute([':productId' => $productId]);
    $product = $productQuery->fetch(PDO::FETCH_ASSOC);
    $productCount = $productQuery->rowCount();

    $brandsQuery = $connection->prepare('select * from brands');
    $brandsQuery->execute();
    $brands = $brandsQuery->fetchAll(PDO::FETCH_ASSOC);

    $categoriesQuery = $connection->prepare('select * from categories');
    $categoriesQuery->execute();
    $categories = $categoriesQuery->fetchAll(PDO::FETCH_ASSOC);

    $brandQuery = $connection->prepare('select * from brands where id = :brand');
    $brandQuery->execute([':brand' => $product['brand']]);
    $brand = $brandQuery->fetchAll(PDO::FETCH_ASSOC);

    $categoryQuery = $connection->prepare('select * from categories where id = :category');
    $categoryQuery->execute([':category' => $product['category']]);
    $category = $categoryQuery->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-3"></div>

        <div class="col-6">
            <div class="card mt-3">
                <div class="card-header">
                    <h2 class="card-title">Add Product</h2>
                </div>

                <div class="card-body">
                    <?php
                        if ($_POST) {
                            $productTitle = $_POST['productTitle'];
                            $productDescription = $_POST['productDescription'];
                            $productPrice = $_POST['productPrice'];
                            $productStock = $_POST['productStock'];
                            $productImage = $_POST['productImage'];
                            $productBrand = $_POST['productBrand'];
                            $productCategory = $_POST['productCategory'];

                            $updateQuery = $connection->prepare("update products set title = :productTitle, description = :productDescription, price = :productPrice, stock = :productStock, img = :productImage, brand = :productBrand, category = :productCategory where id = :productId");
                            $updateQuery->execute([
                                ':productTitle' => $productTitle,
                                ':productDescription' => $productDescription,
                                ':productPrice' => $productPrice,
                                ':productStock' => $productStock,
                                ':productImage' => $productImage,
                                ':productBrand' => $productBrand,
                                ':productCategory' => $productCategory,
                                ':productId' => $productId,
                            ]);
                            $updateQueryCount = $updateQuery->rowCount();

                            if ($updateQueryCount > 0) {
                                echo "
                                    <div class='alert alert-success text-center'>Product Updated Succesfully.</div>
                                ";

                                header("refresh: 1; url= ../products.php");
                            }
                        }
                    ?>

                    <form method="post">
                        <div class="mb-3">
                            <label for="productTitle" class="form-label">Title</label>
                            <input type="text" name="productTitle" id="productTitle" class="form-control" value="<?= $product['title'] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Description</label>
                            <textarea type="text" name="productDescription" id="productDescription" class="form-control"><?= $product['description'] ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Price</label>
                            <input type="number" name="productPrice" id="productPrice" class="form-control" value="<?= $product['price'] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="productStock" class="form-label">Stock</label>
                            <input type="number" name="productStock" id="productStock" class="form-control" value="<?= $product['stock'] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="productImage" class="form-label">Image</label>
                            <textarea type="text" name="productImage" id="productImage" class="form-control"><?= $product['img'] ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="productBrand" class="form-label">Brand</label>
                            <select class="form-select" name="productBrand">
                                <option selected>Select Brand</option>

                                <?php
                                    foreach ($brands as $brand) {
                                        ?>
                                        <option value="<?= $brand['id']; ?>"><?= $brand['name']; ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="productCategory" class="form-label">Category</label>
                            <select class="form-select" name="productCategory">
                                <option selected>Select Category</option>

                                <?php
                                    foreach ($categories as $category) {
                                        ?>
                                        <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Update Product</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-3"></div>
    </div>
</div>

<?php include "../partials/footer.php"; ?>