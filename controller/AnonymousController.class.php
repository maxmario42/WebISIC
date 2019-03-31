<?php
class AnonymousController extends Controller {
    /*
    Ce contrôleur regroupe l’ensemble des actions pour un utilisateur non connecté.
    */
    
    public function __construct($currentRequest) {
        parent::__construct($currentRequest);
        $userId = Request::getUser();
        if(isset($userId))
        {
            header("Location: index.php?controller=User"); //On empêche la déconnexion par changement d'adresse
        }
    }

    public function Connect($currentRequest){
        //Permet la connexion d'un utilisateur
        $user = User::tryLogin($currentRequest->read('login'),$currentRequest->read('password'));

        if(is_object($user)) {
            Request::setUser($user->ID);
            header("Location:index.php?controller=User");
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
    //Appelle la vue qui retournera la page d'inscription Etudiant
    {
        $view = new View($this,'profile/inscriptionEtu');
        $view->render();
    }
    public function inscriptionProf($currentRequest)
    //Appelle la vue qui retournera la page d'inscription Prof
    {
        $view = new View($this,'profile/inscriptionProf');
        $view->render();
    }
    public function login($currentRequest)
    //Appelle la vue qui retourne la page de login
    {
        $view = new View($this,'profile/login');
        $view->render();
    }

    /*
    Actions d'inscriptions
    */

    public function validateInscriptionEtu($request) {
    //Valide l'inscription d'un étudiant
        $login = $request->read('inscLogin');
        if(User::isLoginUsed($login)) 
        {
            $view = new View($this,'profile/inscriptionEtu');
            $view->setArg('inscErrorText','This login is already used');
            $view->render();
            echo("<script>alert('utilisateur existe déjà...');</script>");  
        } 
        else {
            $mdp = $request->read('inscPassword');
            $mdpVali = $request->read('inscPasswordVali');
            $nom = $request->read('nom');
            $prenom = $request->read('prenom');
            $mail_etudiant = $request->read('mail');
            $promo = $request->read('promo');
            $annee = $request->read('anneedesortie');
            if ($mdp==$mdpVali)
            {
                $user = User::createEtu($nom, $prenom, $mail_etudiant, $promo, $annee, $mdp, $login);
                if(!isset($user)) {
                    $view = new View($this,'profile/inscriptionEtu');
                    $view->setArg('inscErrorText', 'Cannot complete inscription');
                    $view->render();
                } 
                else 
                {
                    header("Location:index.php?action=login");
                }
            }
            else
            {
                $view = new View($this,'profile/inscriptionEtu');
                $view->setArg('inscErrorText', 'Les mots de passe ne correspondent pas');
                $view->render();
                echo("<script>alert('Les mots de passe ne correspondent pas');</script>");  
            }
        }
    }
    public function validateInscriptionProf($request) {
    //Valide l'inscription d'un prof
        $login = $request->read('inscLogin');
        if(User::isLoginUsed($login)) 
        {
            $view = new View($this,'profile/inscriptionProf');
            $view->setArg('inscErrorText','This login is already used');
            $view->render();
            echo("<script>alert('utilisateur existe déjà...');</script>");  
        } 
        else {
            $mdp = $request->read('inscPassword');
            $mdpVali = $request->read('inscPasswordVali');
            $nom = $request->read('nom');
            $prenom = $request->read('prenom');
            $mail_prof = $request->read('mail');
            $matricule = $request->read('matricule');
            $statut = $request->read('statut');
            if ($mdp==$mdpVali)
            {
                $user = User::createProf($nom, $prenom, $mail_prof, $matricule, $statut, $mdp, $login);
                if(!isset($user)) {
                    $view = new View($this,'profile/inscriptionProf');
                    $view->setArg('inscErrorText', 'Cannot complete inscription');
                    $view->render();
                } 
                else 
                {
                    header("Location:index.php?action=login");
                }
            }
            else
            {
                $view = new View($this,'profile/inscriptionProf');
                $view->setArg('inscErrorText', 'Les mots de passe ne correspondent pas');
                $view->render();
                echo("<script>alert('Les mots de passe ne correspondent pas');</script>");  
            }
        }
    }
}
?>