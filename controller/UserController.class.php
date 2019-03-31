<?php
    class UserController extends Controller {
        
        protected $user;
        
        public function __construct($request) 
        {
            parent::__construct($request);
            $userId = Request::getUser();
            if(!isset($userId))
            {
                header("Location: index.php"); //On empêche l'accès aux personnes non connectées
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

        public function editionEtu($request)
        {
            $login = $request->read('inscLogin');
            if(User::isLoginUsed($login)&&$this->user->LOGIN!=$login) 
            {
                $view = new UserView($this,'profile/edit',array('user' => $this->user));
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
                $promo = $request->read('promo');
                $annee = $request->read('anneedesortie');
                if ($mdp==$mdpVali)
                {
                    $user = User::updateEtu($this->user->LOGIN,$nom, $prenom, $mail_etudiant, $promo, $annee, $mdp, $login);
                    if(!isset($user)) 
                    {
                        $view = new UserView($this,'profile/edit',array('user' => $this->user));
                        $view->setArg('inscErrorText', 'Cannot complete inscription');
                        $view->render();
                } 
                    else 
                    {
                    header("Location:index.php?controller=User&action=profile");
                    }
                }
                else
                {
                    $view = new UserView($this,'profile/edit',array('user' => $this->user));
                    $view->setArg('inscErrorText', 'Les mots de passe ne correspondent pas');
                    $view->render();
                    secho("<script>alert('Les mots de passe ne correspondent pas');</script>");  
                }
            }
        }
    
        public function editionProf($request)
        {
            $login = $request->read('inscLogin');
            if(User::isLoginUsed($login)&&$this->user->LOGIN!=$login) 
            {
                $view = new UserView($this,'profile/edit',array('user' => $this->user));
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
                $mail_prof = $request->read('mail');
                $matricule = $request->read('matricule');
                $statut = $request->read('statut');
                if ($mdp==$mdpVali)
                {
                    $user = User::updateProf($this->user->LOGIN,$nom, $prenom, $mail_prof, $matricule, $statut, $mdp, $login);
                    if(!isset($user)) 
                    {
                        $view = new UserView($this,'profile/edit',array('user' => $this->user));
                        $view->setArg('inscErrorText', 'Cannot complete inscription');
                        $view->render();
                } 
                    else 
                    {
                    header("Location:index.php?controller=User&action=profile");
                    }
                }
                else
                {
                    $view = new UserView($this,'profile/edit',array('user' => $this->user));
                    $view->setArg('inscErrorText', 'Les mots de passe ne correspondent pas');
                    $view->render();
                    secho("<script>alert('Les mots de passe ne correspondent pas');</script>");  
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
        //Déconnecte l'utilisateur
            Request::unsetUser();
            header("Location: index.php");
        }
    }

?>
