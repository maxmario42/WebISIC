<?php

class QuestionnaireController extends Controller
/*
Ce controlleur gère les questionnaires.
*/
{

    public function __construct($request)
    {
        parent::__construct($request);
        $this->protection('Enseignant'); //pour qu'une personne n'essai pas de forcer l'entree sur cette page.
    }

    public function defaultAction()
    //Par défaut, vue de création de questionnaire
    {
        $view = new View($this, 'questionnaire/creerQuestionnaire');
        $view->setArg('user', $this->request->getUserObject());
        $view->render();
    }

    public function newQuest()
    //Création d'un questionnaire
    {
        $titre = $this->request->read('titre');
        if (!isset($titre)) {
            $this->linkTo('Questionnaire', 'showQuest'); //Redirection si on tente de forcer l'action
        }
        Questionnaire::isUsed($titre, 'TITRE');
        if (Questionnaire::isUsed($titre, 'TITRE')) {
            $view = new View($this, 'questionnaire/creerQuestionnaire');
            $view->setArg('user', $this->request->getUserObject());
            $view->setArg('inscErrorText', 'This title is already used');
            $view->render();
            echo ("<script>alert('Vous avez déjà crée une questionnaire avec cette titre...');</script>");
        } else {
            $description = $this->request->read('description');
            $idU = (int)$this->request->getUserObject()->ID;
            $etat = "Fermé";
            $lien_http = "";
            $date_ouverture = $this->request->read('date_ouverture');
            $date_fermeture = $this->request->read('date_fermeture');
            $mode_acces = $this->request->read('mode_acces');
            $temps = (int)$this->request->read('temps_total');
            $revenir = (int)$this->request->read('revenir_arriere');
            $moins = (int)$this->request->read('moins');
            $plus = (int)$this->request->read('plus');
            //$neutre=(int)$this->request->read('neutre');
            $neutre = 0;
            $regles = Regles_Questionnaire::create($temps, $revenir, $plus, $moins, $neutre);
            $questio = Questionnaire::create($idU, $titre, $regles->ID_REGLES_QUEST, $description, $etat, $date_ouverture, $date_fermeture, $mode_acces, $lien_http);

            if (!isset($questio)) {
                $view = new View($this, 'questionnaire/creerQuestionnaire');
                $view->setArg('user', $this->request->getUserObject());
                $view->setArg('inscErrorText', 'Cannot complete creation');
                $view->render();
            } else {
                $this->linkTo('Questionnaire', 'showQuiz', array('idq' => $questio->IDQ));
            }
        }
    }

    /*
    Actions d'affichage
    */

    public function showQuiz()
    {
        //Affichage d'un questionnaire
        $idq = (int)$this->request->getParameter('idq'); //recupere le parametre en get de l'ID du questionnaire de l'url.
        if (!isset($idq)) {
            $this->linkTo('Questionnaire', 'showQuest'); //Redirection si on tente de forcer l'action
        }
        $questionnaire = Questionnaire::getWithId($idq);
        $regles = Regles_Questionnaire::getWithId($questionnaire->ID_REGLES_QUEST);
        $view = new View($this, 'questionnaire/showQuestionnaire');
        $view->setArg('user', $this->request->getUserObject());
        $view->setArg('questionnaire', $questionnaire);
        $view->setArg('regles', $regles);
        $view->render();
    }

    public function showQuest()
    {
        //Affichage des questionnaires d'un utilisateur
        $questionnaires = Questionnaire::getAllWithAnId($this->request->getUserObject()->ID, User::getIDColumn());
        if (!isset($questionnaires)) {
            throw new Error("Problème d'accès aux questionnaires", 500);
        }
        $view = new View($this, 'questionnaire/listQuestionnaire');
        $view->setArg('user', $this->request->getUserObject());
        $view->setArg('questionnaires', $questionnaires);
        $view->render();
    }

    /*
    Actions de participations
    */

    public function showParticipations()
    //Affiche les participations des étudiants à un questionnaire (On obtient uniquement le score, pas les réponses)
    {
        $idq = (int)$this->request->getParameter('idq'); //recupere le parametre en get de l'ID du questionnaire de l'url.
        if (!isset($idq)) {
            $this->linkTo('Questionnaire', 'showQuest'); //Redirection si on tente de forcer l'action
        }
        $questionnaire = Questionnaire::getWithId($idq);
        $participations = Participer::lesParticipation($idq);
        $view = new View($this, 'questionnaire/participation');
        $view->setArg('user', $this->request->getUserObject());
        $view->setArg('questionnaire', $questionnaire);
        $view->setArg('participations', $participations);
        $view->render();
    }

    public function deleteParticipation()
    //Supprime la participation d'un étudiant à un questionnaire
    {
        $idq = (int)$this->request->getParameter('idq');
        $id = (int)$this->request->getParameter('id');
        if (!isset($idq) || !isset($id)) {
            $this->linkTo('Questionnaire', 'showQuest'); //Redirection si on tente de forcer l'action
        }
        Participer::abandon($id, $idq);
        $this->linkTo('Questionnaire', 'showParticipations', array('idq' => $idq));
    }

    /*
    Actions de gestion
    */

    public function edit()
    //Appelle la vue pour mettre à jour les informations
    {
        $idq = (int)$this->request->getParameter('idq'); //recupere le parametre en get de l'ID du questionnaire de l'url.
        $questionnaire = Questionnaire::getWithId($idq);
        $regles = Regles_Questionnaire::getWithId($questionnaire->ID_REGLES_QUEST);
        if (!isset($idq) || !is_object($questionnaire)) {
            $this->linkTo('Questionnaire', 'showQuest'); //Redirection si on tente de forcer l'action
        }
        $v = new View($this, 'questionnaire/editQuestionnaire');
        $v->setArg('user', $this->request->getUserObject());
        $v->setArg('questionnaire', $questionnaire);
        $v->setArg('regles', $regles);
        $v->render();
    }

    public function edition()
    //Permet de mettre à jour les informations d'un questionnaire.
    {
        $idq = (int)$this->request->getParameter('idq'); //recupere le parametre en get de l'ID du questionnaire de l'url.
        $questionnaire = Questionnaire::getWithId($idq);
        $titre = $this->request->read('titre');
        if (!isset($titre) || !is_object($questionnaire)) {
            $this->linkTo('Questionnaire', 'showQuest'); //Redirection si on tente de forcer l'action
        }
        if (Questionnaire::isUsed($titre, 'TITRE') && $questionnaire->TITRE != $titre) {
            $view = new View($this, 'questionnaire/editQuestionnaire');
            $view->setArg('user', $this->request->getUserObject());
            $view->setArg('questionnaire', $questionnaire);
            $view->setArg('inscErrorText', 'This title is already used');
            $view->render();
            echo ("<script>alert('Vous avez un questionnaire avec le même titre...');</script>");
        } else {
            $etat = "Fermé";
            $description = $this->request->read('description');
            $date_ouverture = $this->request->read('date_ouverture');
            $date_fermeture = $this->request->read('date_fermeture');
            $mode_acces = $this->request->read('mode_acces');
            $temps = (int)$this->request->read('temps_total');
            $revenir = (int)$this->request->read('revenir_arriere');
            $moins = (int)$this->request->read('moins');
            $plus = (int)$this->request->read('plus');
            //$neutre=(int)$this->request->read('neutre');
            $neutre = 0;
            $regles = Regles_Questionnaire::update($questionnaire->ID_REGLES_QUEST, $temps, $revenir, $plus, $moins, $neutre);
            $questio = Questionnaire::update($idq, $titre, $description, $etat, $date_ouverture, $date_fermeture, $mode_acces);
            if (!isset($questio)) {
                $view = new View($this, 'questionnaire/editQuestionnaire');
                $view->setArg('user', $this->request->getUserObject());
                $view->setArg('questionnaire', $questionnaire);
                $view->setArg('inscErrorText', 'Cannot complete Edition');
                $view->render();
            } else {
                $this->linkTo('Questionnaire', 'showQuiz', array('idq' => $questionnaire->IDQ)); //Modification réussie
            }
        }
    }
    public function deleteQuest()
    //Permet de supprimer un questionnaire et ses questions.
    {
        $idq = (int)$this->request->getParameter('idq'); //recupere le parametre en get de l'ID du questionnaire de l'url.
        if (!isset($idq)) {
            $this->linkTo('Questionnaire', 'showQuest'); //Redirection si on tente de forcer l'action
        }
        $questions = Question::getQuestions($idq);
        foreach ($questions as $question) {
            Reponse_Choisie::deleteAll($question->ID_QUEST);
            $reponses = Reponses_Possibles::getAllWithAnId($question->ID_QUEST, 'ID_QUEST');
            foreach ($reponses as $reponse) {
                    Reponses_Possibles::deleteWithId($reponse->ID_REPONSE);
                }
            Question::delete($idq, $question->ID_QUEST);
        }
        Participer::deleteWithAnId($idq, 'IDQ');
        $idrq = Questionnaire::getAllWithId($idq)->ID_REGLES_QUEST;
        Questionnaire::deleteWithId($idq);
        Regles_Questionnaire::deleteWithId($idrq);
        $this->linkTo('Questionnaire', 'showQuest');
    }
}
