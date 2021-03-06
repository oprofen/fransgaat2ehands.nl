<?php
/**
 * @author		
 * @copyright	
 * @license		
 */

defined("_JEXEC") or die("Restricted access");

/**
 * Item Model for dvd.
 *
 * @package     Dvdstore
 * @subpackage  Models
 */
class DvdstoreModelDvd extends StoreModelProductAdmin
{
    protected $dataBaseInfo = [
        [   'componentName' => 'dvdstore',
            'databaseName' => 'assessment',
            'componentNameForAssociation' => 'dvdstore',
            'associationName' => 'assessment'
        ],
        [   'componentName' => 'dvdstore',
            'databaseName' => 'object_type',
            'componentNameForAssociation' => 'dvdstore',
            'associationName' => 'object_type'
        ],
        [   'componentName' => 'dvdstore',
            'databaseName' => 'subcategory',
            'componentNameForAssociation' => 'dvdstore',
            'associationName' => 'subcategory'
        ],
        [   'componentName' => 'bookstore',
            'databaseName' => 'language',
            'componentNameForAssociation' => 'dvdstore',
            'associationName' => 'language'
        ],
        [   'componentName' => 'bookstore',
            'databaseName' => 'language',
            'componentNameForAssociation' => 'dvdstore',
            'associationName' => 'sub_language'
        ],
        [   'componentName' => 'dvdstore',
            'databaseName' => 'actor',
            'componentNameForAssociation' => 'dvdstore',
            'associationName' => 'actor'
        ],
        [   'componentName' => 'dvdstore',
            'databaseName' => 'translator',
            'componentNameForAssociation' => 'dvdstore',
            'associationName' => 'translator'
        ],
        [   'componentName' => 'dvdstore',
            'databaseName' => 'producer',
            'componentNameForAssociation' => 'dvdstore',
            'associationName' => 'producer'
        ],
        [   'componentName' => 'dvdstore',
            'databaseName' => 'distributor',
            'componentNameForAssociation' => 'dvdstore',
            'associationName' => 'distributor'
        ],
        [   'componentName' => 'dvdstore',
            'databaseName' => 'written_by',
            'componentNameForAssociation' => 'dvdstore',
            'associationName' => 'written_by'
        ],
        [   'componentName' => 'dvdstore',
            'databaseName' => 'film_production',
            'componentNameForAssociation' => 'dvdstore',
            'associationName' => 'film_production'
        ]
    ];
}
?>