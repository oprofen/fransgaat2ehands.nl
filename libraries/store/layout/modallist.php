<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;



JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
JHtml::_('formbehavior.chosen', 'select');
$app       = JFactory::getApplication();
$user      = JFactory::getUser();
$userId    = $user->get('id');
$columns   = 6;

?>
<div class="container-popup">
<div class="pull-left">
	<button class="btn btn-primary" type="button" onclick="Joomla.submitform('<?php echo $this->nameItem;?>.add', document.getElementById('adminForm'));"><?php echo JText::_('JTOOLBAR_NEW') ?></button>
	<button class="btn btn-primary" type="button" onclick="if (document.adminForm.boxchecked.value==0){alert('Please first make a selection from the list.');}else{ Joomla.submitform('<?php echo $this->nameItem;?>.edit', document.getElementById('adminForm'));}"><?php echo JText::_('JTOOLBAR_EDIT') ?></button>
	<button class="btn btn-primary" type="button" onclick="if (document.adminForm.boxchecked.value==0){alert('Please first make a selection from the list.');}else{ Joomla.submitform('<?php echo $this->nameItems;?>.delete', document.getElementById('adminForm'));}"><?php echo JText::_('JTOOLBAR_DELETE') ?></button>
</div>
	<div class="clearfix"> </div>
	<hr class="hr-condensed" />
	<form action="<?php echo JRoute::_('index.php?option=com_'. $this->nameComponent .'&layout=modal&tmpl=component&view=' . $this->nameItems); ?>" method="post" name="adminForm" id="adminForm">
		<fieldset class="filter">
			<div class="btn-toolbar">
				<div class="btn-group">
					<label for="filter_search">
						<?php echo JText::_('JSEARCH_FILTER_LABEL'); ?>
					</label>
				</div>
				<div class="btn-group">
					<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" size="30" title="<?php echo JText::_('COM_CONTENT_FILTER_SEARCH_DESC'); ?>" />
				</div>
				<div class="btn-group">
					<button type="submit" class="btn hasTooltip" title="<?php echo JHtml::tooltipText('JSEARCH_FILTER_SUBMIT'); ?>" data-placement="bottom">
						<span class="icon-search"></span><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
					<button type="button" class="btn hasTooltip" title="<?php echo JHtml::tooltipText('JSEARCH_FILTER_CLEAR'); ?>" data-placement="bottom" onclick="document.getElementById('filter_search').value='';this.form.submit();">
						<span class="icon-remove"></span><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
				</div>
			</div>
			<hr class="hr-condensed" />
		</fieldset>
			<div id="j-main-container">
				<?php if (empty($this->items)) : ?>
					<div class="alert alert-no-items">
						<?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
					</div>
				<?php else : ?>
					<table class="table table-striped" id="<?php echo $this->nameItem;?>List">
						<thead>
						<tr>

							<th width="1%" class="center">
								<?php echo JHtml::_('grid.checkall'); ?>
							</th>

							<th>
								<?php echo JText::_('JGLOBAL_TITLE'); ?>
							</th>

							<th width="10%" class="nowrap hidden-phone">
								<?php echo JText::_('JAUTHOR'); ?>
							</th>

							<th width="10%" class="nowrap hidden-phone">
								<?php echo JText::_('JDATE'); ?>
							</th>

							<th width="1%" class="nowrap hidden-phone">
								<?php echo JText::_('JGRID_HEADING_ID'); ?>

							</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<td colspan="<?php echo $columns; ?>">
							</td>
						</tr>
						</tfoot>
						<tbody>
						<?php foreach ($this->items as $i => $item) :
							$item->max_ordering = 0;
							$ordering   = ($listOrder == 'a.ordering');
							$canCreate  = $user->authorise('core.create');
							$canEdit    = $user->authorise('core.edit',       'com_'. $this->nameComponent .'.'. $this->nameItem .'.' . $item->id);
							$canCheckin = $user->authorise('core.manage',     'com_checkin') || $item->checked_out == $userId || $item->checked_out == 0;
							$canEditOwn = $user->authorise('core.edit.own',   'com_'. $this->nameComponent .'.' . $this->nameItem .'.' . $item->id) && $item->created_by == $userId;
							$canChange  = $user->authorise('core.delete', 'com_'. $this->nameComponent .'.' . $this->nameItem.'.' . $item->id);
							?>
							<tr class="row<?php echo $i % 2; ?>" sortable-group-id="<?php echo $item->catid; ?>">
								<td class="center">
									<?php echo JHtml::_('grid.id', $i, $item->id); ?>
								</td>

								<td class="has-context">
									<div class="pull-left break-word">
										<?php if ($item->checked_out) : ?>
											<?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, $this->nameItems . '.', $canCheckin); ?>
										<?php endif; ?>
										<?php if ($canEdit || $canEditOwn) : ?>
											<a class="hasTooltip" href="<?php echo JRoute::_('index.php?option=com_'. $this->nameComponent .'&task='. $this->nameItem .'.edit&layout=modal&tmpl=component&id=' . $item->id); ?>" title="<?php echo JText::_('JACTION_EDIT'); ?>">
												<?php echo $this->escape($item->title); ?></a>
										<?php else : ?>
											<span><?php echo $this->escape($item->title); ?></span>
										<?php endif; ?>
									</div>
								</td>


								<td class="small hidden-phone">


											<?php echo $this->escape($item->author_name); ?></a>
								</td>

								<td class="nowrap small hidden-phone">
									<?php echo JHtml::_('date', $item->created, JText::_('DATE_FORMAT_LC4')); ?>
								</td>

								<td class="hidden-phone">
									<?php echo (int) $item->id; ?>
								</td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>

				<?php endif;?>

				<input type="hidden" name="task" value="" />
				<input type="hidden" name="boxchecked" value="0" />
				<?php echo JHtml::_('form.token'); ?>
			</div>
	</form>

</div>