<?php
/**
*
* vod.php	: Movie on Demand
*
* Roberto Tonjaw. Mar 2014
*/

/**
*/
//echo "tes"; exit;
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


$vod_full = $config['vod_server'] . $config['vod_path'] . $config['movie_path'] . '/';

$id = request_var('ch', '');
//$data = array();
$sql = "SELECT movie_url FROM " . MOVIES_TABLE . " WHERE movie_id = " . $id;

//echo $sql; exit;
$result = $db->sql_query($sql);
$data = $db->sql_fetchfield('movie_url');
$db->sql_freeresult($result);
//print_r($data); exit;
//echo $vod_full . $data; exit;
// Generate the page
$template->set_template();
//page_header($lang_id);
page_header($lang_id, $page);

$template->assign_vars(array(
    'S_VOD_FULL'	=> '1',
    'S_MOVIE'		=> $vod_full . $data,
    'S_HOME_MENU_URL'		=> $tonjaw_root_path . 'index.php?menu=' . $config['home_menu_value'],
    //'T_LOG_JS_PATH'		=> $tonjaw_root_path . $config['js_path'] . 'log.js',
    ));

$template->set_filenames(array(
	'body' => 'movie_full.tpl',
));

//add_log($adm_lang['read']);
page_footer();


?>
