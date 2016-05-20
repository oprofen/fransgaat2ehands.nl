<?php
/**
 * @package     Bookstore
 * @subpackage  Library
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined("_JEXEC") or die("Restricted access");


/**
 * Assessment item view class.
 *
 * @package     Bookstore
 * @subpackage  Library
 */
class StoreViewLegacySingular extends JViewLegacy
{
    protected $item;
    protected $form;
    protected $state;
    protected $nameItem;
    protected $nameItems;
    public $componentName;
    
    public function __construct(array $config)
    {
        parent::__construct($config);
        
        // Set a base path for use by the view
        $this->_basePath = JPATH_LIBRARIES;

        // Set the default template search path
        $this->_setPath('template', $this->_basePath . '/store/layout/item');
    }
    
    public function display($tpl = null)
    {
        

        $this->form  = $this->get('Form');
        $this->item  = $this->get('Item');
        $this->state = $this->get('State');
        $this->nameItem = $this->getModel()->nameItem;
        $this->nameItems = $this->getModel()->nameItems;
        $this->nameComponent = $this->getModel()->nameComponent;

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors));
            return false;
        }

        if ($this->getLayout() == 'modal') {
            $this->form->setFieldAttribute('language', 'readonly', 'true');
        }

        $this->addToolbar();
        parent::display($tpl);
    }

    protected function addToolbar()
    {
        JFactory::getApplication()->input->set('hidemainmenu', true);

        $user = JFactory::getUser();
        $userId = $user->id;
        $isNew = ($this->item->id == 0);
        $checkedOut = !($this->item->checked_out == 0 || $this->item->checked_out == $userId);

        // Since we don't track these assets at the item level, use the category id.
        $this->canDo = JHelperContent::getActions('com_' . $this->nameComponent, $this->nameItem, $this->item->id);

        JToolbarHelper::title($isNew ? JText::_('COM_'. $this->nameComponent .'_' . strtoupper($this->nameItem) . '_NEW') : JText::_('COM_'. $this->nameComponent .'_' . strtoupper($this->nameItem) . '_EDIT'), 'address contact');

        // If not checked out, can save the item.
        if (!$checkedOut && ($this->canDo->get('core.edit') || $this->canDo->get('core.create'))) {
            JToolbarHelper::apply($this->nameItem . '.apply');
            JToolbarHelper::save($this->nameItem . '.save');
        }

        if (!$checkedOut && $this->canDo->get('core.create')) {
            JToolbarHelper::save2new($this->nameItem . '.save2new');
        }
        // If an existing item, can save to a copy.
        if (!$isNew && $this->canDo->get('core.create')) {
            JToolbarHelper::save2copy($this->nameItem . '.save2copy');
        }

        JToolbarHelper::cancel($this->nameItem . '.cancel', 'JTOOLBAR_CLOSE');

    }
}

?>