<?php
    namespace BirdyFram;

    class Page extends ApplicationComponent{
        protected $contentFile;
        protected $vars = [];

        public function addVar($var, $value){
            if(!is_string($var) || is_numeric($var) || empty($var))
                throw new \InvalidArgumentException('The name of the variable must be a non empty string.');
            $this->vars[$var] = $value;
        }

        public function getGeneratedPage(){
            if(!file_exists($this->contentFile))
                throw new \RuntimeException('The specified view doesn\'t exist. ');

            $user = $this->app->user();
            
            extract($this->vars);

            ob_start();
                require $this->contentFile;
            $content = ob_get_clean();

            ob_start();
                require __DIR__ . '/../../App/' . $this->app->name() . '/Templates/layout.php';
            return ob_get_clean();
        }

        public function setContentFile($contentFile){
            if(!is_string($contentFile) || empty($contentFile))
                throw new \InvalidArgumentException('The specified view is not valid.');
            $this->contentFile = $contentFile;
        }
    }
?>