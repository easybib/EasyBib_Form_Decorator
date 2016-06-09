<?php
/**
 * @category EasyBib
 * @package  EasyBib_Form
 * @author   Michael Scholl <michael@sch0ll.de>
 * @license  Apache 2.0
 * @version  GIT: <git_id>
 * @link     https://github.com/easybib/EasyBib_Form_Decorator
 */

/**
 * Default Decorators Set
 *
 * This is used to style subforms. These defaults will allow decorators to be applied
 * to subforms that are within current forms.
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
 * @author   César <cesar.bmcosta@gmail.co>
 * @author   Seth Miller <cr125rider@gmail.com>
 * @license  Apache 2.0
 * @version  Release: @package_version@
 * @link     https://github.com/easybib/EasyBib_Form_Decorator
 */
class EasyBib_Form_SubForm_Decorator extends EasyBib_Form_Decorator
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
}
