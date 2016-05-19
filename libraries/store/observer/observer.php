<?php
/**
 * @package     Store
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * Class StoreObserver
 */
class StoreObserver extends JTableObserver
{
    /**
     * @param JObservableInterface $observableObject
     * @param array $params
     * @return JTableObserverStore
     */
    //TODO adjust typeAlias
    public static function createObserver(JObservableInterface $observableObject, $params = array())
    {
        $typeAlias = $params['typeAlias'];

        $observer = new self($observableObject);

        $observer->typeAliasPattern = $typeAlias;

        return $observer;
    }


    /**
     * Post-processor for $table->store($updateNulls)
     * You can change optional params newTags and replaceTags of tagsHelper with method setNewTagsToAdd
     *
     * @param   boolean &$result The result of the load
     *
     * @return  void
     *
     * @since   3.1.2
     */
    public function onAfterStore(&$result)
    {
        if ($result) {
            StoreHelper::deleteALLItems($this->table->dataBaseInfo, $this->table->id);
            StoreHelper::insertData($this->table->dataBaseInfo, $this->table);
            return true;
        } else {
            return $result;
        }
    }

    /**
     * Pre-processor for $table->delete($pk)
     *
     * @param   mixed $pk An optional primary key value to delete.  If not set the instance property value is used.
     *
     * @return  void
     *
     * @since   3.1.2
     * @throws  UnexpectedValueException
     */
    public function onBeforeDelete($pk)
    {
        StoreHelper::deleteALLItems($this->table->dataBaseInfo, $this->table->id);
    }

}
