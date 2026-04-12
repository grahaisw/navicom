<?php
/**
*
* includes/error_collector.php
*
* Roberto Tonjaw. Dec 2013
*/

/**
*/
if (!defined('IN_TONJAW'))
{
	die('Hacking Attempt');
}

class tonjaw_error_collector
{
	var $errors;

	function tonjaw_error_collector()
	{
		$this->errors = array();
	}

	function install()
	{
		set_error_handler(array(&$this, 'error_handler'));
	}

	function uninstall()
	{
		restore_error_handler();
	}

	function error_handler($errno, $msg_text, $errfile, $errline)
	{
		$this->errors[] = array($errno, $msg_text, $errfile, $errline);
	}

	function format_errors()
	{
		$text = '';
		foreach ($this->errors as $error)
		{
			if (!empty($text))
			{
				$text .= "<br />\n";
			}

			list($errno, $msg_text, $errfile, $errline) = $error;

			// Prevent leakage of local path to phpBB install
			$errfile = tonjaw_filter_root_path($errfile);

			$text .= "Errno $errno: $msg_text at $errfile line $errline";
		}

		return $text;
	}
}