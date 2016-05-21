<?php
/**
 * @author
 * @copyright
 * @license
 */

defined("_JEXEC") or die("Restricted access");

/**
 * Bookstore helper class.
 *
 * @package     Cdstore
 * @subpackage  Helpers
 */
class CdstoreHelper extends JHelperContent
{
    public static $views = ['publishers', 'assessments', 'locations', 'labels', 'subcategories',
        'artists','music_producers', 'object_types', 'purchase_codes', 'languages','countries'];

    public static function addSubmenu($vName)
    {


        JHtmlSidebar::addEntry(
            JText::_('COM_CDSTORE_CDS_TITLE'),
            'index.php?option=com_cdstore&view=cds',
            $vName == 'cds'
        );
        foreach (self::$views as $view) {
            JHtmlSidebar::addEntry(
                JText::_('COM_CDSTORE_' . strtoupper($view) . '_TITLE'),
                'index.php?option=com_cdstore&view=' . $view,
                $vName == $view
            );
        }

    }


}