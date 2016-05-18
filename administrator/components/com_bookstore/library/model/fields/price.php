<?php
/**
 * @author
 * @copyright
 * @license
 */

defined("_JEXEC") or die("Restricted access");
JFormHelper::loadFieldClass('Text');

/**
 * Form field for Assessment items.
 *
 * @package        Bookstore
 * @subpackage    Fields
 */
class JFormFieldPrice extends JFormFieldText
{
    /**
     * The form field type.
     *
     * @var    string
     * @since  11.1
     */

    protected $type = 'price';

    /**
     * Method to get the field input markup.
     *
     * @return  string  The field input markup.
     */
    protected function getInput()
    {

        $html = '<span class="add-on">&nbsp;&euro;&nbsp;</span>';
        $html .= parent::getInput();
        return $html;

    }
    /**
     * Method to get a control group with label and input.
     *
     * @param   array  $options  Options to be passed into the rendering of the field
     *
     * @return  string  A string containing the html for the control group
     *
     */
    public function renderField($options = array())
    {
        $options['class'] = "input-prepend";
        return parent::renderField($options);
    }

}

?>