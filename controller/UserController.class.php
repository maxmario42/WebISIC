<?php
    class UserController extends Controller {
        protected $user;
        
        
        public function __construct($request) {
            parent::__construct($request);
            session_start();
            $userId = NULL;
            $userId = $request->read('User');
            if(!is_null($userId))
            $this->user = User::getWithId($userId);
            
        }

        public function defaultAction($currentRequest){
            $view = new UserView($this,'profile/login', array('user' => $this->user));
            $view->render();
        }

        public function profile($args) {
            $v = new UserView($this,'profile/view', array('user' => $this->user));
            $v->render();
        }

        public function disconnect($args) {
            if(isset($_SESSION))
                session_destroy();
            //echo  "URL = " . __BA::SE_URL;
            header("Location: index.php");
        }
    }

?>
