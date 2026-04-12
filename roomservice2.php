<?php
/**
*
* roomservice.php
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

// GRAB ROOM SERVICES
$service_data = array();
$group_data  = array();

$gid = request_var('gid', '');
$key = request_var('key', '');
$mode = request_var('mode', '');
$key = !trim($key)? '' : 'key=' . $key . '&';
$code = request_var('code', '');

$url = $tonjaw_root_path . 'roomservice.php?' . $key;
$service_path = $tonjaw_root_path . $config['media_path'] . $config['service_icon_path'];
$group_path = $tonjaw_root_path . $config['media_path'] . $config['service_group_icon_path'];

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

if ( $pms_config['roomservice_item_in_pos'] )
{
    // GRAB Room Service Menu from POS of PMS
    require($tonjaw_root_path . $config['pms_path'] . $pmsname . '.' . $phpEx);
    $pms	= new $pms_api();
    
    if (!empty($gid) && $mode === 'item')
    {
	$filter = ($gid) ? " AND s.service_group_id = $gid" : '';
	
	//$sql = "SELECT service_id, service_code FROM " . SERVICES_TABLE ." WHERE service_enabled = 1 " . $filter . " ORDER BY service_order";
		
	
	$sql = "SELECT s.service_id, t.translation_title AS service_name, t.translation_description AS service_description, s.service_price, s.service_thumbnail, s.service_allow_ads, tg.translation_title AS group_name, g.service_group_thumbnail AS group_thumbnail, s.service_code, g.service_group_clip AS group_clip, s.service_currency
	    FROM " . SERVICES_TABLE . " s 
	    JOIN " . SERVICE_TRANSLATIONS_TABLE . " t ON t.service_id = s.service_id 
	    JOIN " . SERVICE_GROUPS_TABLE . " g ON g.service_group_id = s.service_group_id 
	    JOIN " . SERVICE_GROUP_TRANSLATIONS_TABLE . " tg ON tg.service_group_id = g.service_group_id 
	    WHERE t.language_id= '" . $lang_id . "' 
	    AND tg.language_id= '" . $lang_id . "' AND s.service_enabled = 1 " . $filter . " 
	    ORDER BY s.service_order, t.translation_title LIMIT 10";
	//echo $sql; exit;
	$result = $db->sql_query($sql);
	
	$i = 0;
	$rec1 = 1;
	$menu_match = 0;
	$a = '';
	while ($row = $db->sql_fetchrow($result))
	{ 	
		$response = $pms->get_menu_item($row['service_code']);
		
	    //if($response) {
		if($pms->menu_data['menu_match'] == 1) {
			
			foreach ($pms->menu_data as $row1)
			{	
			
			$menu_name = $pms_config['roomservice_name_from_pos'] ? $row1['menu_name'] : $row['service_name'];
			$cat_name = $pms_config['roomservice_name_from_pos'] ? $row1['category_name'] : $row['group_name'];
			//$menu_thumbnail = $pms_config['roomservice_name_from_pos'] ? $row1['menu_id'] : $row['service_thumbnail'];
			$menu_description = $pms_config['roomservice_name_from_pos'] ? $row1['description'] : $row['service_description'];
			$menu_price = $pms_config['roomservice_name_from_pos'] ? $row1['price'] : $row['service_price'];
			$menu_code = $pms_config['roomservice_name_from_pos'] ? $row1['menu_id'] : $row['service_code'];
			//$menu_group_thumbnail = $pms_config['roomservice_name_from_pos'] ? $row1['category_id'] : $row['group_thumbnail'];
			$menu_currency = $pms_config['roomservice_name_from_pos'] ? $row1['currency'] : $row['service_currency'];
			
			$service_data[$i] = array(
			  'rec1'		=> $rec1,
			  'id'			=> $row['service_id'],
			  'code'		=> $menu_code,
			  'name'		=> $menu_name,
			  'thumbnail'		=> $row['service_thumbnail'],
			  'description'		=> $menu_description,
			  'allow_ads'		=> $row['service_allow_ads'],
			  'price'		=> $menu_price,
			  'group_name'		=> $cat_name,
			  'group_thumbnail'	=> $row['group_thumbnail'],
			  'group_clip'		=> $row['group_clip'],
			  'currency'		=> $menu_currency,
			);
			
			$menu_match++;
			
			}
			$rec1 = 0;
			$i++;
			
		} /*else {
			$service_data[$i] = array(
			  'rec1'		=> $rec1,
			  'id'			=> $row['service_id'],
			  'code'		=> $row['service_code'],
			  'name'		=> $row['service_name'],
			  'thumbnail'		=> $row['service_thumbnail'],
			  'description'		=> $row['service_description'],
			  'allow_ads'		=> $row['service_allow_ads'],
			  'price'		=> $row['service_price'],
			  'group_name'		=> $row['group_name'],
			  'group_thumbnail'	=> $row['group_thumbnail'],
			  'group_clip'		=> $row['group_clip'],
			  'currency'		=> $row['service_currency'],
			);

			$rec1 = 0;
			$i++;
		}*/
		
	}
	//print_r($service_data); exit;
	foreach ($service_data as $row)
	{
	    $thumbnail_path = $tonjaw_root_path.$config['media_path'].$config['image_path'].'fnb/600x400/'.$row['thumbnail'].'.jpg';
	   	if(!file_exists($thumbnail_path)) {
	   		$thumbnail = $config['default_thumbnail_roomservice'];
	   	} else {
	   		$thumbnail = $row['thumbnail'];
	   	}

		$template->assign_block_vars('roomservice', array(
		    'REC1'			=> $row['rec1'],
		    'S_TITLE'			=> $row['name'],
		    'S_PICTURE'			=> $thumbnail,
		    'S_DESCRIPTION'		=> $row['description'],
		    //'S_URL'			=> ($key) ? $row[$config['tv_source_protocol']] . '?key=' . $room_key : $row[$config['tv_source_protocol']],
		    'S_CATEGORY'		=> $row['group_name'],
		    'S_CATEGORY_THUMBNAIL'	=> $row['group_thumbnail'],
		    'S_PRICE'			=> number_format($row['price']), //prepare_message($row['description']),
		    'S_THUMBNAIL'		=> $thumbnail,
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
	    'S_ROOMSERVICE'			=> '1',
	    'S_ONMOUSEDOWN'			=> "",
	    'T_MEDIA_IMAGE_FNB_PATH'		=> $service_path,
	    'T_MEDIA_IMAGE_FNB_CAT_PATH'	=> $group_path,
	    'L_CALL_TO_ORDER'			=> ($pms->menu_data['menu_match'] > 0) ? $lang['click_to_order'] : $lang['call_to_order'],
	    'L_PRICE'				=> $lang['price'],
	    'L_CURRENCY'			=> $config['currency'],
	    'L_PAGE_TITLE'			=> empty($service_data[0]['group_name']) ? '' : $service_data[0]['group_name'],
	    'S_GRADIENT_THUMBNAIL'		=> $service_data[0]['group_thumbnail'],
	    'S_GROUP_CLIP'			=> $service_data[0]['group_clip'],
	    'S_MENU_EXIST'		=> ($pms->menu_data['menu_match'] > 0) ? 1 : 0,
	    //'T_LOG_JS_PATH'			=> $tonjaw_root_path . $config['js_path'] . 'log.js',
	    'S_BGROUND_IMAGE'        => (!empty($guestgroup)) ? $guestgroup.'.jpg' : $config['bground_default'],
	));

	$template->set_filenames(array(
	    'body' => 'roomservice.tpl',
	));
	
    
    }


}
else
{ // $pms_config['roomservice_item_in_pos']

    // Retrieve Service Item from IPTV DB

    if (!empty($gid) && $mode === 'item')
    {
	$filter = ($gid) ? " AND s.service_group_id = $gid" : '';

	$sql = "SELECT s.service_id, t.translation_title AS service_name, t.translation_description AS service_description, s.service_price, s.service_thumbnail, s.service_allow_ads, tg.translation_title AS group_name, g.service_group_thumbnail AS group_thumbnail, s.service_code, g.service_group_clip AS group_clip, s.service_currency
	    FROM " . SERVICES_TABLE . " s 
	    JOIN " . SERVICE_TRANSLATIONS_TABLE . " t ON t.service_id = s.service_id 
	    JOIN " . SERVICE_GROUPS_TABLE . " g ON g.service_group_id = s.service_group_id 
	    JOIN " . SERVICE_GROUP_TRANSLATIONS_TABLE . " tg ON tg.service_group_id = g.service_group_id 
	    WHERE t.language_id= '" . $lang_id . "' 
	    AND tg.language_id= '" . $lang_id . "' AND s.service_enabled = 1 " . $filter . " 
	    ORDER BY s.service_order, t.translation_title";

	//echo $sql; exit;
	$result = $db->sql_query($sql);
	$i = 0;
	$rec1 = 1;

	while ($row = $db->sql_fetchrow($result))
	{
	    $service_data[$i] = array(
	      'rec1'		=> $rec1,
	      'id'		=> $row['service_id'],
	      'code'		=> $row['service_code'],
	      'name'		=> $row['service_name'],
	      'thumbnail'	=> $row['service_thumbnail'],
	      'description'	=> $row['service_description'],
	      'allow_ads'	=> $row['service_allow_ads'],
	      'price'		=> $row['service_price'],
	      'group_name'	=> $row['group_name'],
	      'group_thumbnail'	=> $row['group_thumbnail'],
	      'group_clip'	=> $row['group_clip'],
		  'currency'	=> $row['service_currency'],
	    );
	
	    $rec1 = 0;
	    $i++;
	}
	
	//print_r($service_data); exit;
	
	foreach ($service_data as $row)
	{
	    $thumbnail_path = $tonjaw_root_path.$config['media_path'].$config['image_path'].'fnb/600x400/'.$row['thumbnail'].'.jpg';
	   	if(!file_exists($thumbnail_path)) {
	   		$thumbnail = $config['default_thumbnail_roomservice'];
	   	} else {
	   		$thumbnail = $row['thumbnail'];
	   	}
	   	
	    $template->assign_block_vars('roomservice', array(
		'REC1'			=> $row['rec1'],
		'S_TITLE'		=> $row['name'],
		'S_PICTURE'		=> $row['thumbnail'],
		'S_DESCRIPTION'		=> $row['description'],
		//'S_URL'			=> ($key) ? $row[$config['tv_source_protocol']] . '?key=' . $room_key : $row[$config['tv_source_protocol']],
		'S_CATEGORY'		=> $row['group_name'],
		'S_CATEGORY_THUMBNAIL'	=> $row['group_thumbnail'],
		'S_PRICE'			=> number_format($row['price']), //prepare_message($row['description']),
		'S_THUMBNAIL'		=> (!empty($row['thumbnail'])) ? $row['thumbnail'] : $config['default_thumbnail_roomservice'],
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
	    'S_ROOMSERVICE'		=> '1',
	    'S_ONMOUSEDOWN'		=> "",
	    'T_MEDIA_IMAGE_FNB_PATH'	=> $service_path,
	    'T_MEDIA_IMAGE_FNB_CAT_PATH'=> $group_path,
	    'L_CALL_TO_ORDER'		=> ($pms->menu_data['menu_match'] > 0) ? $lang['click_to_order'] : $lang['call_to_order'],
	    'L_PRICE'			=> $lang['price'],
	    'L_CURRENCY'		=> $config['currency'],
	    'L_PAGE_TITLE'		=> $service_data[0]['group_name'].'_'.print_r($service_data),
	    'S_GRADIENT_THUMBNAIL'	=> $service_data[0]['group_thumbnail'],
	    'S_GROUP_CLIP'		=> $service_data[0]['group_clip'],
	    'S_MENU_EXIST'		=> ($pms->menu_data['menu_match'] > 0) ? 1 : 0,
	    //'T_LOG_JS_PATH'		=> $tonjaw_root_path . $config['js_path'] . 'log.js',
	    'S_BGROUND_IMAGE'        => (!empty($guestgroup)) ? $guestgroup.'.jpg' : $config['bground_default'],
	    ));

	$template->set_filenames(array(
		'body' => 'roomservice.tpl',
	));
	
    }

} // end of $pms_config['roomservice_item_in_pos']



if ( empty($gid) && $mode !== 'item' )
{
    //Retrieve Room Service Category
    
    $sql2 = 'SELECT g.service_group_id, g.service_group_thumbnail, g.service_group_clip, t.translation_title AS group_name,
	t.translation_description AS group_description 
	FROM ' . SERVICE_GROUPS_TABLE . " g, " . SERVICE_GROUP_TRANSLATIONS_TABLE . " t 
	WHERE g.service_group_id=t.service_group_id 
	AND g.service_group_enabled=1 AND t.language_id='" . $lang_id . "'" ;
    //echo $sql; exit;
    $result = $db->sql_query($sql2);
    $i = 0;

    while ($row = $db->sql_fetchrow($result))
    {
	$group_data[$i] = array(
	    'id'		=> $row['service_group_id'],
	    'name'		=> $row['group_name'],
	    'thumbnail'		=> $row['service_group_thumbnail'],
	    'description'	=> $row['group_description'],
	    'clip'		=> $row['service_group_clip'],
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
	'S_ROOMSERVICE_CATEGORY'	=> '1',
	'S_ONMOUSEDOWN'			=> '1',
	'T_MEDIA_IMAGE_FNB_PATH'	=> $group_path,
	//'L_PAGE_TITLE'			=> $lang['roomservice'],
	'S_HOME_MENU_URL'		=> $tonjaw_root_path . 'index.php?menu=' . $config['home_menu_value'],
	//'T_LOG_JS_PATH'		=> $tonjaw_root_path . $config['js_path'] . 'log.js',
	'S_BGROUND_IMAGE'        => (!empty($guestgroup)) ? $guestgroup.'.jpg' : $config['bground_default'],
	));

    $template->set_filenames(array(
	    'body' => 'roomservice_category.tpl',
    ));

}

$db->sql_freeresult($result);

//add_log($adm_lang['read']);
page_footer();

?>
