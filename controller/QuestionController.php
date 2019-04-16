<?php
class QuestionController extends Controller
{
    public function __construct($request)
    {
        parent::__construct($request);
        $this->protection(); //pour qu'une personne n'essai pas de forcer l'entree sur cette page.
    }

    public function defaultAction()
    {  
        $view = new View($this, 'question/creerQuestion');
        $view->setArg('user',$this->request->getUserObject());
        $view->render();
    }

    public function newQuest()
    {   
        $this->protection('Enseignant');
        $intitule = $this->request->read('intitule');
        $idq = $this->request->getParameter('idq'); //recupere le parametre en get de l'ID du questionnaire de l'url.
        if(!isset($intitule))
        {
            $this->linkTo('Question'); //Redirection si on tente de forcer l'action
        }
        $idU=(int)$this->request->getUserObject()->ID;
        $typeq=$this->request->read('typeq');
        $temps_max=$this->request->read('temps_max');
        $questio = Question::create($idq, $intitule, $typeq, $temps_max);
        if(!isset($questio))
        {
            $view = new View($this, 'question/creerQuestion');
            $view->setArg('user',$this->request->getUserObject());
            $view->setArg('inscErrorText', 'Cannot complete creation');
            $view->render();
        } 
        else 
        {  
            $this->linkTo('Question','showQuest');
        }
    }

    public function showQuestion()
    {
        $idquest = $this->request->getParameter('idquest'); //recupere le parametre en get de l'ID du questionnaire de l'url.
        if(!isset($idquest))
        {
            $this->linkTo('Questionnaire','showQuest'); //Redirection si on tente de forcer l'action
        }
        $question=Question::getWithId($idquest);
        $view = new View($this,'question/showQuestion');
        $view->setArg('user',$this->request->getUserObject());
        $view->setArg('question',$question);  
        $view->render();
    }

    public function showListQuestion()
    {
        $idq = $this->request->getParameter('idq');
        if(!isset($idq))
        {
            $this->linkTo('Questionnaire','showQuest'); //Redirection si on tente de forcer l'action
        }
        $quiz=Questionnaire::getWithId($idq);
        $questions= Question::getQuestions($idq);
        if(!isset($questions))
        {
            throw new Error("Problème d'accès aux questions", 500);
        }
        $view = new View($this,'questionnaire/listQuestion');
        $view->setArg('user',$this->request->getUserObject());
        $view->setArg('questionnaire',$quiz);
        $view->setArg('question',$questions);
        $view->render();
    }
}
?>