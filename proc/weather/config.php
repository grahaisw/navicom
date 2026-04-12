<?php
/**
*
* config.php
*
* By Roberto Tonjaw. Feb 2014
*/

$dbms = 'postgres'; //'mysql'; 
$dbhost = 'localhost';
$dbport = '';
$dbname = 'navicom';
$dbuser = 'navicom';
$dbpasswd = 'apalah';

/*
$dbms = 'mysql';
$dbhost = 'sql5c40a.carrierzone.com';
$dbport = '';
$dbname = 'weather_pacitanorg520908';
$dbuser = 'pacitanorg520908';
$dbpasswd = 'sh1enj0l4tr';
*/
$table = 'weather';
$key = '5192b2e68b6dd5de';

/**
*  
*
*/
$city[61] = 'https://api.wunderground.com/api/5192b2e68b6dd5de/geolookup/conditions/forecast/q/Indonesia/Jakarta.json';
$city[62] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Surabaya.json';
$city[63] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Denpasar.json';
$city[64] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Yogyakarta.json';
$city[65] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Medan.json';
$city[66] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Makassar.json';
$city[67] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Ambon.json';
$city[68] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Bandung.json';
$city[69] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Palembang.json';
$city[70] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Balikpapan.json';
$city[11] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Padang.json';
$city[12] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Batam.json';
$city[13] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Manado.json';
$city[14] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Pontianak.json';
$city[15] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Banjarmasin.json';
$city[16] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Palu.json';
$city[17] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Jambi.json';
$city[18] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Kendari.json';
$city[19] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Samarinda.json';
$city[20] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Semarang.json';

$city[21] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/forecast/geolookup/conditions/q/HI/Pekanbaru.json';
$city[22] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Pangkalpinang.json';
$city[23] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Banda_Aceh.json';
$city[24] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Dumai.json';
$city[25] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Jayapura.json';
$city[26] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Mataram.json';
$city[27] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Kupang.json';
$city[28] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Bengkulu.json';
$city[29] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Surakarta.json';
$city[30] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Palangkaraya.json';

$city[31] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/forecast/geolookup/conditions/q/NY/New_York.json';
$city[32] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/forecast/geolookup/conditions/q/CA/Los_Angeles.json';
$city[33] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/forecast/geolookup/conditions/q/HI/Honolulu.json';
$city[34] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Australia/Sydney.json';
$city[35] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Australia/Melbourne.json';
$city[36] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Australia/Perth.json';
$city[37] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/England/London.json';
$city[38] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Netherlands/Amsterdam.json';
$city[39] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Germany/Frankfurt.json';
$city[40] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Italy/Rome.json';

$city[41] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/France/Paris.json';
$city[42] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Russia/Moscow.json';
$city[43] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/United_Arab_Emirates/Dubai.json';
$city[44] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Singapore/Singapore.json';
$city[45] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Malaysia/Kuala_Lumpur.json';
$city[46] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Thailand/Bangkok.json';
$city[47] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/China/Hong_Kong.json';
$city[48] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/China/Beijing.json';
$city[49] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/China/Shanghai.json';
$city[50] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Japan/Tokyo.json';

$city[51] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Taiwan/Taipei.json';
$city[52] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/India/Mumbai.json';
$city[53] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/India/New_Delhi.json';
$city[54] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Philippines/Manila.json';
$city[55] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Brazil/Rio_De_Janeiro.json';
$city[56] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Spain/Madrid.json';
$city[57] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Germany/Berlin.json';
$city[58] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Saudi_Arabia/Riyadh.json';
$city[59] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Viet_Nam/Ho_Chi_Minh.json';
$city[60] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Switzerland/Zurich.json';

$city[71] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Greenland/Nuuk.json';
$city[72] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Greenland/Qaqortoq.json';
$city[73] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Argentina/Ushuaia.json';
$city[74] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Norway/Finnmark.json';
$city[75] = 'http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Iceland/Reykjavik.json';


/**
* Checks if a path ($path) is absolute or relative
*
* @param string $path Path to check absoluteness of
* @return boolean
*/
function is_absolute($path)
{
    return (isset($path[0]) && $path[0] == '/' || preg_match('#^[a-z]:[/\\\]#i', $path)) ? true : false;
}

/**
* @author Chris Smith <chris@project-minerva.org>
* @copyright 2006 Project Minerva Team
* @param string $path The path which we should attempt to resolve.
* @return mixed
*/
function tonjaw_own_realpath($path)
{
	// Now to perform funky shizzle

	// Switch to use UNIX slashes
	$path = str_replace(DIRECTORY_SEPARATOR, '/', $path);
	$path_prefix = '';

	// Determine what sort of path we have
	if (is_absolute($path))
	{
		$absolute = true;

		if ($path[0] == '/')
		{
			// Absolute path, *NIX style
			$path_prefix = '';
		}
		else
		{
			// Absolute path, Windows style
			// Remove the drive letter and colon
			$path_prefix = $path[0] . ':';
			$path = substr($path, 2);
		}
	}
	else
	{
		// Relative Path
		// Prepend the current working directory
		if (function_exists('getcwd'))
		{
			// This is the best method, hopefully it is enabled!
			$path = str_replace(DIRECTORY_SEPARATOR, '/', getcwd()) . '/' . $path;
			$absolute = true;
			if (preg_match('#^[a-z]:#i', $path))
			{
				$path_prefix = $path[0] . ':';
				$path = substr($path, 2);
			}
			else
			{
				$path_prefix = '';
			}
		}
		else if (isset($_SERVER['SCRIPT_FILENAME']) && !empty($_SERVER['SCRIPT_FILENAME']))
		{
			// Warning: If chdir() has been used this will lie!
			// Warning: This has some problems sometime (CLI can create them easily)
			$path = str_replace(DIRECTORY_SEPARATOR, '/', dirname($_SERVER['SCRIPT_FILENAME'])) . '/' . $path;
			$absolute = true;
			$path_prefix = '';
		}
		else
		{
			// We have no way of getting the absolute path, just run on using relative ones.
			$absolute = false;
			$path_prefix = '.';
		}
	}

	// Remove any repeated slashes
	$path = preg_replace('#/{2,}#', '/', $path);

	// Remove the slashes from the start and end of the path
	$path = trim($path, '/');

	// Break the string into little bits for us to nibble on
	$bits = explode('/', $path);

	// Remove any . in the path, renumber array for the loop below
	$bits = array_values(array_diff($bits, array('.')));

	// Lets get looping, run over and resolve any .. (up directory)
	for ($i = 0, $max = sizeof($bits); $i < $max; $i++)
	{
		// @todo Optimise
		if ($bits[$i] == '..' )
		{
			if (isset($bits[$i - 1]))
			{
				if ($bits[$i - 1] != '..')
				{
					// We found a .. and we are able to traverse upwards, lets do it!
					unset($bits[$i]);
					unset($bits[$i - 1]);
					$i -= 2;
					$max -= 2;
					$bits = array_values($bits);
				}
			}
			else if ($absolute) // ie. !isset($bits[$i - 1]) && $absolute
			{
				// We have an absolute path trying to descend above the root of the filesystem
				// ... Error!
				return false;
			}
		}
	}

	// Prepend the path prefix
	array_unshift($bits, $path_prefix);

	$resolved = '';

	$max = sizeof($bits) - 1;

	// Check if we are able to resolve symlinks, Windows cannot.
	$symlink_resolve = (function_exists('readlink')) ? true : false;

	foreach ($bits as $i => $bit)
	{
		if (@is_dir("$resolved/$bit") || ($i == $max && @is_file("$resolved/$bit")))
		{
			// Path Exists
			if ($symlink_resolve && is_link("$resolved/$bit") && ($link = readlink("$resolved/$bit")))
			{
				// Resolved a symlink.
				$resolved = $link . (($i == $max) ? '' : '/');
				continue;
			}
		}
		else
		{
			// Something doesn't exist here!
			// This is correct realpath() behaviour but sadly open_basedir and safe_mode make this problematic
			// return false;
		}
		$resolved .= $bit . (($i == $max) ? '' : '/');
	}

	// @todo If the file exists fine and open_basedir only has one path we should be able to prepend it
	// because we must be inside that basedir, the question is where...
	// @internal The slash in is_dir() gets around an open_basedir restriction
	if (!@file_exists($resolved) || (!@is_dir($resolved . '/') && !is_file($resolved)))
	{
		return false;
	}

	// Put the slashes back to the native operating systems slashes
	$resolved = str_replace('/', DIRECTORY_SEPARATOR, $resolved);

	// Check for DIRECTORY_SEPARATOR at the end (and remove it!)
	if (substr($resolved, -1) == DIRECTORY_SEPARATOR)
	{
		return substr($resolved, 0, -1);
	}

	return $resolved; // We got here, in the end!
}

if (!function_exists('realpath'))
{
	/**
	* A wrapper for realpath
	* @ignore
	*/
	function tonjaw_realpath($path)
	{
		return tonjaw_own_realpath($path);
	}
}
else
{
	/**
	* A wrapper for realpath
	*/
	function tonjaw_realpath($path)
	{
		$realpath = realpath($path);

		// Strangely there are provider not disabling realpath but returning strange values. :o
		// We at least try to cope with them.
		if ($realpath === $path || $realpath === false)
		{
			return tonjaw_own_realpath($path);
		}

		// Check for DIRECTORY_SEPARATOR at the end (and remove it!)
		if (substr($realpath, -1) == DIRECTORY_SEPARATOR)
		{
			$realpath = substr($realpath, 0, -1);
		}

		return $realpath;
	}
}

/**
* Eliminates useless . and .. components from specified path.
*
* @param string $path Path to clean
* @return string Cleaned path
*/
function tonjaw_clean_path($path)
{
	$exploded = explode('/', $path);
	$filtered = array();
	foreach ($exploded as $part)
	{
		if ($part === '.' && !empty($filtered))
		{
			continue;
		}

		if ($part === '..' && !empty($filtered) && $filtered[sizeof($filtered) - 1] !== '..')
		{
			array_pop($filtered);
		}
		else
		{
			$filtered[] = $part;
		}
	}
	$path = implode('/', $filtered);
	return $path;
}

if (!function_exists('htmlspecialchars_decode'))
{
	/**
	* A wrapper for htmlspecialchars_decode
	* @ignore
	*/
	function htmlspecialchars_decode($string, $quote_style = ENT_COMPAT)
	{
		return strtr($string, array_flip(get_html_translation_table(HTML_SPECIALCHARS, $quote_style)));
	}
}

/**
* Removes absolute path to Tonjaw root directory from error messages
* and converts backslashes to forward slashes.
*
* @param string $errfile	Absolute file path
*							(e.g. /var/www/tonjaw/inc/functions.php)
*							Please note that if $errfile is outside of the Tonjaw root,
*							the root path will not be found and can not be filtered.
* @return string			Relative file path
*							(e.g. /inc/functions.php)
*/
function tonjaw_filter_root_path($errfile)
{
	static $root_path;

	if (empty($root_path))
	{
		$root_path = tonjaw_realpath(dirname(__FILE__) . '/../');
	}

	return str_replace(array($root_path, '\\'), array('[ROOT]', '/'), $errfile);
}

/**
* set_var
*
* Set variable, used by {@link request_var the request_var function}
*
* @access private
*/
function set_var(&$result, $var, $type, $multibyte = false)
{
	settype($var, $type);
	$result = $var;

	if ($type == 'string')
	{
		$result = trim(htmlspecialchars(str_replace(array("\r\n", "\r", "\0"), array("\n", "\n", ''), $result), ENT_COMPAT, 'UTF-8'));

		if (!empty($result))
		{
			// Make sure multibyte characters are wellformed
			if ($multibyte)
			{
				if (!preg_match('/^./u', $result))
				{
					$result = '';
				}
			}
			else
			{
				// no multibyte, allow only ASCII (0-127)
				$result = preg_replace('/[\x80-\xFF]/', '?', $result);
			}
		}

		$result = (STRIP) ? stripslashes($result) : $result;
	}
}

/**
* request_var
*
* Used to get passed variable
*/
function request_var($var_name, $default, $multibyte = false, $cookie = false)
{
	if (!$cookie && isset($_COOKIE[$var_name]))
	{
		if (!isset($_GET[$var_name]) && !isset($_POST[$var_name]))
		{
			return (is_array($default)) ? array() : $default;
		}
		$_REQUEST[$var_name] = isset($_POST[$var_name]) ? $_POST[$var_name] : $_GET[$var_name];
	}

	$super_global = ($cookie) ? '_COOKIE' : '_REQUEST';
	if (!isset($GLOBALS[$super_global][$var_name]) || is_array($GLOBALS[$super_global][$var_name]) != is_array($default))
	{
		return (is_array($default)) ? array() : $default;
	}

	$var = $GLOBALS[$super_global][$var_name];
	if (!is_array($default))
	{
		$type = gettype($default);
	}
	else
	{
		list($key_type, $type) = each($default);
		$type = gettype($type);
		$key_type = gettype($key_type);
		if ($type == 'array')
		{
			reset($default);
			$default = current($default);
			list($sub_key_type, $sub_type) = each($default);
			$sub_type = gettype($sub_type);
			$sub_type = ($sub_type == 'array') ? 'NULL' : $sub_type;
			$sub_key_type = gettype($sub_key_type);
		}
	}

	if (is_array($var))
	{
		$_var = $var;
		$var = array();

		foreach ($_var as $k => $v)
		{
			set_var($k, $k, $key_type);
			if ($type == 'array' && is_array($v))
			{
				foreach ($v as $_k => $_v)
				{
					if (is_array($_v))
					{
						$_v = null;
					}
					set_var($_k, $_k, $sub_key_type, $multibyte);
					set_var($var[$k][$_k], $_v, $sub_type, $multibyte);
				}
			}
			else
			{
				if ($type == 'array' || is_array($v))
				{
					$v = null;
				}
				set_var($var[$k], $v, $type, $multibyte);
			}
		}
	}
	else
	{
		set_var($var, $var, $type, $multibyte);
	}

	return $var;
}


?>
