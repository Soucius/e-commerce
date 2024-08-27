<?php

    include "../options/database.php";

    if (isset($_GET['did'])) {
        $categoryId = $_GET['did'];

        $deleteQuery = $connection->prepare('delete from categories where id = :categoryId');
        $deleteQuery->execute([':categoryId' => $categoryId]);

        header('Location:../categories.php');
    }