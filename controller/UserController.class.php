<?php
    class UserController extends Controller {
        
        protected $user;
        
        public function __construct($request) 
        {
            parent::__construct($request);
            $userId = Request::getUser();
            if(!isset($userId))
            {
                header("Location: index.php");
            }
            $this->user = User::getWithId($userId);
        }

        public function defaultAction($request)
        {
            $view = new UserView($this, 'home',array('user' => $this->user));
            $view->render();
        }

        public function profile($request)
        //Appelle la vue qui affiche notre profil
        {
            $v = new UserView($this,'profile/view', array('user' => $this->user));
            $v->render();
        }

        public function edit($request)
        //Appelle la vue pour mettre à jour nos informations
        {
            $v = new UserView($this,'profile/edit', array('user' => $this->user));
            $v->render();
        }

        public function edition($request)
        {
            $login = $request->read('inscLogin');
            if(User::isLoginUsed($login)) 
            {
                $view = new UserView($this,'profile/edit', array('user' => $this->user));
                $view->setArg('inscErrorText','This login is already used');
                $view->render();
                echo("<script>alert('utilisateur existe déjà...');</script>");  
            } 
            else 
            {
                $mdp = $request->read('inscPassword');
                $mdpVali = $request->read('inscPasswordVali');
                $nom = $request->read('nom');
                $prenom = $request->read('prenom');
                $mail_etudiant = $request->read('mail');
                if ($mdp==$mdpVali)
                {
                    $user = User::update($this->user->LOGIN,$nom, $prenom, $mail_etudiant, $mdp, $login);
                    if(!isset($user)) 
                    {
                        $view = new UserView($this,'profile/edit', array('user' => $this->user));
                        $view->setArg('inscErrorText', 'Cannot edit information');
                        $view->render();
                    } 
                    else 
                    {
                        $view = new UserView($this,'home', array('user' => $user));
                        $view->render();
                    }
                }   
                else
                {
                    $view = new UserView($this,'profile/edit', array('user' => $this->user));
                    $view->setArg('inscErrorText', 'Les mots de passe ne correspondent pas');
                    $view->render();
                    echo("<script>alert('Les mots de passe ne correspondent pas');</script>");  
                }
            }
        }

        public function aPropos($request)
        //Appelle la vue qui retournera notre about Us
        {
            $view = new UserView($this,'apropos', array('user' => $this->user), array('user' => $this->user));
            $view->render();
        }

        public function disconnect($request) {
            Session::getInstance()->destroy();
            header("Location: index.php");
        }
    }

?>
