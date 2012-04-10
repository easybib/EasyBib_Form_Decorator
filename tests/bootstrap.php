<?php

ini_set('display_errors', 1);

set_include_path(implode(PATH_SEPARATOR, array(
    '../library',
    get_include_path(),
)));

require ('Zend/Loader/Autoloader.php');
$autoloader = Zend_Loader_Autoloader::getInstance();
$autoloader->registerNamespace('EasyBib');

require ('TestForm.php');