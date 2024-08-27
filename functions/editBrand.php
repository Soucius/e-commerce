<?php

    include "../options/database.php";
    include "../partials/head.php";
    include "../partials/nav.php";

    if (isset($_GET['eid'])) {
        $brandId = $_GET['eid'];

        $brandQuery = $connection->prepare("select * from brands where id = :brandId");
        $brandQuery->execute([":brandId" => $brandId]);
        $brand = $brandQuery->fetch(\PDO::FETCH_ASSOC);
        $brandName = $brand['name'];

        if (isset($_POST['editedBrandName'])) {
            $editedBrandName = $_POST['editedBrandName'];

            $updateQuery = $connection->prepare('update brands set name = :brandName where id = :brandId');
            $updateQuery->execute([':brandName' => $editedBrandName, ':brandId' => $brandId]);

            header('Location:../brands.php');
        }
    }
?>

<form method="post" class="row gy-2 gx-3 align-items-center justify-content-center mt-5">
    <div class="col-auto">
        <input type="text" class="form-control" name="editedBrandName" id="editedBrandName" placeholder="Edit Brand Name..." value="<?= $brandName; ?>">
    </div>

    <div class="col-auto">
        <button type="submit" class="btn btn-primary btn-sm">Edit Brand</button>
    </div>
</form>

<?php include "../partials/footer.php"; ?>