<?php
/**
 * @author		
 * @copyright	
 * @license		
 */

defined("_JEXEC") or die("Restricted access");

if (!JFactory::getUser()->authorise('core.manage', 'com_cdstore'))
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}
$document = JFactory::getDocument();
$document->addStylesheet(JURI::root() . 'media/store/assets/css/test.css', 'text/css');
JLoader::discover('Store', JPATH_LIBRARIES . '/store', true, true);
JLoader::register('CdStoreHelper', __DIR__ . '/helpers/cdstore.php');
$dispatcher = JEventDispatcher::getInstance();
$dispatcher->register('onContentAfterDelete', 'StoreAfterDeletePlugin');

$controller = JControllerLegacy::getInstance('Cdstore');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();



?>