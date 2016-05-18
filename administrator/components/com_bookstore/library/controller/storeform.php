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
 * Client controller class.
 *
 * @since  1.6
 */
class StoreControllerForm extends JControllerForm
{
    /**
     * The prefix to use with controller messages.
     *
     * @var    string
     * @since  1.6
     */
    protected $text_prefix;
    /**
     * 
     * @var string
     */
    protected $nameItem;
    /**
     * Items name used as part of text prefix
     * @var string
     */
    protected $nameItems;
    /**
     * Component name used as part of text prefix
     * @var string 
     */
    protected $nameComponent;

    public function __construct(array $config)
    {
        $classNameParts = explode('Controller', get_called_class());

        $this->nameItem = strtolower($classNameParts[1]);
        $this->nameComponent = strtolower($classNameParts[0]);
        $this->nameItems = ($this->nameItems == null) ? $this->nameItem . "s" : $this->nameItems;
        $this->text_prefix = "COM_" . strtoupper($this->nameComponent) . "_" . strtoupper($this->nameItem);
        parent::__construct($config);
    }

    /**
     * @param string $url
     * @param null $msg
     * @param null $type
     * @return JControllerLegacy
     */
    public function setRedirect($url, $msg = null, $type = null)
    {
        $layout = $this->input->getCmd('layout', '');
        if ($layout === 'modal') {
            $pattern = '/(?<=&layout=)[\w]*(?=(&|))/i';
            if (preg_match($pattern,$url, $match)) {

                $url = preg_replace($pattern, $layout, $url);
            } else {
                $url .= '&layout=' . $layout;
            }
        }
        $tmpl = $this->input->getCmd('tmpl', '');
        if ($tmpl === 'component') {
            $patternTmpl = '/(?<=&tmpl=)[\w]*(?=(&|))/i';
            if (preg_match($patternTmpl,$url, $match)) {

                $url = preg_replace($patternTmpl, $tmpl, $url);
            } else {
                $url .= '&tmpl=' . $tmpl;
            }
        }

        return parent::setRedirect($url, $msg, $type);
    }


}
