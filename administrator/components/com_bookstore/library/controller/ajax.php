<?php
defined('_JEXEC') or die;
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 12.04.2016
 * Time: 14:48
 */

/**
 * Class StoreControllerAjax
 *
 * Allows ajax tasks
 */
class StoreControllerAjax extends JControllerLegacy
{
    /** get data of certain collection
     * @throws Exception
     * @return void
     */
    public function getAjaxData()
    {
        $app = JFactory::getApplication();
        $collection = StoreHelper::getItems($this->input->getCmd('collection'), $this->input->getCmd('componentname'),
            filter_var($this->input->getCmd('multilanguage'), FILTER_VALIDATE_BOOLEAN));

        try
        {
            echo new JResponseJson($collection);
        }
        catch(Exception $e)
        {
            echo new JResponseJson($e);
        }
        $app->close();
    }
}