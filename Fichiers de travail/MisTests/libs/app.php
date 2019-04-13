<?php
    require_once 'controllers/error.php';
    error_reporting(E_ALL);
    ini_set("display_errors", E_ALL);
class App
{   

    function __construct()
    {
        echo "<p>Nueva app</p>";
        $url = isset($_GET['url']) ? $_GET['url']:null;

        $url = rtrim($url, '/');
        // echo( $url);
        $url = explode('/', $url); //buscar un separador para obtener
        //los parametros correctos de la url
        //var_dump($url); //control de los parametros de mi controlador.
        if(empty($url[0])){
            $archivoController = 'controllers/main.php';
            require_once $archivoController;
            $controller = new Main();
            return false;
        }
        $archivoController = 'controllers/' . $url[0] . '.php';
        //echo $archivoController;
        if (file_exists($archivoController)) {
            require_once $archivoController;
            $controller = new $url[0];
            if(isset($url[1])){
                $controller->{$url[1]}(); 
                //application de la action sur le controller
            }
        }else{
            
            $controller= new Error1();

        }
    }
}
 