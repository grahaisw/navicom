<?php
/**
*
* tv_full.php
*
* Agnes Emanuella. Mar 2015
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

$tv_data = array();

$order = request_var('ch', '');
$gid = request_var('gid', '');
$gid = (!isset($gid)) ? '' : $gid;

$sql = "SELECT tv_channel_url_udp, tv_channel_url_http FROM " . TV_CHANNELS_TABLE . " WHERE tv_channel_id = " . $order;
//echo $sql; exit;
$result = $db->sql_query($sql);
$data = $db->sql_fetchfield('tv_channel_url_'.$config['tv_source_protocol']);

$db->sql_freeresult($result);

$filter = "";
if(!empty($gid)) {
	$filter = " AND g.tv_channel_group_id = ".$gid." ";
}

$sql = "SELECT c.tv_channel_id, c.tv_channel_name, c.tv_channel_thumbnail, c.tv_channel_url_udp, c.tv_channel_url_http, 		c.tv_channel_allow_ads, t.translation_title, gp.tv_channel_group_id, c.tv_channel_order  
FROM " . TV_CHANNELS_TABLE . " c 
JOIN " . TV_GROUPINGS_TABLE . " gp ON c.tv_channel_id = gp.tv_channel_id 
JOIN " . TV_GROUPS_TABLE . " g ON gp.tv_channel_group_id = g.tv_channel_group_id 
JOIN " . TV_GROUP_TRANSLATIONS_TABLE . " t ON t.tv_channel_group_id = g.tv_channel_group_id 
WHERE t.language_id= '" . $lang_id . "' AND c.tv_channel_enabled = 1 ".$filter."
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
		'order'		=> $row['tv_channel_order'],
		);

		$i++;
	}

	$temp_id = $row['tv_channel_id'];
}

$db->sql_freeresult($result);

// Generate the page
$template->set_template();
page_header($lang_id, $page);
$i = 0;
foreach ($tv_data as $row)
{
	if($row['id'] == $order) {
		$index = $i;
	}
	//$data = array();
	$template->assign_block_vars('channel', array(
		'S_ID'		=> $row['id'],
		'S_TITLE'		=> $row['name'],
		//'S_URL'	=> ($room_key) ? $row[$config['tv_source_protocol']] . '?key=' . $room_key : $row[$config['tv_source_protocol']],
		'S_URL'		=> $row[$config['tv_source_protocol']],
		'S_DESCRIPTION'	=> '', //prepare_message($row['description']),
		'S_THUMBNAIL'	=> $row['thumbnail'],
		'S_ORDER'		=> $row['order'],
	));
	
	$i++;
}

$template->assign_vars(array(
    'S_TV_CHANNEL_FULL'	=> '1',
    'S_TV_CHANNEL_SOURCE'	=> $data,
    'S_HOME_MENU_URL'		=> $tonjaw_root_path . 'index.php?menu=' . $config['home_menu_value'],
    //'T_LOG_JS_PATH'		=> $tonjaw_root_path . $config['js_path'] . 'log.js',
	'S_TV_CHANNEL_ORDER'	=> $order,
	'S_GID'					=> $gid,
	'S_TV_CHANNEL_INDEX'	=> $index,
    ));

$template->set_filenames(array(
	'body' => 'tv_channel_full.tpl',
));

//add_log($adm_lang['read']);
page_footer(true, 'tv_channel.php');


?>
