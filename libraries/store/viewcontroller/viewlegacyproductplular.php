<?php
/**
 * @author
 * @copyright
 * @license
 */

defined("_JEXEC") or die("Restricted access");


/**
 * Assessments list view class.
 *
 * @package     Bookstore
 * @subpackage  Views
 */
class StoreViewLegacyProductPlular extends StoreViewLegacyPlular
{
    public function __construct(array $config)
    {
        parent::__construct($config);

        // Set the default template search path
        $this->_setPath('template', $this->_basePath . '/store/layout/products');
    }

    /**
     * Add the page title and toolbar.
     *
     * @return  void
     *
     * @since   1.6
     */
    protected function addToolbar()
    {
        $canDo = JHelperContent::getActions('com_' . $this->nameComponent);
        $user = JFactory::getUser();

        JToolbarHelper::title(JText::_('COM_' . strtoupper($this->nameComponent) . '_' . strtoupper($this->nameItems) . '_TITLE'), 'stack item');

        if ($canDo->get('core.create')) {
            JToolBarHelper::addNew($this->nameItem . '.add', 'JTOOLBAR_NEW');
        }

        if ($canDo->get('core.edit')) {
            JToolbarHelper::editList($this->nameItem . '.edit');
        }

        if ($canDo->get('core.edit.state')) {
            JToolbarHelper::publish($this->nameItems . '.publish', 'JTOOLBAR_PUBLISH', true);
            JToolbarHelper::unpublish($this->nameItems . '.unpublish', 'JTOOLBAR_UNPUBLISH', true);
            JToolbarHelper::archiveList($this->nameItems . '.archive');
            JToolbarHelper::checkin($this->nameItems . '.checkin');
        }

        if ($this->state->get('filter.published') == -2 && $canDo->get('core.delete')) {
            JToolbarHelper::deleteList('JGLOBAL_CONFIRM_DELETE', $this->nameItems . '.delete', 'JTOOLBAR_EMPTY_TRASH');
        } elseif ($canDo->get('core.edit.state')) {
            JToolbarHelper::trash($this->nameItems . '.trash');
        }

        if ($user->authorise('core.admin', 'com_' . $this->nameComponent) || $user->authorise('core.options', 'com_' . $this->nameComponent)) {
            JToolbarHelper::preferences('com_' . $this->nameComponent);
        }


        JHtmlSidebar::setAction('index.php?option=com_' . $this->nameComponent);
    }

    /**
     * Returns an array of fields the table can be sorted by
     *
     * @return  array  Array containing the field name to sort by as the key and display text as value
     *
     * @since   3.0
     */
    protected function getSortFields()
    {
        return array(
            'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
            'a.state' => JText::_('JSTATUS'),
            'a.title' => JText::_('JGLOBAL_TITLE'),
            'a.created_by' => JText::_('JAUTHOR'),
            'a.created' => JText::_('JDATE'),
            'a.id' => JText::_('JGRID_HEADING_ID'),
        );
    }
}

?>