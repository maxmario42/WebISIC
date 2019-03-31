<?php
class Main extends Controller1{

    function __construct()
    { parent::__construct();
        echo "<p> Nuevo controlador  Main</p>";
        $this->view->render('main/index');
    }

    function saludo(){
        echo "<p>Ejecutaste el método saludo</p>";
    }
}

?>