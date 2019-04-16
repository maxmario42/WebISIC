<?php

class QuestionnaireController extends Controller
{

    public function __construct($request)
    {
        parent::__construct($request);
        $this->protection(); //pour qu'une personne n'essai pas de forcer l'entree sur cette page.
    }

    public function defaultAction()
    //Par défaut, vue de création de questionnaire
    {  
        $this->protection('Enseignant'); //Réserve l'accès aux Enseignants
        $view = new View($this, 'questionnaire/creerQuestionnaire');
        $view->setArg('user',$this->request->getUserObject());
        $view->render();
    }

    public function newQuest()
    //Création d'un questionnaire
    {   
        $this->protection('Enseignant'); //Réserve l'accès aux Enseignants
        $titre = $this->request->read('titre');
        if(!isset($titre))
        {
            $this->linkTo('Questionnaire','showQuest'); //Redirection si on tente de forcer l'action
        }
        Questionnaire::isUsed($titre,'TITRE');
        if (Questionnaire::isUsed($titre,'TITRE'))
        {
                $view = new View($this, 'questionnaire/creerQuestionnaire');
                $view->setArg('user',$this->request->getUserObject());
                $view->setArg('inscErrorText', 'This title is already used');
                $view->render();
                echo ("<script>alert('Vous avez déjà crée une questionnaire avec cette titre...');</script>");
        } 
        else 
        {
            $description= $this->request->read('description');
            $idU=(int)$this->request->getUserObject()->ID;
            $etat="Fermé";
            $lien_http="";
            $date_ouverture=$this->request->read('date_ouverture');
            $date_fermeture=$this->request->read('date_fermeture');
            $mode_acces=$this->request->read('mode_acces');
            $temps=(int)$this->request->read('temps_total');
            $revenir=(int)$this->request->read('revenir_arriere');
            $moins=(int)$this->request->read('moins');
            $plus=(int)$this->request->read('plus');
            //$neutre=(int)$this->request->read('neutre');
            //$regles = Regles_Questionnaire::create($temps,$revenir,$plus,$moins,$neutre);
            $questio = Questionnaire::create($idU,$titre,1,$description, $etat,$date_ouverture,$date_fermeture,$mode_acces,$lien_http);
            
           if(!isset($questio)) 
            {
                $view = new View($this, 'questionnaire/creerQuestionnaire');
                $view->setArg('user',$this->request->getUserObject());
                $view->setArg('inscErrorText', 'Cannot complete creation');
                $view->render();
            } 
            else 
            {  
                $this->linkTo('Questionnaire','showQuiz',array('idq'=>$questio->IDQ));
            }
          
        }
    }
    public function showQuiz(){
    //Affichage d'un questionnaire
        $idq = $this->request->getParameter('idq'); //recupere le parametre en get de l'ID du questionnaire de l'url.
        if(!isset($idq))
        {
            $this->linkTo('Questionnaire','showQuest'); //Redirection si on tente de forcer l'action
        }
        $quiz=Questionnaire::getWithId($idq);
        $view = new View($this,'questionnaire/showQuestionnaire');
        $view->setArg('user',$this->request->getUserObject());
        $view->setArg('quiz',$quiz);  
        $view->render();
    }

    public function showQuest(){
    //Affichage des questionnaires d'un utilisateur
        $this->protection('Enseignant');
        $questionnaires= Questionnaire::getAllWithAnId($this->request->getUserObject()->ID,User::getIDColumn());
        if(!isset($questionnaires))
        {
            throw new Error("Problème d'accès aux questionnaires", 500);
        }
        $view = new View($this,'questionnaire/listQuestionnaire');
        $view->setArg('user',$this->request->getUserObject());
        $view->setArg('questionnaire',$questionnaires);
        $view->render();
    } 

    public function edit()
    //Appelle la vue pour mettre à jour les informations
    {
        $this->protection('Enseignant'); //Réserve l'accès aux Enseignants
        $idq = $this->request->getParameter('idq'); //recupere le parametre en get de l'ID du questionnaire de l'url.
        $quiz=Questionnaire::getWithId($idq);
        if(!isset($idq)||!is_object($quiz))
        {
            $this->linkTo('Questionnaire','showQuest'); //Redirection si on tente de forcer l'action
        }
        $v = new View($this,'questionnaire/editQuestionnaire');
        $v->setArg('user',$this->request->getUserObject());
        $v->setArg('quiz',$quiz);
        $v->render();
    }

    public function edition()
    //Permet de mettre à jour les informations d'un questionnaire.
    {
        $this->protection('Enseignant'); //Réserve l'accès aux Enseignants
        $idq = $this->request->getParameter('idq'); //recupere le parametre en get de l'ID du questionnaire de l'url.
        $quiz=Questionnaire::getWithId($idq);
        $titre = $this->request->read('titre');
        if(!isset($titre)||!is_object($quiz))
        {
            $this->linkTo('Questionnaire','showQuest'); //Redirection si on tente de forcer l'action
        }
        if(Questionnaire::isUsed($titre,'TITRE')&&$quiz->TITRE!=$titre) 
        {
            $view = new View($this,'questionnaire/editQuestionnaire');
            $view->setArg('user',$this->request->getUserObject());
            $view->setArg('quiz',$quiz);
            $view->setArg('inscErrorText','This title is already used');
            $view->render();
            echo("<script>alert('Vous avez un questionnaire avec le même titre...');</script>");  
        } 
        else 
        {
            $etat="Fermé";
            $description=$this->request->read('description');
            $date_ouverture=$this->request->read('date_ouverture');
            $date_fermeture=$this->request->read('date_fermeture');
            $mode_acces=$this->request->read('mode_acces');
            $temps=(int)$this->request->read('temps_total');
            $revenir=(int)$this->request->read('revenir_arriere');
            $moins=(int)$this->request->read('moins');
            $plus=(int)$this->request->read('plus');
            //$neutre=(int)$this->request->read('neutre');
            //$regles = Regles_Questionnaire::update($quiz->ID_REGLES_QUEST,$temps,$revenir,$plus,$moins,$neutre);
            $questio = Questionnaire::update($idq,$titre, $description,$etat,$date_ouverture,$date_fermeture,$mode_acces);
            if(!isset($questio)) 
            {
                $view = new View($this,'questionnaire/editQuestionnaire');
                $view->setArg('user',$this->request->getUserObject());
                $view->setArg('quiz',$quiz);
                $view->setArg('inscErrorText', 'Cannot complete Edition');
                $view->render();
            } 
            else 
            {
                $this->linkTo('Questionnaire','showQuiz',array('idq' => $quiz->IDQ)); //Modification réussie
            }                    
        }
    }
}
?>