<?php
    namespace BirdyFram;

    abstract class BackController extends ApplicationComponent{
        protected $action = '';
        protected $module = '';
        protected $view = '';
        protected $page = null;
        protected $managers = null;

        public function __construct(Application $app, $module, $action){
            parent::__construct($app);

            $this->managers = new Managers('PDO', PDOFactory::getMysqlConnexion());
            $this->page = new Page($app);
            
            $this->setModule($module);
            $this->setAction($action);
            $this->setView($action);
        }

        public function execute(){
            $method = 'execute' . ucfirst($this->action);
            
            if(!is_callable([$this, $method])){
                throw new \RuntimeException('The action ' . $this->action . ' is not defined on this module.');
            }

            $this->$method($this->app->httpRequest());
        }

        public function page(){
            return $this->page;
        }

        public function setModule($module){
            if(!is_string($module) || empty($module))
                throw new \InvalidArgumentException('The action must be a valid string.');
            $this->module = $module;
        }

        public function setAction($action){
            if(!is_string($action) || empty($action))
                throw new \InvalidArgumentException('The action must be a valid string.');
            $this->action = $action;
        }

        public function setView($view){
            if(!is_string($view) || empty($view))
                throw new \InvalidArgumentException('The action must be a valid string.');
            $this->view = $view;

            $this->page->setContentFile(__DIR__ . '/../../App/' . $this->app->name() . '/Modules/' . $this->module . '/Views/' . $this->view . '.php');
        }
    }
?>