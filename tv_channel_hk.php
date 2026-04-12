<?php
/**
*
* tv_channel_hk.php
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
define('BYPASS_LOCK', true);

$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : './';
$phpEx = substr(strrchr( $_SERVER['PHP_SELF'], '.'), 1);
$file = explode('.', substr(strrchr( $_SERVER['PHP_SELF'], '/'), 1));
$page = $file[0] . '.' . $phpEx;

// Include files
require($tonjaw_root_path . 'common.' . $phpEx);
require($tonjaw_root_path . 'fe_common.' . $phpEx);

$url = $tonjaw_root_path . $page . '?' . $key;

// GRAB TV CHANNEL
$tv_data = array();
$existing_group  = array();
$unique_group = array();

$gid = request_var('gid', '');
$mode = request_var('mode', '');

//print_r($tv_data); exit;

// Get TV Promo
if(!$config['tv_promo_random']) {
    $sql = "SELECT COUNT(tv_promo_id) AS total_entries FROM " . TV_PROMO_TABLE . " WHERE tv_promo_enabled = 1 AND tv_promo_default = 1";
    
    $result = $db->sql_query($sql);
    $count = (int) $db->sql_fetchfield('total_entries');	
    $db->sql_freeresult($result);
    
    if($count > 0) 
    {
	$sql = "SELECT * FROM " . TV_PROMO_TABLE . " WHERE tv_promo_enabled = 1 AND tv_promo_default = 1";
	$result = $db->sql_query($sql);
	
	while ($row = $db->sql_fetchrow($result)) {
	    $promo = $row['tv_promo_thumbnail'];
	}
    } 
    else 
    {
	$config['tv_promo_random'] = true;
    }
} 

$promo = array();

if($config['tv_promo_random']) 
{
    $sql = "SELECT COUNT(tv_promo_id) AS total_entries FROM " . TV_PROMO_TABLE . " WHERE tv_promo_enabled = 1";
    $result = $db->sql_query($sql);
    $count = (int) $db->sql_fetchfield('total_entries');
    $db->sql_freeresult($result);

    if($count > 0) 
    {
	$sql = "SELECT * FROM " . TV_PROMO_TABLE . " WHERE tv_promo_enabled = 1";
	$result = $db->sql_query($sql);
	$promo_enabled = array();

	$i = 0;
	while ($row = $db->sql_fetchrow($result)) 
	{
	    $promo_enabled[$i]['thumbnail'] = $row['tv_promo_thumbnail'];
	    $promo_enabled[$i]['title'] = $row['tv_promo_title'];
	    $promo_enabled[$i]['description'] = $row['tv_promo_description'];

	    $i++;
	}

	$promo_rand = rand(0, $i - 1);
	//$promo_rand = array_rand(array_keys($promo_enabled));
	//echo 'promo rand: ' . $promo_rand . '<br/>';

	$promo['title'] = $promo_enabled[$promo_rand]['title'];
	$promo['thumbnail'] = $promo_enabled[$promo_rand]['thumbnail'];
	$promo['description'] = $promo_enabled[$promo_rand]['description'];

	//print_r($promo); exit;
	//print_r($promo_enabled); exit;
	$promo_enabled = true;
    } 
    else 
    {
	$promo['thumbnail'] = '';
	$promo_enabled = false;
    }
}

if($promo['thumbnail'] != '') 
{
    $promo['thumbnail'] = $tonjaw_root_path . $config['media_path'] . $config['tv_promo_path'] . $promo['thumbnail'];
} 
else 
{
    $promo['thumbnail'] = '';
}

// Generate the page first
$template->set_template();
//page_header($lang_id);
page_header($lang_id, $page);

if( $config['mobile'] )
{
    //Get Guests Names
    //$guests_name = array();
    $guest_names = '';
    generate_menus($lang_id, $room_key, $guest_names);
    $config['tv_source_protocol'] = 'http';

}

if ( !$config['tv_grouping'] || !empty($gid) )
{
    if ( !empty($gid) && $mode === 'ch' )
    {
	$filter = ($gid) ? " AND gp.tv_channel_group_id = $gid" : '';
    
    }
	/*
    $sql = "SELECT c.tv_channel_id, c.tv_channel_name, c.tv_channel_thumbnail, c.tv_channel_url_udp, c.tv_channel_url_http, 		c.tv_channel_allow_ads, t.translation_title, gp.tv_channel_group_id   
	FROM " . TV_CHANNELS_TABLE . " c 
	JOIN " . TV_GROUPINGS_TABLE . " gp ON c.tv_channel_id = gp.tv_channel_id 
	JOIN " . TV_GROUPS_TABLE . " g ON gp.tv_channel_group_id = g.tv_channel_group_id 
	JOIN " . TV_GROUP_TRANSLATIONS_TABLE . " t ON t.tv_channel_group_id = g.tv_channel_group_id 
	WHERE t.language_id= '" . $lang_id . "' AND c.tv_channel_enabled = 1 " . $filter . " 
	ORDER BY c.tv_channel_order, c.tv_channel_id";    
    */
	$sql = "SELECT c.tv_channel_id, c.tv_channel_name, c.tv_channel_thumbnail, c.tv_channel_url_udp, c.tv_channel_url_http, c.tv_channel_allow_ads, gp.tv_channel_group_id   
	FROM " . TV_CHANNELS_TABLE . " c 
	JOIN " . TV_GROUPINGS_TABLE . " gp ON c.tv_channel_id = gp.tv_channel_id 
	JOIN " . TV_GROUPS_TABLE . " g ON gp.tv_channel_group_id = g.tv_channel_group_id 
	WHERE c.tv_channel_enabled = 1 " . $filter . " 
	ORDER BY c.tv_channel_order, c.tv_channel_id";    
    
	//echo $sql; exit;
    $result = $db->sql_query($sql);
    $i = 0;

    while ($row = $db->sql_fetchrow($result))
    {
	if( $row['tv_channel_id'] != $temp_id)
	{
	    $tv_data[$i] = array(
		'id'		=> $row['tv_channel_id'],
		'name'		=> $row['tv_channel_name'],
		'thumbnail'	=> $row['tv_channel_thumbnail'],
		'http'		=> $row['tv_channel_url_http'],
		'udp'		=> $row['tv_channel_url_udp'],
		'allow_ads'	=> $row['tv_channel_allow_ads'],
	    );
    /*
	    $existing_group[$i] = array(
	    'gid'		=> $row['tv_channel_group_id'],
	    'group'		=> $row['translation_title'],
	    );
    */
	    $i++;
	}
	
	$temp_id = $row['tv_channel_id'];
    }

    $db->sql_freeresult($result);

    
    foreach ($tv_data as $row)
    {
	//$data = array();
	$template->assign_block_vars('channel', array(
	    'S_TITLE'		=> $row['name'],
	    //'S_URL'	=> ($room_key) ? $row[$config['tv_source_protocol']] . '?key=' . $room_key : $row[$config['tv_source_protocol']],
	    'S_URL'		=> $row[$config['tv_source_protocol']],
	    'S_DESCRIPTION'	=> '', //prepare_message($row['description']),
	    'S_THUMBNAIL'	=> $row['thumbnail'],
	));
    }

    foreach ($unique_group as $row)
    {
	//$data = array();
	$template->assign_block_vars('group', array(
	    'L_GROUP'	=> $row['group'],
	    'S_GROUP'	=> $tonjaw_root_path . "tv_channel.php?gid=" . $row['gid'],
	));
    }

    $template->assign_vars(array(
	'L_NOTICE'			=> '',
	'S_TV_CHANNEL'		=> '1',
	'S_ONMOUSEDOWN'		=> "onmousedown='return false;'",
	//'L_PAGE_TITLE'		=> $lang['tv_channel'],
	'S_HOME_MENU_URL'		=> $tonjaw_root_path . 'index.php?menu=' . $config['home_menu_value'],
	//'T_LOG_JS_PATH'		=> $tonjaw_root_path . $config['js_path'] . 'log.js',
	'PROMO_DISPLAY'		=> $promo_enabled, //file_exists($promo_image)? 'block' : 'none',
	'S_PROMO_IMAGE'		=> $promo['thumbnail'],
	'S_PROMO_TITLE'		=> $promo['title'],
	'S_PROMO_DESCRIPTION'	=> $promo['description'],
	'T_MEDIA_IMAGE_TV_PATH'	=> $tonjaw_root_path . $config['media_path'] . $config['tv_icon_path'], 
    ));
    
    $template->set_filenames(array(
	    'body' => 'tv_channel.tpl',
    ));

}

if ( empty($gid) && $mode !== 'ch' && $config['tv_grouping'] )
{
    //Retrieve TV GROUP
    
    $sql2 = 'SELECT g.tv_channel_group_id, g.tv_channel_group_thumbnail, t.translation_title AS group_name
	FROM ' . TV_GROUPS_TABLE . " g, " . TV_GROUP_TRANSLATIONS_TABLE . " t 
	WHERE g.tv_channel_group_id=t.tv_channel_group_id 
	AND g.tv_channel_group_enabled=1 AND t.language_id='" . $lang_id . "' 
	ORDER BY g.tv_channel_group_order, t.translation_title" ;
    //echo $sql2; exit;
    $result = $db->sql_query($sql2);
    $i = 0;

    while ($row = $db->sql_fetchrow($result))
    {
	$sql1 = 'SELECT COUNT(t.tv_channel_id) AS total_entries
		FROM ' . TV_CHANNELS_TABLE . ' t JOIN ' . TV_GROUPINGS_TABLE . ' g ON t.tv_channel_id = g.tv_channel_id 
		WHERE  g.tv_channel_group_id=' . $row['tv_channel_group_id'];
	//echo $sql1; exit;
	$result1 = $db->sql_query($sql1);
	$count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result1);

	$sql = 'SELECT t.tv_channel_id, t.tv_channel_url_http, t.tv_channel_url_udp FROM ' . TV_CHANNELS_TABLE . ' t 
	    JOIN ' . TV_GROUPINGS_TABLE . ' g ON t.tv_channel_id = g.tv_channel_id 
	    WHERE g.tv_channel_group_id=' . $row['tv_channel_group_id'];
	//echo $sql; exit;
	$result2 = $db->sql_query($sql);
	
	$a = 0;
	$source_url = array();
	
	while ($row2 = $db->sql_fetchrow($result2))
	{
	    $source_url[$a] = array(
		'http'	=> $row2['tv_channel_url_http'],
		'udp'	=> $row2['tv_channel_url_udp'],
	    );
	    
	    $a++;
	}
	$array_key = rand(0, $count-1);
	
	$db->sql_freeresult($result2);
	
	//print_r($source_url);
	//echo '<br/>key:' . $array_key; //exit;
	//echo '<br/>url:' . $source_url[$array_key]['udp']; exit;
	// Begin filling array
	
	//if ($count > 1 )
	//{
	    $group_data[$i] = array(
		'id'		=> $row['tv_channel_group_id'],
		'name'		=> $row['group_name'],
		'thumbnail'	=> $row['tv_channel_group_thumbnail'],
		'description'	=> $row['group_description'],
		'http'		=> $source_url[$array_key]['http'],
		'udp'		=> $source_url[$array_key]['udp'],
	    );
	//}

	unset($source_url);
	
	$i++;
    }
    
    //print_r($group_data); exit;

    foreach ($group_data as $row)
    {
	//$data = array();
	$template->assign_block_vars('group', array(
	    'S_ID'		=> $row['id'],
	    'S_CAT_URL'		=> $url . 'mode=ch' . '&gid=' . $row['id'],
	    'S_CAT_TITLE'	=> $row['name'],
	    'S_DESCRIPTION'	=> $row['description'],
	    'S_THUMBNAIL'	=> $row['thumbnail'],
	    'S_URL'		=> $row[$config['tv_source_protocol']],
	));
	
	//echo '<br/>url: ' . $row[$config['tv_source_protocol']];
    }
    //exit;

    $template->assign_vars(array(
	'L_NOTICE'		=> '',
	'S_TV_CHANNEL_GROUP'	=> '1',
	'S_ONMOUSEDOWN'		=> '1',
	'T_MEDIA_IMAGE_TV_PATH'	=> $tonjaw_root_path . $config['media_path'] . $config['tv_icon_path'], 
	//'L_PAGE_TITLE'	=> $lang['roomservice'],
	'S_HOME_MENU_URL'	=> $tonjaw_root_path . 'index.php?menu=' . $config['home_menu_value'],
	//'T_LOG_JS_PATH'	=> $tonjaw_root_path . $config['js_path'] . 'log.js',
	));

    $template->set_filenames(array(
	    'body' => 'tv_channel_category.tpl',
    ));

}

$db->sql_freeresult($result);

/*
$template->set_filenames(array(
	'body' => 'tv_channel.tpl',
));
*/
//add_log($adm_lang['read']);
page_footer();


?>