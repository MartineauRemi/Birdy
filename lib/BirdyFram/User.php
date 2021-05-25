<?php
    namespace BirdyFram;

    class User {
        public function getAttribute($attribute){
            return isset($_SESSION[$attribute]) ? $_SESSION[$attribute] : null;
        }

        public function getFlash(){
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }

        public function hasFlash(){
            return isset($_SESSION['flash']);
        }

        public function setFlash($value){
            $_SESSION['flash'] = $value;
        }

        public function isAuthentificated(){
            return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
        }

        public function setAttribute($attribute, $value){
            $_SESSION[$attribute] = $value;
        }

        public function setAuthentificated($authentificated = true){
            if(!is_bool($authentificated))
                return new \InvalidArgumentException('The value specified to the method User::setAuthentificated() must be a boolean.');
            $_SESSION['auth'] = $authentificated;
        }
    }
?>