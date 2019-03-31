<?php
 require_once 'libs/app.php';
 require_once 'libs/controller.php';
 require_once 'libs/view.php';
 require_once 'libs/model.php';
 
 $rootDirectoryPath = realpath(dirname(__FILE__)); 
define ('__ROOT_DIR', $rootDirectoryPath );
 $app= new App();
?>