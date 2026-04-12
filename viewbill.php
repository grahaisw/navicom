<?php
/**
*
* viewbill.php
*
* Roberto Tonjaw. Apr 2014
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
//require($tonjaw_root_path . $config['pms_path'] . 'common_pms.' . $phpEx);
/*
require($tonjaw_root_path . $config['pms_path'] . $pmsname . '.' . $phpEx);
$pms	= new $pms_api();
*/
//print_r($guests_name); exit;



// GRAB LANGUAGE
$key = request_var('key', '');

// Set background image
$guestgroup = get_guest_group($node_id);

// Generate the page
$widget_data = grab_weather_widget('Kuta');
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


// If Room Share or Group status is/are TRUE set empty bill
if( empty($guests_name[0]['group']) || empty($guests_name[0]['room_share']) )
{
	if(!isset($pms_config['url_request'])) {
		//GET GUEST BILL
		$pms->get_guest_bill($guests_name[0]['resv_id'], $guests_name[0]['room']);
		//GET MESSAGE COUNT
	   // $message_count = $pms->get_message_count($guests_name[0]['resv_id']);
		
		//if( $pms->bill_data['total_balance'] == NULL )
		/*if ( !empty($pms->bill_data['debit']) &&  !empty($pms->bill_data['credit']))
		{
		//echo 'tunggu...'; exit;
		$template->assign_vars(array(
			'S_MESSAGE'		=> $lang['viewbill_waiting_message'],
			'S_VIEWBILL_EMPTY'	=> 1,
		));
		}
		else
		{ */ 
	
		$sql = "SELECT guest_reservation_id FROM " . GUESTS_TABLE . " g
			JOIN " . ROOMS_TABLE . " r ON g.room_name = r.room_name
			JOIN " . NODES_TABLE . " n ON r.room_id = n.room_id
			WHERE n.node_ip = '".$session->ip."'";
		$result = $db->sql_query($sql);
		$guest_reservation_id = $db->sql_fetchfield('guest_reservation_id');
		
		$sql2 = "SELECT * FROM " . GUEST_BILLS_TABLE . " WHERE guest_reservation_id = " . $guest_reservation_id;
		$result2 = $db->sql_query($sql2);
		
		$i = 1;	
		$total_balance = 0;
		while ($row = $db->sql_fetchrow($result2))
		{//echo '<font color="white">'.$row['debit'].'_'.$row['credit'].'</font><br>';
			//$data = array();
			if ( !empty($row['guest_bill_date']) ) 
			{

			$template->assign_block_vars('viewbill', array(
				'S_NO'	=> $i,
				'S_DATE'	=> date($config['viewbill_dateformat'], $row['guest_bill_date']),
				'S_TITLE'	=> $row['guest_bill_description'],
				'S_PRICE'	=> (empty($row['guest_bill_credit']))? number_format($row['guest_bill_debit']) : number_format($row['guest_bill_credit']),
			));
			$balance = $row['guest_bill_debit'] + $row['guest_bill_credit'];
			$total_balance += $balance;
			$i++;
			}
		}
		
		$template->assign_vars(array(
			'L_DATE'		=> $lang['date'],
			'L_ITEM'		=> $lang['item'],
			'L_AMOUNT'		=> $lang['amount'],
			'L_TOTAL_AMOUNT'	=> $lang['total_amount'],
			'S_TOTAL_AMOUNT'	=> number_format($total_balance) . ' IDR',
			'S_VIEWBILL_EXIST'	=> 1,
			'S_WIDGET_DATE'		=> date("D. j M"),
			'S_WIDGET_CITY'		=> $widget_data['city'],
			'S_WIDGET_ICON'		=> $widget_data['icon'],
			'S_WIDGET_TEMP'		=> $widget_data['temp'],
			'S_CURRENT_TIME'	=> date("Y/n/d/H/i/s", time()),
		));
		//}
    
    }
	
}


$template->assign_vars(array(
    'L_NOTICE'		=> '',
    //'L_PAGE_TITLE'	=> $lang['view_bill'],
    'S_VIEWBILL'	=> '1',
    'S_ONMOUSEDOWN'	=> "",
    'T_BG_CLIP_PATH'	=> $config['vod_server'] . $config['vod_path'],
    'S_BGROUND_IMAGE'        => (!empty($guestgroup)) ? $guestgroup.'.jpg' : $config['bground_default'],
    'S_HOME_MENU_URL'	=> $tonjaw_root_path . 'index.php?menu=' . $config['home_menu_value'],
    'S_CURRENT_PAGE'	=> $_SERVER['QUERY_STRING'],
    'L_HOTSPOT_INFO'    => $lang['hotspot_info'],
    'L_HOTSPOT_USER'    => $lang['hotspot_user'],
    'L_HOTSPOT_PWD'    => $lang['hotspot_pwd'],
    'S_HOTSPOT_USER'    => $user,
    'S_HOTSPOT_PWD'     => $pwd,
    'S_HOTSPOT'         => $config['hotspot_in_home_screen'],
    'S_WIDGET_DATE'             => date("D. j M"),
    'S_WIDGET_CITY'             => $widget_data['city'],
    'S_WIDGET_ICON'             => $widget_data['icon'],
    'S_WIDGET_TEMP'             => $widget_data['temp'],
    'S_CURRENT_TIME'    => date("Y/n/d/H/i/s", time()),

));

$template->set_filenames(array(
	'body' => 'viewbill.tpl',
));

//add_log($adm_lang['read']);
page_footer();


?>
