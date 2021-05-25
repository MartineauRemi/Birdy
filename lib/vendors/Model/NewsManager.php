<?php
    namespace Model;
    use \BirdyFram\Manager;
    use \Entity\News;

    abstract class NewsManager extends Manager{
        public abstract function getList($start=-1, $limit=-1);
        public abstract function getUnique($id);
        public abstract function count();
        public abstract function add(News $news);
        public abstract function update(News $news);
        public abstract function delete($id);
        
        public function save(News $news){
            if($news->isValid())
                $news->isNew()? $this->add($news) : $this->update($news);
            else
                throw new \RuntimeException('The news must be valid to be saved.');
        }
    }