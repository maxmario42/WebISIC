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
       /* if(!isset($idq))
        {
            $this->linkTo('Questionnaire','showQuest'); //Redirection si on tente de forcer l'action
        }*/
        $questionnaire=Questionnaire::getWithId($idq);
        $question=Question::getWithId($idquest);
        $view = new View($this,'reponse/creerReponse');
        $view->setArg('user',$this->request->getUserObject());
        $view->setArg('questionnaire',$questionnaire);
        $view->setArg('question',$question);  
        $view->render();
    }

    public function newReponse(){
        $idq = (int)$this->request->getParameter('idq');
        $idquest = (int)$this->request->getParameter('idquest');
        $enonce=$this->request->read('enonce');
        $correct=(int)$this->request->read('correct');
        //champ colonne est vide pour l'instant
        $reponse=Reponses_Possibles::create($idquest,$enonce,$correct,null);
        if(!isset($reponse))
        {  $question=Question::getWithId($idquest);
            $questionnaire=Questionnaire::getWithId($idq);
            $view = new View($this, 'reponse/creerReponse');
            $view->setArg('user',$this->request->getUserObject());
            $view->setArg('questionnaire',$questionnaire);
            $view->setArg('question',$question);
            $view->setArg('inscErrorText', 'Cannot complete creation');
            $view->render();
        } 
        else 
        {  //CHANGEMENT POUR FAIRE RENDER DES QUESTIONS POSSIBLES
            $this->linkTo('Reponse','showReponse',array('idq'=>$idq,'idquest'=>$idquest,'idR'=>$reponse->ID_REPONSE));
        }
    }

    public function showReponse()
    {
        $idq = (int)$this->request->getParameter('idq');    
        $idquest = (int)$this->request->getParameter('idquest');
        $idR=(int)$this->request->getParameter('idR');
        $question=Question::getWithId($idquest);
        $questionnaire=Questionnaire::getWithId($idq);
        $reponse=Reponses_Possibles::getWithId($idR);
        $view = new View($this,'reponse/showReponse');
        $view->setArg('questionnaire',$questionnaire);
        $view->setArg('question',$question);
        $view->setArg('reponse',$reponse);
        $view->setArg('user',$this->request->getUserObject());
        $view->render();
    }

}
?>