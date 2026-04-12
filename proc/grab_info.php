<?php
/**
*
* proc/grab_info.php
*
* Agnes Emanuella, Nov 2014
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

$url_request = $config['fids_server'] . 
		  '?key=' . $config['fids_key'] . 
		  '&format=' . $config['fids_data_format'];

switch( $config['fids_data_format'] )
{
	case 'xml':
		//dummy data
		$url_request = $config['fids_server'] . 'info.xml';
		
		$xml = @simpleXML_load_file($url_request,"SimpleXMLElement",LIBXML_NOCDATA);

		if( !$xml )
		{
			//exit('Failed to open >' . $url_request . '<');
			$xml = array();
		}
		else
		{
			// delete airport fids from AIRPORT_FIDS_TABLE
			$sql = 'DELETE FROM ' . SIGNAGE_GENERALS_TABLE;
			$db->sql_query($sql);
			
			$data['info_count'] = (int) $xml->Info->attributes()->{'DataCount'};
			
			foreach( $xml->Info->Record as $row_rec )
			{
				//echo '<br/>';
				$sql_ary = array(
					'signage_general_date' 		=> (string) $row_rec->Date,
					'signage_general_title'		=> (string) $row_rec->Title,
					'signage_general_remark'	=> (string) $row_rec->Remark,
					'signage_general_enabled'	=> 1,
				);
				
				$sql = 'INSERT INTO ' . SIGNAGE_GENERALS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
		
				//echo $sql; 
				$db->sql_query($sql);

			}
		
		
		
		}

		break;



	case 'json':
		//dummy data
		$url_request = $config['fids_server'] . 'info.json';
		$fileContents = file_get_contents($url_request);	  
		$parsed_json = json_decode($fileContents); 
		
		// empty table first
		$sql = 'DELETE FROM ' . SIGNAGE_GENERALS_TABLE;
		$db->sql_query($sql);
		
		$total_data = count($parsed_json->Info->Record);
		for($i=0; $i<$total_data; $i++) {
			$sql_ary = array(
				'signage_general_date' 		=> (string) $parsed_json->Info->Record[$i]->Date,
				'signage_general_title'		=> (string) $parsed_json->Info->Record[$i]->Title,
				'signage_general_remark'	=> (string) $parsed_json->Info->Record[$i]->Remark,
				'signage_general_enabled'	=> 1,
			);
			
			$sql = 'INSERT INTO ' . SIGNAGE_GENERALS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	
			//echo $sql; 
			$db->sql_query($sql);
		}
		
		break;
}
    
    
unset($data);
unset($xml);


?>