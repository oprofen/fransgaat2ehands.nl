<?php
/**
 * @author		
 * @copyright	
 * @license		
 */

defined("_JEXEC") or die("Restricted access");

/**
 * Item Model for cd.
 *
 * @package     Cdstore
 * @subpackage  Models
 */
class CdstoreModelCd extends StoreModelProductAdmin
{
    protected $dataBaseInfo = [
        [   'componentName' => 'cdstore',
            'databaseName' => 'assessment',
            'componentNameForAssociation' => 'cdstore',
            'associationName' => 'assessment'
        ],
        [   'componentName' => 'cdstore',
            'databaseName' => 'object_type',
            'componentNameForAssociation' => 'cdstore',
            'associationName' => 'object_type'
        ],
        [   'componentName' => 'cdstore',
            'databaseName' => 'subcategory',
            'componentNameForAssociation' => 'cdstore',
            'associationName' => 'subcategory'
        ],
        [   'componentName' => 'cdstore',
            'databaseName' => 'artist',
            'componentNameForAssociation' => 'cdstore',
            'associationName' => 'artist'
        ],
        [   'componentName' => 'cdstore',
            'databaseName' => 'music_producer',
            'componentNameForAssociation' => 'cdstore',
            'associationName' => 'music_producer'
        ]
    ];
}
?>