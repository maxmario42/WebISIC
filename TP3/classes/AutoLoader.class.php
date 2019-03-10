<?php
// Load my root class 
require_once(__ROOT_DIR . '/classes/MyObject.class.php');

class AutoLoader extends MyObject {
    public function __construct() { 
        spl_autoload_register(array($this, 'load')); 
    }
    // This method will be automatically executed by PHP whenever it encounters 
    // an unknown class name in the source code 
    private function load($className) { 
        $temp = strtolower ($className);
        $nom = ucfirst ($temp) . '.class.php';
        $trouve = false;
        if (is_readable (__ROOT_DIR . '/classes/'.$nom)){
            $chemin=__ROOT_DIR . '/classes/'.$nom;
            $trouve = true;
        }
        else if (is_readable (__ROOT_DIR . '/model/'.$nom)){
            $chemin=__ROOT_DIR . '/model/'.$nom;
            $trouve = true;
        }
        else if (is_readable (__ROOT_DIR . '/controller/'.$nom)){
            $chemin=__ROOT_DIR . '/controller/'.$nom;
            $trouve = true;
        }
        else if (is_readable (__ROOT_DIR . '/view/'.$nom)){
            $chemin=__ROOT_DIR . '/view/'.$nom;
            $trouve = true;
        }
        if ($trouve){
            require_once($chemin);
        }
    }
}

$__LOADER = new AutoLoader(); 
?> 