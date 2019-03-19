<?php
    class UserController extends Controller {
        protected $user;
        
        
        public function __construct($request) {
            parent::__construct($request);
            session_start();
            $userId = NULL;
            
            $userId = $request->read('user');
            if(!is_null($userId))
            $this->user = User::getWithId($userId);
            
        }


        public function defaultAction($currentRequest){
            //if (is_null($this->user)){
              //  echo('user is null');}
            $view = new View($this,'profile/login');
            $view ->setUser($this->user);
            
            $view->render();
        }


        public function profileAction($args) {
            $v = new View($this->user,'profile/view');
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

<?php
/*
class UserController extends Controller
{
    public function defaultAction($request)
    {
        $view = new View($this);
        $view->render();
    }
    public function profileAction($request)
    {
        $id = $this->request->GET('id');
        if ($id) {
            $user = User::find($this->request->GET('id'));
        } else {
            $user = $this->request->getUser();
        }
        if (!$user || !$user->isInDb()) {
            throw new Error('Ce profil n\'existe pas', 404);
        }
        $view = new View($this, 'profile/view');
        $view->setArg('user', $user);
        $view->render();
    }

    public function isLoginUsed($key){

    }
  
}
*/
?>
