<?php
require_once(__ROOT_DIR . '/classes/MyObject.class.php');
class AutoLoader extends MyObject
{
    public function __construct()
    {
        spl_autoload_register(array($this, 'load'));
    }
    private function load($className)
    {
        $dirs = array('classes', 'model', 'repository', 'controller', 'view');
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
