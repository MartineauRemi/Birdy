<?php
    namespace BirdyFram;

    class HTTPRequest extends ApplicationComponent{
        public function __construct(Application $app){
            parent::__construct($app);
        }
        
        public function getExists($key){
            return isset($_GET[$key]);
        }
        public function getData($key){
            return isset($_GET[$key])? $_GET[$key] : null;
        }

        public function postExists($key){
            return isset($_POST[$key]);
        }

        public function postData($key){
            return isset($_POST[$key])? $_POST[$key] : null;
        }

        public function cookieExists($key){
            return isset($_COOKIE[$key]);
        }

        public function cookieData($key){
            return isset($_COOKIE[$key])? $_COOKIE[$key] : null;
        }

        public function requestURI(){
            return $_SERVER['REQUEST_URI'];
        }

        public function method(){
            return $_SERVER['REQUEST_METHOD'];
        }
    }