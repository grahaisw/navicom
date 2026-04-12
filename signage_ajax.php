<?php

/**
*
* signage_ajax.php	
*
* Agnes Emanuella, Aug 2014
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

//require($tonjaw_root_path . $config['include_path'] . 'functions.' . $phpEx);
$mod = $_GET['mod'];
if($mod == "playlist") {
    global $db, $config; 
    $table_join = "".SIGNAGE_CONTENT_SCHEDULE_TABLE." s LEFT JOIN ".SIGNAGE_PLAYLIST_CONTENT_TABLE." p ON s.playlist_id = p.playlist_id LEFT JOIN ".SIGNAGE_REGION_GROUPINGS_TABLE." g ON s.signage_region_grouping_id = g.signage_region_grouping_id LEFT JOIN ".SIGNAGE_REGIONS_TABLE." r ON g.region_id = r.region_id LEFT JOIN ".SIGNAGE_PLAYLIST_TABLE." l ON s.playlist_id = l.playlist_id LEFT JOIN ".SIGNAGE_ROOM_GROUPINGS_TABLE." rg ON g.signage_id = rg.signage_id LEFT JOIN ".NODES_TABLE." n ON n.room_id = rg.room_id";
    $sql = "SELECT COUNT(*) AS total_row FROM ".$table_join." WHERE signage_content_schedule_enabled = 1 AND signage_content_schedule_start = '".mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"))."'";
    $result = $db->sql_query($sql);
    $row_count = (int) $db->sql_fetchfield('total_row');
    $db->sql_freeresult($result);
    if($row_count > 0) {
        $sql = "SELECT r.region_position AS pos FROM ".$table_join." WHERE signage_content_schedule_enabled = 1 AND signage_content_schedule_start = '".mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"))."' GROUP BY r.region_position ORDER BY r.region_position";
        $result_position = $db->sql_query($sql);
        $content = array();
        $i = 0;        while($row_position = $db->sql_fetchrow($result_position)) {
            $content_source = "";
            $content_end = "";
            $position = "";
            $sql = "SELECT p.playlist_content_source, s.signage_content_schedule_end, l.playlist_duration, l.playlist_type, s.signage_content_schedule_fullscreen FROM ".$table_join." WHERE signage_content_schedule_enabled = 1 AND signage_content_schedule_start = '".mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"))."' AND r.region_position = ".$row_position['pos']." AND n.node_mac = '".$session->mac."' ORDER BY p.playlist_content_id";
            $result = $db->sql_query($sql);
            while($row = $db->sql_fetchrow($result)) {
                if($row['playlist_type'] == 2) { // jika running text
                    if($content_source != "") $content_source .= '<img src="'.$config['text_signage_path'].'separator.png" height="20" style="margin:0 15px" />';
                } else {
                    if($content_source != "") $content_source .= "|";
                }
                $content_source .= $row['playlist_content_source'];
                $content_end = date("Y-m-d H:i", $row['signage_content_schedule_end']);
                $position = $row_position['pos'];
                $content_duration = $row['playlist_duration'] * 1000;				$is_fullscreen = $row['signage_content_schedule_fullscreen'];
            }
            $source = array(0 => $content_source, 1 => $content_end, 2 => $position, 3 => $content_duration, 4 => $is_fullscreen);
            $src = implode("^", $source);
            $content[$i] = $src;
            $i++;
            
        }
        $output = implode(";", $content);
    }
    echo $output;
} else if($mod == "default") {
    global $db, $config;
    $sql = "SELECT g.signage_id, re.region_position, g.playlist_id, g.default_source, g.default_type, n.node_name
    FROM ".SIGNAGE_REGION_GROUPINGS_TABLE." g LEFT JOIN ".SIGNAGES_TABLE." s ON g.signage_id = s.signage_id LEFT JOIN ".SIGNAGE_TEMPLATES_TABLE." t ON s.template_id = t.template_id LEFT JOIN ".SIGNAGE_ROOM_GROUPINGS_TABLE." r ON s.signage_id = r.signage_id LEFT JOIN ".NODES_TABLE." n ON r.room_id = n.room_id LEFT JOIN signage_regions re ON g.region_id = re.region_id
    WHERE n.node_ip = '".$session->ip."' AND s.signage_enabled = 1
    ORDER BY g.region_id";    	
    $result = $db->sql_query($sql);
    $content = array();
    $i = 0;
    while($row = $db->sql_fetchrow($result)) {
        $data = "";
        if($row['playlist_id'] != "" && $row['playlist_id'] > 0) {
            $sqlPlaylist = "SELECT playlist_content_id, playlist_content_source, p.playlist_duration FROM ".SIGNAGE_PLAYLIST_CONTENT_TABLE." c LEFT JOIN ".SIGNAGE_PLAYLIST_TABLE." p ON c.playlist_id = p.playlist_id WHERE c.playlist_id = ".$row['playlist_id']." ORDER BY playlist_content_id";
            $resultPlaylist = $db->sql_query($sqlPlaylist);            
            $j = 0;            $playlist = array();            
            while($rowPlaylist = $db->sql_fetchrow($resultPlaylist)) {
                $playlist[$j] = array(
                    'source'    => $rowPlaylist['playlist_content_source'],	
                );                
                $duration = $rowPlaylist['playlist_duration'] * 1000;
                $j++;                
            }            
            for($k=0; $k<count($playlist); $k++) {
                if($data != "") $data .= "|";
                $data .= $playlist[$k]['source'];
            }            
            $position = $row['region_position'];
            $source = array(0 => trim($data), 1 => $position, 2 => $duration, 3 => strtolower($row['default_type']));
            $src = implode("^", $source); 
            $content[$i] = $src;        
        } else {
            if(strtolower($row['default_type']) == "rss") {
                if(substr($row['default_source'],0,2) == "DB") { 					$def_source = explode("-", $row['default_source']);					$table = $def_source[1];					$rss_data = array();					$limit = 15;					$con = "";										$sql = "SELECT * FROM ".$table."";					$result = $db->sql_query($sql);					$total_data = $db->get_row_count($table);										switch($table) {						case 'airport_fids'	: 								$head = array("Airline", "Flight", "Destination", "Scheduled Time", "Terminal", "Gate", "Remark");								break;												case 'signage_generals'	: 								$head = array("Date", "Title", "Description");								break;					}										$i = 1;					$j = 0;					while($item = $db->sql_fetchrow($result)) {						switch($table) {							case 'airport_fids'	: 									$con .= '<tr><td>'.$item['fids_airline'].'</td><td>'.$item['fids_flight'].'</td><td>'.$item['fids_city'].'</td><td align=\'left\'>'.$item['fids_time'].'</td><td align=\'left\'>'.$item['fids_terminal'].'</td><td align=\'left\'>'.$item['fids_gate'].'</td><td align=\'left\'>'.$item['fids_remark'].'</td></tr>';									break;														case 'signage_generals'	: 									$con .= '<tr><td>'.date($config['header_dateformat'], $item['signage_general_date']).'</td><td>'.$item['signage_general_title'].'</td><td>'.$item['signage_general_remark'].'</td></tr>';									break;						}						$rss_data[$j] = $con;												if($total_data >= $limit) {							if($i < $total_data) {								if(($i % $limit)==0) { 									$rss_data[$j] = $con; 									$j++;									$con = "";								}							} else if($i == $total_data) {								$rss_data[$j] = $con;							}						} else {							$rss_data[$j] = $con;						}												$i++;					}					$header = implode("|", $head);					$con = implode("|", $rss_data);					$default_source = $con;									} else {					$url = $config['rss_signage_path'].$row['default_source'];
					//$url = $row['default_source'];
					$rss = simplexml_load_file($url);
					if($rss) {						if($row['default_source'] == 'fids.xml') {
							$con = "";
							$rss_data = array();							$limit = 10;														$items = $rss->Departure->Record;  							$total_data = count($items);                         														$head = array("FlightID", "Destination", "Time", "Gate", "Remark");														$i = 1;							$j = 0;							foreach($items as $item) {
								$airline = $item->Airline;								$flightnum = $item->FlightID;								$destination = $item->Destination;								$time = $item->Time;								$gate = $item->Gate;								$remarks = $item->Remark;								$con .= '<tr><td>'.$flightnum.'</td><td>'.$destination.'</td><td align="left">'.$time.'</td><td align="left">'.$gate.'</td><td align="left">'.$remarks.'</td></tr>';																if($total_data >= $limit) {									if($i < $total_data) {										if(($i % $limit)==0) { 											$rss_data[$j] = $con; 											$j++;											$con = "";										}									} else if($i == $total_data) {										$rss_data[$j] = $con;									}								} else {									$rss_data[$j] = $con;								}																$i++;
							}							$header = implode("|", $head);
							$con = implode("|", $rss_data);							$default_source = $con;							
						} else {							$con = "";														$items = $rss->channel->item;														foreach($items as $item) {								$title = $item->title;								$con .= $title."<br/><br/>";							}						}					}				}
            } else {
                $default_source = $row['default_source'];				
            }
            $position = $row['region_position'];
            $duration = 0;			
            $source = array(0 => trim($default_source), 1 => $position, 2 => $duration, 3 => strtolower($row['default_type']), 4 => $header);     
            $src = implode("^", $source); 
            $content[$i] = $src;        
        }
        $i++;
    }	
    $output = implode(";", $content);    
    echo $output;
} else if($mod == "urgency") {
    global $db, $config;
    $urgency_type = array("emergency", "fids");
    for($i=0; $i<count($urgency_type); $i++) {
        $sql = "SELECT COUNT(u.signage_urgency_id) AS total_row FROM ".SIGNAGE_URGENCIES_TABLE." u LEFT JOIN ".SIGNAGE_URGENCY_ROOM_GROUPINGS_TABLE." g ON u.signage_urgency_id = g.signage_urgency_id LEFT JOIN ".NODES_TABLE." n ON g.room_id = n.room_id WHERE signage_urgency_enabled = 1 AND signage_urgency_flag = '".$urgency_type[$i]."' AND n.node_mac = '".$session->mac."'";
        $result = $db->sql_query($sql);
        $total_row = (int) $db->sql_fetchfield('total_row');
        $db->sql_freeresult($result);       
        if($total_row > 0) {
            $sql = "SELECT * FROM ".SIGNAGE_URGENCIES_TABLE." u LEFT JOIN ".SIGNAGE_URGENCY_ROOM_GROUPINGS_TABLE." g ON u.signage_urgency_id = g.signage_urgency_id LEFT JOIN ".NODES_TABLE." n ON g.room_id = n.room_id WHERE signage_urgency_enabled = 1 AND signage_urgency_flag = '".$urgency_type[$i]."' AND n.node_mac = '".$session->mac."' ORDER BY signage_urgency_priority_order ASC";
            $result = $db->sql_query($sql);            
            while($row = $db->sql_fetchrow($result)) {
                $flag = $row['signage_urgency_flag'];
                $enabled = $row['signage_urgency_enabled'];
                $duration = $row['signage_urgency_duration'];
                $stop = date("Y-m-d H:i:s", mktime(date("H"),date("i"),date("s")+$duration,date("m"),date("d"),date("Y")));
                $airline_image = "";
                if($row['signage_urgency_airline'] != NULL) {
                    $airline = str_replace(" ", "_", strtolower($row['signage_urgency_airline'])).".png";
                    $airline_image = $config['image_signage_path'].$airline;
                }
                if($output != "") $output .= ',';
                $output .=  '{"flag":"'.$row['signage_urgency_flag'].'","enabled":"'.$row['signage_urgency_enabled'].'","stoptime":"'.$stop.'","airline":"'.$airline_image.'","flight_number":"'.$row['signage_urgency_flight_no'].'","destination":"'.ucfirst($row['signage_urgency_destination']).'","gate":"Gate '.$row['signage_urgency_departure_gate'].'","time":"'.$row['signage_urgency_departure_time'].'","message":"'.ucfirst($row['signage_urgency_message']).'","order":"'.$row['signage_urgency_priority_order'].'","display":"'.$row['signage_urgency_display'].'","id":"'.$row['signage_urgency_id'].'"}';
            }
            
            $db->sql_freeresult($result);
            break;
        } 
    }    echo $output;    
} else if($mod == "urgencystop") {
    $id = $_GET['id'];
    $sql = "UPDATE ".SIGNAGE_URGENCIES_TABLE." SET signage_urgency_enabled = 0 WHERE signage_urgency_id = ".$id."";
    $db->sql_query($sql);		$sql = "SELECT signage_urgency_display FROM ".SIGNAGE_URGENCIES_TABLE." WHERE signage_urgency_id = ".$id."";    $result = $db->sql_query($sql);	$display = $db->sql_fetchfield('signage_urgency_display');
    echo $display;
} 
?>