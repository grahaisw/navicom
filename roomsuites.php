<?php
/**
*
* roomsuites.php	
*
* Agnes Emanuella. Jun 2015
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
$directory_data = array();

//$filter = ($gid) ? " AND gp.movie_group_id = $gid" : '';

$sql = "SELECT d.roomsuites_image, d.roomsuites_image_enabled, d.roomsuites_clip, d.roomsuites_clip_enabled, 
	t.translation_title AS title, t.translation_description AS description  
    FROM " . ROOMSUITES_TABLE . " d 
    JOIN " . ROOMSUITE_TRANSLATIONS_TABLE . " t ON t.roomsuites_id = d.roomsuites_id 
    WHERE t.language_id= '" . $lang_id . "' AND d.roomsuites_enabled = 1  
    ORDER BY d.roomsuites_order";

//echo $sql; exit;
$result = $db->sql_query($sql);
$i = 0;
$rec1 = 1;

while ($row = $db->sql_fetchrow($result))
{
    $directory_data[$i] = array(
	'rec1'			=> $rec1,
	'image'			=> $row['roomsuites_image'],
	'image_enable'	=> $row['roomsuites_image_enabled'],
	'clip'			=> $row['roomsuites_clip'],
	'clip_enable'	=> $row['roomsuites_clip_enabled'],
	'title'			=> $row['title'],
	'description'	=> $row['description'],
	
    );

    $rec1 = 0;
    $i++;
}

$db->sql_freeresult($result);
//print_r($directory_data); exit;

$image_path = $tonjaw_root_path . $config['media_path'] . $config['fitness_image_path'];

// Set background image
$guestgroup = get_guest_group($node_id);

// Generate the page
$widget_data = grab_weather_widget('Kuta');
$template->set_template();
/*
//Get Guests Names
$guests_name = array();
$guest_names = '';
generate_menus($lang_id, $room_key, $guest_names, $guests_name);
*/
//page_header($lang_id);
page_header($lang_id, $page);

if( $config['mobile'] )
{
    //Get Guests Names
    //$guests_name = array();
    $guest_names = '';
    generate_menus($lang_id, $room_key, $guest_names);

}

foreach ($directory_data as $row)
{
    //$data = array();
    $template->assign_block_vars('directory', array(
	//'REC1'			=> $row['rec1'],
	'S_TITLE'		=> prepare_message($row['title']),
	'S_CONTENT'		=> prepare_message($row['description']),
	'S_TITLE_THUMBNAIL'	=> $row['image'] . '.jpg',
	'S_IMAGE'		=> $row['image'] . '.jpg',
    ));
}
/*
foreach ($unique_group as $row)
{
    //$data = array();
    $template->assign_block_vars('group', array(
	'L_GROUP'	=> $row['group'],
	'S_GROUP'	=> $tonjaw_root_path . "tv_channel.php?gid=" . $row['gid'],
    ));
}
*/
$template->assign_vars(array(
    'L_NOTICE'		=> '',
    'S_ROOMSUITES'	=> '1',
    'S_ONMOUSEDOWN'	=> '',
    //'L_PAGE_TITLE'	=> $lang['directory'],
    'S_HOME_MENU_URL'		=> $tonjaw_root_path . 'index.php?menu=' . $config['home_menu_value'],
    //'T_MEDIA_IMAGE_MOVIE_PATH'	=> $tonjaw_root_path . $config['media_path'] . $config['movie_icon_path'],
    //'T_LOG_JS_PATH'		=> $tonjaw_root_path . $config['js_path'] . 'log.js',
	//'S_CONTENT'		=> prepare_message($directory_data[0]['description']),
    'S_BGROUND_IMAGE'        => (!empty($guestgroup)) ? $guestgroup.'.jpg' : $config['bground_default'],
	'S_WIDGET_DATE'		=> date("D. j M"),
	'S_WIDGET_CITY'		=> $widget_data['city'],
	'S_WIDGET_ICON'		=> $widget_data['icon'],
	'S_WIDGET_TEMP'		=> $widget_data['temp'],
	'S_CURRENT_TIME'	=> date("Y/n/d/H/i/s", time()),
	 'S_CURRENT_PAGE'    => $_SERVER['QUERY_STRING'],
));

$template->set_filenames(array(
	'body' => 'roomsuites.tpl',
));

//add_log($adm_lang['read']);
page_footer();


?>
