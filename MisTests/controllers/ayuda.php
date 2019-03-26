<?php
//require_once 'libs/controller.php';
class Ayuda extends Controller1{

    function _construct(){
            parent::__construct();
            $this->view->mensaje = "menu ayuda";
            $this->view->render('ayuda/index');
    }
}
?>