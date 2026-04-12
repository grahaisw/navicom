<?php
/**
*
* proc/grab_weather.php
*
* Roberto Tonjaw. Feb 2014
*/

/**
*/
define('IN_TONJAW', true);

$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : './../';
$phpEx = substr(strrchr($_SERVER['PHP_SELF'], '.'), 1);
$file = explode('.', substr(strrchr($_SERVER['PHP_SELF'], '/'), 1));

//http://weather.navicom.co.id/query.php?key=170533ceb61bdbc877d71dd966333e8f&id=Banda_Aceh
require($tonjaw_root_path . 'config.' . $phpEx);
require($tonjaw_root_path . $config['include_path'] . 'db/' . $dbms . '.' . $phpEx);
require($tonjaw_root_path . $config['include_path'] . 'functions.' . $phpEx);
require($tonjaw_root_path . $config['include_path'] . 'constants.' . $phpEx);

$db	= new $sql_db();

// Connect to DB
$db->sql_connect($dbhost, $dbuser, $dbpasswd, $dbname, $dbport, false, defined('TONJAW_DB_NEW_LINK') ? TONJAW_DB_NEW_LINK : false);

// We do not need this any longer, unset for safety purposes
unset($dbpasswd);


$sql = 'SELECT weather_id, weather_city FROM ' . WEATHER_TABLE ;
$result = $db->sql_query($sql);
//echo 'crot<p>' . $sql;

while ($row = $db->sql_fetchrow($result))
{
    $city = str_replace(' ', '_', $row['weather_city']);
    //echo $city; exit;
    //$json_string = file_get_contents('http://weather.pacitan.org/query.php?key=170533ceb61bdbc877d71dd966333e8f&id=' . $city); 
	$json_string = file_get_contents($tonjaw_root_path.'proc/weather/query.php?key=5192b2e68b6dd5de&id=' . $city); 
    $parsed_json = json_decode($json_string); 
    
    if(!empty($parsed_json->{'weather_city_full'}))
    {
	$sql_ary = array(
	    'weather_city_full'		=> $parsed_json->{'weather_city_full'},
	    'weather_today_text'	=> $parsed_json->{'weather_today_text'},
	    'weather_today_condition'	=> $parsed_json->{'weather_today_condition'},
	    'weather_today_icon'	=> $parsed_json->{'weather_today_icon'},
	    'weather_today_icon_url'	=> $parsed_json->{'weather_today_icon_url'},
	    'weather_today_temp_f_min'	=> $parsed_json->{'weather_today_temp_f_min'},
	    'weather_today_temp_f_max'	=> $parsed_json->{'weather_today_temp_f_max'},
	    'weather_today_temp_c_min'	=> $parsed_json->{'weather_today_temp_c_min'},
	    'weather_today_temp_c_max'	=> $parsed_json->{'weather_today_temp_c_max'},
	    'weather_day1_text'		=> $parsed_json->{'weather_day1_text'},
	    'weather_day1_condition'	=> $parsed_json->{'weather_day1_condition'},
	    'weather_day1_icon'		=> $parsed_json->{'weather_day1_icon'},
	    'weather_day1_icon_url'	=> $parsed_json->{'weather_day1_icon_url'},
	    'weather_day1_temp_f_min'	=> $parsed_json->{'weather_day1_temp_f_min'},
	    'weather_day1_temp_f_max'	=> $parsed_json->{'weather_day1_temp_f_max'},
	    'weather_day1_temp_c_min'	=> $parsed_json->{'weather_day1_temp_c_min'},
	    'weather_day1_temp_c_max'	=> $parsed_json->{'weather_day1_temp_c_max'},
	    'weather_day2_text'		=> $parsed_json->{'weather_day2_text'},
	    'weather_day2_condition'	=> $parsed_json->{'weather_day2_condition'},
	    'weather_day2_icon'		=> $parsed_json->{'weather_day2_icon'},
	    'weather_day2_icon_url'	=> $parsed_json->{'weather_day2_icon_url'},
	    'weather_day2_temp_f_min'	=> $parsed_json->{'weather_day2_temp_f_min'},
	    'weather_day2_temp_f_max'	=> $parsed_json->{'weather_day2_temp_f_max'},
	    'weather_day2_temp_c_min'	=> $parsed_json->{'weather_day2_temp_c_min'},
	    'weather_day2_temp_c_max'	=> $parsed_json->{'weather_day2_temp_c_max'},
	    'weather_day3_text'		=> $parsed_json->{'weather_day3_text'},
	    'weather_day3_condition'	=> $parsed_json->{'weather_day3_condition'},
	    'weather_day3_icon'		=> $parsed_json->{'weather_day3_icon'},
	    'weather_day3_icon_url'	=> $parsed_json->{'weather_day3_icon_url'},
	    'weather_day3_temp_f_min'	=> $parsed_json->{'weather_day3_temp_f_min'},
	    'weather_day3_temp_f_max'	=> $parsed_json->{'weather_day3_temp_f_max'},
	    'weather_day3_temp_c_min'	=> $parsed_json->{'weather_day3_temp_c_min'},
	    'weather_day3_temp_c_max'	=> $parsed_json->{'weather_day3_temp_c_max'},
	);
    
	$sql = 'UPDATE ' . WEATHER_TABLE . ' SET ' . 
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE weather_id = " . $row['weather_id'] ;
    
	//echo "<p>$sql</p>";
	$db->sql_query($sql);
    }
    
}

$db->sql_freeresult($result);

/*
echo $parsed_json->{'weather_city_full'} . '<br/>';
echo $parsed_json->{'weather_today_text'} . '<br/>';
echo $parsed_json->{'weather_today_condition'} . '<br/>';
echo $parsed_json->{'weather_today_icon'} . '<br/>';
echo "<img src='" . $parsed_json->{'weather_today_icon_url'} . "'><br/>";
*/
  
?>
