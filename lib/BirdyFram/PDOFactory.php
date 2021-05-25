<?php
    namespace BirdyFram;
    class PDOFactory{
        public static function getMysqlConnexion(){
            $db = new \PDO('mysql:host=localhost;dbname=test;charset=utf8;port=3307', 'root', 'root');
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $db;
        }
    }
?>