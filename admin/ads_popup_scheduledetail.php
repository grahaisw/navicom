<?php

/**
 *
 * admin/adsdetail.php
 *
 * Agnes Emanuella. Jul 2014
 */
/**
 */
define('IN_TONJAW', true);
define('IN_ADMIN', true);
define('NEED_SID', true);

$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : './../';
$phpEx = substr(strrchr($_SERVER['PHP_SELF'], '.'), 1);
$file = explode('.', substr(strrchr($_SERVER['PHP_SELF'], '/'), 1));

// Include files
require($tonjaw_root_path . 'common.' . $phpEx);
$tonjaw_admin_path = $tonjaw_root_path . $config['admin_path'];
require($tonjaw_admin_path . 'common_adm.' . $phpEx);

$parent = request_var('parent', '');
$mode = request_var('mode', '');
$sid = request_var('sid', '');
$modules = request_var('module', '');
$rid = request_var('id', '');
$time = request_var('time', '');

$session->session_begin($parent);

require($tonjaw_root_path . $config['include_path'] . 'functions_module.' . $phpEx);

// Instantiate new module
$module = new p_master();

$template->set_template();

// Instantiate module system and generate list of available modules
$module->list_modules($parent);

//Generate detail menu of the selected module
$module->list_modules_detail($parent, $module->p_id);

// Assign data to the template engine for the list of modules
// We do this before loading the active module for correct menu display in trigger_error
$module->assign_tpl_vars(append_sid("{$tonjaw_admin_path}index.$phpEx"));

//$flag_file    = '0';
$error = '';
$error_msg = '';
$node_data = array();
$group_data = array();
$zone_data = array();
$data_channel = array();

if($mode == 'add') {
    $u_action = $tonjaw_admin_path . 'ads_popup_scheduledetail.' . $phpEx . '?sid=' . $sid;
} else if($mode == 'update') {
    $u_action = $tonjaw_admin_path . 'ads_popup_scheduledetail.' . $phpEx . '?sid=' . $sid . '&id=' . $rid;
}
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode)) {
    die('Hacking Attempt');
}
// print_r($u_action);die();
// Preparing data


$data_popup = array();
$popup_count = 0;
//$param = $_GET['time'];


$start = view_popup($data_popup, $popup_count, $time);
if (isset($_GET['note'])) {
    $note = utf8_normalize_nfc(request_var('note', ''));
}
if (isset($_POST['submit'])) {

    // $zid = array();
    // $zid = (isset($_REQUEST['zone_id'])) ? request_var('zone_id', array('0')) : array(); 
    // Preparing UPDATE ROOM TABLE
    $timess = utf8_normalize_nfc(request_var('time', ''));
    $start = utf8_normalize_nfc(request_var('start', ''));
    $end = utf8_normalize_nfc(request_var('end', ''));
    $popup = request_var('ads_popup_id', '');
    $duration = utf8_normalize_nfc(request_var('duration', ''));
    $zone = array();
    $zone = (isset($_REQUEST['zone_id'])) ? request_var('zone_id', array('0')) : array();
    // $zone = request_var('zone_id', '');
    $channel = array();
    $channel = (isset($_REQUEST['tv_channel_id'])) ? request_var('tv_channel_id', array('0')) : array();
    $tanggalstart = explode('/', $start);
    $times = explode(':', $timess);
    $tglstart = mktime($times[0], $times[1], 0, $tanggalstart[1], $tanggalstart[2], $tanggalstart[0]);
    $tanggalend = explode('/', $end);
    $tglend = mktime($times[0], $times[1], 0, $tanggalend[1], $tanggalend[2], $tanggalend[0]);

    if ($mode == 'add') {
		$insert = true;
        $cektime = "SELECT * FROM " . ADS_POPUP_SCHEDULES_TABLE . " WHERE ads_popup_param ='$time' AND ((ads_popup_schedule_start <= ".$tglstart." AND ads_popup_schedule_end >= ".$tglstart.") OR (ads_popup_schedule_start <= ".$tglend." AND ads_popup_schedule_end >= ".$tglend.") OR (ads_popup_schedule_start >= ".$tglstart." AND ads_popup_schedule_end <= ".$tglend.")) ";
        
		$oktime = $db->sql_query($cektime);
        while($fish = $db->sql_fetchrow($oktime)) {
			$idpopup = $fish['ads_popup_schedule_id'];
			$tglawal = $fish['ads_popup_schedule_start'];
			$tglakhir = $fish['ads_popup_schedule_end'];
			
			//if (($tglstart >= $tglawal && $tglstart <= $tglakhir) || ($tglend >= $tglawal && $tglend <= $tglakhir)) { 
			if (($tglstart <= $tglawal && $tglend >= $tglakhir) || ($tglstart >= $tglawal && $tglstart <= $tglakhir) || ($tglend >= $tglawal && $tglend <= $tglakhir)) { 
				$cekzone = "SELECT * FROM " . ADS_ZONE_GROUPINGS_TABLE . " g JOIN " . ADS_POPUP_SCHEDULES_TABLE . " p ON g.ads_popup_schedule_id = p.ads_popup_schedule_id WHERE g.ads_popup_param ='$time' AND ((ads_popup_schedule_start <= ".$tglstart." AND ads_popup_schedule_end >= ".$tglstart.") OR (ads_popup_schedule_start <= ".$tglend." AND ads_popup_schedule_end >= ".$tglend.") OR (ads_popup_schedule_start >= ".$tglstart." AND ads_popup_schedule_end <= ".$tglend.")) ";
				
                $okzone = $db->sql_query($cekzone);
				$zone_data = array();
				while ($filletzone = $db->sql_fetchrow($okzone)) {
					$zone_data[] = $filletzone['zone_id'];
				}
				
				$db->sql_freeresult($okzone);
				
				foreach($zone as $zone_item) { 
					if(in_array($zone_item, $zone_data)) { //echo "a"; exit;
						$cekchannel = "SELECT * FROM " . ADS_CHANNEL_GROUPINGS_TABLE . " c RIGHT JOIN " . ADS_ZONE_GROUPINGS_TABLE . " z ON c.ads_popup_schedule_id = z.ads_popup_schedule_id JOIN " . ADS_POPUP_SCHEDULES_TABLE . " p ON z.ads_popup_schedule_id = p.ads_popup_schedule_id WHERE c.ads_popup_param = '".$time."' AND zone_id = '".$zone_item."' AND ((ads_popup_schedule_start <= ".$tglstart." AND ads_popup_schedule_end >= ".$tglstart.") OR (ads_popup_schedule_start <= ".$tglend." AND ads_popup_schedule_end >= ".$tglend.") OR (ads_popup_schedule_start >= ".$tglstart." AND ads_popup_schedule_end <= ".$tglend."))";
						
						$okchannel = $db->sql_query($cekchannel);
						$channel_data = array();
						while ($filletchannel = $db->sql_fetchrow($okchannel)) {
							$channel_data[] = $filletchannel['tv_channel_id'];
						}
						
						$db->sql_freeresult($okchannel);
				
						foreach($channel as $channel_item) {
							if(in_array($channel_item, $channel_data)) { 
								$insert = false;
								break 3;
							} else {
								$insert = true;
							}
						}
					} else { //echo "c"; exit;
						$insert = true;
					}
				}
			} else {  //echo 'b'; exit;
				$insert = true;
			}
		}
		//exit;
		if($insert) {
			// ads_popup_schedule
			$sql_ary3 = array(
				'ads_popup_schedule_duration' 	=> $duration,
				'ads_popup_schedule_enabled' 	=> 1,
				'ads_popup_id' 					=> $popup,
				'ads_popup_schedule_start' 		=> $tglstart,
				'ads_popup_schedule_end' 		=> $tglend,
				'ads_popup_param' 				=> $timess,
			);
			
			$sql3 = 'INSERT INTO ' . ADS_POPUP_SCHEDULES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary3);

            // echo $sql3 . 'maste,r<p>'; //exit;
			$db->sql_query($sql3);
            $rid = $db->sql_nextid();
			
			foreach ($zone as $value) {
                $sql_ary = array(
                    'ads_popup_schedule_id' => $rid,
                    'zone_id' 				=> $value,
                    'ads_popup_param' 		=> $timess,
                );

                $sql = 'INSERT INTO ' . ADS_ZONE_GROUPINGS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
                $db->sql_query($sql);
            }

            foreach ($channel as $val) {
                $sql_ary5 = array(
                    'ads_popup_schedule_id' => $rid,
                    'tv_channel_id' 		=> $val,
                    'ads_popup_param' 		=> $timess,
                );

                $sql6 = 'INSERT INTO ' . ADS_CHANNEL_GROUPINGS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary5);
                // echo $sql6;die();
                $db->sql_query($sql6);
                
            }
			
            redirect($config['admin_path'] . 'ads_popup_schedule.' . $phpEx, $sid);
			
		} else {
			$rejectnote = "Data sudah ada di database";
			header('Location: ' . $_SERVER['HTTP_REFERER'] . '&note=' . $rejectnote);
		}

    } else if ($mode == 'update') { //echo 'z';
		$update = true;
		$cektime = "SELECT * FROM " . ADS_POPUP_SCHEDULES_TABLE . " WHERE ads_popup_param = '".$time."' AND ads_popup_schedule_id <> ".$rid . " AND ((ads_popup_schedule_start <= ".$tglstart." AND ads_popup_schedule_end >= ".$tglstart.") OR (ads_popup_schedule_start <= ".$tglend." AND ads_popup_schedule_end >= ".$tglend.") OR (ads_popup_schedule_start >= ".$tglstart." AND ads_popup_schedule_end <= ".$tglend.")) ";
        $oktime = $db->sql_query($cektime);
        while($fish = $db->sql_fetchrow($oktime)) {
			$idpopup = $fish['ads_popup_schedule_id'];
			$tglawal = $fish['ads_popup_schedule_start'];
			$tglakhir = $fish['ads_popup_schedule_end'];
		
			if (($tglstart >= $tglawal && $tglstart <= $tglakhir) || ($tglend >= $tglawal && $tglend <= $tglakhir)) {
				$cekzone = "SELECT * FROM " . ADS_ZONE_GROUPINGS_TABLE . " g JOIN " . ADS_POPUP_SCHEDULES_TABLE . " p ON g.ads_popup_schedule_id = p.ads_popup_schedule_id WHERE g.ads_popup_param ='$time' AND ((ads_popup_schedule_start <= ".$tglstart." AND ads_popup_schedule_end >= ".$tglstart.") OR (ads_popup_schedule_start <= ".$tglend." AND ads_popup_schedule_end >= ".$tglend.")) AND p.ads_popup_schedule_id <> ".$rid;
				//echo $cekzone; exit;
                $okzone = $db->sql_query($cekzone);
				$zone_data = array();
				while ($filletzone = $db->sql_fetchrow($okzone)) {
					$zone_data[] = $filletzone['zone_id'];
				}
				
				$db->sql_freeresult($okzone);
				
				foreach($zone as $zone_item) {
					if(in_array($zone_item, $zone_data)) { //echo "a";
						$cekchannel = "SELECT * FROM " . ADS_CHANNEL_GROUPINGS_TABLE . " c RIGHT JOIN " . ADS_ZONE_GROUPINGS_TABLE . " z ON c.ads_popup_schedule_id = z.ads_popup_schedule_id JOIN " . ADS_POPUP_SCHEDULES_TABLE . " p ON z.ads_popup_schedule_id = p.ads_popup_schedule_id WHERE c.ads_popup_param = '".$time."' AND zone_id = '".$zone_item."' AND ((ads_popup_schedule_start <= ".$tglstart." AND ads_popup_schedule_end >= ".$tglstart.") OR (ads_popup_schedule_start <= ".$tglend." AND ads_popup_schedule_end >= ".$tglend.") OR (ads_popup_schedule_start >= ".$tglstart." AND ads_popup_schedule_end <= ".$tglend.")) AND p.ads_popup_schedule_id <> ".$rid."";
						//echo $cekchannel; exit;
						$okchannel = $db->sql_query($cekchannel);
						$channel_data = array();
						while ($filletchannel = $db->sql_fetchrow($okchannel)) {
							$channel_data[] = $filletchannel['tv_channel_id'];
						}
						
						$db->sql_freeresult($okchannel);
				
						foreach($channel as $channel_item) {
							if(in_array($channel_item, $channel_data)) {
								$update = false;
								break 3;
							} else {
								$update = true;
							}
						}
					} else { //echo "b";
						$update = true;
					}
				}
			} else {
				$update = true;
			}
		}
		//exit;
		if($update) {
			// ads_popup_schedule
			$sql_ary3 = array(
				'ads_popup_schedule_duration' 	=> $duration,
				'ads_popup_schedule_enabled' 	=> 1,
				'ads_popup_id' 					=> $popup,
				'ads_popup_schedule_start' 		=> $tglstart,
				'ads_popup_schedule_end' 		=> $tglend,
				'ads_popup_param' 				=> $timess,
			);
			
			$sql3 = "UPDATE " . ADS_POPUP_SCHEDULES_TABLE . " SET " . $db->sql_build_array('UPDATE', $sql_ary3) .
                    " WHERE ads_popup_schedule_id = ".$rid;
                          
            // echo $sql3 . 'maste,r<p>'; //exit;
			$db->sql_query($sql3);
			
			// Remove old data from zone grouping table
			$sql = 'DELETE FROM ' . ADS_ZONE_GROUPINGS_TABLE . "
				WHERE ads_popup_schedule_id = ".$rid;
			$db->sql_query($sql);
            
			foreach ($zone as $value) {
                $sql_ary = array(
                    'ads_popup_schedule_id' => $rid,
                    'zone_id' 				=> $value,
                    'ads_popup_param' 		=> $timess,
                );

                $sql = 'INSERT INTO ' . ADS_ZONE_GROUPINGS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
                $db->sql_query($sql);
            }
			
			// Remove old data from channel grouping table
			$sql = 'DELETE FROM ' . ADS_CHANNEL_GROUPINGS_TABLE . "
				WHERE ads_popup_schedule_id = ".$rid;
			$db->sql_query($sql);

            foreach ($channel as $val) {
                $sql_ary5 = array(
                    'ads_popup_schedule_id' => $rid,
                    'tv_channel_id' 		=> $val,
                    'ads_popup_param' 		=> $timess,
                );

                $sql6 = 'INSERT INTO ' . ADS_CHANNEL_GROUPINGS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary5);
                // echo $sql6;die();
                $db->sql_query($sql6);
                
            }
			
            redirect($config['admin_path'] . 'ads_popup_schedule.' . $phpEx, $sid);
			
		} else {
			$rejectnote = "Data sudah ada di database";
			header('Location: ' . $_SERVER['HTTP_REFERER'] . '&note=' . $rejectnote);
		}
	}

}

if ($mode == 'update') { 
    if (empty($rid)) {

        die('Missing  ID. Cannot update .');
    }
   
    $label = ($mode === 'update') ? $adm_lang['update_item'] : $adm_lang['view_item'];
    
	// Get node data for updating
	$sql = 'SELECT * FROM ' . ADS_POPUP_SCHEDULES_TABLE . " WHERE ads_popup_schedule_id=" . (int) $rid;

	//echo $sql; exit;
	$result = $db->sql_query($sql);
	$data = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	// Get Ala Carte Data for this Node
	$sql_zone = "SELECT * FROM " . ADS_ZONE_GROUPINGS_TABLE . " WHERE ads_popup_schedule_id = " . $rid . "";
	$result_zone = $db->sql_query($sql_zone);
	// echo $result_zone;die();

	$data_zone = array();
	while ($row_zone = $db->sql_fetchrow($result_zone)) {
		$data_zone[] = $row_zone['zone_id'];
	}
	$db->sql_freeresult($result_zone);

	$sql_channel = "SELECT * FROM " . ADS_CHANNEL_GROUPINGS_TABLE . " WHERE ads_popup_schedule_id = " . $rid . "";
	$result_channel = $db->sql_query($sql_channel);
	$data_channel = array();
	$i = 0;
	while ($row_channel = $db->sql_fetchrow($result_channel)) {
		$data_channel[$i] = $row_channel['tv_channel_id'];
		$i++;
	}
	$db->sql_freeresult($result_channel);
    
}

$foreign_id = (!empty($rid)) ? $rid : 0;
//$zone_id = (!empty($zid))? $zid : 0;

$s_hidden_fields = build_hidden_fields(array(
    'parent' => $parent,
    'mode' => $mode,
    'sid' => $sid,
    'module' => $modules,
    'id' => $rid)
);

//print_r($node_data); exit;


adm_page_header($module->active_module_name);

$template->assign_vars(array(
    'S_TARGET_ZONE' => generate_ads_zone('ads_popup_id', $data['ads_popup_id']),
    'S_TARGET_ROOM' => generate_popup_zone('zone_id[]', $data_zone),
    'S_TARGET_CHANNEL' => generate_popup_channel('tv_channel_id[]', $data_channel),
    'HIDE_DISPLAY_SIDE_MENU' => $adm_lang['hide_display_side_menu'],
    //'T_LOG_JS_PATH'       => $tonjaw_root_path . $config['js_path'] . 'log.js',
    'LOGIN_AS' => $adm_lang['login_as'],
    'USERNAME' => $session->username,
    'U_LOGOUT' => append_sid("{$tonjaw_admin_path}index.$phpEx") . '&amp;mode=logout',
    'L_LOGOUT' => $adm_lang['logout'],
    'MODULE_TITLE' => $module->active_module_name,
    'MODULE_DESC' => $module->active_module_desc,
    'U_ACTION' => $u_action,
    //'L_TITLE'         => $adm_lang['users_online'] . $config['session_length']/3600 . ' hour',
    'S_ADD_UPDATE' => $module->user_priviledge[1],
    // 'U_ADD'         => append_sid("{$tonjaw_admin_path}ads_popup_scheduledetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD' => $adm_lang['add'],
    'S_FACEBOX' => '0',
    'S_DATATABLE_NODES' => '0',
    'S_START' => (!empty($data['ads_popup_schedule_start'])) ? date('Y/m/d', $data['ads_popup_schedule_start']) : '',
    'S_END' => (!empty($data['ads_popup_schedule_end'])) ? date('Y/m/d', $data['ads_popup_schedule_end']) : '',
    'S_DUR' => $data['ads_popup_schedule_duration'],
    'L_COMPANY_NAME' => $adm_lang['company_name'],
    'L_ADDRESS' => $_GET['time'],
    'L_CONTACT_PERSON' => $adm_lang['contact_person'],
    'L_PHONE' => $adm_lang['phone'],
    'L_EMAIL' => $adm_lang['email'],
    'L_ENABLED' => $adm_lang['enabled'],
    'S_COMPANY_NAME' => $data['signage_ads_name'],
    'S_ADDRESS' => $data['signage_ads_address'],
    'S_CONTACT_PERSON' => $data['signage_ads_cp'],
    'S_PHONE' => $data['signage_ads_phone'],
    'S_EMAIL' => $data['signage_ads_email'],
    'S_ENABLED' => ($data['signage_ads_enabled']) ? 'checked' : '',
    'S_FORM_TOKEN' => $s_hidden_fields,
    'L_SUBMIT' => $adm_lang['submit'],
    'ZONENOTE' => (!empty($note)) ? $note : '',
));

$template->set_filenames(array(
    'body' => 'admin_popup_scheduleform.tpl',
));

page_footer();
?>
