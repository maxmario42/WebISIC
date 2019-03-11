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
}
?>