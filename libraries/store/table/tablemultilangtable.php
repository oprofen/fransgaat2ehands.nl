<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_bookstore
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


/**
 *  Table class.
 *
 * @since  1.0
 */
class StoreMultilangTable extends StoreTable
{
    /**
     * Overloaded check function
     *
     * @return  boolean  True on success, false on failure
     *
     * @see     JTable::check
     * @since   1.5
     */
    public function check()
    {

        // Check for valid name
        if (trim($this->title_en) == '' || trim($this->title_nl) == '') {
            $this->setError(JText::_('COM_' . strtoupper($this->nameComponent) . '_WARNING_PROVIDE_VALID_NAME'));

            return false;
        }

        return true;
    }
}
