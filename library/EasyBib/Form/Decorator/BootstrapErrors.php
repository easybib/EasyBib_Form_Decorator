<?php
/**
 * @category   EasyBib
 * @package    EasyBib_Form
 * @subpackage Decorator
 * @author     Michael Scholl <michael@sch0ll.de>
 * @license    Apache 2.0
 * @version    GIT: <git_id>
 * @link       https://github.com/easybib/EasyBib_Form_Decorator
 */

/**
 * Ez_Form_Decorator_BootstrapErrors
 *
 * Wraps errors in span with class help-block
 *
 * @category   EasyBib
 * @package    EasyBib_Form
 * @subpackage Decorator
 * @author     Michael Scholl <michael@sch0ll.de>
 * @license    Apache 2.0
 * @version    Release: @package_version@
 * @link       https://github.com/easybib/EasyBib_Form_Decorator
 */
class EasyBib_Form_Decorator_BootstrapErrors extends Zend_Form_Decorator_HtmlTag
{
    /**
     * Render content wrapped in an HTML tag
     *
     * @param string $content
     *
     * @return string
     */
    public function render($content)
    {
        $element = $this->getElement();
        $view    = $element->getView();
        if (null === $view) {
            return $content;
        }

        $errors = $element->getMessages();
        if (empty($errors)) {
            return $content;
        }

        $separator = $this->getSeparator();
        $placement = $this->getPlacement();

        $formErrorHelper = $view->getHelper('formErrors');
        $formErrorHelper->setElementStart('<span%s>')
            ->setElementSeparator(' | ')
            ->setElementEnd('</span>');

        $errors = $formErrorHelper->formErrors(
            $errors, array('class' => 'help-block')
        );

        switch ($placement) {
        case 'PREPEND':
            return $errors . $separator . $content;
        case 'APPEND':
        default:
            return $content . $separator . $errors;
        }
    }
}
