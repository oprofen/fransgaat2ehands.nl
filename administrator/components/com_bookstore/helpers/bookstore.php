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
 * @package     Bookstore
 * @subpackage  Helpers
 */
class BookstoreHelper extends StoreHelper
{
    public static $views = ['publishers', 'assessments', 'locations', 'writers', 'subcategories', 'translators',
        'illistrators', 'object_types', 'purchase_codes', 'countries', 'languages'];

    public static function addSubmenu($vName)
    {


        JHtmlSidebar::addEntry(
            JText::_('COM_BOOKSTORE_BOOKS_TITLE'),
            'index.php?option=com_bookstore&view=books',
            $vName == 'books'
        );
        foreach (self::$views as $view) {
            JHtmlSidebar::addEntry(
                JText::_('COM_BOOKSTORE_' . strtoupper($view) . '_TITLE'),
                'index.php?option=com_bookstore&view=' . $view,
                $vName == $view
            );
        }


    }


}