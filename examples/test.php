<?php
/**
 * @desc Makes debugging easier. :)
 */
ini_set('display_errors', 1);

/**
 * @desc General setup!
 */
$dir   = array();
$dir[] = dirname(__DIR__) . '/library';
$dir[] = '/path/to/Zend-Framework/library';
$dir[] = dirname(__DIR__) . '/docs';

set_include_path(implode(':', $dir) . ':' . get_include_path());

/**
 * PSR-0 is beautiful.
 *
 * @param string $className Name of the class to load.
 *
 * @return boolean
 */
function EasyBib_autoload($className) {
    $file = str_replace('_', '/', $className) . '.php';
    return include $file;
}
spl_autoload_register('EasyBib_autoload');

$form = new ExampleForm();

// success!!!
