<?php
    namespace BirdyFram;
    class PDOFactory{
        public static function getMysqlConnexion(){
            $db = new \PDO("","","");
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $db;
        }
    }
?>