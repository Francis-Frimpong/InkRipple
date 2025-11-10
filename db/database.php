<?php
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=inkripple_db;charset=utf8mb4', 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }
    catch(PDOException $e){
        echo 'A problem occured with databse connection...';
        die();
    }

?>