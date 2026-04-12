<?php
/**
*
* admin/logdetail.php
*
* Roberto Tonjaw. Jan 2014
*/

/**
*/

define('IN_TONJAW', true);
define('IN_ADMIN', true);
define('NEED_SID', true);

$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : './../';
$phpEx = substr(strrchr( $_SERVER['PHP_SELF'], '.'), 1);
$file = explode('.', substr(strrchr( $_SERVER['PHP_SELF'], '/'), 1));

// Include files
require($tonjaw_root_path . 'common.' . $phpEx);
$tonjaw_admin_path = $tonjaw_root_path . $config['admin_path'];
require($tonjaw_admin_path . 'common_adm.' . $phpEx);

$template->set_template();

// This page depends on its parent and cannot be displayed alone
if (!isset($_GET['parent']) && !isset($_GET['sid']) && !isset($_GET['id']) && !isset($_GET['module']))
{
    //echo 'parent: ' . $_GET['parent']; exit;
    die('Hacking Attempt');
}

//$session->session_begin($file[0]);
$sql = 'SELECT * FROM ' . LOGS_TABLE . " WHERE log_time = '" . $db->sql_escape($_GET['id']) . "'";

$result = $db->sql_query($sql);
$data = $db->sql_fetchrow($result);
$db->sql_freeresult($result);

mini_page_header($_GET['module']);

$template->assign_vars(array(
    'L_TIME'		=> $adm_lang['time'],
    'V_TIME'		=> date($config['log_dateformat'], $data['log_time']),
    'L_MAC'		=> $adm_lang['mac'],
    'V_MAC'		=> $data['log_mac'],
    'L_USER'		=> $adm_lang['username'],
    'V_USER'		=> $data['log_user'],
    'L_MODULE'		=> $adm_lang['module'],
    'V_MODULE'		=> $data['log_module'],
    'L_ACTION'		=> $adm_lang['action'],
    'V_ACTION'		=> $data['log_action'],
    'L_DATA'		=> $adm_lang['data'],
    'V_DATA'		=> $data['log_data'],
    'L_BROWSER'		=> $adm_lang['browser'],
    'V_BROWSER'		=> $data['log_browser'],
 ));

$template->set_filenames(array(
	'body' => 'admin_logview.tpl',
));

page_footer();



?>