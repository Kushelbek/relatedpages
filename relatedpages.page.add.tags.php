<?php

/**
 * [BEGIN_COT_EXT]
 * Hooks=page.add.tags, page.edit.tags
 * [END_COT_EXT]
 */
/**
 * plugin relatedpages for Cotonti Siena
 * 
 * @package relatedpages
 * @version 1.0.0
 * @author esclkm
 * @copyright 
 * @license BSD
 *  */
// Generated by Cotonti developer tool (littledev.ru)
defined('COT_CODE') or die('Wrong URL.');

require_once cot_incfile('relatedpages', 'plug');

global $db_x, $cfg;

if ($t->hasTag('ADDRELATED'))
{
	$t->assign('ADDRELATED',  cot_relatedpages_checklistbox($cfg['plugin']['relatedpages']['infocat'], $pag['page_id']));
}
?>