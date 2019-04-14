<?php
    class UserController extends Controller {
        
        public function __construct($request) 
        {
            parent::__construct($request);
            $this->protection();
        }

        public function defaultAction($request)
        {
            $view = new UserView($this, 'home');
            $view->setArg('user',$request->getUserObject());
            $view->render();
        }

        public function profile($request)
        //Appelle la vue qui affiche notre profil
        {
            $v = new UserView($this,'profile/view');
            $v->setArg('user',$request->getUserObject());
            $v->render();
        }

        public function edit($request)
        //Appelle la vue pour mettre à jour nos informations
        {
            $v = new UserView($this,'profile/edit');
            $v->setArg('user',$request->getUserObject());
            $v->render();
        }

        public function edition($request)
        //Permet de mettre à jour les informations d'un utilisateur. Fonctionne sur tout les types.
        {
            $login = $request->read('inscLogin');
            if(!isset($login))
            {
                $this->linkTo('User','edit'); //Redirection si on tente de forcer l'action
            }
            if(User::isUsed($login,'LOGIN')&&$request->getUserObject()->LOGIN!=$login) 
            {
                $view = new UserView($this,'profile/edit');
                $view->setArg('inscErrorText','This login is already used');
                $view->setArg('user',$request->getUserObject());
                $view->render();
                echo("<script>alert('utilisateur existe déjà...');</script>");  
            } 
            else 
            {
                $mdp = $request->read('inscPassword');
                $mdpVali = $request->read('inscPasswordVali');
                $nom = $request->read('nom');
                $prenom = $request->read('prenom');
                $mail = $request->read('mail');
                /* 
                Les types enseignants et étudiants comportent chacun deux champs spécifiques. 
                Enseignant -> Matricule et Statut
                Etudiant -> Promo et Année de Sortie
                */
                $spe1 = $request->read('spe1');
                $spe2 = $request->read('spe2');
                if ($mdp==$mdpVali)
                {
                    $user = User::update($request->getUserObject()->LOGIN,$request->getUserObject()->TYPE_UTILISATEUR,$nom, $prenom, $mail, $spe1, $spe2, $mdp, $login);
                    if(!isset($user)) 
                    {
                        $view = new UserView($this,'profile/edit');
                        $view->setArg('user',$request->getUserObject());
                        $view->setArg('inscErrorText', 'Cannot complete inscription');
                        $view->render();
                } 
                    else 
                    {
                        $this->linkTo('User','profile'); //Modification réussie
                    }
                }
                else
                {
                    $view = new UserView($this,'profile/edit');
                    $view->setArg('inscErrorText', 'Les mots de passe ne correspondent pas');
                    $view->setArg('user',$request->getUserObject());
                    $view->render();
                    secho("<script>alert('Les mots de passe ne correspondent pas');</script>");  
                }
            }
        }

        public function aPropos($request)
        //Appelle la vue qui retournera notre about Us
        {
            $view = new UserView($this,'apropos');
            $view->setArg('user',$request->getUserObject());
            $view->render();
        }

        public function creerQuest($request){
            $this->linkTo("Questionnaire"); 
        }

        public function disconnect($request) {
        //Déconnecte l'utilisateur
            $request->unsetUser();
            $this->linkTo(NULL);
        }
    }

?>
