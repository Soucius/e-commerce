<?php

    include "../options/database.php";

    if (isset($_POST["categoryName"])) {
        $categoryName = $_POST["categoryName"];
        $categoryQuery = $connection->prepare("insert into categories (name) values (:categoryName)");
        $categoryQuery->execute([":categoryName" => $categoryName]);

        header("Location:../categories.php");
    }