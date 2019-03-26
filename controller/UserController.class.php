<?php
    class UserController extends Controller {
        protected $user;
        
        
        public function __construct($request) {
            parent::__construct($request);
            session_start();
            
            if (!isset($_SESSION['UserID'])){
                throw new Exception("No User id in Session");    
            }
            $userId = $_SESSION['UserID'];
            $this->user = User::getWithId($userId);
            //var_dump($this->user);
        }

        public function defaultAction($currentRequest){
            $view = new UserView($this, 'home',array('user' => $this->user));
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
