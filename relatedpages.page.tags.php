<?php

/**
 * [BEGIN_COT_EXT]
 * Hooks=page.tags
 * Tags=page.tpl:{PAGE_RELATEDPAGES},{PAGE_RELATEDPAGES_LEFT}
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

if ($t->hasTag('PAGE_RELATEDPAGES'))
{
	$t->assign('PAGE_RELATEDPAGES', cot_getrelatedpages($pag['page_id'], 'right'));
}
if ($t->hasTag('PAGE_RELATEDPAGES_LEFT'))
{
	$t->assign('PAGE_RELATEDPAGES_LEFT', cot_getrelatedpages($pag['page_id'], 'left'));
}
