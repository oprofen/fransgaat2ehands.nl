<?php
/**
 * @author		
 * @copyright	
 * @license		
 */

defined("_JEXEC") or die("Restricted access");

/**
 * Book table class.
 *
 * @package     Bookstore
 * @subpackage  Tables
 */
class BookstoreTableBook extends StoreTableProduct
{
    public function bind($src, $ignore = array())
    {
        if(!$src['ean13']){
            $src['ean13'] = $src['isbn13'];
        }

        return parent::bind($src, $ignore);
    }
    /**
     * Overloaded check function
     *
     * @return  boolean  True on success, false on failure
     *
     * @see     JTable::check
     * @since   1.5
     */
    public function check()
    {
        if($this->year_issue){
        $this->year_issue = (int)$this->year_issue;
        }
        if($this->year_original){
            $this->year_original= (int)$this->year_original;
        };
       
        return parent::check();
    }
}
?>