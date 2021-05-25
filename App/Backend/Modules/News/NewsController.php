<?php
    namespace \App\Backend\Modules\News;

    use \BirdyFram\HTTPRequest;
    use \BirdyFram\BackController;
    use \Entity\News;
    use \Entity\Comment;
    use \FormBuilder\NewsFormBuilder;
    use \FormBuilder\CommentFormBuilder;
    use \BirdyFram\FormHandler;

    class NewsController extends BackController{
        public function executeIndex(HTTPRequest $request){
            $this->page->addVal('title', 'Gestion des news');
            
            $manager = $this->managers->getManagerOf('News');
            $this->page->addVar('newsList', $manager->getList());
            $this->page->addVar('newsNumber', $manager->count());
        }

        public function executeInsert(HTTPRequest $request){
            $this->processForm($request);
            $this->page->addVar('title', 'Add a news');
        }

        public function executeUpdate(HTTPRequest $request){
            $this->processForm($request);
            $this->page->addVar('title', 'News update');
        }

        public function executeDelete(HTTPRequest $request){
            $newsId = $request->getData('id');
            $this->managers->getManagerOf('News')->delete($newsId);
            $this->managers->getManagerOf('Comments')->deleteFromNews($newsId);
            $this->app->user()->setFlash('The news has been successfully deleted.');
            $this->app->httpResponse->redirect('.');
        }

        public function executeUpdateComment(HTTPRequest $request){
            $this->page->addVar('title', 'Comment modification');

            if($request->method() === 'POST'){
                $comment = new Comment([
                    'id' => $request->getData('id'),
                    'author' => $request->postData('author'),
                    'content' => $request->postData('content')
                ]);
            }else
                $comment = $this->managers->getManagerOf('Comments')->get($request->getData('id');

            $formBuilder = new FormBuilder($comment);
            $formBuilder->build();
            $form = $formBuilder->form();
            $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);

            if($formHandler->process()){
                $this->app->user()->setFlash('The comment has been added successfully.');
                $this->app->httpResponse()->redirect('/admin/');
            }

            $this->page->addVar('form', $form->createView());
        }

        public function executeDeleteComment(HTTPRequest $request){
            $this->managers->getManagerOf('Comments')->delete($request->getData('id'));
            $this->app->user()->setFlash('The comment has been successfully deleted.');
            $this->app->httpResponse()->redirect('.');
        }

        public function processForm(HTTPRequest $request){

            if($request->method() === 'POST'){
                $news = new News([
                    'author' => $request->postData('author'),
                    'title' => $request->postData('title'),
                    'content' => $request->postData('content')
                ]);

                if($request->getExists('id'))
                    $news->setId($request->getData('id'));
            }else{
                if($request->getExists('id'))
                    $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));
                else
                    $news = new News;
            }
            $formBuilder = new NewsFormBuilder($news);
            $formBuilder->build();
            $form = $formBuilder->form();
            $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);

            if($formHandler->process()){
              $this->app->user()->setFlash('The news has been successfully ' . $news->isNew() ? 'added.' : 'modified.');
              $this->app->httpResponse()->redirect('/admin/');
            }
        
            $this->page->addVar('form', $form->createView());
        }
    }
?>