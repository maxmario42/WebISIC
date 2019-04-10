<?php

class QuestionnaireController extends Controller
{ protected $questio;

    public function __construct($currentRequest) {
        parent::__construct($currentRequest);
        $this->protection(); //pour qu'une personne n'essai pas de forcer l'entree sur cette page.
    }

    public function defaultAction($request)
    {   //echo "you are in the questionnaire controller";
        $view = new UserView($this, 'questionnaire/creerQuestionnaire', array('user' => $this->user));
        $view->render();
    }

    public function newQuest($request)
    {   
        $titre = $request->read('titre');
        Questionnaire::isTitreUsed($titre);
        if (Questionnaire::isTitreUsed($titre)) {
                $view = new UserView($this, 'questionnaire/creerQuestionnaire', array('user' => $this->user));
                $view->setArg('inscErrorText', 'This title is already used');
                $view->render();
                echo ("<script>alert('Vous avez déjà crée une questionnaire avec cette titre...');</script>");
            } else {
                $description= $request->read('description');
                $idU=(int)$this->user->ID;
                $idU;
                $etat="Fermé";
                $lien_http="";
                $date_ouverture=$request->read('date_ouverture');
               
                $date_fermeture=$request->read('date_fermeture');
                $mode_acces=$request->read('mode_acces');
                $questio = Questionnaire::create($idU,$titre,$description, $etat,$date_ouverture,$date_fermeture,$mode_acces,$lien_http);
                
                if(!isset($questio)) {
                    $view = new UserView($this, 'questionnaire/creerQuestionnaire', array('user' => $this->user));
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
            $view = new UserView($this,'questionnaire/showQuestionnaire', array('user' => $this->user, 'questionnaire' => $this->questio));
            $view->render();
        } 

        public function edit($request)
        //Appelle la vue pour mettre à jour nos informations
        {
            $v = new UserView($this,'questionnaire/editQuestionnaire', array('user' => $this->user, 'questionnaire' => $this->questio));
            $v->render();
        }

        public function edition($request)
        //Permet de mettre à jour les informations d'un utilisateur. Fonctionne sur tout les types.
        {
            $titre = $request->read('titre');
            if(Questionnaire::isTitreUsed($titre)) 
            {
                $view = new UserView($this,'questionnaire/editQuestionnaire',array('user' => $this->user, 'questionnaire' => $this->questio));
                $view->setArg('inscErrorText','This title is already used');
                $view->render();
                echo("<script>alert('Vous avez un questionnaire avec le même titre...');</script>");  
            } 
            else 
            {
                $etat="Fermé";
                $description=$request->read('description');
                $date_ouverture=$request->read('date_ouverture');
                $date_fermeture=$request->read('date_fermeture');
                $mode_acces=$request->read('mode_acces');
                $questio = Questionnaire::update($this->questio->IDQ,$titre, $description,$etat,$date_ouverture,$date_fermeture,$mode_acces);
                if(!isset($questio)) 
                {
                    $view = new UserView($this,'questionnaire/editQuestionnaire',array('user' => $this->user, 'questionnaire' => $this->questio));
                    $view->setArg('inscErrorText', 'Cannot complete Edition');
                    $view->render();
            } 
                else 
                {
                    $this->linkTo('Questionnaire','showQuest');
                }
                       
                    
                
              
            }
        }
    
}
?>