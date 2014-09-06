<?php

/**
 * [BEGIN_COT_EXT]
 * Hooks=page.add.add.done, page.edit.update.done
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
cot_update_ralatedpages($id);
