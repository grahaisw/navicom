<?php
/**
*
* includes/functions.php
*
* By Roberto Tonjaw. Dec 2013
*/

/**
*/

if (!defined('IN_TONJAW'))
{
	die('Hacking Attempt');
}

// Common global functions

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

/**
* Return sorted array $records
*
* @param array $records
* @param string $field
*/
function array_sort($records, $field, $reverse=false)
{
    $hash = array();
   
    foreach($records as $record)
    {
        $hash[$record[$field]] = $record;
    }
   
    ($reverse)? krsort($hash) : ksort($hash);
   
    $records = array();
   
    foreach($hash as $record)
    {
        $records []= $record;
    }
   
    return $records;
}

/**
* Return unique id
* @param string $extra additional entropy
*/
function unique_id($extra = 'c')
{
	static $dss_seeded = false;
	global $config;

	$val = md5(microtime());

	return substr($val, 4, 16);
}

/*
* Hash the password
*/
function tonjaw_hash($password)
{
	$itoa64 = './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

	$random_state = unique_id();
	$random = '';
	$count = 6;

	if (($fh = @fopen('/dev/urandom', 'rb')))
	{
		$random = fread($fh, $count);
		fclose($fh);
	}

	if (strlen($random) < $count)
	{
		$random = '';

		for ($i = 0; $i < $count; $i += 16)
		{
			$random_state = md5(unique_id() . $random_state);
			$random .= pack('H*', md5($random_state));
		}
		$random = substr($random, 0, $count);
	}

	$hash = _hash_crypt_private($password, _hash_gensalt_private($random, $itoa64), $itoa64);

	if (strlen($hash) == 34)
	{
		return $hash;
	}

	return md5($password);
}

/**
* Check for correct password
*
* @param string $password The password in plain text
* @param string $hash The stored password hash
*
* @return bool Returns true if the password is correct, false if not.
*/
function tonjaw_check_hash($password, $hash)
{
	if (strlen($password) > 4096)
	{
		// If the password is too huge, we will simply reject it
		// and not let the server try to hash it.
		return false;
	}

	$itoa64 = './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
	if (strlen($hash) == 34)
	{
		return (_hash_crypt_private($password, $hash, $itoa64) === $hash) ? true : false;
	}

	return (md5($password) === $hash) ? true : false;
}

/**
* Generate salt for hash generation
*/
function _hash_gensalt_private($input, &$itoa64, $iteration_count_log2 = 6)
{
	if ($iteration_count_log2 < 4 || $iteration_count_log2 > 31)
	{
		$iteration_count_log2 = 8;
	}

	$output = '$H$';
	$output .= $itoa64[min($iteration_count_log2 + ((PHP_VERSION >= 5) ? 5 : 3), 30)];
	$output .= _hash_encode64($input, 6, $itoa64);

	return $output;
}

/**
* Encode hash
*/
function _hash_encode64($input, $count, &$itoa64)
{
	$output = '';
	$i = 0;

	do
	{
		$value = ord($input[$i++]);
		$output .= $itoa64[$value & 0x3f];

		if ($i < $count)
		{
			$value |= ord($input[$i]) << 8;
		}

		$output .= $itoa64[($value >> 6) & 0x3f];

		if ($i++ >= $count)
		{
			break;
		}

		if ($i < $count)
		{
			$value |= ord($input[$i]) << 16;
		}

		$output .= $itoa64[($value >> 12) & 0x3f];

		if ($i++ >= $count)
		{
			break;
		}

		$output .= $itoa64[($value >> 18) & 0x3f];
	}
	while ($i < $count);

	return $output;
}

/**
* The crypt function/replacement
*/
function _hash_crypt_private($password, $setting, &$itoa64)
{
	$output = '*';

	// Check for correct hash
	if (substr($setting, 0, 3) != '$H$' && substr($setting, 0, 3) != '$P$')
	{
		return $output;
	}

	$count_log2 = strpos($itoa64, $setting[3]);

	if ($count_log2 < 7 || $count_log2 > 30)
	{
		return $output;
	}

	$count = 1 << $count_log2;
	$salt = substr($setting, 4, 8);

	if (strlen($salt) != 8)
	{
		return $output;
	}

	/**
	* We're kind of forced to use MD5 here since it's the only
	* cryptographic primitive available in all versions of PHP
	* currently in use.  To implement our own low-level crypto
	* in PHP would result in much worse performance and
	* consequently in lower iteration counts and hashes that are
	* quicker to crack (by non-PHP code).
	*/
	if (PHP_VERSION >= 5)
	{
		$hash = md5($salt . $password, true);
		do
		{
			$hash = md5($hash . $password, true);
		}
		while (--$count);
	}
	else
	{
		$hash = pack('H*', md5($salt . $password));
		do
		{
			$hash = pack('H*', md5($hash . $password));
		}
		while (--$count);
	}

	$output = substr($setting, 0, 12);
	$output .= _hash_encode64($hash, 16, $itoa64);

	return $output;
}

/**
* Hashes an email address to a big integer
*
* @param string $email		Email address
*
* @return string		Unsigned Big Integer
*/
function tonjaw_email_hash($email)
{
	return sprintf('%u', crc32(strtolower($email))) . strlen($email);
}


/**
* Global function for chmodding directories and files for internal use
*
* This function determines owner and group whom the file belongs to and user and group of PHP and then set safest possible file permissions.
* The function determines owner and group from common.php file and sets the same to the provided file.
* The function uses bit fields to build the permissions.
* The function sets the appropiate execute bit on directories.
*
* Supported constants representing bit fields are:
*
* CHMOD_ALL - all permissions (7)
* CHMOD_READ - read permission (4)
* CHMOD_WRITE - write permission (2)
* CHMOD_EXECUTE - execute permission (1)
*
* NOTE: The function uses POSIX extension and fileowner()/filegroup() functions. If any of them is disabled, this function tries to build proper permissions, by calling is_readable() and is_writable() functions.
*
* @param string	$filename	The file/directory to be chmodded
* @param int	$perms		Permissions to set
*
* @return bool	true on success, otherwise false
*/
function tonjaw_chmod($filename, $perms = CHMOD_READ)
{
	static $_chmod_info;

	// Return if the file no longer exists.
	if (!file_exists($filename))
	{
		return false;
	}

	// Determine some common vars
	if (empty($_chmod_info))
	{
		if (!function_exists('fileowner') || !function_exists('filegroup'))
		{
			// No need to further determine owner/group - it is unknown
			$_chmod_info['process'] = false;
		}
		else
		{
			global $tonjaw_root_path, $phpEx;

			// Determine owner/group of common.php file and the filename we want to change here
			$common_php_owner = @fileowner($tonjaw_root_path . 'common.' . $phpEx);
			$common_php_group = @filegroup($tonjaw_root_path . 'common.' . $phpEx);

			// And the owner and the groups PHP is running under.
			$php_uid = (function_exists('posix_getuid')) ? @posix_getuid() : false;
			$php_gids = (function_exists('posix_getgroups')) ? @posix_getgroups() : false;

			// If we are unable to get owner/group, then do not try to set them by guessing
			if (!$php_uid || empty($php_gids) || !$common_php_owner || !$common_php_group)
			{
				$_chmod_info['process'] = false;
			}
			else
			{
				$_chmod_info = array(
					'process'		=> true,
					'common_owner'	        => $common_php_owner,
					'common_group'	        => $common_php_group,
					'php_uid'		=> $php_uid,
					'php_gids'		=> $php_gids,
				);
			}
		}
	}

	if ($_chmod_info['process'])
	{
		$file_uid = @fileowner($filename);
		$file_gid = @filegroup($filename);

		// Change owner
		if (@chown($filename, $_chmod_info['common_owner']))
		{
			clearstatcache();
			$file_uid = @fileowner($filename);
		}

		// Change group
		if (@chgrp($filename, $_chmod_info['common_group']))
		{
			clearstatcache();
			$file_gid = @filegroup($filename);
		}

		// If the file_uid/gid now match the one from common.php we can process further, else we are not able to change something
		if ($file_uid != $_chmod_info['common_owner'] || $file_gid != $_chmod_info['common_group'])
		{
			$_chmod_info['process'] = false;
		}
	}

	// Still able to process?
	if ($_chmod_info['process'])
	{
		if ($file_uid == $_chmod_info['php_uid'])
		{
			$php = 'owner';
		}
		else if (in_array($file_gid, $_chmod_info['php_gids']))
		{
			$php = 'group';
		}
		else
		{
			// Since we are setting the everyone bit anyway, no need to do expensive operations
			$_chmod_info['process'] = false;
		}
	}

	// We are not able to determine or change something
	if (!$_chmod_info['process'])
	{
		$php = 'other';
	}

	// Owner always has read/write permission
	$owner = CHMOD_READ | CHMOD_WRITE;
	if (is_dir($filename))
	{
		$owner |= CHMOD_EXECUTE;

		// Only add execute bit to the permission if the dir needs to be readable
		if ($perms & CHMOD_READ)
		{
			$perms |= CHMOD_EXECUTE;
		}
	}

	switch ($php)
	{
		case 'owner':
			$result = @chmod($filename, ($owner << 6) + (0 << 3) + (0 << 0));

			clearstatcache();

			if (is_readable($filename) && tonjaw_is_writable($filename))
			{
				break;
			}

		case 'group':
			$result = @chmod($filename, ($owner << 6) + ($perms << 3) + (0 << 0));

			clearstatcache();

			if ((!($perms & CHMOD_READ) || is_readable($filename)) && (!($perms & CHMOD_WRITE) || tonjaw_is_writable($filename)))
			{
				break;
			}

		case 'other':
			$result = @chmod($filename, ($owner << 6) + ($perms << 3) + ($perms << 0));

			clearstatcache();

			if ((!($perms & CHMOD_READ) || is_readable($filename)) && (!($perms & CHMOD_WRITE) || tonjaw_is_writable($filename)))
			{
				break;
			}

		default:
			return false;
		break;
	}

	return $result;
}

/**
* Test if a file/directory is writable
*
* This function calls the native is_writable() when not running under
* Windows and it is not disabled.
*
* @param string $file Path to perform write test on
* @return bool True when the path is writable, otherwise false.
*/
function tonjaw_is_writable($file)
{
	if (strtolower(substr(PHP_OS, 0, 3)) === 'win' || !function_exists('is_writable'))
	{
		if (file_exists($file))
		{
			// Canonicalise path to absolute path
			$file = tonjaw_realpath($file);

			if (is_dir($file))
			{
				// Test directory by creating a file inside the directory
				$result = @tempnam($file, 'i_w');

				if (is_string($result) && file_exists($result))
				{
					unlink($result);

					// Ensure the file is actually in the directory (returned realpathed)
					return (strpos($result, $file) === 0) ? true : false;
				}
			}
			else
			{
				$handle = @fopen($file, 'r+');

				if (is_resource($handle))
				{
					fclose($handle);
					return true;
				}
			}
		}
		else
		{
			// file does not exist test if we can write to the directory
			$dir = dirname($file);

			if (file_exists($dir) && is_dir($dir) && tonjaw_is_writable($dir))
			{
				return true;
			}
		}

		return false;
	}
	else
	{
		return is_writable($file);
	}
}

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
* Get option bitfield from custom data
*
* @param int	$bit		The bit/value to get
* @param int	$data		Current bitfield to check
* @return bool	Returns true if value of constant is set in bitfield, else false
*/
function tonjaw_optionget($bit, $data)
{
	return ($data & 1 << (int) $bit) ? true : false;
}

/**
* Set option bitfield
*
* @param int	$bit		The bit/value to set/unset
* @param bool	$set		True if option should be set, false if option should be unset.
* @param int	$data		Current bitfield to change
*
* @return int	The new bitfield
*/
function tonjaw_optionset($bit, $set, $data)
{
	if ($set && !($data & 1 << $bit))
	{
		$data += 1 << $bit;
	}
	else if (!$set && ($data & 1 << $bit))
	{
		$data -= 1 << $bit;
	}

	return $data;
}

/**
* Get remote IP
*
* @param str		$ipAddress
* @return str		The real user IP
*/ 
function get_user_ip(){
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
	$ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
	$ip = $forward;
    }
    else
    {
	$ip = $remote;
    }
	return $ip;
    }

/**
* Get remote Mac Address. Only works in intranet application
*
* @return str		The Mac Address
*/
function get_mac($ipAddress)
{ 
    global $config, $db;
    
    $macAddr = false;
    
    if ( $config['stb_auth'] == 'ip')
    {
	  $sql = 'SELECT node_mac FROM ' . NODES_TABLE . " WHERE node_ip='" . $ipAddress . "'";
	  $result = $db->sql_query($sql);
	  
	  $macAddr[3] = $db->sql_fetchfield('node_mac');
	  $db->sql_freeresult($result);
	  
    }
    else
    {
	//$ipAddress = get_user_ip();
	if($ipAddress === $config['self_ip'])
	{
	    $macAddr[3] = $config['mac_127'];
	}
	else
	{
	    $mac = exec('/usr/sbin/arp -an ' . $ipAddress);
	    $macAddr = explode(" ", $mac);
	}
    }
    //echo '</br> real mac: ' . $lines[3];

    return $macAddr[3];  
}

/**
* Outputs correct status line header.
*
* Depending on php sapi one of the two following forms is used:
*
* Status: 404 Not Found
*
* HTTP/1.x 404 Not Found
*
* HTTP version is taken from HTTP_VERSION environment variable,
* and defaults to 1.0.
*
* Sample usage:
*
* send_status_line(404, 'Not Found');
*
* @param int $code HTTP status code
* @param string $message Message for the status code
* @return null
*/
function send_status_line($code, $message)
{
	if (substr(strtolower(@php_sapi_name()), 0, 3) === 'cgi')
	{
		// in theory, we shouldn't need that due to php doing it. Reality offers a differing opinion, though
		header("Status: $code $message", true, $code);
	}
	else
	{
		if (!empty($_SERVER['SERVER_PROTOCOL']))
		{
			$version = $_SERVER['SERVER_PROTOCOL'];
		}
		else
		{
			$version = 'HTTP/1.0';
		}
		header("$version $code $message", true, $code);
	}
}

/**
* Return a nicely formatted backtrace.
*
* Turns the array returned by debug_backtrace() into HTML markup.
* Also filters out absolute paths to Tonjaw root.
*
* @return string	HTML markup
*/
function get_backtrace()
{
	$output = '<div style="font-family: monospace;">';
	$backtrace = debug_backtrace();

	// We skip the first one, because it only shows this file/function
	unset($backtrace[0]);

	foreach ($backtrace as $trace)
	{
		// Strip the current directory from path
		$trace['file'] = !$trace['file'] ? '(not given by php)' : htmlspecialchars(tonjaw_filter_root_path($trace['file']));
		$trace['line'] = !$trace['line'] ? '(not given by php)' : $trace['line'];

		// Only show function arguments for include etc.
		// Other parameters may contain sensible information
		$argument = '';
		if (!empty($trace['args'][0]) && in_array($trace['function'], array('include', 'require', 'include_once', 'require_once')))
		{
			$argument = htmlspecialchars(tonjaw_filter_root_path($trace['args'][0]));
		}

		$trace['class'] = (!isset($trace['class'])) ? '' : $trace['class'];
		$trace['type'] = (!isset($trace['type'])) ? '' : $trace['type'];

		$output .= '<br />';
		$output .= '<b>FILE:</b> ' . $trace['file'] . '<br />';
		$output .= '<b>LINE:</b> ' . ($trace['line']) ? $trace['line'] : '' . '<br />';

		$output .= '<b>CALL:</b> ' . htmlspecialchars($trace['class'] . $trace['type'] . $trace['function']);
		$output .= '(' . (($argument !== '') ? "'$argument'" : '') . ')<br />';
	}
	$output .= '</div>';
	return $output;
}

/**
* This function returns a regular expression pattern for commonly used expressions
* Use with / as delimiter for email mode and # for url modes
* mode can be: email|bbcode_htm|url|url_inline|www_url|www_url_inline|relative_url|relative_url_inline|ipv4|ipv6
*/
function get_preg_expression($mode)
{
	switch ($mode)
	{
		case 'email':
			// Regex written by James Watts and Francisco Jose Martin Moreno
			// http://fightingforalostcause.net/misc/2006/compare-email-regex.php
			return '([\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+\.)*(?:[\w\!\#$\%\'\*\+\-\/\=\?\^\`{\|\}\~]|&amp;)+@((((([a-z0-9]{1}[a-z0-9\-]{0,62}[a-z0-9]{1})|[a-z])\.)+[a-z]{2,63})|(\d{1,3}\.){3}\d{1,3}(\:\d{1,5})?)';
		break;

		case 'bbcode_htm':
			return array(
				'#<!\-\- e \-\-><a href="mailto:(.*?)">.*?</a><!\-\- e \-\->#',
				'#<!\-\- l \-\-><a (?:class="[\w-]+" )?href="(.*?)(?:(&amp;|\?)sid=[0-9a-f]{32})?">.*?</a><!\-\- l \-\->#',
				'#<!\-\- ([mw]) \-\-><a (?:class="[\w-]+" )?href="(.*?)">.*?</a><!\-\- \1 \-\->#',
				'#<!\-\- s(.*?) \-\-><img src="\{SMILIES_PATH\}\/.*? \/><!\-\- s\1 \-\->#',
				'#<!\-\- .*? \-\->#s',
				'#<.*?>#s',
			);
		break;

		// Whoa these look impressive!
		// The code to generate the following two regular expressions which match valid IPv4/IPv6 addresses
		// can be found in the develop directory
		case 'ipv4':
			return '#^(?:(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$#';
		break;

		case 'ipv6':
			return '#^(?:(?:(?:[\dA-F]{1,4}:){6}(?:[\dA-F]{1,4}:[\dA-F]{1,4}|(?:(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])))|(?:::(?:[\dA-F]{1,4}:){0,5}(?:[\dA-F]{1,4}(?::[\dA-F]{1,4})?|(?:(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])))|(?:(?:[\dA-F]{1,4}:):(?:[\dA-F]{1,4}:){4}(?:[\dA-F]{1,4}:[\dA-F]{1,4}|(?:(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])))|(?:(?:[\dA-F]{1,4}:){1,2}:(?:[\dA-F]{1,4}:){3}(?:[\dA-F]{1,4}:[\dA-F]{1,4}|(?:(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])))|(?:(?:[\dA-F]{1,4}:){1,3}:(?:[\dA-F]{1,4}:){2}(?:[\dA-F]{1,4}:[\dA-F]{1,4}|(?:(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])))|(?:(?:[\dA-F]{1,4}:){1,4}:(?:[\dA-F]{1,4}:)(?:[\dA-F]{1,4}:[\dA-F]{1,4}|(?:(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])))|(?:(?:[\dA-F]{1,4}:){1,5}:(?:[\dA-F]{1,4}:[\dA-F]{1,4}|(?:(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])))|(?:(?:[\dA-F]{1,4}:){1,6}:[\dA-F]{1,4})|(?:(?:[\dA-F]{1,4}:){1,7}:)|(?:::))$#i';
		break;

		case 'url':
		case 'url_inline':
			$inline = ($mode == 'url') ? ')' : '';
			$scheme = ($mode == 'url') ? '[a-z\d+\-.]' : '[a-z\d+]'; // avoid automatic parsing of "word" in "last word.http://..."
			// generated with regex generation file in the develop folder
			return "[a-z]$scheme*:/{2}(?:(?:[a-z0-9\-._~!$&'($inline*+,;=:@|]+|%[\dA-F]{2})+|[0-9.]+|\[[a-z0-9.]+:[a-z0-9.]+:[a-z0-9.:]+\])(?::\d*)?(?:/(?:[a-z0-9\-._~!$&'($inline*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~!$&'($inline*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:\#(?:[a-z0-9\-._~!$&'($inline*+,;=:@/?|]+|%[\dA-F]{2})*)?";
		break;

		case 'www_url':
		case 'www_url_inline':
			$inline = ($mode == 'www_url') ? ')' : '';
			return "www\.(?:[a-z0-9\-._~!$&'($inline*+,;=:@|]+|%[\dA-F]{2})+(?::\d*)?(?:/(?:[a-z0-9\-._~!$&'($inline*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~!$&'($inline*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:\#(?:[a-z0-9\-._~!$&'($inline*+,;=:@/?|]+|%[\dA-F]{2})*)?";
		break;

		case 'relative_url':
		case 'relative_url_inline':
			$inline = ($mode == 'relative_url') ? ')' : '';
			return "(?:[a-z0-9\-._~!$&'($inline*+,;=:@|]+|%[\dA-F]{2})*(?:/(?:[a-z0-9\-._~!$&'($inline*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~!$&'($inline*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:\#(?:[a-z0-9\-._~!$&'($inline*+,;=:@/?|]+|%[\dA-F]{2})*)?";
		break;

		case 'table_prefix':
			return '#^[a-zA-Z][a-zA-Z0-9_]*$#';
		break;
		
		case 'mac':
			return '/[\d|A-F]{2}\-[\d|A-F]{2}\-[\d|A-F]{2}\-[\d|A-F]{2}\-[\d|A-F]{2}\-[\d|A-F]{2}/i';
		break;
	}

	return '';
}


// Pagination functions

/**
* Pagination routine, generates page number sequence
* tpl_prefix is for using different pagination blocks at one page
*/
function generate_pagination($base_url, $num_items, $per_page, $start_item, $add_prevnext_text = false, $tpl_prefix = '')
{
	global $template, $config, $adm_lang;

	// Make sure $per_page is a valid value
	$per_page = ($per_page <= 0) ? 1 : $per_page;

	$seperator = '<span class="page-sep">' . $adm_lang['comma_separator'] . '</span>';
	$total_pages = ceil($num_items / $per_page);

	if ($total_pages == 1 || !$num_items)
	{
		return false;
	}

	$on_page = floor($start_item / $per_page) + 1;
	$url_delim = (strpos($base_url, '?') === false) ? '?' : ((strpos($base_url, '?') === strlen($base_url) - 1) ? '' : '&amp;');

	$page_string = ($on_page == 1) ? '<strong>1</strong>' : '<a href="' . $base_url . '">1</a>';

	if ($total_pages > 5)
	{
		$start_cnt = min(max(1, $on_page - 4), $total_pages - 5);
		$end_cnt = max(min($total_pages, $on_page + 4), 6);

		$page_string .= ($start_cnt > 1) ? '<span class="page-dots"> ... </span>' : $seperator;

		for ($i = $start_cnt + 1; $i < $end_cnt; $i++)
		{
			$page_string .= ($i == $on_page) ? '<strong>' . $i . '</strong>' : '<a href="' . $base_url . "{$url_delim}start=" . (($i - 1) * $per_page) . '">' . $i . '</a>';
			if ($i < $end_cnt - 1)
			{
				$page_string .= $seperator;
			}
		}

		$page_string .= ($end_cnt < $total_pages) ? '<span class="page-dots"> ... </span>' : $seperator;
	}
	else
	{
		$page_string .= $seperator;

		for ($i = 2; $i < $total_pages; $i++)
		{
			$page_string .= ($i == $on_page) ? '<strong>' . $i . '</strong>' : '<a href="' . $base_url . "{$url_delim}start=" . (($i - 1) * $per_page) . '">' . $i . '</a>';
			if ($i < $total_pages)
			{
				$page_string .= $seperator;
			}
		}
	}

	$page_string .= ($on_page == $total_pages) ? '<strong>' . $total_pages . '</strong>' : '<a href="' . $base_url . "{$url_delim}start=" . (($total_pages - 1) * $per_page) . '">' . $total_pages . '</a>';

	if ($add_prevnext_text)
	{
		if ($on_page != 1)
		{
			$page_string = '<a href="' . $base_url . "{$url_delim}start=" . (($on_page - 2) * $per_page) . '">' . $adm_lang['previous'] . '</a>&nbsp;&nbsp;' . $page_string;
		}

		if ($on_page != $total_pages)
		{
			$page_string .= '&nbsp;&nbsp;<a href="' . $base_url . "{$url_delim}start=" . ($on_page * $per_page) . '">' . $adm_lang['next'] . '</a>';
		}
	}

	$template->assign_vars(array(
		$tpl_prefix . 'BASE_URL'		=> $base_url,
		'A_' . $tpl_prefix . 'BASE_URL'		=> addslashes($base_url),
		$tpl_prefix . 'PER_PAGE'		=> $per_page,

		$tpl_prefix . 'PREVIOUS_PAGE'		=> ($on_page == 1) ? '' : $base_url . "{$url_delim}start=" . (($on_page - 2) * $per_page),
		$tpl_prefix . 'NEXT_PAGE'		=> ($on_page == $total_pages) ? '' : $base_url . "{$url_delim}start=" . ($on_page * $per_page),
		$tpl_prefix . 'TOTAL_PAGES'		=> $total_pages,
	));

	return $page_string;
}

/**
* Return current page (pagination)
*/
function on_page($num_items, $per_page, $start)
{
	global $template, $adm_lang;

	// Make sure $per_page is a valid value
	$per_page = ($per_page <= 0) ? 1 : $per_page; 

	//echo 'per page: ' . $per_page . '</br>';
	$on_page = floor($start / $per_page) + 1;

	//echo 'on page: ' . $on_page . '</br>';
	$template->assign_vars(array(
		'ON_PAGE'	=> $on_page)
	);

	return sprintf($adm_lang['page_of'], $on_page, max(ceil($num_items / $per_page), 1));
}

// Server functions (building urls, redirecting...)

/**
* Append session id to url.
*
* @param string $url The url the session id needs to be appended to (can have params)
* @param mixed $params String or array of additional url parameters
* @param bool $is_amp Is url using &amp; (true) or & (false)
* @param string $session_id Possibility to use a custom session id instead of the global one
*
* Examples:
* <code>
* append_sid("{$tonjaw_root_path}index.$phpEx?t=1&amp;f=2");
* append_sid("{$tonjaw_root_path}index.$phpEx", 't=1&amp;f=2');
* append_sid("{$tonjaw_root_path}index.$phpEx", 't=1&f=2', false);
* append_sid("{$tonjaw_root_path}index.$phpEx", array('t' => 1, 'f' => 2));
* </code>
*
*/
function append_sid($url, $params = false, $is_amp = true, $session_id = false)
{
	global $_SID, $_EXTRA_URL, $session;

	if ($params === '' || (is_array($params) && empty($params)))
	{
		// Do not append the ? if the param-list is empty anyway.
		$params = false;
	}

	$params_is_array = is_array($params);

	// Get anchor
	$anchor = '';
	if (strpos($url, '#') !== false)
	{
		list($url, $anchor) = explode('#', $url, 2);
		$anchor = '#' . $anchor;
	}
	else if (!$params_is_array && strpos($params, '#') !== false)
	{
		list($params, $anchor) = explode('#', $params, 2);
		$anchor = '#' . $anchor;
	}

	// Handle really simple cases quickly
	if ($session->session_id == '' && $session_id === false && !$params_is_array && !$anchor)
	{
		if ($params === false)
		{
			return $url;
		}

		$url_delim = (strpos($url, '?') === false) ? '?' : (($is_amp) ? '&amp;' : '&');
		return $url . ($params !== false ? $url_delim. $params : '');
	}

	// Assign sid if session id is not specified
	if ($session_id === false)
	{
		$session_id = $session->session_id;
	}

	$amp_delim = ($is_amp) ? '&amp;' : '&';
	$url_delim = (strpos($url, '?') === false) ? '?' : $amp_delim;

	// Appending custom url parameter?
	$append_url = '';

	// Use the short variant if possible ;)
	if ($params === false)
	{
		// Append session id
		if (!$session_id)
		{
			return $url . (($append_url) ? $url_delim . $append_url : '') . $anchor;
		}
		else
		{
			return $url . (($append_url) ? $url_delim . $append_url . $amp_delim : $url_delim) . 'sid=' . $session_id . $anchor;
		}
	}

	// Build string if parameters are specified as array
	if (is_array($params))
	{
		$output = array();

		foreach ($params as $key => $item)
		{
			if ($item === NULL)
			{
				continue;
			}

			if ($key == '#')
			{
				$anchor = '#' . $item;
				continue;
			}

			$output[] = $key . '=' . $item;
		}

		$params = implode($amp_delim, $output);
	}

	// Append session id and parameters (even if they are empty)
	// If parameters are empty, the developer can still append his/her parameters without caring about the delimiter
	return $url . (($append_url) ? $url_delim . $append_url . $amp_delim : $url_delim) . $params . ((!$session_id) ? '' : $amp_delim . 'sid=' . $session_id) . $anchor;
}


/**
* Generate board url (example: http://www.example.com/Tonjaw)
*
* @param bool $without_script_path if set to true the script path gets not appended (example: http://www.example.com)
*
* @return string the generated board url
*/
function generate_board_url($without_script_path = false)
{
	global $config;

	//$server_name = $user->host;
	$server_port = ($_SERVER['SERVER_PORT']) ? (int) $_SERVER['SERVER_PORT'] : (int) getenv('SERVER_PORT');

	//$server_protocol = ($config['server_protocol']) ? $config['server_protocol'] : (($config['cookie_secure']) ? 'https://' : 'http://');
	
	if ( $config['server_protocol'] )
	{
	    $server_protocol = $config['server_protocol'];
	}
	else
	{
	    $server_protocol = ($config['cookie_secure']) ? 'https://' : 'http://';
	}
	
	$server_name = $config['server_name'];
	$server_port = (int) $config['server_port'];
	$script_path = $config['script_path'];

	$url = $server_protocol . $server_name;
	$cookie_secure = $config['cookie_secure'];

	/*
	// Forcing server vars is the only way to specify/override the protocol
	if ($config['force_server_vars'] || !$server_name)
	{
		$server_protocol = ($config['server_protocol']) ? $config['server_protocol'] : (($config['cookie_secure']) ? 'https://' : 'http://');
		$server_name = $config['server_name'];
		$server_port = (int) $config['server_port'];
		$script_path = $config['script_path'];

		$url = $server_protocol . $server_name;
		$cookie_secure = $config['cookie_secure'];
	}
	else
	{
		// Do not rely on cookie_secure, users seem to think that it means a secured cookie instead of an encrypted connection
		$cookie_secure = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 1 : 0;
		$url = (($cookie_secure) ? 'https://' : 'http://') . $server_name;

		$script_path = $user->page['root_script_path'];
	}
*/
	if ($server_port && (($cookie_secure && $server_port <> 443) || (!$cookie_secure && $server_port <> 80)))
	{
		// HTTP HOST can carry a port number (we fetch $user->host, but for old versions this may be true)
		if (strpos($server_name, ':') === false)
		{
			$url .= ':' . $server_port;
		}
	}

	if (!$without_script_path)
	{
		$url .= $script_path;
	}

	// Strip / from the end
	if (substr($url, -1, 1) == '/')
	{
		$url = substr($url, 0, -1);
	}

	return $url;
}

/**
* Redirects the user to another page then exits the script nicely
* This function is intended for urls within the board. It's not meant to redirect to cross-domains.
*
* @param string $url The url to redirect to
* @param bool $return If true, do not redirect but return the sanitized URL. Default is no return.
* @param bool $disable_cd_check If true, redirect() will redirect to an external domain. If false, the redirect point to the boards url if it does not match the current domain. Default is false.
*/

function redirect($url, $sid='')
{
    global $config;

    if (strstr(urldecode($url), "\n") || strstr(urldecode($url), "\r"))
    {
	trigger_error('Tried to redirect to potentially insecure url.', E_USER_ERROR);
    }

    $server_protocol = ($config['cookie_secure']) ? 'https://' : 'http://';
    $server_name = preg_replace('#^\/?(.*?)\/?$#', '\1', trim($config['server_name']));
    $server_port = ($config['server_port'] <> 80) ? ':' . trim($config['server_port']) : '';
    $script_name = preg_replace('#^\/?(.*?)\/?$#', '\1', trim($config['script_path']));
    $script_name = ($script_name == '') ? $script_name : '/' . $script_name;
    $url = preg_replace('#^\/?(.*?)\/?$#', '/\1', trim($url));
/*
echo "sp: $server_protocol<br>";
echo "sn: $server_name<br>";
echo "sp: $server_port<br>";
echo "sn: $script_name<br>";
echo "redir: $url"; exit;
*/
    // Redirect via an HTML form for PITA webservers
    if (@preg_match('/Microsoft|WebSTAR|Xitami/', getenv('SERVER_SOFTWARE')))
    {
	header('Refresh: 0; URL=' . $server_protocol . $server_name . $server_port . $script_name . $url);
	echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><meta http-equiv="refresh" content="0; url=' . $server_protocol . $server_name . $server_port . $script_name . $url . '"><title>Redirect</title></head><body><div align="center">If your browser does not support meta redirection please click <a href="' . $server_protocol . $server_name . $server_port . $script_name . $url . '">HERE</a> to be redirected</div></body></html>';
	exit;
    }
    
    if (!empty($sid))
    {
	$url .= '?sid=' . $sid;
    }
    
    //echo 'path dirname: ' . $pathinfo['dirname'] . '<p>url: ' . $url; exit;
    // Behave as per HTTP/1.1 spec for others
    header('location: ' . $server_protocol . $server_name . $server_port . $script_name . $url);
    exit;
}


// Little helpers

/**
* Little helper for the build_hidden_fields function
*/
function _build_hidden_fields($key, $value, $specialchar, $stripslashes)
{
	$hidden_fields = '';

	if (!is_array($value))
	{
		$value = ($stripslashes) ? stripslashes($value) : $value;
		$value = ($specialchar) ? htmlspecialchars($value, ENT_COMPAT, 'UTF-8') : $value;

		$hidden_fields .= '<input type="hidden" name="' . $key . '" value="' . $value . '" />' . "\n";
	}
	else
	{
		foreach ($value as $_key => $_value)
		{
			$_key = ($stripslashes) ? stripslashes($_key) : $_key;
			$_key = ($specialchar) ? htmlspecialchars($_key, ENT_COMPAT, 'UTF-8') : $_key;

			$hidden_fields .= _build_hidden_fields($key . '[' . $_key . ']', $_value, $specialchar, $stripslashes);
		}
	}

	return $hidden_fields;
}

/**
* Build simple hidden fields from array
*
* @param array $field_ary an array of values to build the hidden field from
* @param bool $specialchar if true, keys and values get specialchared
* @param bool $stripslashes if true, keys and values get stripslashed
*
* @return string the hidden fields
*/
function build_hidden_fields($field_ary, $specialchar = false, $stripslashes = false)
{
	$s_hidden_fields = '';

	foreach ($field_ary as $name => $vars)
	{
		$name = ($stripslashes) ? stripslashes($name) : $name;
		$name = ($specialchar) ? htmlspecialchars($name, ENT_COMPAT, 'UTF-8') : $name;

		$s_hidden_fields .= _build_hidden_fields($name, $vars, $specialchar, $stripslashes);
	}

	return $s_hidden_fields;
}

/**
* Add log event
*/
function add_log($action='', $data='')
{
	global $db, $session;

	if (!empty($GLOBALS['skip_add_log']))
	{
		return false;
	}

	$sql_ary = array(
		'log_time'		=> (int) time(),
		'log_action'		=> (string) strtoupper($action),
		'log_data'		=> (string) $data,
		'log_user'		=> (string) $session->username,
		'log_module'		=> (string) $session->module,
		'log_mac'		=> (string) $session->mac,
		'log_browser'		=> (string) trim(substr($session->browser, 0, 149)),
	);

	$db->sql_query('INSERT INTO ' . LOGS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary));


	return $db->sql_nextid();
}

/**
* Generate login box or verify password
*/
function login_box($redirect = '', $l_explain = '', $l_success = '', $admin = true, $l_log = '')
{
	global $db, $template, $adm_lang, $auth, $phpEx, $tonjaw_root_path, $config;

	$err = '';
	$login_info = '';

	$template->set_template();
	
	$s_hidden_fields = array(
		'sid'		=> md5(time()),
	);

	// Assign credential for username/password pair
	$credential = ($admin) ? md5(unique_id()) : false;

	if ($redirect)
	{
		$s_hidden_fields['redirect'] = $redirect;
	}

	if ($admin)
	{
		$s_hidden_fields['credential'] = $credential;
	}

	$s_hidden_fields = build_hidden_fields($s_hidden_fields);
	
	//echo $credential . ' crotz';
	if ($l_success === false)
	{
	   $login_info = $l_explain; //$adm_lang['Error_login'];
	}

	$template->assign_vars(array(
		'SITENAME'		=> $adm_lang['site_title'],
		'SITE_DESCRIPTION'	=> $adm_lang['site_desc'],
		'PAGE_TITLE'		=> $adm_lang['login_page_title'],
		'FORM_TITLE'		=> $adm_lang['login_form_title'],
		'T_THEME_PATH'		=> $tonjaw_root_path . $config['theme_path'],
		'T_TEMPLATE_PATH'	=> $tonjaw_root_path . $config['template_path'],
		'S_LOGIN_ACTION'	=> $tonjaw_root_path . $config['admin_path'] . 'index.' . $phpEx,
		'S_HIDDEN_FIELDS' 	=> $s_hidden_fields,
		'L_USERNAME'		=> $adm_lang['username'],
		'L_LOG'			=> $l_log,
		'L_PASSWORD'		=> $adm_lang['password'],
		'L_LOGIN_INFO'		=> $login_info,
		'L_LOGIN'		=> $adm_lang['login']
	));

	//page_header($user->lang['LOGIN'], false);

	$template->set_filenames(array(
		'body' => 'login_body.tpl')
	);
	
	page_footer();
}



/**
* Generate page header
*/
function page_header($lang_id, $page='')
{
    global $config, $template, $tonjaw_root_path, $lang, $pms;

    if (defined('HEADER_INC'))
    {
	return;
    }

    define('HEADER_INC', true);
    
    // CEK NEW MESSAGE
    $new_message = check_message();
    //$new_message = false; 
    if($new_message)
    {
	$message_flag = 1;
	$new_message = $lang['you_got_message'];

    }
    
    //echo 'bleh'; exit;
    $running_text = grab_running_text($lang_id, $page);
    //$running_text = '';
    $running_text = (!empty($running_text)) ? $running_text : '';
	/*if(empty($running_text)) {
		$show_running_text = 0;
	} else {
		$show_running_text = 1;
	}*/
    
    //echo $running_text; exit;
    $page_title = get_page_title($page, $lang_id);

    $template->assign_vars(array(
	'SITENAME'		=> $config['site_name'],
	'L_PAGE_TITLE'		=> prepare_message($page_title),
	'T_THEME_PATH'		=> $tonjaw_root_path . $config['theme_path'],
	'T_JS_PATH'		=> $tonjaw_root_path . $config['js_path'],
	'SITE_DESCRIPTION'	=> $adm_lang['site_desc'],
	'CURRENT_TIME'		=> date($config['header_dateformat']),
// INSERT DATATABLE SCRIPT
	'T_IMAGESET_PATH'	=> $tonjaw_root_path . $config['imageset_path'],
	'T_MEDIA_IMAGES_PATH'	=> $tonjaw_root_path . $config['media_path'] . $config['image_path'],
	//'T_DATATABLE_PATH'	=> $tonjaw_root_path . $config['datatable_path'],
	'S_USER_LANG'		=> ($lang_id=='en' || $lang_id=='id') ? 'navicom-normal' : $lang_id,
	'S_USER_LANG_ID'	=> $lang_id,
	//'S_RUNNINGTEXT'		=> $lang['temp_running_text'],
	'S_RUNNINGTEXT'		=> $running_text,
	//'S_SHOW_RUNNINGTEXT'	=> $show_running_text,
	'S_NEW_MESSAGE'		=> $new_message,

    ));

    // application/xhtml+xml not used because of IE
    header('Content-type: text/html; charset=UTF-8');

    header('Cache-Control: private, no-cache="set-cookie"');
    header('Expires: 0');
    header('Pragma: no-cache');

    return;

}

/**
* Grab Running Text
*/
function grab_running_text($lang_id, $page)
{
    global $node_id, $db, $config, $session, $lang;
    //global $db, $config, $template, $session, $lang, $home_menu, $guests_name, $phpEx, $pms_config, $pmsname;
    
    $sql = 'SELECT menu_runningtext_enabled FROM ' . MENUS_TABLE . " 
	WHERE menu_url='" . $page . "'";
	
    $result = $db->sql_query($sql);
    $runningtext_enabled = $db->sql_fetchfield('menu_runningtext_enabled');
    $text = '';
    $db->sql_freeresult($result);
    
	delete_roomservice_notification($lang_id);
	
    if ( $runningtext_enabled == 1 || $page === 'index.php')
    {
		/*
		$sql = 'SELECT t.translation_message, r.message_id 
			FROM ' . RUNNINGTEXT_TABLE . ' r 
			JOIN ' . RUNNINGTEXT_TRANSLATIONS_TABLE . " t ON t.message_id=r.message_id 
			LEFT JOIN " . RUNNINGTEXT_GROUPINGS_TABLE . " rg ON r.message_id=rg.message_id 
			LEFT JOIN " . ROOMS_TABLE . " ro ON ro.room_id=rg.room_id 
			LEFT JOIN " . NODES_TABLE . " n ON n.room_id=ro.room_id
			LEFT JOIN " . ZONES_TABLE . " z ON z.zone_id=ro.zone_id 
			WHERE t.language_id='" . $lang_id . "' AND r.message_global=1 AND r.message_enabled=1 
			OR n.node_id=$node_id";
		*/ 
		
		if( !$config['mobile'] )
		{
			$node_id = $node_id ? $node_id : 0;
			
			$sql = 'SELECT r.room_id, z.zone_id 
			FROM ' . ZONES_TABLE . ' z JOIN ' . ROOMS_TABLE . ' r ON r.zone_id=z.zone_id 
			JOIN ' . NODES_TABLE . " n ON n.room_id=r.room_id WHERE n.node_id=$node_id";
			//echo $sql; exit;
			
			$result = $db->sql_query($sql);
			while ($row = $db->sql_fetchrow($result))
			{
			$room_id = $row['room_id'];
			$zone_id = $row['zone_id'];
			}
			$db->sql_freeresult($result);    
		
		}
		
		if( !empty($room_id) && !empty($zone_id) )
		{
			/*$sql = 'SELECT t.translation_message, r.message_id, r.message_global, g.room_id, z.zone_id, r.message_daily, r.message_schedule_start, r.message_schedule_end
			FROM ' . RUNNINGTEXT_TABLE . ' r 
			JOIN ' . RUNNINGTEXT_TRANSLATIONS_TABLE . ' t ON t.message_id=r.message_id 
			LEFT JOIN ' . RUNNINGTEXT_GROUPINGS_TABLE . ' g ON g.message_id=r.message_id 
			LEFT JOIN ' . RUNNINGTEXT_ZONE_GROUPINGS_TABLE . " z ON z.message_id=r.message_id 
			WHERE t.language_id='" . $lang_id . "' AND r.message_enabled=1";    
			*/
			$sql = 'SELECT t.translation_message, r.message_id, r.message_global, n.node_id, g.room_id, z.zone_id, r.message_daily, r.message_schedule_start, r.message_schedule_end 
			FROM ' . RUNNINGTEXT_TABLE . ' r 
			JOIN ' . RUNNINGTEXT_TRANSLATIONS_TABLE . " t ON t.message_id=r.message_id 
			LEFT JOIN " . RUNNINGTEXT_GROUPINGS_TABLE . " g ON r.message_id=g.message_id 
			LEFT JOIN " . ROOMS_TABLE . " ro ON ro.room_id=g.room_id 
			LEFT JOIN " . NODES_TABLE . " n ON n.room_id=ro.room_id
			LEFT JOIN " . ZONES_TABLE . " z ON z.zone_id=ro.zone_id 
			WHERE t.language_id='" . $lang_id . "' AND r.message_enabled=1 
			";
			$orderby = ' ORDER BY message_order ASC';
			//echo $sql.$orderby; exit;
			$result = $db->sql_query($sql.$orderby);
			$text = ''; $temp_text = array();
			
			while ($row = $db->sql_fetchrow($result))
			{
				
				$filter = "";
		
				//if( $row['room_id'] == $room_id || $row['zone_id'] == $zone_id )
				//{
					//if($row['message_daily']) { // kalo daily=1, lihat timenya saja
						$current_time = date("His");
						$start_time = date("His", $row['message_schedule_start']);
						$end_time = date("His", $row['message_schedule_end']);
						$end_hour = substr($end_time,0,2);
						if($end_hour == '00') {
							$end_time = str_replace($end_hour, '24', $end_time);
						}
						
						//echo date("His", time()); exit;
						if($current_time >= $start_time && $current_time <= $end_time) {
							//echo $current_time.' '.$start_time.' '.$end_time;
							$filter .= " AND (message_schedule_start <= ".time()." OR message_schedule_end >= ".time().") AND r.message_id = ".$row['message_id']."";
							
							if( $row['message_global'] == 1) {
								$filter .= " AND (n.node_id=$node_id OR r.message_global=1)";
							} else {
								$filter .= " AND n.node_id=$node_id";
							}
						}
					/*} else {
						$mktime = mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"));
						//$filter = " AND (message_schedule_start <= ".$mktime." AND message_schedule_end >= ".$mktime.")";
						$filter = " AND ((message_schedule_start <= ".time()." AND message_schedule_end >= ".time().") AND n.node_id=$node_id)";
						
						if( $row['message_global'] == 1) {
							$filter .= " AND r.message_global=1";
						}
					}*/
				//}
				
				if(!empty($filter)) {
					$sql2 = $sql.$filter;
					//echo $sql2; //exit;
					$result2 = $db->sql_query($sql2);
					$i = 0;
					while ($row2 = $db->sql_fetchrow($result2))
					{	//echo $i.' -- '.$temp_text[$i].' -- '.$text.'<br>'; 
						if(!in_array($row2['translation_message'], $temp_text)) {
							$text .= $row2['translation_message'] . '. ';
							$temp_text[$i] = $row2['translation_message'];
							$i++;
						}	
					}
				}
				
				/*$filter = "";
				if( $row['message_global'] == 1) {
					$filter = " AND r.message_global=1 ";
				}
				
				if($row['room_id'] == $room_id || $row['zone_id'] == $zone_id )
				{
					if($row['message_daily']) { // kalo daily=1, lihat timenya saja
						$current_time = date("His");
						$start_time = date("His", $row['message_schedule_start']);
						$end_time = date("His", $row['message_schedule_end']);
							
						if($current_time >= $start_time && $current_time <= $end_time) {
							$filter .= " AND (r.message_id = ".$row['message_id']."";
						}
					} else {
						$filter .= " AND ((message_schedule_start <= ".time()." AND message_schedule_end >= ".time().")";
					}

					if(!empty($filter)) { 
						$sql2 = $sql.$filter." OR n.node_id=$node_id)";
						//echo $sql2; exit;
						$result2 = $db->sql_query($sql2);
						while ($row2 = $db->sql_fetchrow($result2))
						{
							if($temp_text != $row2['translation_message']) {
								$text .= $row2['translation_message'] . '. ';
								$temp_text = $row2['translation_message'];
							}	
						}
					}
					
				}*/ 
			}
			$db->sql_freeresult($result);
			
			$guest = get_guests_data();

			$guest_name = $guest[0]['salutation'].' '.$guest[0]['fullname'];
			
			if(in_array($session->ip, $config['list_ip_static'])) {
				$text = str_replace('[GUEST]', $lang['guest_greetings'], $text);
			} else {
				$text = str_replace('[GUEST]', $guest_name, $text);
			}
			//echo $text; exit;
		} 
		
		
	
    } 
	return $text;
}

/**
* Generate page footer
*/
function page_footer($show_running_text = true, $page='')
{
	global $db, $template, $adm_lang, $user;
	
	if($page != '') {
		$sql = 'SELECT menu_runningtext_enabled FROM ' . MENUS_TABLE . " 
		WHERE menu_url='" . $page . "'";
		
		$result = $db->sql_query($sql);
		$show_running_text = $db->sql_fetchfield('menu_runningtext_enabled');
	}
	
	$template->assign_vars(array(
		'DEBUG_OUTPUT'		=> (defined('DEBUG')) ? $debug_output : '',
		'TRANSLATION_INFO'	=> ($user->lang['TRANSLATION_INFO']) ? $user->lang['TRANSLATION_INFO'] : '',
		'CREDIT_LINE'		=> $adm_lang['powered_by'] . $adm_lang['owner_name'],
		'S_SHOW_RUNNINGTEXT'	=> $show_running_text,
	));

	$template->display('body');

	garbage_collection();
	exit_handler();
}


/**
* Closing the cache object and the database
* Cool function name, eh? We might want to add operations to it later
*/
function garbage_collection()
{
	global $cache, $db;

	// Unload cache, must be done before the DB connection if closed
	if (!empty($cache))
	{
		$cache->unload();
	}

	// Close our DB connection.
	if (!empty($db))
	{
		$db->sql_close();
	}
}

/**
* Handler for exit calls in Tonjaw.
* This function supports hooks.
*
* Note: This function is called after the template has been outputted.
*/
function exit_handler()
{

	// As a pre-caution... some setups display a blank page if the flush() is not there.
	(ob_get_level() > 0) ? @ob_flush() : @flush();

	exit;
}

/**
* custom version of nl2br which takes custom BBCodes into account
*/
function bbcode_nl2br($text)
{
	// custom BBCodes might contain carriage returns so they
	// are not converted into <br /> so now revert that
	$text = str_replace(array("\n", "\r"), array('<br />', "\n"), $text);
	return $text;
}

function prepare_message($message)
{
	$unhtml_specialchars_match = array('#&gt;#', '#&lt;#', '#&quot;#', '#&amp;#');
	$unhtml_specialchars_replace = array('>', '<', '"', '&');

	return preg_replace($unhtml_specialchars_match, $unhtml_specialchars_replace, $message);
}

/**
* Content 
* 
*/

/**
* Get Movie Genre
*
* Param		$selected_item		array 
*/

function get_movie_genre($lang, $movie_id)
{
    global $db, $config;

    if(empty($lang))
    {
	$lang = $config['default_language'];
    }
    
    $sql = "SELECT t.translation_title FROM " . MOVIE_GROUPS_TABLE . " g, " . 
	    MOVIE_GROUPINGS_TABLE . " gp, " . 
	    MOVIE_GROUP_TRANSLATIONS_TABLE . " t 
	    WHERE g.movie_group_id = gp.movie_group_id  
	    AND g.movie_group_id=t.movie_group_id 
	    AND g.movie_group_enabled = 1 
	    AND t.language_id = '" . $lang . "'
	    AND gp.movie_id = " . $movie_id . "   
	    ORDER BY t.translation_title";

	$result = $db->sql_query($sql);
	$i = 0;
	
	while ($row = $db->sql_fetchrow($result))
	{
	    if($i == sizeof($result))
	    {
		$genres .= $row['translation_title'];
	    }
	    else
	    {
		$genres .= $row['translation_title'] . ', ';
	    }
	    //$selected = ( in_array($row['movie_group_id'], $selected_item)) ? ' selected="selected"' : '';
	    
	    $i++;
	}
	
	$db->sql_freeresult($result);
	
    
    return $genres;
}

/**
* Authenticate client  
* 
*/

function authenticate_room(&$room_id, $room_key, &$lang_id, &$node_id)
{
    global $config, $db, $session, $lang, $navicoms;
    
    //print_r($navicoms); exit;
     
    
    /* if ( in_array($session->mac, $navicoms) )
    {
	$session->mac_exist = 1;
    } */
    
    // Legal STB
    //if ($session->mac_exist && empty($room_key))
    if (empty($room_key))
    {
	// Check http header browser
	$header = trim(substr($session->browser, 0, 149));
/* PENDING -  WAITING FOR STB UPDATE HTTP HEADER 
	if(trim($header) !== $config['stb_http_header'] && !in_array($session->mac, $navicoms))
	{
	    die($lang['Error_invalid_client']);
	    

	}*/
	
	switch ( $config['stb_auth'] )
	{
	    case 'mac':
		$sql = 'SELECT r.room_id, r.room_key, n.node_lang_id, n.node_id, room_name FROM ' . 
		    ROOMS_TABLE . " r, " . NODES_TABLE . " n WHERE r.room_id=n.room_id AND n.node_mac='" . $session->mac . "'";
	    
		break;
		
	    case 'ip':
		$sql = 'SELECT r.room_id, r.room_key, n.node_lang_id, n.node_id, room_name FROM ' . 
		    ROOMS_TABLE . " r, " . NODES_TABLE . " n WHERE r.room_id=n.room_id AND n.node_ip='" . $session->ip . "'";
		break;
	}
	//echo $sql;exit;
	//return true;
    }
    
    // Illegal STB and Android/IPad  
    if (!$session->mac_exist && empty($room_key))
    {
	echo '<span style="background: #fff">' . $lang['Error_nomac_nokey'] . '</span>'; exit;
	//die($lang['Error_nomac_nokey']);
    }
    
    // Android/IPad
    if (!empty($room_key))
    {
	$sql = 'SELECT r.room_id, room_key, room_enabled, node_id, node_lang_id, room_name FROM ' . ROOMS_TABLE . " r , " . NODES_TABLE . " n
	    WHERE r.room_id=n.room_id AND room_key='" . $room_key . "'"; // AND n.node_ip='" . $session->ip . "'";
    }
    
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
	//print_r($data);exit;
	//echo 'room key: ' . $room_key . '<br>';
	$room_id = $data['room_id'];
    $room_key = $data['room_key'];
	$guests_name = get_guests_data();
	
	$config['default_language'] = $guests_name[0]['language'];
    //$lang_id = (!$data['node_lang_id'])? $config['default_language'] : $data['node_lang_id'];
    $lang_id = !empty($data['node_lang_id']) ? $data['node_lang_id'] : $config['default_language'];
    $node_id = $data['node_id'];
    //echo '<div style="color:yellow;margin:50px;">'.$sql.'</div>';
    //print_r($data); exit;
	
	
    if ( in_array($session->mac, $navicoms) )
    {
	//$room_id = 'Navicoms';
    }
    
    //Android/IPad invalid room_key
    if( empty($room_id) )
    {
	//die($lang['Error_invalid_room_key']); 
echo '<html><body bgcolor=#fff>Client/STB name: ' . $node_name; 
echo '</br>kKKKKKEEEEEEYYYYYYY: ' . $session->ip;
echo '</br>Client/STB mac: ' . $session->mac;
echo '</br>Client/STB browser: ' . trim(substr($session->browser, 0, 149));
echo '</br>Client/STB feature: ' . $session->module;
echo '</div></body><html>';
exit;

    }
    
    return true;
}

function get_runningtext() 
{
    global $db, $config;

    $sql = "SELECT r.message_id AS id, r.message_global AS type, r.message_enabled, t.translation_message AS message
	FROM " . RUNNINGTEXT_TABLE . " r 
    JOIN " . RUNNINGTEXT_TRANSLATIONS_TABLE . " t ON t.message_id = r.message_id 
	WHERE r.message_enabled = 1 
    AND t.language_id= '" . $config['default_language'] . "'";
    
    $result = $db->sql_query($sql);
    
    $runningtext_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
        $runningtext_data[] = $row['message'];
    }   
    
    $data = implode("&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;&nbsp;&nbsp;&nbsp;", $runningtext_data);
    $content = '<marquee scrollamount="10" loop="" style="width:1280px;">'.$data.'</marquee>';
    
    return $content;
}

function get_guests_data($mac='')
{
    global $db, $config, $room_key, $session, $tonjaw_root_path, $phpEx, $lang_id;
    
    $guests_data = array();
    
    if ( $config['mobile'] )
    {
	$filter = " r.room_key='$room_key'";
    }
    else
    {
	switch($config['stb_auth'])
	{
	    case 'mac':
		$filter = " n.node_mac='" . $session->mac . "'";
		break;
	    case 'ip':
		$filter = " n.node_ip='" . $session->ip . "'";
		break;
	}
    }

    $sql = 'SELECT r.room_name, n.node_name, g.guest_reservation_id, g.guest_firstname, g.guest_lastname, g.guest_fullname, g.guest_salutation, g.guest_groupname, g.guest_room_share, r.room_key, g.guest_language FROM ' . GUESTS_TABLE . " g 
	JOIN " . ROOMS_TABLE . " r ON r.room_name=g.room_name 
	JOIN " . NODES_TABLE . " n ON n.room_id=r.room_id 
	WHERE " . $filter;//n.node_mac='" . $mac . "'";
    //echo '<span style="background: #fff">' . $sql . '</span>'; exit;
    $result = $db->sql_query($sql);
    
    $i = 0;
    
    while ($row = $db->sql_fetchrow($result))
    {
	$guests_data[$i] = array(
	    'resv_id'		=> $row['guest_reservation_id'],
	    'firstname'		=> $row['guest_firstname'],
	    'lastname'		=> $row['guest_lastname'],
	    'fullname'		=> $row['guest_fullname'],
	    'salutation'	=> $row['guest_salutation'],
	    'groupname'		=> $row['guest_groupname'],
	    'room'		=> $row['room_name'],
	    'node'		=> $row['node_name'],
	    'room_share'	=> $row['guest_room_share'],
	    'room_key'		=> $row['room_key'],
	    //'language'	=> strtolower($row['guest_language']),
	    'language'		=> strtolower(substr($row['guest_language'], 0,2)),
	);

	$i++;
    }

    $db->sql_freeresult($result);
    //print_r($guests_data); exit;
    
    //echo "lang_id: " . $lang_id . '<br/>guest: ' . $guests_data[0]['language'];
    
    $lang_id = !empty(trim($lang_id)) ? $lang_id : $guests_data[0]['language'];
    
    //echo '<br/>lang_id' . $lang_id; 
    //echo '<br/>ip: ' . $session->ip . '<br/>mac: ' . $session->mac;
    //exit;
   
    if( file_exists($tonjaw_root_path . $config['language_path'] . $lang_id . '.' . $phpEx) )
    {
	include($tonjaw_root_path . $config['language_path'] . $lang_id . '.' . $phpEx);
	//echo 'crotttt'; exit;
	//$lang_id = $guests_data[0]['language'];
    }
    else
    {
	include($tonjaw_root_path . $config['language_path'] . $config['default_language'] . '.' . $phpEx);
    }
    //echo '<span style="background: #fff">' . $guests_data[0]['room'] . '</span>'; exit;

    return $guests_data;
}

function get_room_data($mac)
{
    global $db, $config;
    
    $room_data = array();

    $sql = 'SELECT r.room_name, n.node_name FROM ' . ROOMS_TABLE . " r  
	JOIN " . NODES_TABLE . " n ON n.room_id=r.room_id 
	WHERE n.node_mac='" . $mac . "'";
	
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    
    $i = 0;
    
    while ($row = $db->sql_fetchrow($result))
    {
	$room_data[$i] = array(
	    'room'	=> $row['room_name'],
	    'node'	=> $row['node_name'],
	);

	$i++;
    }

    $db->sql_freeresult($result);

    return $room_data;
}

function generate_menus($lang_id, $room_key, &$guest_names = '')
{
    global $db, $config, $template, $session, $lang, $home_menu, $guests_name, $phpEx, $pms_config, $pmsname, $pms;

    //Get Guests Names
    //$guests_name = array();
    //$guests_name = get_guests_data($session->mac); //echo 'mac: ' . $guests_name .'<p>'; //exit;
//echo 'mac:' . $session->mac; exit;

	
	
	//require($tonjaw_root_path . $config['pms_path'] . 'common_pms.' . $phpEx);	
	
	$xml_guest = $pms->get_guest_info($guests_name[0]['room']);
	if($xml_guest !== false) { // jika koneksi ke PMS berhasil
		$total_guest = count($xml_guest->Guest);
		
		if($total_guest > 1 && !$config['mobile'])
		{//print_r($xml_guest); exit;
			if(strcasecmp($xml_guest->Guest[0]->GuestName, $xml_guest->Guest[1]->GuestName) == 0) {
				$guest_names = $xml_guest->Guest[0]->Title . ' ' . $xml_guest->Guest[0]->GuestName;
			} else {
				$guest_names = $config['guest_names_separator'][1] . ' ' . $xml_guest->Guest[0]->Title . ' ' . $xml_guest->Guest[0]->GuestName . $config['guest_names_separator'][0] . $xml_guest->Guest[1]->Title . ' ' . $xml_guest->Guest[1]->GuestName;
			}
		}
		elseif($total_guest > 1 && $config['mobile'] )
		{ 
		$guest_names = $config['guest_names_separator'][1]. $xml_guest->Guest[0]->Title . ' ' . $xml_guest->Guest[0]->GuestName;
		}
		elseif ( !empty($xml_guest->Guest[0]->GuestName) )
		{ 
		$guest_names = $config['guest_names_separator'][1]. $xml_guest->Guest[0]->Title . ' ' . $xml_guest->Guest[0]->GuestName;
		}
		elseif ( empty($xml_guest->Guest[0]->GuestName) && !empty($guests_name[0]['lastname']))
		{ 
		$guest_names = $config['guest_names_separator'][1]. $guests_name[0]['salutation'] . ' ' . $guests_name[0]['lastname']. ', ' . $guests_name[0]['firstname'];
		}
	} else { // jika koneksi putus
		if( count($guests_name) > 1 && !$config['mobile'])
		{
			if(strcasecmp($guests_name[0]['fullname'], $guests_name[1]['fullname']) == 0) {
				$guest_names = $guests_name[0]['salutation'] . ' ' . $guests_name[0]['fullname'];
			} else {
				$guest_names = $guests_name[0]['salutation'] . ' ' . $guests_name[0]['fullname'] . $config['guest_names_separator'][0] . $guests_name[1]['salutation'] . ' ' . $guests_name[1]['fullname'];
			}
		}
		elseif( count($guests_name) > 1 && $config['mobile'] )
		{ 
		$guest_names = $config['guest_names_separator'][1]. $guests_name[0]['salutation'] . ' ' . $guests_name[0]['fullname'];
		}
		elseif ( !empty($guests_name[0]['fullname']) )
		{ 
		$guest_names = $config['guest_names_separator'][1]. $guests_name[0]['salutation'] . ' ' . $guests_name[0]['fullname'];
		}
		elseif ( empty($guests_name[0]['fullname']) && !empty($guests_name[0]['lastname']))
		{ 
		$guest_names = $config['guest_names_separator'][1]. $guests_name[0]['salutation'] . ' ' . $guests_name[0]['lastname']. ', ' . $guests_name[0]['firstname'];
		}
	}


	// hard code untuk Room 2219 (Club Premiere Lounge)
	//$sql = "SELECT node_ip FROM ".NODES_TABLE." WHERE node_name = '".$guests_name[0]['node']."'";
	$sql = "SELECT n.node_ip FROM ".NODES_TABLE." n LEFT JOIN ".ROOMS_TABLE." r ON r.room_id = n.room_id WHERE room_name = '".$guests_name[0]['room']."'";
	$result = $db->sql_query($sql);
	//$node_ip = $db->sql_fetchfield('node_ip');
	$node_ip = $session->ip;
	if($node_ip == '192.168.1.91') {
		$guest_names = "Club Premiere Lounge";
	}


    // GRAB MAIN MENU
$menus_data = array();

if( $config['mobile'] )
{
    $sql = 'SELECT m.menu_thumbnail, m.menu_url, m.menu_in_empty_room, t.translation_title FROM ' . MENUS_TABLE . ' m, ' . MENU_TRANSLATIONS_TABLE . " t WHERE m.menu_id=t.menu_id AND t.language_id='" . $lang_id . "' 
    AND menu_enabled=1 AND menu_in_empty_room=1 AND menu_in_mobile=1 ORDER BY m.menu_order";
    $result = $db->sql_query($sql);

    while ($row = $db->sql_fetchrow($result))
    {
	$menu_data[$i] = array(
	    'menu_thumbnail'	=> $row['menu_thumbnail'],
	    'menu_url'		=> $row['menu_url'],
	    'menu_in_empty_room'=> $row['menu_in_empty_room'],
	    'menu_title'	=> $row['translation_title'],
	);

	$i++;
    }
    
    print_r($guests_name); echo '<br/>guest: ' . $guest_names . '<br/>ip: ' . $session->ip . '<br/>mac: ' . $session->mac . '<br/>lang: ' . $guests_name[0]['language'];exit;

}
else
{

    $group_id = request_var('group_id', '');

    if( !$config['fe_menu_grouping'] || !empty($group_id) )
    {
	if ( !empty($group_id) )
	{
	    $filter = ($group_id) ? " AND menu_group_id = $group_id" : '';
	    
	    $group_url = "&group_id=$group_id";
	
	}
	
	$sql = 'SELECT m.menu_id, m.menu_thumbnail, m.menu_url, m.menu_in_empty_room, t.translation_title AS menu_title FROM ' . MENUS_TABLE . ' m, ' . MENU_TRANSLATIONS_TABLE . " t WHERE m.menu_id=t.menu_id AND t.language_id='" . $lang_id . "' 
	AND menu_enabled=1 AND menu_in_empty_room=1 AND menu_in_stb=1 " . $filter . " ORDER BY m.menu_order";
	//echo $sql; exit;
	$result = $db->sql_query($sql);

	$i = 0;

	while ($row = $db->sql_fetchrow($result))
	{
		if($xml_guest === false) { // jika koneksi ke PMS putus
			if($row['menu_url'] == "roomservice.php" || $row['menu_url'] == "viewbill.php") {
				continue;
			}
		}
	    $menu_data[$i] = array(
		'menu_id'		=> $row['menu_id'],
		'menu_title'	=> $row['menu_title'],
		'menu_thumbnail'	=> $row['menu_thumbnail'],
		'menu_url'		=> $row['menu_url'],
		'menu_in_empty_room'	=> $row['menu_in_empty_room'],
	    );
	    
	    $i++;
	}

    }

    if ( empty($group_id) && $config['fe_menu_grouping'] )
    {
	$sql = 'SELECT m.menu_group_id,  m.menu_group_thumbnail, m.menu_group_in_empty_room, t.translation_title FROM ' . MENU_GROUPS_TABLE . ' m, ' . MENU_GROUP_TRANSLATIONS_TABLE . " t WHERE m.menu_group_id=t.menu_group_id AND t.language_id='" . $lang_id . "' AND m.menu_group_enabled=1 AND m.menu_group_in_stb=1 ORDER BY m.menu_group_order";

	$result = $db->sql_query($sql);
	$i=0;
	//echo 'menu:' . $home_menu; exit;
	$home_menu_url = $home_menu ? '&menu=1': '';
	
	while ($row = $db->sql_fetchrow($result))
	{
	    $sql = 'SELECT menu_url FROM ' . MENUS_TABLE . ' 
		WHERE menu_group_id=' . $row['menu_group_id'] . ' AND menu_enabled=1';
	    $result1 = $db->sql_query($sql);
	    $c = 0;
	    while ($row1 = $db->sql_fetchrow($result1))
	    {
		$url = $row1['menu_url'];
		$c++;
	    }
	    
	    if( $c == 1 )
	    {
		$menu_data[$i] = array(
		    'menu_group_id'	=> $row['menu_group_id'],
		    'menu_title'	=> $row['translation_title'],
		    'menu_thumbnail'	=> $row['menu_group_thumbnail'],
		    'menu_url'		=> $url,
		    'menu_in_empty_room'	=> $row['menu_group_in_empty_room'],
		);
	    }
	    elseif( $c > 1 )
	    {
		$menu_data[$i] = array(
		    'menu_group_id'	=> $row['menu_group_id'],
		    'menu_title'	=> $row['translation_title'],
		    'menu_thumbnail'	=> $row['menu_group_thumbnail'],
		    'menu_url'		=> 'index.php',
		    'menu_in_empty_room'	=> $row['menu_group_in_empty_room'],
		);
	    }
	    
	    unset($url);
	    $i++;
	}

    }

}
//echo 'room key: ' . $room_key; exit;
//echo $sql; exit;
//print_r($menu_data); exit;

$db->sql_freeresult($result);

$rec1 = 1;
//echo $page . ' blah'; exit;
// WaterWheel Carousel menu BEGIN 
$index = 0;
$size = sizeof($menus_data);
$half = ceil(($size - 1) / 2);
$small_half = floor(($size - 1) / 2);
$plus = 0;
$minus = 0;
$pointer = 0;
//echo $size . ' * ' . $half; exit;

// END 
foreach ($menu_data as $row)
{
    //$data = array();
    if ( empty($row['menu_in_empty_room']) && empty($guest_names) )
    {
	
    
    }
    else
    {
	if ( !empty($row['menu_group_id']) )
	{
	    $group_url = 'group_id='.$row['menu_group_id'];
	}
	
	//echo 'crot'; exit;
    	$template->assign_block_vars('menu', array(
	    'REC1'		=> $rec1,
	    'S_MENU_THUMBNAIL'	=> $row['menu_thumbnail'],
	    'S_MENU_URL'	=> ($room_key) ? $row['menu_url'] . '?key=' . $room_key . $group_url . $home_menu_url: $row['menu_url'] . '?' . $group_url . $home_menu_url,
	    'S_MENU_TITLE'	=> prepare_message($row['menu_title']),
	    // S_INDEX -> WaterWheel Carousel menu
	    'S_INDEX'		=> $index,
	    'S_INDEX2'		=> $rec1,
	));
	
	//echo 'crottttt'; exit;
    }
    
    
    
    // WaterWheel Carousel menu BEGIN 
    if ( $pointer < $half )
    {
	$minus--;
	$pointer++;
	$index = $minus;
	$stack = $size - $pointer;
    }
    else
    {
	
	//$index = $stack - $plus;
	$index = $small_half;
	$small_half--;
	$plus++;
	
	//echo $plus; exit;
    }
    //$index++;
    
    // END 
    
    //$rec1 = 0;
    $rec1++;
}

    $template->assign_vars(array(
	'L_ROOM'			=> $lang['room'],
	'S_ROOM'			=> $guests_name[0]['room'],
	'S_GUEST'			=> $guests_name[0]['fullname'],
	//'T_LOG_JS_PATH'		=> $tonjaw_root_path . $config['js_path'] . 'log.js',
    ));


    return;
}

function get_signage_data($default_type, $default_source, $playlist_id, $region_position)
{
    global $db, $config;
    
    if(!empty($playlist_id)) {
        $sql = "SELECT playlist_content_id, playlist_content_source, p.playlist_duration FROM ".SIGNAGE_PLAYLIST_CONTENT_TABLE." c LEFT JOIN ".SIGNAGE_PLAYLIST_TABLE." p ON c.playlist_id = p.playlist_id WHERE c.playlist_id = ".$playlist_id." ORDER BY playlist_content_id";
        $result = $db->sql_query($sql);
        $i = 0;
        while($row = $db->sql_fetchrow($result)) {
            $source[$i] = array(
                'id'        => $row['playlist_content_id'],
                'source'    => $row['playlist_content_source'],	
                //'duration'  => $row['playlist_duration'],	
            );
            $duration = $row['playlist_duration'] * 1000;
            $i++;
        }
        
        for($i=0; $i<count($source); $i++) {
            if($content != "") $content .= "|";
            $content .= $source[$i]['source'];
        }
    } else {
        $content = $default_source;
        $duration = 0;
    }
    
    $data = array("content" => $content, "duration" => $duration, "type" => strtolower($default_type));
    
    return $data;
}

function get_rss_data($default_source) 

{

    global $db, $config;

	

	if(substr($default_source,0,2) == "DB") { 

		$source = explode("-", $default_source);

		$table = $source[1];

		$rss_data = array();

		$limit = 15;

		$content = "";

		

		$sql = "SELECT * FROM ".$table."";

		$result = $db->sql_query($sql);

		$total_data = $db->get_row_count($table);

		

		//$field_list = $db->sql_list_columns($table);

		

		switch($table) {

			case 'airport_fids'	: 

					$head = array("Airline", "Flight", "Destination", "Scheduled Time", "Terminal", "Gate", "Remark");

					break;

			

			case 'signage_generals'	: 

					$head = array("Date", "Title", "Description");

					break;

		}

		

		$i = 1;

		$j = 0;

		while($row = $db->sql_fetchrow($result)) {

			switch($table) {

				case 'airport_fids'	: 

						$content .= '<tr><td>'.$row['fids_airline'].'</td><td>'.$row['fids_flight'].'</td><td>'.$row['fids_city'].'</td><td align=\'left\'>'.$row['fids_time'].'</td><td align=\'left\'>'.$row['fids_terminal'].'</td><td align=\'left\'>'.$row['fids_gate'].'</td><td align=\'left\'>'.$row['fids_remark'].'</td></tr>';

						break;

				

				case 'signage_generals'	: 

						$content .= '<tr><td>'.date($config['header_dateformat'], $row['signage_general_date']).'</td><td>'.$row['signage_general_title'].'</td><td>'.$row['signage_general_remark'].'</td></tr>';

						break;

			}

			$rss_data[$j] = $content;

			

			if($total_data >= $limit) {

				if($i < $total_data) {

					if(($i % $limit)==0) { 

						$rss_data[$j] = $content; 

						$j++;

						$content = "";

					}

				} else if($i == $total_data) {

					$rss_data[$j] = $content;

				}

			} else {

				$rss_data[$j] = $content;

			}

			$i++;

		}

		

		$header = implode("|", $head);

		$con = implode("|", $rss_data);

		

	} else {

	

		$url = $config['rss_signage_path'].$default_source;

		//$url = $default_source;

		$rss = @simplexml_load_file($url);

		

		if($rss) {

			if($default_source == 'fids.xml') {

				//$nodes = $rss->xpath('//Record/*[not(*)]');

				$rss_data = array();

				$limit = 10;

				$content = "";

				$head = array();

				

				$items = $rss->Departure->Record;

				$total_data = count($items); 

				

				$head = array("FlightID", "Destination", "Time", "Gate", "Remark");

				/*foreach ($nodes as $node) {

					$head[$node->getName()] = true;

				}

				$head = array_keys($head);*/

				

				$i = 1;

				$j = 0;

				foreach($items as $item) {

					$airline = $item->Airline;

					$flightnum = $item->FlightID;

					$destination = $item->Destination;

					$time = $item->Time;

					$gate = $item->Gate;

					$remarks = $item->Remark;

					

					$content .= '<tr><td>'.$flightnum.'</td><td>'.$destination.'</td><td align=\'left\'>'.$time.'</td><td align=\'left\'>'.$gate.'</td><td align=\'left\'>'.$remarks.'</td></tr>';

					

					if($total_data >= $limit) {

						if($i < $total_data) {

							if(($i % $limit)==0) { 

								$rss_data[$j] = $content; 

								$j++;

								$content = "";

							}

						} else if($i == $total_data) {

							$rss_data[$j] = $content;

						}

					} else {

						$rss_data[$j] = $content;

					}

					

					$i++;

				}

				$header = implode("|", $head);

				$con = implode("|", $rss_data);

				

			} else {

				$con = "";

				

				$items = $rss->channel->item;

				

				foreach($items as $item) {

					$title = $item->title;



					$con .= $title."<br/><br/>";

				}

			}

		}

    }

    $data = array("content" => $con, "duration" => 0, "type" => "rss", "header" => $header);

	//print_r($data); exit;

    return $data;

}

function get_page_title($file, $lang_id)
{
    global $db;
    
    $sql = 'SELECT t.translation_title AS page_tile FROM ' . MENUS_TABLE . ' m, ' . 
	    MENU_TRANSLATIONS_TABLE . " t WHERE m.menu_id=t.menu_id AND m.menu_url='$file' AND t.language_id='" . $lang_id . "'";
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $page_title = (string) $db->sql_fetchfield('page_tile');
    $db->sql_freeresult($result);
	
    return $page_title;

}

function get_guest_group($node_id) 
{
	global $db;

	$sql = "SELECT guest_groupname FROM ".NODES_TABLE." n 
	JOIN ".ROOMS_TABLE." r ON n.room_id = r.room_id 
	JOIN ".GUESTS_TABLE." g ON g.room_name = r.room_name
	WHERE n.node_id = ".$node_id."";

	$result = $db->sql_query($sql);
    $guest_groupname = (string) $db->sql_fetchfield('guest_groupname');
    $db->sql_freeresult($result);
	
    return $guest_groupname;
}

function generate_teraphist($field_name, $selected_item = '')
{
	global $db, $lang_id;

	$sql = "SELECT r.teraphist_id, t.translation_title, t.translation_description FROM " . TERAPHISTS_TABLE . " r 
	JOIN " . TERAPHIST_TRANSLATIONS_TABLE . " t ON r.teraphist_id=t.teraphist_id 
	WHERE r.teraphist_enabled=1 AND t.language_id='" . $lang_id . "' ORDER BY t.translation_title";

	$result = $db->sql_query($sql);
	
	$select_teraphist = '<select name="' . $field_name . '"><option></option>';

	while ($row = $db->sql_fetchrow($result))
	{
	    $selected = ( $selected_item == $row['teraphist_id'] ) ? ' selected="selected"' : '';
	    $select_teraphist .= '<option value="' . $row['teraphist_id'] . '" ' . $selected . '>' . $row['translation_title'] . '</option>';
			
	}
	
	$db->sql_freeresult($result);
	
	$select_teraphist .= '</select>';

	return $select_teraphist;
}

function generate_transportation($field_name, $selected_item = '')
{
	global $db, $lang_id;

	$sql = "SELECT r.car_id, t.translation_title, t.translation_description FROM " . CARS_TABLE . " r 
	JOIN " . CAR_TRANSLATIONS_TABLE . " t ON r.car_id=t.car_id 
	WHERE r.car_enabled=1 AND t.language_id='" . $lang_id . "' ORDER BY t.translation_title";

	$result = $db->sql_query($sql);
	
	$select_car = '<select name="' . $field_name . '"><option></option>';

	while ($row = $db->sql_fetchrow($result))
	{
	    $selected = ( $selected_item == $row['car_id'] ) ? ' selected="selected"' : '';
	    $select_car .= '<option value="' . $row['car_id'] . '" ' . $selected . '>' . $row['translation_title'] . '</option>';
			
	}
	
	$db->sql_freeresult($result);
	
	$select_car .= '</select>';

	return $select_car;
}

function generate_number_combo($field_name, $max_number, $min_number, $default_after_max='', $text_after_max='', $auto_focus='', $selected_item='')
{

    $auto_focus = $auto_focus ? 'autofocus' : '';
    $combo = "<select id='" . $field_name . "' name='" . $field_name . "'  $auto_focus>
		";
    
    $max = $max_number + 1;
    
    for( $i=$min_number; $i<=$max_number; $i++ )
    {
	$selected = ( $selected_item == $i ) ? 'selected' : '';
    
	$combo .= "<option $selected>$i</option>";
	
    }
    
    if( empty($default_after_max) )
    {
	$combo .= "</select>";
    }
    else
    {
	$combo .= "<option value='" . $default_after_max ."'>$text_after_max</option>
	    </select>";
    }
    

    return $combo;
}

function generate_time_combo($field_name, $max_value, $auto_focus='', $selected_item='')
{

    $auto_focus = $auto_focus ? 'autofocus' : '';
    $combo = "<select name='" . $field_name . "'  $auto_focus>
		";
    
    $max = $max_number + 1;
    
    for( $i=0; $i<=$max_value; $i++ )
    {
	$selected = ( $selected_item == $i ) ? 'selected' : '';
	
	if ( strlen($i) == 1 )
	{
	    $time = '0' . (string) $i;
	}
	else
	{
	    $time = (string) $i;
	}
	
	$combo .= "<option value='$i' $selected>$time:00</option>";
	
    }
    
    $combo .= "</select>";
    
    return $combo;
}

function generate_subject($field_name, $selected_item = '')
{
	global $db, $lang_id;

	$sql = "SELECT r.guest_request_id, r.guest_request_value, t.translation_title 
	FROM " . GUEST_REQUESTS_TABLE . " r 
	JOIN " . GUEST_REQUEST_TRANSLATIONS_TABLE . " t ON r.guest_request_id=t.guest_request_id 
	WHERE r.guest_request_enabled=1 AND t.language_id='" . $lang_id . "' ORDER BY t.translation_title";

	$result = $db->sql_query($sql);
	
	$select_subject = '<select name="' . $field_name . '"><option></option>';

	while ($row = $db->sql_fetchrow($result))
	{
	    $selected = ( $selected_item == $row['guest_request_id'] ) ? ' selected="selected"' : '';
	    $select_subject .= '<option value="' . $row['guest_request_value'] . '" ' . $selected . '>' . $row['translation_title'] . '</option>';
			
	}
	
	$db->sql_freeresult($result);
	
	$select_subject .= '</select>';

	return $select_subject;
}

function check_message()
{
    global $db, $guests_name, $config, $phpEx, $pms;
	
	require_once($tonjaw_root_path . $config['pms_path'] . 'common_pms.' . $phpEx);
	
	$new_message = $pms->check_message($guests_name[0]['resv_id']);
	
    return $new_message;
}

function grab_weather_widget($city) 
{
	global $db;
	
	$data = array();
	
	$sql = "SELECT weather_today_icon, weather_today_temp_c_min, weather_today_temp_c_max 
	FROM " . WEATHER_TABLE . " 
	WHERE weather_city LIKE '%".$city."%'";
	$result = $db->sql_query($sql);
	while($row = $db->sql_fetchrow($result)) {
		$data['icon'] = $row['weather_today_icon'];
		$data['temp'] = $row['weather_today_temp_c_max'];
		$data['city'] = $city;
	}
	
	return $data;
}

function delete_roomservice_notification($lang_id) 
{
	global $db, $tonjaw_root_path, $config, $phpEx;
	
	require($tonjaw_root_path . $config['language_path'] . $lang_id . '.' . $phpEx);
		
	$title = $lang['roomservice_process_confirmation'];
	$now = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
	
	$sql = 'SELECT r.message_id
			FROM ' . RUNNINGTEXT_TABLE . ' r 
			JOIN ' . RUNNINGTEXT_TRANSLATIONS_TABLE . ' t ON t.message_id=r.message_id 
			LEFT JOIN ' . RUNNINGTEXT_GROUPINGS_TABLE . ' g ON g.message_id=r.message_id 
			LEFT JOIN ' . RUNNINGTEXT_ZONE_GROUPINGS_TABLE . " z ON z.message_id=r.message_id 
			WHERE t.translation_message='" . $title . "' AND r.message_schedule_end < ".$now." AND r.message_enabled=1";    
	$result = $db->sql_query($sql);
	//echo $sql; exit;
	while($row = $db->sql_fetchrow($result)) {
	//if(!empty($message_id)) {
		$sql = "DELETE FROM ".RUNNINGTEXT_TABLE." WHERE message_id = ".$row['message_id']."";
		$db->sql_query($sql);
		
		$sql = "DELETE FROM ".RUNNINGTEXT_TRANSLATIONS_TABLE." WHERE message_id = ".$row['message_id']."";
		$db->sql_query($sql);
		
		$sql = "DELETE FROM ".RUNNINGTEXT_GROUPINGS_TABLE." WHERE message_id = ".$row['message_id']."";
		$db->sql_query($sql);
		
		$sql = "DELETE FROM ".RUNNINGTEXT_ZONE_GROUPINGS_TABLE." WHERE message_id = ".$row['message_id']."";
		$db->sql_query($sql);
	//}
	}
	
	return;
}
?>
