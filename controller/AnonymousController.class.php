<?php
class AnonymousController extends Controller {
    /*
    Ce contrôleur regroupe l’ensemble des actions pour un utilisateur non connecté.
    */
    
    public function __construct($currentRequest) {
        parent::__construct($currentRequest);
        if(is_object($currentRequest->getUserObject()))
        {
            $this->linkTo('User',NULL); //On empêche la déconnexion par changement d'adresse
        }
    }

    public function Connect($currentRequest){
        //Permet la connexion d'un utilisateur
        $user = User::tryLogin($currentRequest->read('login'),$currentRequest->read('password'));

        if(is_object($user)) {
            $currentRequest->setUser($user->ID);
            $this->linkTo('User');
        }
        else {
            $view = new View($this,'profile/login');
            $view->render();
            echo("<script>alert('C'est pas bon !!');</script>");  
        }
    }
        
    public function defaultAction($currentRequest)
    {
        $view = new View($this);
        $view->render();
    }

    public function aPropos($currentrequest)
    //Appelle la vue qui retournera notre about Us
    {
       $view = new View($this,'apropos');
       $view->render();
    }
        
    public function inscriptionEtu($currentRequest)
    //Appelle la vue qui retournera la page d'inscription
    {
        $view = new View($this,'inscription/inscriptionEtu');
        $view->render();
    }

    public function inscriptionProf($currentRequest)
    //Appelle la vue qui retournera la page d'inscription
    {
        $view = new View($this,'inscription/inscriptionProf');
        $view->render();
    }

    public function login($currentRequest)
    //Appelle la vue qui retourne la page de login
    {
        $view = new View($this,'profile/login');
        $view->render();
    }

    public function validateInscription($request) 
    {
    //Valide l'inscription d'un utilisateur
        $login = $request->read('inscLogin');
        if(User::isLoginUsed($login)) 
        {
            $view = new View($this);
            $view->setArg('inscErrorText','This login is already used');
            $view->render();
            echo("<script>alert('utilisateur existe déjà...');</script>");  
        } 
        else {
            $mdp = $request->read('inscPassword');
            $mdpVali = $request->read('inscPasswordVali');
            $nom = $request->read('nom');
            $prenom = $request->read('prenom');
            $mail = $request->read('mail');
            //Pour les 4 champs suivants, selon les valeurs récupérées, le User::create crééra un étudiant ou un enseignant
            $promo = $request->read('promo');
            $annee = $request->read('anneedesortie');
            $matricule = $request->read('matricule');
            $statut = $request->read('statut');
            if ($mdp==$mdpVali)
            {
                $user = User::create($nom, $prenom, $mail, $matricule, $statut ,$promo, $annee, $mdp, $login);
                if(!isset($user)) {
                    $view = new View($this);
                    $view->setArg('inscErrorText', 'Cannot complete inscription');
                    $view->render();
                } 
                else 
                {
                    $this->linkTo(NULL,'login');
                }
            }
            else
            {
                $view = new View($this);
                $view->setArg('inscErrorText', 'Les mots de passe ne correspondent pas');
                $view->render();
                echo("<script>alert('Les mots de passe ne correspondent pas');</script>");  
            }
        }
    }
}
?>