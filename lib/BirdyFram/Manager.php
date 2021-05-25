<?php
    namespace BirdyFram;
    abstract class Manager{
        protected $dao;

        public function __construct($dao){
            $this->dao = $dao;
        }
    }
?>