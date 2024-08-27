<?php

    include "../options/database.php";

    if (isset($_POST["brandName"])) {
        $brandName = $_POST["brandName"];
        $brandQuery = $connection->prepare("insert into brands (name) values (:brandName)");
        $brandQuery->execute([":brandName" => $brandName]);

        header("Location:../brands.php");
    }
