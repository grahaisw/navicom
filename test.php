<?php
/*
*  JSON Parsing from weather.com
*/
echo maketime();
echo time() . '<p>'; 
date_default_timezone_set('UTC');
echo mktime(13,46,0,1,14,2015);

function maketime('20150114 14:37')
    {
	$year = substr($datetime_int, 0, 4);
	$month = substr($datetime_int, 5, 2);
	$date = substr($datetime_int, 7, 2);
	$hour = substr($datetime_int, 10, 2);
	$minute = substr($datetime_int, 13, 2);
    
	$datetime_int = mktime($hour, $minute, 0 , $month, $day, $year);
	
	return $datetime_int;
    }
    
exit;

//phpinfo(); exit;
$json_string = file_get_contents('http://www.navicom.co.id/weather/tes_json.php');
    
 //$json_string = file_get_contents("http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Australia/Sydney.json"); 
 
 $parsed_json = json_decode($json_string); 
 $location = $parsed_json->{'city'}; 
 $nama = $parsed_json->{'nama'}; 
 echo $parsed_json->{'nama'} . ' - ' . $parsed_json->{'city'} . ' - ' . $parsed_json->{'sex'};
 
 
 
 //echo "Current temperature in ${location} is: ${nama}\n <p>";


/*
$json_string = file_get_contents("http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Surabaya.json"); 
 
 $parsed_json = json_decode($json_string); 
 $location = $parsed_json->{'location'}->{'city'}; 
 $temperature_string = $parsed_json->{'current_observation'}->{'temperature_string'}; 
 $weather = $parsed_json->{'current_observation'}->{'weather'}; 
 $state = $parsed_json->{'current_observation'}->{'display_location'}->{'full'}; 
 echo "Current temperature in ${location} is: ${temperature_string}<br>";
echo "weather: ${weather}<br>";
echo "state: ${state}<br>";

exit;
*/
/* testing
$a = '2014/01/23 18:00';

//$datetime = DateTime::createFromFormat("Y/m/d H:i", '2014/01/23 18:00');

echo $a . '<p>';

$b = strtotime($a);

echo $b . '<p>';

//$datetime = date_create_from_format("Y/m/d H:i", '2014/01/23 18:00');
echo date("D, d-F-Y H:i:s", $b);
*/




?>
<!--
<html>
<head>
</head>
<body>
<p>
<div width="900" color="red" border="1" align="center"> testing
</div>
<p>
<div align="center" height="600">
<video src="media/clips/adele.mp4" width="600" autoplay></video>
</div>
</body>
</html>
-->