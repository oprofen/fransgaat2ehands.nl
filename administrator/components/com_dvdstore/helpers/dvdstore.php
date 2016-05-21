<?php
/**
 * @author
 * @copyright
 * @license
 */

defined("_JEXEC") or die("Restricted access");

/**
 * Dvdstore helper class.
 *
 * @package     Dvdstore
 * @subpackage  Helpers
 */
class DvdstoreHelper extends JHelperContent
{
    public static $views = ['distributors', 'assessments', 'locations', 'directors', 'subcategories', 'film_productions',
        'actors', 'object_types', 'purchase_codes', 'translators', 'languages','countries', 'producers', 'written_bys'];

    public static function addSubmenu($vName)
    {


        JHtmlSidebar::addEntry(
            JText::_('COM_DVDSTORE_DVDS_TITLE'),
            'index.php?option=com_dvdstore&view=dvds',
            $vName == 'dvds'
        );
        foreach (self::$views as $view) {
            JHtmlSidebar::addEntry(
                JText::_('COM_DVDSTORE_' . strtoupper($view) . '_TITLE'),
                'index.php?option=com_dvdstore&view=' . $view,
                $vName == $view
            );
        }

    }


}