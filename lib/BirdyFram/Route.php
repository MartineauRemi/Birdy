<?php
    namespace BirdyFram;
    class Route{
        protected $action;
        protected $module;
        protected $url;
        protected $varsNames;
        protected $vars = [];

        public function __construct($url,$module,$action, array $varsNames){
            $this->setAction($action);
            $this->setModule($module);
            $this->setUrl($url);
            $this->setVarsNames($varsNames);
        }

        public function hasVars(){
            return !empty($this->varsNames);
        }

        public function match($url){
            preg_match('`^' . $this->url . '$`', $url, $matches) ? $matches : false;
        }

        public function setAction($action){
            if(is_string($action))
                $this->action = $action;
        }

        public function setModule($module){
            if(is_string($module))
                $this->module = $module;
        }

        public function setUrl($url){
            if(is_string($url))
                $this->url = $url;
        }

        public function setVarsNames(array $varsNames){
            $this->varsNames = $varsNames;
        }

        public function setVars(array $vars){
            $this->vars = $vars;
        }

        public function action(){
            return $this->action;
        }

        public function module(){
            return $this->module;
        }

        public function vars(){
            return $this->vars;
        }

        public function varsNames(){
            return $this->varsNames;
        }

        public function url(){
            return $this->url;
        }

    }