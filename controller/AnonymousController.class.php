<?php
class AnonymousController extends Controller {
    
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
            $id = $user->__get('ID');
            //var_dump($id);
            $newRequest = new Request();
            $newRequest->changeController('User');
            $newRequest->write('User',$id);
            //print_r($_POST);
            //echo($user->id());
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
    {
        $view = new View($this,'inscription');
        $view->render();
    }
    public function login($currentRequest)
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
            $nom = $request->read('nom');
            $prenom = $request->read('prenom');
            $mail_etudiant = $request->read('mail');
            $user = User::create($nom, $prenom, $mail_etudiant, $mdp, $login);
            if(!isset($user)) {
                $view = new View($this,'inscription');
                $view->setArg('inscErrorText', 'Cannot complete inscription');
                $view->render();
            } 
            else {
                
                
                $newRequest = new Request();
                $newRequest->changeController('User');
                //print_r($req);
                //$user->getId($login);
                $id = $user->__get('ID');
               // var_dump($id);
                $newRequest->write('User',$id);
                $newRequest->changeAction(null);
               // print_r($newRequest);
                //echo($user->id());
                $controller = Dispatcher::dispatch($newRequest);
                $controller -> execute();
            }
        }
    }
}
?>

<?php
/*
class AnonymousController extends Controller
//Ce contrôleur regroupe l’ensemble des actions pour un utilisateur non connecté.
{
    public function defaultAction($request)
    //Appelle la vue qui retournera la bonne réponse ou affichera la bonne chose
    { //echo "Hello world";
       $view = new View($this);
       //print_r($view); pour tester apres.s
       $view->render();
    }

    public function aProposAction($request)
    //Appelle la vue qui retournera notre about Us
    { //echo "Hello world";
       $view = new View($this,'apropos');
       //print_r($view); pour tester apres.s
       $view->render();
    }
   
    
    public function inscriptionAction($request){
       $view = new View($this,'inscription');
       $view->render();  
    }

    public function loginAction($request)
    {
      $view = new View($this,'profile/login');
      $view->render();
    }

    public function validateloginAction()
    {
        if ($this->request->getUser()!=null) {
            $this->redirect(Router::path('profile/login'));
        } else {
            if ($this->request->isPost()) {
                $login = $this->request->POST('inscLogin');
                $password = $this->request->POST('inscPassword');
                $user = User::findOneBy(array('LOGIN' => $login));
                if ($user->getPassword() == $password) {
                    $this->request->setUser($user);
                    $this->redirect(Router::path('profile/login'));
                } else {
                    $view = new View($this, 'profile/login');
                }
            } else {
                $view = new View($this, 'profile/login');
            }
        }
        $view->render();
    }

    public function validateInscriptionAction($request) {
       
      $login = $request->read('inscLogin');
      $passwordRepeat = $request->read('inscPasswordRepeat');
      $password = $request->read('inscPassword');
      //echo($login);
      
      $V = User::isLoginUsed($login);
      var_dump($V);
      if($V) {
         echo("isUsed");
         $view = new View($this,'inscription');
        $view->setArg('inscErrorText','This login is already used');
        $view->render();
         } 
         elseif ($password != $passwordRepeat) {
            $view = new View($this, 'inscription');
            $this->request->notify('danger', 'Les mots de passe ne correspondent pas.');
            $view->render();
         } 
       else {
        $nom = $request->read('nom');
        $prenom = $request->read('prenom');
        $mail = $request->read('mail'); 
        $user = User::create($nom, $prenom, $type_utilisateur= 'invite', $matricule=NULL, $statut=NULL, $mail_enseignant=NULL, $promo=NULL, $annee_de_sortie=NULL, $mail, $password,$login);
            if(!isset($user)) {
               $view = new View($this,'inscription');
               $view->setArg('inscErrorText', 'Cannot complete inscription');
               $view->render();
               } else {
            $newRequest = new Request();
            $newRequest->write('controller','user');
            $newRequest->set('user', $user->getId());
            $this->redirect(Router::path('profile'));
            //Dispatcher::dispatch($newRequest);
                     }  
        } 
        }

   /*function __construct($request) {
      parent::  _construct($request);
        $this-> name ='anonymous';
        $this-> request-> hasPOST('login') && $this->request->hasPOST('password')
        $this->request->setActionname('login');
        $this->request->hasPOST(insclogin) && $request->hasPOST('inscPassword');
        $this->request->SetActionName('validateInscription');
    }*/
    /*
}
*/
?>	