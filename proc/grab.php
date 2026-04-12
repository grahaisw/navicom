<?php
$i = 0; 
for($i=0; $i<2; $i++) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://staging.via.inalix.com/sub/?id=opr');
	//curl_setopt($ch, CURLOPT_USERPWD, "info:info");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	//curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
	//curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
	//curl_setopt($ch, CURLOPT_TIMEOUT, 2);
	echo 'a';
	$response = curl_exec($ch); 
	echo 'a1';
	if(curl_errno($ch)) { echo 'b';
		print curl_error($ch);
		//return false;
	} else {
		$string = json_decode($response, true);
		print_r($string);
		$opr = $string['opr'];
		$fids_id = $string['flight'];
		
	}
	
	
	//$i++;
}
?>