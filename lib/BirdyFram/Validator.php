<?php
    namespace BirdyFram;

    abstract class Validator{
        protected $errorMsg;

        public function __construct($errorMsg){
            $this->setErrorMsg($errorMsg);
        }

        public abstract function isValid($value);

        public function setErrorMsg($errorMsg){
            if(is_string($errorMsg))
                $this->errorMsg = $errorMsg;
        }

        public function errorMsg(){
            return $this->errorMsg;
        }
    }
?>