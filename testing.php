<?php
/*
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

$item_id = request_var('item_id', '');
$price = request_var('price', '0');
$price = str_replace(',', '', $price);
$note = utf8_normalize_nfc(request_var('note', ''));
$code = request_var('code', '0');
$gid = request_var('gid', '');
$mode = request_var('mode', '');


$sql_ary = array(
	    'testing_no'	=> $item_id,
	    'testing_name'	=> $price . '::' . $code,
	);

 $sql = 'INSERT INTO _testing ' . $db->sql_build_array('INSERT', $sql_ary);

$db->sql_query($sql);

*/


/**
*
* admin/pms.php
*
* Roberto Tonjaw. May 2014
*/

/**
*/
define('IN_TONJAW', true);
define('IN_ADMIN', true);
define('NEED_SID', true);

$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : './';
$phpEx = substr(strrchr( $_SERVER['PHP_SELF'], '.'), 1);
$file = explode('.', substr(strrchr( $_SERVER['PHP_SELF'], '/'), 1));

// Include files
require($tonjaw_root_path . 'common.' . $phpEx);
$tonjaw_admin_path = $tonjaw_root_path . $config['admin_path'];
require($tonjaw_admin_path . 'common_adm.' . $phpEx);

//$session->session_begin($file[0]);

require($tonjaw_root_path . $config['include_path'] . 'functions_module.' . $phpEx);
require($tonjaw_root_path . $config['pms_path'] . $pmsname . '.' . $phpEx);

// Instantiate new module
$module = new p_master();
$pms	= new $pms_api();

$sync = $pms->pms_sync();
//$pms_info = $pms->get_pms_info();



?>