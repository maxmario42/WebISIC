<?php
class ParticiperController extends Controller
{
    public function __construct($request)
    {
        parent::__construct($request);
        $this->protection(); //pour qu'une personne n'essai pas de forcer l'entree sur cette page.
    }

    public function defaultAction()
    {
    //Affichage des questionnaires
        $questionnaires= Questionnaire::getAll();
        if(!isset($questionnaires))
        {
            throw new Error("Problème d'accès aux questionnaires", 500);
        }
        $view = new View($this,'participer/listQuestionnaire');
        $view->setArg('user',$this->request->getUserObject());
        $view->setArg('questionnaires',$questionnaires);
        $view->render();
    }
}
?>