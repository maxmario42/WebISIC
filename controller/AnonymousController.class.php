<?php
class AnonymousController extends Controller {
    /*
    Ce contrôleur regroupe l’ensemble des actions pour un utilisateur non connecté.
    */
    public function __construct($currentRequest) {
        parent::__construct($currentRequest);  
        if(count($_POST)==5){
            $this -> validateInscription($currentRequest);
        }
        else if (count($_POST)==2){
            $this -> Connect($currentRequest);
        }
    }

    public function Connect($currentRequest){
        $user = User::tryLogin($currentRequest->read('inscLogin'),$currentRequest->read('inscPassword'));


        if(!is_null($user)) {
            $id = $user->ID;
            $newRequest = new Request();
            $newRequest->changeController('User');
            $newRequest->write('User',$id);
            $controller = Dispatcher::dispatch($newRequest);
            $controller -> execute();
        }
        else {
            echo 'Incorrect Password or Login';
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
       //print_r($view); pour tester apres.s
       $view->render();
    }
        
    public function inscription($currentRequest)
    //Appelle la vue qui retournera la page d'inscription
    {
        $view = new View($this,'inscription');
        $view->render();
    }
    public function login($currentRequest)
    //Appelle la vue qui retourne la page de login
    {
        $view = new View($this,'profile/login');
        $view->render();
    }

    public function validateInscription($request) {
        $login = $request->read('inscLogin');
        if(User::isLoginUsed($login)) {
            $view = new View($this,'inscription');
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
            if ($mdp==$mdpVali)
            {
                $user = User::create($nom, $prenom, $mail_etudiant, $mdp, $login);
                if(!isset($user)) {
                    $view = new View($this,'inscription');
                    $view->setArg('inscErrorText', 'Cannot complete inscription');
                    $view->render();
                } 
                else {
                    $newRequest = new Request();
                    $newRequest->changeController('User');
                    $id = $user->ID;
                    $newRequest->write('User',$id);
                    $newRequest->changeAction(null);
                    $controller = Dispatcher::dispatch($newRequest);
                    $controller -> execute();
                }
            }
            else
            {
                $view = new View($this,'inscription');
                $view->setArg('inscErrorText', 'Les mots de passe ne correspondent pas');
                $view->render();
                echo("<script>alert('Les mots de passe ne correspondent pas');</script>");  
            }
        }
    }
}
?>