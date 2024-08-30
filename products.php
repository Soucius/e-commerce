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
            <nav class="navbar bg-body-tertiary fixed-left">
                <div class="container-fluid">
                    <h2 class="navbar-brand">Filters</h2>
                    
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Filters</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        
                        <div class="offcanvas-body">
                            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#">Link</a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown
                                    </a>
                                    <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>

                            <form class="d-flex mt-3" role="search">
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
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
                                <div class="card ms-2 mt-sm-2 mt-2" style="width: 18rem;">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-6">
                                                <a href="../functions/editProduct.php?uid=<?= $product['id'] ?>" class="btn btn-sm btn-warning">Update Product</a>
                                            </div>
                                            <div class="col-6">
                                                <a href="../functions/deleteProduct.php?did=<?= $product['id'] ?>" class="btn btn-sm btn-danger">Delete Product</a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card-body">
                                        <img src="<?= $product['img'] ?>" class="card-img-top" height="280" width="150">

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