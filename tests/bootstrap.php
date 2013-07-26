<?php

ini_set('display_errors', 1);

set_include_path(implode(PATH_SEPARATOR, array(
    '../library:../vendor/easybib-core/zf1/library',
    get_include_path(),
)));

//require ('Zend/Loader/Autoloader.php');
//$autoloader = Zend_Loader_Autoloader::getInstance();
//$autoloader->registerNamespace('EasyBib');

$autoloader = dirname(__DIR__) . '/vendor/autoload.php';
if (!file_exists($autoloader)) {
    echo "Please `./composer.phar install`.";
    echo PHP_EOL;
    exit(1);
}
require $autoloader;

require ('TestForm.php');
