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
 * Item Model for an Article.
 *
 * @since  1.6
 */
class StoreModelAdmin extends JModelAdmin
{
    /**
     * @var        string    The prefix to use with controller messages.
     * @since   1.6
     */
    protected $text_prefix;

    /**
     * The type alias for this content type (for example, 'com_content.article').
     *
     * @var      string
     * @since    3.2
     */
    public $typeAlias;

    /**
     * The context used for the associations table
     *
     * @var      string
     * @since    3.4.4
     */
    protected $associationsContext;

    /**
     * Item name used as part of typeAlias and as part as table name
     * @var string
     */
    public $nameItem;
    /**
     * @var string
     */
    public $nameItems;
    /**
     * Component name used as part of typeAlias and as part as table name
     * @var string
     */
    public $nameComponent;

    /**
     * StoreModelAdmin constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $classNameParts = explode('Model', get_called_class());

        $this->nameItem = strtolower($classNameParts[1]);
        $this->nameItems = ($this->nameItems == null) ? $this->nameItem . "s" : $this->nameItems;

        $this->nameComponent = strtolower($classNameParts[0]);

        $this->text_prefix = "COM_" . strtoupper($this->nameComponent);


        $this->typeAlias = "com_" . $this->nameComponent . "." . $this->nameItem;
        $this->associationsContext = "com_" . $this->nameComponent . ".item";

        parent::__construct($config);
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
        $type = $this->nameItem;
        $prefix = $this->nameComponent . "Table";
        $config['ignore_request'] = true;
        return JTable::getInstance($type, $prefix, $config);
    }

    /**
     * Method to get the record form.
     *
     * @param   array $data Data for the form.
     * @param   boolean $loadData True if the form is to load its own data (default case), false if not.
     *
     * @return  mixed  A JForm object on success, false on failure
     *
     * @since   1.6
     */
    public function getForm($data = array(), $loadData = true)
    {
        // Get the form.
        $form = $this->loadForm($this->typeAlias, $this->nameItem, array('control' => 'jform', 'load_data' => $loadData));

        if (empty($form)) {
            return false;
        }

        return $form;
    }

    /**
     * Method to get the data that should be injected in the form.
     *
     * @return  mixed  The data for the form.
     *
     * @since   1.6
     */
    protected function loadFormData()
    {
        // Check the session for previously entered form data.
        $app = JFactory::getApplication();
        $data = $app->getUserState('com_' . $this->nameComponent . '.edit.' . $this->nameItem . '.data', array());

        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }

}
