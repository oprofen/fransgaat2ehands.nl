<?php
/**
 * @author
 * @copyright
 * @license
 */

defined("_JEXEC") or die("Restricted access");

/**
 * Vinylstore helper class.
 *
 * @package     Vinylstore
 * @subpackage  Helpers
 */
class VinylstoreHelper extends JHelperContent
{
    public static $views = ['publishers', 'assessments', 'locations', 'labels', 'subcategories',
        'artists','music_producers', 'object_types', 'purchase_codes', 'languages','countries'];

    public static function addSubmenu($vName)
    {


        JHtmlSidebar::addEntry(
            JText::_('COM_VINYLSTORE_VINYLS_TITLE'),
            'index.php?option=com_vinylstore&view=vinyls',
            $vName == 'vinyls'
        );
        foreach (self::$views as $view) {
            JHtmlSidebar::addEntry(
                JText::_('COM_VINYLSTORE_' . strtoupper($view) . '_TITLE'),
                'index.php?option=com_vinylstore&view=' . $view,
                $vName == $view
            );
        }

    }


}