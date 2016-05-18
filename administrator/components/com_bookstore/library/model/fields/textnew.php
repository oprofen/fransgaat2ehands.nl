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
class JFormFieldTextnew extends JFormFieldText
{
    /**
     * The form field type.
     *
     * @var    string
     * @since  11.1
     */

    protected $type = 'textnew';

    /**
     * Method to get the field input markup.
     *
     * @return  string  The field input markup.
     */
    protected function getInput()
    {

        $html =  parent::getInput();
        $pattern = "/<input\s+/";
        if($this->element['tabindex']){
            $tabindex = '<input tabindex="' . (int)$this->element['tabindex'] . '" ';
            $html = preg_replace($pattern, $tabindex, $html);
        }
        if($this->element['autofocus']){
            $tabindex = '<input autofocus ';
            $html = preg_replace($pattern, $tabindex, $html);
        }
        

        return $html;

    }



}

?>