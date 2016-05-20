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
 * Multi languages item view class.
 *
 * @package     Bookstore
 * @subpackage  Library
 */
class StoreViewLegacyMultilangSingular extends StoreViewLegacySingular
{
    
    public function __construct(array $config)
    {
        parent::__construct($config);

        // Set the default template search path
        $this->_setPath('template', $this->_basePath . '/store/layout/item_multilang');
    }
}

?>