<?php
/**
*
* index.php	: Main Menu
*
* Roberto Tonjaw. Feb 2014
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

// Include files
require($tonjaw_root_path . 'common.' . $phpEx);
require($tonjaw_root_path . 'fe_common.' . $phpEx);

//$mode	= request_var('mode', '');
//$sid 	= request_var('sid', '');

// Goto Welcome Screen if TRUE
if ( $config['go_to_welcome_screen'] && !empty($node_id) )
{
    $sql = 'SELECT node_welcome_screen FROM ' . NODES_TABLE . " WHERE node_id=$node_id" ;
    $result = $db->sql_query($sql);
    $node_welcome_screen = $db->sql_fetchfield('node_welcome_screen');
    $db->sql_freeresult($result);

    if( $node_welcome_screen != 0 )
    {
	redirect($tonjaw_root_path . 'welcome.' . $phpEx, $room_key);
    }
    
}

// Welcome Screen is in Homepage / Main Menu

$welcome_data = array();

$sql = 'SELECT t.page_translation_title, t.page_translation_content FROM ' . PAGES_TABLE . ' p, ' . 
    PAGE_TRANSLATIONS_TABLE . ' t '  . " WHERE p.page_id = t.page_id AND p.page_id = " . 
    $config['welcome_page_id'] . " AND language_id='" . $lang_id . "'";
//echo $sql; exit;
$result = $db->sql_query($sql);
$i = 0;
while ($row = $db->sql_fetchrow($result))
{
    $welcome_data[$i] = array(
	'title'		=> $row['page_translation_title'],
	'content'	=> $row['page_translation_content'],
    );
}

$db->sql_freeresult($result);
 
//print_r($welcome_data); exit;  
    
    
// Goto Last URL if TRUE
if( $config['go_to_last_url'] && !empty($node_id) )
{
    $sql = 'SELECT node_last_url FROM ' . NODES_TABLE . " WHERE node_id=$node_id" ;
    $result = $db->sql_query($sql);
    $last_url = $db->sql_fetchfield('node_last_url');
    $db->sql_freeresult($result);
    
    if( !empty($last_url) )
    {
	redirect($last_url);
    }
}

// GRAB MAIN MENU
$menus_data = array();

$sql = 'SELECT m.menu_thumbnail, m.menu_url, t.translation_title FROM ' . MENUS_TABLE . ' m, ' . 
    MENU_TRANSLATIONS_TABLE . " t WHERE m.menu_id=t.menu_id AND t.language_id='" . $lang_id . "' 
    AND menu_enabled=1 ORDER BY m.menu_order";

//echo $sql; exit;
$result = $db->sql_query($sql);

while ($row = $db->sql_fetchrow($result))
{
    $menus_data[$i] = array(
	'menu_thumbnail'=> $row['menu_thumbnail'],
	'menu_url'	=> $row['menu_url'],
	'menu_title'	=> $row['translation_title'],
    );

    $i++;
}

//print_r($menus_data); exit;

$db->sql_freeresult($result);

// Generate the page
$template->set_template();
page_header($lang_id);

foreach ($menus_data as $row)
{
    //$data = array();
    $template->assign_block_vars('menu', array(
	'S_MENU_THUMBNAIL'	=> $row['menu_thumbnail'],
	'S_MENU_URL'		=> ($room_key) ? $row['menu_url'] . '?key=' . $room_key : $row['menu_url'],
	'S_MENU_TITLE'		=> prepare_message($row['menu_title']),
    ));
}

$template->assign_vars(array(
    'L_NOTICE'			=> $lang['testing'],
    'S_MAINMENU2'		=> '1',
    'S_WELCOME_TITLE'		=> prepare_message($welcome_data[0]['title']),
    'S_WELCOME_CONTENT'		=> prepare_message($welcome_data[0]['content']),
    'T_BG_CLIP_PATH'		=> $config['vod_server'] . $config['vod_path'],
    //'T_LOG_JS_PATH'		=> $tonjaw_root_path . $config['js_path'] . 'log.js',
    ));

$template->set_filenames(array(
	'body' => 'home2.tpl',
));

//add_log($adm_lang['read']);
page_footer();

?>