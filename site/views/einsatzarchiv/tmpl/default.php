<?php
/**
 * @version     3.1.0
 * @package     com_einsatzkomponente
 * @copyright   Copyright (C) 2014. Alle Rechte vorbehalten.
 * @license     GNU General Public License Version 2 oder später; siehe LICENSE.txt
 * @author      Ralf Meyer <ralf.meyer@einsatzkomponente.de> - http://einsatzkomponente.de
 */
// no direct access
defined('_JEXEC') or die;

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_einsatzkomponente', JPATH_ADMINISTRATOR);


JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user = JFactory::getUser();
$userId = $user->get('id');
$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');
$canCreate = $user->authorise('core.create', 'com_einsatzkomponente');
$canEdit = $user->authorise('core.edit', 'com_einsatzkomponente');
$canCheckin = $user->authorise('core.manage', 'com_einsatzkomponente');
$canChange = $user->authorise('core.edit.state', 'com_einsatzkomponente');
$canDelete = $user->authorise('core.delete', 'com_einsatzkomponente');

require_once JPATH_SITE.'/components/com_einsatzkomponente/views/einsatzarchiv/tmpl/'.$this->params->get('main_layout','main_layout_1.php').''; 

?>


