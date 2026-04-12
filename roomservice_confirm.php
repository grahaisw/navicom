<?php
/**
*
* roomservice_confirm.php	: User's Guide
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

$item_id = request_var('item_id', '');
$price = request_var('price', '0');
$price = str_replace(',', '', $price);
$note = utf8_normalize_nfc(request_var('note', ''));
$code = request_var('code', '0');
$service_name = request_var('title', '');
$gid = request_var('gid', '');
$mode = request_var('mode', '');
$key = request_var('key', '');
$key = !trim($key)? '' : '?key=' . $key . '';

//echo 'code: ' . $code; exit;

// Generate the page
$template->set_template();
//page_header($lang_id);
page_header($lang_id, $page);

$u_action = $tonjaw_root_path . 'basket1.'. $phpEx . $key;

$template->assign_vars(array(
    'L_CONFIRMATION'	=> $lang['confirmation'],
    'L_PASSWORD'	=> $lang['password'],
    'L_QUANTITY'	=> $lang['quantity'],
    'L_SPECIAL_REQUEST'	=> $lang['special_request'],
    'L_CANCEL'		=> $lang['cancel'],
    'L_CONFIRM'		=> $lang['confirm'],
    'U_ACTION'		=> $u_action,
    'S_QUANTITY'	=> generate_number_combo('qty', $config['max_qty'], $config['min_qty'], false, $lang['more_than'] . ' ' . $config['max_qty'], true ),
    'S_CODE'		=> $code,
    'S_ITEM_ID'		=> $item_id,
    'S_GID'		=> $gid,
    'S_MODE'		=> $mode,
    'S_PRICE'		=> $price,
    'S_ITEM'		=> $service_name,
    'S_TYPE'		=> $config['roomservice_buffer_type'],
));

$template->set_filenames(array(
	'body' => 'roomservice_confirm.tpl',
));

//add_log($adm_lang['read']);
page_footer();

?>
