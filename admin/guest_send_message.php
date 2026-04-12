<?php
/**
*
* admin/guest_send_message.php
*
* Roberto Tonjaw. Mar 2015
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


$resv_id 	= request_var('id', '');
$room_name 	= request_var('room', '');
$mode		= request_var('mode', 'list');
$guest_name 	= request_var('guest', '');
$parent 	= request_var('parent', '');
$sid 		= request_var('sid', '');
$subject = utf8_normalize_nfc(request_var('subject', ''));
$message = utf8_normalize_nfc(request_var('message', ''));
    
if( isset($_POST['btnSubmit']) && !empty($message) )
{
    $sql_ary = array(
	'guest_reservation_id'	=> 0,
	'guest_message_from'	=> (string) $config['hotel'],
	'guest_message_subject'	=> (string) $subject,
	'guest_message_content'	=> (string) $message,
	'guest_message_date'	=> (int) time(),
	//'room_name'		=> (string) $room_name,
	'guest_message_to'	=> (int) $resv_id,
    );
    
    $sql = 'INSERT INTO ' . GUEST_MESSAGES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
    echo 'SQL: ' . $sql; exit;
    $db->sql_query($sql);
    
    //exit;
    
}




$s_hidden_fields = build_hidden_fields(array(
	    'parent'	=> $parent,
	    'mode'	=> $mode,
	    'sid'	=> $sid,
	    'module'	=> $modules,
	    'id'	=> $resv_id,
	    'room_name'	=> $room_name)
	);


$u_action = '';

$template->set_template();

$template->assign_vars(array(
    'L_TITLE'		=> strtoupper($adm_lang['send_message']),
    'U_ACTION'		=> $u_action,
    'T_THEME_PATH'	=> $tonjaw_root_path . $config['theme_path'],
    'U_ROOMNAME'	=> $room_name,
    'L_TO'		=> $adm_lang['to'],
    'U_GUESTNAME'	=> $guest_name,
    'U_RESV_ID'		=> $resv_id,
    'L_SEND'		=> $adm_lang['send'],
    'L_CANCEL'		=> $adm_lang['cancel'],
    'L_SUBJECT'		=> $adm_lang['subject'],
    'L_MESSAGE'		=> $adm_lang['message'],
    'L_TO'		=> $adm_lang['to'],
    'L_GUEST2'		=> $adm_lang['guest'],
    'S_FORM_TOKEN'	=> $s_hidden_fields,
));


$template->set_filenames(array(
    'body' => 'admin_send_message.tpl',
));

page_footer();

?>
