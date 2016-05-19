<?php
/**
 * @package     Bookstore
 * @subpackage  com_bookstore
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\Registry\Registry;

/**
 * This models supports retrieving lists of items.
 *
 * @since  1.6
 */
class StoreModelList extends JModelList
{
    /**
     * @var string
     */
    public $nameItems;
    /**
     * @var string
     */
    public $nameItem;
    /**
     * @var string
     */
    public $nameComponent;
    /**
     * @var array
     */
    protected $filter_fields = array(
        'a.title', 'title',
        'a.checked_out', 'checked_out',
        'a.checked_out_time', 'checked_out_time',
        'a.created', 'created',
        'a.created_by', 'created_by', 'author_id',
        'a.ordering', 'ordering',
        'ordering', 'state'
    );
    /**
     * @var string Name of xml filter file
     */
    protected $filterFormName = 'filter_general';
    /**
     * Data basename
     * @var string
     */
    public $dbName;

    /**
     * Constructor.
     *
     * @param   array $config An optional associative array of configuration settings.
     *
     * @see     JController
     * @since   1.6
     */

    public function __construct($config = array())
    {
        $classNameParts = explode('Model', get_called_class());

        $this->nameItems = strtolower($classNameParts[1]);

        $this->nameItem = ($this->nameItem == "") ? substr($this->nameItems, 0, strlen($this->nameItems) - 1) : $this->nameItem;

        $this->nameComponent = ($this->nameComponent == "") ? strtolower($classNameParts[0]) : $this->nameComponent;

        $this->dbName = ($this->dbName == null) ?  ($this->nameComponent . '_' . $this->nameItem) : $this->dbName;
        
        parent::__construct($config);
    }

    /**
     * Method to auto-populate the model state.
     *
     * This method should only be called once per instantiation and is designed
     * to be called on the first call to the getState() method unless the model
     * configuration flag to ignore the request is set.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @param   string $ordering An optional ordering field.
     * @param   string $direction An optional direction (asc|desc).
     *
     * @return  void
     *
     * @since   12.2
     */
    protected function populateState($ordering = 'a.title', $direction = 'ASC')
    {
        // Get the Application
        $app = JFactory::getApplication();

        // Set filter state for search
        $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);

        // Set filter state for author
        $authorId = $app->getUserStateFromRequest($this->context . '.filter.author_id', 'filter_author_id');
        $this->setState('filter.author_id', $authorId);


        // List state information.
        parent::populateState($ordering, $direction);
    }

    /**
     * Method to get a store id based on model configuration state.
     *
     * This is necessary because the model is used by the component and
     * different modules that might need different sets of data or different
     * ordering requirements.
     *
     * @param   string $id A prefix for the store id.
     *
     * @return  string  A store id.
     *
     * @since   1.6
     */
    protected function getStoreId($id = '')
    {
        // Compile the store id.
        $id .= ':' . $this->getState('filter.search');
        $id .= ':' . $this->getState('filter.author_id');

        return parent::getStoreId($id);
    }

    /**
     * Get the master query for retrieving a list of articles subject to the model state.
     *
     * @return  JDatabaseQuery
     *
     * @since   1.6
     */
    protected function getListQuery()
    {
        // Get database object
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        
        $query->select('a.id, a.title, a.checked_out, a.checked_out_time, ' .
            'a.created, a.created_by, a.ordering')
            ->from('#__' . $this->dbName . ' AS a');


        // Join over the users for the checked out user.
        $query->select('uc.name AS editor')
            ->join('LEFT', '#__users AS uc ON uc.id = a.checked_out');

        // Join over the users for the author.
        $query->select('ua.name AS author_name')
            ->join('LEFT', '#__users AS ua ON ua.id = a.created_by');

        // Join over the users for the modifier.
        $query->select('um.name AS modifier_name')
            ->join('LEFT', '#__users AS um ON um.id = a.modified_by');

        // Filter by search
        $search = $this->getState('filter.search');
        $s = $db->quote('%' . $db->escape($search, true) . '%');

        if (!empty($search)) {
            if (stripos($search, 'id:') === 0) {
                $query->where('a.id = ' . (int)substr($search, strlen('id:')));
            } elseif (stripos($search, 'title:') === 0) {
                $search = $db->quote('%' . $db->escape(substr($search, strlen('title:')), true) . '%');
                $query->where('a.title LIKE ' . $search);
            } elseif (stripos($search, 'author:') === 0) {
                $search = $db->quote('%' . $db->escape(substr($search, 7), true) . '%');
                $query->where('(ua.name LIKE ' . $search . ' OR ua.username LIKE ' . $search . ')');
            } else {
                $query->where('a.title LIKE' . $s);
            }
        }


        // Filter by author
        $authorId = $this->getState('filter.author_id');
        if (is_numeric($authorId)) {
            $type = $this->getState('filter.author_id.include', true) ? '= ' : '<>';
            $query->where('a.created_by ' . $type . (int)$authorId);
        }

        // Add list oredring and list direction to SQL query
        $sort = $this->getState('list.ordering', 'title');
        $order = $this->getState('list.direction', 'ASC');
        $query->order($db->escape($sort) . ' ' . $db->escape($order));

        return $query;
    }


    /**
     * Build a list of authors
     *
     * @return  array
     *
     * @since   1.6
     */
    public function getAuthors()
    {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Construct the query
        $query->select('u.id AS value, u.name AS text')
            ->from('#__users AS u')
            ->join('INNER', '#__' . $this->dbName . ' AS a ON a.created_by = u.id')
            ->group('u.id, u.name')
            ->order('u.name');

        // Setup the query
        $db->setQuery($query);

        // Return the result
        return $db->loadObjectList();
    }

    /**
     * Method to get an array of data items.
     *
     * @return  mixed  An array of data items on success, false on failure.
     *
     * @since   12.2
     */
    public function getItems()
    {
        if ($items = parent::getItems()) {
            //Do any procesing on fields here if needed
        }

        return $items;
    }

}
