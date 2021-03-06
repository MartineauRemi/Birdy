<?php
    namespace BirdyFram;

    abstract class FormBuilder{
        protected $form;

        public function __construct(Entity $entity){
            $this->setForm(new Form($entity));
        }

        public abstract function build();

        public function setForm(Form $form){
            $this->form = $form;
        }

        public function form(){
            return $this->form;
        }
    }