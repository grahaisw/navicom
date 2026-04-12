<?php
/**
*
* common.php
*
* By Roberto Tonjaw. Dec 2013
*/

/**
*/
if (!defined('IN_TONJAW'))
{
	die('Hacking Attempt');
}

if (file_exists($tonjaw_root_path . 'config.' . $phpEx))
{
	require($tonjaw_root_path . 'config.' . $phpEx);
}

require($tonjaw_root_path . $config['include_path'] . 'startup.' . $phpEx);

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



// Include files
// require($tonjaw_root_path . 'includes/acm/acm_' . $acm_type . '.' . $phpEx);              FINISHED BUT PENDING BY TONJAW
// require($tonjaw_root_path . 'includes/cache.' . $phpEx);                                  PENDING BY TONJAW

require($tonjaw_root_path . $config['include_path'] . 'session.' . $phpEx);
require($tonjaw_root_path . $config['include_path'] . 'db/' . $dbms . '.' . $phpEx);
require($tonjaw_root_path . $config['include_path'] . 'functions.' . $phpEx);
require($tonjaw_root_path . $config['include_path'] . 'constants.' . $phpEx);
require($tonjaw_root_path . $config['include_path'] . 'template.' . $phpEx);
require($tonjaw_root_path . $config['pms_path'] . $pmsname . '.' . $phpEx);
//require($tonjaw_root_path . $config['include_path'] . 'auth.' . $phpEx);
require($tonjaw_root_path . $config['include_path'] . 'utf/utf_tools.' . $phpEx);


//$authenticate	= new authenticate();
$template	= new template();
$db		= new $sql_db();
$session	= new session();

$pms		= new $pms_api();

// Connect to DB
$db->sql_connect($dbhost, $dbuser, $dbpasswd, $dbname, $dbport, false, defined('TONJAW_DB_NEW_LINK') ? TONJAW_DB_NEW_LINK : false);

// We do not need this any longer, unset for safety purposes
unset($dbpasswd);

// GENERATE VARIABLES

//default config
//$site_config['lang'] = 'en';
//$site_config['style'] = 'simplicity';
//$site_config['theme'] = 'default';

//user config, supposed to be retrieved from DB
/*
if (empty($user['lang']))
{
    $user['lang'] = $config['default_lang'];
}

if (empty($user['style']))
{
    $user['style'] = $site_config['style'];
}

if (empty($user['theme']))
{
    $user['theme'] = $site_config['theme'];
}
*/

?>