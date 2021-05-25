<?php
    namespace \App\Backend;
    use \BirdyFram\Application;
    use \App\Backend\Modules\Connexion\ConnexionController;

    class BackendApplication extends Application{
        public function __construct(){
            parent::__construct();
            $this->name = 'Backend';
        }

        public function run(){
            if($this->user->isAuthentificated())
                $controller = $this->getController();
            else
                $controller = new ConnexionController($this, 'Connexion', 'index');
            
            $controller->execute();
            $this->httpResponse->setPage($controller->page);
            $this->httpResponse->send();
        }
    }
?>