<?php

class ExampleForm extends EasyBib_Form
{
    public function init()
    {

        // create elements
        $userId      = new Zend_Form_Element_Hidden('id');
        $mail        = new Zend_Form_Element_Text('email');
        $name        = new Zend_Form_Element_Text('name');
        $radio       = new Zend_Form_Element_Radio('radio');
        $file        = new Zend_Form_Element_File('file');
        $multi       = new Zend_Form_Element_MultiCheckbox('multi');
        $captcha     = new Zend_Form_Element_Captcha('captcha', array('captcha' => 'Figlet'));
        $submit      = new Zend_Form_Element_Button('submit');
        $cancel      = new Zend_Form_Element_Button('cancel');

        // config elements

        $mail->setLabel('Mail:')
            ->setAttrib('placeholder', 'data please!')
            ->setRequired(true)
            ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis fringilla purus eget ante ornare vitae iaculis est varius.')
            ->addValidator('emailAddress');

        $name->setLabel('Name:')
            ->setRequired(true);

        $radio->setLabel('Radio:')
            ->setMultiOptions(array('1' => PHP_EOL . 'test1', '2' => PHP_EOL . 'test2'))
            ->setRequired(true);

        $file->setLabel('File:')
            ->setRequired(true)
            ->setDescription('Check file upload');

        $multiOptions = array(
            'view'    => PHP_EOL . 'view',
            'edit'    => PHP_EOL . 'edit',
            'comment' => PHP_EOL . 'comment'
        );
        $multi->setLabel('Multi:')
            ->addValidator('Alpha')
            ->setMultiOptions($multiOptions)
            ->setRequired(true);

        $captcha->setLabel('Captcha:')
            ->setRequired(true)
            ->setDescription("This is a test");

        $submit->setLabel('Save')
            ->setAttrib('type', 'submit');
        $cancel->setLabel('Cancel');

        // add elements
        $this->addElements(array(
            $userId, $mail, $name, $radio, $file, $captcha, $multi, $submit, $cancel
        ));

        // add display group
        $this->addDisplayGroup(
            array('email', 'name', 'radio', 'multi', 'file', 'captcha', 'submit', 'cancel'),
            'users'
        );

        // set decorators
        EasyBib_Form_Decorator::setFormDecorator($this, EasyBib_Form_Decorator::BOOTSTRAP_MINIMAL, 'submit', 'cancel');

    }

}