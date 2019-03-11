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
        $className = ucfirst(strtolower($bar)); //Permet de respecter la convention de nommage
        $dirs = array('classes', 'model', 'controller', 'view');
        foreach ($dirs as $dir) {
            $path = implode('/', array(
                __ROOT_DIR,
                $dir,
                $className.'.class.php'
            ));
            if (is_readable($path)) {
                require_once($path);
                return;
            }
        }
        throw new \Error('File not found');
    }
}

$__LOADER = new AutoLoader(); 
?> 