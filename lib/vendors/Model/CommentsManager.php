<?php
    namespace Model;
    use \BirdyFram\Manager;
    use \Entity\Comment;

    public abstract class CommentsManager extends Manager{
        
        protected abstract function add(Comment $comment);
        
        public function save(Comment $comment){
            if($comment->isValid())
                $comment->isNew() ? $this->add($comment) : $this->udpate($comment);
            else
                throw new \RuntimeException('The comment must be valid to be saved.');
        }

        public abstract function getListOf($news);
        protected abstract function udpate(Comment $comment);
        public abstract function get($id);
        public abstract function delete($id);
        public abstract function deleteFromNews($news);
    }