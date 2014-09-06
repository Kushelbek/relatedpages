<?php

/**
 * [BEGIN_COT_EXT]
 * Hooks=page.add.tags, page.edit.tags
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

//require_once cot_incfile('relatedpages', 'plug');
require_once cot_langfile('relatedpages', 'plug');

global $db_x, $cfg, $db_relatedpages;
$db_relatedpages = $db_x.'relatedpages';
/* @var $db CotDB */
/* @var $cache Cache */
/* @var $t Xtemplate */

function cot_update_ralatedpages($page = 0)
{
	global $db, $db_pages, $cfg, $db_relatedpages;

	if ((int)$page == 0)
	{
		return false;
	}
	// проверяемб что было
	$oldrelatedpages = array();
	if ((int)$page > 0)
	{
		$oldrelatedpages = $db->query("SELECT rp_related_id FROM $db_relatedpages WHERE rp_page_id='".(int)$page."' ORDER BY rp_related_id ASC")->fetchAll(PDO::FETCH_COLUMN, 0);
		;
		$oldrelatedpages = (is_array($oldrelatedpages)) ? $oldrelatedpages : array();
	}
	// проверяем что будет
	$related = array();
	$related = cot_import('rrealated_pages', 'P', 'ARR');
	$related = is_array($related) ? $related : array();
	$relatedpages = array();
	foreach ($related as $k => $v)
	{
		if (!empty($v))
		{
			$relatedpages[] = $k;
		}
	}

	// проверяем какие страницы убрались
	$deleted = array_diff($oldrelatedpages, $relatedpages);
	if (!empty($deleted))
	{
		$related_in = "rp_related_id IN ('".implode("','", $deleted)."')";
		$db->delete($db_relatedpages, $related_in);
	}

	//проверяем новые()
	// проверяем какие страницы убрались
	$inserted = array_diff($relatedpages, $oldrelatedpages);
	if (!empty($inserted))
	{
		foreach ($inserted as $v)
		{
			$arr = array();
			$arr['rp_related_id'] = (int)$v;
			$arr['rp_page_id'] = (int)$page;
			$db->insert($db_relatedpages, $arr);
		}
	}
	return true;
}

function cot_delete_ralatedpages($page = 0)
{
	global $db, $db_pages, $cfg, $db_relatedpages;

	if ((int)$page == 0)
	{
		return false;
	}

	$db->delete($db_relatedpages, "rp_page_id=".(int)$page);
	return true;
}

function cot_relatedpages_checklistbox($cat = '', $page = 0)
{
	global $db, $db_pages, $db_users, $env, $structure, $cfg, $db_relatedpages;

	// Get the cats
	$cats = array();
	if (!empty($cat))
	{
		// Specific cat
		$cats = cot_structure_children('page', $cat, $sub);
	}
	if (count($cats) > 0)
	{
		$where_cat = "AND page_cat IN ('".implode("','", $cats)."')";
	}

	$selectedpages = array();
	if ((int)$page > 0)
	{
		$selectedpages = $db->query("SELECT rp_related_id FROM $db_relatedpages WHERE rp_page_id='".(int)$page."' ORDER BY rp_related_id ASC")->fetchAll(PDO::FETCH_COLUMN, 0);;
		$selectedpages = (is_array($selectedpages)) ? $selectedpages : array();
	}
//	cot_print($selectedpages, "SELECT rp_related_id FROM $db_relatedpages WHERE rp_page_id='".(int)$page."' ORDER BY rp_related_id ASC");
	// Display the items
	$t = new XTemplate(cot_tplfile(array('relatedpages', 'form'), 'plug'));

	$sql = $db->query("SELECT * FROM $db_pages WHERE page_state='0' $where_cat ORDER BY page_title ASC");

	$jj = 1;
	while ($row = $sql->fetch())
	{
		$t->assign(cot_generate_pagetags($row, 'PAGE_ROW_'));

		$t->assign(array(
			'PAGE_ROW_CHECK' => cot_checkbox(in_array($row['page_id'], $selectedpages), 'rrealated_pages['.$row['page_id'].']'),
			'PAGE_ROW_NUM' => $jj,
			'PAGE_ROW_ODDEVEN' => cot_build_oddeven($jj),
			'PAGE_ROW_RAW' => $row
		));

		$t->parse("MAIN.PAGE_ROW");
		$jj++;
	}

	$t->parse("MAIN");
	return $t->text("MAIN");
}

function cot_getrelatedpages($page = 0, $order = 'right')
{
	global $db, $db_pages, $db_users, $env, $structure, $cfg, $db_relatedpages;

	if ((int)$page == 0)
	{
		return false;
	}

	// Display the items
	$t = new XTemplate(cot_tplfile(array('relatedpages'), 'plug'));
	$join = ($order == 'right') ? 'rp_related_id' : 'rp_page_id';

	$where = ($order == 'right') ? 'rp_page_id = "'.(int)$page.'"' : 'rp_related_id = "'.(int)$page.'"';
	$sql = $db->query("SELECT p.* FROM $db_pages AS p LEFT JOIN $db_relatedpages AS r ON p.page_id = r.$join WHERE page_state='0' AND $where ORDER BY page_title ASC");

	$jj = 1;
	while ($row = $sql->fetch())
	{
		$t->assign(cot_generate_pagetags($row, 'PAGE_ROW_'));

		$t->assign(array(
			'PAGE_ROW_NUM' => $jj,
			'PAGE_ROW_ODDEVEN' => cot_build_oddeven($jj),
			'PAGE_ROW_RAW' => $row
		));

		$t->parse("MAIN.PAGE_ROW");
		$jj++;
	}

	$t->parse("MAIN");
	return $t->text("MAIN");
}
