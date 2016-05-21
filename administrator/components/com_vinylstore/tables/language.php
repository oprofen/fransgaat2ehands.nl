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
 * @package     Vinylstore
 * @subpackage  Tables
 */
class VinylstoreTableLanguage extends StoreTableMultilang
{
    protected $dbName = 'bookstore_language';
    protected $assetNamePrefix = 'bookstore.language';
    protected $parentAssetNamePrefix = 'bookstore';
}
?>