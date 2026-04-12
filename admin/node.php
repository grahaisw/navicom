<?php
/**
*
* admin/node.php
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

$session->session_begin($file[0]);

require($tonjaw_root_path . $config['include_path'] . 'functions_module.' . $phpEx);

// Instantiate new module
$module = new p_master();

$template->set_template();

// Instantiate module system and generate list of available modules
$module->list_modules($file[0]);

//Generate detail menu of the selected module
$module->list_modules_detail($file[0], $module->p_id);

// Assign data to the template engine for the list of modules
// We do this before loading the active module for correct menu display in trigger_error
$module->assign_tpl_vars(append_sid("{$tonjaw_admin_path}index.$phpEx"));

// Set up general vars
$mode       = request_var('mode', 'list');
$keyword    = request_var('v', '');
$sid        = request_var('sid', '');

//$keyword = '';

if($keyword === 'all')
{
    $keyword = "WHERE node_enabled = '1'";
}

$u_action = append_sid("{$tonjaw_admin_path}node.$phpEx", "mode=update");

//GRAB NODES DATA
$node_data = array();
$node_count = 0;
//$sql_sort = 'log_time DESC';
$start = view_nodes($node_data, $node_count, $keyword);

if ($mode === 'update')
{
    $nid    = array();
    $mark   = array();
    
    $nid    = (isset($_REQUEST['nid'])) ? request_var('nid', array(0)) : array();

    $i = 0;
    foreach($node_data as $row)
    {

    $mark[$i] = request_var('mark_' . $nid[$i], '')? '1' : '0';
    
    $sql = 'UPDATE ' . NODES_TABLE . ' 
      SET node_enabled = ' . (string) $mark[$i] ."
      WHERE node_id=" . $nid[$i];
      
    if( !empty($nid[$i]) )
    {
        $db->sql_query($sql);
    }
    
        //echo $sql . '<p>';
        //echo '<p>ada yg rubah euy</br>lama:' . $row['enabled'] . '</br>baru:' . $mark[$i]; 
        //echo '<p>Ready to update Node ID: ' . $nid[$i] . '</br>' . $sql . '<p>'; 
    $i++;
    }
    
    redirect($config['admin_path'] . 'node.' . $phpEx, $sid);
    //exit;
    
}

if (isset($_GET['id']) && $mode === 'delete')
{
    $nid    = request_var('id', '');
    
    $sql = 'DELETE FROM ' . NODES_TABLE . ' WHERE node_id = ' . (int) $nid;
    $db->sql_query($sql);
    
    redirect($config['admin_path'] . 'node.' . $phpEx, $sid);
    // echo 'ready to wipe out ID: ' . $nid . '</br>SQL: ' . $sql; exit;
}

// Generate the page
adm_page_header($module->active_module_name);

foreach ($node_data as $row)
{   
    
    /*if(!empty($row['ip'])) {
        $fp = @fsockopen($row['ip'], 80, $err, $err_string, 1);
        if(!$fp) {
            $status = "<span style=\"color:red\">OFF</span>";
        } else {
            $status = "<span style=\"color:green\">ON</span>";
        }
    } else {
        $status = "";
    }*/
    
    
    $last_channel_id = (!empty($row['last_channel'])) ? $row['last_channel'] : $config['tv_channel_id_on_home'];
    $sql_channel = "SELECT tv_channel_name FROM ".TV_CHANNELS_TABLE." WHERE tv_channel_id = ".$last_channel_id."";
    $result_channel = $db->sql_query($sql_channel);
    $channel_name = $db->sql_fetchfield('tv_channel_name');
	
    $sql_flight = "SELECT fids_remark, fids_lastupdate, fids_flight FROM " . AIRPORT_FIDS_TABLE . " a
                        JOIN " . AIRPORT_FLIGHT_STATUS_TABLE . " f ON upper(a.fids_remark) = upper(f.airport_flight_status_remark)
                        WHERE airport_flight_status_display_on_tv = 1 AND fids_lastupdate <= '".$row['lastupdate']."'
                        ORDER BY fids_lastupdate DESC LIMIT 1";
                $result_flight = $db->sql_query($sql_flight);
                $row_flight = $db->sql_fetchrow($result_flight);
                $last_flight_date = (!empty($row_flight['fids_lastupdate'])) ? date("Y-m-d H:i:s", $row_flight['fids_lastupdate']) : '';
                $last_flight = $row_flight['fids_flight'].' - '.$row_flight['fids_remark'].'<br>'.$last_flight_date;	
    
    //$data = array();
    $template->assign_block_vars('node', array(
    'NAME'          => $row['name'],
    'MAC'           => $row['mac'],
    'IP'            => $row['ip'],
    'DESCRIPTION'       => ($row['desc'])? $row['desc'] . '<br/>' . $row['url'] : $row['url'],
	'LAST_FLIGHT'		=> $last_flight,
    'S_NID'         => $row['id'],
    'STATUS'        => $status,
    'U_RESTART'     => $status,
    //'S_ENABLED'       => $row['enabled'],
    'V_ENABLED'     => ($row['enabled'])? 'checked' : '',
    'ENABLED'       => ($row['enabled']) ? 'Yes' : 'No',
    'U_UPDATE'      => append_sid("{$tonjaw_admin_path}nodedetail.$phpEx", "mode=update") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_UPDATE'      => $adm_lang['edit'],
    'U_DELETE'      => append_sid("{$tonjaw_admin_path}node.$phpEx", "mode=delete") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_DELETE'      => $adm_lang['delete'],
    'ICON_PATH'     => $tonjaw_root_path . $config['imageset_path'],
    'ROOM'          => $row['room'],
    'LAST_CHANNEL'  => $channel_name,
    ));
}

$template->assign_vars(array(
    'HIDE_DISPLAY_SIDE_MENU'    => $adm_lang['hide_display_side_menu'],
    //'T_LOG_JS_PATH'       => $tonjaw_root_path . $config['js_path'] . 'log.js',
    'LOGIN_AS'          => $adm_lang['login_as'],
    'USERNAME'          => $session->username,
    'U_LOGOUT'          => append_sid("{$tonjaw_admin_path}index.$phpEx") . '&amp;mode=logout',
    'L_LOGOUT'          => $adm_lang['logout'],
    'MODULE_TITLE'      => $module->active_module_name,
    'MODULE_DESC'       => $module->active_module_desc,
    'U_ACTION'          => $u_action . "&amp;$u_sort_param$keywords_param&amp;start=$start",
    //'L_TITLE'         => $adm_lang['users_online'] . $config['session_length']/3600 . ' hour',
    'S_ADD_UPDATE'      => $module->user_priviledge[1],
    'S_DELETE'          => $module->user_priviledge[2],
    'U_ADD'         => append_sid("{$tonjaw_admin_path}nodedetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'         => $adm_lang['add'],
    'S_FACEBOX'         => '0',
    'S_DATATABLE_NODES'     => '1',
    'S_THIRD_FIELD'     => '1',
    'S_FOURTH_FIELD'        => '1',
    'S_FIFTH_FIELD'     => '1',
    'S_SEVENTH_FIELD'       => '1',
    'S_EIGHT_FIELD'     => '1',
    'S_NINTH_FIELD'     => '1',
    'S_TENTH_FIELD'     => '1',
	'S_ELEVENTH_FIELD'     => '1',
    'L_MAC'         => $adm_lang['mac'],
    'L_IP'          => $adm_lang['ip'],
    'L_NAME'            => $adm_lang['node_name'],
    'L_DESCRIPTION'     => $adm_lang['description'],
    'L_NO_ENTRIES'      => $adm_lang['no_entry'],
    'L_ENABLED'         => $adm_lang['enabled'],
    'S_NODES'           => ($node_count > 0),
    'L_SUBMIT'          => $adm_lang['submit'],
    'L_CONFIRM_DELETE'      => $adm_lang['confirm_delete'],
    'L_STATUS'          => $adm_lang['status_stb'],
    'L_CHECK_STATUS'    => $adm_lang['check_status'],
    'L_RESTART'         => $adm_lang['restart_stb'],
    'S_IN_NODE'         => 1,
    'L_ROOM'            => $adm_lang['room'],
    'L_LAST_CHANNEL'    => $adm_lang['last_channel'],
	'L_LAST_FLIGHT'		=> $adm_lang['last_flight'],
	'S_IN_REALTIME'	=> '1',
    ));

$template->set_filenames(array(
    'body' => 'admin_node.tpl',
));

//add_log($adm_lang['read']);
page_footer();


?>
