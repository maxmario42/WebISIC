<?php

class QuestionnaireController extends Controller
{ 
    protected $questio;

    public function __construct($currentRequest)
    {
        parent::__construct($currentRequest);
        $this->protection(); //pour qu'une personne n'essai pas de forcer l'entree sur cette page.
    }

    public function defaultAction($request)
    {   //echo "you are in the questionnaire controller";
        $view = new UserView($this, 'questionnaire/creerQuestionnaire', array('user' => $request->getUserObject()));
        $view->render();
    }

    public function newQuest($request)
    {   
        $titre = $request->read('titre');
        Questionnaire::isTitreUsed($titre);
        if (Questionnaire::isTitreUsed($titre))
        {
                $view = new UserView($this, 'questionnaire/creerQuestionnaire', array('user' => $request->getUserObject()));
                $view->setArg('inscErrorText', 'This title is already used');
                $view->render();
                echo ("<script>alert('Vous avez déjà crée une questionnaire avec cette titre...');</script>");
        } 
        else 
        {
            $description= $request->read('description');
            $idU=(int)$request->getUserObject()->ID;
            $etat="Fermé";
            $lien_http="";
            $date_ouverture=$request->read('date_ouverture');
            $date_fermeture=$request->read('date_fermeture');
            $mode_acces=$request->read('mode_acces');
            $questio = Questionnaire::create($idU,$titre,$description, $etat,$date_ouverture,$date_fermeture,$mode_acces,$lien_http);
           
            if(!isset($questio)) 
            {
                $view = new UserView($this, 'questionnaire/creerQuestionnaire', array('user' => $request->getUserObject()));
                $view->setArg('inscErrorText', 'Cannot complete creation');
                $view->render();
            } 
            else 
            {  
                  echo "ON VA CREER TON QUESTIONNAIRE";
              // $this->linkToID('Questionnaire','showQuiz');
            }
          
        }
    }
    public function showQuiz($request){
        echo "On va afficher seulement une questionnaire";
        $idq = $request->getParameter('id'); //recupere le parametre en get de l'ID du questionnaire de l'url.
        $quiz=Questionnaire::showQuiz($idq);
        //($quiz);
        $view = new UserView($this,'questionnaire/showQuestionnaire', array('user' => $request->getUserObject(), 'quiz' => $quiz));
        $view->render(); 
        /*TO DO, on veut afficher ici seulement l'information d'une questionnaire*/ 
    }

    public function showQuest($request){
        $questionnaires= Questionnaire::showQuest($request->getUserObject()->ID);
        ($questionnaires);
       
       $view = new UserView($this,'questionnaire/listQuestionnaire', array('user' => $request->getUserObject(), 'questionnaire' => $questionnaires));
      //$view->setArg('questionnaire',$questionnaires);
       //($view->getArg('questionnaire'));
       //echo "On affichera TA Liste des QUESTIONNAIRES";
        $view->render();
    } 

    public function edit($request)
    //Appelle la vue pour mettre à jour nos informations
    {
        $v = new UserView($this,'questionnaire/editQuestionnaire', array('user' => $request->getUserObject(), 'questionnaire' => $this->questio));
        $v->render();
    }

    public function edition($request)
    //Permet de mettre à jour les informations d'un utilisateur. Fonctionne sur tout les types.
    {
        $titre = $request->read('titre');
        if(Questionnaire::isTitreUsed($titre)) 
        {
            $view = new UserView($this,'questionnaire/editQuestionnaire',array('user' => $request->getUserObject(), 'questionnaire' => $this->questio));
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
                $view = new UserView($this,'questionnaire/editQuestionnaire',array('user' => $request->getUserObject(), 'questionnaire' => $this->questio));
                $view->setArg('inscErrorText', 'Cannot complete Edition');
                $view->render();
            } 
            else 
            {
                $this->linkTo('Questionnaire','showQuiz');
            }                    
        }
    }
}
?>