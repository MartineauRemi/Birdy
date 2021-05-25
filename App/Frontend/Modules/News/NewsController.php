<?php
    namespace App\Frontend\Modules\News;

    use \BirdyFram\BackController;
    use \BirdyFram\HTTPRequest;
    use \Entity\Comment;
    use \FormBuilder\CommentFormBuilder;
    use \BirdyFram\FormHandler;

    class NewsController extends BackController{
        public function executeIndex(HTTPRequest $request){
            $newsNb = $this->app->config()->get('news_number');
            $charsNb = $this->app->config()->get('chars_number');

            $this->page->addVar('title', 'List of the ' . $newsNb . ' last news');
            $manager = $this->managers->getManagerOf('News');

            $newsList = $manager->getList(0, $newsNb);
            // foreach($newsList as $news){
            //     if(strlen($news->content()) > $charsNb){
            //         $start = substr($news->content(), 0, $charsNb);
            //         $start = strrpos($start, ' ') ? substr($start, 0, strrpos($start, ' ')) . '...' : $start;
            //         $news->setContent($start);
            //     }
            // }
            $this->page->addVar('newsList', $newsList);
        }

        public function executeShow(HTTPRequest $request){
            $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));
            if(empty($news))
                $this->app->httpResponse()->redirect404();
            
            $this->page->addVar('title', $news->title());
            $this->page->addVar('news', $news);
            $this->page->addVar('comments', $this->managers->getManagerOf('Comments')->getListOf($news->id()));
        }

        public function executeInsertComment(HTTPRequest $request){
            if($request->method() === 'POST'){
                $comment = new Comment([
                    'news' => $request->getData('news'),
                    'author' => $request->postData('author'),
                    'content' => $request->postData('content')
                ]);
            }else
                $comment = new Comment;

            $formBuilder = new FormBuilder($comment);
            $formBuilder->build();

            $form = $formBuilder->form();
            $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);

            if($formHandler->process()){
                $this->app->user()->setFlash('Le commentaire a bien été ajouté.');
                $this->app->httpResponse()->redirect('news-'.$request->getData('news'). '.hmtl');
            }

            $this->page->addVar('title', 'Ajout d\'un commentaire');
            $this->page->addVar('comment', $comment);
            $this->page->addVar('form', $form->createView());
        }
    }