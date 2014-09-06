<?php

/** 
 * [BEGIN_COT_EXT]
 * Hooks=page.edit.delete.done
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
cot_delete_ralatedpages($id);
