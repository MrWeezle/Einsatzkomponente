
<?php
/**
 * @version    CVS: 3.9
 * @package    Com_Einsatzkomponente
 * @author     Ralf Meyer <ralf.meyer@einsatzkomponente.de>
 * @copyright  Copyright (C) 2015. Alle Rechte vorbehalten.
 * @license    GNU General Public License Version 2 oder später; siehe LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

require_once JPATH_SITE.'/administrator/components/com_einsatzkomponente/helpers/einsatzkomponente.php'; // Helper-class laden

$canEdit = JFactory::getUser()->authorise('core.edit', 'com_einsatzkomponente.' . $this->item->id);
if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_einsatzkomponente' . $this->item->id)) {
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
?>
<?php if ($this->item) : ?>
<?php if ($this->item->state == '2'): $this->item->name = $this->item->name.' (a.D.)';endif;?>


	<div class="item_fields">
		<table class="table">

<?php if ($this->params->get('show_fahrzeuge_beschreibung','1')) : ?>
<?php if( $this->item->desc) : ?>
<tr>
	<?php jimport('joomla.html.content'); ?>  
	<?php $Desc = JHTML::_('content.prepare', $this->item->desc); ?>
	<div class="eiko_orga_desc">
	<?php echo $Desc;?>
	<br/>

			</div>
</tr>
<?php endif;?>
<?php endif;?> 


<?php if (!$this->params->get('show_fahrzeuge_beschreibung','0')) : ?>



  <!-- Page Content -->
  
  <style>
  .portfolio-item {
    margin-bottom: 25px;
}
.img-responsive {padding-top:10px;}
  </style>
  
  
    <div class="container">

        <!-- Portfolio Item Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
								<?php if ($this->params->get('show_fahrzeuge_detail_1','1')) : ?>
								<?php //echo $this->item->detail1_label; ?>
								<?php echo $this->item->detail1; ?>
								<?php endif;?>

                    <small><?php echo $this->item->name; ?>
					</small>
                </h1>
				
					<?php if ($this->params->get('show_fahrzeuge_orga','1')) : ?>
					<h3><?php echo 'Organisation'; ?>:
					<?php echo $this->item->department; ?></h3>
					<?php endif;?>
				
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Item Row -->
        <div class="row">

            <div class="col-md-8">
                <img class="img-responsive" src="<?php echo $this->item->image;?>" alt="">
            </div>

            <div class="col-md-4">
			<?php if ($this->params->get('show_fahrzeuge_desc','1')) : ?>
			<?php if( $this->item->desc) : ?>
            <h3>Beschreibung</h3>
			<p>
				<?php jimport('joomla.html.content'); ?>  
				<?php $Desc = JHTML::_('content.prepare', $this->item->desc); ?> 
				<div class="eiko_fahrzeuge_desc">
				<?php echo $Desc;?>
				</div>
			</p>
			<?php endif;?>
			<?php endif;?>
                <h3>weitere Daten</h3>
                <ul>
					<?php if ($this->params->get('show_fahrzeuge_detail_2','1')) : ?>
					<li><?php echo $this->item->detail2_label; ?>:
					<?php echo $this->item->detail2; ?></li>
					<?php endif;?>
					<?php if ($this->params->get('show_fahrzeuge_detail_3','1')) : ?>
					<li><?php echo $this->item->detail3_label; ?>:
					<?php echo $this->item->detail3; ?></li>
					<?php endif;?>
					
					<?php if ($this->params->get('show_fahrzeuge_detail_4','1')) : ?>
					<li><?php echo $this->item->detail4_label; ?>:
					<?php echo $this->item->detail4; ?></li>
					<?php endif;?>

					<?php if ($this->params->get('show_fahrzeuge_detail_5','1')) : ?>
					<li><?php echo $this->item->detail5_label; ?>:
					<?php echo $this->item->detail5; ?></li>
					<?php endif;?>

					<?php if ($this->params->get('show_fahrzeuge_detail_6','1')) : ?>
					<li><?php echo $this->item->detail6_label; ?>:
					<?php echo $this->item->detail6; ?></li>
					<?php endif;?>

					<?php if ($this->params->get('show_fahrzeuge_detail_7','1')) : ?>
					<li><?php echo $this->item->detail7_label; ?>:
					<?php echo $this->item->detail7; ?></li>
					<?php endif;?>
					<?php if ($this->params->get('show_fahrzeuge_link','1')) : ?>
					<?php if( $this->item->link) : ?>
					<?php echo '<br/><li>Link zur Webseite: <a href="" target="blank" class="eiko_fahrzeuge_link">'.$this->item->link.'</a></li>'; ?>
					<?php endif;?>
					<?php endif;?>
					
					<?php // letzter Einsatz   
					$database			= JFactory::getDBO();
					$query = 'SELECT * FROM #__eiko_einsatzberichte WHERE FIND_IN_SET ("'.$this->item->id.'",vehicles) AND (state ="1" OR state="2") ORDER BY date1 DESC' ;
					$database->setQuery( $query );
					$total = $database->loadObjectList();
					?>
					<?php if ($total) : ?>
					<br/><li>Letzter Eintrag in unserem Einsatzarchiv : 
					<a href="<?php echo JRoute::_('index.php?option=com_einsatzkomponente&view=einsatzbericht&id='.(int) $total[0]->id); ?>"><?php echo date("d.m.Y", strtotime($total[0]->date1));?></a></li>
					<?php endif; ?>
					
<!-- Ausrüstung anzeigen -->  
<?php 	if ($this->params->get('show_fahrzeuge_ausruestung','0')) : 
		if(!$this->item->ausruestung == '') :
		if ($this->params->get('eiko','0')) : 
				$array = array();
				$ausruestung = '';
				$this->item->ausruestung = explode(",", $this->item->ausruestung);
				foreach((array)$this->item->ausruestung as $value): 
					if(!is_array($value)):
						$array[] = $value;
					endif;
				endforeach;
				$data = array();
				foreach($array as $value):
					$ausruestung .= '<li> '.$value.'</li>';
				endforeach; 
  
 ?>
 <br/><li>Beladung / Ausrüstung: <ul><?php echo $ausruestung;?></ul></li> 
 <?php endif;?>
 <?php endif;?>
 <?php endif;?>
<!-- Ausrüstung anzeigen ENDE -->  

                </ul>
            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->	



<?php endif;?>


		</table>
	</div>
	
	
	
	
	
	<br/>
	
	
	<?php if($canEdit): ?>
		<a class="btn" href="<?php echo JRoute::_('index.php?option=com_einsatzkomponente&view=fahrzeugform.&id='.$this->item->id); ?>"><?php echo JText::_("Bearbeiten"); ?></a>
	<?php endif; ?>
								<?php //if(JFactory::getUser()->authorise('core.delete','com_einsatzkomponente.einsatzfahrzeug.'.$this->item->id)):?>
									<!-- <a class="btn" href="<?php echo JRoute::_('index.php?option=com_einsatzkomponente&task=fahrzeug.remove&id=' . $this->item->id, false, 2); ?>"><?php echo JText::_("Löschen"); ?></a> -->
								<?php //endif; ?>
	<?php
else:
	echo JText::_('COM_EINSATZKOMPONENTE_ITEM_NOT_LOADED');
endif;?>













