<?php
class AnonymousController extends Controller {
    /*
    Ce contrôleur regroupe l’ensemble des actions pour un utilisateur non connecté.
    */
    
    public function __construct($request) {
        parent::__construct($request);
        if(is_object($request->getUserObject()))
        {
            $this->linkTo('User',NULL); //On empêche la déconnexion par changement d'adresse
        }
    }

    public function Connect(){
        //Permet la connexion d'un utilisateur
        $user = User::tryLogin($this->request->read('login'),$this->request->read('password'));

        if(is_object($user)) { //La connexion réussie
            $this->request->setUser($user->ID);
            $this->linkTo('User');
        }
        else { //Connexion échouée
            $view = new View($this,'profile/login');
            $view->render();
            echo("<script>alert('C'est pas bon !!');</script>");  
        }
    }
        
    public function defaultAction()
    //Page d'acceuil
    {
        $view = new View($this);
        $view->render();
    }

    public function aPropos()
    //Appelle la vue qui retournera notre about Us
    {
       $view = new View($this,'apropos');
       $view->render();
    }
        
    public function inscriptionEtu()
    //Appelle la vue qui retournera la page d'inscription pour Etudiant
    {
        $view = new View($this,'inscription/inscriptionEtu');
        $view->render();
    }

    public function inscriptionProf()
    //Appelle la vue qui retournera la page d'inscription pour Enseignant
    {
        $view = new View($this,'inscription/inscriptionProf');
        $view->render();
    }

    public function login()
    //Appelle la vue qui retourne la page de login
    {
        $view = new View($this,'profile/login');
        $view->render();
    }

    public function validateInscription() 
    {
    //Valide l'inscription d'un utilisateur
        $login = $this->request->read('inscLogin');
        if(!isset($login))
        {
            $this->linkTo(NULL); //Empêche de forcer l'action
        }
        if(User::isUsed($login,'LOGIN')) //On veut éviter un doublon
        {
            $view = new View($this);
            $view->setArg('inscErrorText','Login utilisé');
            $view->render();
            echo("<script>alert('utilisateur existe déjà...');</script>");  
        } 
        else {
            $mdp = $this->request->read('inscPassword');
            $mdpVali = $this->request->read('inscPasswordVali');
            $nom = $this->request->read('nom');
            $prenom = $this->request->read('prenom');
            $mail = $this->request->read('mail');
            //Pour les 4 champs suivants, selon les valeurs récupérées, le User::create crééra un étudiant ou un enseignant. 
            //2 de ces 4 champs seront nécéssairements vides.
            $promo = $this->request->read('promo');
            $annee = $this->request->read('anneedesortie');
            $matricule = $this->request->read('matricule');
            $statut = $this->request->read('statut');
            if ($mdp==$mdpVali)
            {
                $user = User::create($nom, $prenom, $mail, $matricule, $statut ,$promo, $annee, $mdp, $login); //Que ce soit un prof ou un étudiant
                if(!isset($user)) {
                    $view = new View($this);
                    $view->setArg('inscErrorText', 'Inscription impossible');
                    $view->render();
                } 
                else 
                {
                    $this->linkTo(NULL,'login'); //On va vers la page de login si l'inscription a réussi
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

    public function questionnaires()
    {
        //Affichage des questionnaires
        $questionnaires = Questionnaire::getAll();
        if (!isset($questionnaires)) {
            throw new Error("Problème d'accès aux questionnaires", 500);
        }
        $view = new View($this, 'participer/listQuestionnaire');
        $view->setArg('questionnaires', $questionnaires);
        $view->render();
    }
}
?>