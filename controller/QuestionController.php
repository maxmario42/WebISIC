<?php
class QuestionController extends Controller
{
    public function __construct($currentRequest)
    {
        parent::__construct($currentRequest);
        $this->protection(); //pour qu'une personne n'essai pas de forcer l'entree sur cette page.
    }

    public function defaultAction($request)
    {  
        $view = new UserView($this, 'question/creerQuestion');
        $view->setArg('user',$request->getUserObject());
        $view->render();
    }

    public function newQuest($request)
    {   
        $intitule = $request->read('intitule');
        if (Question::isUsed($intitule,'INTITULE'))
        {
                $view = new UserView($this, 'question/creerQuestion');
                $view->setArg('user',$request->getUserObject());
                $view->setArg('inscErrorText', 'This title is already used');
                $view->render();
                echo ("<script>alert('Vous avez déjà crée une questionnaire avec cette titre...');</script>");
        } 
        else 
        {
            $idU=(int)$request->getUserObject()->ID;
            $typeq=$request->read('typeq');
            $temps_max=$request->read('temps_max');
            $questio = Question::create($idq, $intitule, $typeq, $temps_max);
            if(!isset($questio)) 
            {
                $view = new UserView($this, 'question/creerQuestion');
                $view->setArg('user',$request->getUserObject());
                $view->setArg('inscErrorText', 'Cannot complete creation');
                $view->render();
            } 
            else 
            {  
               $this->linkTo('Question','showQuest');
            }
        }
    }
}
?>