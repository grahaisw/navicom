<?php

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

require($tonjaw_root_path . $config['include_path'] . 'functions_module.' . $phpEx);

$mod = $_POST['mod'];
$id = $_POST['id'];
$type_id = $_POST['type_id'];
$is_playlist = $_POST['is_playlist'];



if($mod == "schedule") {
	$sql = "SELECT playlist_type FROM signage_playlists WHERE playlist_id = ".$id."";
	$result = $db->sql_query($sql);
	$type_id = $db->sql_fetchfield('playlist_type');
	
	$type = get_playlist_type($type_id);
	$content_type = $type[1];
	
	echo $content_type;
	
} else {
	$type = get_playlist_type($type_id);
	
	if($is_playlist) {
		$sql = "SELECT playlist_id AS id, playlist_name AS name FROM " . SIGNAGE_PLAYLIST_TABLE . " WHERE playlist_enabled = 1 AND playlist_type = '".$type_id."' ORDER BY playlist_name";
		$result = $db->sql_query($sql);
		while($row = $db->sql_fetchrow($result)) {
			$select_node .= '<option class="'.$type[1].'" value="' . $row['id'] . '" ' . $selected . '>' . $row['name'] . '</option>';
		}
	} else {
		$sql = "SELECT signage_".$type[1]."_id AS id, signage_".$type[1]."_name AS name, signage_".$type[1]."_file AS file FROM " . $type[0] . " WHERE signage_".$type[1]."_enabled = 1 ";
		$result = $db->sql_query($sql);
		while($row = $db->sql_fetchrow($result)) {
			$select_node .= '<option class="'.$type[1].'" value="' . $row['id'] . '" ' . $selected . '>' . $row['name'] . '</option>';
		}
	}
	
	echo $select_node;
}


?>