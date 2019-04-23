<?php
class ParticiperController extends Controller
{
    protected $session;

    public function __construct($request)
    {
        parent::__construct($request);
        $this->protection(); //pour qu'une personne n'essai pas de forcer l'entree sur cette page.
        $this->session=Session::getInstance();
    }

    public function defaultAction()
    {
        //Affichage des questionnaires
        $questionnaires = Questionnaire::getAll();
        if (!isset($questionnaires)) {
            throw new Error("Problème d'accès aux questionnaires", 500);
        }
        $view = new View($this, 'participer/listQuestionnaire');
        $view->setArg('user', $this->request->getUserObject());
        $view->setArg('questionnaires', $questionnaires);
        $view->render();
    }

    public function participer()
    {
        if (!isset($this->session->questionnaireEnCours))
        {
            $idq = (int)$this->request->getParameter('idq');
            $this->session->questionnaireEnCours = $idq;
            $this->session->questionEnCours=0;
        }
        $this->linkTo('Participer', 'repondre');
    }

    public function abandonner()
    {
        unset($this->session->questionnaireEnCours);
        unset($this->session->questionEnCours);
        $this->linkTo('Participer');
    }

    public function repondre()
    {
        $idq = $this->session->questionnaireEnCours;
        $numeroQuestion = $this->session->questionEnCours;
        if (!isset($idq) || !isset($numeroQuestion)) {
            throw new Error('Problème',500);
        }
        $questionnaire = Questionnaire::getWithId($idq);
        $question = Question::getQuestions($idq)[$numeroQuestion];
        $reponses = Reponses_Possibles::getAllWithAnId($question->ID_QUEST, Question::getIDColumn());
        $view = new View($this, "participer/" . strtolower($question->TYPEQ));
        $view->setArg('user', $this->request->getUserObject());
        $view->setArg('questionnaire', $questionnaire);
        $view->setArg('question', $question);
        $view->setArg('reponses', $reponses);
        $view->render();
    }

    public function reponseQCU()
    { }

    public function reponseQRL()
    { }

    public function reponseQCM()
    { }
}
