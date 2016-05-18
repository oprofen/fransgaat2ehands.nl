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
$document->addStylesheet('components/com_bookstore/assets/css/test.css', 'text/css');


JLoader::register('StoreHelper', JPATH_ADMINISTRATOR . '/components/com_bookstore/library/helper/store.php');

JLoader::register('BookstoreHelper', __DIR__ . '/helpers/bookstore.php');

JLoader::register('StoreControllerAjax', JPATH_ADMINISTRATOR . '/components/com_bookstore/library/controller/ajax.php');
JLoader::register('StoreControllerForm', JPATH_ADMINISTRATOR . '/components/com_bookstore/library/controller/storeform.php');
JLoader::register('StoreControllerAdmin', JPATH_ADMINISTRATOR . '/components/com_bookstore/library/controller/storeadmin.php');
JLoader::register('StoreModelList', JPATH_ADMINISTRATOR . '/components/com_bookstore/library/model/storemodellist.php');
JLoader::register('StoreModelAdmin', JPATH_ADMINISTRATOR . '/components/com_bookstore/library/model/storemodeladmin.php');
JLoader::register('StoreModelListMultiLang', JPATH_ADMINISTRATOR . '/components/com_bookstore/library/model/storemodellistmultilang.php');
JLoader::register('StoreViewLegacyPlular', JPATH_ADMINISTRATOR . '/components/com_bookstore/library/viewcontroller/storeviewlegacyplular.php');
JLoader::register('StoreViewLegacySingular', JPATH_ADMINISTRATOR . '/components/com_bookstore/library/viewcontroller/storeviewlegacysingular.php');
JLoader::register('JTableObserverStore',JPATH_ADMINISTRATOR . '/components/com_bookstore/library/observer/observer.php');
JLoader::register('StoreTable', JPATH_ADMINISTRATOR . '/components/com_bookstore/library/table/storetable.php');
JLoader::register('StoreMultilangTable', JPATH_ADMINISTRATOR . '/components/com_bookstore/library/table/storetablemultilang.php');
JLoader::register('StoreTableProduct', JPATH_ADMINISTRATOR . '/components/com_bookstore/library/table/storetableproduct.php');


JLoader::register('StoreControllerProductAdmin', JPATH_ADMINISTRATOR . '/components/com_bookstore/library/controller/storeproductadmin.php');
JLoader::register('StoreControllerProductForm', JPATH_ADMINISTRATOR . '/components/com_bookstore/library/controller/storeproductform.php');
JLoader::register('StoreModelProductAdmin', JPATH_ADMINISTRATOR . '/components/com_bookstore/library/model/storemodelproductadmin.php');
JLoader::register('StoreModelProductList', JPATH_ADMINISTRATOR . '/components/com_bookstore/library/model/storemodelproductlist.php');
JLoader::register('StoreViewLegacyProductPlular', JPATH_ADMINISTRATOR . '/components/com_bookstore/library/viewcontroller/storeviewlegacyproductplular.php');

JLoader::register('AfterDeletePlugin', JPATH_ADMINISTRATOR . '/components/com_bookstore/library/plugin/afterdelete.php');

$dispatcher = JEventDispatcher::getInstance();
$dispatcher->register('onContentAfterDelete', 'AfterDeletePlugin');


$controller = JControllerLegacy::getInstance('Bookstore');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();



?>