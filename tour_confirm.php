<?php
/**
*
* tour_confirm.php
*
* Roberto Tonjaw. Mar 2015
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
$gid = request_var('gid', '');
$mode = request_var('mode', '');
$title = request_var('title', '0');
$key = request_var('key', '');
$key = !trim($key)? '' : '?key=' . $key . '';
$lang_id = 'en';
//echo 'code: ' . $code; exit;

// Generate the page
$template->set_template();
//page_header($lang_id);
page_header($lang_id, $page);

$u_action = $tonjaw_root_path . 'basket_custom1.'. $phpEx . $key;

$template->assign_vars(array(
    'U_ACTION'		=> $u_action,
    'L_CONFIRMATION'	=> $title, //$lang['confirmation'],
    'L_PASSWORD'	=> $lang['password'],
    'L_QUANTITY'	=> $lang['how_many_person'],
    'L_SPECIAL_REQUEST'	=> $lang['special_request'],
    'L_CANCEL'		=> $lang['cancel'],
    'L_CONFIRM'		=> $lang['confirm'],
    'S_CODE'		=> $code,
    'S_ITEM_ID'		=> $item_id,
    'S_GID'		=> $gid,
    'S_MODE'		=> $mode,
    'S_PRICE'		=> $price,
    'S_ITEM'		=> $service_name,
    'L_DATETIME'	=> $lang['datetime'],
    'S_QUANTITY'	=> generate_number_combo('qty', $config['max_qty'], $config['min_qty'], $config['over_max_qty'], $lang['more_than'] . ' ' . $config['max_qty'], true ),
    'L_DATE'		=> $lang['date'],
    'S_DATE'		=> generate_number_combo('date', 31, 1, '', '', false, date('j', time()) + 1 ),
    'L_MONTH'		=> $lang['month'],
    'S_MONTH'		=> generate_number_combo('month', 12, 1, '', '', false, date('n', time()) ),
    'L_YEAR'		=> $lang['year'],
    'S_YEAR'		=> generate_number_combo('year', date('Y', time()) + 1, date('Y', time()), '', '', false, date('Y', time()) ),
    'L_TIME'		=> $lang['time'],
    'S_TIME'		=> generate_time_combo('time', $config['max_hour']),
    'L_TRANSPORTATION'	=> $lang['transportation'],
    'S_TRANSPORTATION'	=> generate_transportation('car_id'),
    'S_TYPE'		=> $config['tour_buffer_type'],
));

$template->set_filenames(array(
	'body' => 'tour_confirm.tpl',
));

//add_log($adm_lang['read']);
page_footer();

?>
