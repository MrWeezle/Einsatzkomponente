<?php
/**
 * @version     3.0.0
 * @package     com_einsatzkomponente
 * @copyright   Copyright (C) 2013 by Ralf Meyer. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Ralf Meyer <webmaster@feuerwehr-veenhusen.de> - http://einsatzkomponente.de
 */
// No direct access.
defined('_JEXEC') or die;
require_once JPATH_COMPONENT.'/controller.php';
/**
 * Einsatzberichte list controller class.
 */
class EinsatzkomponenteControllerEinsatzberichte extends EinsatzkomponenteController
{
	/**
	 * Proxy for getModel.
	 * @since	1.6
	 */
	public function &getModel($name = 'Einsatzarchiv', $prefix = 'EinsatzkomponenteModel', $config = array())
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}