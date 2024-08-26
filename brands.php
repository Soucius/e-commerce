<?php include "partials/head.php"; ?>
<?php include "partials/nav.php"; ?>

<div class="row py-5">
    <div class="col-3 mx-auto">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title text-center">Brands</h1>
                </div>

                <div class="card-body">
                    <form action="addBrand.php" method="post" class="row gy-2 gx-3 align-items-center justify-content-center">
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
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <span>Total Brands: </span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "partials/footer.php"; ?>