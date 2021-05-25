<?php
    namespace \App\Backend\Modules\Connexion;
    use \BirdyFram\BackController;
    use \BirdyFram\HTTPRequest;

    class ConnexionController extends BackController{
        public function executeIndex(HTTPRequest $request){
            $this->page->addVar('title', 'Connexion');

            if($request->postExists('login')){
                $login = $request->postData('login');
                $pwd = $request->postData('password');

                if($login == $this->app->config()->get('login') && $pwd == $this->app->config()->get('pwd')){
                    $this->app->user()->setAuthentificated(true);
                    $this->app->httpResponse()->redirect('.');
                }else
                    $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect.');
            }
        }
    }
?>