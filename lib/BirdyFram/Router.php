<?php
    namespace BirdyFram;
    class Router{
        protected $routes = [];
        const NO_ROUTE = 1;

        public function addRoute(Route $route){
            if(!in_array($route, $this->routes))
                $this->routes[] = $route;
        }

        public function getRoute($url){
            foreach($this->routes as $route){
                if(($varsValues = $route->match($url)) !== false){
                    if($route->hasVars()){
                        $varsNames = $route->varsNames();
                        $listVars = [];

                        foreach($varsValues as $key => $match){
                            if($key !== 0)
                                $listVars[$varsNames[$key - 1]] = $match;
                        }
                        $route->setVars($listVars);
                    }
                }
                return $route;
            }
            throw new \RuntimeException('No route is matching the URL', self::NO_ROUTE);
        }
    }
?>