<?php
/**
*
* shop.php
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

// GRAB ROOM SERVICES
$shop_data = array();
$group_data  = array();

$gid = request_var('gid', '');
$key = request_var('key', '');
$mode = request_var('mode', '');
$key = !trim($key)? '' : 'key=' . $key . '&';
$code = request_var('code', '');

$url = $tonjaw_root_path . 'shop.php?' . $key;
$shop_path = $tonjaw_root_path . $config['media_path'] . $config['shop_icon_path'];
$group_path = $tonjaw_root_path . $config['media_path'] . $config['shop_group_icon_path'];

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

if ( $pms_config['shop_item_in_pos'] )
{
    // GRAB Shop from POS of PMS
    require($tonjaw_root_path . $config['pms_path'] . $pmsname . '.' . $phpEx);
    $pms	= new $pms_api();
    
    if (!empty($gid) && $mode === 'item')
    {
	$filter = ($gid) ? " AND s.shop_group_id = $gid" : '';
	
	$sql = "SELECT s.shop_id, t.translation_title AS shop_name, t.translation_description AS shop_description, s.shop_price, s.shop_thumbnail, s.shop_allow_ads, tg.translation_title AS group_name, g.shop_group_thumbnail AS group_thumbnail, s.shop_code, g.shop_group_clip AS group_clip, s.shop_currency 
	    FROM " . SHOPS_TABLE . " s 
	    JOIN " . SHOP_TRANSLATIONS_TABLE . " t ON t.shop_id = s.shop_id 
	    JOIN " . SHOP_GROUPS_TABLE . " g ON g.shop_group_id = s.shop_group_id 
	    JOIN " . SHOP_GROUP_TRANSLATIONS_TABLE . " tg ON tg.shop_group_id = g.shop_group_id 
	    WHERE t.language_id= '" . $lang_id . "' 
	    AND tg.language_id= '" . $lang_id . "' AND s.shop_enabled = 1 " . $filter . " 
	    ORDER BY s.shop_order, t.translation_title";

	$result = $db->sql_query($sql);

	$i = 0;
	$rec1 = 1;
	
	while ($row = $db->sql_fetchrow($result))
	{
	    $pms->get_menu_item($row['shop_code']);
	    
	    foreach ($pms->menu_data as $row1)
	    {
		$shop_name = $pms_config['shop_name_from_pos'] ? $row1['menu_name'] : $row['shop_name'];
		$cat_name = $pms_config['shop_name_from_pos'] ? $row1['category_name'] : $row['group_name'];
	    
		$shop_data[$i] = array(
		  'rec1'		=> $rec1,
		  'id'			=> $row['shop_id'],
		  'code'		=> $row1['shop_code'],
		  'name'		=> $shop_name,
		  'thumbnail'		=> $row1['shop_id'],
		  'description'		=> $row1['description'],
		  'allow_ads'		=> $row['shop_allow_ads'],
		  'price'		=> $row1['price'],
		  'group_name'		=> $cat_name,
		  'group_thumbnail'	=> $row1['category_id'],
		  'group_clip'		=> $row['group_clip'],
		  'currency'	=> $row['shop_currency'],
		);
	
	    }
	    $rec1 = 0;
	    $i++;

	}
	
	foreach ($shop_data as $row)
	{
	    //$data = array();
		$template->assign_block_vars('shop', array(
		    'REC1'			=> $row['rec1'],
		    'S_TITLE'			=> $row['name'],
		    'S_PICTURE'			=> $row['thumbnail'],
		    'S_DESCRIPTION'		=> $row['description'],
		    //'S_URL'			=> ($key) ? $row[$config['tv_source_protocol']] . '?key=' . $room_key : $row[$config['tv_source_protocol']],
		    'S_CATEGORY'		=> $row['group_name'],
		    'S_CATEGORY_THUMBNAIL'	=> $row['group_thumbnail'],
		    'S_PRICE'			=> number_format($row['price']), //prepare_message($row['description']),
		    'S_THUMBNAIL'		=> $row['thumbnail'],
		    'S_CODE'			=> $row['code'],
		    'S_QTY'			=> '1',
		    'L_CURRENCY'		=> $row['currency'],
		    'L_PRICE'			=> $lang['price'],
		    'S_SERVICE_ID'		=> $row['id'],
		    'S_GID'			=> $gid,
		    'S_MODE'			=> $mode,
			'S_KEY'				=> $key,
		));
	
	}
	
	$template->assign_vars(array(
	    'L_NOTICE'				=> '',
	    'S_SHOP'				=> '1',
	    'S_ONMOUSEDOWN'			=> "",
	    'T_MEDIA_IMAGE_SHOP_PATH'		=> $shop_path,
	    'T_MEDIA_IMAGE_SHOP_CAT_PATH'	=> $group_path,
	    'L_CALL_TO_ORDER'			=> $lang['call_to_order'],
	    'L_PRICE'				=> $lang['price'],
	    'L_CURRENCY'			=> $config['currency'],
	    'L_PAGE_TITLE'			=> $shop_data[0]['group_name'],
	    'S_GRADIENT_THUMBNAIL'		=> $shop_data[0]['group_thumbnail'],
	    'S_GROUP_CLIP'			=> $shop_data[0]['group_clip'],
	    //'T_LOG_JS_PATH'			=> $tonjaw_root_path . $config['js_path'] . 'log.js',
	    'S_BGROUND_IMAGE'        => (!empty($guestgroup)) ? $guestgroup.'.jpg' : $config['bground_default'],
	));

	$template->set_filenames(array(
	    'body' => 'shop.tpl',
	));
	
    
    }


}
else
{ // $pms_config['roomservice_item_in_pos']

    // Retrieve Service Item from IPTV DB

    if (!empty($gid) && $mode === 'item')
    {
	$filter = ($gid) ? " AND s.shop_group_id = $gid" : '';

	$sql = "SELECT s.shop_id, t.translation_title AS shop_name, t.translation_description AS shop_description, s.shop_price, s.shop_thumbnail, s.shop_allow_ads, tg.translation_title AS group_name, g.shop_group_thumbnail AS group_thumbnail, s.shop_code, g.shop_group_clip AS group_clip, s.shop_currency  
	    FROM " . SHOPS_TABLE . " s 
	    JOIN " . SHOP_TRANSLATIONS_TABLE . " t ON t.shop_id = s.shop_id 
	    JOIN " . SHOP_GROUPS_TABLE . " g ON g.shop_group_id = s.shop_group_id 
	    JOIN " . SHOP_GROUP_TRANSLATIONS_TABLE . " tg ON tg.shop_group_id = g.shop_group_id 
	    WHERE t.language_id= '" . $lang_id . "' 
	    AND tg.language_id= '" . $lang_id . "' AND s.shop_enabled = 1 " . $filter . " 
	    ORDER BY s.shop_order, t.translation_title";

	//echo $sql; exit;
	$result = $db->sql_query($sql);
	$i = 0;
	$rec1 = 1;

	while ($row = $db->sql_fetchrow($result))
	{
	    $shop_data[$i] = array(
	      'rec1'		=> $rec1,
	      'id'		=> $row['shop_id'],
	      'code'		=> $row['shop_code'],
	      'name'		=> $row['shop_name'],
	      'thumbnail'	=> $row['shop_thumbnail'],
	      'description'	=> $row['shop_description'],
	      'allow_ads'	=> $row['shop_allow_ads'],
	      'price'		=> $row['shop_price'],
	      'group_name'	=> $row['group_name'],
	      'group_thumbnail'	=> $row['group_thumbnail'],
	      'group_clip'	=> $row['group_clip'],
		  'currency'	=> $row['shop_currency'],
	    );
	
	    $rec1 = 0;
	    $i++;
	}
	
	//print_r($shop_data); exit;
	
	foreach ($shop_data as $row)
	{
	    //$data = array();
	    $template->assign_block_vars('shop', array(
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
		'S_KEY'				=> $key,
	    ));
	}

	$template->assign_vars(array(
	    'L_NOTICE'			=> '',
	    'S_SHOP'		=> '1',
	    'S_ONMOUSEDOWN'		=> "",
	    'T_MEDIA_IMAGE_SHOP_PATH'	=> $shop_path,
	    'T_MEDIA_IMAGE_SHOP_CAT_PATH'=> $group_path,
	    'L_CALL_TO_ORDER'		=> $lang['click_to_order'],
	    'L_PRICE'			=> $lang['price'],
	    'L_CURRENCY'		=> $config['currency'],
	    'L_PAGE_TITLE'		=> $shop_data[0]['group_name'],
	    'S_GRADIENT_THUMBNAIL'	=> $shop_data[0]['group_thumbnail'],
	    'S_GROUP_CLIP'		=> $shop_data[0]['group_clip'],
	    //'T_LOG_JS_PATH'		=> $tonjaw_root_path . $config['js_path'] . 'log.js',
	    'S_BGROUND_IMAGE'        => (!empty($guestgroup)) ? $guestgroup.'.jpg' : $config['bground_default'],
	    ));

	$template->set_filenames(array(
		'body' => 'shop.tpl',
	));
	
    }


} // end of $pms_config['roomservice_item_in_pos']



if ( empty($gid) && $mode !== 'item' )
{
    //Retrieve Shop Category
    
    $sql2 = 'SELECT g.shop_group_id, g.shop_group_thumbnail, g.shop_group_clip, t.translation_title AS group_name,
	t.translation_description AS group_description 
	FROM ' . SHOP_GROUPS_TABLE . " g, " . SHOP_GROUP_TRANSLATIONS_TABLE . " t 
	WHERE g.shop_group_id=t.shop_group_id 
	AND g.shop_group_enabled=1 AND t.language_id='" . $lang_id . "'" ;
    //echo $sql; exit;
    $result = $db->sql_query($sql2);
    $i = 0;

    while ($row = $db->sql_fetchrow($result))
    {
	$group_data[$i] = array(
	    'id'		=> $row['shop_group_id'],
	    'name'		=> $row['group_name'],
	    'thumbnail'		=> $row['shop_group_thumbnail'],
	    'description'	=> $row['group_description'],
	    'clip'		=> $row['shop_group_clip'],
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
	    'S_CLIP'		=> $row['clip'],
	));
    }

    $template->assign_vars(array(
	'L_NOTICE'			=> '',
	'S_SHOP_CATEGORY'		=> '1',
	'S_ONMOUSEDOWN'			=> '1',
	'T_MEDIA_IMAGE_SHOP_PATH'	=> $group_path,
	//'L_PAGE_TITLE'		=> $lang['roomservice'],
	'S_HOME_MENU_URL'		=> $tonjaw_root_path . 'index.php?menu=' . $config['home_menu_value'],
	//'T_LOG_JS_PATH'		=> $tonjaw_root_path . $config['js_path'] . 'log.js',
	'S_BGROUND_IMAGE'        => (!empty($guestgroup)) ? $guestgroup.'.jpg' : $config['bground_default'],
	));

    $template->set_filenames(array(
	    'body' => 'shop_category.tpl',
    ));

}

$db->sql_freeresult($result);

//add_log($adm_lang['read']);
page_footer();

?>