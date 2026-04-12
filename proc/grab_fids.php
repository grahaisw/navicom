<?php
/**
*
* proc/grab_fids.php
*
* Roberto Tonjaw. Oct 2014
*/

/**
*/
define('IN_TONJAW', true);

$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : './../';
$phpEx = substr(strrchr($_SERVER['PHP_SELF'], '.'), 1);
$file = explode('.', substr(strrchr($_SERVER['PHP_SELF'], '/'), 1));

require($tonjaw_root_path . 'config.' . $phpEx);
require($tonjaw_root_path . $config['include_path'] . 'db/' . $dbms . '.' . $phpEx);
require($tonjaw_root_path . $config['include_path'] . 'functions.' . $phpEx);
require($tonjaw_root_path . $config['include_path'] . 'constants.' . $phpEx);

$db	= new $sql_db();

// Connect to DB
$db->sql_connect($dbhost, $dbuser, $dbpasswd, $dbname, $dbport, false, defined('TONJAW_DB_NEW_LINK') ? TONJAW_DB_NEW_LINK : false);

// We do not need this any longer, unset for safety purposes
unset($dbpasswd);
error_reporting(E_ALL); ini_set('display_errors', 1);
$i = 0;
while(true) { 
//for($i=0; $i<10; $i++) {

	if($i == 0) {
                $logfile = "grab_fids.log";
                $fh = fopen($logfile, 'a+') or die("can't open file");
        }

        if($i < 2) {
                $stringData = "########## ".date("Y-m-d H:i:s")." ########## \r\n";
                fwrite($fh, $stringData);

        }


	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $config['fids_server']);
	//curl_setopt($ch, CURLOPT_USERPWD, "inalix:inalixOKE");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	$response = curl_exec($ch); 
	
	if($i < 2) {
	        $stringData = 'Access cURL : '.$config['fids_server'].' \r\n';
        	fwrite($fh, $stringData);
        }


	if(!curl_errno($ch)) {
		//$url_request = $config['fids_server'] . 'sub.json';
		//$json_string = file_get_contents($url_request);
		$string = json_decode($response, true);
		//print_r($string); exit;
		$opr = $string['opr'];
		$fids_id = $string['flight'];
		//echo $opr . ' - '. $fids_id . ' \r';

		if(!empty($fids_id)) {

		$sql_ary = array(
			'airport_fids_update_id' 		=> $fids_id,
			'airport_fids_update_opr'		=> $opr,
			'airport_fids_update_timestamp'	=> (int) time(),
		);
		
		$sql_insert = 'INSERT INTO ' . AIRPORT_FIDS_UPDATE_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
		$result = $db->sql_query($sql_insert);
		if($result) {
			if($i < 2) {
                	        $stringData = 'Query Insert : '.$sql_insert." \r\n";
        	                fwrite($fh, $stringData);
	                }

		}/* else {
			//echo pg_result_error($result);
		}*/
		}

		//Write all data to airport_fids_log
		$sql_ary2 = array(
                        'airport_fids_update_id'                => $fids_id,
                        'airport_fids_update_opr'               => $opr,
                        'airport_fids_update_timestamp' => (int) time(),
                );

                $sql_insert2 = 'INSERT INTO ' . AIRPORT_FIDS_LOG_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary2);
                $result2 = $db->sql_query($sql_insert2);


	} else {
		if($i < 2) {
                	$stringData = 'cURL Error : '.curl_error($ch)." \r\n";
                       	fwrite($fh, $stringData);
              	}

		//print curl_error($ch);
		//echo 'blong \n'; //exit;
		
	}
	
	unset($string);
	unset($opr);
	unset($fids_id);
	
	if($i == 1) {
                if(file_exists($logfile)) {
                        //unlink($logfile);
                        //exit;
                        ftruncate($fh, 0);
                        fclose($fh);
                        $i = 0;
                }
        } else {
                //fclose($fh);
                $i++;
        }

	
	usleep(10000);
}
    
   

?>
