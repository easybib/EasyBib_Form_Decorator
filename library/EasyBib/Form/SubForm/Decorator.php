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
 * @package  EasyBib_Form
 * @author   Michael Scholl <michael@sch0ll.de>
 * @license  http://www.opensource.org/licenses/mit-license.html MIT License
 * @version  git: $id$
 * @link     https://github.com/easybib/EasyBib_Form_Decorator
 */

/**
 * Default Decorators Set
 *
 * General usage:
 * EasyBib_Form_Decorator::setFormDecorator($form, 'div', 'submit', 'cancel');
 * EasyBib_Form_Decorator::setFormDecorator(
 *   Instance of form,
 *   Decorator Mode - 3 different options:
 *      - EasyBib_Form_Decorator::TABLE     (html table style)
 *      - EasyBib_Form_Decorator::DIV       (div style)
 *      - EasyBib_Form_Decorator::BOOTSTRAP (twitter bootstrap style)
 *   Name of submit button,
 *   Name of cancel button
 * );
 *
 * @category EasyBib
 * @package  EasyBib_Form
 * @author   Michael Scholl <michael@sch0ll.de>
 * @license  http://www.opensource.org/licenses/mit-license.html MIT License
 * @version  Release: @package_version@
 * @link     https://github.com/easybib/EasyBib_Form_Decorator
 */
class EasyBib_Form_SubDecorator extends EasyBib_Form_Decorator
{
    /**
     * Form Element Decorator
     *
     * @staticvar array
     */
    protected static $_FormDecorator = array(
        'table' => array(
            'FormElements',
        ),
        'div' => array(
            'FormElements',
        ),
        'bootstrap' => array(
            'FormElements',
        )
    );
    
     /**
      * Set the subform decorators by the given string format or by the default div style
      *
      * @param object $objSubForm        Zend_Form_SubForm pointer-reference
      * @param string $constFormat    Project_Plugin_FormDecoratorDefinition constants
      * @return NULL
      */
     public static function setFormDecorator(Zend_Form_SubForm $form, $format = self::BOOTSTRAP, $submit_str = 'submit', $cancel_str = 'cancel') {
         parent::setFormDecorator($form, $format, $submit_str, $cancel_str);
         $form->setDecorators(self::$_FormDecorator[$format]);
 
     }
 }

}
