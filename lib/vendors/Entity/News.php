<?php
    namespace Entity;
    use \BirdyFram\Entity;

    class News extends Entity{
        protected $author;
        protected $content;
        protected $title;
        protected $creationDate;
        protected $updateDate;

        const INVALID_AUTHOR = 1;
        const INVALID_TITLE = 2;
        const INVALID_CONTENT = 3;

        public function isValid(){
            return !(empty($this->author) || empty($this->title) || empty($this->content));
        }

        public function setAuthor($author){
            if(!is_string($author) || empty($author))
                $this->errors[] = self::INVALID_AUTHOR;
            $this->author = $author;
        }

        public function setTitle($title){
            if(!is_string($title) || empty($title))
                $this->errors[] = self::INVALID_TITLE;
            $this->title = $title;
        }

        public function setContent($content){
            if(!is_string($content) || empty($content))
                $this->errors[] = self::INVALID_CONTENT;
            $this->content = $content;
        }

        public function setCreationDate($creationDate){
            $this->creationDate = $creationDate;
        }

        public function setUpdateDate($updateDate){
            $this->udpateDate = $updateDate;
        }

        public function author(){
            return $this->author;
        }

        public function title(){
            return $this->title;
        }

        public function content(){
            return $this->content;
        }

        public function creationDate(){
            return $this->creationDate;
        }

        public function updateDate(){
            return $this->updateDate;
        }
    }