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

        public function edition($request)
        //Permet de mettre à jour les informations d'un utilisateur. Fonctionne sur tout les types.
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
                /* 
                Les types enseignants et étudiants comportent chacun deux champs spécifiques. 
                Enseignant -> Matricule et Statut
                Etudiant -> Promo et Année de Sortie
                */
                $spe1 = $request->read('spe1');
                $spe2 = $request->read('spe2');
                if ($mdp==$mdpVali)
                {
                    $user = User::update($this->user->LOGIN,$this->user->TYPE_UTILISATEUR,$nom, $prenom, $mail_etudiant, $spe1, $spe2, $mdp, $login);
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
