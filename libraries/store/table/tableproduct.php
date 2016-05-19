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
class StoreTableProduct extends StoreTable
{

    protected $nameComponent;
    public $dataBaseInfo;

    /**
     * Constructor
     *
     * @param   JDatabaseDriver &$db Database connector object
     *
     * @since   1.0
     */
    public function __construct(&$db)
    {
        parent::__construct($db);
        StoreObserver::createObserver($this, array('typeAlias' => 'com_' . $this->nameComponent . '.' . $this->dataBaseName));


    }

    /**
     * @param mixed $src
     * @param array $ignore
     * @return bool
     */

    public function bind($src, $ignore = array())
    {
        $tables = array();

        foreach ($this->dataBaseInfo as $table) {
            $field = $table['associationName'];
            if (isset($src[$field]) && is_array($src[$field]) && ($src[$field][0] != '' || count($src[$field]) > 1)) {
                $src[$field] = array_unique($src[$field]);
                $values = [];
                for ($k = 0; $k < count($src[$field]); $k++) {
                    if (trim($src[$field][$k]) != '') {
                        $values[] = $src[$field][$k];
                    }
                }
                $this->$field = $values;

            }
            $tables[] = $field;
        }

        return parent::bind($src, $tables);
    }
}
