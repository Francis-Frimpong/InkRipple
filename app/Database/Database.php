<?php
namespace App\Database;

use PDO;

class Database{
    private static $pdo;

    public static function getConnection(){
        if (!self::$pdo){
            self::$pdo = new PDO(
                'mysql:host=localhost;dbname=inkripple_db;charset=utf8mb4', 
                'root', 
                '', 
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        }
        return self::$pdo;
    }
}