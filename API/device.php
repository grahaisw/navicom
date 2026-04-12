<?php

$data_string = '{"method":"passthrough", "params": {"deviceId": "8006737433717E8EC25E5982B503F74A18F41615", "requestData": "{\"system\":{\"set_relay_state\":{\"state\":0}}}" }}';

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://aps1-wap.tplinkcloud.com/?token=d4fcfd62-29d3daf8858e49f1860a0c9",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  //CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $data_string,
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: b9fd21fa-a5a6-dc8c-839c-17eb5223f6c5"
  ),
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
));

$response = curl_exec($curl);

if(curl_errno($curl))
{
		//echo $data_string.' x';
		echo curl_error($curl);
}
else
{
		curl_close($curl);
		echo $response;
}

?>
