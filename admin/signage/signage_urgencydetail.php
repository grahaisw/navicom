<?php
/**
*
* admin/signage/signage_urgencydetail.php
*
* Agnes Emanuella. Sep 2014
*/

/**
*/

define('IN_TONJAW', true);
define('IN_ADMIN', true);
define('NEED_SID', true);

$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : './../../';
$phpEx = substr(strrchr( $_SERVER['PHP_SELF'], '.'), 1);
$file = explode('.', substr(strrchr( $_SERVER['PHP_SELF'], '/'), 1));

// Include files
require($tonjaw_root_path . 'common.' . $phpEx);
$tonjaw_admin_path = $tonjaw_root_path . $config['admin_path'];
require($tonjaw_admin_path . 'common_adm.' . $phpEx);
$tonjaw_admin_signage_path = $tonjaw_root_path . $config['signage_path'];

$parent 	= request_var('parent', '');
$mode		= request_var('mode', '');
$sid 		= request_var('sid', '');
$modules	= request_var('module', '');
$nextid		= request_var('id', '');

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

//$flag_file 	= '0';
$error = '';
$error_msg = '';
$node_data = array();

$u_action = $tonjaw_admin_signage_path . 'signage_urgencydetail.' . $phpEx .'?sid=' . $sid;
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{
    $emergency_code = request_var('emergency_code', '');
    $target_gate_name = request_var('target_gate_name', '');
    $zone_id = array();
    $zone_id = (isset($_REQUEST['zone_id'])) ? request_var('zone_id', array('0')) : array();
    $room_id = array();
    $room_id = (isset($_REQUEST['room_id'])) ? request_var('room_id', array('0')) : array();
    $duration = request_var('duration', '');
    $enabled_flag = request_var('enabled_flag', '');
    $enabled_flag = $enabled_flag == 'on' ? '1' : '0' ;
    // $thumbnail = request_var('thumbnail', '');

    // echo $thumbnail;exit();
    // $filename = 'http://127.0.0.1/navicom_makasar/admin/uploads/temp/' . $thumbnail;
    // $filename_ads = '../../' . $config['middleware_path'] . 'media/images/signane/' . $thumbnail;
    // echo $filename;exit();
    // if(file_exists($filename)) {
    
        /*if (!copy($filename, $filename_ads)) {
            $errors= error_get_last();
            echo "failed to copy $filename...\n";
            echo "COPY ERROR: ".$errors['type'];
            echo "<br />\n".$errors['message'];
        } else {
            echo 'yeay';
        }*/
        
    //     $input = fopen($filename, "r");
    //     $temp = tmpfile();
    //     $realSize = stream_copy_to_stream($input, $temp);
    //     fclose($input);
        
    //     $target = fopen($filename_ads, "w");        
    //     fseek($temp, 0, SEEK_SET);
    //     stream_copy_to_stream($temp, $target);
    //     fclose($target);
        
    //     // Delete files in temporary folder
    //     $files = glob($tonjaw_admin_path . 'uploads/temp/*'); //get all file names
    //     foreach($files as $file){
    //         if(is_file($file))
    //         unlink($file); //delete file
    //     }
    // }
    
    $sql_ary = array(
	    'signage_urgency_duration'	    => $duration,
        'signage_urgency_enabled'	    => (int) $enabled_flag,
        'emergency_code'	            => $emergency_code,
        'signage_urgency_priority_order' => '1',
        'signage_urgency_flag'          => 'emergency',
        //'signage_thumbnail'          => $thumbnail,
    );
    
    if ($mode === 'add')
    {
        $sql = 'INSERT INTO ' . SIGNAGE_URGENCIES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
       // echo $sql . 'master<p>'; exit;
        $db->sql_query($sql);
        $nextid = $db->sql_nextid();
        // echo $nextid;exit();
    }
    
    if ($mode === 'update')
    {
        $sql = 'UPDATE ' . SIGNAGE_URGENCIES_TABLE . ' SET ' . 
            $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE signage_urgency_id = '.$nextid;
        //echo $sql; exit;
        $db->sql_query($sql);
        
        // Remove old data from signage_zone_groupings table
        $sql = 'DELETE FROM ' . SIGNAGE_URGENCY_ZONE_GROUPINGS_TABLE . "
            WHERE signage_urgency_id = $nextid";
        $db->sql_query($sql);
        
        // Remove old data from signage_room_groupings table
        $sql = 'DELETE FROM ' . SIGNAGE_URGENCY_ROOM_GROUPINGS_TABLE . "
            WHERE signage_urgency_id = $nextid";
        $db->sql_query($sql);
        
    }
    
    //Insert new data to signage_urgency_zone_groupings table
    $i = 0;
    while ( $i < sizeof($zone_id) )
    {
        $sql_ary = array(
            'signage_urgency_id'    => $nextid,
            'zone_id'		        => $zone_id[$i],
        );
        
        $sql = 'INSERT INTO ' . SIGNAGE_URGENCY_ZONE_GROUPINGS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
        $db->sql_query($sql);
    
        $i++;
    }
    
    //Insert new data to signage_urgency_room_groupings table
    $j = 0;
    while ( $j < sizeof($room_id) )
    {
        $sql_ary = array(
            'signage_urgency_id'    => $nextid,
            'room_id'		        => $room_id[$j],
        );
        
        $sql = 'INSERT INTO ' . SIGNAGE_URGENCY_ROOM_GROUPINGS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
        $db->sql_query($sql);
    
        $j++;
    }


    // echo "string";exit();
    //GRAB LANGUAGES DATA
    $lang_data = array();
    $lang_count = 0;
    //$sql_sort = 'log_time DESC';
    $keyword = 'WHERE language_enabled = 1 ';
    $start = view_langs($lang_data, $lang_count, $keyword);

    // echo '<p>'; print_r($lang_data);
    $sql_translation    = array();

    $i = 0;
    foreach($lang_data as $row)
    {
    $lang_id = request_var('lang_' . $row['id'], '');
    $translation_id = request_var('translation_' . $row['id'], '');
    $title = utf8_normalize_nfc(request_var('title_' . $row['id'], '', true));
    $description = utf8_normalize_nfc(request_var('description_' . $row['id'], '', true));
    // echo $lang_id;exit();
    $sql_translation = array(
        'signage_urgencies_translations_id'        => (int) $nextid,
        'translation_title'     => (string) $title,
        'translation_description'   => (string) $description,
        'language_id'       => (string) $lang_id,
    );
    // print_r($sql_translation);exit();
    //if ($mode === 'add')
    if ( empty($translation_id) )
    {
        $sql = 'INSERT INTO ' . SIGNAGE_URGENCIES_TRANSLATION_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_translation);
         // echo $sql;exit();
    }
    
    //if ($mode === 'update')
    if ( !empty($translation_id) )
    {
        $sql = 'UPDATE ' . SIGNAGE_URGENCIES_TRANSLATION_TABLE . " SET " . 
        $db->sql_build_array('UPDATE', $sql_translation) .
        " WHERE translation_id = " .$translation_id;
    }
    
    //echo '<p>lang: ' . $sql; exit;
    $db->sql_query($sql);
    
    }
    // echo "string";exit();
    redirect($config['signage_path'] . 'signage_urgency.' . $phpEx, $sid);
}

$detail_data = array();
$lang_data = array();
$lang_count = 0;
$keyword = 'WHERE language_enabled = 1 ';
//$sql_sort = 'log_time DESC';
$start = view_langs($lang_data, $lang_count, $keyword);

if ($mode === 'update' || $mode === 'detail')
{
    

     if (empty($nextid))
    {
    die('Missing Service ID. Cannot update Services Table.');
    }
    
    $label = ($mode === 'update') ? $adm_lang['update_item'] : $adm_lang['view_item'];
    // Get service data for updating
    // $sql = 'SELECT s.*, t.translation_title AS group_name FROM ' . SIGNAGE_URGENCIES_TRANSLATION_TABLE . "  
    // WHERE s.service_group_id=g.service_group_id 
    // AND g.service_group_id=t.service_group_id 
    // AND t.language_id='" . $config['default_language'] . "'
    // AND s.signage_urgencies_translations_id=" . (int) $nextid;
    
    // $result = $db->sql_query($sql);
    // $data = $db->sql_fetchrow($result);
    // $db->sql_freeresult($result);
    
    $data_thumbnail = ($data['service_thumbnail'])? $data['service_thumbnail'] : '0';
    $thumbnail = $tonjaw_root_path . $config['media_path'] . $config['service_icon_path'] . $data_thumbnail;





    // Get room data for updating
    $sql = 'SELECT * FROM ' . SIGNAGE_URGENCIES_TABLE . " WHERE signage_urgency_id = $nextid";
    
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);






      $sql = 'SELECT * FROM ' . SIGNAGE_URGENCIES_TRANSLATION_TABLE . " WHERE signage_urgencies_translations_id = $nextid";
      // echo $sql;exit()
    $result = $db->sql_query($sql);
    
    while ($detail = $db->sql_fetchrow($result))
    {
    $detail_data[$detail['language_id']] = array(
        'translation_id'        => $detail['translation_id'],
        'translation_title'     => $detail['translation_title'],
        'translation_description'   => $detail['translation_description'],
    );

    }
    
    $db->sql_freeresult($result);

}

$flag_path = $tonjaw_root_path . $config['media_path'] . $config['flag_path'];

$s_hidden_fields = build_hidden_fields(array(
    'parent'    => $parent,
    'mode'  => $mode,
    'sid'   => $sid,
    'module'    => $modules,
    'id'    => $nextid)
);

// $s_hidden_fields = build_hidden_fields(array(
//     'parent'	=> $parent,
//     'mode'	=> $mode,
//     'sid'	=> $sid,
//     'module'    => $modules,
//     'id'    => $nextid)
// );

adm_page_header($module->active_module_name);


foreach ($lang_data as $row)
{
    //echo '<p>' . $tonjaw_root_path . $config['language_path'] . $row['id'] . ".$phpEx";
    //$data = array();
    $template->assign_block_vars('lang', array(
    'LANG_NAME' => $row['name']." (".$row['id'].")",    
    'L_TITLE'   => $adm_lang['title'],
    'L_DESCRIPTION' => $adm_lang['description'],
    'S_DESCRIPTION' => $detail_data[$row['id']]['translation_description'],
    'FLAG_FILE' => $flag_path . $row['flag'],
    'S_LID'     => $row['id'],
    'S_TITLE'   => $detail_data[$row['id']]['translation_title'],
    'S_POS_NAME'    => $name,
    'S_RID'     => $detail_data[$row['id']]['translation_id'],
    ));
}

$template->assign_vars(array(
    'HIDE_DISPLAY_SIDE_MENU'	=> $adm_lang['hide_display_side_menu'],
    //'T_LOG_JS_PATH'		=> $tonjaw_root_path . $config['js_path'] . 'log.js',
    'LOGIN_AS'			=> $adm_lang['login_as'],
    'USERNAME'			=> $session->username,
    'U_LOGOUT'			=> append_sid("{$tonjaw_admin_path}index.$phpEx") . '&amp;mode=logout',
    'L_LOGOUT'			=> $adm_lang['logout'],
    'MODULE_TITLE'		=> $module->active_module_name,
    'MODULE_DESC' 		=> $module->active_module_desc,
    'U_ACTION'			=> $u_action,
    //'L_TITLE'			=> $adm_lang['users_online'] . $config['session_length']/3600 . ' hour',
    'S_ADD_UPDATE'		=> $module->user_priviledge[1],
    'U_ADD'			=> append_sid("{$tonjaw_admin_signage_path}signage_urgencydetail.$phpEx", "mode=add") . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '0',
    'L_NAME'			=> $adm_lang['name'],
    'L_FILE'			=> $adm_lang['file'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'L_SUBMIT'			=> $adm_lang['submit'],
    'L_DURATION'		=> $adm_lang['duration'],
    'L_EMERGENCY_TYPE'	=> $adm_lang['emergency_type'],
    'L_TARGET_GATE'		=> $adm_lang['target_gate'],
    'L_ZONE'		    => $adm_lang['zone'],
    'L_ROOMS'		    => $adm_lang['room'],
    'L_THUMBNAIL'       => $adm_lang['thumbnail'],
    'THUMBNAIL_FILE'        => file_exists($thumbnail)? '1' : '0',
    'S_THUMBNAIL_FILE'      => $thumbnail,
    'S_THUMBNAIL'       => $adm_lang['signane_thumbnail'],
));

switch($mode) {
    case 'update' :
    case 'add':
        $s_hidden_fields = build_hidden_fields(array(
            'parent'	=> $parent,
            'mode'	=> $mode,
            'sid'	=> $sid,
            'module'	=> $modules,
            'id'	=> $nextid)
        );
        
        $template->assign_vars(array(
            'S_FORM'		=> '1',
            'S_DURATION'	=> $data['signage_urgency_duration'],
            'S_ENABLED'		=> ($data['signage_urgency_enabled'])? 'checked' : '',
            'S_EMERGENCY_TYPE'	=> generate_emergency_type('emergency_code', $data['emergency_code']),
            'S_TARGET_GATE'	=> generate_target_gate('target_gate_id', $data['signage_emergency_direction']),
            'S_ZONE'		=> generate_zone_multiple('zone_id[]', $nextid, SIGNAGE_URGENCY_ZONE_GROUPINGS_TABLE, 'signage_urgency_id'),
            'S_ROOMS'		=> generate_room('room_id[]', $nextid, SIGNAGE_URGENCY_ROOM_GROUPINGS_TABLE, 'signage_urgency_id'),
            'S_FORM_TOKEN'	=> $s_hidden_fields,
//            'THUMBNAIL_FILE'        => file_exists($thumbnail)? '1' : '0',
//    'S_THUMBNAIL_FILE'      => $thumbnail,
    'L_THUMBNAIL'       => $adm_lang['thumbnail'],
    'S_THUMBNAIL'       => $adm_lang['signage_thumbnail'],
        ));
        break;
        
    case 'detail' :
    
        $template->assign_vars(array(
            'S_DETAIL'		=> '1',
            'S_DURATION'	=> $data['signage_urgency_duration'],
            'S_ENABLED'		=> ($data['signage_urgency_enabled'])? 'Yes' : 'No',
        ));
        break;
    
}

$template->set_filenames(array(
	'body' => 'admin_signage_urgencyform.tpl',
));

page_footer();


?>
