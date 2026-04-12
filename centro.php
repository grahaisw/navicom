<?php
/**
*
* centro.php
*
* Roberto Tonjaw. Dec 2014
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
require($tonjaw_root_path . $config['qrcode_path'] . 'qrlib.' . $phpEx);

//print_r($guests_name); exit;
$centro_id	= request_var('id', '');

//echo $code_content; exit;

// Generate the page
$template->set_template();
//page_header($lang_id);
page_header($lang_id, $page);

$template->assign_vars(array(
    'L_NOTICE'		=> '',
    //'L_PAGE_TITLE'	=> $lang['directory'],
    'S_CUSTOM_PAGE'	=> '1',
    'S_ONMOUSEDOWN'	=> "",
    'U_IMAGE_PAGE'	=> $centro_id,
    'S_HOME_MENU_URL'	=> $tonjaw_root_path . 'index.php?menu=' . $config['home_menu_value'],
));

$template->set_filenames(array(
	'body' => 'centro.tpl',
));

//add_log($adm_lang['read']);
page_footer();


?>