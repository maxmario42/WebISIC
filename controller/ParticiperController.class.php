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

    public function participer()
    {
        $idq = (int)$this->request->getParameter('idq');
        $questions = Question::getQuestions($idq);
        $unequestion = $questions[0];
        $this->linkTo('Participer','repondre',array('idq' => $idq, 'idquest'=>$unequestion->ID_QUEST));
    }

    public function repondre()
    {
        $idq = (int)$this->request->getParameter('idq');
        $idquest = (int)$this->request->getParameter('idquest');
        if (!isset($idq)||!isset($idquest))
        {
            $this->linkTo('Participer');
        }
        $questionnaire = Questionnaire::getWithId($idq);
        $question = Question::getWithId($idquest);
        $reponses = Reponses_Possibles::getAllWithAnId($idquest,Question::getIDColumn());
        $view = new View($this,"participer/".strtolower($question->TYPEQ));
        $view->setArg('user',$this->request->getUserObject());
        $view->setArg('questionnaire',$questionnaire);
        $view->setArg('question',$question);
        $view->setArg('reponses',$reponses);
        $view->render();
    }
}
?>