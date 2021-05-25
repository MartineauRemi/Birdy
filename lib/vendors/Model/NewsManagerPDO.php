<?php
    namespace Model;
    use \Entity\News;

    class NewsManagerPDO extends NewsManager{
        public function add(News $news){
            $request = $this->dao->prepare(
                'INSERT INTO news SET author = ?, title = ?, content = ?, creationDate = NOW(), updateDate = NOW()',
                [$news->author(), $news->title(), $news->content()]);

            $request->execute();
        }
        
        public function update(News $news){
            $request = $this->dao->prepare(
                'UDPATE news SET author = ?, title = ?, content = ?, updateDate = NOW() WHERE id = ?',
                [$news->author, $news->title, $news->content, (int)$news->id]);
            $request->execute();
        }

        public function delete($id){
            $request = $this->dao->prepare('DELETE FROM news WHERE id = ?', [(int)$id]);
        }

        public function getList($start=-1, $limit=-1){
            $sql = 'SELECT * FROM news ORDER BY id DESC';

            if($start !== -1 || $limit !== -1)
                $sql .= " LIMIT " . (int)$limit . " OFFSET " . (int)$start;
            
            $request = $this->dao->query($sql);
            $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');

            $newsList = $request->fetchAll();
            foreach($newsList as $news){
                $news->setCreationDate(new \DateTime($news->creationDate()));
                $news->setUpdateDate(new \DateTime($news->updateDate()));
            }

            $request->closeCursor();
            return $newsList;
        }

        public function getUnique($id){
            $request = $this->dao->prepare('SELECT * FROM news WHERE id = ?', [$id]);
            $request->execute();
            $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');
            
            if($news = $request->fetch()){
                $news->setCreationDate(new DateTime($news->creationDate()));
                $news->setUpdateDate(new DateTime($news->updateDate()));
                return $news;
            }

            return null;
        }

        public function count(){
            return $this->dao->query('SELECT COUNT(*) FROM news')->fetchColumn();
        }
    }
?>