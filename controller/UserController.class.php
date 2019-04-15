<?php
    class UserController extends Controller {
        
        public function __construct($request) 
        {
            parent::__construct($request);
            $this->protection();
        }

        public function defaultAction()
        {
            $view = new View($this, 'home');
            $view->setArg('user',$this->request->getUserObject());
            $view->render();
        }

        public function profile()
        //Appelle la vue qui affiche notre profil
        {
            $v = new View($this,'profile/view');
            $v->setArg('user',$this->request->getUserObject());
            $v->render();
        }

        public function edit()
        //Appelle la vue pour mettre à jour nos informations
        {
            $v = new View($this,'profile/edit');
            $v->setArg('user',$this->request->getUserObject());
            $v->render();
        }

        public function edition()
        //Permet de mettre à jour les informations d'un utilisateur. Fonctionne sur tout les types.
        {
            $login = $this->request->read('inscLogin');
            if(!isset($login))
            {
                $this->linkTo('User','edit'); //Redirection si on tente de forcer l'action
            }
            if(User::isUsed($login,'LOGIN')&&$this->request->getUserObject()->LOGIN!=$login) 
            {
                $view = new View($this,'profile/edit');
                $view->setArg('inscErrorText','This login is already used');
                $view->setArg('user',$this->request->getUserObject());
                $view->render();
                echo("<script>alert('utilisateur existe déjà...');</script>");  
            } 
            else 
            {
                $mdp = $this->request->read('inscPassword');
                $mdpVali = $this->request->read('inscPasswordVali');
                $nom = $this->request->read('nom');
                $prenom = $this->request->read('prenom');
                $mail = $this->request->read('mail');
                /* 
                Les types enseignants et étudiants comportent chacun deux champs spécifiques. 
                Enseignant -> Matricule et Statut
                Etudiant -> Promo et Année de Sortie
                */
                $spe1 = $this->request->read('spe1');
                $spe2 = $this->request->read('spe2');
                if ($mdp==$mdpVali)
                {
                    $user = User::update($this->request->getUserObject()->LOGIN,$this->request->getUserObject()->TYPE_UTILISATEUR,$nom, $prenom, $mail, $spe1, $spe2, $mdp, $login);
                    if(!isset($user)) 
                    {
                        $view = new View($this,'profile/edit');
                        $view->setArg('user',$this->request->getUserObject());
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
                    $view = new View($this,'profile/edit');
                    $view->setArg('inscErrorText', 'Les mots de passe ne correspondent pas');
                    $view->setArg('user',$this->request->getUserObject());
                    $view->render();
                    secho("<script>alert('Les mots de passe ne correspondent pas');</script>");  
                }
            }
        }

        public function aPropos()
        //Appelle la vue qui retournera notre about Us
        {
            $view = new View($this,'apropos');
            $view->setArg('user',$this->request->getUserObject());
            $view->render();
        }

        public function creerQuest(){
            $this->linkTo("Questionnaire"); 
        }

        public function disconnect() {
        //Déconnecte l'utilisateur
            $this->request->unsetUser();
            $this->linkTo(NULL);
        }
    }

?>
