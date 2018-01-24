<?php

/**
 *  @module         foldergallery
 *  @version        see info.php of this module
 *  @author         Jürg Rast, schliffer, Bianka Martinovic, Chio, Pumpi, Aldus, erpe
 *  @copyright      2009-2018 Jürg Rast, schliffer, Bianka Martinovic, Chio, Pumpi, Aldus, erpe 
 *  @license        GNU General Public License
 *  @license terms  see info.php of this module
 *  @platform       see info.php of this module
 * 
 */
 
// include class.secure.php to protect this file and the whole CMS!
if (defined('LEPTON_PATH')) {	
	include(LEPTON_PATH.'/framework/class.secure.php'); 
} else {
	$oneback = "../";
	$root = $oneback;
	$level = 1;
	while (($level < 10) && (!file_exists($root.'/framework/class.secure.php'))) {
		$root .= $oneback;
		$level += 1;
	}
	if (file_exists($root.'/framework/class.secure.php')) { 
		include($root.'/framework/class.secure.php'); 
	} else {
		trigger_error(sprintf("[ <b>%s</b> ] Can't include class.secure.php!", $_SERVER['SCRIPT_NAME']), E_USER_ERROR);
	}
}
// end include class.secure.php

// Delete DB-Entries (messages and settings)
$temp_parent_ids = array();
$database->execute_query(
	'SELECT `id` FROM `'.TABLE_PREFIX.'mod_foldergallery_categories` WHERE `section_id`='.$section_id.';',
	true,
	$temp_parent_ids
);

foreach($temp_parent_ids as $parent) {
	$database->simple_query('DELETE FROM `'.TABLE_PREFIX.'mod_foldergallery_files` WHERE `parent_id`='.$parent['id']);
}

$database->simple_query("DELETE FROM `".TABLE_PREFIX."mod_foldergallery_settings` WHERE `page_id` = '$page_id' AND `section_id` = '$section_id'");
$database->simple_query("DELETE FROM `".TABLE_PREFIX."mod_foldergallery_categories` WHERE `section_id` = '$section_id'");

?>