<?php
/**
 * @package     Bookstore
 * @subpackage  Library
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined("_JEXEC") or die("Restricted access");


/**
 * Product view class.
 *
 * @package     Bookstore
 * @subpackage  Library
 */
class StoreViewLegacyProductSingular extends StoreViewLegacySingular
{

    public function __construct(array $config)
    {
        parent::__construct($config);
        // Set a base path for use by the view
        $this->_basePath = JPATH_COMPONENT;
        
        // Set the default template search path
        $this->_setPath('template', $this->_basePath . '/views/' . $this->getName() . '/tmpl');


    }
}

?>