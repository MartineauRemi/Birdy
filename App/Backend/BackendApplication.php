<?php
    namespace \App\Backend;
    use \BirdyFram\Application;

    class BackendApplication extends Application{
        public function __construct(){
            parent::__construct();
            $this->name = 'Backend';
        }

        public function run(){
            if($this->user->isAuthentificated())
                $controller = $this->getController();
            else
                $controller = new Modules\Connexion\ConnexionController($this, 'Connexion', 'index');
            
            $controller->execute();
            $this->httpResponse->setPage($controller->page());
            $this->httpResponse->send();
        }
    }
?>