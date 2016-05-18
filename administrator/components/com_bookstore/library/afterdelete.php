<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 26.04.2016
 * Time: 14:06
 */

jimport('joomla.plugin');


/**
 * Example Plugin
 *
 * @author
 * @package
 * @subpackage
 * @since
 */
class AfterDeletePlugin extends JPlugin
{
    /**
     * This method handles the onIncrement fictional event.  It takes an integer input and
     * increments its value.
     *
     * @param  integer  $input An integer to increment
     *
     * @return integer  Incremented integer
     *
     * @since 3.x
     * @access public
     */
    function onContentAfterDelete($context, $table)
    {
        $tables = BookstoreHelper::$databases;
        $context = explode ('.',$context);
        if(in_array($context[1], $tables)){
            $db = JFactory::getDbo();
            $query = $db->getQuery(true)
                ->delete($db->qn('#__bookstore_association_' . $context[1]))
                ->where($db->qn('id') . '=' . $table->id);
            $db->setQuery($query);
            $db->execute();
        }
    }
}
?>