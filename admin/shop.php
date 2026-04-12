<?php
/**
*
* admin/shop.php
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

//echo $file[0]; exit;
//$template->set_template();

$mode		= request_var('mode', '');
$sid 		= request_var('sid', '');
$rid		= request_var('id', '');

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

$u_action = append_sid("{$tonjaw_admin_path}shop.$phpEx", "mode=update");

// This page depends on its parent and cannot be displayed alone

//GRAB SHOP DATA
$shop_data = array();
$shop_count = 0;
//$sql_sort = 'log_time DESC';
$start = grab_shop($shop_data, $shop_count);
//print_r($service_data); exit;

if ($mode === 'update')
{
    $rid	= array();
    $mark	= array();
    
    $rid	= (isset($_REQUEST['shop_id'])) ? request_var('shop_id', array('0')) : array();

    //echo '<p>rid: '; print_r($rid); echo '<p>';
    //echo '<br>mark: '; print_r($mark); echo '<p><p>'; exit; 
    
    $i = 0;
    foreach($shop_data as $row)
    {
	$mark[$i] = request_var('mark_' . $rid[$i], '')? '1' : '0';
	
	$sql = 'UPDATE ' . SHOPS_TABLE . ' 
	  SET shop_enabled=' . (string) $mark[$i] ."
	  WHERE shop_id = '" . $rid[$i] . "'";

	if( !empty($rid[$i]) )
	{
	    $db->sql_query($sql);
	    //echo '<p>' . $sql . "<br/>rid[$i]</p>";
	}
	
	$i++;
    }
    //exit;
    redirect($config['admin_path'] . 'shop.' . $phpEx, $sid);

}

if (isset($_GET['id']) && $mode === 'delete')
{

}

$thumbnail_path = $tonjaw_root_path . $config['media_path'] . $config['shop_icon_path'];

// Generate the page
adm_page_header($module->active_module_name);

if ( $pms_config['shop_item_in_pos'] )
{
    require($tonjaw_root_path . $config['pms_path'] . $pmsname . '.' . $phpEx);
    $pms	= new $pms_api();

}



foreach ($shop_data as $row)
{
    //$data = array();
    $thumbnail = file_exists($thumbnail_path.$row['thumbnail'])? $thumbnail_path.$row['thumbnail'] : $thumbnail_path.$config['default_thumbnail'];
    
    if ( $pms_config['shop_item_in_pos'] )
    {
	$pms->get_menu_item($row['code']);
	
	$price = '';
	$name = '';
	
	foreach ($pms->menu_data as $row1)
	{
	    $price = $row1['price'];
	    $name = $row1['menu_name'] . ' - ';
	}
	// Reset array if there's no such a code in POS menu
	$pms->menu_data = array();
    
    }
    else
    {
	$price = $row['price'];
    }
    
    //echo $thumbnail; exit;
    $template->assign_block_vars('shop', array(
	'S_RID'			=> $row['id'],
	'NAME'			=> $name . $row['name'],
	'DESCRIPTION'		=> $row['code'] . ' ' . $row['description'],
	'ORDER'			=> $row['order'],
	'GROUP'			=> $row['group'],
	//'S_DIRECTOR'		=> $row['director'],
	'PRICE'			=> $price,
	'THUMBNAIL'		=> $thumbnail_path . $row['thumbnail'],

	'ENABLED'		=> ($row['enabled']) ? 'Yes' : 'No',
	'V_ENABLED'		=> ($row['enabled'])? 'checked' : '',
	'U_UPDATE'		=> append_sid("{$tonjaw_admin_path}shopdetail.$phpEx", "mode=update") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'L_UPDATE'		=> $adm_lang['edit'],
	'U_NAME'		=> append_sid("{$tonjaw_admin_path}shopdetail.$phpEx", "mode=detail") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'U_DELETE'		=> append_sid("{$tonjaw_admin_path}shop.$phpEx", "mode=delete") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
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
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}shopdetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '1',
    'S_THIRD_FIELD'		=> '1',
    'S_FOURTH_FIELD'		=> '1',
    'S_EIGHT_FIELD'		=> '1',
    'S_SEVENTH_FIELD'		=> '1',
    'L_ORDER'			=> $adm_lang['order'],
    'L_THUMBNAIL'		=> $adm_lang['poster'],
    'L_NAME'			=> $adm_lang['title'],
    'L_PRICE'			=> $adm_lang['price'],
    'L_GROUP'			=> $adm_lang['category'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'S_SHOPS'			=> ($shop_count > 0),
    'L_SUBMIT'			=> $adm_lang['submit'],
    'L_CONFIRM_DELETE'		=> $adm_lang['confirm_delete'],

));

$template->set_filenames(array(
	'body' => 'admin_shop.tpl',
));

//add_log($adm_lang['read']);
page_footer();


?>