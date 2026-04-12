<?php
/**
*
* basket_custom1.php
*
* By Roberto Tonjaw. Mar 2015
*/

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

$mode = request_var('mode', '');
$mid = request_var('id', '');
$type = request_var('type', '');
$datetime = request_var('datetime', '');

$qty = (int) request_var('qty', '');
$item_id = request_var('item_id', '');
$price = request_var('price', '0');
$price = str_replace(',', '', $price);
$note = utf8_normalize_nfc(request_var('note', ''));
$code = request_var('code', '');
$date = request_var('date', '');
$month = request_var('month', '');
$year = request_var('year', '');
$hour = request_var('time', '');

//echo $hour . '-0'.'-0-'.$month.'-'.$date.'-'.$year; exit;
$datetime = mktime($hour, 0, 0 , $month, $date, $year);

//echo 'time: ' . date( $config['default_dateformat'], $datetime); exit;
switch( $type )
{
    case $config['tour_buffer_type']:	//TOUR
	$message = $lang['tour_confirm_message'];
	$equip_id = request_var('car_id', '');
	
	$sql_item = "SELECT t.translation_title AS item_name FROM " . TOURS_TABLE . " a, " . 
	    TOUR_TRANSLATIONS_TABLE . " t WHERE a.tour_id=t.tour_id AND a.tour_id=$item_id AND t.language_id='en'";
	    
	$sql_equip = "SELECT t.translation_title AS equip_name FROM " . CARS_TABLE . " a, " . 
	    CAR_TRANSLATIONS_TABLE . " t WHERE a.car_id=t.car_id AND a.car_id=$equip_id AND t.language_id='en'";
	//echo $sql; exit;
	break;

    case $config['spa_buffer_type']:	//SHOP
	$message = $lang['spa_confirm_message'];
	$equip_id = request_var('teraphist_id', '');
	
	$sql_item = "SELECT t.translation_title AS item_name FROM " . SPAS_TABLE . " a, " . 
	    SPA_TRANSLATIONS_TABLE . " t WHERE a.spa_id=t.spa_id AND a.spa_id=$item_id AND t.language_id='en'";
	    
	$sql_equip = "SELECT t.translation_title AS equip_name FROM " . TERAPHISTS_TABLE . " a, " . 
	    TERAPHIST_TRANSLATIONS_TABLE . " t WHERE a.teraphist_id=t.teraphist_id AND a.teraphist_id=$equip_id AND t.language_id='en'";
	//echo $sql; exit;
	break;
}

$result = $db->sql_query($sql_item);
$item_name = (string) $db->sql_fetchfield('item_name');
$db->sql_freeresult($result);

$result = $db->sql_query($sql_equip);
$equip_name = (string) $db->sql_fetchfield('equip_name');
$db->sql_freeresult($result);

$guests_name = array();
$guests_name = get_guests_data($session->mac); // echo 'mac: ' . $guests_name[0]['fullname']; exit;

if ( !empty($qty) )
{
    $sql_ary = array(
	'guest_reservation_id'		=> (int) $guests_name[0]['resv_id'],
	'guest_order_roomname'		=> (string) $guests_name[0]['room'],
	'guest_order_guestname'		=> (string) $guests_name[0]['fullname'],
	'guest_order_received_date'	=> time(),
	'guest_order_type'		=> (string) $type,
	'guest_order_code'		=> (string) $code,
	'guest_order_item'		=> (string) $item_name,
	'guest_order_price'		=> (int) $price,
	'guest_order_qty'		=> (int) $qty,
	'guest_order_note'		=> (string) $note,
	'guest_order_time'		=> (int) $datetime,
	'guest_order_equip'		=> (string) $equip_name,
    );

    $sql = 'INSERT INTO ' . OUTLET_INDIRECT_BUFFER_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
    //echo $sql; exit;
    $db->sql_query($sql);

}


// Generate the page
$template->set_template();
//page_header($lang_id);
page_header($lang_id, $page);


$template->assign_vars(array(
    'L_MESSAGE'		=> '',
    'S_MESSAGE'		=> $message,
));

$template->set_filenames(array(
    'body'	=> 'basket_custom1.tpl',
));

//add_log($adm_lang['read']);
page_footer();

?>
