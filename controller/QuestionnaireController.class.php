<?php

class QuestionnaireController extends Controller
{

    public function __construct($currentRequest)
    {
        parent::__construct($currentRequest);
        $this->protection(); //pour qu'une personne n'essai pas de forcer l'entree sur cette page.
    }

    public function defaultAction($request)
    {   //echo "you are in the questionnaire controller";
        $view = new UserView($this, 'questionnaire', array('user' => $this->user));
        $view->render();
    }

    public function newQuest($request)
    {   
        $titre = $request->read('titre');
       var_dump( Questionnaire::isTitreUsed($titre));
        if (Questionnaire::isTitreUsed($titre)) {
                $view = new View($this);
                $view->setArg('inscErrorText', 'This title is already used');
                $view->render();
                echo ("<script>alert('Vous avez déjà crée une questionnaire avec cette titre...');</script>");
            } else {
                /*$description= $request->read('description');*/
                $id=$this->user->ID;
                var_dump($id);
                $etat='Fermé';
                $lien_http='';
                $date_ouverture=$request->read('date_ouverture');
                $date_fermeture=$request->read('date_fermeture');
                $mode_acces=$request->read('mode_acces');
                $questio = Questionnaire::create($id,$titre, 'sans aucun description', $etat, $date_ouverture, $date_fermeture ,$mode_acces,$lien_http);
                if(!isset($questio)) {
                    $view = new View($this);
                    $view->setArg('inscErrorText', 'Cannot complete creation');
                    $view->render();
                } 
                else 
                {
                    $this->linkTo('Questionnaire','showQuest');
                }
          //*  echo "ON VA CREER TON QUESTIONNAIRE";
        }
    }
        public function showQuest($request){
            echo "On affichera TON QUESTIONNAIRE";
           /* $view = new View($this,'profile/login');
        $view->render();*/
        }
    
}
 