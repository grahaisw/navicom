<?php

/**
*
* main.php
*
* Roberto Tonjaw. Dec 2013
*/

/**
*/
define('IN_TONJAW', true);
define('NEED_SID', true);
define('IN_FRONTEND', true);

$browser = ($_SERVER['HTTP_USER_AGENT']) ? htmlspecialchars((string) $_SERVER['HTTP_USER_AGENT']) : '';
//echo '<p>' . getenv('REQUEST_URI') . '</p>';
//echo '<p>' . $browser . '</p>';
//echo time();
$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
$file = explode('.', substr(strrchr(__FILE__, '/'), 1));

// Include files
require($tonjaw_root_path . 'common.' . $phpEx);

/*
* begin pinjem
* sementara pinjem dr common_adm.php
*/
// directories path
$config['adm_style'] = "simplicity";
$config['adm_theme'] = "default";
$config['adm_lang'] = 'en';

$config['template_path'] = $config['style_path'] . $config['adm_style'] . '/' .  $config['adm_theme'] . '/template';
$config['theme_path'] = $config['style_path'] . $config['adm_style'] . '/' .  $config['adm_theme'] . '/theme';

require($tonjaw_root_path . $config['language_path'] . $config['adm_lang'] . '/adm_lang.' . $phpEx);
require($tonjaw_root_path . $config['include_path'] . 'functions_admin.' . $phpEx);

$user['template_path'] = $config['template_path'];
/*
* end of pinjem
*/

$session->session_begin($file[0], NEED_LOGIN);

add_log($adm_lang['view']);
		    
echo '<html><body bgcolor=#fff>Client/STB name: ' . $node_name; 
echo '</br>Client/STB ip: ' . $session->ip;
echo '</br>Client/STB mac: ' . $session->mac;
echo '</br>Client/STB browser: ' . trim(substr($session->browser, 0, 149));
echo '</br>Client/STB feature: ' . $session->module;
echo '</div></body><html>';
exit;















?>