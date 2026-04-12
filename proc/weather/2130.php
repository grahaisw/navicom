<?php
/**
*
* 2130.php
*
* By Roberto Tonjaw. Feb 2014
*/

define('IN_TONJAW', true);
$root_path = (defined('ROOT_PATH')) ? ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
$file = explode('.', substr(strrchr(__FILE__, '/'), 1));

// Include files
require($root_path . 'startup.' . $phpEx);
require($root_path . 'config.' . $phpEx);
require($root_path . $dbms . '.' . $phpEx);
$db	= new $sql_db();

// Connect to DB
$db->sql_connect($dbhost, $dbuser, $dbpasswd, $dbname, $dbport, false, defined('TONJAW_DB_NEW_LINK') ? TONJAW_DB_NEW_LINK : false);

// We do not need this any longer, unset for safety purposes
unset($dbpasswd);

$start = 21;
$end = 30;

while($start <= $end)
{
    //echo "============================================================================================i:$start<p>";
    $json_string = file_get_contents($city[$start]); 
    $parsed_json = json_decode($json_string); 
    
    $city_short = $parsed_json->{'current_observation'}->{'display_location'}->{'city'};
    $city_full = $parsed_json->{'current_observation'}->{'display_location'}->{'full'}; 
    $today_text = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[0]->{'date'}->{'weekday'};
    $today_temp_c_min = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[0]->{'low'}->{'celsius'}; 
    $today_temp_c_max = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[0]->{'high'}->{'celsius'};
    $today_temp_f_min = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[0]->{'low'}->{'fahrenheit'};
    $today_temp_f_max = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[0]->{'high'}->{'fahrenheit'};
    $today_conditions = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[0]->{'conditions'};
    $today_icon = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[0]->{'icon'};
    $today_icon_url = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[0]->{'icon_url'};
    
    $day1_text = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[1]->{'date'}->{'weekday'};
    $day1_temp_c_min = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[1]->{'low'}->{'celsius'}; 
    $day1_temp_c_max = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[1]->{'high'}->{'celsius'};
    $day1_temp_f_min = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[1]->{'low'}->{'fahrenheit'}; 
    $day1_temp_f_max = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[1]->{'high'}->{'fahrenheit'};
    $day1_conditions = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[1]->{'conditions'};
    $day1_icon = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[1]->{'icon'};
    $day1_icon_url = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[1]->{'icon_url'};
    
    $day2_text = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[2]->{'date'}->{'weekday'};
    $day2_temp_c_min = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[2]->{'low'}->{'celsius'}; 
    $day2_temp_c_max = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[2]->{'high'}->{'celsius'};
    $day2_temp_f_min = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[2]->{'low'}->{'fahrenheit'};
    $day2_temp_f_max = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[2]->{'high'}->{'fahrenheit'};
    $day2_conditions = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[2]->{'conditions'};
    $day2_icon = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[2]->{'icon'};
    $day2_icon_url = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[2]->{'icon_url'};
    
    $day3_text = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[3]->{'date'}->{'weekday'};
    $day3_temp_c_min = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[3]->{'low'}->{'celsius'};
    $day3_temp_c_max = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[3]->{'high'}->{'celsius'};
    $day3_temp_f_min = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[3]->{'low'}->{'fahrenheit'}; 
    $day3_temp_f_max = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[3]->{'high'}->{'fahrenheit'};
    $day3_conditions = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[3]->{'conditions'};
    $day3_icon = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[3]->{'icon'};
    $day3_icon_url = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[3]->{'icon_url'};
    
    if(empty($city_short))
    {
	break;
    }
  
    $sql_ary = array(
	'weather_city' 			=> $city_short,
	'weather_city_full'		=> $city_full,
	'weather_today_text'		=> $today_text,
	'weather_today_condition'	=> $today_conditions,
	'weather_today_icon'		=> $today_icon,
	'weather_today_icon_url'	=> $today_icon_url,
	'weather_today_temp_f_min'	=> $today_temp_f_min,
	'weather_today_temp_f_max'	=> $today_temp_f_max,
	'weather_today_temp_c_min'	=> $today_temp_c_min,
	'weather_today_temp_c_max'	=> $today_temp_c_max,
	'weather_day1_text'		=> $day1_text,
	'weather_day1_condition'	=> $day1_conditions,
	'weather_day1_icon'		=> $day1_icon,
	'weather_day1_icon_url'		=> $day1_icon_url,
	'weather_day1_temp_f_min'	=> $day1_temp_f_min,
	'weather_day1_temp_f_max'	=> $day1_temp_f_max,
	'weather_day1_temp_c_min'	=> $day1_temp_c_min,
	'weather_day1_temp_c_max'	=> $day1_temp_c_max,
	'weather_day2_text'		=> $day2_text,
	'weather_day2_condition'	=> $day2_conditions,
	'weather_day2_icon'		=> $day2_icon,
	'weather_day2_icon_url'		=> $day2_icon_url,
	'weather_day2_temp_f_min'	=> $day2_temp_f_min,
	'weather_day2_temp_f_max'	=> $day2_temp_f_max,
	'weather_day2_temp_c_min'	=> $day2_temp_c_min,
	'weather_day2_temp_c_max'	=> $day2_temp_c_max,
	'weather_day3_text'		=> $day3_text,
	'weather_day3_condition'	=> $day3_conditions,
	'weather_day3_icon'		=> $day3_icon,
	'weather_day3_icon_url'		=> $day3_icon_url,
	'weather_day3_temp_f_min'	=> $day3_temp_f_min,
	'weather_day3_temp_f_max'	=> $day3_temp_f_max,
	'weather_day3_temp_c_min'	=> $day3_temp_c_min,
	'weather_day3_temp_c_max'	=> $day3_temp_c_max,
    );
    
    $sql = 'SELECT weather_city FROM ' . $table . " WHERE weather_city = '" . $city_short . "'";
    
    $result = $db->sql_query($sql);
    $exist = (string) $db->sql_fetchfield('weather_city');
    $db->sql_freeresult($result);
    //echo $sql . '<br>:' . $ada; exit;
    
    if(!empty($exist))
    {
	$sql = 'UPDATE ' . $table . ' SET ' . 
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE weather_city = '" . $city_short . "'";
    }
    else
    {
	$sql = 'INSERT INTO ' . $table . ' ' . $db->sql_build_array('INSERT', $sql_ary);
    }
    
    //echo "<p>$sql</p>";
    $db->sql_query($sql);

/*
//print_r($sql_ary); echo '<p>';
echo "City: " . $city_short . "<br>";
echo "City: " . $city_full . "<br>";
echo "Today: <strong>$today_text</strong><br>";
echo "temp_f: $today_temp_f_min&deg;F ~ $today_temp_f_max&deg;F<br>";
echo "temp_c: $today_temp_c_min&deg;C ~ $today_temp_c_max&deg;C<br>";
echo "icon: $today_icon<br>";
echo '<img src="' .$today_icon_url . '"><br>';
echo "conditions: $today_conditions<br>";
echo "<br>=========================================<br>";
echo "Day 1: <strong>$day1_text</strong><br>";
echo "temp_f: $day1_temp_f_min&deg;F ~ $day1_temp_f_max&deg;F<br>";
echo "temp_c: $day1_temp_c_min&deg;C ~ $day1_temp_c_max&deg;C<br>";
echo "icon: $day1_icon<br>";
echo '<img src="' .$day1_icon_url . '"><br>';
echo "conditions: $day1_conditions<br>";
echo "<br>=========================================<br>";
echo "Day 2: <strong>$day2_text</strong><br>";
echo "temp_f: $day2_temp_f_min&deg;F ~ $day2_temp_f_max&deg;F<br>";
echo "temp_c: $day2_temp_c_min&deg;C ~ $day2_temp_c_max&deg;C<br>";
echo "icon: $day2_icon<br>";
echo '<img src="' .$day2_icon_url . '"><br>';
echo "conditions: $day2_conditions<br>";
echo "<br>=========================================<br>";
echo "Day 3: <strong>$day3_text</strong><br>";
echo "temp_f: $day3_temp_f_min&deg;F ~ $day3_temp_f_max&deg;F<br>";
echo "temp_c: $day3_temp_c_min&deg;C ~ $day3_temp_c_max&deg;C<br>";
echo "icon: $day3_icon<br>";
echo '<img src="' .$day3_icon_url . '"><br>';
echo "conditions: $day3_conditions<br>";
echo "<br>=========================================<br>";
*/    


    $start++;
}

unset($parsed_json);
unset($json_string); 
unset($sql_ary);
unset($db);

?>