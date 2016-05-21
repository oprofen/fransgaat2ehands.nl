<?php
/**
 * @author		
 * @copyright	
 * @license		
 */

defined("_JEXEC") or die("Restricted access");

/**
 * Translator table class.
 *
 * @package     Vinylstore
 * @subpackage  Tables
 */
class VinylstoreTableArtist extends StoreTable
{
    protected $dbName = 'cdstore_artist';
    protected $assetNamePrefix = 'cdstore.language';
    protected $parentAssetNamePrefix = 'cdstore';
}
?>