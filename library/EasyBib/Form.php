<?php
/**
 * @category EasyBib
 * @package  Form
 * @author   Michael Scholl <michael@sch0ll.de>
 * @license  Apache 2.0
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
 * @license  Apache 2.0
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
