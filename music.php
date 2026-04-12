<?php
/**
*
* vod.php	: music on Demand
*
* Roberto Tonjaw. Mar 2014
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

// GRAB musicS
$music_data = array();
$existing_group  = array();
$unique_group = array();

$gid = request_var('gid', '');
$code = request_var('code', '');

if (!empty($code) ) {
    $values = array();
    $qty = request_var('qty', '');
    $item_id = request_var('item_id', '');
    $price = request_var('price', '0');
    $price = str_replace(',', '', $price);
    
    $sql = "SELECT t.translation_title AS music_title 
	FROM " . MUSIC_TABLE . " m 
	JOIN " . MUSIC_TRANSLATIONS_TABLE . " t ON t.music_id = m.music_id 
	WHERE t.language_id= '" . $config['default_language'] . "' 
	AND m.music_id= " . $item_id ;
    
    $result = $db->sql_query($sql);
    $music_title = $db->sql_fetchfield('music_title');
    
    $db->sql_freeresult($result);
    
    
    //Get Guests Names
    $guests_name = array();
    $guests_name = get_guests_data($session->mac); //echo 'mac: ' . $guests_name; exit;

    $values = array(
	'resv_id'	=> $guests_name[0]['resv_id'],
	'room_name'	=> $guests_name[0]['room'],
	'guest_name'	=> $guests_name[0]['fullname'],
	'code'		=> $code,
	'item'		=> $music_title,
	'price'		=> $price,
	'qty'		=> $qty,
    );
    
    //Send it to PMS
    //print_r($values); exit;
    require($tonjaw_root_path . $config['pms_path'] . $pmsname . '.' . $phpEx);
    $pms	= new $pms_api();
    $pms->post_charge($values);
    
    redirect('vod_full.' . $phpEx . '?ch=' . $item_id, $sid);
    
}


$filter = ($gid) ? " AND gp.music_group_id = $gid" : '';

$sql = "SELECT c.music_id, c.music_code, t.translation_title AS music_title, t.translation_description AS music_description, c.music_price, c.music_casts, c.music_director, c.music_thumbnail, c.music_url, c.music_trailer, c.music_allow_ads, tg.translation_title AS group_title 
	FROM " . MUSIC_TABLE . " c 
	JOIN " . MUSIC_TRANSLATIONS_TABLE . " t ON t.music_id = c.music_id 
	JOIN " . MUSIC_GROUPINGS_TABLE . " gp ON c.music_id = gp.music_id 
	JOIN " . MUSIC_GROUPS_TABLE . " g ON gp.music_group_id = g.music_group_id 
	JOIN " . MUSIC_GROUP_TRANSLATIONS_TABLE . " tg ON tg.music_group_id = g.music_group_id 
	WHERE t.language_id= '" . $lang_id . "' 
	AND tg.language_id= '" . $lang_id . "' AND c.music_enabled = 1 " . $filter . " 
	ORDER BY t.translation_title";

//echo $sql; exit;
$result = $db->sql_query($sql);
$i = 0;

while ($row = $db->sql_fetchrow($result))
{
    if( $row['music_id'] != $temp_id)
    {
	$music_data[$i] = array(
	    'id'		=> $row['music_id'],
	    'title'		=> $row['music_title'],
	    'thumbnail'		=> $row['music_thumbnail'],
	    'url'		=> $row['music_url'],
	    'description'	=> $row['music_description'],
	    'allow_ads'		=> $row['music_allow_ads'],
	    'price'		=> $row['music_price'],
	    'casts'		=> $row['music_casts'],
	    'director'		=> $row['music_director'],
	    'trailer'		=> $row['music_trailer'],
	    'group'		=> $row['group_title'],
	    'code'		=> $row['music_code'],
	);
	
	$i++;
    }
    
    $temp_id = $row['music_id'];
}

$db->sql_freeresult($result);

/*
// Get unique group id
$existing_group = array_sort($existing_group, 'gid');

$i = 0;
$gid_temp = '';
foreach ($existing_group as $row)
{
    if ( $row['gid'] !== $gid_temp )
    {
	$unique_group[$i]['gid'] = $row['gid'];
	$unique_group[$i]['group'] = $row['group'];
	
	$i++;
    }
    
    $gid_temp = $row['gid'];
}
*/
//print_r($music_data); exit;
//$vod_trailer = $config['vod_server'] . $config['vod_path'] . $config['trailer_path'] . '/';

// trailer for wonderful indonesia
$vod_trailer = $config['vod_server'] . $config['vod_path']. '/' . $config['music_path'] . '/';
$vod_full = $config['vod_server'] . $config['vod_path'] . '/' . $config['music_path'] . '/';

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
    //$config['tv_source_protocol'] = 'http';

}

foreach ($music_data as $row)
{
    //$data = array();
    $template->assign_block_vars('music', array(
	'S_TITLE'	=> $row['title'],
	'S_URL'		=> ($room_key) ? $row['url'] . '?key=' . $room_key : $row['url'],
	//'S_DESCRIPTION'	=> prepare_message($row['description']),
	'S_THUMBNAIL'	=> $row['thumbnail'],
	'S_TRAILER'	=> $vod_trailer . $row['url'],
	'S_FULL_MUSIC'	=> $vod_full . $row['url'],
	'S_ID'		=> $row['id'],
	'L_DIRECTOR'	=> $lang['director'],
	'S_DIRECTOR'	=> prepare_message($row['director']),
	'L_CASTS'	=> $lang['casts'],
	'S_CASTS'	=> prepare_message($row['casts']),
	'L_PRICE'	=> $lang['price'],
	'S_PRICE'	=> $row['price'],
	'L_GENRE'	=> $lang['genre'],
	'S_GENRE'	=> $row['group'],
	'L_DESCRIPTION'	=> $lang['synopsis'],
	'S_DESCRIPTION'	=> prepare_message($row['description']),
	'L_CURRENCY'	=> $config['currency'],
	'S_QTY'		=> "1",
	'S_CODE'	=> $row['code'],
    ));
}

$template->assign_vars(array(
    'L_NOTICE'			=> '',
    'S_MUSIC'			=> '1',
    'S_ONMOUSEDOWN'		=> "onmousedown='return false;'",
    'T_MEDIA_IMAGE_MUSIC_PATH'	=> $tonjaw_root_path . $config['media_path'] . $config['music_icon_path'],
    //'L_PAGE_TITLE'		=> $lang['vod'],
    'L_BUY_TO_WATCH'		=> $lang['click_to_watch'],
    'S_HOME_MENU_URL'		=> $tonjaw_root_path . 'index.php?menu=' . $config['home_menu_value'],
    //'T_LOG_JS_PATH'		=> $tonjaw_root_path . $config['js_path'] . 'log.js',
    'S_BGROUND_IMAGE'        => (!empty($guestgroup)) ? $guestgroup.'.jpg' : $config['bground_default'],
    'S_CURRENT_PAGE'           => $_SERVER['QUERY_STRING'],

    ));

$template->set_filenames(array(
	'body' => 'music.tpl',
));

//add_log($adm_lang['read']);
page_footer();


?>
