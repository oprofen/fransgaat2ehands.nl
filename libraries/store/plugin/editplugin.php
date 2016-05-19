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
class EditorPlugin extends JPlugin
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
    function onAfterRender()
    {
        $app = JFactory::getApplication();
        $body = $app->getBody();
        $i = $body;
    }
}
?>