<?php
/**
 * @author
 * @copyright
 * @license
 */

defined("_JEXEC") or die("Restricted access");

// necessary libraries
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
$input = JFactory::getApplication()->input;
$id = $input->getCmd('elementid');
$jform = $input->get('jform', [], 'ARRAY');
$html = ($jform[substr($id, 6)]) ? $jform[substr($id, 6)]: '';
$editor = $this->editor->display('editor', $html, '100%', '100%', '20', '20', true, null, null, null);
?>

<form id="myForm" method="post">
    <div class="row-fluid">
        <div class="span12">
           <div class="control-group">
               <div class="controls"><?php echo $editor ?></div>
           </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    jQuery(window).unload(function () {
        var value = jQuery('#editor').val();
        jQuery('#<?php echo $id;?>', window.parent.document).val(value);
        console.log("closed iframe");
    })
</script>