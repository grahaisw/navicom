<?php
/**
*
* admin/shopdetail.php
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

$parent 	= request_var('parent', '');
$mode		= request_var('mode', '');
$sid 		= request_var('sid', '');
$modules	= request_var('module', '');
$rid		= request_var('id', '');

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
$group_data = array();

$u_action = $tonjaw_admin_path . 'shopdetail.' . $phpEx .'?sid=' . $sid;
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{
    // Preparing UPDATE SHOP TABLE
    $order = request_var('order', '');
    $code = utf8_normalize_nfc(request_var('code', '', true));
    $gid = request_var('group_id', '1');
    $price = request_var('price', '0');
    $allow_ads_flag = request_var('allow_ads_flag', '');
    $enabled_flag = request_var('enabled_flag', '');
    $thumbnail = request_var('thumbnail', '');
	$currency = request_var('currency', '');
    
    $enabled_flag = $enabled_flag == 'on' ? '1' : '0';
    $allow_ads_flag = $allow_ads_flag == 'on' ? '1' : '0';
    
    $sql_ary = array(
	'shop_order'		=> (int) $order,
	'shop_enabled'		=> (int) $enabled_flag,
	'shop_allow_ads'		=> (int) $allow_ads_flag,
	'shop_price'		=> (int) $price,
	'shop_thumbnail'		=> (string) $thumbnail,
	'shop_group_id'		=> (int) $gid,
	'shop_code'		=> (string) $code,
	'shop_updated'		=> (int) 1,
	'shop_currency'	=> (string) $currency,
     );
    
    if ($mode === 'add')
    {
	$error = '';
	$error_msg = '';

	if ( $error )
	{
	    die($error_msg);
	}
    
	$sql = 'INSERT INTO ' . SHOPS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	//echo $sql; exit;
	$db->sql_query($sql);
	$rid = $db->sql_nextid();
	
    }

    if ($mode === 'update')
    {
	$sql = 'UPDATE ' . SHOPS_TABLE . " SET " . 
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE shop_id = $rid";
	$db->sql_query($sql);
	
    }
    
    //GRAB LANGUAGES DATA
    $lang_data = array();
    $lang_count = 0;
    //$sql_sort = 'log_time DESC';
    $start = view_langs($lang_data, $lang_count);

    //echo '<p>'; print_r($lang_data);
    $sql_translation 	= array();
    $i = 0;
    foreach($lang_data as $row)
    {
	$lang_id = request_var('lang_' . $row['id'], '');
	$translation_id = request_var('translation_' . $row['id'], '');
	$title = utf8_normalize_nfc(request_var('title_' . $row['id'], '', true));
	$description = utf8_normalize_nfc(request_var('description_' . $row['id'], '', true));
	
	$sql_translation = array(
	    'shop_id'			=> (int) $rid,
	    'translation_title'		=> (string) $title,
	    'translation_description'	=> (string) $description,
	    'language_id'		=> (string) $lang_id,
	);
	
	//if ($mode === 'add')
	if ( empty($translation_id) )
	{
	    $sql = 'INSERT INTO ' . SHOP_TRANSLATIONS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_translation);
	    
	}
	
	//if ($mode === 'update')
	if ( !empty($translation_id) )
	{
	    $sql = 'UPDATE ' . SHOP_TRANSLATIONS_TABLE . " SET " . 
	    $db->sql_build_array('UPDATE', $sql_translation) .
	    " WHERE translation_id = " .$translation_id;
	}
    
	//echo '<p>lang: ' . $sql; exit;
	$db->sql_query($sql);
	
    }

    redirect($config['admin_path'] . 'shop.' . $phpEx, $sid);
}

$detail_data = array();
$lang_data = array();
$lang_count = 0;
$keyword = 'WHERE language_enabled = 1 ';
//$sql_sort = 'log_time DESC';
$start = view_langs($lang_data, $lang_count, $keyword);

if ($mode === 'update' || $mode === 'detail')
{
    if (empty($rid))
    {
	die('Missing Shop ID. Cannot update Shop Table.');
    }
    
    $label = ($mode === 'update') ? $adm_lang['update_item'] : $adm_lang['view_item'];
    // Get service data for updating
    $sql = 'SELECT s.*, t.translation_title AS group_name FROM ' . SHOPS_TABLE . " s, " . 
	SHOP_GROUPS_TABLE. " g, " . SHOP_GROUP_TRANSLATIONS_TABLE . " t 
	WHERE s.shop_group_id=g.shop_group_id 
	AND g.shop_group_id=t.shop_group_id 
	AND t.language_id='" . $config['default_language'] . "'
	AND s.shop_id=" . (int) $rid;
    
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    
    $data_thumbnail = ($data['shop_thumbnail'])? $data['shop_thumbnail'] : '0';
    $thumbnail = $tonjaw_root_path . $config['media_path'] . $config['shop_icon_path'] . $data_thumbnail;

    $sql = 'SELECT * FROM ' . SHOP_TRANSLATIONS_TABLE . " WHERE shop_id = $rid";
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    //$detail = $db->sql_fetchrow($result);
    
    while ($detail = $db->sql_fetchrow($result))
    {
	$detail_data[$detail['language_id']] = array(
	    'translation_id'		=> $detail['translation_id'],
	    'translation_title'		=> $detail['translation_title'],
	    'translation_description'	=> $detail['translation_description'],
	);
    }
    
    $db->sql_freeresult($result);

}

if ( $pms_config['shop_item_in_pos'] )
{
    require($tonjaw_root_path . $config['pms_path'] . $pmsname . '.' . $phpEx);
    
    $pms	= new $pms_api();
    $pms->get_menu_item($data['shop_code']);
    
    foreach ($pms->menu_data as $row1)
    {
	$price = $row1['price'];
	$name = $row1['menu_name'];
    }

}
else
{
    $price = '';
    $name = '';
}

$flag_path = $tonjaw_root_path . $config['media_path'] . $config['flag_path'];

$s_hidden_fields = build_hidden_fields(array(
    'parent'	=> $parent,
    'mode'	=> $mode,
    'sid'	=> $sid,
    'module'	=> $modules,
    'id'	=> $rid)
);

$label = (!$label) ? $adm_lang['add_item'] : $label;
adm_page_header($module->active_module_name);

foreach ($lang_data as $row)
{
    //echo '<p>' . $tonjaw_root_path . $config['language_path'] . $row['id'] . ".$phpEx";
    //$data = array();
    $template->assign_block_vars('lang', array(
	'LANG_NAME'	=> $row['name']." (".$row['id'].")",	
	'L_TITLE'	=> $adm_lang['title'],
	'L_DESCRIPTION'	=> $adm_lang['description'],
	'S_DESCRIPTION'	=> $detail_data[$row['id']]['translation_description'],
	'FLAG_FILE'	=> $flag_path . $row['flag'],
	'S_LID'		=> $row['id'],
	'S_TITLE'	=> $detail_data[$row['id']]['translation_title'],
	'S_POS_NAME'	=> $name,
	'S_RID'		=> $detail_data[$row['id']]['translation_id'],
    ));
}


$template->assign_vars(array(
    'HIDE_DISPLAY_SIDE_MENU'	=> $adm_lang['hide_display_side_menu'],
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
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}shopdetail.$phpEx", "mode=add") . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
    'L_NAME'			=> $adm_lang['name'],
    'L_GROUP'			=> $adm_lang['category'],
    
    'L_CASTS'			=> $adm_lang['casts'],
    'L_DIRECTOR'		=> $adm_lang['director'],
    'L_URL'			=> $adm_lang['url'],
    'L_CODE'			=> $adm_lang['code'],
    'L_ORDER'			=> $adm_lang['order'],
    'L_ADD'			=> $adm_lang['add'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'L_ALLOW_ADS'		=> $adm_lang['allow_ads'],
    //'L_POSTER'			=> $adm_lang['poster'],
    'L_PRICE'			=> $adm_lang['price'],
    'L_THUMBNAIL'		=> $adm_lang['thumbnail'],
    'THUMBNAIL_FILE'		=> file_exists($thumbnail)? '1' : '0',
    'S_THUMBNAIL_FILE'		=> $thumbnail,
    'S_THUMBNAIL'		=> $data['shop_thumbnail'],
    'S_ORDER'			=> $data['shop_order'],
    'S_PRICE'			=> $data['shop_price'],
    'S_POS_PRICE'		=> $price,
    'S_CODE'			=> $data['shop_code'],
    'L_LABEL'			=> $label,
	'L_CURRENCY'		=> $adm_lang['currency'],
));


switch( $mode )
{
    case 'update':
    case 'add':

	$s_hidden_fields = build_hidden_fields(array(
	    'parent'	=> $parent,
	    'mode'	=> $mode,
	    'sid'	=> $sid,
	    'module'	=> $modules,
	    'id'	=> $rid)
	);

	$template->assign_vars(array(
	    //'L_NOTICE_THUMBNAIL'	=> $adm_lang['upload_thumbnail_notice'],
	    'S_THUMBNAIL'		=> $data['shop_thumbnail'],
	    'S_GROUP'			=> generate_shop_groups('group_id', $data['shop_group_id']),
	    'S_CODE'			=> $data['shop_code'],
	    'S_PRICE'			=> $data['shop_price'],
	    'S_POS_PRICE'		=> $price,
	    'S_FORM'			=> '1',
	    'S_ENABLED'			=> ($data['shop_enabled'])? 'checked' : '',
	    'S_ALLOW_ADS'		=> ($data['shop_allow_ads'])? 'checked' : '',
	    'S_ORDER'			=> $data['shop_order'],
	    'L_SUBMIT'			=> $adm_lang['submit'],
	    'S_FORM_TOKEN'		=> $s_hidden_fields,
		'S_CURRENCY'		=> generate_currency('currency', $data['shop_currency']),
	));
	
	break;
	
    case 'detail':
    	
	$template->assign_vars(array(
	    'S_GROUP'		=> $data['group_name'],
	    'S_THUMBNAIL'	=> $thumbnail,
	    'S_DETAIL'		=> '1',
	    'S_ALLOW_ADS'	=> ($data['shop_allow_ads'])? $adm_lang['yes'] : $adm_lang['no'],
	    'S_ENABLED'		=> ($data['shop_enabled'])? $adm_lang['yes'] : $adm_lang['no'],
	    'S_ORDER'		=> $data['shop_order'],
	    'L_EDIT'		=> $adm_lang['update'],
	    'U_EDIT'		=> append_sid("{$tonjaw_admin_path}shopdetail.$phpEx", "mode=update") . '&amp;id=' .$rid . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
		'S_CURRENCY'	=> $data['shop_currency'],
	));
	
	break;

}


$template->set_filenames(array(
	'body' => 'admin_shopform.tpl',
));

page_footer();

?>