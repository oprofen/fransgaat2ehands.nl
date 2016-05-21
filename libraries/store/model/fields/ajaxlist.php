<?php
/**
 * @author
 * @copyright
 * @license
 */

defined("_JEXEC") or die("Restricted access");
JFormHelper::loadFieldClass('list');

/**
 * Form field for Assessment items.
 *
 * @package        Bookstore
 * @subpackage    Fields
 */
class JFormFieldAjaxlist extends JFormFieldList
{
    /**
     * The form field type.
     *
     * @var    string
     * @since  11.1
     */
    protected $type = 'ajaxlist';


    protected function getOptions()
    {

        $options = array();

        $items = StoreHelper::getItems($this->getAttribute('database'),$this->getAttribute('componentname'),
            filter_var($this->getAttribute('multilanguage'), FILTER_VALIDATE_BOOLEAN), $this->getAttribute('order'));
        foreach ($items as $item) {
            // Create a new option object based on the <option /> element.
            $tmp = JHtml::_('select.option', $item->id, $item->title);

            // Add the option object to the result set.
            $options[] = $tmp;
        }

        // Merge any additional options in the XML definition.
        $options = array_merge(parent::getOptions(), $options);
       

        return $options;
    }

    public function getInput()
    {

        JHtml::_('behavior.modal');
        // Build the Ajaxscript.

        $ajaxScript = array();
        $ajaxScript[] = "jQuery.ajax({";
        $ajaxScript[] = "url:'" . JURI::current() . "/administrator/index.php?option=" .
            JFactory::getApplication()->input->get('option') ."&task=ajax.getAjaxData&collection=". $this->getAttribute('database') .
            "&componentname=". $this->getAttribute('componentname') ."&multilanguage=". $this->getAttribute('multilanguage') ."'";
        $ajaxScript[] = "})";
        $ajaxScript[] = ".done(function( r ) {";
        $ajaxScript[] = "r = jQuery.parseJSON(r);";
        $ajaxScript[] = "data = r.data;";
        $ajaxScript[] = "if ( data ) {";
        $ajaxScript[] =    "var valueArray = jQuery('#" . $this->id . "').val();";
        $ajaxScript[] =    "jQuery('#" . $this->id . " option').remove()";
        $ajaxScript[] = "var arr = ['<option value="."></option>'];";
        $ajaxScript[] = "for(var i = 0; i < data.length; i++){";
        $ajaxScript[] = "if(valueArray){";
        $ajaxScript[] = "if(Array.isArray(valueArray)){";
        $ajaxScript[] = "var selected = (~valueArray.indexOf( data[i].id)) ? 'selected' : '' ;";
        $ajaxScript[] = "} else {";
        $ajaxScript[] = "var selected = (valueArray == data[i].id) ? 'selected' : '' ;";
        $ajaxScript[] = "}";
        $ajaxScript[] = "} else {";
        $ajaxScript[] = "var selected = ''";
        $ajaxScript[] = "}";
        $ajaxScript[] = "arr[i + 1] = '<option value=' + data[i].id + ' ' + selected + '>' + data[i].title + '</option>';";
        $ajaxScript[] = "}";
        $ajaxScript[] = "jQuery('#" . $this->id ."').append(arr)";
        $ajaxScript[] = "jQuery('#" . $this->id . "').trigger('liszt:updated.chosen')";
        $ajaxScript[] = "}";
        $ajaxScript[] ="});";
        $ajaxScript = implode("\n", $ajaxScript);
        $href = "com_".$this->getAttribute('componentname')
            . "&view=" . $this->getAttribute('plular_view_name') . "&tmpl=component&keeplayout=modal&layout=modal\"";
        $rel = "rel=\"{handler: 'iframe',size: {x:960, y:500}, onClose:function(){" . $ajaxScript . "}}\"";
        $html = "<a tabindex=\"-1\" href=\"index.php?option=" . $href . " class=\"modal btn btn-success btn-small\" type=\"button\""
            . $rel . "><span class=\"icon-rightarrow icon-white\"></span></a>";
        return parent::getInput() . $html;
    }
}

?>