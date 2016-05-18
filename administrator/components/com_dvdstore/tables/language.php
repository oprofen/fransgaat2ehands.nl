<?php
/**
 * @author		
 * @copyright	
 * @license		
 */

defined("_JEXEC") or die("Restricted access");

/**
 * Language table class.
 *
 * @package     Dvdstore
 * @subpackage  Tables
 */
class DvdstoreTableLanguage extends StoreMultilangTable
{
    protected $dbName = 'bookstore_language';
    protected $assetNamePrefix = 'bookstore.language';
    protected $parentAssetNamePrefix = 'bookstore';
}
?>