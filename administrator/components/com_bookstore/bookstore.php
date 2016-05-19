<?php
/**
 * @author		
 * @copyright	
 * @license		
 */

defined("_JEXEC") or die("Restricted access");

if (!JFactory::getUser()->authorise('core.manage', 'com_bookstore'))
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}
$document = JFactory::getDocument();

$document->addStylesheet(JURI::root() . 'media/store/assets/css/test.css', 'text/css');
JLoader::discover('Store', JPATH_LIBRARIES . '/store', true, true);
JLoader::register('BookstoreHelper', __DIR__ . '/helpers/bookstore.php');

$dispatcher = JEventDispatcher::getInstance();
$dispatcher->register('onContentAfterDelete', 'StoreAfterDeletePlugin');



$controller = JControllerLegacy::getInstance('Bookstore');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();



?>