<?php
    namespace BirdyFram;
    
    class NotNullValidator extends Validator{
        public function isValid($value){
            return $value != '';
        }
    }
?>