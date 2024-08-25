<?php

    $databaseName = "e-commerce";
    $host = "localhost";
    $user = "root";
    $password = "";

    try {
        $connection = new PDO("mysql:host=$host;dbname=$databaseName", $user, $password);
    } catch (PDOException $error) {
        echo $error->getMessage();
    }