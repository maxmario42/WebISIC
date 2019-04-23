<?php
class ReponseController extends Controller{
    public function __construct($request)
    {
        parent::__construct($request);
        $this->protection('Enseignant'); //pour qu'une personne n'essai pas de forcer l'entree sur cette page.
    }

    public function defaultAction()
    {  
        $idq = (int)$this->request->getParameter('idq');
        $idquest = (int)$this->request->getParameter('idquest');
        if(!isset($idq))
        {
            $this->linkTo('Questionnaire','showQuest'); //Redirection si on tente de forcer l'action
        }
        $questionnaire=Questionnaire::getWithId($idq);
        $question=Question::getWithId($idquest);
        $view = new View($this, 'reponse/creerReponse');
        $view->setArg('user',$this->request->getUserObject());
        $view->setArg('questionnaire',$questionnaire);
        $view->setArg('question',$question);  
        $view->render();
    }

    public function showReponse(){
        $idq = (int)$this->request->getParameter('idq');
        $idquest = (int)$this->request->getParameter('idquest');
        $enonce=$this->request->read('enonce');
        $correct=(int)$this->request('correct');
        //champ colonne est vide pour l'instant
        $reponse=Reponses_Possibles::create($idquest,$enonce,$correct,null);
        $question=Question::getWithId($idquest);
        $questionnaire=Questionnaire::getWithId($idq);
        $view = new View($this,'question/showReponse');
        $view->setArg('user',$this->request->getUserObject());
        $view->setArg('questionnaire',$questionnaire);
        $view->setArg('question',$question);  
        $view->render();

    }

}
?>