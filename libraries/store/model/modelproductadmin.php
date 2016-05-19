<?php
/**
 * @package     Bookstore
 * @subpackage  com_bookstore
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


/**
 * Item Model for a product.
 *
 * @since  1.6
 */
class StoreModelProductAdmin extends StoreModelAdmin
{
    /**
     * database is n association archive which has to have the following fields
     * 'collectionName' The collection name used as the first part of table
     * 'componentName' The component name used as the second part of table
     * 'componentNameAssoc' The association name used as the first part of association table
     * 'associationName' The association name used as the second part of association table
     * this field used in a table observer.
     * @var array
     */
    protected $dataBaseInfo;


    /**
     * Prepare and sanitise the table data prior to saving.
     *
     * @param   JTable $table A JTable object.
     *
     * @return  void
     *
     * @since   1.6
     */
    protected function prepareTable($table)
    {
        $db = $this->getDbo();

        if ($table->state == 1 && (int)$table->publish_up == 0) {
            $table->publish_up = JFactory::getDate()->toSql();
        }

        if ($table->state == 1 && intval($table->publish_down) == 0) {
            $table->publish_down = $db->getNullDate();
        }

        // Increment the content version number.
        $table->version++;

    }

    /**
     * A protected method to get a set of ordering conditions.
     *
     * @param   object $table A record object.
     *
     * @return  array  An array of conditions to add to add to ordering queries.
     *
     * @since   1.6
     */
    protected function getReorderConditions($table)
    {
        $condition = array();
        $condition[] = 'catid = ' . (int)$table->catid;

        return $condition;
    }


    /**
     * Method to get a single record.
     *
     * @param   integer $pk The id of the primary key.
     *
     * @return  mixed  Object on success, false on failure.
     */
    public function getItem($pk = null)
    {
        if ($item = parent::getItem($pk)) {

            if (!empty($item->id)) {
                foreach ($this->dataBaseInfo as $dataBaseInfo) {
                    $field = $dataBaseInfo['associationName'];
                    $item->$field = StoreHelper::getItem($dataBaseInfo['databaseName'],
                        $dataBaseInfo['componentName'], $dataBaseInfo['associationName'],
                        $dataBaseInfo['componentNameForAssociation'], $item->id);
                }

            }
        }

        return $item;
    }

    /**
     * Returns a Table object, always creating it.
     *
     * @param   string $type The table type to instantiate
     * @param   string $prefix A prefix for the table class name. Optional.
     * @param   array $config Configuration array for model. Optional.
     *
     * @return  JTable    A database object
     */
    public function getTable($type = '', $prefix = '', $config = array())
    {
        $table = parent::getTable($type, $prefix = '', $config = array());
        if($table) {
           $table->dataBaseInfo = $this->dataBaseInfo;
        }
        return $table;
    }


}
