<?php
    namespace BirdyFram;
    class PDOFactory{
        public static function getMysqlConnexion(){
            $db = new \PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_3b212f89c1e0900;charset=utf8', 'b5ab7b2f850e8a', 'de2bf61f');
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $db;
        }
    }
?>