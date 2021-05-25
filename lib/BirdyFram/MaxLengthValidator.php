<?php
     namespace BirdyFram;

     class MaxLengthValidator extends Validator{
         protected $maxLength;

         public function __construct($errorMsg, $maxLength){
            parent::__construct($errorMsg);
            $this->setMaxLength($maxLength);
         }

         public function isValid(){
            return strlen($value) <= $this->maxLength;
         }

         public function setMaxLength($maxLength){
            $maxLength = (int) $maxLength;
            if($maxLength > 0)
                $this->maxLength = $maxLength;
            else
                throw new \RuntimeException('The maximum length must be more than 0.');
         }
     }
?>