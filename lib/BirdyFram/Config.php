<?php
    namespace BirdyFram;

    class Config extends ApplicationComponent{
        protected $vars = [];

        public function get($var){
            if(!$this->vars){
                $xml = new \DOMDocument;
                $xml->load(__DIR__ . '/../../App/' . $this->app->name() . '/Config/app.xml');

                $elements = $xml->getElementsByTagName('define');

                foreach($elements as $elt)
                    $this->vars[$elt->getAttribute('var')] = $elt->getAttribute('value');
                return isset($this->vars[$var])? $this->vars[$var] : null;
            }
        }
    }