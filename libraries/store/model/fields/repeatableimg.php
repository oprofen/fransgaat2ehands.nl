<?php
/**
 * @author
 * @copyright
 * @license
 */

defined("_JEXEC") or die("Restricted access");
JFormHelper::loadFieldClass('Repeatable');


/**
 * Form field for Assessment items.
 *
 * @package        Bookstore
 * @subpackage    Fields
 */
class JFormFieldRepeatableimg extends JFormFieldRepeatable
{
    /**
     * The form field type.
     *
     * @var    string
     * @since  11.1
     */

    protected $type = 'repeatableimg';

    /**
     * Method to get the field input markup.
     *
     * @return  string  The field input markup.
     */
    protected function getInput()
    {

       $document = JFactory::getDocument();
        $document->addScript(JURI::root(). 'media/store/assets/js/imagefield.js');
        $script = [];
        $script[] = " jQuery(function () { ";
        $script[] = "var images = jQuery.parseJSON(jQuery('#" . $this->id . "').val()); ";
        $script[] = " if(images) {";
        $script[] = "jQuery.updateImages('#show_images_new', images.image, '". str_replace('administrator/', '', JURI::base()) ."' ); ";
         $script[] = " } ";
        $script[] = "jQuery('#" . $this->id . "_modal').on('hidden', function(){ ";
        $script[] = " setTimeout(function(){ ";
        $script[] = "var images = jQuery.parseJSON(jQuery('#" . $this->id . "').val()); ";
        $script[] = " if(images) {";
        $script[] = "jQuery.updateImages('#show_images_new', images.image, '". str_replace('administrator/', '', JURI::base()) ."' ); ";
        $script[] = " } ";
        $script[] = " }, 500);";
        $script[] = " }); });";
        $script = implode("\n", $script);
        $document->addScriptDeclaration($script,"text/javascript");
        return parent::getInput();

    }

}

?>