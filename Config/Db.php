<?php
class Db{
    private static $conn = null;

    public static function getConn(){
        if(self::$conn == null){
            try {
                self::$conn = new PDO("mysql:dbname=prueba1;host=localhost;port=3307", "root", "piespi3010");
                
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }

        }
        return self::$conn;

    }
}