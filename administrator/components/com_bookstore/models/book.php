<?php
/**
 * @author
 * @copyright
 * @license
 */

defined("_JEXEC") or die("Restricted access");

/**
 * Item Model for book.
 *
 * @package     Bookstore
 * @subpackage  Models
 */
class BookstoreModelBook extends StoreModelProductAdmin
{
    /**
     * @var array
     */
    protected $dataBaseInfo = [
        [   'componentName' => 'bookstore',
            'databaseName' => 'assessment',
            'componentNameForAssociation' => 'bookstore',
            'associationName' => 'assessment'
        ],
        [   'componentName' => 'bookstore',
            'databaseName' => 'object_type',
            'componentNameForAssociation' => 'bookstore',
            'associationName' => 'object_type'
        ],
        [   'componentName' => 'bookstore',
            'databaseName' => 'publisher',
            'componentNameForAssociation' => 'bookstore',
            'associationName' => 'publisher'
        ],
        [   'componentName' => 'bookstore',
            'databaseName' => 'subcategory',
            'componentNameForAssociation' => 'bookstore',
            'associationName' => 'subcategory'
        ],
        [   'componentName' => 'bookstore',
            'databaseName' => 'translator',
            'componentNameForAssociation' => 'bookstore',
            'associationName' => 'translator'
        ],
        [   'componentName' => 'bookstore',
            'databaseName' => 'writer',
            'componentNameForAssociation' => 'bookstore',
            'associationName' => 'writer'
        ]
    ];
}

?>