<?php
/**
*
* basket1.php
*
* Started by Andes Jan 2015
* Enhanced by Roberto Tonjaw. Mar 2015
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
$datetime = request_var('datetime', 0);
$option_name = request_var('option_name', '');
$option_val = request_var('option_val', '');
$password = strtoupper(request_var('password', ''));

$qty = request_var('qty', '');
$item_id = request_var('item_id', '');
$price = request_var('price', '0');
$price = str_replace(',', '', $price);
$note = utf8_normalize_nfc(request_var('note', ''));
$code = request_var('code', '');
$service_name = request_var('title', '');
$key = request_var('key', '');
$key = !trim($key)? '' : '?key=' . $key . '';
$gid = request_var('gid', '');

$guests_name = array();
$guests_name = get_guests_data($session->mac); // echo 'mac: ' . $guests_name[0]['fullname']; exit;
//print_r($guests_name); exit;
//echo 'passwd: ' . $password . '<br/>room: ' . $guests_name[0]['room'] . '<br/>IP: ' . $session->ip . '<br/>Mac: ' . $session->mac; exit;

/*
if ( $password !== $guests_name[0]['room'] && $mode !=='view' && $mode !== 'delete')
{
    //echo 'Ilegal Password'; exit;
    switch( $type )
    {
	case $config['roomservice_buffer_type']:
	    $page = 'roomservice_confirm.tpl';
	    break;
	    
	case $config['shop_buffer_type']:
	    $page = 'shop_confirm.tpl';
	    break;
    }
    // Generate the page
    $template->set_template();
    //page_header($lang_id);
    page_header($lang_id, $page);

    $u_action = $tonjaw_root_path . 'basket1.'. $phpEx;

    $template->assign_vars(array(
	'L_CONFIRMATION'	=> $lang['wrong_password'], //$lang[''],
	'L_PASSWORD'		=> $lang['password'],
	'L_QUANTITY'		=> $lang['quantity'],
	'L_SPECIAL_REQUEST'	=> $lang['special_request'],
	'L_CANCEL'		=> $lang['cancel'],
	'L_CONFIRM'		=> $lang['confirm'],
	'U_ACTION'		=> $u_action,
	'S_QUANTITY'		=> generate_number_combo('qty', $config['max_qty'], $config['min_qty'], $config['over_max_qty'], $lang['more_than'] . ' ' . $config['max_qty'], true, $qty ),
	'S_CODE'		=> $code,
	'S_ITEM_ID'		=> $item_id,
	'S_NOTE'		=> $note,
	'S_GID'			=> $gid,
	'S_MODE'		=> $mode,
	'S_PRICE'		=> $price,
	'S_ITEM'		=> $service_name,
	'S_TYPE'		=> $type,
    ));

    $template->set_filenames(array(
	    'body' => $page,
    ));

    //add_log($adm_lang['read']);
    page_footer();
}
*/

//require_once($tonjaw_root_path . $config['pms_path'] . 'common_pms.' . $phpEx);

// if insert item
if( isset ($_POST['qty']) ){ 
/*
    $qty = request_var('qty', '');
    $item_id = request_var('item_id', '');
    $price = request_var('price', '0');
    $price = str_replace(',', '', $price);
    $note = utf8_normalize_nfc(request_var('note', ''));
    $code = request_var('code', '');
*/    
    switch ($type)
    {
	case $config['shop_buffer_type']:
	
	    if ( $pms_config['shop_name_from_pos'] )
	    {
		// GRAB Shop Item Name from POS of PMS
		//require($tonjaw_root_path . $config['pms_path'] . $pmsname . '.' . $phpEx);
		//$pms	= new $pms_api();
		$pms->get_shop_item($code);
		$item_name = $pms->menu_data[0]['menu_name'];
	    }
	    else
	    {
		$sql = "SELECT t.translation_title AS shop_name 
		FROM " . SHOPS_TABLE . " s 
		JOIN " . SHOP_TRANSLATIONS_TABLE . " t ON t.shop_id = s.shop_id 
		WHERE t.language_id= '" . $config['default_language'] . "' 
		AND s.shop_id= " . $item_id ;
	    
		//echo 'crot-sql: ' . $sql; exit;
		
		$result = $db->sql_query($sql);
		$item_name = utf8_normalize_nfc($db->sql_fetchfield('shop_name'));
		
		$db->sql_freeresult($result);
	    }
	
	    $sql_list = "SELECT * FROM " . GUEST_BASKETS_TABLE . " 
		WHERE guest_basket_type='" . $type . "'	AND room_name='" . $guests_name[0]['room'] . "' ORDER BY guest_basket_id DESC";
	    
	    break;
	    
	default:
	    if ( $pms_config['roomservice_name_from_pos'] )
	    {		
			// GRAB Room Service Menu from POS of PMS
			//require($tonjaw_root_path . $config['pms_path'] . $pmsname . '.' . $phpEx);
			//$pms	= new $pms_api();
			$response = $pms->get_menu_item($code);

			if($response === TRUE) { //echo 'a';
				$item_name = $pms->menu_data[0]['menu_name'];
				$item_price = $pms->menu_data[0]['price_nett'];
			} else { //echo 'b';
				$sql = "SELECT t.translation_title AS service_name, s.service_price 
				FROM " . SERVICES_TABLE . " s 
				JOIN " . SERVICE_TRANSLATIONS_TABLE . " t ON t.service_id = s.service_id 
				WHERE t.language_id= '" . $config['default_language'] . "' 
				AND s.service_id= " . $item_id ;

				$result = $db->sql_query($sql);
				//$item_name = utf8_normalize_nfc($db->sql_fetchfield('service_name'));
				$row = $db->sql_fetchrow($result);
				$item_name = $row['service_name'];
				$item_price = $row['service_price'] + (0.21 * $row['service_price']);
			}
	    }
	    else
	    {
		$sql = "SELECT t.translation_title AS service_name, s.service_price 
		FROM " . SERVICES_TABLE . " s 
		JOIN " . SERVICE_TRANSLATIONS_TABLE . " t ON t.service_id = s.service_id 
		WHERE t.language_id= '" . $config['default_language'] . "' 
		AND s.service_id= " . $item_id ;
	    
		$result = $db->sql_query($sql);
		//$item_name = utf8_normalize_nfc($db->sql_fetchfield('service_name'));
		$row = $db->sql_fetchrow($result);
		$item_name = $row['service_name'];
		$item_price = $row['service_price'];
		
		$db->sql_freeresult($result);
	    }
	
	    $type = $config['roomservice_buffer_type'];
	    
	    $sql_list = "SELECT * FROM " . GUEST_BASKETS_TABLE . " 
		WHERE guest_basket_type='" . $type . "'	AND room_name='" . $guests_name[0]['room'] . "' ORDER BY guest_basket_id DESC";

	    break;
    }
    //exit;
    //Get Guests Names
    //$guests_name = array();
    //$guests_name = get_guests_data($session->mac); //echo 'mac: ' . $guests_name; exit;

    //$menu_name = $pms_config['roomservice_name_from_pos'] ? $row1['menu_name'] : $row['service_name'];
    $sql_ary = array(
	'guest_basket_id'		=> time(),
	'guest_reservation_id'		=> (int) $guests_name[0]['resv_id'],
	'room_name'			=> (string) $guests_name[0]['room'],
	'guest_service_code'		=> (string) $code,
	'guest_service_item'		=> (string) $item_name,
	'guest_service_price'		=> (int) $item_price,
	'guest_service_qty'		=> (int) $qty,
	'guest_service_note'		=> (string) $note,
	'guest_service_guestname'	=> (string) $guests_name[0]['fullname'],
	'guest_basket_type'		=> (string) $type,
	'guest_basket_option'		=> (string) $option_name . ": " . $option_val,
	'guest_basket_datetime'		=> (int) $datetime,
    );

    $sql = 'INSERT INTO ' . GUEST_BASKETS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
    //echo $sql; exit;
    $db->sql_query($sql);		

}
// end insert item

// if delete item
if ( $mode === 'delete' )
{
    $sql = 'DELETE FROM ' . GUEST_BASKETS_TABLE . ' WHERE guest_basket_id = ' . $mid;
	//echo $sql; exit;
    $db->sql_query($sql);
    
    $mode = 'view';
}
// end delete item	

if ($mode === 'view')
{
    $sql_list = "SELECT * FROM " . GUEST_BASKETS_TABLE . " 
	WHERE guest_basket_type='" . $type . "'	AND room_name='" . $guests_name[0]['room'] . "' ORDER BY guest_basket_id DESC";
    
}

$result = $db->sql_query($sql_list);

// Generate the page
$template->set_template();
//page_header($lang_id);
page_header($lang_id, $page);

// tonjaw's here. 20150311

$total_price = 0;
$total_price_nett = 0;
$i = 0;
while($row = $db->sql_fetchrow($result))
{	
	$response = $pms->get_menu_item($row['guest_service_code']);
	if($response === TRUE) {
		$price_nett = $pms->menu_data[0]['price_nett']; 
		$price = $row['guest_service_qty'] * $price_nett; 
	} else {
		$price = $row['guest_service_qty'] * $row['guest_service_price'];
	}

	$subtotal_price = $row['guest_service_qty'] * $row['guest_service_price'];
	$total_price += $subtotal_price;
	$total_price_nett += $price;
	
    $template->assign_block_vars('somerow', array(
	'GUEST_ID'		=> $row['guest_basket_id'],
	'GUEST_QTY'		=> $row['guest_service_qty'],
	'GUEST_ITEM'		=> $row['guest_service_item'],
	//'GUEST_PRICE_ITEM'	=> number_format($row['guest_service_price']),
	'GUEST_PRICE_ITEM'	=> number_format($price),
	'GUEST_SUBTOTAL_PRICE_ITEM'	=> number_format($subtotal_price),
	'U_DELETE'		=> append_sid("{$tonjaw_root_path}basket1.$phpEx$key", "mode=delete") . '&amp;id=' . $row['guest_basket_id'] . "&amp;type=$type",
	'ICON_PATH'		=> $tonjaw_root_path . $config['imageset_path'],
	'ROOMNAME'		=> $row['room_name'],
	'COUNTER'		=> $i,
    ));
	
	$i++;
}

$data_count = $i;

$template->assign_vars(array(
    'L_GUEST_NAME'		=> $guests_name[0]['fullname'],
    'L_GUEST_ROOMNAME'	=> $guests_name[0]['room'],
    'L_CONFIRMATION'	=> $lang['confirmation'],
    'L_CLEAR_FORM'		=> $lang['clear_form'],
    'L_DELETE'			=> $lang['delete'],
    'L_QUANTITY'		=> $lang['quantity'],
    'L_ITEM_SELECTED'	=> $lang['item_selected'],
    'L_PRICE_PER_ITEM'	=> $lang['price_per_item'],
	'L_TOTAL_PRICE'		=> $lang['total_price'],
	'L_SUBTOTAL'		=> strtoupper($lang['subtotal']),
	'L_TOTAL'			=> strtoupper($lang['total']),
    'L_DELETE_ITEM'		=> $lang['delete_item'],
    'L_BASKET_ITEM'		=> $lang['basket_item'],
    'L_SPECIAL_REQUEST'	=> $lang['special_request'],
    'L_CONTINUE_SHOP'	=> $lang['continue_shop'],
    'L_CONFIRM'			=> $lang['confirm'],
    'GUEST_ROOM'		=> $guests_name[0]['resv_id'], //$row['guest_reservation_id'],
    'L_TYPE'			=> $type,
	'S_KEY'				=> $key,
	'GUEST_TOTAL_PRICE_ITEM'	=> number_format($total_price),
	'GUEST_PRICE_NETT'	=> number_format($total_price_nett),
	'S_PRICE_NETT'		=> ($total_price_nett > 0) ? 1 : 0,
	'S_CONFIRM'			=> ($data_count > 0) ? 1 : 0,
	'S_AUTOFOCUS'		=> ($data_count > 0) ? '' : 'autofocus',
	'L_PRICE_NOTE'		=> $lang['price_note'],
	'S_TOTAL_DATA'		=> $i-1,
));

$db->sql_freeresult($result);

$template->set_filenames(array(
	'body'	=> 'basket.tpl',
));

//add_log($adm_lang['read']);
page_footer();

?>
