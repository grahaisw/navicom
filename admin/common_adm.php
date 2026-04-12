<?php
/**
*
* admin/common_adm.php
*
* Roberto Tonjaw. Dec 2013
*/

/**
*/

if (!defined('IN_TONJAW'))
{
	die('Hacking Attempt');
}

$browser = ($_SERVER['HTTP_USER_AGENT']) ? htmlspecialchars((string) $_SERVER['HTTP_USER_AGENT']) : '';

// directories path
$config['adm_style'] = $config['default_cp_style'];
$config['adm_theme'] = "default";
$config['adm_lang'] = 'en';

$config['template_path'] = $config['style_path'] . $config['adm_style'] . '/' .  $config['adm_theme'] . '/template';
$config['theme_path'] = $config['style_path'] . $config['adm_style'] . '/' .  $config['adm_theme'] . '/theme';
$config['imageset_path'] = $config['style_path'] . $config['adm_style'] . '/' .  $config['adm_theme'] . '/imageset';

require($tonjaw_root_path . $config['language_path'] . $config['adm_lang'] . '/adm_lang.' . $phpEx);
require($tonjaw_root_path . $config['include_path'] . 'functions_admin.' . $phpEx);

$user['template_path'] = $config['template_path'];


?>