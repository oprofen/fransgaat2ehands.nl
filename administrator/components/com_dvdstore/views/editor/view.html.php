<?php
/**
 * @author		
 * @copyright	
 * @license		
 */

defined("_JEXEC") or die("Restricted access");


/**
 * DVD item view class.
 *
 * @package     Dvdstore
 * @subpackage  Views
 */

class DvdstoreViewEditor extends JViewLegacy
{

    public $editor;

    public function display($tpl = null)
    {
        $conf = JFactory::getConfig();
        $editor = $conf->get('editor');
        $this->editor = JEditor::getInstance($editor);
        return parent::display($tpl); // TODO: Change the autogenerated stub
    }
}
?>