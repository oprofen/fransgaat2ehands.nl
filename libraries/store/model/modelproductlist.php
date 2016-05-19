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
class StoreModelProductList extends StoreModelList
{
	/**
	 * @var
	 */
	public $nameItems;
	/**
	 * @var
	 */
	public $nameItem;
	/**
	 * @var
	 */
	public $nameComponent;
	/**
	 * @var array
	 */

	protected $filter_fields = array(
		'id', 'a.id',
		'name', 'a.name',
		'alias', 'a.alias',
		'checked_out', 'a.checked_out',
		'checked_out_time', 'a.checked_out_time',
		'published', 'a.published',
		'created', 'a.created',
		'created_by', 'a.created_by',
		'ordering', 'a.ordering',
		'publish_up', 'a.publish_up',
		'publish_down', 'a.publish_down',
		'selling_price', 'a.selling_price'
	);
	/**
	 * @var string Name of xml filter file
	 */
	protected $filterFormName = 'filter_general_product';

	/**
	 * Method to auto-populate the model state.
	 *
	 * This method should only be called once per instantiation and is designed
	 * to be called on the first call to the getState() method unless the model
	 * configuration flag to ignore the request is set.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param   string  $ordering   An optional ordering field.
	 * @param   string  $direction  An optional direction (asc|desc).
	 *
	 * @return  void
	 *
	 * @since   12.2
	 */
	protected function populateState($ordering = 'title', $direction = 'ASC')
	{

		$published = $this->getUserStateFromRequest($this->context . '.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);

		$fromprice = $this->getUserStateFromRequest($this->context . '.filter.fromprice', 'filter_fromprice');
		$this->setState('filter.fromprice', $fromprice);

		$toprice = $this->getUserStateFromRequest($this->context . '.filter.toprice', 'filter_toprice');
		$this->setState('filter.published', $toprice);

		

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
	 * @param   string  $id  A prefix for the store id.
	 *
	 * @return  string  A store id.
	 *
	 * @since   1.6
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id .= ':' . $this->getState('filter.published');

		return parent::getStoreId($id);
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return  JDatabaseQuery
	 *
	 * @since   1.6
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$user = JFactory::getUser();

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'a.id, a.title, a.checked_out, a.checked_out_time' .
				', a.state, a.created, a.created_by, a.ordering, ' .
				' a.publish_up, a.publish_down, a.selling_price'
			)
		);
		$query->from('#__'. $this->dbName . ' AS a');


		// Join over the users for the checked out user.
		$query->select('uc.name AS editor')
			->join('LEFT', '#__users AS uc ON uc.id=a.checked_out');
		


		// Join over the users for the author.
		$query->select('ua.name AS author_name')
			->join('LEFT', '#__users AS ua ON ua.id = a.created_by');

		// Filter by published state
		$published = $this->getState('filter.published');

		if (is_numeric($published))
		{
			$query->where('a.state = ' . (int) $published);
		}
		elseif ($published === '')
		{
			$query->where('(a.state = 0 OR a.state = 1)');
		}


		// Filter by author
		$authorId = $this->getState('filter.author_id');

		if (is_numeric($authorId))
		{
			$type = $this->getState('filter.author_id.include', true) ? '= ' : '<>';
			$query->where('a.created_by ' . $type . (int) $authorId);
		}

		// Filter by search in title.
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0)
			{
				$query->where('a.id = ' . (int) substr($search, 3));
			}
			elseif (stripos($search, 'author:') === 0)
			{
				$search = $db->quote('%' . $db->escape(substr($search, 7), true) . '%');
				$query->where('(ua.name LIKE ' . $search . ' OR ua.username LIKE ' . $search . ')');
			}
			else
			{
				$search = $db->quote('%' . str_replace(' ', '%', $db->escape(trim($search), true) . '%'));
				$query->where('(a.title LIKE ' . $search .')');
			}
		}


		//filter by price

		$fromprice = $this->getState('filter.fromprice');
		$toprice = $this->getState('filter.toprice');
		if($fromprice && $toprice){
			$query->where('a.selling_price >= ' . (int) $fromprice . ' AND a.selling_price <= ' . (int) $toprice);
		} elseif ($fromprice){
			$query->where('a.selling_price >= ' . (int) $fromprice);

		} elseif($toprice){
			$query->where('a.selling_price <= ' . (int) $toprice);
		}

		
		

		// Add the list ordering clause.
		$orderCol = $this->state->get('list.ordering', 'a.id');
		$orderDirn = $this->state->get('list.direction', 'desc');
		


		$query->order($db->escape($orderCol . ' ' . $orderDirn));

		return $query;
	}

}
