<?php
/**
 * @author		
 * @copyright	
 * @license		
 */

defined("_JEXEC") or die("Restricted access");

class BookstoreController extends JControllerLegacy
{
	/**
	 * The default view for the display method.
	 *
	 * @var    string
	 * @since  12.2
	 */
	protected $default_view = 'books';


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
		$view = $this->input->get('view', 'books');
		$layout = $this->input->get('layout', 'books');
		$id = $this->input->getInt('id');

		$keeplayout = $this->input->getCmd('keeplayout', '');
		if ($keeplayout !== '') {
			$layout = $keeplayout;

		}

		// Check for edit form.
		if ($view == 'book' && $layout == 'edit' && !$this->checkEditId('com_bookstore.edit.book', $id)) {
			// Somehow the person just went to the form - we don't allow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_bookstore&view=books', false));

			return false;
		}

		return parent::display();
	}

	/**
	 * Redirects the browser or returns false if no redirect is set.
	 *
	 * @return  boolean  False if no redirect exists.
	 *
	 * @since   12.2
	 */
	public function redirect()
	{
		if ($this->redirect)
		{
			$keeplayout = $this->input->getCmd('keeplayout', '');
			if ($keeplayout !== '') {
				$pattern = '/(?<=&layout=)[\w]*(?=(&|))/i';
				if (preg_match($pattern,$this->redirect, $match)) {

					$url = preg_replace($pattern, $keeplayout, $url);
				} else {
					$this->redirect .= '&layout=' . $keeplayout;
				}

			}
			$app = JFactory::getApplication();

			// Enqueue the redirect message
			$app->enqueueMessage($this->message, $this->messageType);

			// Execute the redirect
			$app->redirect($this->redirect);
		}

		return false;
	}
}
?>