<?php

    include "../options/database.php";

    if (isset($_GET['did'])) {
        $productId = $_GET['did'];

        $deleteQuery = $connection->prepare('delete from products where id = :productId');
        $deleteQuery->execute([':productId' => $productId]);

        header('Location:../products.php');
    }