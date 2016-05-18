<?php
/**
 * @author
 * @copyright
 * @license
 */

defined("_JEXEC") or die("Restricted access");
JFormHelper::loadFieldClass('Textarea');
JHtml::_('bootstrap.framework');


/**
 * Form field for Assessment items.
 *
 * @package        Bookstore
 * @subpackage    Fields
 */
class JFormFieldTextareaeditor extends JFormFieldTextarea

{
    /**
     * The form field type.
     *
     * @var    string
     * @since  11.1
     */
    public $type = 'textareaeditor';

    /**
     * Method to get the field input markup.
     *
     * @return  string  The field input markup.
     */

    public function getInput()
    {
        $document = JFactory::getDocument();
        $document->addScript('components/com_bookstore/assets/js/editor-script.js');

        $href = JURI::base() . "index.php?option=" .JFactory::getApplication()->input->get('option')
            . "&view=editor&tmpl=component&elementid=" . $this->id . "\"";
        
        $html = "<a data-id=\"foo\" role=\"button\" class=\"btn btn-info btn-small\" data-href=\"". $href ."\" data-value=\"" . $this->id . "\""
           . "><span class=\"icon-pencil-2 icon-white\"></span></a>";
        return parent::getInput() . $html;
    }

}

?>