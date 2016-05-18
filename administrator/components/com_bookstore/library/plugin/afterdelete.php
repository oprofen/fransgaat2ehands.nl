<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 26.04.2016
 * Time: 14:06
 */

jimport('joomla.plugin');


/**
 * Class AfterDeletePlugin
 */
class AfterDeletePlugin extends JPlugin
{

    /**
     * Event fired after delete. Method deletes items from association table  when you delete from the source tables
     * @param string $context
     * @param JTable $table
     * @return void
     */
    function onContentAfterDelete($context, $table)
    {
        $context = explode('.', $context);

        switch ($context[0]) {
            case 'com_bookstore':
                switch ($context[1]) {
                    case 'assessment':
                    case 'object_type':
                    case 'publisher':
                    case 'subcategory':
                    case 'translator':
                    case 'writer':
                        $this->deleteLines($context[0], $context[1], $table->id);
                        break;
                    case 'language':
                        $this->deleteLines('dvdstore', 'language', $table->id);
                        $this->deleteLines('dvdstore', 'sub_language', $table->id);
                        break;
                }
                break;
            case 'com_dvdstore':
                switch ($context[1]) {
                    case 'assessment':
                    case 'object_type':
                    case 'actor':
                    case 'subcategory':
                        $this->deleteLines($context[0], $context[1], $table->id);
                        break;
                    case 'language':
                        $this->deleteLines('dvdstore', 'language', $table->id);
                        $this->deleteLines('dvdstore', 'sub_language', $table->id);
                        break;
                }
                break;
        }
    }

    /**
     * Used to delete lines from the association table
     * @param string $componentNameAssoc the first part of the table name in database
     * @param string $associationName the second part of the table name in database
     * @param int $id Id of the item
     * @return void
     */
    private function deleteLines($componentNameAssoc, $associationName, $id)
    {
        $db = JFactory::getDbo();

        $query = $db->getQuery(true)
            ->delete($db->qn('#__' . $componentNameAssoc . '_association_' . $associationName))
            ->where($db->qn('id') . '=' . $id);

        $db->setQuery($query);

        $db->execute();
    }
}

?>