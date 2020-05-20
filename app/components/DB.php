<?php

namespace App\components;

use PDO;

final class DB {

    private static $db_connect;

    public static function getConnection() {

        $params = include dirname(__DIR__, 2) . '/config/DB_sql_params.php';

        try {
            $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";

            if (static::$db_connect === null) {
                static::$db_connect = new PDO($dsn, $params['user'], $params['password']);
                static::$db_connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return static::$db_connect;
        } catch (PDOException $err) {
            echo "Описане ошибки: <br>" . $err->getMessage() . "<br> <h1>Файл для импорта БД (mysqldump.sql.zip) в папке config!</h1>";
        }
    }

    private function __construct() {
        
    }

    private function __clone() {
        
    }

    private function __wakeup() {
        
    }

}
