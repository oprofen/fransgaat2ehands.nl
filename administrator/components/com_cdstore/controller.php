<?php
/**
 * @author		
 * @copyright	
 * @license		
 */

defined("_JEXEC") or die("Restricted access");

class CdstoreController extends JControllerLegacy
{
	/**
	 * The default view for the display method.
	 *
	 * @var    string
	 * @since  12.2
	 */
	protected $default_view = 'cds';


	/**
	 * Method to display a view.
	 *
	 * @param   boolean $cachable If true, the view output will be cached
	 * @param   array $urlparams An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return  JController        This object to support chaining.
	 *
	 * @since   1.5
	 */
	public function display($cachable = false, $urlparams = array())
	{
		$view = $this->input->get('view', 'cds');
		$layout = $this->input->get('layout', 'cds');
		$id = $this->input->getInt('id');

		// Check for edit form.
		if ($view == 'cd' && $layout == 'edit' && !$this->checkEditId('com_cdstore.edit.cd', $id)) {
			// Somehow the person just went to the form - we don't allow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_cdstore&view=cds', false));

			return false;
		}

		return parent::display();
	}
	
}
?>