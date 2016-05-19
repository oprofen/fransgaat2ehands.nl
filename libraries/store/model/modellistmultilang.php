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
class StoreModelListMultiLang extends StoreModelList
{
	/**
	 * Name of xml filter file
	 * @var string
	 */
	protected $filterFormName = 'filter_general_multilang';
	

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
	protected function populateState($ordering = 'a.created', $direction = 'ASC')
	{
		// List state information.
		parent::populateState($ordering, $direction);
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
		
		$lang = JFactory::getLanguage();
		switch($lang->getTag()){
			case 'nl-NL':
				$title = 'title_nl';
				break;
			default :
				$title = 'title_en';
				break;

		}
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select('a.id, a.'. $title .' as title, a.checked_out, a.checked_out_time, ' .
					'a.created, a.created_by, a.ordering')
			->from('#__' . $this->dbName .' AS a');
		

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

		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0)
			{
				$query->where('a.id = ' . (int) substr($search, strlen('id:')));
			}
			elseif (stripos($search, 'title:') === 0)
			{
				$search = $db->quote('%' . $db->escape(substr($search, strlen('title:')), true) . '%');
				$query->where('a'. $title . ' LIKE ' . $search);
			}
			elseif (stripos($search, 'author:') === 0)
			{
				$search = $db->quote('%' . $db->escape(substr($search, 7), true) . '%');
				$query->where('(ua.name LIKE ' . $search . ' OR ua.username LIKE ' . $search . ')');
			}
			else
			{

				$search = $db->quote('%' . $db->escape($search, true) . '%');
				$query->where('a.'. $title . ' LIKE' . $search);
			}
		}
		

		// Filter by author
		$authorId = $this->getState('filter.author_id');
		if (is_numeric($authorId))
		{
			$type = $this->getState('filter.author_id.include', true) ? '= ' : '<>';
			$query->where('a.created_by ' . $type . (int) $authorId);
		}

		// Add list oredring and list direction to SQL query
		$sort = $this->getState('list.ordering', 'created');
		if($sort == 'a.title'){
			$sort = 'a.' . $title;
		}
		$order = $this->getState('list.direction', 'ASC');
		$query->order($db->escape($sort).' '.$db->escape($order));
		
		return $query;
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
		}

		return $items;
	}

}
