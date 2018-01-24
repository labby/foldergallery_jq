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

$module_directory     = "foldergallery";


if (isset ($oLEPTON)) {
	/**
	 *	load the correct language-file for frontend
	 */
	if (file_exists (LEPTON_PATH.'/templates/'.DEFAULT_TEMPLATE.'/frontend/'.$module_directory.'/'.LANGUAGE.'.php')) {
			require_once LEPTON_PATH.'/templates/'.DEFAULT_TEMPLATE.'/frontend/'.$module_directory.'/'.LANGUAGE.'.php';
	}
	else {
		$lang = (dirname(__FILE__))."/languages/". LANGUAGE .".php";
		require_once !file_exists($lang) ? (dirname(__FILE__))."/languages/EN.php" : $lang ;
	}
}
else {
	/**
	 *	load the correct language-file for backend
	 */
	if (file_exists (LEPTON_PATH.'/templates/'.DEFAULT_THEME.'/backend/'.$module_directory.'/'.LANGUAGE.'.php')) {
			require_once LEPTON_PATH.'/templates/'.DEFAULT_THEME.'/backend/'.$module_directory.'/'.LANGUAGE.'.php';
	}
	else {
		$lang = (dirname(__FILE__))."/languages/". LANGUAGE .".php";
		require_once !file_exists($lang) ? (dirname(__FILE__))."/languages/EN.php" : $lang ;
	}
}
?>