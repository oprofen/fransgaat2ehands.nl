<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 13.05.2016
 * Time: 11:10
 */

/**
 * Class StoreHelper
 */
class StoreHelper extends JHelperContent
{
    /**
     * Get the collection from database
     *
     * @param string $collectionName The collection name used as the first part of table
     * @param string $componentName The component name used as the second part of table
     * @param bool $multiLanguage
     * if true, from the table will be got data which corresponds to the system language (Nl or En support)
     * @return array
     */
    public static function getItems($collectionName, $componentName, $multiLanguage = false)
    {

        if ($multiLanguage) {
            $lang = JFactory::getLanguage();
            switch ($lang->getTag()) {
                case 'nl-NL':
                    $title = 'a.title_nl as title';
                    break;
                default :
                    $title = 'a.title_en as title';
                    break;

            };
        } else {
            $title = 'a.title';
        }


        $db = JFactory::getDbo();

        $query = $db->getQuery(true);
        $query->select("a.id, " . $title)->from("#__" . $componentName . "_" . $collectionName . " as a");

        $db->setQuery($query);

        try {
            $items = $db->loadObjectList();
        } catch (RuntimeException $e) {
            JError::raiseWarning(500, $e->getMessage());
        }


        return $items;

    }

    /**
     * Get the item from the collection by its id
     *
     * @param string $collectionName The collection name used as the first part of table
     * @param string $componentName The component name used as the second part of table
     * @param string $componentNameAssoc The association name used as the first part of association table
     * @param string $associationName The association name used as the second part of association table
     * @param integer $id
     * @return mixed
     */

    public static function getItem($collectionName, $componentName, $associationName, $componentNameAssoc, $id)
    {

        $db = JFactory::getDbo();

        $query = $db->getQuery(true)
            ->select("a.id")
            ->from("#__" . $componentName . "_" . $collectionName . " as a")
            ->join('LEFT', $db->quoteName("#__" . $componentNameAssoc . "_association_" . $associationName, 'b') . ' ON (' . $db->quoteName('a.id') . ' = ' . $db->quoteName('b.id') . ')')
            ->where($db->quoteName("b.book") . "=" . $id);
        $db->setQuery($query);

        try {
            $item = $db->loadColumn();
        } catch (RuntimeException $e) {
            JError::raiseWarning(500, $e->getMessage());
        }


        return $item;

    }
    /**
     * Delete all rows of a certain id
     * @param array $tablesInfo Info about component name, database names
     * @param $id
     * @return void
     */
    public static function deleteALLItems($tablesInfo, $id)
    {
        // Deleting old association for these items
        $db = JFactory::getDbo();

        foreach ($tablesInfo as $tableInfo) {
            $query = $db->getQuery(true)
                ->delete($db->qn('#__'.$tableInfo['componentNameForAssociation'].'_association_' . $tableInfo['associationName']))
                ->where($db->qn('book') . '=' . $id);
            $db->setQuery($query);
            $db->execute();
        }
    }

    /**
     * Insert data in association table
     *
     * @param array $tablesInfo Info about component name, database names
     * @param JTable $jtable 
     * @return void
     */
    public static function insertData($tablesInfo, $jtable)
    {
        foreach ($tablesInfo as $tableInfo) {
            $field = $tableInfo['associationName'];
            if (isset($jtable->$field)) {
                $data = $jtable->$field;
                $values = [];
                for ($k = 0; $k < count($data); $k++) {

                    $values[] = $jtable->id . ', ' . $data[$k];

                }

                if (count($values) > 0) {
                    $db = JFactory::getDbo();
                    $query = $db->getQuery(true)
                        ->insert($db->qn('#__'. $tableInfo['componentNameForAssociation'] .'_association_' . $tableInfo['associationName']))
                        ->columns($db->qn(['book', 'id']))
                        ->values($values);
                    $db->setQuery($query);
                    $db->execute();
                }

            }
        }
    }
}