<?php
    namespace BirdyFram;
    
    class Managers extends ApplicationComponent{
        protected $api = null;
        protected $dao = null;
        protected $managers = [];

        public function __construct($api, $dao){
            $this->api = $api;
            $this->dao = $dao;
        }

        public function getManagerOf($module){
            if(!is_string($module) || empty($module))
                throw new \InvalidArgumentException('The specified module is invalid.');
            if(!isset($this->managers[$module])){
                $manager = '\\Model\\' . $module.'Manager'.$this->api;
                $this->managers[$module] = new $manager($this->dao);
            }
            return $this->managers[$module];
        }
    }
?>