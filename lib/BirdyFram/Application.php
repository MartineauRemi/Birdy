<?php
    namespace BirdyFram;

    abstract class Application{
        protected $httpRequest;
        protected $httpResponse;
        protected $name;
        protected $config;
        protected $user;

        public function __construct(){
            $this->httpRequest = new HTTPRequest($this);
            $this->httpResponse = new HTTPResponse($this);
            $this->config = new Config($this);
            $this->user = new User($this);
            $this->name = '';
        }

        public abstract function run();

        public function httpRequest(){
            return $this->httpRequest;
        }

        public function httpResponse(){
            return $this->httpResponse;
        }

        public function name(){
            return $this->name;
        }

        public function config(){
            return $this->config;
        }

        public function user(){
            return $this->user;
        }

        public function getController(){
            $router = new Router;
            $xml = new \DOMDocument;
            $xml->load(__DIR__. '/../../App/' . $this->name . '/Config/routes.xml');
            
            $routes = $xml->getElementsByTagName('route');
            foreach($routes as $route){
                $vars = [];
                if($route->hasAttribute('vars'))
                    $vars = explode(',', $route->getAttribute('vars'));
                $router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars));
            }

            try{
                $matchedRoute = $router->getRoute(substr($this->httpRequest->requestURI(), 10));
            }catch(\RuntimeException $e){
                if($e->getCode() === Router::NO_ROUTE)
                    $this->httpResponse->redirect404();
            }

            $_GET = array_merge($_GET, $matchedRoute->vars());
            $controllerClass = 'App\\'.$this->name.'\\Modules\\' . $matchedRoute->module() . '\\' . $matchedRoute->module() . 'Controller';
            return new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action()); 
        }
    }
?>