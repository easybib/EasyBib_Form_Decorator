<?php

class DecoratorBootstrapTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ExampleForm/EasyBib_Form $form
     */
    protected $form;

    /**
     * @var Zend_View $view
     */
    protected $view;

    /**
     * setUp
     *
     * @return void
     */
    protected function setUp()
    {
        $this->view = new Zend_View();
        $this->form = new TestForm();
        $this->form->setView($this->view);

        // form config
        $this->form->setMethod('POST');
        $this->form->setAction('DecoratorTest.php');
        $this->form->setAttrib('id', 'testForm');
        $this->form->setAttrib('class', 'form-horizontal');
    }

    /**
     * tearDown
     *
     * @return void
     */
    protected function tearDown()
    {
        unset($this->form);
        unset($this->view);
    }

    public function testTextElement()
    {
        $decorators = $this->form->getElement('email')->getDecorators();
        $this->bootstrapAssertions($decorators);
    }

    public function testMultiRadioElement()
    {
        $decorators = $this->form->getElement('radio')->getDecorators();
        $this->bootstrapAssertions($decorators);
        $this->assertSame('radio', $this->form->getElement('radio')->getAttrib('label_class'));
        $this->assertSame('', $this->form->getElement('radio')->getSeparator());
    }

    public function testMultiCheckboxElement()
    {
        $decorators = $this->form->getElement('multi')->getDecorators();
        $this->bootstrapAssertions($decorators);
        $this->assertSame('checkbox', $this->form->getElement('multi')->getAttrib('label_class'));
        $this->assertSame('', $this->form->getElement('radio')->getSeparator());
    }

    public function testCaptchaElement()
    {
        $this->markTestSkipped("Removed captcha test");

        $decorators = $this->form->getElement('captcha')->getDecorators();
        $this->bootstrapAssertions($decorators, false);
        $validator = $this->form->getElement('captcha')->getValidator('Zend_Captcha_Figlet');
        $this->assertSame('Zend_Captcha_Figlet', get_class($validator));
    }

    public function testFileElement()
    {
        $decorators = $this->form->getElement('file')->getDecorators();
        $this->bootstrapAssertions($decorators, false);
        $this->assertTrue(isset($decorators['Zend_Form_Decorator_File']));
    }

    public function testHiddenElement()
    {
        $decorators = $this->form->getElement('id')->getDecorators();
        $this->assertEquals(1, count($decorators));
        $this->assertArrayHasKey('Zend_Form_Decorator_ViewHelper', $decorators);
    }

    public function testSubmitElement()
    {
        $decorators = $this->form->getElement('submit')->getDecorators();
        $this->assertEquals(2, count($decorators));
        $this->assertArrayHasKey('Zend_Form_Decorator_ViewHelper', $decorators);
        $this->assertArrayHasKey('Zend_Form_Decorator_HtmlTag', $decorators);
        $this->assertSame('form-actions', $decorators['Zend_Form_Decorator_HtmlTag']->getOption('class'));
        $this->assertSame(array('btn', 'btn-primary'), $this->form->getElement('submit')->getAttrib('class'));
        $this->assertTrue($this->form->getElement('submit')->getDecorator('HtmlTag')->getOption('openOnly'));
    }

    public function testCancelElement()
    {
        $decorators = $this->form->getElement('cancel')->getDecorators();
        $this->assertEquals(2, count($decorators));
        $this->assertArrayHasKey('Zend_Form_Decorator_ViewHelper', $decorators);
        $this->assertArrayHasKey('Zend_Form_Decorator_HtmlTag', $decorators);
        $this->assertSame(array('btn'), $this->form->getElement('cancel')->getAttrib('class'));
        $this->assertTrue($this->form->getElement('cancel')->getDecorator('HtmlTag')->getOption('closeOnly'));
    }

    public function testFormElement()
    {
        $decorators = $this->form->getDecorators();
        $this->assertEquals(2, count($decorators));
        $this->assertArrayHasKey('Zend_Form_Decorator_FormElements', $decorators);
        $this->assertArrayHasKey('Zend_Form_Decorator_Form', $decorators);
    }

    public function testDisplayGroupElement()
    {
        $decorators = $this->form->getDisplayGroup('users')->getDecorators();
        $this->assertEquals(2, count($decorators));
        $this->assertArrayHasKey('Zend_Form_Decorator_FormElements', $decorators);
        $this->assertArrayHasKey('Zend_Form_Decorator_Fieldset', $decorators);
    }

    protected function bootstrapAssertions($decorators, $view = true)
    {
        $this->assertArrayHasKey('Zend_Form_Decorator_HtmlTag', $decorators);
        $this->assertArrayHasKey('Zend_Form_Decorator_Label', $decorators);
        $this->assertArrayHasKey('EasyBib_Form_Decorator_BootstrapTag', $decorators);
        $this->assertArrayHasKey('EasyBib_Form_Decorator_BootstrapErrors', $decorators);
        $this->assertArrayHasKey('Zend_Form_Decorator_Description', $decorators);
        if ($view === true) {
            $this->assertArrayHasKey('Zend_Form_Decorator_ViewHelper', $decorators);
        }

        $this->assertSame('control-group', $decorators['Zend_Form_Decorator_HtmlTag']->getOption('class'));
        $this->assertSame('controls', $decorators['EasyBib_Form_Decorator_BootstrapTag']->getOption('class'));
        $this->assertSame('control-label', $decorators['Zend_Form_Decorator_Label']->getOption('class'));
        $this->assertSame('p', $decorators['Zend_Form_Decorator_Description']->getOption('tag'));
        $this->assertSame('help-block', $decorators['Zend_Form_Decorator_Description']->getOption('class'));
    }

}
