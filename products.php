<?php

    include "partials/head.php";
    include "partials/nav.php";
    include "options/database.php";

    $productsQuery = $connection->prepare("select * from products");
    $productsQuery->execute();
    $products = $productsQuery->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-3 border-end">
            <div class="container mx-3">
                <h2 class="text-center">Filters</h2>
    
                <hr class="w-50 mx-auto">
            </div>
    
            <div class="container px-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Filter by Brands</h4>
                    </div>
    
                    <div class="card-body">
                        <ul class="list-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="brandCheck" id="brandCheck">
                                <label class="form-check-label" for="brandCheck">Default checkbox</label>
                            </div>
                        </ul>
                    </div>
    
                    <div class="card-footer">
                        <span>Selected: </span>
                    </div>
                </div>
            </div>
    
            <div class="container px-3 pt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Filter by Category</h4>
                    </div>
    
                    <div class="card-body">
                        <ul class="list-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="categoryCheck" id="categoryCheck">
                                <label class="form-check-label" for="categoryCheck">
                                    Default checkbox
                                </label>
                            </div>
                        </ul>
                    </div>
    
                    <div class="card-footer">
                        <span>Selected: </span>
                    </div>
                </div>
            </div>
    
            <div class="container px-3 pt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Filter by Price</h4>
                    </div>
    
                    <div class="card-body">
                        <ul class="list-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="priceCheck" id="priceCheck">
                                <label class="form-check-label" for="priceCheck">
                                    Default checkbox
                                </label>
                            </div>
                        </ul>
                    </div>
    
                    <div class="card-footer">
                        <span>Selected: </span>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="col-9">
            <div class="container">
                <h1>Products</h1>
    
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Products</li>
                    </ol>
                </nav>

                <a href="functions/addProduct.php" class="btn btn-primary">Add Product</a>
                <a href="functions/deleteProduct.php" class="btn btn-danger">Delete Product</a>
    
                <div class="container border rounded-3 mt-2">
                    <div class="row p-3">
                        <?php
                            $brandsQuery = $connection->prepare("select * from brands");
                            $brandsQuery->execute();
                            $brands = $brandsQuery->fetchAll(PDO::FETCH_ASSOC);
                            $brandName = "";

                            foreach ($products as $product) {
                                foreach ($brands as $brand) {
                                    if ($brand["id"] == $product["brand"]) {
                                        $brandName = $brand['name'];
                                    }
                                }
                                ?>
                                <div class="card ms-2" style="width: 18rem;">
                                    <img src="<?= $product['img'] ?>" class="card-img-top">

                                    <div class="card-body">
                                        <h5 class="card-title"><?= $brandName; ?> - <?= $product['title']; ?></h5>

                                        <p class="card-text">$<?= $product['price']; ?></p>
                                    </div>
                                    
                                    <div class="card-footer text-center">
                                        <a href="#" class="btn btn-primary">Add to Cart</a>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "partials/footer.php"; ?>