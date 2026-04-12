<?php
/**
*
* lock.php	: 
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

//$mode	= request_var('mode', '');
//$sid 	= request_var('sid', '');


$page = '';
// Generate the page
$template->set_template();

page_header($lang_id, $page);

$template->assign_vars(array(
    'L_TITLE'			=> prepare_message($remote_data[0]['title']),
    'S_LOCK'			=> '1',
    'S_HOME_MENU_URL'		=> $tonjaw_root_path . 'index.php?menu=' . $config['home_menu_value'],
    'T_MEDIA_IMAGE_PATH'	=> $tonjaw_root_path . $config['media_path'] . $config['image_path'],
    //'T_LOG_JS_PATH'		=> $tonjaw_root_path . $config['js_path'] . 'log.js',
    ));

$template->set_filenames(array(
	'body' => 'lock.tpl',
));

//add_log($adm_lang['read']);
page_footer(false);

?>
