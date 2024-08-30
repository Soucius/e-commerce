<?php

    include "../partials/head.php";
    include "../partials/nav.php";
    include "../options/database.php";

    $brandsQuery = $connection->prepare("select * from brands");
    $brandsQuery->execute();
    $brands = $brandsQuery->fetchAll(PDO::FETCH_ASSOC);

    $categoriesQuery = $connection->prepare("select * from categories");
    $categoriesQuery->execute();
    $categories = $categoriesQuery->fetchAll(PDO::FETCH_ASSOC);

    @$productTitle = $_POST['productTitle'];
    @$productDescription = $_POST['productDescription'];
    @$productPrice = $_POST['productPrice'];
    @$productStock = $_POST['productStock'];
    @$productImage = $_POST['productImage'];
    @$productBrand = $_POST['productBrand'];
    @$productCategory = $_POST['productCategory'];

    if ($productTitle != "" and $productDescription != "" and $productPrice != 0 and $productStock != 0 and $productImage != "" and $productBrand != "" and $productCategory != "") {
        $addProductQuery = $connection->prepare("insert into products (title, description, price, stock, img, brand, category) values (:productTitle, :productDescription, :productPrice, :productStock, :productImage, :productBrand, :productCategory)");
        $addProductQuery->execute([
            ":productTitle" => $productTitle,
            ":productDescription" => $productDescription,
            ":productPrice" => $productPrice,
            ":productStock" => $productStock,
            ":productImage" => $productImage,
            ":productBrand" => $productBrand,
            ":productCategory" => $productCategory,
        ]);
        $addProductQueryCount = $addProductQuery->rowCount();
    }

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
                        if (@$addProductQueryCount > 0) {
                            echo "
                                <div class='alert alert-success text-center'>Product Added Succesfully.</div>
                            ";
                            header("refresh: 1; url= ../products.php");
                        }
                    ?>

                    <form method="post">
                        <div class="mb-3">
                            <label for="productTitle" class="form-label">Title</label>
                            <input type="text" name="productTitle" id="productTitle" class="form-control" placeholder="Product Title...">
                        </div>

                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Description</label>
                            <textarea type="text" name="productDescription" id="productDescription" class="form-control" placeholder="Product Description..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Price</label>
                            <input type="number" name="productPrice" id="productPrice" class="form-control" placeholder="Product Price...">
                        </div>

                        <div class="mb-3">
                            <label for="productStock" class="form-label">Stock</label>
                            <input type="number" name="productStock" id="productStock" class="form-control" placeholder="Product Stock...">
                        </div>

                        <div class="mb-3">
                            <label for="productImage" class="form-label">Image</label>
                            <textarea type="text" name="productImage" id="productImage" class="form-control" placeholder="Product Image Url..."></textarea>
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

                        <button type="submit" class="btn btn-primary w-100">Add Product</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-3"></div>
    </div>
</div>

<?php include "../partials/footer.php"; ?>