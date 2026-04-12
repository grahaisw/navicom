<?php
/*$request = new HttpRequest();
$request->setUrl('https://fcm.googleapis.com/fcm/send');
$request->setMethod(HTTP_METH_POST);

$request->setHeaders(array(
  'postman-token' => 'd60f909a-5ae3-4e49-032c-2dac53b5e7f2',
  'cache-control' => 'no-cache',
  'authorization' => 'key=AAAALqpzZ2c:APA91bFeI1KNkhK39Vp-p-DP6u6CYhc8aTZgD4HaIggM8zk3m3CESmGO3eMrhFjGugC2JAp8cWNZDMfj77TFr8QCIv8BKNFFklyvm9RhXLE4UYoevobQigabFA1F0IU4ZnfNOQ5bFg-J',
  'content-type' => 'application/json'
));

$request->setBody('{ "notification": {
	"title":"kebakaran tigaaa",
	"body":"ya pokoknya ada kebakaran di bandara",
	"badge":"0",
	"sound":"default",
	"click_action":"ALERT_ACTIVITY"
	},
	"data": {
		"extra_information":"kebakaran. Please selamatkan diri masing2 yaa"
	},
	"to":"/topics/NEWS"
}');

try {
  $response = $request->send();

  echo $response->getBody();
} catch (HttpException $ex) {
  echo $ex;
}
*/
//$data_string = "{ \"notification\": {\n\t\"title\":\"kebakaran 2\",\n\t\"body\":\"ya pokoknya ada kebakaran di bandara\",\n\t\"badge\":\"0\",\n\t\"sound\":\"default\",\n\t\"click_action\":\"ALERT_ACTIVITY\"\n\t},\n\t\"data\": {\n\t\t\"extra_information\":\"kebakaran. Please selamatkan diri masing2 yaa\"\n\t},\n\t\"to\":\"/topics/NEWS\"\n}";



$data_string = '{"notification": { "title":"lagi belajar android","body":"ya pokoknya lagi belajar","sound":"default","click_action":"ALERT_ACTIVITY"}, "data": {"extra_information":"kebakaran. Please selamatkan diri masing2 yaa"},"to":"/topics/NEWS"}';

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://fcm.googleapis.com/fcm/send",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $data_string,
  CURLOPT_HTTPHEADER => array(
	"authorization: key=".$config['firebase_key'],
	"cache-control: no-cache",
	"content-type: application/json",
	"postman-token: bb431e65-1214-36fd-bc56-da4c05dc8a36"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
?>