<?php
require_once 'libs/controller.php';
    class Error1 extends Controller1{
        function __construct(){
            parent::__construct();
            $this->view->mensaje = "Error genérico";
            $this->view->render('error/index');
            //echo "<p>Error al cargar recurso</p>";
        }
    }
?>