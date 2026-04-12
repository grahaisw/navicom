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

$u_action = $tonjaw_admin_path . 'music_backgrounddetail.' . $phpEx .'?sid=' . $sid;
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
    $title = utf8_normalize_nfc(request_var('title', ''));
    $url = utf8_normalize_nfc(request_var('url', ''));

    $nid = array();
    $nid = (isset($_REQUEST['node_id'])) ? request_var('node_id', array('0')) : array('0' => '1');
    // $gid = array();
    // $gid = (isset($_REQUEST['genre_id'])) ? request_var('genre_id', array('0')) : array('0' => 'crottt');
    $price = request_var('price', '0');
    $allow_ads_flag = request_var('allow_ads_flag', '');
    $enabled_flag = request_var('enabled_flag', '');
    $picture_name = request_var('thumbnail', '');
    
    $enabled_flag = $enabled_flag == 'on' ? '1' : '0';
    // $allow_ads_flag = $allow_ads_flag == 'on' ? '1' : '0';

   	//upload file
   	 // $filename = $tonjaw_admin_path . '/../../../../vod/temp/' . $url;
	$filename = 'uploads/temp/' . $url;
    	// $filename_music = $tonjaw_admin_path . '/../../../../vod/lagu/' . $url;
	$filename_music = '../vod/' . $url;
	 //echo $filename;exit();
	
	if(file_exists($filename)) {	

		$uploadFile = 'uploads/temp/' . basename($url);
		$handle    = fopen('uploads/temp/' . $url, "r");
		$data      = fread($handle, filesize($url));
		$POST_DATA = array(
		   //'file' => base64_encode($data)
		   'fileName' => basename($uploadFile),
	           'fileData' => base64_encode(file_get_contents($uploadFile)),
		   'type'	=> 'music_backgrounds'
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
	    'background_music_title'	=> $title,
	    'background_music_url'		=> $url,
	    'background_music_enabled'	=> (int) $enabled_flag,
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
		
	$sql = 'INSERT INTO ' . BACKGROUND_MUSIC_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	// echo $sql; exit;
	$db->sql_query($sql);
	$mid = $db->sql_nextid();
	
    }

    if ($mode === 'update')
    {	
    	// echo "string";exit();

    	 	 $sql4 ='select background_music_url from background_music where background_music_id = '.$mid.'';
      // echo $sql4;exit();
    $result= $db->sql_query($sql4);
    
    $music = $db->sql_fetchfield('background_music_url');
    // echo $music;exit();
    // Delete files in temporary folder
        /*$files = glob($config['vod_server'].$config['vod_path'].'/music_backgrounds/'.$music.''); //get all file names
        foreach($files as $file){
            if(is_file($file))
            unlink($file); //delete file
        }*/

		$c = curl_init();
          	curl_setopt($c, CURLOPT_URL, $config['vod_server'].$config['vod_path']."/handle.php?mod=delete&type=music_backgrounds&file=".$music);
                curl_setopt($c, CURLOPT_POST, 1);
                curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($c, CURLOPT_POSTFIELDS, $POST_DATA);

                $response = curl_exec($c);
                //echo $response; exit;
                //curl_close($c);


// echo "string";exit();
	$sql = 'UPDATE ' . BACKGROUND_MUSIC_TABLE . " SET " . 
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE background_music_id = $mid";
	$db->sql_query($sql);
	// echo "string";exit();
	// Remove old data from music grouping table
	$sql2 = 'DELETE FROM ' . BACKGROUND_MUSIC_GROUPINGS_TABLE . "
	    WHERE background_music_id = $mid";
	$db->sql_query($sql2);
	
    }
    // echo $gid; exit;
    //Insert new data to music_grouping table
    foreach($nid as $key => $val)
    {
	$sql_ary = array(

	    'node_id'		=> $nid,
	    'background_music_id'	=> $mid,
	);
	 
	$sql = 'INSERT INTO ' . BACKGROUND_MUSIC_GROUPINGS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	  // print_r($sql);exit(); 
	    // echo $sql . 'master<p>'; //exit;
	$db->sql_query($sql);
	
    }
    


    redirect($config['admin_path'] . 'music_background.' . $phpEx, $sid);
}

//GRAB music DATA
$music_data = array();
$music_count = 0;
//$sql_sort = 'log_time DESC';
$start = grab_backgroundmusic($music_data, $music_count);

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
    $sql = 'SELECT * FROM ' . BACKGROUND_MUSIC_TABLE . " WHERE background_music_id=" . (int) $mid;
    
    // echo $sql; exit;
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
   
    $data_thumbnail = ($data['music_thumbnail'])? $data['music_thumbnail'] : '0';
    $thumbnail = $tonjaw_root_path . $config['media_path'] . $config['music_icon_path'] . $data_thumbnail;
    $data_trailer = ($data['music_trailer'])? $data['music_trailer'] : '0';
    $trailer =  $tonjaw_root_path . $config['media_path'] . $config['trailer_path'] . $data_trailer;
    
    $sql2 = 'SELECT node_id FROM ' . BACKGROUND_MUSIC_GROUPINGS_TABLE . ' where background_music_id = '. $mid .'' ;
    // echo $sql2; exit;
    $result = $db->sql_query($sql2);
    // $detail = $db->sql_fetchrow($result);
    
    $i = 0;
    while ($detail = $db->sql_fetchrow($result))
    {
	$group_data[$i] = array(
	    'background_music_id'	=> $detail['background_music_id'],
	    'node_id'	=> $detail['node_id'],
	);
	
	$i++;

    }
    
    
    // print_r($group_data[i]); exit;
    
 
    
    $db->sql_freeresult($result);

}
$foreign_id = ($mid)? $mid : 0;
$flag_path = $tonjaw_root_path . $config['media_path'] . $config['flag_path'];

$s_hidden_fields = build_hidden_fields(array(
    'parent'	=> $parent,
    'mode'	=> $mode,
    'sid'	=> $sid,
    'module'	=> $modules,
    'id'	=> $mid)
);
// print_r($music_data);exit();

$label = (!$label) ? $adm_lang['add_item'] : $label;
adm_page_header($module->active_module_name);

// foreach ($music_data as $row)
// {
//     //echo '<p>' . $tonjaw_root_path . $config['language_path'] . $row['id'] . ".$phpEx";
//     //$data = array();
//     $template->assign_block_vars('music', array(
// 	'LANG_NAME'	=> $row['name']." (".$row['id'].")",	
// 	'L_TITLE'	=> $adm_lang['title'],
// 	'L_DESCRIPTION'	=> $adm_lang['description'],
// 	'S_DESCRIPTION'	=> $detail_data[$row['id']]['translation_description'],
// 	'FLAG_FILE'	=> $flag_path . $row['flag'],
// 	'S_LID'		=> $row['id'],
// 	'S_TITLE'	=> $row['title'],
// 	'S_MID'		=> $detail_data[$row['id']]['translation_id'],
//     ));
// }


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
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}music_backgrounddetail.$phpEx", "mode=add") . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
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
    'L_LABEL'			=> $label,
    'S_MUSIC' => 1,
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
	    'S_TITLE'		=> $data['background_music_title'],
	    // 'S_GENRE'			=> generate_music_genre('genre_id[]', $mid, $group_data),
	    'S_NODE'			=> background_node('node_id[]', $foreign_id),
	    'S_FORM'			=> '1',
	    'S_ENABLED'			=> ($data['background_music_enabled'])? 'checked' : '',
	    'S_ALLOW_ADS'		=> ($data['music_allow_ads'])? 'checked' : '',
	    'S_TRAILER'			=> $data['music_trailer'],
	    'L_SUBMIT'			=> $adm_lang['submit'],
	    'S_FORM_TOKEN'		=> $s_hidden_fields,
	    'S_URL'			=> $data['background_music_url'],
	));
	
	break;
	
    case 'detail':
    
	
	
	$template->assign_vars(array(
	    'S_GENRE'		=> get_music_genre($config['default_language'], $mid),
	    'S_POSTER'		=> $thumbnail,
	    // 'S_NODE'			=> generate_music_background('node_id[]', $foreign_id),
	    'S_DETAIL'		=> '1',
	    'S_ALLOW_ADS'	=> ($data['music_allow_ads'])? $adm_lang['yes'] : $adm_lang['no'],
	    'S_ENABLED'		=> ($data['background_music_enabled'])? $adm_lang['yes'] : $adm_lang['no'],
	    'S_TRAILER'		=> $trailer,
	    'L_EDIT'		=> $adm_lang['update'],
	    'U_EDIT'		=> append_sid("{$tonjaw_admin_path}musicdetail.$phpEx", "mode=update") . '&amp;id=' .$mid . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
	));
	
	break;
	
}

// echo $file[0]; exit;
$template->set_filenames(array(
	'body' => 'admin_musicbackgroundform.tpl',
));

page_footer();

?>
