<?php
/**
 * @author
 * @copyright
 * @license
 */

defined("_JEXEC") or die("Restricted access");

// necessary libraries
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select', JDEBUG,['disable_search_threshold' => 1]);

JFactory::getDocument()->addScript('components/com_bookstore/assets/js/custom.js');

?>

<script type="text/javascript">
    Joomla.submitbutton = function (task) {
        if (task == 'book.cancel' || document.formvalidator.isValid(document.id('book-form'))) {
            Joomla.submitform(task, document.getElementById('book-form'));
        }
    }
</script>

<form action="<?php echo JRoute::_('index.php?option=com_bookstore&id=' . (int)$this->item->id); ?>" method="post"
      name="adminForm" id="book-form" class="form-validate">

    <div class="form-inline form-inline-header">
        <div class="control-group">
            <div class="control-label"><?php echo $this->form->getLabel('id'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('id'); ?></div>
        </div>
    </div>

    <div class="form-horizontal main-product">
        <?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'Tab_1')); ?>

        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'Tab_1', JText::_('COM_BOOKSTORE_FIELDSET_TAB_1', true), true); ?>
        <div class="row-fluid">
            <div class="span4">
                <fieldset>
                    <?php foreach ($this->form->getFieldset('firstTab_1') as $field) : ?>
                        <?php echo $field->renderField(); ?>
                    <?php endforeach; ?>
                </fieldset>
            </div>
            <div class="span4">
                <fieldset>
                    <?php foreach ($this->form->getFieldset('firstTab_2') as $field) : ?>
                        <?php echo $field->renderField(); ?>
                    <?php endforeach; ?>
                </fieldset>
            </div>
            <div class="span4">
                <fieldset>
                    <?php foreach ($this->form->getFieldset('firstTab_3') as $field) : ?>
                        <?php echo $field->renderField(); ?>
                    <?php endforeach; ?>
                </fieldset>
                <div id="show_images_new">
                </div>
            </div>

        </div>
        <?php echo JHtml::_('bootstrap.endTab'); ?>

        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'Tab_2', JText::_('COM_BOOKSTORE_FIELDSET_TAB_2', true), true); ?>
        <div class="row-fluid">
            <div class="span4">
                <fieldset>
                    <?php foreach ($this->form->getFieldset('SecondTab_1') as $field) : ?>
                        <?php echo $field->renderField(); ?>
                    <?php endforeach; ?>
                </fieldset>
            </div>
            <div class="span4">
                <fieldset>
                    <?php foreach ($this->form->getFieldset('SecondTab_2') as $field) : ?>
                        <?php echo $field->renderField(); ?>
                    <?php endforeach; ?>
                </fieldset>
            </div>
            <div class="span4">
                <fieldset>
                    <?php foreach ($this->form->getFieldset('SecondTab_3') as $field) : ?>
                        <?php echo $field->renderField(); ?>
                    <?php endforeach; ?>
                </fieldset>

            </div>
        </div>
        

   

    <?php echo JHtml::_('bootstrap.endTab'); ?>

    <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'publishing', JText::_('JGLOBAL_FIELDSET_PUBLISHING', true)); ?>
    <div class="row-fluid">
        <div class="span6">
            <?php echo JLayoutHelper::render('joomla.edit.publishingdata', $this); ?>
        </div>
        <div class="span6">
            <?php echo JLayoutHelper::render('joomla.edit.metadata', $this); ?>
        </div>
    </div>
    <?php echo JHtml::_('bootstrap.endTab'); ?>
        <?php if ($this->canDo->get('core.admin')) : ?>
            <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'permissions', JText::_('COM_BOOKSTORE_FIELDSET_RULES', true)); ?>
            <?php echo $this->form->getInput('rules'); ?>
            <?php echo JHtml::_('bootstrap.endTab'); ?>
        <?php endif; ?>
    <?php echo JHtml::_('bootstrap.endTabSet'); ?>
    </div>
    <input type="hidden" name="task" value=""/>
    <?php echo JHtml::_('form.token'); ?>
</form>