<?php
/**
 * @author		
 * @copyright	
 * @license		
 */

defined("_JEXEC") or die("Restricted access");

// Include the HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
JHtml::_('formbehavior.chosen', 'select');

$app = JFactory::getApplication();
$input = $app->input;
$assoc = JLanguageAssociations::isEnabled();
?>

<div class="container-popup">

<div class="pull-right">
	<button class="btn btn-primary" type="button" onclick="Joomla.submitform('<?php echo $this->nameItem;?>.apply', document.getElementById('adminForm'));"><?php echo JText::_('JTOOLBAR_APPLY') ?></button>
	<button class="btn btn-primary" type="button" onclick="Joomla.submitform('<?php echo $this->nameItem;?>.save', document.getElementById('adminForm'));"><?php echo JText::_('JTOOLBAR_SAVE') ?></button>
	<button class="btn" type="button" onclick="window.location.href ='<?php echo JRoute::_('index.php?option=com_'. $this->nameComponent .'&layout=modal&tmpl=component&view=' . $this->nameItems); ?>' ;"><?php echo JText::_('JCANCEL') ?></button>
</div>

<div class="clearfix"> </div>
<hr class="hr-condensed" />

<form action="<?php echo JRoute::_('index.php?option=com_'. $this->nameComponent .'&layout=modal&tmpl=component&layout=modal&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate form-horizontal">
	<div class="form-vertical">
		<div class="row-fluid">
			<div class="span4">

					<fieldset>
						<?php foreach ($this->form->getFieldset('english') as $field) : ?>
							<?php echo $field->getControlGroup(); ?>
						<?php endforeach; ?>
					</fieldset>

			</div>
			<div class="span4">

				<fieldset>
					<?php foreach ($this->form->getFieldset('dutch') as $field) : ?>
						<?php echo $field->getControlGroup(); ?>
					<?php endforeach; ?>
				</fieldset>

			</div>
			<div class="span3">
				<?php echo JLayoutHelper::render('joomla.edit.publishingdata', $this); ?>
			</div>
		</div>
	</div>
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</form>
