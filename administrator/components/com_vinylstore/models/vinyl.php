<?php
/**
 * @author		
 * @copyright	
 * @license		
 */

defined("_JEXEC") or die("Restricted access");

/**
 * Item Model for vinyl.
 *
 * @package     Vinylstore
 * @subpackage  Models
 */
class VinylstoreModelVinyl extends StoreModelProductAdmin
{
    protected $dataBaseInfo = [
        [   'componentName' => 'vinylstore',
            'databaseName' => 'assessment',
            'componentNameForAssociation' => 'vinylstore',
            'associationName' => 'assessment'
        ],
        [   'componentName' => 'vinylstore',
            'databaseName' => 'object_type',
            'componentNameForAssociation' => 'vinylstore',
            'associationName' => 'object_type'
        ],
        [   'componentName' => 'cdstore',
            'databaseName' => 'subcategory',
            'componentNameForAssociation' => 'vinylstore',
            'associationName' => 'subcategory'
        ],
        [   'componentName' => 'cdstore',
            'databaseName' => 'artist',
            'componentNameForAssociation' => 'vinylstore',
            'associationName' => 'artist'
        ],
        [   'componentName' => 'cdstore',
            'databaseName' => 'music_producer',
            'componentNameForAssociation' => 'vinylstore',
            'associationName' => 'music_producer'
        ]
    ];
}
?>