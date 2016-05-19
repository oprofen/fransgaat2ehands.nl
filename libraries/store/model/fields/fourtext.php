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
class JFormFieldFourtext extends JFormFieldText
{
    /**
     * The form field type.
     *
     * @var    string
     * @since  11.1
     */
    /**
     * Layout to render the form field
     *
     * @var  string
     */

    /**
     * Layout to render the label
     *
     * @var  string
     */
    protected $type = 'fourtext';

    /**
     * layout filename
     * @var string 
     */
    protected $renderLayout = 'renderfourtextfield';
    /** layout file name for label
     * @var string
     */
    protected $renderLabelLayout = 'renderfourtextlabel';

    /** 
     * Method to get the field input markup.
     *
     * @return  string  The field input markup.
     */
    protected function getInput()
    {
        $before = ($this->element['before']) ? JText::_($this->element['before']) : "";
        $after = ($this->element['after']) ? JText::_($this->element['after']) : "";

        $html = $before . (parent::getInput()) . $after;

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
        $options['class'] = ($this->element['controlclass']) ? $this->element['controlclass']: "";
        $options['div-class-input'] = ($this->element['div_class_input']) ? $this->element['div_class_input']: "";
        return parent::renderField($options);
    }

    /**
     * Method to get layout path
     * @return array
     */
    protected function getLayoutPaths()
    {
        return ['components/com_bookstore/library/model/fields'];
    }



}

?>