<?php
/**
*
* remote.php	: User's Guide
*
* Roberto Tonjaw. Apr 2014
*/

/**
*/

//header('location: main.php');
//exit;

define('IN_TONJAW', true);
define('NEED_SID', true);
define('IN_FRONTEND', true);

$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : './';
$phpEx = substr(strrchr( $_SERVER['PHP_SELF'], '.'), 1);
$file = explode('.', substr(strrchr( $_SERVER['PHP_SELF'], '/'), 1));
$page = $file[0] . '.' . $phpEx;

// Include files
require($tonjaw_root_path . 'common.' . $phpEx);
require($tonjaw_root_path . 'fe_common.' . $phpEx);
/*
$psswd = request_var('password', '');
$qty = request_var('quantity', '');
$info = request_var('info', '');
*/
$item_id = request_var('item_id', '');
$price = request_var('price', '0');
$price = str_replace(',', '', $price);
$note = utf8_normalize_nfc(request_var('note', ''));
$code = request_var('code', '0');
$gid = request_var('gid', '');
$mode = request_var('mode', '');

echo '1-' . $item_id . '-' . $price . '-' . $note. '-' . $code. '-' . $gid. '-' . $mode; exit;

// Generate the page
$template->set_template();
//page_header($lang_id);
page_header($lang_id, $page);

$template->assign_vars(array(
	'S_PASSWORD'		=> $psswd,
	'S_QUANTITY'		=> $qty,
	'S_INFO'			=> $info,
    ));

$template->set_filenames(array(
	'body' => 'echo.tpl',
));

//add_log($adm_lang['read']);
page_footer();

?>
