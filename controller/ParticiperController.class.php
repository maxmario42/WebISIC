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
    //Débute une participation
    {
        if (!isset($this->session->questionnaireEnCours)) //Si réponse en cours
        {
            $idq = (int)$this->request->getParameter('idq');
            if (!Participer::debutParticipation($this->request->getUser(),$idq)) //Si l'utilisateur a déjà participé, on le redirige vers les résultats
            {
                $this->linkTo('Participer','detailResultats',array('idq' => $idq));
            }
            //Stockage dans la session
            $this->session->questionnaireEnCours = $idq;
            $this->session->questionEnCours=0;
        }
        $this->linkTo('Participer', 'repondre');
    }

    public function abandonner()
    {
        Participer::abandon($this->request->getUser(),$this->session->questionnaireEnCours);
        unset($this->session->questionnaireEnCours);
        unset($this->session->questionEnCours);
        $this->linkTo('Participer');
    }

    public function repondre()
    //Affiche la prochaine question
    {
        $idq = $this->session->questionnaireEnCours;
        $numeroQuestion = $this->session->questionEnCours;
        if (!isset($idq) || !isset($numeroQuestion)) {
            throw new Error('Problème',500);
        }
        $questionnaire = Questionnaire::getWithId($idq);
        $questions = Question::getQuestions($idq);
        if (!array_key_exists($numeroQuestion,$questions))//Si on a fait toute les questions
        {
            $this->linkTo('Participer','fin');
        }
        $question = $questions[$numeroQuestion];
        $reponses = Reponses_Possibles::getAllWithAnId($question->ID_QUEST, Question::getIDColumn());
        $view = new View($this, "participer/" . strtolower($question->TYPEQ));
        $view->setArg('user', $this->request->getUserObject());
        $view->setArg('questionnaire', $questionnaire);
        $view->setArg('question', $question);
        $view->setArg('reponses', $reponses);
        $view->render();
    }

    public function reponse()
    //Inscrit la réponse
    { 
        $idq = $this->session->questionnaireEnCours;
        $numeroQuestion = $this->session->questionEnCours;
        $questionnaire = Questionnaire::getWithId($idq);
        $questions = Question::getQuestions($idq);
        $question = $questions[$numeroQuestion];
        $reponse=$this->request->read('reponse');
        if($question->TYPEQ=='QCU')
        {
            Reponse_Choisie::choixQCU($reponse,$idq,$this->request->getUser());
        }
        else if($question->TYPEQ=='QRL')
        {
            Reponse_Choisie::choixQRL($reponse,$idq,$this->request->getUser());
        }
        else if($question->TYPEQ=='QCM')
        {
            Reponse_Choisie::choixQCM($reponse,$idq,$this->request->getUser());
        }
        $this->session->questionEnCours+=1;
        $this->linkTo('Participer','repondre');
    }
    public function fin()
    {
        Participer::finParticipation($this->request->getUser(),$this->session->questionnaireEnCours);
        unset($this->session->questionnaireEnCours);
        unset($this->session->questionEnCours);
        $this->linkTo('Participer','resultats');
    }

    public function resultats()
    {
        $participations = Participer::mesParticipation($this->request->getUser());
        if (!isset($participations)) {
            throw new Error("Problème d'accès aux participations", 500);
        }
        $questionnaires=array();
        foreach ($participations as $participation) 
        {
            array_push($questionnaires,Questionnaire::getWithId($participation->IDQ));
        }
        $view = new View($this, 'resultats/listQuestionnaire');
        $view->setArg('user', $this->request->getUserObject());
        $view->setArg('questionnaires', $questionnaires);
        $view->render();
    }

    public function detailResultats()
    {
        $idq = (int)$this->request->getParameter('idq');
        $participation=Participer::uneParticipation($this->request->getUser(),$idq);
        if (!is_object($participation))
        {
            $this->linkTo('Participer','resultats');
        }
        $questionnaire = Questionnaire::getWithId($idq);
        $view = new View($this, 'resultats/showQuestionnaire');
        $view->setArg('user', $this->request->getUserObject());
        $view->setArg('questionnaire', $questionnaire);
        $view->setArg('participation', $participation);
        $view->render();
    }

}
