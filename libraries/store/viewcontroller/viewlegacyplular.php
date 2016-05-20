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
class StoreViewLegacyPlular extends JViewLegacy
{
    protected $items;
    protected $pagination;
    protected $state;
    protected $nameItems;
    protected $nameItem;
    public $nameComponent;

    public function __construct(array $config)
    {
        parent::__construct($config);
        // Set a base path for use by the view
        $this->_basePath = JPATH_LIBRARIES;

        // Set the default template search path
        $this->_setPath('template', $this->_basePath . '/store/layout/items');
    }

    public function display($tpl = null)
    {
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');
        $this->authors = $this->get('Authors');
        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');
        $this->nameItems = $this->getModel()->nameItems;
        $this->nameItem = $this->getModel()->nameItem;
        $this->nameComponent = $this->getModel()->nameComponent;


        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors));
            return false;
        }


        if ($this->getLayout() !== 'modal') {

            $this->addToolbar();
            $helper = $this->nameComponent . Helper;
            $helper::addSubmenu($this->nameItems);
            $this->sidebar = JHtmlSidebar::render();


        }

        parent::display($tpl);
    }

    /**
     *    Method to add a toolbar
     */
    protected function addToolbar()
    {
        $canDo = JHelperContent::getActions('com_' . $this->nameComponent);


        JToolbarHelper::title(JText::_('COM_' . strtoupper($this->nameComponent) . '_' . strtoupper($this->nameItems) . '_TITLE'), 'stack item');


        if ($canDo->get('core.create')) {
            JToolBarHelper::addNew($this->nameItem . '.add', 'JTOOLBAR_NEW');
        }

        if ($canDo->get('core.edit')) {
            JToolbarHelper::editList($this->nameItem . '.edit');
        }
        if ($canDo->get('core.delete')) {
            JToolBarHelper::deleteList('', $this->nameItems . '.delete', 'JTOOLBAR_DELETE');
        }

        if ($canDo->get('core.admin') || $canDo->get('core.options')) {
            JToolbarHelper::preferences('com_' . $this->nameComponent);
        }

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
            'a.title' => JText::_('JGLOBAL_TITLE'),
            'a.created' => JText::_('JDATE'),
            'a.id' => JText::_('JGRID_HEADING_ID')
        );
    }
}

?>