<?php
    namespace App\Frontend;
    use \BirdyFram\Application;

    class FrontendApplication extends Application{
        public function __construct(){
            parent::__construct();
            $this->name = 'Frontend';
        }

        public function run(){
            // echo substr($this->httpRequest()->requestURI(), 10);
            $controller = $this->getController();
            $controller->execute();

            $this->httpResponse->setPage($controller->page());
            $this->httpResponse->send();
        }
    }
?>