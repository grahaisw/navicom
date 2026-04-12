<?php
/**
*
* basket2.php
*
* By Andes Jan 2015
* Modified by Roberto Tonjaw. Mar 2015
*/

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

$roomname = request_var('roomname', '');
$type = request_var('type', '');
$key = request_var('key', '');
$key = !trim($key)? '' : '?key=' . $key . '';
$password = strtoupper(request_var('password', ''));

$guests_name = array();
$guests_name = get_guests_data();

if ($password !== $guests_name[0]['room'])
{
	// Generate the page
    $template->set_template();
    //page_header($lang_id);
    page_header($lang_id, $page);

    $u_action = $tonjaw_root_path . 'basket2.'. $phpEx;
	
	if(empty($password)) {
		$template->assign_vars(array(
		'L_CONFIRMATION'	=> $lang['enter_password'], 
		'L_PASSWORD'		=> $lang['password'],
		'L_QUANTITY'		=> $lang['quantity'],
		'L_SPECIAL_REQUEST'	=> $lang['special_request'],
		'L_CANCEL'		=> $lang['cancel'],
		'L_CONFIRM'		=> $lang['confirm'],
		'U_ACTION'		=> $u_action,
		'S_CODE'		=> $code,
		'S_TYPE'		=> $type,
		'S_PASSWORD'	=> 1,
		'L_GUEST_ROOMNAME'	=> $guests_name[0]['room'],
		'L_TYPE'			=> $type,
		));
	} else {
	
		$template->assign_vars(array(
		'L_CONFIRMATION'	=> $lang['wrong_password'], 
		'L_PASSWORD'		=> $lang['password'],
		'L_QUANTITY'		=> $lang['quantity'],
		'L_SPECIAL_REQUEST'	=> $lang['special_request'],
		'L_CANCEL'		=> $lang['cancel'],
		'L_CONFIRM'		=> $lang['confirm'],
		'U_ACTION'		=> $u_action,
		'S_CODE'		=> $code,
		'S_TYPE'		=> $type,
		'S_PASSWORD'	=> 1,
		'L_GUEST_ROOMNAME'	=> $guests_name[0]['room'],
		'L_TYPE'			=> $type,
		));
	}
    $template->set_filenames(array(
	    'body' => 'basket2.tpl',
    ));


    //add_log($adm_lang['read']);
    page_footer();
}	


// if clear basket
if ( isset($_POST['btnClear']) ){

    $sql = 'DELETE FROM ' . GUEST_BASKETS_TABLE . " 
	WHERE room_name = '" . $roomname. "' AND guest_basket_type='" . $type . "'";
    //echo $sql; exit;
    $db->sql_query($sql);
    
    redirect($tonjaw_root_path . 'basket1.' . $phpEx . '?mode=view');
    //header('Location: basket1.php');
}
//end if clear basket

// if confirm basket

if (isset($_POST['btnSubmit']) && $password == $guests_name[0]['room']){ 

    $sql = "SELECT * FROM " . GUEST_BASKETS_TABLE . " b 
	LEFT JOIN " . SERVICES_TABLE . " s ON b.guest_service_code = s.service_code
	WHERE guest_basket_type='" . $type . "' AND room_name='" . $roomname . "'
	ORDER BY guest_basket_id DESC";
//  echo $sql; exit; 
    $result = $db->sql_query($sql);
    
    $guest_service_id = time();

    while ($row = $db->sql_fetchrow($result))
    {
	$sql_ary = array(
	    'guest_service_id'		=> (int) $guest_service_id, //$row['guest_basket_id'],
	    'guest_service_code'	=> (string) $row['guest_service_code'],
	    'guest_service_note'	=> (string) $row['guest_service_note'],
	    'guest_service_qty'		=> (int) $row['guest_service_qty'],
	    'guest_service_item' 	=> (string) $row['guest_service_item'],
	    'guest_service_price'	=> (int) $row['guest_service_price'],
	);
	
	$sql2 = 'INSERT INTO ' . GUEST_SERVICES_DETAIL_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	//echo $sql2; exit;
	$db->sql_query($sql2);		

	// Last guest_basket_id will be used as guest_service_id
	$guest_service_id = $guest_service_id;
	$resv_id = $row['guest_reservation_id'];
	$room_name = $row['room_name'];
	$guestname = $row['guest_service_guestname'];

    //$roomname = $row['room_name'];
    }

    $db->sql_freeresult($result);
    
    // Insert to master Guest Service
    
    $sql_ary = array(
	'guest_service_id'		=> (int) $guest_service_id,
	'guest_reservation_id'		=> (int) $resv_id,
	'guest_service_roomname' 	=> (string) $room_name,
	'guest_service_guestname' 	=> (string) $guestname,
	'guest_service_type'		=> (string) $type,
    );
    
    $sql = 'INSERT INTO ' . GUEST_SERVICES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	//echo $sql2; 
    $db->sql_query($sql);
    
    $sql = 'DELETE FROM ' . GUEST_BASKETS_TABLE . ' WHERE room_name = ' . "'" . $roomname . "' AND guest_basket_type='" . $type . "'";
	//echo $sql; exit;
    $db->sql_query($sql);
	
}
// end confirm basket

// Generate the page
$template->set_template();
//page_header($lang_id);
page_header($lang_id, $page);

$u_action = $tonjaw_root_path . 'basket2.'. $phpEx;

$template->assign_vars(array(
    //'L_CONFIRMATION'	=> (empty($password)) ? $lang['enter_password'] : '',
	//'L_PASSWORD'		=> $lang['password'],
	'L_MESSAGE'		=> $lang['message'],
    'L_CONTENT_MESSAGE'	=> $lang['message_success_basket'],
	'U_ACTION'		=> $u_action,
	'S_VERIFY_PASSWORD'	=> 1,
	'L_GUEST_ROOMNAME'	=> $guests_name[0]['room'],
	'L_TYPE'			=> $type,
));

$template->set_filenames(array(
    'body' => 'basket2.tpl',
));

//add_log($adm_lang['read']);
page_footer();

?>
