<?php
/**
*
* fe_common.php
*
* By Roberto Tonjaw. Feb 2014
*/

/**
*/

require($tonjaw_root_path . $config['language_path'] . $config['default_language'] . '.' . $phpEx);

// SELECT STYLE
//cek schedules
$today = time();
$sql = 'SELECT style_id FROM ' . STYLE_SCHEDULES_TABLE . " 
    WHERE style_schedule_start < $today AND style_schedule_end > $today AND style_schedule_enabled=1";
$result = $db->sql_query($sql);
$style_id = $db->sql_fetchfield('style_id');
$db->sql_freeresult($result);

//echo 'style_id: ' . $sql. $style_id; exit;

//get style
if(!empty($style_id))
{
    $sql = 'SELECT style_name FROM ' . STYLES_TABLE . " WHERE style_id = $style_id AND style_admin = 0";
}
else
{
    $sql = 'SELECT style_name FROM ' . STYLES_TABLE . " WHERE style_active = 1 AND style_admin = 0";
}

$result = $db->sql_query($sql);
$style_name = $db->sql_fetchfield('style_name');
$db->sql_freeresult($result);

if(empty($style_name)) 
{ 
    $style_name = $config['default_style'];
    //die('No style is active!'); 
}

if(!file_exists($tonjaw_root_path . $config['style_path'] . $style_name))
{
    die($lang['Error_unavailable_style']); 
}

// Authenticate Room Key
$room_key = request_var('key', '');


if( !empty($room_key) )
{
    $sql = 'SELECT room_name FROM ' . ROOMS_TABLE . " 
	    WHERE room_key='" . $room_key . "'";
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $room_name = $db->sql_fetchfield('room_name');
    $db->sql_freeresult($result);
	//print_r($data);
    if( !empty($room_name) )
    {
	$style_name = $config['mobile_style'];
	$config['mobile'] = true;
    }
    
   /* echo 'style: ' . $style_name; exit;
    $config['theme_path'] = $config['style_path'] . $style_name . '/css';
    $config['template_path'] = $config['style_path'] . $style_name ;
    $config['imageset_path'] = $config['style_path'] . $style_name . '/imageset';
    */
}

//$config['mobile'] = true;
//$style_name = $config['mobile_style'];

$config['template_path'] = $config['style_path'] . $style_name . '/template';
$config['theme_path'] = $config['style_path'] . $style_name . '/theme';
$config['imageset_path'] = $config['style_path'] . $style_name . '/imageset';



/*
echo 'style: ' . $style_name . '<br>';
echo 'today: ' . $today . '<br>';
echo 'today: ' . gmdate('m-d-Y - h:i:sa',$today) . '<br>';
echo 'template: ' . $config['template_path'] . '<br>';
echo 'theme: ' . $config['theme_path'] . '<br>';
echo 'imageset: ' . $config['imageset_path'] . '<br>';
*/
$session->session_begin($file[0]);

//Authenticate
//$browser = trim(substr($session->browser, 0, 149));


//echo 'crot: ' . $room_key . '<br>';
$room_id = '';
$lang_id = '';
$node_id = '';
$auth = authenticate_room($room_id, $room_key, $lang_id, $node_id);

$sql = "SELECT room_name FROM ".ROOMS_TABLE." WHERE room_id = ".$room_id."";
$result = $db->sql_query($sql);
$room_name = $db->sql_fetchfield('room_name');
$db->sql_freeresult($result);

$guests_name = get_guests_data();

//print_r($guests_name); exit;

if ( empty(trim($guests_name[0]['resv_id'])) && $config['lock_on_empty_room'] )
{
    $lock = request_var('lock',0);
    
    if(empty($lock))
    {
	redirect('lock.'.$phpEx . '?lock=1');
    }
    
}

//echo '<div style="color:yellow;margin:50px;">Lang: '.$lang_id.'</div>';
//require($tonjaw_root_path . $config['language_path'] . $lang_id . '.' . $phpEx);

/*$sql = 'UPDATE ' . GUESTS_TABLE . " SET guest_language='" . $lang_id ."'
	  WHERE guest_reservation_id = ".$guests_name[0]['resv_id']."";
$db->sql_query($sql);
*/

//echo 'room key: ' . $room_key; exit;
//require($tonjaw_root_path . $config['language_path'] . $lang_id . '.' . $phpEx);
require($tonjaw_root_path . $config['language_path'] . $lang_id . '.' . $phpEx);

//echo prepare_message($lang['Error_invalid_room_key']);

if($auth)
{
 //echo 'fe_common: jalan ndul...' . $lang_id . "<p>$node_id<p>"; 
 //exit; 
}

?>
