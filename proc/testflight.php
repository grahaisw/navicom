<?php
echo 'mulai \n';
$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, 'ws://192.168.200.215/ws/subs/status');
//curl_setopt($ch, CURLOPT_URL, 'http://192.168.200.215/api/flight/388696?format=json');
curl_setopt($ch, CURLOPT_URL, 'http://192.168.200.215/api/airline/GA670?format=json');
curl_setopt($ch, CURLOPT_USERPWD, "info:info");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$response = curl_exec($ch); 
if(curl_errno($ch)) {
	echo 'error: '.curl_error($ch);
	if($i < 2) {
		$stringData = 'cURL Error : '.curl_error($ch)." \r\n";
		fwrite($fh, $stringData);
	}
	//return false;
} else { echo 'sukses';
	//$url_request = $config['fids_api'] . 'flight.json';
	//$response = file_get_contents($url_request);
	$string = json_decode($response, true); 
	print_r($string);exit;
	$fids_type = $string['direction'];
}
?>
