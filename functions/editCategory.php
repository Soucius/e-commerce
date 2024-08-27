<?php

    include "../options/database.php";
    include "../partials/head.php";
    include "../partials/nav.php";

    if (isset($_GET['eid'])) {
        $categoryId = $_GET['eid'];

        $categoryQuery = $connection->prepare("select * from categories where id = :categoryId");
        $categoryQuery->execute([":categoryId" => $categoryId]);
        $category = $categoryQuery->fetch(\PDO::FETCH_ASSOC);
        $categoryName = $category['name'];

        if (isset($_POST['editedCategoryName'])) {
            $editedCategoryName = $_POST['editedCategoryName'];

            $updateQuery = $connection->prepare('update categories set name = :categoryName where id = :categoryId');
            $updateQuery->execute([':categoryName' => $editedCategoryName, ':categoryId' => $categoryId]);

            header('Location:../categories.php');
        }
    }
?>

<form method="post" class="row gy-2 gx-3 align-items-center justify-content-center mt-5">
    <div class="col-auto">
        <input type="text" class="form-control" name="editedCategoryName" id="editedCategoryName" placeholder="Edit Category Name..." value="<?= $categoryName; ?>">
    </div>

    <div class="col-auto">
        <button type="submit" class="btn btn-primary btn-sm">Edit Category</button>
    </div>
</form>

<?php include "../partials/footer.php"; ?>