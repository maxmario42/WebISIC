<?php
    class UserController extends Controller {
        
        protected $user;
        
        public function __construct($request) 
        {
            parent::__construct($request);
            $userId = Request::getUser();
            $this->user = User::getWithId($userId);
        }

        public function defaultAction($currentRequest)
        {
            $view = new UserView($this, 'home',array('user' => $this->user));
            $view->render();
        }

        public function profile($args) 
        {
        //Appelle la vue qui affiche notre profil
            $v = new UserView($this,'profile/view', array('user' => $this->user));
            $v->render();
        }

        public function aPropos($currentrequest)
        //Appelle la vue qui retournera notre about Us
        {
            $view = new UserView($this,'apropos', array('user' => $this->user));
            $view->render();
        }

        public function disconnect($args) {
            Session::getInstance()->destroy();
            header("Location: index.php");
        }
    }

?>
