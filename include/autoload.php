<?php
spl_autoload_register('myAutoloader');
function myAutoloader($className)
{
    $path = 'src/';
    $dirs = array(
            'Controller/', 
            'Model/', 
            'View/', 
        );
    foreach( $dirs as $dir ) {
            if (file_exists($path.$dir.$className.'.php')) {
                include $path.$dir.$className.'.php';
                return;
            }
        }    
}
?>