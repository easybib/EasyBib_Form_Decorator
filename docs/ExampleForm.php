<?php
/**
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 *
 * PHP Version 5
 *
 * @category EasyBib
 * @package  ExampleForm
 * @author   Michael Scholl <michael@sch0ll.de>
 * @license  http://www.opensource.org/licenses/mit-license.html MIT License
 * @version  git: $id$
 * @link     https://github.com/easybib/EasyBib_Form_Decorator
 */

/**
 * Example Form
 *
 * @category EasyBib
 * @package  ExampleForm
 * @author   Michael Scholl <michael@sch0ll.de>
 * @license  http://www.opensource.org/licenses/mit-license.html MIT License
 * @version  Release: @package_version@
 * @link     https://github.com/easybib/EasyBib_Form_Decorator
 */
class ExampleForm extends EasyBib_Form
{
    /**
     * Configure user form.
     *
     * @return void
     */
    public function init()
    {
        // form config
        $this->setMethod('POST');
        $this->setAction('/test/add');
        $this->setAttrib('id', 'testForm');

        /**
         * Add class to form for label alignment
         *
         * - Vertical   .form-vertical   (not required)	Stacked, left-aligned labels over controls (default)
         * - Inline     .form-inline     Left-aligned label and inline-block controls for compact style
         * - Search     .form-search     Extra-rounded text input for a typical search aesthetic
         * - Horizontal .form-horizontal
         *
         * Use .form-horizontal to have same experience as with Bootstrap v1!
         */
        $this->setAttrib('class', 'form-horizontal');

        // create elements
        $userId      = new Zend_Form_Element_Hidden('id');
        $mail        = new Zend_Form_Element_Text('email');
        $name        = new Zend_Form_Element_Text('name');
        $radio       = new Zend_Form_Element_Radio('radio');
        $multi       = new Zend_Form_Element_MultiCheckbox('multi');
        $captcha     = new Zend_Form_Element_Captcha('captcha', array('captcha' => 'Figlet'));
        $submit      = new Zend_Form_Element_Button('submit');
        $cancel      = new Zend_Form_Element_Button('cancel');

        // config elements
        $userId->addValidator('digits');

        $mail->setLabel('Mail:')
            ->setRequired(true)
            ->addValidator('emailAddress');

        $name->setLabel('Name:')
            ->setRequired(true);

        $radio->setLabel('Radio:')
            ->setMultiOptions(array(
                '1' => PHP_EOL . 'test1',
                '2' => PHP_EOL . 'test2'
            ))
            ->setRequired(true);

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

        $submit->setLabel('Save');
        $cancel->setLabel('Cancel');

        // add elements
        $this->addElements(array(
            $userId, $mail, $name, $radio, $multi, $captcha, $submit, $cancel
        ));

        // add display group
        $this->addDisplayGroup(
            array('email', 'name', 'radio', 'multi', 'captcha', 'submit', 'cancel'),
            'users'
        );
        $this->getDisplayGroup('users')->setLegend('Add User');

        // set decorators
        EasyBib_Form_Decorator::setFormDecorator($this, EasyBib_Form_Decorator::BOOTSTRAP, 'submit', 'cancel');

    }

    /**
     * Validate the form
     *
     * @param  array $data
     * @return boolean
     */
    public function isValid($data)
    {
        if (!is_array($data)) {
            require_once 'Zend/Form/Exception.php';
            throw new Zend_Form_Exception(__METHOD__ . ' expects an array');
        }
        if ($data['name'] == 'xyz') {
            $this->getElement('name')->addError('Wrong name provided!');
        }
        return parent::isValid($data);
    }
}
