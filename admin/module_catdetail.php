<?php
/**
*
* admin/module_catdetail.php
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

$template->set_template();

$parent 	= request_var('parent', '');
$mode		= request_var('mode', '');
$sid 		= request_var('sid', '');
$modules	= request_var('module', '');
$mcatid		= request_var('id', '');

//echo $parent; exit;
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
 
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{
    $mcat_name = utf8_normalize_nfc(request_var('name', ''));
   
    $sql_ary = array(
	'module_detail_cat_name'	=> (string) $mcat_name,
    );
    //$parent_parameter = $sid . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module-
}

if ($mode === 'add' && isset($_POST['submit']))
{
    
    $sql = 'INSERT INTO ' . MODULES_DETAIL_CAT_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);

    $db->sql_query($sql);
    
    redirect($config['admin_path'] . 'module_cat.' . $phpEx, $sid);
    //echo $sql; exit;
}

if ($mode === 'update')
{
    $data = array();
    
    if (empty($mcatid))
    {
	die('Missing Module Category ID. Cannot update Module Category Table.');
    }
    
    $label = ($mode === 'update') ? $adm_lang['update_item'] : $adm_lang['view_item'];

    if (isset($_POST['submit']))
    {
      
	$sql = 'UPDATE ' . MODULES_DETAIL_CAT_TABLE . " SET " . 
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE module_detail_cat_id = " .  (int) $mcatid;
	
	$db->sql_query($sql);
	
	redirect($config['admin_path'] . 'module_cat.' . $phpEx, $sid);
	//echo $sql; exit;
    }
    else
    {
	// Get node data for updating
	$sql = 'SELECT * FROM ' . MODULES_DETAIL_CAT_TABLE . " WHERE module_detail_cat_id=" . (int) $mcatid;
    
	//echo $sql; exit;
	$result = $db->sql_query($sql);
	$data = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

    }
}

$s_hidden_fields = build_hidden_fields(array(
    'parent'	=> $parent,
    'mode'	=> $mode,
    'sid'	=> $sid,
    'module'	=> $modules,
    'id'	=> $mcatid)
);

$label = (!$label) ? $adm_lang['add_item'] : $label;
adm_page_header($module->active_module_name);

$template->assign_vars(array(
    'HIDE_DISPLAY_SIDE_MENU'	=> $adm_lang['hide_display_side_menu'],
    'LOGIN_AS'			=> $adm_lang['login_as'],
    'USERNAME'			=> $session->username,
    'U_LOGOUT'			=> append_sid("{$tonjaw_admin_path}index.$phpEx") . '&amp;mode=logout',
    'L_LOGOUT'			=> $adm_lang['logout'],
    'MODULE_TITLE'		=> $module->active_module_name,
    'MODULE_DESC' 		=> $module->active_module_desc,
    'S_ADD_UPDATE'		=> $module->user_priviledge[1],
    'S_DELETE'			=> $module->user_priviledge[2],
    'U_ACTION'		=> append_sid("{$tonjaw_admin_path}module_catdetail.$phpEx"),
    'L_COMPOSE'		=> ($mode === 'add')?$adm_lang['add'] : $adm_lang['edit'],
    'L_NAME'		=> $adm_lang['module_category_name'],
    'S_NAME'		=> $data['module_detail_cat_name'],
    'L_SUBMIT'		=> $adm_lang['submit'],
    'S_FORM_TOKEN'	=> $s_hidden_fields,
    'L_LABEL'		=> $label,
 ));

$template->set_filenames(array(
	'body' => 'admin_module_cat_form.tpl',
));

page_footer();

?>