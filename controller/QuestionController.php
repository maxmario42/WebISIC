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
        $intitule = $this->request->read('intitule');
        if (Question::isUsed($intitule,'INTITULE'))
        {
                $view = new View($this, 'question/creerQuestion');
                $view->setArg('user',$this->request->getUserObject());
                $view->setArg('inscErrorText', 'This title is already used');
                $view->render();
                echo ("<script>alert('Vous avez déjà crée une questionnaire avec cette titre...');</script>");
        } 
        else 
        {
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
    }
}
?>