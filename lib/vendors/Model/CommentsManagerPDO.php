<?php
    namespace Model;
    use \Entity\Comment;

    class CommentsManagerPDO extends CommentsManager{
        protected function add(Comment $comment){
            $request = $this->dao->prepare(
                'INSERT INTO comments SET news = ?, author = ?, content = ?, date = NOW()'
                ,[$comment->news(), $comment->author(), $comment->content()]);

            $request->execute();
            $comment->setId($this->dao->lastInsertId());
        }

        public function getListOf($news){
            if(!ctype_digit($news))
                throw new \InvalidArgumentException('The news id must be a valid integer.');

            $request = $this->dao->prepare('SELECT * FROM comments WHERE news = ?', [$news]);
            $request->execute();
            $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

            $comments = $request->fetchAll();
            foreach($comments as $comment)
                $comment->setDate(new \DateTime($comment->date()));

            return $comments;
        }

        protected function update(Comment $comment){
            $request = $this->dao->prepare(
                'UPDATE comments SET author = ?, content = ? WHERE id = ?',
                [$comment->author(), $comment->content(), $comment->id()]);
            $request->execute();
        }

        public function delete($id){
            $this->dao->exec('DELETE FROM comments WHERE id = ' . (int)$id);
        }

        public function deleteFromNews($news){
            $this->dao->exec('DELETE FROM comments WHERE news = ' . (int)$news);
        }

        public function get($id){
            $request = $this->dao->prepare('SELECT * FROM comments WHERE id = ?', [(int)$id]);
            $request->execute();
            $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
            return $request->fetch();
        }
    }
?>