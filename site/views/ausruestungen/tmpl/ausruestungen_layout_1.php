<?php
/**
 * @version     3.0.7
 * @package     com_einsatzkomponente
 * @copyright   Copyright (C) 2015. Alle Rechte vorbehalten.
 * @license     GNU General Public License Version 2 oder sp�ter; siehe LICENSE.txt
 * @author      Ralf Meyer <ralf.meyer@mail.de> - http://einsatzkomponente.de
 */
// no direct access
defined('_JEXEC') or die;

?>

<form action="<?php echo JRoute::_('index.php?option=com_einsatzkomponente&view=ausruestungen'); ?>" method="post"
      name="adminForm" id="adminForm">

	<?php //echo JLayoutHelper::render('default_filter', array('view' => $this), dirname(__FILE__)); ?>
	<table class="table" id="organisationList">
		<thead>
		<tr>

		<th>
		</th>
							<th class=''>
				<?php echo JHtml::_('grid.sort',  'Bezeichnung', 'a.name', $listDirn, $listOrder); ?>
				</th>

							<?php if ($canEdit || $canDelete): ?>
					<th class="center">
				<?php echo JText::_('Actions'); ?>
				</th>
				<?php endif; ?>

		</tr>
		</thead>
		<tfoot>
		<tr>
			<td colspan="<?php echo isset($this->items[0]) ? count(get_object_vars($this->items[0])) : 10; ?>">
				<?php echo $this->pagination->getListFooter(); ?>
			</td>
		</tr>
<?php if (!$this->params->get('eiko')) : ?>
        <tr><!-- Bitte das Copyright nicht entfernen. Danke. -->
            <th colspan="<?php echo isset($this->items[0]) ? count(get_object_vars($this->items[0])) : 10; ?>"><span class="copyright">Einsatzkomponente V<?php echo $this->version; ?>  (C) 2015 by Ralf Meyer ( <a class="copyright_link" href="http://einsatzkomponente.de" target="_blank">www.einsatzkomponente.de</a> )</span></th>
        </tr>
	<?php endif; ?>
		</tfoot>
		<tbody>
		<?php foreach ($this->items as $i => $item) : ?> 
			<?php $canEdit = $user->authorise('core.edit', 'com_einsatzkomponente'); ?>

							<?php if (!$canEdit && $user->authorise('core.edit.own', 'com_einsatzkomponente')): ?>
					<?php $canEdit = JFactory::getUser()->id == $item->created_by; ?>
				<?php endif; ?>

			<tr class="row<?php echo $i % 2; ?>">

				<td>
					<img  class="img-rounded eiko_img_einsatzbild_main_1" style="margin-right:10px;width:<?php echo $this->params->get('display_home_image_width','80px');?>;" src="<?php echo JURI::Root();?><?php echo $item->image;?>" title="<?php echo $item->name;?>"/>

				</td>
				
				<td>
				<?php if (isset($item->checked_out) && $item->checked_out) : ?>
					<?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'ausruestungen.', $canCheckin); ?>
				<?php endif; ?>
				<a href="<?php echo JRoute::_('index.php?option=com_einsatzkomponente&view=ausruestung&id='.(int) $item->id); ?>">
				<?php echo $this->escape($item->name); ?></a>
				</td>
				
				
				
				
				
								<?php if ($canEdit || $canDelete): ?>
					<td class="center">
						<?php if ($canEdit): ?>
							<a href="<?php echo JRoute::_('index.php?option=com_einsatzkomponente&task=ausruestungform.edit&id=' . $item->id, false, 2); ?>" class="btn btn-mini" type="button"><i class="icon-edit" ></i></a>
						<?php endif; ?>
						<?php if ($canDelete): ?>
							<button data-item-id="<?php echo $item->id; ?>" class="btn btn-mini delete-button" type="button"><i class="icon-trash" ></i></button>
						<?php endif; ?>
					</td>
				<?php endif; ?>

			</tr>
			
			
		<?php endforeach; ?>
		</tbody>
	</table>

	<?php if ($canCreate) : ?>
		<a href="<?php echo JRoute::_('index.php?option=com_einsatzkomponente&task=ausruestungform.edit&id=0', false, 2); ?>"
		   class="btn btn-success btn-small"><i
				class="icon-plus"></i>
			<?php echo JText::_('Neue Ausr�stung anlegen'); ?></a>
	<?php endif; ?>

	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
	<?php echo JHtml::_('form.token'); ?>
</form>

<script type="text/javascript">

	jQuery(document).ready(function () {
		jQuery('.delete-button').click(deleteItem);
	});

	function deleteItem() {
		var item_id = jQuery(this).attr('data-item-id');
		<?php if($canDelete) : ?>
		if (confirm("<?php echo JText::_('COM_EINSATZKOMPONENTE_DELETE_MESSAGE'); ?>")) {
			window.location.href = '<?php echo JRoute::_('index.php?option=com_einsatzkomponente&task=ausruestungform.remove&id=', false, 2) ?>' + item_id;
		}
		<?php endif; ?>
	}
</script>


