<?php

ini_set('display_errors', 1);

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    '../library',
    get_include_path(),
)));

// Autoloader
require ('Zend/Loader/Autoloader.php');
$autoloader = Zend_Loader_Autoloader::getInstance();
$autoloader->registerNamespace('EasyBib');

// objects
require ('ExampleForm.php');
$view = new Zend_View();
$form = new ExampleForm();
$form->setView($view);

// form config
$form->setMethod('POST');
$form->setAction('DecoratorExample.php');
$form->setAttrib('id', 'testForm');
$form->setAttrib('class', 'well');

if (!empty($_POST)) {
    $form->isValid($_POST);
    $form->getElement('email')->addError('test');
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>TestForm</title>
        <!-- <link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.3.0/bootstrap.min.css"> -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
    </head>
    <body>
       <h1>TestForm</h1>
       <?php echo $form->render(); ?>

    </body>
</html>
