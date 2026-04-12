<?php
/**
*
* pms/common_pms.php
*
* Roberto Tonjaw. May 2014
*/

/**
*/

if (!defined('IN_TONJAW'))
{
	die('Hacking Attempt');
}

if (file_exists($tonjaw_root_path . 'config.' . $phpEx) && empty($pmsname))
{
	require($tonjaw_root_path . 'config.' . $phpEx);
}

//require($tonjaw_root_path . $config['include_path'] . 'startup.' . $phpEx);

if (defined('DEBUG_EXTRA'))
{
	$base_memory_usage = 0;
	if (function_exists('memory_get_usage'))
	{
		$base_memory_usage = memory_get_usage();
	}
}

// Load Extensions
// dl() is deprecated and disabled by default as of PHP 5.3.
if (!empty($load_extensions) && function_exists('dl'))
{
	$load_extensions = explode(',', $load_extensions);

	foreach ($load_extensions as $extension)
	{
		@dl(trim($extension));
	}
}

//require($tonjaw_root_path . $config['include_path'] . 'db/' . $dbms . '.' . $phpEx);
//require($tonjaw_root_path . $config['include_path'] . 'functions.' . $phpEx);
//require($tonjaw_root_path . $config['include_path'] . 'constants.' . $phpEx);
require($tonjaw_root_path . $config['pms_path'] . $pmsname . '.' . $phpEx);
//require($tonjaw_root_path . $config['include_path'] . 'utf/utf_tools.' . $phpEx);

//$db		= new $sql_db();
$pms		= new $pms_api();



// Connect to DB
//$db->sql_connect($dbhost, $dbuser, $dbpasswd, $dbname, $dbport, false, defined('TONJAW_DB_NEW_LINK') ? TONJAW_DB_NEW_LINK : false);

// We do not need this any longer, unset for safety purposes
//unset($dbpasswd);


?>