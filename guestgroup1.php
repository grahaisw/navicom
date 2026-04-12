<?php
/**
*
* guestgroup.php	
*
* Agnes Emanuella. Feb 2017
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

// GRAB DIRECTORY
$group_data = array();

$sql = "SELECT guest_groups_info_id, guest_groups_info_logo, guest_groups_info_title, guest_groups_info_type
	FROM " . GUEST_GROUPS_INFO_TABLE . "
	WHERE guest_groups_info_enabled = 1 AND guest_groups_code = ".$guests_name[0]['group']."  AND guest_groups_info_type = '1'";
//echo $sql; exit;
	$result = $db->sql_query($sql);
$data = $db->sql_fetchrow($result);

$db->sql_freeresult($result);

$sql = "SELECT guest_groups_detail_content
    FROM " . GUEST_GROUPS_DETAIL_TABLE . "
    WHERE guest_groups_info_id = ".$data['guest_groups_info_id']."
    ORDER BY guest_groups_detail_order";

//echo $sql; exit;
$result = $db->sql_query($sql);
$i = 0;
$rec1 = 1;

while ($row = $db->sql_fetchrow($result))
{
    $group_data[$i] = array(
	'content'		=> $row['guest_groups_detail_content'],
    );

    $rec1 = 0;
    $i++;
}

$db->sql_freeresult($result);
//print_r($group_data); exit;

$image_path = $tonjaw_root_path . $config['media_path'] . $config['fitness_image_path'];

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

foreach ($group_data as $row)
{
	if($data['guest_groups_info_type'] == '1') {
		$content = prepare_message($row['content']);
	} else if($data['guest_groups_info_type'] == '2') {
		$content = $row['content'].'.jpg';
	}
	
    $template->assign_block_vars('group', array(
	'CONTENT'		=> prepare_message(bbcode_nl2br($content)),
	
    ));
}

$template->assign_vars(array(
    'L_NOTICE'		=> '',
    'S_GUESTGROUP'	=> '1',
    'S_ONMOUSEDOWN'	=> '',
    //'L_PAGE_TITLE'	=> $lang['directory'],
    'S_HOME_MENU_URL'		=> $tonjaw_root_path . 'index.php?menu=' . $config['home_menu_value'],
    //'T_MEDIA_IMAGE_MOVIE_PATH'	=> $tonjaw_root_path . $config['media_path'] . $config['movie_icon_path'],
    //'T_LOG_JS_PATH'		=> $tonjaw_root_path . $config['js_path'] . 'log.js',
	//'S_CONTENT'		=> prepare_message($group_data[0]['description']),
    'S_BGROUND_IMAGE'   => (!empty($guestgroup)) ? $guestgroup.'.jpg' : $config['bground_default'],
	'S_CURRENT_TIME'	=> date("Y/n/d/H/i/s", time()),
	'S_CURRENT_PAGE'    => $_SERVER['QUERY_STRING'],
	'S_TITLE'			=> $data['guest_groups_info_title'],
	'S_LOGO'			=> $data['guest_groups_info_logo'].'.jpg',
	'S_CONTENT_IMAGE'	=> ($data['guest_groups_info_type']=='2') ? 1 : 0,
	'S_CONTENT_TEXT'	=> ($data['guest_groups_info_type']=='1') ? 1 : 0,
//	'S_SHOW_RUNNINGTEXT '	=> '1',
));

$template->set_filenames(array(
	'body' => 'guestgroup.tpl',
));

//add_log($adm_lang['read']);
page_footer();


?>
