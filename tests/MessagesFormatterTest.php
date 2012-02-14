<?php

class MessagesFormatterTest extends PHPUnit_Framework_TestCase
{

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
        $this->view->addHelperPath('EasyBib/View/Helper', 'EasyBib_View_Helper');
    }

    /**
     * tearDown
     *
     * @return void
     */
    protected function tearDown()
    {
        unset($this->view);
    }

    public function testStringUsage()
    {
        $message = 'This is a test';
        $output  = $this->view->messagesFormatter($message);
        $this->assertContains($message, $output);
        $this->assertSame('<div class="alert alert-warning">' . $message . '</div>', $output);
    }

    public function testArrayUsage()
    {
        $message = array('success', 'This is a test');
        $output  = $this->view->messagesFormatter($message);
        $this->assertContains($message[1], $output);
        $this->assertSame('<div class="alert alert-' . $message[0] . '">' . $message[1] . '</div>', $output);
    }

    public function testMultiArrayUsage()
    {
        $message = array(
            array('success', 'This is a test'),
            array('notice', 'Test 2'),
        );
        $output  = $this->view->messagesFormatter($message);
        $this->assertContains($message[0][1], $output);
        $this->assertContains($message[1][1], $output);
        $this->assertSame('<div class="alert alert-' . $message[0][0] . '">' .
            $message[0][1] . '</div><div class="alert alert-' . $message[1][0] . '">' .
            $message[1][1] . '</div>', $output);
    }

    public function testOtherParameter()
    {
        $message = array('success', 'This is a test');
        $output  = $this->view->messagesFormatter($message, 'p', 'other');
        $this->assertContains($message[1], $output);
        $this->assertSame('<p class="' . $message[0] . '">' . $message[1] . '</p>', $output);

        $message = array('warning', 'This is a test');
        $output  = $this->view->messagesFormatter($message, 'span', 'other');
        $this->assertContains($message[1], $output);
        $this->assertSame('<span class="' . $message[0] . '">' . $message[1] . '</span>', $output);
    }

}