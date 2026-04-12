<?php
/**
*
* signage.php	
*
* Agnes Emanuella, Jul 2014
*/

//header('location: main.php');
//exit;

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

$config['template_path'] = $config['style_path'] . 'signage' . '/template';
$config['theme_path'] = $config['style_path'] . 'signage' . '/theme';
$config['imageset_path'] = $config['style_path'] . 'signage' . '/imageset';

// GRAB DIGITAL SIGNAGE
$template_data = array();
$signage_data = array();

$sql = "SELECT t.template_id, t.template_name FROM ".SIGNAGE_TEMPLATES_TABLE." t LEFT JOIN ".SIGNAGES_TABLE." s ON t.template_id = s.template_id LEFT JOIN ".SIGNAGE_ROOM_GROUPINGS_TABLE." g ON s.signage_id = g.signage_id LEFT JOIN ".NODES_TABLE." n ON g.room_id = n.room_id WHERE t.template_enabled = 1 AND n.node_ip = '" . $session->ip . "' AND s.signage_enabled = 1";

//echo $sql; exit;
$result = $db->sql_query($sql);
$i = 0;

while ($row = $db->sql_fetchrow($result))
{
    $template_data[$i] = array(
        'id'        => $row['template_id'],
        'name'      => $row['template_name'],	
    );

    $i++;
}

$db->sql_freeresult($result);

$template_id = $template_data[0]['id'];
$template_name = $template_data[0]['name'] ? $template_data[0]['name'] : 'default';

$sql = "SELECT g.signage_id, re.region_position, g.playlist_id, g.default_source, g.default_type, n.node_name
    FROM ".SIGNAGE_REGION_GROUPINGS_TABLE." g LEFT JOIN ".SIGNAGES_TABLE." s ON g.signage_id = s.signage_id LEFT JOIN ".SIGNAGE_TEMPLATES_TABLE." t ON s.template_id = t.template_id LEFT JOIN ".SIGNAGE_ROOM_GROUPINGS_TABLE." r ON s.signage_id = r.signage_id LEFT JOIN ".NODES_TABLE." n ON r.room_id = n.room_id LEFT JOIN signage_regions re ON g.region_id = re.region_id
    WHERE n.node_ip = '".$session->ip."' AND s.signage_enabled = 1
    ORDER BY g.region_id";

//echo $sql; exit;
$result = $db->sql_query($sql);
$i = 0;
$data = array();

while ($row = $db->sql_fetchrow($result))
{
    $signage_data[$i] = array(
        'signage_id'        => $row['signage_id'],
        'region_position'   => $row['region_position'],
        'playlist_id'       => $row['playlist_id'],        
        'default_source'    => $row['default_source'],
        'default_type'      => $row['default_type'],
    );

    $region_position = $signage_data[$i]['region_position'];
    $default_type = $signage_data[$i]['default_type'];
    $default_source = $signage_data[$i]['default_source'];
    $playlist_id = $signage_data[$i]['playlist_id'];

    if(strtolower($default_type) == "rss") {
        $rss_index = $i;
        $data[$region_position] = get_rss_data($default_source);
    } else {
        $rss_index = -1;
        $data[$region_position] = get_signage_data($default_type, $default_source, $playlist_id, $region_position);
    }

    $i++;

}

$db->sql_freeresult($result);
//$a = date("Y-m-d H:i");
//$b = mktime(13,0,0,8,19,2014);
//echo $data[1]['type']; exit;
//print_r($data);exit;

$image_signage_path = $tonjaw_root_path . $config['media_signage_path']; 


$query_mb= "SELECT  background_music_url from background_music where background_music_enabled = 1";
 $hasil = $db->sql_query($query_mb);
 $roww = $db->sql_fetchrow($hasil);
 $test = $roww['background_music_url'];
 $daniel = $config['vod_server'] . '/vod/music_backgrounds/'. $test .'';
// Generate the page
$template->set_template();
page_header($lang_id, $page);

/*foreach ($data[2]['content'] as $rows)
{   
    $template->assign_block_vars('digitalsignage', array(
        'CONTENT'		=> $rows,
    ));

}*/

$template->assign_vars(array(
    'L_NOTICE'		=> '',
    'S_DIGITALSIGNAGE'	=> '1',
    'S_ONMOUSEDOWN'	=> '',
    'S_TEMPLATE'        => strtolower($template_name).'.tpl',
    'S_TEMPLATE_NAME'   => ($template_name == 'default') ? strtolower($template_name) : 'tpl_'.strtolower($template_name),
    //'S_TEMPLATE'      => 'urgency.tpl',
    'S_CONTENT_1'       => $data[1]['content'],
    'S_DURATION_1'      => $data[1]['duration'],
    'S_TYPE_1'          => $data[1]['type'],
    'S_HEADER_1'        => $data[1]['header'],
    'S_CONTENT_2'       => $data[2]['content'],
    'S_DURATION_2'      => $data[2]['duration'],
    'S_TYPE_2'          => $data[2]['type'],
    'S_HEADER_2'        => $data[2]['header'],
    'S_CONTENT_3'       => $data[3]['content'],
    'S_DURATION_3'      => $data[3]['duration'],
    'S_TYPE_3'          => $data[3]['type'],
    'S_HEADER_3'        => $data[3]['header'],
    'S_CONTENT_4'       => $data[4]['content'],
    'S_DURATION_4'      => $data[4]['duration'],
    'S_TYPE_4'          => $data[4]['type'],
    'S_HEADER_4'        => $data[4]['header'],
    'S_CONTENT_5'       => $data[5]['content'],
    'S_DURATION_5'      => $data[5]['duration'],
    'S_TYPE_5'          => $data[5]['type'],
    'S_HEADER_5'        => $data[5]['header'],
    //'S_CLIPS_COUNT'   => $data[2]['count'],
    'S_RSS'             => ($data[4]['type'] == "rss") ? '1' : '0',
    'S_IMAGE'           => ($data[4]['type'] == "image") ? '1' : '0',
'S_MB'               => $daniel,
));

//echo 'crot: ' . $template_name; exit;
$template->set_filenames(array(
	'body' => 'signage.tpl',
));

//add_log($adm_lang['read']);
page_footer();

?>