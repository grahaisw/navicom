<?php
/**
*
* spa.php
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

// GRAB SPAS
$spa_data = array();
$group_data  = array();

$gid = request_var('gid', '');
$key = request_var('key', '');
$mode = request_var('mode', '');
$key = !trim($key)? '' : 'key=' . $key . '&';
$code = request_var('code', '');

/*
if (!empty($code) ) {
    //echo 'code: ' . $code . '. Ready to send to pms about the order! '; exit;
    
    $values = array();
    $qty = request_var('qty', '');
    $item_id = request_var('item_id', '');
    $price = request_var('price', '0');
    $price = str_replace(',', '', $price);
    $note = utf8_normalize_nfc(request_var('note', ''));
    
    $sql = "SELECT t.translation_title AS service_name 
	FROM " . SERVICES_TABLE . " s 
	JOIN " . SERVICE_TRANSLATIONS_TABLE . " t ON t.service_id = s.service_id 
	WHERE t.language_id= '" . $config['default_language'] . "' 
	AND s.service_id= " . $item_id ;
    
    $result = $db->sql_query($sql);
    $service_name = utf8_normalize_nfc($db->sql_fetchfield('service_name'));
    
    $db->sql_freeresult($result);
    
    
    //Get Guests Names
    $guests_name = array();
    $guests_name = get_guests_data($session->mac); //echo 'mac: ' . $guests_name; exit;

    $values = array(
	'resv_id'	=> $guests_name[0]['resv_id'],
	'room_name'	=> $guests_name[0]['room'],
	'guest_name'	=> $guests_name[0]['fullname'],
	'code'		=> $code,
	'item'		=> $service_name,
	'price'		=> $price,
	'qty'		=> $qty,
    );
    
    //Send it to PMS ** MOVED TO roomservice_buffer in CMS **
    //print_r($values); exit;
    //
    //require($tonjaw_root_path . $config['pms_path'] . $pmsname . '.' . $phpEx);
    //$pms	= new $pms_api();
    //$pms->post_charge($values);
    //
    
    if ( $pms_config['local_saved_roomservice_order'] )
    {
	 $sql_ary = array(
	    'guest_service_id'		=> time(),
	    'guest_reservation_id'	=> $guests_name[0]['resv_id'],
	    'guest_service_roomname'	=> $guests_name[0]['room'],
	    'guest_service_guestname'	=> utf8_normalize_nfc($guests_name[0]['fullname']),
	    'guest_service_code'	=> (string) $code,
	    'guest_service_item'	=> (string) $service_name,
	    'guest_service_price'	=> (int) $price,
	    'guest_service_qty'		=> (int) $qty,
	    'guest_service_note'	=> (string) $note,
	);

	// Add new record 
	$sql = 'INSERT INTO ' . GUEST_SERVICES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	//echo $sql; exit;
	$db->sql_query($sql);
	
    }
    
}
*/

$url = $tonjaw_root_path . 'spa.php?' . $key;
$spa_path = $tonjaw_root_path . $config['media_path'] . $config['spa_icon_path'];
$group_path = $tonjaw_root_path . $config['media_path'] . $config['spa_group_icon_path'];

// Set background image
$guestgroup = get_guest_group($node_id);

// Generate the page
$template->set_template();
//page_header($lang_id);
page_header($lang_id, $page);

if( $config['mobile'] )
{
    //Get Guests Names
    //$guests_name = array();
    $guest_names = '';
    generate_menus($lang_id, $room_key, $guest_names);

}

if ( $pms_config['spa_item_in_pos'] )
{


}
else
{ // $pms_config['spa_item_in_pos']

    if ( !$config['spa_grouping'] || !empty($gid) )
    {
	if ( !empty($gid) && $mode === 'item' )
	{
	    $filter = ($gid) ? " AND s.spa_group_id = $gid" : '';
	}

        // Retrieve Spa Item from IPTV DB

	$sql = "SELECT s.spa_id, t.translation_title AS spa_name, t.translation_description AS spa_description, s.spa_price, s.spa_thumbnail, s.spa_allow_ads, tg.translation_title AS group_name, g.spa_group_thumbnail AS group_thumbnail, s.spa_code, g.spa_group_clip AS group_clip, s.spa_clip AS spa_clip, s.spa_currency
	    FROM " . SPAS_TABLE . " s 
	    JOIN " . SPA_TRANSLATIONS_TABLE . " t ON t.spa_id = s.spa_id 
	    JOIN " . SPA_GROUPS_TABLE . " g ON g.spa_group_id = s.spa_group_id 
	    JOIN " . SPA_GROUP_TRANSLATIONS_TABLE . " tg ON tg.spa_group_id = g.spa_group_id 
	    WHERE t.language_id= '" . $lang_id . "' 
	    AND tg.language_id= '" . $lang_id . "' AND s.spa_enabled = 1 " . $filter . " 
	    ORDER BY s.spa_order, t.translation_title";

	//echo $sql; exit;
	$result = $db->sql_query($sql);
	$i = 0;
	$rec1 = 1;

	while ($row = $db->sql_fetchrow($result))
	{
	    $spa_data[$i] = array(
	      'rec1'		=> $rec1,
	      'id'		=> $row['spa_id'],
	      'code'		=> $row['spa_code'],
	      'name'		=> $row['spa_name'],
	      'thumbnail'	=> $row['spa_thumbnail'],
	      'description'	=> $row['spa_description'],
	      'allow_ads'	=> $row['spa_allow_ads'],
	      'price'		=> $row['spa_price'],
	      'group_name'	=> $row['group_name'],
	      'group_thumbnail'	=> $row['group_thumbnail'],
	      'clip'		=> $row['spa_clip'],
	      'group_clip'	=> $row['group_clip'],
		  'currency'	=> $row['spa_currency'],
	    );
	
	    $rec1 = 0;
	    $i++;
	}
	
	//print_r($spa_data); exit;
	
	foreach ($spa_data as $row)
	{
	    //$data = array();
	    $template->assign_block_vars('spa', array(
		'REC1'			=> $row['rec1'],
		'S_TITLE'		=> $row['name'],
		'S_PICTURE'		=> $row['thumbnail'],
		'S_DESCRIPTION'		=> $row['description'],
		//'S_URL'			=> ($key) ? $row[$config['tv_source_protocol']] . '?key=' . $room_key : $row[$config['tv_source_protocol']],
		'S_CATEGORY'		=> $row['group_name'],
		'S_CATEGORY_THUMBNAIL'	=> $row['group_thumbnail'],
		'S_PRICE'			=> number_format($row['price']), //prepare_message($row['description']),
		'S_THUMBNAIL'		=> $row['thumbnail'],
		'S_CODE'		=> $row['code'],
		'S_QTY'			=> '1',
		'L_CURRENCY'		=> $row['currency'],
		'L_PRICE'		=> $lang['price'],
		'S_SERVICE_ID'		=> $row['id'],
		'S_GID'			=> $gid,
		'S_MODE'		=> $mode,
		'S_SPA_CLIP'		=> $row['clip'],
		'S_KEY'				=> $key,
	    ));
	}
	
	$template->assign_vars(array(
	    'L_NOTICE'				=> '',
	    'S_SPA'				=> '1',
	    'S_ONMOUSEDOWN'			=> "",
	    'T_MEDIA_IMAGE_SPA_PATH'		=> $spa_path,
	    'T_MEDIA_IMAGE_SPA_CAT_PATH'	=> $group_path,
	    'L_CALL_TO_ORDER'			=> $lang['click_for_booking'],
	    'L_PRICE'				=> $lang['price'],
	    'L_CURRENCY'			=> $config['currency'],
	    //'L_PAGE_TITLE'			=> $spa_data[0]['group_name'],
	    'S_GRADIENT_THUMBNAIL'		=> $spa_data[0]['group_thumbnail'],
	    //'T_LOG_JS_PATH'		=> $tonjaw_root_path . $config['js_path'] . 'log.js',
	    'S_GROUP_CLIP'			=> $row['group_clip'],
	    'S_BGROUND_IMAGE'        => (!empty($guestgroup)) ? $guestgroup.'.jpg' : $config['bground_default'],
	    ));
	    
	if ( !empty($gid) )
	{
	    $template->assign_vars(array(
		'L_PAGE_TITLE'			=> $spa_data[0]['group_name'],
	    ));
	}

	$template->set_filenames(array(
		'body' => 'spa.tpl',
	));
	
    }


} // end of $pms_config['roomservice_item_in_pos']



if ( empty($gid) && $mode !== 'item' && $config['spa_grouping'] )
{
    //Retrieve Spa Category
    
    $sql2 = 'SELECT g.spa_group_id, g.spa_group_thumbnail, g.spa_group_clip, t.translation_title AS group_name,
	t.translation_description AS group_description 
	FROM ' . SPA_GROUPS_TABLE . " g, " . SPA_GROUP_TRANSLATIONS_TABLE . " t 
	WHERE g.spa_group_id=t.spa_group_id 
	AND g.spa_group_enabled=1 AND t.language_id='" . $lang_id . "'" ;
    //echo $sql; exit;
    $result = $db->sql_query($sql2);
    $i = 0;

    while ($row = $db->sql_fetchrow($result))
    {
	$group_data[$i] = array(
	    'id'		=> $row['spa_group_id'],
	    'name'		=> $row['group_name'],
	    'thumbnail'		=> $row['spa_group_thumbnail'],
	    'description'	=> $row['group_description'],
	    'clip'		=> $row['spa_group_clip'],
	);
	    
	$i++;
    }

    foreach ($group_data as $row)
    {
	//$data = array();
	$template->assign_block_vars('category', array(
	    'S_ID'		=> $row['id'],
	    'S_CAT_URL'		=> $url . 'mode=item' . '&gid=' . $row['id'],
	    'S_CAT_TITLE'	=> $row['name'],
	    'S_DESCRIPTION'	=> $row['description'],
	    'S_THUMBNAIL'	=> $row['thumbnail'],
	    'S_SPA_CLIP'	=> $row['clip'],
	));
    }

    $template->assign_vars(array(
	'L_NOTICE'			=> '',
	'S_SPA_CATEGORY'		=> '1',
	'S_ONMOUSEDOWN'			=> '1',
	'T_MEDIA_IMAGE_SPA_PATH'	=> $group_path,
	//'L_PAGE_TITLE'			=> prepare_message(get_page_title($page, $lang_id)), //$lang['spa'],
	'S_HOME_MENU_URL'		=> $tonjaw_root_path . 'index.php?menu=' . $config['home_menu_value'],
	//'T_LOG_JS_PATH'		=> $tonjaw_root_path . $config['js_path'] . 'log.js',
	'S_BGROUND_IMAGE'        => (!empty($guestgroup)) ? $guestgroup.'.jpg' : $config['bground_default'],
	));

    $template->set_filenames(array(
	    'body' => 'spa_category.tpl',
    ));

}

$db->sql_freeresult($result);

//add_log($adm_lang['read']);
page_footer();

?>