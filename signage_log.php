<?php

/**
*
* signage_log.php	
*
* Agnes Emanuella, Sep 2014
*/

define('IN_TONJAW', true);
define('NEED_SID', true);
define('IN_FRONTEND', true);

$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : './';
$phpEx = substr(strrchr( $_SERVER['PHP_SELF'], '.'), 1);
$file = explode('.', substr(strrchr( $_SERVER['PHP_SELF'], '/'), 1));
$page = $file[0] . '.' . $phpEx;

// Include files
require($tonjaw_root_path . 'common.' . $phpEx);
require($tonjaw_root_path . 'fe_common.' . $phpEx);

require($tonjaw_root_path . $config['include_path'] . 'functions_admin.' . $phpEx);

$mod = $_GET['mod'];
$src = $_GET['src'];

$replace = array($config['image_signage_path'] => "", $config['clip_signage_path'] => "");
$content_source = strtr($src, $replace);

$sql = "SELECT playlist_content_id, playlist_type, COUNT(playlist_type) FROM ".SIGNAGE_PLAYLIST_CONTENT_TABLE." pc LEFT JOIN ".SIGNAGE_PLAYLIST_TABLE." p ON pc.playlist_id = p.playlist_id WHERE playlist_content_source = '".$content_source."' GROUP BY playlist_type, playlist_content_id ORDER BY playlist_content_id";
$result = $db->sql_query($sql);
while($row = $db->sql_fetchrow($result)) {
    $playlist_type = $row['playlist_type'];
    
    $type = get_playlist_type($playlist_type);
    
    $sql_ads = "SELECT s.signage_ads_id, signage_ads_name, signage_".$type[1]."_file AS source FROM ".$type[0]." s LEFT JOIN signage_ads a ON s.signage_ads_id = a.signage_ads_id WHERE signage_".$type[1]."_file = '".$content_source."'";
    $result_ads = $db->sql_query($sql_ads);
    while($row_ads = $db->sql_fetchrow($result_ads)) {
        $sql_ary = array(
            'signage_ads_id'		    => $row_ads['signage_ads_id'],
            'signage_ads_type'	        => $playlist_type,
            'signage_ads_name'	        => $row_ads['signage_ads_name'],
            'playlist_content_id'	    => $row['playlist_content_id'],
            'playlist_content_source'	=> $row_ads['source'],
            'signage_ads_log_time'	    => mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")),
        );
        
        $sql_insert = 'INSERT INTO ' . SIGNAGE_ADS_LOG_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
        $db->sql_query($sql_insert);
        
    }
}

$db->sql_freeresult($result);

echo $sql_insert;





?>