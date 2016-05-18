<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_bookstore
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * List controller class.
 *
 * @since  1.6
 */
class StoreControllerAdmin extends JControllerAdmin
{
    /**
     * The prefix to use with controller messages.
     *
     * @var    string
     * @since  1.6
     */
    protected $text_prefix;
    /**
     * Items name used as part of text prefix
     * @var string
     */
    protected $nameItems;
    /**
     * Item name used to get name of model name
     * @var string
     */
    protected $nameItem;
    /**
     * Component name, used to get model name and  as part of text prefix
     * @var string
     */
    protected $nameComponent;

    /**
     * StoreControllerAdmin constructor.
     * @param array $config
     */

    public function __construct(array $config)
    {
        $classNameParts = explode('Controller', get_called_class());
        $this->nameItems = strtolower($classNameParts[1]);
        $this->nameComponent = strtolower($classNameParts[0]);
        $this->nameItem = ($this->nameItem == null) ? substr($this->nameItems, 0, strlen($this->nameItems) - 1) : $this->nameItem;
        $this->text_prefix = "COM_" . strtoupper($this->nameComponent) . "_" . strtoupper($this->nameItems);

        parent::__construct($config);
    }

    /**
     * Method to get a model object, loading it if required.
     *
     * @param   string $name The model name. Optional.
     * @param   string $prefix The class prefix. Optional.
     * @param   array $config Configuration array for model. Optional.
     *
     * @return  JModelLegacy  The model.
     *
     * @since   1.6
     */
    public function getModel($name, $prefix, $config)
    {
        $name = $this->nameItem;
        $prefix = $this->nameComponent . 'Model';
        $config = array('ignore_request' => true);
        $model = parent::getModel($name, $prefix, $config);

        return $model;
    }

    /**
     * Set a URL for browser redirection.
     * @param   string $url URL to redirect to.
     * @param   string $msg Message to display on redirect. Optional, defaults to value set internally by controller, if any.
     * @param   string $type Message type. Optional, defaults to 'message' or the type set by a previous call to setMessage.
     * @return JControllerLegacy
     */
    public function setRedirect($url, $msg = null, $type = null)
    {
        $layout = $this->input->getCmd('layout', '');
        if ($layout === 'modal') {
            $pattern = '/(?<=&layout=)[\w]*(?=(&|))/i';
            if (preg_match($pattern, $url, $match)) {

                $url = preg_replace($pattern, $layout, $url);
            } else {
                $url .= '&layout=' . $layout;
            }
        }
        $tmpl = $this->input->getCmd('tmpl', '');
        if ($tmpl === 'component') {
            $patternTmpl = '/(?<=&tmpl=)[\w]*(?=(&|))/i';
            if (preg_match($patternTmpl, $url, $match)) {

                $url = preg_replace($patternTmpl, $tmpl, $url);
            } else {
                $url .= '&tmpl=' . $tmpl;
            }
        }

        return parent::setRedirect($url, $msg, $type);
    }


}
