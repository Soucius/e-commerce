<?php

    include "../options/database.php";

    if (isset($_GET['did'])) {
        $brandId = $_GET['did'];

        $deleteQuery = $connection->prepare('delete from brands where id = :brandId');
        $deleteQuery->execute([':brandId' => $brandId]);

        header('Location:../brands.php');
    }