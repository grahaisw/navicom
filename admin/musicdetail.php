<?php
/**
*
* admin/musicdetail.php
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

$parent 	= request_var('parent', '');
$mode		= request_var('mode', '');
$sid 		= request_var('sid', '');
$modules	= request_var('module', '');
$mid		= request_var('id', '');

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

$u_action = $tonjaw_admin_path . 'musicdetail.' . $phpEx .'?sid=' . $sid;
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
    
}

// Preparing data
if (isset($_POST['submit']))
{
    // Preparing UPDATE PAGE TABLE
    $trailer = utf8_normalize_nfc(request_var('trailer', ''));
    $code = utf8_normalize_nfc(request_var('code', '', true));
    $casts = utf8_normalize_nfc(request_var('casts', ''));
    $director = utf8_normalize_nfc(request_var('director', ''));
    $url = utf8_normalize_nfc(request_var('url', ''));
    $gid = array();
    $gid = (isset($_REQUEST['genre_id'])) ? request_var('genre_id', array('0')) : array('0' => 0);
    $price = request_var('price', '0');
    $allow_ads_flag = request_var('allow_ads_flag', '');
    $enabled_flag = request_var('enabled_flag', '');
    $picture_name = request_var('thumbnail', '');
    
    $enabled_flag = $enabled_flag == 'on' ? '1' : '0';
    $allow_ads_flag = $allow_ads_flag == 'on' ? '1' : '0';

    	//upload file
    $filename = 'uploads/temp/' . $url;
	$filename_music = '../vod/' . $url;
	
	if(file_exists($filename)) {	

		$uploadFile = 'uploads/temp/' . basename($url);
		$handle    = fopen('uploads/temp/' . $url, "r");
		$data      = fread($handle, filesize($url));
		$POST_DATA = array(
		   //'file' => base64_encode($data)
		   'fileName' => basename($uploadFile),
	           'fileData' => base64_encode(file_get_contents($uploadFile)),
		   'type'	=> 'musics'
		);
		
		
		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, $config['vod_server'].$config['vod_path']."/handle.php");
		curl_setopt($c, CURLOPT_POST, 1);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($c, CURLOPT_POSTFIELDS, $POST_DATA);
		
		$response = curl_exec($c);
		//echo $response; exit;
		//curl_close($c);
		//fclose($fp); 
	
		if ($response == "Success") $uploaded = true;
		else $uploaded = false;

		
		// Delete files in temporary folder
		if($uploaded) {
		$files = glob('uploads/temp/*'); //get all file names
		foreach($files as $file){
			if(is_file($file))
			unlink($file); //delete file
		}
		}
	}
    
    $sql_ary = array(
	    'music_trailer'	=> $trailer,
	    'music_casts'	=> $casts,
	    'music_director'	=> $director,
	    'music_url'		=> $url,
	    'music_enabled'	=> (int) $enabled_flag,
	    'music_allow_ads'	=> (int) $allow_ads_flag,
	    'music_price'	=> (int) $price,
	    'music_thumbnail'	=> $picture_name,
	    'music_code'	=> (string) $code,
	    'music_code'	=> (string) $code,
     );
    /*
    // Preparing upload poster file
    $path = $tonjaw_root_path . $config['media_path'] . $config['music_icon_path'];
    $can_upload = (file_exists($tonjaw_root_path . $config['media_path'] . $config['music_icon_path']) && tonjaw_is_writable($path) && (@ini_get('file_uploads') || strtolower(@ini_get('file_uploads')) == 'on')) ? true : false;
    */
    //echo 'path: ' . $path . '<br>' . $can_upload; exit;
    
    if ($mode === 'add')
    {
	$error = '';
	$error_msg = '';

	/*    
	if ((!empty($_FILES['uploadfile']['name'])) && $can_upload)
	{
	    //echo 'siap upload'; exit;
	    require_once($tonjaw_root_path . $config['include_path'] . 'functions_image.' . $phpEx);

	    //$filetype = explode('.', $_FILES['uploadfile']['name']);
	    $newfilename = $_FILES['uploadfile']['name'];//$lang_id . '.' . $filetype[1];
	    
	    $picture_name = upload_image($error, $error_msg, $newfilename, $_FILES['uploadfile']['tmp_name'], $_FILES['uploadfile']['size'], $_FILES['uploadfile']['type'], $path, 'poster');
	    //list($sql_ary['user_avatar_type'], $sql_ary['language_flag'], $sql_ary['user_avatar_width'], $sql_ary['user_avatar_height']) = image_upload('flag', $lang_id, $error);
	}
	else
	{
	    die('file kosong atau ga bs nulis');
	}
	*/
	if ( $error )
	{
	    die($error_msg);
	}
    
	//$sql_ary['music_thumbnail'] = $picture_name;
		
	$sql = 'INSERT INTO ' . MUSIC_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	// echo $sql; exit;
	$db->sql_query($sql);
	$mid = $db->sql_nextid();
	
    }

    if ($mode === 'update')
    {

    	 $sql4 ='select music_url from '.MUSIC_TABLE.' where music_id = '.$mid.'';
      // echo $sql4;exit();
    $result= $db->sql_query($sql4);
    
    $music = $db->sql_fetchfield('music_url');
    // echo $music;exit();
    // Delete files in temporary folder
      		$c = curl_init();
          	curl_setopt($c, CURLOPT_URL, $config['vod_server'].$config['vod_path']."/handle.php?mod=delete&type=musics&file=".$music);
                curl_setopt($c, CURLOPT_POST, 1);
                curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($c, CURLOPT_POSTFIELDS, $POST_DATA);

                $response = curl_exec($c);
                //echo $response; exit;
                //curl_close($c);

	$sql = 'UPDATE ' . MUSIC_TABLE . " SET " . 
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE music_id = $mid";
	$db->sql_query($sql);
	
	// Remove old data from music grouping table
	$sql = 'DELETE FROM ' . MUSIC_GROUPINGS_TABLE . "
	    WHERE music_id = $mid";
	$db->sql_query($sql);
	
    }
    // echo $gid; exit;
    //Insert new data to music_grouping table
    foreach($gid as $key => $val)
    {
	$sql_ary = array(
	    'music_id'		=> $mid,
	    'music_group_id'	=> $val,
	);
	 
	$sql = 'INSERT INTO ' . MUSIC_GROUPINGS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	  // print_r($sql);exit(); 
	    // echo $sql . 'master<p>'; //exit;
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
	    'music_id'			=> (int) $mid,
	    'translation_title'		=> (string) $title,
	    'translation_description'	=> (string) $description,
	    'language_id'		=> (string) $lang_id,
	);
	
	//if ($mode === 'add')
	if ( empty($translation_id) )
	{
	    $sql = 'INSERT INTO ' . MUSIC_TRANSLATIONS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_translation);
	    
	}
	
	//if ($mode === 'update')
	if ( !empty($translation_id) )
	{
	    $sql = 'UPDATE ' . MUSIC_TRANSLATIONS_TABLE . " SET " . 
	    $db->sql_build_array('UPDATE', $sql_translation) .
	    " WHERE translation_id = " .$translation_id;
	}
    
	//echo '<p>lang: ' . $sql; exit;
	$db->sql_query($sql);
	
    }

    redirect($config['admin_path'] . 'music.' . $phpEx, $sid);
}

$detail_data = array();
$lang_data = array();
$lang_count = 0;
$keyword = 'WHERE language_enabled = 1 ';
//$sql_sort = 'log_time DESC';
$start = view_langs($lang_data, $lang_count, $keyword);

if ($mode === 'update' || $mode === 'detail')
{
    if (empty($mid))
    {
	die('Missing music ID. Cannot update music Table.');
    }
    
    $label = ($mode === 'update') ? $adm_lang['update_item'] : $adm_lang['view_item'];
    // Get music data for updating
    $sql = 'SELECT * FROM ' . MUSIC_TABLE . " WHERE music_id=" . (int) $mid;
    
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    
    $data_thumbnail = ($data['music_thumbnail'])? $data['music_thumbnail'] : '0';
    $thumbnail = $tonjaw_root_path . $config['media_path'] . $config['music_icon_path'] . $data_thumbnail;
    $data_trailer = ($data['music_trailer'])? $data['music_trailer'] : '0';
    $trailer =  $tonjaw_root_path . $config['media_path'] . $config['trailer_path'] . $data_trailer;
    
    $sql = 'SELECT g.music_group_id, t.translation_title FROM ' . MUSIC_GROUPINGS_TABLE . " g, " . 
	MUSIC_GROUP_TRANSLATIONS_TABLE . " t WHERE g.music_id = $mid AND g.music_group_id=t.music_group_id 
	AND t.language_id = '" . $config['default_language'] ."'";
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    //$detail = $db->sql_fetchrow($result);
    
    $i = 0;
    while ($detail = $db->sql_fetchrow($result))
    {
	$group_data[$i] = array(
	    'music_group_id'	=> $detail['music_group_id'],
	    'genre_name'	=> $detail['translation_title'],
	);
	
	$i++;

    }
    
    $db->sql_freeresult($result);
    
    // print_r($group_data); exit;
    
    $sql = 'SELECT * FROM ' . MUSIC_TRANSLATIONS_TABLE . " WHERE music_id = $mid";
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

$flag_path = $tonjaw_root_path . $config['media_path'] . $config['flag_path'];

$s_hidden_fields = build_hidden_fields(array(
    'parent'	=> $parent,
    'mode'	=> $mode,
    'sid'	=> $sid,
    'module'	=> $modules,
    'id'	=> $mid)
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
	'S_MID'		=> $detail_data[$row['id']]['translation_id'],
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
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}musicdetail.$phpEx", "mode=add") . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
    'L_TITLE'			=> $adm_lang['title'],
    'L_CODE'			=> $adm_lang['code'],
    'L_CASTS'			=> $adm_lang['casts'],
    'L_DIRECTOR'		=> $adm_lang['director'],
    'L_GENRE'			=> $adm_lang['genre'],
    'L_URL'			=> $adm_lang['url'],
    'L_TRAILER'			=> $adm_lang['trailer'],
    'L_ADD'			=> $adm_lang['add'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'L_ALLOW_ADS'		=> $adm_lang['allow_ads'],
    'L_POSTER'			=> $adm_lang['poster'],
    'L_PRICE'			=> $adm_lang['price'],
    'L_THUMBNAIL'		=> $adm_lang['poster'],
    'POSTER_FILE'		=> file_exists($thumbnail)? '1' : '0',
    'S_POSTER_FILE'		=> $thumbnail,
    'S_THUMBNAIL'		=> $data['music_thumbnail'],
    'S_DIRECTOR'		=> $data['music_director'],
    'S_CASTS'			=> $data['music_casts'],
    'S_URL'			=> $data['music_url'],
    'S_PRICE'			=> $data['music_price'],
    'S_CODE'			=> $data['music_code'],
    'L_LABEL'			=> $label,
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
	    'id'	=> $mid)
	);


	$template->assign_vars(array(
	    'L_NOTICE_THUMBNAIL'	=> $adm_lang['upload_thumbnail_notice'],
	    'S_THUMBNAIL'		=> $data['music_thumbnail'],
	    'S_GENRE'			=> generate_music_genre('genre_id[]', $mid, $group_data),
	    
	    'S_FORM'			=> '1',
	    'S_ENABLED'			=> ($data['music_enabled'])? 'checked' : '',
	    'S_ALLOW_ADS'		=> ($data['music_allow_ads'])? 'checked' : '',
	    'S_TRAILER'			=> $data['music_trailer'],
	    'L_SUBMIT'			=> $adm_lang['submit'],
	    'S_FORM_TOKEN'		=> $s_hidden_fields,
	    'S_MUSIC' => 1,
	));
	
	break;
	
    case 'detail':
    
	
	
	$template->assign_vars(array(
	    'S_GENRE'		=> get_music_genre($config['default_language'], $mid),
	    'S_POSTER'		=> $thumbnail,
	    'S_DETAIL'		=> '1',
	    'S_ALLOW_ADS'	=> ($data['music_allow_ads'])? $adm_lang['yes'] : $adm_lang['no'],
	    'S_ENABLED'		=> ($data['music_enabled'])? $adm_lang['yes'] : $adm_lang['no'],
	    'S_TRAILER'		=> $trailer,
	    'L_EDIT'		=> $adm_lang['update'],
	    'U_EDIT'		=> append_sid("{$tonjaw_admin_path}musicdetail.$phpEx", "mode=update") . '&amp;id=' .$mid . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
	));
	
	break;
	
}

// echo $file[0]; exit;
$template->set_filenames(array(
	'body' => 'admin_musicform.tpl',
));

page_footer();

?>
