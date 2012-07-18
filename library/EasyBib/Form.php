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
 * @package  Form
 * @author   Michael Scholl <michael@sch0ll.de>, César <cesar.bmcosta@gmail.com>, Seth Miller <cr125rider@gmail.com> 
 * @license  http://www.opensource.org/licenses/mit-license.html MIT License
 * @version  git: $id$
 * @link     https://github.com/easybib/EasyBib_Form_Decorator
 */

/**
 * EasyBib_Form
 *
 * Extends Zend_Form
 * - provides model support
 * - provides buildBootstrapErrorDecorators method
 *   for adding css error classes to form if not valid
 *
 * @category EasyBib
 * @package  Form
 * @author   Michael Scholl <michael@sch0ll.de>
 * @license  http://www.opensource.org/licenses/mit-license.html MIT License
 * @version  Release: @package_version@
 * @link     https://github.com/easybib/EasyBib_Form_Decorator
 */

class EasyBib_Form extends Zend_Form
{
    protected $model;

    /**
     * @return the $model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }
    
    /**
     * Proxie to Zend_Form::isValid()
     * calls buildBootstrapErrorDecorators for parent::isValid() returning false
     *
     * @param  array $data
     * @return boolean
     */
    public function isValid($values)
    {
        $validCheck = parent::isValid($values);
        if ($validCheck === false) {
            $this->buildBootstrapErrorDecorators();
        }
        return $validCheck;
    }

    /**
     * Build Bootstrap Error Decorators
     */
    public function buildBootstrapErrorDecorators() 
    {
        $subForms = $this->getSubForms();
        $styleClass = 'error';
        foreach ($this->getErrors() as $key=>$errors) {
            if (empty($errors)) {
                continue;
            }
            if (array_key_exists($key, $subForms)) {
                $subForm = $this->getSubForm($key);
                
                foreach ($errors as $subKey => $subErrors) {
                    if (empty($subErrors)) {
                        continue;
                    }
                    $this->setClassToAnElement($subForm->getElement($subKey), $styleClass);
                }
            } else {
                $this->setClassToAnElement($this->getElement($key), $styleClass);
            }   
        }
    }

    /**
     * Set an error class into element HtmlTag decorator
     *
     * @param Zend_Form_Element $element
     * @return null
     */
    protected function setClassToAnElement(Zend_Form_Element $element, $styleClass)
    {
        $htmlTagDecorator = $element->getDecorator('HtmlTag');       
        
        if (!empty($htmlTagDecorator)) {
            $class = $htmlTagDecorator->getOption('class');
            $htmlTagDecorator->setOption('class', $class . ' ' . $styleClass);
        }

    }
}
