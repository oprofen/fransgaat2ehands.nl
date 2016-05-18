<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_bookstore
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\Registry\Registry;

/**
 * Contact Table class.
 *
 * @since  1.0
 */
class StoreTable extends JTable
{
    /**
     * Component name used as a part of asset name prefix and database name if they are specify assign explicitly
     * @var string
     */
    protected $nameComponent;
    /**
     * Item name used as a part of asset name prefix and database name if they are specify assign explicitly
     * @var string
     */
    protected $nameItem;
    /**
     * Explicitly assigned database name
     * @var string
     */
    protected $dbName;
    /**
     * Explicitly assigned asset name prefix name
     * @var string
     */
    protected $assetNamePrefix;
    /**
     * Explicitly assigned parent asset name prefix name
     * @var string
     */
    protected $parentAssetNamePrefix;

    /**
     * Constructor
     *
     * @param   JDatabaseDriver &$db Database connector object
     *
     * @since   1.0
     */
    public function __construct(&$db)
    {
        $classNameParts = explode('Table', get_called_class());

        $this->nameItem = ($this->nameItem == null) ? strtolower($classNameParts[1]) : $this->nameItem;

        $this->nameComponent = ($this->nameComponent == null) ? strtolower($classNameParts[0]) : $this->nameComponent;

        $this->setColumnAlias('published', 'state');
        $this->assetNamePrefix = ($this->assetNamePrefix == null) ? ($this->nameComponent . '.' . $this->nameItem) : $this->assetNamePrefix;
        $this->parentAssetNamePrefix = ($this->parentAssetNamePrefix == null) ? $this->nameComponent : $this->parentAssetNamePrefix;

        $dbName = $this->dbName ? $this->dbName : ($this->nameComponent . '_' . $this->nameItem);
        parent::__construct('#__' . $dbName, 'id', $db);

    }

    /**
     * Stores an item.
     *
     * @param   boolean $updateNulls True to update fields even if they are null.
     *
     * @return  boolean  True on success, false on failure.
     *
     * @since   1.6
     */
    public function store($updateNulls = false)
    {
        $date = JFactory::getDate()->toSql();
        $userId = JFactory::getUser()->id;

        $this->modified = $date;

        if ($this->id) {
            // Existing item
            $this->modified_by = $userId;
        } else {
            // New item. An item created and created_by field can be set by the user,
            // so we don't touch either of these if they are set.
            if (!(int)$this->created) {
                $this->created = $date;
            }

            if (empty($this->created_by)) {
                $this->created_by = $userId;
            }
        }


        return parent::store($updateNulls);
    }

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
        if (trim($this->title) == '') {
            $this->setError(JText::_('COM_' . strtoupper($this->nameComponent) . '_WARNING_PROVIDE_VALID_NAME'));

            return false;
        }

        return true;
    }

    /**
     * Method to compute the default name of the asset.
     * The default name is in the form table_name.id
     * where id is the value of the primary key of the table.
     *
     * @return  string
     *
     * @since   11.1
     */
    protected function _getAssetName()
    {
        $k = $this->_tbl_key;

        return 'com_' . $this->assetNamePrefix . '.' . (int)$this->$k;
    }

    /**
     * We provide our global ACL as parent
     * @see JTable::_getAssetParentId()
     */
    protected function _getAssetParentId(JTable $table = null, $id = null)
    {
        $asset = JTable::getInstance('Asset');
        $asset->loadByName('com_' . $this->parentAssetNamePrefix);
        return $asset->id;
    }

    /**
     * Method to bind an associative array or object to the JTable instance.This
     * method only binds properties that are publicly accessible and optionally
     * takes an array of properties to ignore when binding.
     *
     * @param   mixed  $src     An associative array or object to bind to the JTable instance.
     * @param   mixed  $ignore  An optional array or space separated list of properties to ignore while binding.
     *
     * @return  boolean  True on success.
     *
     * @throws  InvalidArgumentException
     */
    public function bind($array, $ignore = '')
    {
        // Bind the rules.
        if (isset($array['rules']) && is_array($array['rules'])) {
            $rules = new JRules($array['rules']);
            $this->setRules($rules);
        }
        return parent::bind($array, $ignore);
    }
}
