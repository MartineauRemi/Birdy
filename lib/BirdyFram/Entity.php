<?php
    namespace BirdyFram;

    abstract class Entity implements \ArrayAccess{
        protected $errors = [];
        protected $id;

        public function __construct(array $data = []){
            if(!empty($data))
                $this->hydrate($data);
        }

        use Hydrator;

        public function isNew(){
            return empty($this->id);
        }

        public function errors(){
            return $this->errors;
        }

        public function id(){
            return $this->id;
        }

        public function setId($id){
            $this->id = (int) $id;
        }

        public function offsetGet($var){
            if(isset($this->$var) && is_callable([$this, $var]))
                return $this->$var();
        }

        public function offsetSet($var, $value){
            $method = 'set' . ucfirst($var);

            if(isset($this->$var) && is_callable([$this, $method]))
                $this->method($value);
        }

        public function offsetExists($var){
            return isset($this->$var) && is_callable([$this, $var]);
        }

        public function offsetUnset($var){
            throw new \Exception('Can\'t delete any value.');
        }
    }
?> 