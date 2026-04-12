<?php
/**
*
* admin/movie.php
*
* Roberto Tonjaw. Feb 2014
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

//echo $file[0]; exit;
//$template->set_template();

$mode		= request_var('mode', '');
$sid 		= request_var('sid', '');
$mid		= request_var('id', '');

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

//$flag_file 	= '0';
$error = '';
$error_msg = '';

$u_action = append_sid("{$tonjaw_admin_path}movie.$phpEx", "mode=update");

// This page depends on its parent and cannot be displayed alone

//GRAB MOVIE DATA
$movie_data = array();
$movie_count = 0;
//$sql_sort = 'log_time DESC';
$start = grab_movies($movie_data, $movie_count);

//print_r($movie_data); exit;

if ($mode === 'update')
{
    $mid	= array();
    $mark	= array();
    
    $mid	= (isset($_REQUEST['movie_id'])) ? request_var('movie_id', array('0')) : array();

    //echo '<p>mid: '; print_r($mid);
    //echo '<br>mark: '; print_r($mark); echo '<p><p>'; exit; 
    
    $i = 0;
    foreach($movie_data as $row)
    {
	$mark[$i] = (request_var('mark_' . $mid[$i], ''))? '1' : '0';
	
	$sql = 'UPDATE ' . MOVIES_TABLE . ' 
	  SET movie_enabled=' . (string) $mark[$i] ."
	  WHERE movie_id = '" . $mid[$i] . "'";
	
	if( !empty($mid[$i]) )
	{
	    $db->sql_query($sql);
	    //echo '<p>' . $sql . "<br/>tv_id[$i]</p>";
	}
	
	$i++;
    }
    
    redirect($config['admin_path'] . 'movie.' . $phpEx, $sid);

}

if (isset($_GET['id']) && $mode === 'delete')
{
    // $mid    = array();
    // $mark   = array();
    
    // $mid    = (isset($_REQUEST['id'])) ? request_var('id', array('0')) : array();
    $mid = $_GET['id'];


     $sql4 ='select movie_url from '. MOVIES_TABLE .'  where movie_id = '.$mid.'';
      // echo $sql4;exit();
    $result= $db->sql_query($sql4);
    
    $movie = $db->sql_fetchfield('movie_url');
    // echo $music;exit();
    // Delete files in temporary folder
         $c = curl_init();
            curl_setopt($c, CURLOPT_URL, $config['vod_server'].$config['vod_path']."/handle.php?mod=delete&type=movies&file=".$movie);
                curl_setopt($c, CURLOPT_POST, 1);
                curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($c, CURLOPT_POSTFIELDS, $POST_DATA);

                $response = curl_exec($c);


    
    $sql = 'DELETE FROM ' . MOVIES_TABLE . ' WHERE movie_id = ' . (int) $mid;
    $db->sql_query($sql);
    $sql2 = 'DELETE FROM ' . MOVIE_GROUPINGS_TABLE . ' WHERE movie_id = ' . (int) $mid;
    $db->sql_query($sql2);
    $sql3 = 'DELETE FROM ' . MOVIE_TRANSLATIONS_TABLE . ' WHERE movie_id = ' . (int) $mid;
    $db->sql_query($sql3);
    // echo "string";exit();
    // print_r($sql);exit();
    redirect($config['admin_path'] . 'movie.' . $phpEx, $sid);
}

$thumbnail_path = $tonjaw_root_path . $config['media_path'] . $config['movie_icon_path'];

// Generate the page
adm_page_header($module->active_module_name);

foreach ($movie_data as $row)
{
    //$data = array();
    $thumbnail = file_exists($thumbnail_path.$row['thumbnail'])? $thumbnail_path.$row['thumbnail'] : $thumbnail_path.$config['default_thumbnail_movie'];
    
    //echo $thumbnail; exit;
    $template->assign_block_vars('movie', array(
	'S_MID'			=> $row['id'],
	'NAME'			=> $row['title'],
	'L_CAST'		=> $adm_lang['casts'],
	'S_CAST'		=> $row['casts'],
	'L_DIRECTOR'		=> $adm_lang['director'],
	'S_DIRECTOR'		=> $row['director'],
	'GROUP'			=> $row['group'],
	'THUMBNAIL_PATH'	=> $thumbnail_path,
	'THUMBNAIL'		=> $row['thumbnail'],
	'ALLOW_ADS'		=> ($row['allow_ads']) ? 'Yes' : 'No',
	'ENABLED'		=> ($row['enabled']) ? 'Yes' : 'No',
	'V_ENABLED'		=> ($row['enabled'])? 'checked' : '',
	'U_UPDATE'		=> append_sid("{$tonjaw_admin_path}moviedetail.$phpEx", "mode=update") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'L_UPDATE'		=> $adm_lang['edit'],
	'U_NAME'		=> append_sid("{$tonjaw_admin_path}moviedetail.$phpEx", "mode=detail") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'U_DELETE'		=> append_sid("{$tonjaw_admin_path}movie.$phpEx", "mode=delete") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'L_DELETE'		=> $adm_lang['delete'],
	'ICON_PATH'		=> $tonjaw_root_path . $config['imageset_path'],
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
    'S_DELETE'			=> $module->user_priviledge[2],
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}moviedetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '1',
    'S_FOURTH_FIELD'		=> '1',
    'S_EIGHT_FIELD'		=> '1',
    'S_SEVENTH_FIELD'		=> '1',
    'L_ORDER'			=> $adm_lang['order'],
    'L_THUMBNAIL'		=> $adm_lang['poster'],
    'L_NAME'			=> $adm_lang['title'],
    'L_ALLOW_ADS'		=> $adm_lang['allow_ads'],
    'L_GROUP'			=> $adm_lang['genre'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'S_MOVIES'			=> ($movie_count > 0),
    'L_SUBMIT'			=> $adm_lang['submit'],
    'L_CONFIRM_DELETE'		=> $adm_lang['confirm_delete'],

));

$template->set_filenames(array(
	'body' => 'admin_movie.tpl',
));

//add_log($adm_lang['read']);
page_footer();


?>
