<?php
/**
*
* sendmessage.php
*
* Roberto Tonjaw. Oct 2014
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

//print_r($guests_name); exit;

//echo $code_content; exit;
if( count($guests_name) > 1 && !$config['mobile'])
    {
	$guest_names = $guests_name[0]['salutation'] . ' ' . $guests_name[0]['fullname'] . ' <br/> ' . 
	    $guests_name[1]['salutation'] . ' ' . $guests_name[1]['fullname'];
    }
    elseif( count($guests_name) > 1 && $config['mobile'] )
    {
	$guest_names = '<br/>'. $guests_name[0]['salutation'] . ' ' . $guests_name[0]['fullname'];
    }
    elseif ( !empty($guests_name[0]['fullname']) )
    {
	$guest_names = '<br/>'. $guests_name[0]['salutation'] . ' ' . $guests_name[0]['fullname'];
    }
    elseif ( empty($guests_name[0]['fullname']) && !empty($guests_name[0]['lastname']))
    {
	$guest_names = '<br/>'. $guests_name[0]['salutation'] . ' ' . $guests_name[0]['lastname']. ', ' . $guests_name[0]['firstname'];
    }

$resv_id = request_var('resv_id', '');
$room_id = request_var('room_id', '');
$mode = request_var('mode', '');
$subject = utf8_normalize_nfc(request_var('subject', ''));
$message = utf8_normalize_nfc(request_var('message', ''));
$target = request_var('target', '');
$to_room_name = request_var('to_room_name', '');

if ( isset($_POST['submit']) )
{
    if ( $target === $config['code_room'] )
    {
	$sql = 'SELECT guest_reservation_id FROM ' . GUESTS_TABLE . " WHERE room_name='" . $to_room_name . "'";
	
	$result = $db->sql_query($sql);
	$to_resv_id = $db->sql_fetchfield('guest_reservation_id');
	$db->sql_freeresult($result);
    }
    else
    {
	$to_resv_id = 0;
    }
    
    
    //if( !empty($message) )
    //{
	$sql_ary = array(
	    'guest_reservation_id'	=> (int) $resv_id,
	    'guest_message_from'	=> (string) $guest_names,
	    'guest_message_subject'	=> (string) $subject,
	    'guest_message_content'	=> (string) $message,
	    'guest_message_date'	=> (int) time(),
	    'room_name'			=> (string) $guests_name[0]['room'],
	    'guest_message_to'		=> (int) $to_resv_id,
	);
    
	$sql = 'INSERT INTO ' . GUEST_MESSAGES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	//echo 'SQL: ' . $sql; exit;
	$db->sql_query($sql);

	$note = $lang['message_sent'];
	$show_success = true;
	
	//redirect($tonjaw_root_path . 'inbox.' . $phpEx);
    //}
    //else
    //{
	//$note = $lang['subject_and_message_empty'];
	//$show_form = true;
    //}
    


    
}
else
{
    $show_form = true;
    $mode = 'send';
    $subject = '';
    $message = '';
}

if ( empty($room_id) )
{
    $room_id = $guests_name[0]['room'];
}

if ( empty($resv_id) )
{
    $resv_id = $guests_name[0]['resv_id'];
}

$s_hidden_fields = build_hidden_fields(array(
    'mode'	=> $mode,
    'room_id'	=> $room_id,
    'resv_id'	=> $resv_id,
    'key'	=> $room_key)
);


// Set background image
$guestgroup = get_guest_group($node_id);

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

$template->assign_vars(array(
    'L_NOTICE'		=> '',
    'L_PAGE_TITLE'	=> $lang['send_message'],
    'S_FORM'		=> $show_form,
    'S_SUCCESS'		=> $show_success,
    'L_TO'		=> $lang['to'],
    'S_TO_ROOM'		=> $config['code_room'],
    'L_TO_ROOM'		=> $lang['room'],
    'S_TO_HOTEL'	=> $config['code_hotel'],
    'L_TO_HOTEL'	=> $lang['hotel'],
    'L_ROOM_NAME'	=>  $lang['room_no'],
    
    'S_SENDMESSAGE'	=> '1',
    'L_SUBJECT'		=> $lang['subject'],
    'L_CONTENT'		=> $lang['message'],
    'L_SUBMIT'		=> $lang['submit'],
    'S_FORM_TOKEN'	=> $s_hidden_fields,
    'U_ACTION'		=> $_SERVER['PHP_SELF'],
    'S_NOTE'		=> $note,
    'S_REDIRECT_URL'	=> $tonjaw_root_path . 'sendmessage.' . $phpEx . "?key=$room_key",
    'S_SUBJECT'		=> generate_subject('subject', $subject),
    'S_CONTENT'		=> $message,
    'S_HOME_MENU_URL'	=> $tonjaw_root_path . 'index.php?menu=' . $config['home_menu_value'],
    'S_BGROUND_IMAGE'        => (!empty($guestgroup)) ? $guestgroup.'.jpg' : $config['bground_default'],
));

$template->set_filenames(array(
	'body' => 'sendmessage.tpl',
));

//add_log($adm_lang['read']);
page_footer();



?>