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
 * @author   Michael Scholl <michael@sch0ll.de>
 * @license  http://www.opensource.org/licenses/mit-license.html MIT License
 * @version  GIT: <git_id>
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
 * @author   César <cesar.bmcosta@gmail.co>
 * @author   Seth Miller <cr125rider@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html MIT License
 * @version  Release: @package_version@
 * @link     https://github.com/easybib/EasyBib_Form_Decorator
 */
class EasyBib_Form extends Zend_Form
{
    /**
     * @var mixed
     */
    protected $model;

    /**
     * Return the model.
     *
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the model.
     *
     * @param mixed $model
     *
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * Proxy to {@link Zend_Form::isValid()}.
     *
     * Calls {@link self::buildBootstrapErrorDecorators()} for
     * {@link parent::isValid()} returning false.
     *
     * @param array $data
     *
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
     *
     * @return void
     * @todo   Why call {@link parent::getSubForms()} twice?
     */
    public function buildBootstrapErrorDecorators()
    {
        $subForms   = $this->getSubForms();
        $styleClass = 'error';

        $messages = array_merge($this->getErrors(), $this->getMessages());
        foreach ($messages as $key => $errors) {
            if (empty($errors)) {
                continue;
            }
            if (true === array_key_exists($key, $subForms)) {
                $subForm = $this->getSubForm($key); // why not re-use the $subForms?

                foreach ($errors as $subKey => $subErrors) {
                    if (empty($subErrors)) {
                        continue;
                    }
                    $this->setClassToAnElement(
                        $subForm->getElement($subKey),
                        $styleClass
                    );
                }
                continue;
            }
            $this->setClassToAnElement($this->getElement($key), $styleClass);
        }
    }

    /**
     * Set an error class into element HtmlTag decorator
     *
     * @param Zend_Form_Element $element    Element to 'decorate' for the error.
     * @param string            $styleClass CSS class name.
     *
     * @return void
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
