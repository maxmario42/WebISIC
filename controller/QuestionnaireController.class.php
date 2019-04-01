<?php

Class QuestionnaireController extends Controller{

    public function __construct($currentRequest) {
        parent::__construct($currentRequest);
        $this->protection(); //pour qu'une personne n'essai pas de forcer l'entree sur cette page.
    }

  public function defaultAction($request)
        {   echo "you are in the questionnaire controller";
            $view = new UserView($this, 'questionnaire',array('user' => $this->user));
            $view->render();
        } 

    public function newQuest($request){
      echo "ON VA CREER TON QUESTIONNAIRE";
    }
}
?>