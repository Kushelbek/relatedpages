<?php

/**
 * [BEGIN_COT_EXT]
 * Hooks=page.add.tags, page.edit.tags
 * Tags=page.add.tpl:{PAGEADD_FORM_ADDRELATED};page.edit.tpl:{PAGEEDIT_FORM_ADDRELATED};
 * [END_COT_EXT]
 */
/**
 * plugin Related pages for Cotonti Siena
 * 
 * @package Related pages
 * @version 1.5.0
 * @author esclkm
 * @copyright 
 * @license BSD
 *  */

defined('COT_CODE') or die('Wrong URL.');

require_once cot_incfile('relatedpages', 'plug');

global $db_x, $cfg;

$pr = ((int) $id > 0) ? 'EDIT' : 'ADD';

if ($t->hasTag('PAGE'.$pr.'_FORM_ADDRELATED'))
{
	$t->assign('PAGE'.$pr.'_FORM_ADDRELATED',  cot_relatedpages_checklistbox($cfg['plugin']['relatedpages']['infocat'], $pag['page_id']));
}
