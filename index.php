<?php
error_reporting(E_ALL);
ini_set("display_errors", E_ALL);

// define __ROOT_DIR constant which contains the absolute path on disk 
// of the directory that contains this file (index.php) 
// e.g. for http://eden.imt-lille-douai.fr/~luc.fabresse/index.php 
// __ROOT_DIR = /home/luc.fabresse/public_html 
error_reporting(E_ALL);
ini_set("display_errors", E_ALL);
$rootDirectoryPath = realpath(dirname(__FILE__)); 
define ('__ROOT_DIR', $rootDirectoryPath );

// define __BASE_URL constant which contains the URL PATH of the index.php 
// e.g. for http://eden.imt-lille-douai.fr/~luc.fabresse/index.php 
// __BASE_URL = /web01 
$base_url = explode('/',$_SERVER['PHP_SELF']); 
array_pop($base_url); 
define ('__BASE_URL', implode('/',$base_url) );

// Load all application config 
require_once(__ROOT_DIR . "/config/config.php");

// Load the Loader class to automatically load classes when needed 
require_once(__ROOT_DIR . '/classes/AutoLoader.class.php');

// Reify the current request 
$request = Request::getCurrentRequest();
try { 
    $controller = Dispatcher::dispatch($request); 
    $controller->execute(); 
} catch (Exception $e) { 
    $controller = new ErrorController($request);
    $controller->setError(new Error($e->getMessage()));
    $controller->execute();
} catch (Error $e) {
    $controller = new ErrorController($request);
    $controller->setError($e);
    $controller->execute();
}
?>
