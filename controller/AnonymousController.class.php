<?php

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
   
    public function inscriptionAction($request){
       $view = new View($this,'inscription');
       $view->render();  
    }

    public function loginAction()
    {
      $view = new View($this,'profile/login');
      $view->render();
    }

    public function validateInscriptionAction($request) {
       
      $login = $request->read('inscLogin');
      //echo($login);
      if(User::isLoginUsed($login)) {
         echo("isUsed");
         $view = new View($this,'inscription');
        $view->setArg('inscErrorText','This login is already used');
        $view->render();
         }  
       else {
        $password = $request->read('inscPassword');
        $nom = $request->read('nom');
        $prenom = $request->read('prenom');
        $mail = $request->read('mail'); }
         /*
        $user = User::create($nom, $prenom, $type_utilisateur= NULL, $matricule=NULL, $statut=NULL, $mail_enseignant=NULL, $promo, $annee_de_sortie, $mail_etudiant, $password);
        if(!isset($user)) {
        $view = new View($this,'inscription');
        $view->setArg('inscErrorText', 'Cannot complete inscription');
        $view->render();
        } else {
        $newRequest = new Request();
        $newRequest->write('controller','user');
        $newRequest->write('user',$user->id());
        Dispatcher::dispatch($newRequest);
        }
        } */
        }

   /*function __construct($request) {
      parent::  _construct($request);
        $this-> name ='anonymous';
        $this-> request-> hasPOST('login') && $this->request->hasPOST('password')
        $this->request->setActionname('login');
        $this->request->hasPOST(insclogin) && $request->hasPOST('inscPassword');
        $this->request->SetActionName('validateInscription');
    }*/
}

	