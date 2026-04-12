<?php
/**
*
* telephone_directory.php 
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

// GRAB DIRECTORY
$directory_data = array();

//$filter = ($gid) ? " AND gp.movie_group_id = $gid" : '';

$sql = "SELECT d.directory_image, d.directory_image_enabled, d.directory_clip, d.directory_clip_enabled, 
    t.translation_title AS title, t.translation_description AS description  
    FROM " . DIRECTORIES_TABLE . " d 
    JOIN " . DIRECTORY_TRANSLATIONS_TABLE . " t ON t.directory_id = d.directory_id 
    WHERE t.language_id= '" . $lang_id . "' AND d.directory_enabled = 1  
    ORDER BY d.directory_order";

//echo $sql; exit;
$result = $db->sql_query($sql);
$i = 0;
$rec1 = 1;

while ($row = $db->sql_fetchrow($result))
{
    $directory_data[$i] = array(
    'rec1'          => $rec1,
    'image'         => $row['directory_image'],
    'image_enable'      => $row['directory_image_enable'],
    'clip'          => $row['directory_clip'],
    'clip_enable'       => $row['directory_clip_enable'],
    'title'         => $row['title'],
    'description'       => $row['description'],
    
    );

    $rec1 = 0;
    $i++;
}

$db->sql_freeresult($result);
//print_r($directory_data); exit;

$image_path = $tonjaw_root_path . $config['media_path'] . $config['directory_image_path'];
// Generate the page
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
    //'REC1'            => $row['rec1'],
    'S_TITLE'       => prepare_message($row['title']),
    'S_CONTENT'     => prepare_message($row['description']),
    'S_TITLE_THUMBNAIL' => $row['image'] . '.jpg',
    'S_IMAGE'       => $row['image'] . '.jpg',
    ));
}
/*
foreach ($unique_group as $row)
{
    //$data = array();
    $template->assign_block_vars('group', array(
    'L_GROUP'   => $row['group'],
    'S_GROUP'   => $tonjaw_root_path . "tv_channel.php?gid=" . $row['gid'],
    ));
}
*/
$template->assign_vars(array(
    'L_NOTICE'      => '',
    'S_DIRECTORY'   => '1',
    'S_ONMOUSEDOWN' => '',
    //'L_PAGE_TITLE'    => $lang['directory'],
    'S_HOME_MENU_URL'       => $tonjaw_root_path . 'index.php?menu=' . $config['home_menu_value'],
    //'T_MEDIA_IMAGE_MOVIE_PATH'    => $tonjaw_root_path . $config['media_path'] . $config['movie_icon_path'],
    //'T_LOG_JS_PATH'       => $tonjaw_root_path . $config['js_path'] . 'log.js',
));

$template->set_filenames(array(
    'body' => 'directory.tpl',
));

//add_log($adm_lang['read']);
page_footer();


?>