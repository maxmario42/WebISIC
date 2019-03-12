<?php

class AnonymousController extends Controller
//Ce contrôleur regroupe l’ensemble des actions pour un utilisateur non connecté.
{
    public function defaultAction()
    //Appelle la vue qui retournera la bonne réponse ou affichera la bonne chose
    {
        $view = new View($this);
        $view->render();
    }

    function __construct(!$_REQUEST) {
        _construct($_REQUEST);
        $this-> name ='ananymous';
        $this-> request-> hasPOST('login') && $this->request->hasPOST('password')
        $this->request->setActionname('login');
        $this->request->hasPOST(insclogin) && $request->hasPOST('inscPassword');
        $this->request->SetActionName('validateInscription');
    }
}
?>