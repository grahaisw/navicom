<?php
/**
*
* flight.php	
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

// GRAB FLIGHT SCHEDULE
$flight_data = array();

$aid = request_var('aid', '');
$key = request_var('key', '');
$type = request_var('type', '1');
$key = !trim($key)? '' : 'key=' . $key . '&';

if ( empty($aid) )
{
    $sql = 'SELECT COUNT(airport_id) AS total_entries
		FROM ' . AIRPORTS_TABLE . ' WHERE airport_enabled=1';
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $airports_count = (int) $db->sql_fetchfield('total_entries');
    $db->sql_freeresult($result);
    
    if ( $airports_count == 1 )
    {
	$sql = 'SELECT airport_id FROM ' . AIRPORTS_TABLE . ' WHERE airport_enabled=1';
	$result = $db->sql_query($sql);
	$aid = $db->sql_fetchfield('airport_id');
	$db->sql_freeresult($result);
    }
  
}

// Generate the page
$template->set_template();
//page_header($lang_id);
page_header($lang_id, $page);

if ( !empty($aid) || $airports_count == 1 ) {
    
    $sql = 'SELECT airport_code, airport_name FROM ' . AIRPORTS_TABLE . ' WHERE airport_id=' .$aid;
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result))
    {
	$airport_code = $row['airport_code'];
	$airport_name = $row['airport_name'];
    }
    
    $db->sql_freeresult($result);
    
    //echo $airport_code . '--'. $airport_name; exit;
    $sql ='SELECT * FROM ' . AIRPORT_FIDS_TABLE . ' WHERE fids_type=' . $type . 'AND airport_id=' . $aid;;
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    
    $i = 0;

    while ($row = $db->sql_fetchrow($result))
    {
	$fids_lastupdate = $row['fids_lastupdate'];

	$flight_data[$i] = array(
	    'flight'		=> $row['fids_flight'],
	    'airline_code'	=> $row['fids_airline_code'],
	    'airline'		=> $row['fids_airline'],
	    'city'		=> $row['fids_city'],
	    'time'		=> $row['fids_time'],
	    'terminal'		=> $row['fids_terminal'],
	    'gate'		=> $row['fids_gate'],
	    'type'		=> $row['fids_type'],
	    'remark'		=> $row['fids_remark'],
	);
    
	$i++;
    }
    
    //echo 'type:'.$type; exit;
    //print_r($flight_data); exit;

    switch( $type )
    {
	case $config['fids_departure_code']:
	    $label = $lang['departure'];
	    $label_icon = $config['fids_departure_icon'];
	    $toggle = $lang['arrival'];
	    $toggle_type = $config['fids_arrival_code'];
	    $toggle_icon = $config['fids_arrival_icon'];
	    $city = $lang['destination'];
	    
	    break;
	
	case $config['fids_arrival_code']:
	    $label = $lang['arrival'];
	    $label_icon = $config['fids_arrival_icon'];
	    $toggle = $lang['departure'];
	    $toggle_type = $config['fids_departure_code'];
	    $toggle_icon = $config['fids_departure_icon'];
	    $city = $lang['origin'];
	    
	    break;
    }
    
    //echo 'label:'.$label; exit;
    $query_mb= "SELECT  background_music_url from background_music where background_music_enabled = 1";
 $hasil = $db->sql_query($query_mb);
 $roww = $db->sql_fetchrow($hasil);
 $test = $roww['background_music_url'];
 $daniel = $config['vod_server'] . '/vod/music_backgrounds/'. $test .'';
    
    foreach ($flight_data as $row)
    {
	//$data = array();
	$template->assign_block_vars('flight', array(
	    'S_AIRLINE'			=> $row['airline'],
	    'S_FLIGHT'			=> $row['flight'],
	    'S_ORIGIN_DESTINATION'	=> $row['city'],
	    'S_SCHEDULE'		=> $row['time'],
	    'S_TERMINAL'		=> $row['terminal'],
	    'S_GATE'			=> $row['gate'],
	    'S_REMARK'			=> $row['remark'],
	    'S_TOGGLE_TYPE'		=> $toggle_type,
	));
    }
    
    
    $template->assign_vars(array(
	'L_PAGE_TITLE'		=> $airport_name . " ($airport_code)",
	'L_SUBTITLE'		=> strtoupper($label),
	'L_AIRLINE'		=> $lang['airline'],
	'L_FLIGHT'		=> $lang['flight'],
	'L_ORIGIN_DESTINATION'	=> $city,
	'L_SCHEDULE'		=> $lang['schedule'],
	'L_TERMINAL'		=> $lang['terminal'],
	'L_GATE'		=> $lang['gate'],
	'L_REMARK'		=> $lang['remark'],
	'L_ARRIVAL_DEPARTURE_ICON' => $label_icon,
	'L_TOGGLE'		=> $toggle,
	'L_TOGGLE_ICON'		=> $toggle_icon,
	'S_URL'			=> $tonjaw_root_path . 'flight.' . $phpEx . 
				      "?key=$room_key" .
				      "&aid=" . $aid .
				      "&type=" . $toggle_type,
	'S_LASTUPDATE'		=> date($config['log_dateformat'], $fids_lastupdate),
	'L_LASTUPDATE'		=> $lang['last_update'],
	'L_SOURCE'		=> $lang['source'],
	'S_SOURCE'		=> $config['fids_source'],
	'S_FIDS'		=> '1',
	'S_MB'               => $daniel,
    ));
    
    $db->sql_freeresult($result);
}


if ( $airports_count > 1 )
{
    $sql = 'SELECT airport_id, airport_code, airport_name FROM ' . AIRPORTS_TABLE . ' WHERE airport_enabled=1';
    $result = $db->sql_query($sql);
    
    $airport_data = array();
    $i = 0;

    while ($row = $db->sql_fetchrow($result))
    {
	$airport_data[$i] = array(
	    'id'	=> $row['airport_id'],
	    'code'	=> $row['airport_code'],
	    'name'	=> $row['airport_name'],
	);
    
	$i++;
    }
    
    foreach ($airport_data as $row)
    {
	//$data = array();
	$template->assign_block_vars('airport', array(
	    'S_AIRPORT_CODE'	=> $row['code'],
	    'S_AIRPORT_NAME'	=> $row['name'],
	    'S_URL'		=> $tonjaw_root_path . 'flight.' . $phpEx . 
		"?key=$room_key" .
		"&aid=" . $row['id'],
	));
    }
    
    $template->assign_vars(array(
	//'L_PAGE_TITLE'		=> $lang['flight_schedule'],
	'L_SUBTITLE'		=> $lang['select_airport'],
	'S_SELECT'		=> '1',
    ));
    
    $db->sql_freeresult($result);
	
	
}



$template->assign_vars(array(
    'L_NOTICE'			=> '',
    'S_FLIGHT'			=> '1',
    'S_ONMOUSEDOWN'		=> '',
    'S_HOME_MENU_URL'		=> $tonjaw_root_path . 'index.php?menu=' . $config['home_menu_value'],
    //'L_PAGE_TITLE'		=> $lang['flight_schedule'],
));

$template->set_filenames(array(
	'body' => 'flight.tpl',
));

//add_log($adm_lang['read']);
page_footer();


?>