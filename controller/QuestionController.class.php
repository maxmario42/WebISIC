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
        $idq = $this->request->getParameter('idq');
        if(!isset($idq))
        {
            $this->linkTo('Questionnaire','showQuest'); //Redirection si on tente de forcer l'action
        }
        $questionnaire=Questionnaire::getWithId($idq);
        $view = new View($this, 'question/creerQuestion');
        $view->setArg('user',$this->request->getUserObject());
        $view->setArg('questionnaire',$questionnaire);
        $view->render();
    }

    public function newQuest()
    {   
        $this->protection('Enseignant');
        $intitule = $this->request->read('intitule');
        $idq = $this->request->getParameter('idq'); //recupere le parametre en get de l'ID du questionnaire de l'url.
        var_dump($idq);
        if(!isset($intitule))
        {
            $this->linkTo('Question'); //Redirection si on tente de forcer l'action
        }
        $typeq=$this->request->read('typeq');
        $temps_max=$this->request->read('temps_max');
        $questio = Question::create($idq, $intitule, $typeq, $temps_max);
        if(!isset($questio))
        {
            $questionnaire=Questionnaire::getWithId($idq);
            $view = new View($this, 'question/creerQuestion');
            $view->setArg('user',$this->request->getUserObject());
            $view->setArg('questionnaire',$questionnaire);
            $view->setArg('inscErrorText', 'Cannot complete creation');
            $view->render();
        } 
        else 
        {  
            $this->linkTo('Question','showQuestion',array('idq'=>$idq,'idquest'=>$questio->ID_QUEST));
        }
    }

    public function showQuestion()
    {
        $idq = (int)$this->request->getParameter('idq');
        $idquest = (int)$this->request->getParameter('idquest'); //recupere le parametre en get de l'ID de la question de l'url.
        if(!isset($idquest))
        {
            $this->linkTo('Questionnaire','showQuest'); //Redirection si on tente de forcer l'action
        }
        $question=Question::getWithId($idquest);
        $questionnaire=Questionnaire::getWithId($idq);
        $view = new View($this,'question/showQuestion');
        $view->setArg('user',$this->request->getUserObject());
        $view->setArg('questionnaire',$questionnaire);
        $view->setArg('question',$question);  
        $view->render();
    }

    public function showListQuestion()
    {
        $idq = (int)$this->request->getParameter('idq');
        if(!isset($idq))
        {
            $this->linkTo('Questionnaire','showQuest'); //Redirection si on tente de forcer l'action
        }
        $questionnaire=Questionnaire::getWithId($idq);
        $questions=Question::getQuestions($idq);
        if(!isset($questions))
        {
            throw new Error("Problème d'accès aux questions", 500);
        }
        $view = new View($this,'question/listQuestion');
        $view->setArg('user',$this->request->getUserObject());
        $view->setArg('questionnaire',$questionnaire);
        $view->setArg('question',$questions);
        $view->render();
    }

    public function edit()
    {
        $idq = (int)$this->request->getParameter('idq');
        $idquest = (int)$this->request->getParameter('idquest');
        if(!isset($idquest))
        {
            $this->linkTo('Questionnaire','showQuest'); //Redirection si on tente de forcer l'action
        }
        $questionnaire=Questionnaire::getWithId($idq);
        $question=Question::getWithId($idquest);
        $view = new View($this,'question/editQuestion');
        $view->setArg('user',$this->request->getUserObject());
        $view->setArg('questionnaire',$questionnaire);
        $view->setArg('question',$question);  
        $view->render();
    }

    public function edition()
    {   
        $this->protection('Enseignant');
        $intitule = $this->request->read('intitule');
        $idq = (int)$this->request->getParameter('idq');
        $idquest = (int)$this->request->getParameter('idquest'); //recupere le parametre en get de l'ID du questionnaire de l'url.
        if(!isset($intitule))
        {
            $this->linkTo('Question','edit',array('idquest'=>$idquest)); //Redirection si on tente de forcer l'action
        }
        $typeq=$this->request->read('typeq');
        $temps_max=$this->request->read('temps_max');
        $questio = Question::update($idquest, $intitule, $typeq, $temps_max);
        if(!isset($questio))
        {
            $questionnaire=Questionnaire::getWithId($idq);
            $question=Question::getWithId($idquest);
            $view = new View($this, 'question/editQuestion');
            $view->setArg('user',$this->request->getUserObject());
            $view->setArg('questionnaire',$questionnaire);
            $view->setArg('question',$question);  
            $view->setArg('inscErrorText', 'Cannot complete creation');
            $view->render();
        } 
        else 
        {  
            $this->linkTo('Question','showQuestion',array('idquest'=>$questio->ID_QUEST));
        }
    }

    public function deleteQuestion()
    {
        $this->protection('Enseignant'); //Réserve l'accès aux Enseignants
        $idq = (int)$this->request->getParameter('idq');
        $idquest = (int)$this->request->getParameter('idquest');
        if(!isset($idquest)||!isset($idq))
        {
            $this->linkTo('Questionnaire','showQuest'); //Redirection si on tente de forcer l'action
        }
        Question::delete($idq,$idquest);
        $this->linkTo('Question','showListQuestion',array('idq'=>$idq));
    }
}
