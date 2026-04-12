<?php
/**
*
* includes/functions_admin.php
*
* By Roberto Tonjaw. Dec 2013
*/

/**
*/
if (!defined('IN_TONJAW'))
{
	die('Hacking Attempt');
}

/**
* Header for acp pages
*/

function adm_page_header($page_title)
{
    global $config, $template, $tonjaw_root_path, $adm_lang;

    if (defined('HEADER_INC'))
    {
	return;
    }

    define('HEADER_INC', true);
    
    //$template->set_template();

    $template->assign_vars(array(
	'SITENAME'		=> $adm_lang['site_title'],
	'PAGE_TITLE'		=> $page_title,
	'T_THEME_PATH'		=> $tonjaw_root_path . $config['theme_path'],
	'T_JS_PATH'		=> $tonjaw_root_path . $config['js_path'],
	'SITE_DESCRIPTION'	=> $adm_lang['site_desc'],
	'CURRENT_TIME'		=> date($config['header_dateformat']),
// INSERT DATATABLE SCRIPT
	'T_IMAGESET_PATH'	=> $tonjaw_root_path . $config['imageset_path'],
	'T_DATATABLE_PATH'	=> $tonjaw_root_path . $config['datatable_path'],
	'ICON_PATH'		=> $tonjaw_root_path . $config['imageset_path'],

    ));

    // application/xhtml+xml not used because of IE
    header('Content-type: text/html; charset=UTF-8');

    header('Cache-Control: private, no-cache="set-cookie"');
    header('Expires: 0');
    header('Pragma: no-cache');

    return;

}

function mini_page_header($page_title = '')
{
     global $config, $template, $tonjaw_root_path, $adm_lang;
     
    if (defined('HEADER_INC'))
    {
	return;
    }

    define('HEADER_INC', true);

    $template->assign_vars(array(
	'S_CONTENT_DIRECTION'	=> 'ltr',
	'S_USER_LANG'		=> $config['adm_lang'],
	'T_THEME_PATH'		=> $tonjaw_root_path . $config['theme_path'],
	'T_JS_PATH'		=> $tonjaw_root_path . $config['js_path'],
	'PAGE_TITLE'		=> $page_title,
    ));

    // application/xhtml+xml not used because of IE
    header('Content-type: text/html; charset=UTF-8');

    header('Cache-Control: private, no-cache="set-cookie"');
    header('Expires: 0');
    header('Pragma: no-cache');

    return;

}

function get_userinfo($uid)
{
    global $db;
    
    $sql = "SELECT u.user_name, u.user_fullname, g.user_group_name FROM " . USERS_TABLE . " u, " . USER_GROUPS_TABLE . " 	g WHERE u.user_group_id = g.user_group_id AND u.user_id=$uid";
    
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    
    $userinfo = '';
    
    if(isset($data['user_name']))
    {
	$userinfo = $data['user_fullname'] . " (" . $data['user_name'] . ") - " . $data['user_group_name'];
    }
    else
    {
	die('Unable to find User in get_userinfo.');
    }

    
    return $userinfo;
}
/**
* View Sessions
* If $session_count is set to false, we will skip counting all entries in the database.
*/
function view_session(&$session, &$session_count, $limit = 0, $offset = 0, $sort_by = 'session_start DESC', $keywords = '')
{
	global $db, $phpEx, $tonjaw_root_path, $tonjaw_admin_path, $config;

	// Use no preg_quote for $keywords because this would lead to sole backslashes being added
	// We also use an OR connection here for spaces and the | string. Currently, regex is not supported for searching (but may come later).
	$keywords = preg_split('#[\s|]+#u', utf8_strtolower($keywords), 0, PREG_SPLIT_NO_EMPTY);
	$sql_keywords = '';

	if (!empty($keywords))
	{
		$keywords_pattern = array();

		// Build pattern and keywords...
		for ($i = 0, $num_keywords = sizeof($keywords); $i < $num_keywords; $i++)
		{
			$keywords_pattern[] = preg_quote($keywords[$i], '#');
			$keywords[$i] = $db->sql_like_expression($db->any_char . $keywords[$i] . $db->any_char);
		}

		$keywords_pattern = '#' . implode('|', $keywords_pattern) . '#ui';

	}
	
	if ($session_count !== false)
	{
		$sql = 'SELECT COUNT(session_id) AS total_entries
			FROM ' . SESSIONS_TABLE . ' 
			WHERE session_start > ' . $config['session_length'] . "
				$sql_keywords";
		$result = $db->sql_query($sql);
		$session_count = (int) $db->sql_fetchfield('total_entries');
		$db->sql_freeresult($result);
	}
	
	// $session_count may be false here if false was passed in for it,
	// because in this case we did not run the COUNT() query above.
	// If we ran the COUNT() query and it returned zero rows, return;
	// otherwise query for sessions below.
	if ($session_count === 0)
	{
		// Save the queries, because there are no session to display
		return 0;
	}

	if ($offset >= $session_count)
	{
		$offset = ($offset - $limit < 0) ? 0 : $offset - $limit;
	}
///echo 'shittt</br>offset: ' . $offset . '</br>limit: ' . $limit .'</br>' . $session_count; exit;
	$sql = "SELECT session_id, session_start, session_username, session_browser,
		    session_mac, session_module, session_ip 
		FROM " . SESSIONS_TABLE . '  
		WHERE session_start > ' . $config['session_length'] . "
			$sql_keywords
		ORDER BY $sort_by";
		
		//echo $sql; exit;
	$result = $db->sql_query_limit($sql, $limit, $offset);

	
	$i = 0;
	$session = array();
	while ($row = $db->sql_fetchrow($result))
	{
	    $session[$i] = array(
		'id'			=> $row['session_id'],
		'start'			=> $row['session_start'],
		'ip'			=> $row['session_ip'],
		'username'		=> $row['session_username'],
		'browser'		=> $row['session_browser'],
		'mac'			=> $row['session_mac'],
		'module'		=> $row['session_module'],
	    );

	    $i++;
	}
	$db->sql_freeresult($result);

	//print_r($session); echo ': <p>crottt'; exit;
	return $offset;
}

/**
* View Logs
* 
*/
function view_logs(&$log, &$log_count, $limit = 0, $offset = 0,$limit_days = 0, $sort_by = 'log_time DESC', $keywords = '')
{
    global $db, $config;

	// Use no preg_quote for $keywords because this would lead to sole backslashes being added
	// We also use an OR connection here for spaces and the | string. Currently, regex is not supported for searching (but may come later).
	$keywords = preg_split('#[\s|]+#u', utf8_strtolower($keywords), 0, PREG_SPLIT_NO_EMPTY);
	$sql_keywords = '';

	if (!empty($keywords))
	{
		/*
		$keywords_pattern = array();
		
		// Build pattern and keywords...
		for ($i = 0, $num_keywords = sizeof($keywords); $i < $num_keywords; $i++)
		{
			$keywords_pattern[] = preg_quote($keywords[$i], '#');
			$keywords[$i] = $db->sql_like_expression($db->any_char . $keywords[$i] . $db->any_char);
		}

		$keywords_pattern = '#' . implode('|', $keywords_pattern) . '#ui';
		*/
		$keywords_pattern = array();

		// Build pattern and keywords...
		for ($i = 0, $num_keywords = sizeof($keywords); $i < $num_keywords; $i++)
		{
			$keywords_pattern[] = preg_quote($keywords[$i], '#');
			$keywords[$i] = $db->sql_like_expression($db->any_char . $keywords[$i] . $db->any_char);
		}

		$keywords_pattern = '#' . implode('|', $keywords_pattern) . '#ui';

		$sql_keywords = 'AND (';
/*		if (!empty($operations))
		{
			$sql_keywords .= $db->sql_in_set('log_operation', $operations) . ' OR ';
		}
*/		$sql_lower = $db->sql_lower_text('log_data');
		$sql_keywords .= "$sql_lower " . implode(" OR $sql_lower ", $keywords) . ')';
		//echo $sql_keywords; exit;
	}
	
	if ($log_count !== false)
	{
		$sql = 'SELECT COUNT(log_time) AS total_entries
			FROM ' . LOGS_TABLE . "
			WHERE log_time >= $limit_days
			$sql_keywords";
		
		if (!empty($keywords))
		{
		    //echo $sql; exit;
		}
			
		$result = $db->sql_query($sql);
		$log_count = (int) $db->sql_fetchfield('total_entries');
		$db->sql_freeresult($result);
	}
	
	// $session_count may be false here if false was passed in for it,
	// because in this case we did not run the COUNT() query above.
	// If we ran the COUNT() query and it returned zero rows, return;
	// otherwise query for sessions below.
	if ($log_count === 0)
	{
		// Save the queries, because there are no session to display
		return 0;
	}

	if ($offset >= $log_count)
	{
		$offset = ($offset - $limit < 0) ? 0 : $offset - $limit;
	}
//echo 'shittt</br>offset: ' . $offset . '</br>limit: ' . $limit .'</br>' . $session_count; exit;
	$sql = "SELECT * 
		FROM " . LOGS_TABLE . "
		WHERE log_time >= $limit_days 
			$sql_keywords
		ORDER BY $sort_by";
		
		//echo '<p>' . $sql; exit;
	$result = $db->sql_query_limit($sql, $limit, $offset);

	$i = 0;
	$log = array();
	while ($row = $db->sql_fetchrow($result))
	{
	    $log[$i] = array(
		'id'			=> $row['log_time'],
		'user'			=> $row['log_user'],
		'action'		=> $row['log_action'],
		'module'		=> $row['log_module'],
		'data'			=> $row['log_data'],
		'mac'			=> $row['log_mac'],
		'browser'		=> $row['log_browser'],
	    );

	    $i++;
	}
	$db->sql_freeresult($result);

	//print_r($session); echo ': <p>crottt'; exit;
	return $offset;

}

/**
* View Nodes
* 
*/
function view_nodes(&$node, &$node_count, $sql_keywords = '', $sort_by = 'node_id ASC')
{
    global $db;

    if ($log_count !== false)
    {
	$sql = 'SELECT COUNT(node_id) AS total_entries
		FROM ' . NODES_TABLE . "
		$sql_keywords";
		
	$result = $db->sql_query($sql);
	$node_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
     $sql = "SELECT n.*, room_name FROM " . NODES_TABLE . " n
			LEFT JOIN " . ROOMS_TABLE . " r ON n.room_id = r.room_id
		    $sql_keywords
		ORDER BY $sort_by";
		
	//echo '<p>' . $sql; exit;
	$result = $db->sql_query($sql);

	$i = 0;
	$node = array();
	while ($row = $db->sql_fetchrow($result))
	{
		
	    $node[$i] = array(
		'id'			=> $row['node_id'],
		'name'			=> $row['node_name'],
		'mac'			=> $row['node_mac'],
		'ip'			=> $row['node_ip'],
		'url'			=> $row['node_url'],
		'desc'			=> $row['node_description'],
		'enabled'		=> $row['node_enabled'],
		'room'			=> $row['room_name'],
		'last_channel'	=> $row['node_last_channel'],
		'lastupdate'	=> $row['fids_lastupdate'],
	    );

	    $i++;
	}
	$db->sql_freeresult($result);

	//print_r($node); echo ': <p>crottt'; exit;
	return;

}

/**
* View Zones
* 
*/
function view_zones(&$zone, &$zone_count)
{
    global $db;

    if ($zone_count !== false)
    {
	$sql = 'SELECT COUNT(zone_id) AS total_entries
		FROM ' . ZONES_TABLE;
		
	$result = $db->sql_query($sql);
	$zone_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT * FROM " . ZONES_TABLE;
		
    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $zone = array();
    while ($row = $db->sql_fetchrow($result))
    {
	$zone[$i] = array(
	    'id'	=> $row['zone_id'],
	    'name'	=> $row['zone_name'],
	    'desc'	=> $row['zone_description'],
	    'enabled'	=> $row['zone_enabled'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    return;

}

/**
* View Langs
* 
*/
function view_langs(&$lang, &$lang_count, $sql_keywords = '', $sort_by = 'language_id ASC')
{
    global $db;
    
    if ($log_count !== false)
    {
	$sql = 'SELECT COUNT(language_id) AS total_entries
		FROM ' . LANGUAGES_TABLE . "
		$sql_keywords";
		
	$result = $db->sql_query($sql);
	$lang_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT * FROM " . LANGUAGES_TABLE . "
		    $sql_keywords
		ORDER BY $sort_by";
		
    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $lang = array();
    while ($row = $db->sql_fetchrow($result))
    {
	$lang[$i] = array(
	    'id'			=> $row['language_id'],
	    'name'			=> $row['language_name'],
	    'flag'			=> $row['language_flag'],
	    'enabled'		=> $row['language_enabled'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    return;
}

/**
* View Groups
* 
*/
function view_groups(&$group, &$group_count, $sql_keywords = '', $sort_by = 'user_group_id ASC')
{
    global $db;

    if ($group_count !== false)
    {
	$sql = 'SELECT COUNT(user_group_id) AS total_entries
		FROM ' . USER_GROUPS_TABLE . "
		$sql_keywords";
		
	$result = $db->sql_query($sql);
	$group_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT * FROM " . USER_GROUPS_TABLE . "
		    $sql_keywords
		ORDER BY $sort_by";
		
    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $group = array();
    while ($row = $db->sql_fetchrow($result))
    {
	$group[$i] = array(
	    'id'			=> $row['user_group_id'],
	    'name'			=> $row['user_group_name'],
	    'desc'			=> $row['user_group_description'],
	    'enabled'		=> $row['user_group_enabled'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    return;

}

/**
* View Users
* 
*/
function view_users(&$user, &$user_count, $sql_keywords = '', $sort_by = 'u.user_id ASC')
{
    global $db;

    if ($user_count !== false)
    {
	$sql = 'SELECT COUNT(user_id) AS total_entries
		FROM ' . USERS_TABLE . "
		$sql_keywords";
		
	$result = $db->sql_query($sql);
	$user_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT u.user_id, u.user_name, u.user_fullname, u.user_enabled, u.user_lastvisit, g.user_group_name 
		FROM " . USERS_TABLE . " u, " . USER_GROUPS_TABLE . " g 
		WHERE u.user_group_id = g.user_group_id
		ORDER BY $sort_by";
		
    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $user = array();
    while ($row = $db->sql_fetchrow($result))
    {
	$user[$i] = array(
	    'id'			=> $row['user_id'],
	    'name'			=> $row['user_name'],
	    'fullname'		=> $row['user_fullname'],
	    'enabled'		=> $row['user_enabled'],
	    'groupname'		=> $row['user_group_name'],
	    'lastvisit'		=> $row['user_lastvisit'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    return;

}

/**
* 
*
*/
function view_module_category(&$mcat, &$mcat_count)
{
    global $db;
    
    if ($mcat_count !== false)
    {
	$sql = 'SELECT COUNT(module_detail_cat_id) AS total_entries
		FROM ' . MODULES_DETAIL_CAT_TABLE;
		
	$result = $db->sql_query($sql);
	$mcat_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT * FROM " . MODULES_DETAIL_CAT_TABLE . "
		ORDER BY module_detail_cat_name";
		
    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $mcat = array();
    while ($row = $db->sql_fetchrow($result))
    {
	$mcat[$i] = array(
	    'id'	=> $row['module_detail_cat_id'],
	    'name'	=> $row['module_detail_cat_name'],
	);

	$i++;
    }
    $db->sql_freeresult($result);
    
    return;
}

/**
* View Modules
*
*/
function view_module(&$module_data, &$module_count)
{
    global $db;
    
    if ($module_count !== false)
    {
	$sql = 'SELECT COUNT(module_id) AS total_entries
		FROM ' . MODULES_TABLE;
		
	$result = $db->sql_query($sql);
	$module_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT * FROM " . MODULES_TABLE . "
	    ORDER BY module_order, module_name";
		
    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $module_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$module_data[$i] = array(
	    'id'		=> $row['module_id'],
	    'name'		=> $row['module_name'],
	    'description'	=> $row['module_description'],
	    'in_admin'		=> $row['module_in_admin'],
	    'enabled'		=> $row['module_enabled'],
	    'order'		=> $row['module_order'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    return;
}

/**
* View Modules Detail
* 
*/
function view_module_detail(&$module_data, &$module_count)
{
    global $db;
    
    if ($module_count !== false)
    {
	$sql = 'SELECT COUNT(module_detail_id) AS total_entries
		FROM ' . MODULES_DETAIL_TABLE;
		
	$result = $db->sql_query($sql);
	$module_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT module_detail_id, module_detail_name, module_detail_cat_name, module_name, module_detail_enabled 
	    FROM " . MODULES_VIEW . "
	    ORDER BY module_name, module_detail_name";
		
    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $module_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$module_data[$i] = array(
	    'id'		=> $row['module_detail_id'],
	    'name'		=> $row['module_detail_name'],
	    'category'		=> $row['module_detail_cat_name'],
	    'module'		=> $row['module_name'],
	    'enabled'		=> $row['module_detail_enabled'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    return;
}

/**
* View Styles
*
*/
function view_styles(&$styles_data, &$styles_count)
{
    global $db;
    
    if ($styles_count !== false)
    {
	$sql = 'SELECT COUNT(style_id) AS total_entries
		FROM ' . STYLES_TABLE;
		
	$result = $db->sql_query($sql);
	$styles_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT * FROM " . STYLES_TABLE . "
	    ORDER BY style_name";
		
    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $styles_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$styles_data[$i] = array(
	    'id'		=> $row['style_id'],
	    'name'		=> $row['style_name'],
	    'desc'		=> $row['style_description'],
	    'active'		=> $row['style_active'],
	    'type'		=> $row['style_admin'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    //print_r($styles_data); exit;
    return;
}

/**
* View Buffers
*
*/
function view_buffers(&$buffers_data, &$buffers_count, $type)
{
    global $db;
    
    if ($buffers_count !== false)
    {
	$sql = 'SELECT COUNT(guest_service_id) AS total_entries
		FROM ' . GUEST_SERVICES_TABLE . " WHERE guest_service_type='" . $type . "'";
		
	$result = $db->sql_query($sql);
	$buffers_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT * FROM " . GUEST_SERVICES_TABLE . " WHERE guest_service_type='" . $type . "' 
	    ORDER BY guest_service_id DESC";
		
    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $buffers_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$buffers_data[$i] = array(
	    'id'		=> $row['guest_service_id'],
	    'resv_id'		=> $row['guest_reservation_id'],
	    'room_name'		=> $row['guest_service_roomname'],
	    'code'		=> $row['guest_service_code'],
	    'note'		=> $row['guest_service_note'],
	    'qty'		=> $row['guest_service_qty'],
	    'guest_name'	=> $row['guest_service_guestname'],
	    'item'		=> $row['guest_service_item'],
	    'price'		=> $row['guest_service_price'],
	    'approved'		=> $row['guest_service_approved'],
	    'received'		=> $row['guest_service_received'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    //print_r($buffers_data); exit;
    return;
}

/**
* View Indirect Buffers
*
*/
function view_indirect_buffers(&$buffers_data, &$buffers_count, $type)
{
    global $db;
    
    if ($buffers_count !== false)
    {
	$sql = 'SELECT COUNT(outlet_indirect_buffer_id) AS total_entries
		FROM ' . OUTLET_INDIRECT_BUFFER_TABLE . " WHERE guest_order_type='" . $type .  "'";
		
	$result = $db->sql_query($sql);
	$buffers_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT * FROM " . OUTLET_INDIRECT_BUFFER_TABLE . " WHERE guest_order_type='" . $type .  "' 
	    ORDER BY outlet_indirect_buffer_id DESC";
		
    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $buffers_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$buffers_data[$i] = array(
	    'id'		=> $row['outlet_indirect_buffer_id'],
	    'resv_id'		=> $row['guest_reservation_id'],
	    'room_name'		=> $row['guest_order_roomname'],
	    'guest_name'	=> $row['guest_order_guestname'],
	    'received'		=> $row['guest_order_received'],
	    'received_date'	=> $row['guest_order_received_date'],
	    'approved'		=> $row['guest_order_approved'],
	    //'type'		=> $row['guest_order_type'],
	    'code'		=> $row['guest_order_code'],
	    'item'		=> $row['guest_order_item'],
	    'price'		=> $row['guest_order_price'],
	    'qty'		=> $row['guest_order_qty'],
	    'note'		=> $row['guest_order_note'],
	    'equip'		=> $row['guest_order_equip'],
	    'time'		=> $row['guest_order_time'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    //print_r($buffers_data); exit;
    return;
}

/**
* View Guest Messages
*
*/
function view_guest_messages(&$guest_messages_data, &$guest_messages_count)
{
    global $db;
    
    if ($guest_messages_count !== false)
    {
	$sql = 'SELECT COUNT(guest_message_id) AS total_entries
		FROM ' . GUEST_MESSAGES_TABLE . ' WHERE guest_message_to=0';
		
	$result = $db->sql_query($sql);
	$guest_messages_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT * FROM " . GUEST_MESSAGES_TABLE . " WHERE guest_message_to=0 
	    ORDER BY guest_message_date DESC";
		
    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $guest_messages_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$guest_messages_data[$i] = array(
	    'id'		=> $row['guest_message_id'],
	    'resv_id'		=> $row['guest_reservation_id'],
	    'subject'		=> $row['guest_message_subject'],
	    'content'		=> $row['guest_message_content'],
	    'date'		=> $row['guest_message_date'],
	    'importance'	=> $row['guest_message_importance'],
	    'read'		=> $row['guest_message_read'],
	    'ref_id'		=> $row['guest_message_ref_id'],
	    'room_name'		=> $row['guest_message_from'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    //print_r($guest_messages_data); exit;
    return;
}

/**
* View Styles Schedule
*
*/
function view_style_schedules(&$schedules_data, &$schedules_count)
{
    global $db;
    
    if ($schedules_count !== false)
    {
	$sql = 'SELECT COUNT(style_schedule_id) AS total_entries
		FROM ' . STYLE_SCHEDULES_TABLE;
		
	$result = $db->sql_query($sql);
	$schedules_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT j.*, s.style_name FROM " . STYLE_SCHEDULES_TABLE . " j, " . STYLES_TABLE . " s 
	    WHERE j.style_id = s.style_id 
	    ORDER BY s.style_name";
		
    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $schedules_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$schedules_data[$i] = array(
	    'id'		=> $row['style_schedule_id'],
	    'style_id'		=> $row['style_id'],
	    'style_name'	=> $row['style_name'],
	    'name'		=> $row['style_schedule_name'],
	    'start'		=> $row['style_schedule_start'],
	    'end'		=> $row['style_schedule_end'],
	    'enabled'		=> $row['style_schedule_enabled'],
	    'node'		=> $row['style_schedule_node'],
	);

	$i++;
    }
    $db->sql_freeresult($result);


    return;
}

/**
* View Menu Groups
*
*/
function view_menu_groups(&$menus_data, &$menus_count)
{
    global $db, $config;
    
    if ($menus_count !== false)
    {
	$sql = 'SELECT COUNT(menu_group_id) AS total_entries
		FROM ' . MENU_GROUPS_TABLE;
		
	$result = $db->sql_query($sql);
	$menus_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }

    $sql = "SELECT m.menu_group_id, m.menu_group_order, m.menu_group_in_stb, m.menu_group_in_mobile, m.menu_group_enabled, t.translation_title, 
	m.menu_group_thumbnail, t.language_id 
	FROM " . MENU_GROUPS_TABLE . " m, " . MENU_GROUP_TRANSLATIONS_TABLE . " t 
	WHERE m.menu_group_id=t.menu_group_id AND t.language_id= '" . $config['default_language'] . "' 
	ORDER BY m.menu_group_order ASC";
		
    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $menus_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$menus_data[$i] = array(
	    'menu_id'		=> $row['menu_group_id'],
	    'menu_title'	=> $row['translation_title'],
	    'menu_thumbnail'	=> $row['menu_group_thumbnail'],
	    'menu_lang'		=> $row['language_id'],
	    'menu_in_stb'	=> $row['menu_group_in_stb'],
	    'menu_in_mobile'	=> $row['menu_group_in_mobile'],
	    'menu_enabled'	=> $row['menu_group_enabled'],
	    'menu_order'	=> $row['menu_group_order'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    return;
}

/**
* View Menus
*
*/
function view_menus(&$menus_data, &$menus_count)
{
    global $db, $config;
    
    if ($menus_count !== false)
    {
	$sql = 'SELECT COUNT(menu_id) AS total_entries
		FROM ' . MENUS_TABLE;
		
	$result = $db->sql_query($sql);
	$menus_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }

    $sql = "SELECT m.menu_id, m.menu_url, m.menu_order, m.menu_in_stb, m.menu_in_mobile, m.menu_enabled, t.translation_title, 
	m.menu_thumbnail, t.language_id 
	FROM " . MENUS_TABLE . " m, " . MENU_TRANSLATIONS_TABLE . " t 
	WHERE m.menu_id=t.menu_id AND t.language_id= '" . $config['default_language'] . "' 
	ORDER BY m.menu_order ASC";
		
    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $menus_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$menus_data[$i] = array(
	    'menu_id'		=> $row['menu_id'],
	    'menu_url'		=> $row['menu_url'],
	    'menu_title'	=> $row['translation_title'],
	    'menu_thumbnail'	=> $row['menu_thumbnail'],
	    'menu_lang'		=> $row['language_id'],
	    'menu_in_stb'	=> $row['menu_in_stb'],
	    'menu_in_mobile'	=> $row['menu_in_mobile'],
	    'menu_enabled'	=> $row['menu_enabled'],
	    'menu_order'	=> $row['menu_order'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    return;
}

/**
* View Pages
*
*/
function view_pages(&$pages_data, &$pages_count)
{
    global $db, $config;
    
    if ($pages_count !== false)
    {
	$sql = 'SELECT COUNT(page_id) AS total_entries
		FROM ' . PAGES_TABLE;
		
	$result = $db->sql_query($sql);
	$pages_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT p.page_id, p.page_in_menu , p.page_enabled, p.page_allow_ads, t.page_translation_title, p.page_thumbnail  
	FROM " . PAGES_TABLE . " p, " . PAGE_TRANSLATIONS_TABLE . " t 
	WHERE p.page_id=t.page_id AND t.language_id= '" . $config['default_language'] . "' 
	ORDER BY t.page_translation_title";
		
    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $pages_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$pages_data[$i] = array(
	    'page_id'		=> $row['page_id'],
	    'page_in_menu'	=> $row['page_in_menu'],
	    'page_title'	=> $row['page_translation_title'],
	    'page_thumbnail'	=> $row['page_thumbnail'],
	    'page_enabled'	=> $row['page_enabled'],
	    'page_allow_ads'	=> $row['page_allow_ads'],
	);

	$i++;
    }
    $db->sql_freeresult($result);
    
    return;
}

/**
* View Tv Group
*
*/
function view_tv_groups(&$groups_data, &$groups_count)
{
    global $db, $config;
    
    if ($groups_count !== false)
    {
	$sql = 'SELECT COUNT(tv_channel_group_id) AS total_entries
		FROM ' . TV_GROUPS_TABLE;
		
	$result = $db->sql_query($sql);
	$groups_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT p.tv_channel_group_id, p.tv_channel_group_description , p.tv_channel_group_thumbnail, p.tv_channel_group_order, p.tv_channel_group_enabled, t.translation_title   
	FROM " . TV_GROUPS_TABLE . " p, " . TV_GROUP_TRANSLATIONS_TABLE . " t 
	WHERE p.tv_channel_group_id=t.tv_channel_group_id AND t.language_id= '" . $config['default_language'] . "' 
	ORDER BY p.tv_channel_group_order, t.translation_title";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $groups_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$groups_data[$i] = array(
	    'id'		=> $row['tv_channel_group_id'],
	    'name'		=> $row['translation_title'],
	    'desc'		=> $row['tv_channel_group_description'],
	    'enabled'		=> $row['tv_channel_group_enabled'],
	    'thumbnail'		=> $row['tv_channel_group_thumbnail'],
	    'order'		=> $row['tv_channel_group_order'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    return;
}

/**
* View Movie Group
*
*/
function view_movie_groups(&$groups_data, &$groups_count)
{
    global $db, $config;
    
    if ($groups_count !== false)
    {
	$sql = 'SELECT COUNT(movie_group_id) AS total_entries
		FROM ' . MOVIE_GROUPS_TABLE;
		
	$result = $db->sql_query($sql);
	$groups_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT p.movie_group_id, p.movie_group_description , p.movie_group_enabled, t.translation_title   
	FROM " . MOVIE_GROUPS_TABLE . " p, " . MOVIE_GROUP_TRANSLATIONS_TABLE . " t 
	WHERE p.movie_group_id=t.movie_group_id AND t.language_id= '" . $config['default_language'] . "' 
	ORDER BY t.translation_title";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $groups_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$groups_data[$i] = array(
	    'id'		=> $row['movie_group_id'],
	    'name'		=> $row['translation_title'],
	    'desc'		=> $row['movie_group_description'],
	    'enabled'		=> $row['movie_group_enabled'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    return;
}

/**
* View Service Group
*
*/
function view_service_groups(&$groups_data, &$groups_count)
{
    global $db, $config;
    
    if ($groups_count !== false)
    {
	$sql = 'SELECT COUNT(service_group_id) AS total_entries
		FROM ' . SERVICE_GROUPS_TABLE;
		
	$result = $db->sql_query($sql);
	$groups_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT g.service_group_id, t.translation_description , g.service_group_enabled, g.service_group_order, 
      t.translation_title, g.service_group_thumbnail, g.service_group_allow_ads  
	FROM " . SERVICE_GROUPS_TABLE . " g, " . SERVICE_GROUP_TRANSLATIONS_TABLE . " t 
	WHERE g.service_group_id=t.service_group_id AND t.language_id= '" . $config['default_language'] . "' 
	ORDER BY g.service_group_order";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $groups_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$groups_data[$i] = array(
	    'id'		=> $row['service_group_id'],
	    'name'		=> $row['translation_title'],
	    'desc'		=> $row['translation_description'],
	    'enabled'		=> $row['service_group_enabled'],
	    'order'		=> $row['service_group_order'],
	    'allow_ads'		=> $row['service_group_allow_ads'],
	    'thumbnail'		=> $row['service_group_thumbnail'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    return;
}

/**
* View Spa Group
*
*/
function view_spa_groups(&$groups_data, &$groups_count)
{
    global $db, $config;
    
    if ($groups_count !== false)
    {
	$sql = 'SELECT COUNT(spa_group_id) AS total_entries
		FROM ' . SPA_GROUPS_TABLE;
		
	$result = $db->sql_query($sql);
	$groups_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT g.spa_group_id, t.translation_description , g.spa_group_enabled, g.spa_group_order, 
      t.translation_title, g.spa_group_thumbnail, g.spa_group_allow_ads  
	FROM " . SPA_GROUPS_TABLE . " g, " . SPA_GROUP_TRANSLATIONS_TABLE . " t 
	WHERE g.spa_group_id=t.spa_group_id AND t.language_id= '" . $config['default_language'] . "' 
	ORDER BY g.spa_group_order";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $groups_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$groups_data[$i] = array(
	    'id'		=> $row['spa_group_id'],
	    'name'		=> $row['translation_title'],
	    'desc'		=> $row['translation_description'],
	    'enabled'		=> $row['spa_group_enabled'],
	    'order'		=> $row['spa_group_order'],
	    'allow_ads'		=> $row['spa_group_allow_ads'],
	    'thumbnail'		=> $row['spa_group_thumbnail'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    return;
}

/**
* View Shop Group
*
*/
function view_shop_groups(&$groups_data, &$groups_count)
{
    global $db, $config;
    
    if ($groups_count !== false)
    {
	$sql = 'SELECT COUNT(shop_group_id) AS total_entries
		FROM ' . SHOP_GROUPS_TABLE;
		
	$result = $db->sql_query($sql);
	$groups_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT g.shop_group_id, t.translation_description , g.shop_group_enabled, g.shop_group_order, 
      t.translation_title, g.shop_group_thumbnail, g.shop_group_allow_ads  
	FROM " . SHOP_GROUPS_TABLE . " g, " . SHOP_GROUP_TRANSLATIONS_TABLE . " t 
	WHERE g.shop_group_id=t.shop_group_id AND t.language_id= '" . $config['default_language'] . "' 
	ORDER BY g.shop_group_order";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $groups_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$groups_data[$i] = array(
	    'id'		=> $row['shop_group_id'],
	    'name'		=> $row['translation_title'],
	    'desc'		=> $row['translation_description'],
	    'enabled'		=> $row['shop_group_enabled'],
	    'order'		=> $row['shop_group_order'],
	    'allow_ads'		=> $row['shop_group_allow_ads'],
	    'thumbnail'		=> $row['shop_group_thumbnail'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    return;
}

/**
* View Tour Group
*
*/
function view_tour_groups(&$groups_data, &$groups_count)
{
    global $db, $config;
    
    if ($groups_count !== false)
    {
	$sql = 'SELECT COUNT(tour_group_id) AS total_entries
		FROM ' . TOUR_GROUPS_TABLE;
		
	$result = $db->sql_query($sql);
	$groups_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT g.tour_group_id, t.translation_description , g.tour_group_enabled, g.tour_group_order, 
      t.translation_title, g.tour_group_thumbnail, g.tour_group_allow_ads  
	FROM " . TOUR_GROUPS_TABLE . " g, " . TOUR_GROUP_TRANSLATIONS_TABLE . " t 
	WHERE g.tour_group_id=t.tour_group_id AND t.language_id= '" . $config['default_language'] . "' 
	ORDER BY g.tour_group_order";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $groups_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$groups_data[$i] = array(
	    'id'		=> $row['tour_group_id'],
	    'name'		=> $row['translation_title'],
	    'desc'		=> $row['translation_description'],
	    'enabled'		=> $row['tour_group_enabled'],
	    'order'		=> $row['tour_group_order'],
	    'allow_ads'		=> $row['tour_group_allow_ads'],
	    'thumbnail'		=> $row['tour_group_thumbnail'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    return;
}

/**
* View Transportation
*
*/
function view_transportations(&$transportations_data, &$transportations_count)
{
    global $db, $config;
    
    if ($transportations_count !== false)
    {
	$sql = 'SELECT COUNT(car_id) AS total_entries
		FROM ' . CARS_TABLE;
		
	$result = $db->sql_query($sql);
	$transportations_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT g.car_id, t.translation_description , g.car_enabled, t.translation_title, g.car_thumbnail  
	FROM " . CARS_TABLE . " g, " . CAR_TRANSLATIONS_TABLE . " t 
	WHERE g.car_id=t.car_id AND t.language_id= '" . $config['default_language'] . "'";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $transportations_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$transportations_data[$i] = array(
	    'id'		=> $row['car_id'],
	    'name'		=> $row['translation_title'],
	    'desc'		=> $row['translation_description'],
	    'enabled'		=> $row['car_enabled'],
	    'thumbnail'		=> $row['car_thumbnail'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    return;
}

/**
* View Request
*
*/
function view_requests(&$requests_data, &$requests_count)
{
    global $db, $config;
    
    if ($requests_count !== false)
    {
	$sql = 'SELECT COUNT(guest_request_id) AS total_entries
		FROM ' . GUEST_REQUESTS_TABLE;
		
	$result = $db->sql_query($sql);
	$requests_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT g.guest_request_id, t.translation_description , g.guest_request_enabled, t.translation_title, g.guest_request_value  
	FROM " . GUEST_REQUESTS_TABLE . " g, " . GUEST_REQUEST_TRANSLATIONS_TABLE . " t 
	WHERE g.guest_request_id=t.guest_request_id AND t.language_id= '" . $config['default_language'] . "'";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $requests_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$requests_data[$i] = array(
	    'id'		=> $row['guest_request_id'],
	    'name'		=> $row['translation_title'],
	    'desc'		=> $row['translation_description'],
	    'enabled'		=> $row['guest_request_enabled'],
	    'value'		=> $row['guest_request_value'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    return;
}

/**
* View Teraphist
*
*/
function view_teraphists(&$teraphists_data, &$teraphists_count)
{
    global $db, $config;
    
    if ($teraphists_count !== false)
    {
	$sql = 'SELECT COUNT(teraphist_id) AS total_entries
		FROM ' . TERAPHISTS_TABLE;
		
	$result = $db->sql_query($sql);
	$teraphists_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT g.teraphist_id, t.translation_description , g.teraphist_enabled, t.translation_title, g.teraphist_thumbnail  
	FROM " . TERAPHISTS_TABLE . " g, " . TERAPHIST_TRANSLATIONS_TABLE . " t 
	WHERE g.teraphist_id=t.teraphist_id AND t.language_id= '" . $config['default_language'] . "'";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $teraphists_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$teraphists_data[$i] = array(
	    'id'		=> $row['teraphist_id'],
	    'name'		=> $row['translation_title'],
	    'desc'		=> $row['translation_description'],
	    'enabled'		=> $row['teraphist_enabled'],
	    'thumbnail'		=> $row['teraphist_thumbnail'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    return;
}

/**
* View Styles
*
*/
function view_rooms(&$rooms_data, &$rooms_count)
{
    global $db;
    
    if ($rooms_count !== false)
    {
	$sql = 'SELECT COUNT(room_id) AS total_entries
		FROM ' . ROOMS_TABLE;
		
	$result = $db->sql_query($sql);
	$rooms_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT r.room_id, r.room_name, r.room_description, r.room_enabled, n.node_name, z.zone_name 	  
	  FROM " . ROOMS_TABLE . " r  LEFT OUTER JOIN " . NODES_TABLE . " n ON r.room_id=n.room_id 
	  LEFT OUTER JOIN " . ZONES_TABLE . " z ON r.zone_id=z.zone_id 
	  ORDER BY r.room_name";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0; $a = 0;
    $rooms_data = array();
    $room_name = '';
    
    while ($row = $db->sql_fetchrow($result))
    {
	if ( $room_name !== $row['room_name'] ) 
	{
	    $rooms_data[$i] = array(
		'id'		=> $row['room_id'],
		'name'		=> $row['room_name'],
		'description'	=> $row['room_description'],
		'enabled'	=> $row['room_enabled'],
		'node_name'	=> $row['node_name'],
		'zone_name'	=> $row['zone_name'],
	    );

	    $a = 1;

	}
	else
	{
	    $rooms_data[$i - $a]['node_name'] .= ', ' . $row['node_name'];
	    
	    $a++;
	}
	
	$room_name = $row['room_name'];
	
	$i++;
	
    }
    $db->sql_freeresult($result);

    //print_r($styles_data); exit;
    return;
}

/**
* View Airports
*
*/
function view_airports(&$airports_data, &$airports_count)
{
    global $db, $config;
    
    if ($airports_count !== false)
    {
	$sql = 'SELECT COUNT(airport_id) AS total_entries
		FROM ' . AIRPORTS_TABLE;
		
	$result = $db->sql_query($sql);
	$airports_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT * FROM " . AIRPORTS_TABLE . " ORDER BY airport_code";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $airports_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$airports_data[$i] = array(
	    'id'	=> $row['airport_id'],
	    'code'	=> $row['airport_code'],
	    'name'	=> $row['airport_name'],
	    'desc'	=> $row['airport_description'],
	    'enabled'	=> $row['airport_enabled'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    return;
}

function view_guest_groups(&$guest_groups_data, &$guest_groups_count)
{
    global $db, $config;
    
    if ($guest_groups_count !== false)
    {
	$sql = 'SELECT COUNT(guest_groups_id) AS total_entries
		FROM ' . GUEST_GROUPS_TABLE;
		
	$result = $db->sql_query($sql);
	$guest_groups_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT * FROM " . GUEST_GROUPS_TABLE . " ORDER BY guest_groups_code";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $guest_groups_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$guest_groups_data[$i] = array(
	    'id'	=> $row['guest_groups_id'],
	    'code'	=> $row['guest_groups_code'],
	    'name'	=> $row['guest_groups_name'],
	    'enabled'	=> $row['guest_groups_enabled'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    return;
}

function view_guest_groups_info(&$guest_groups_data, &$guest_groups_count)
{
    global $db, $config;
    
    if ($guest_groups_count !== false)
    {
	$sql = 'SELECT COUNT(guest_groups_info_id) AS total_entries
		FROM ' . GUEST_GROUPS_INFO_TABLE;
		
	$result = $db->sql_query($sql);
	$guest_groups_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT guest_groups_info_id, g.guest_groups_name, guest_groups_info_title, guest_groups_info_logo, guest_groups_info_welcome, guest_groups_info_enabled FROM " . GUEST_GROUPS_INFO_TABLE . " i JOIN " . GUEST_GROUPS_TABLE . " g ON i.guest_groups_code = g.guest_groups_code ORDER BY guest_groups_info_id";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $guest_groups_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$guest_groups_data[$i] = array(
	    'id'			=> $row['guest_groups_info_id'],
	    'group'			=> $row['guest_groups_name'],
	    'title'			=> $row['guest_groups_info_title'],
	    'logo'			=> $row['guest_groups_info_logo'],
	    'welcome_text'	=> $row['guest_groups_info_welcome'],
	    'enabled'		=> $row['guest_groups_info_enabled'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    return;
}

function view_popups(&$popup_data, &$popup_count)
{
    global $db, $config;
    
    if ($popup_count !== false)
    {
	$sql = 'SELECT COUNT(popup_id) AS total_entries
		FROM ' . POPUP_PROMOS_TABLE;
		
	$result = $db->sql_query($sql);
	$popup_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT * FROM " . POPUP_PROMOS_TABLE . " ORDER BY popup_id";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $popup_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$popup_data[$i] = array(
	    'id'	=> $row['popup_id'],
	    'title'	=> $row['popup_title'],
	    'desc'	=> $row['popup_description'],
	    'image'	=> $row['popup_image'],
	    'enabled'	=> $row['popup_enabled'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    return;
}

function view_popup_schedule(&$popup_data, &$popup_count)
{
    global $db, $config;
    
    if ($popup_count !== false)
    {
	$sql = "SELECT COUNT(popup_schedule_id) AS total_entries
		FROM " . POPUP_PROMO_SCHEDULE_TABLE . " s JOIN ".POPUP_PROMOS_TABLE." p ON s.popup_id = p.popup_id";
		
	$result = $db->sql_query($sql);
	$popup_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT s.popup_schedule_id, s.popup_schedule_time, s.popup_schedule_duration, p.popup_title FROM " . POPUP_PROMO_SCHEDULE_TABLE . " s
    	JOIN ".POPUP_PROMOS_TABLE." p ON s.popup_id = p.popup_id
    	ORDER BY popup_schedule_time ASC";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $popup_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$popup_data[$i] = array(
	    'id'	=> $row['popup_schedule_id'],
	    'time'	=> $row['popup_schedule_time'],
	    'duration'	=> $row['popup_schedule_duration'],
	    'title'	=> $row['popup_title'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    return;
}


/**
* Grab Configurations
*
*/
function grab_configurations(&$config_data, $config_count)
{
    global $db, $config;

    if ($config_count !== false)
    {
	$sql = 'SELECT COUNT(config_id) AS total_entries
		FROM ' . CONFIGURATION_TABLE;
		
	$result = $db->sql_query($sql);
	$config_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }

    //echo 'config_count= ' . $config_count; exit;
    
    $sql = 'SELECT * FROM ' . CONFIGURATION_TABLE . ' WHERE config_enabled=1';
    
    $result = $db->sql_query($sql);
    
    $config_data = array();

    while ($row = $db->sql_fetchrow($result))
    {
	 $config_data[] = array(
	    'id'		=> $row['config_id'],
	    'name'		=> $row['config_name'],
	    'title'		=> $row['config_title'],
	    'value'		=> $row['config_value'],
	    'description'	=> $row['config_description'],
	    'input_type'	=> $row['config_input_type'],
	    );
    }
    
    $db->sql_freeresult($result);
    
    return;
}


/**
* Grab Tv
*
*/
function grab_tv(&$tvs_data, &$tvs_count)
{
    global $db, $config;
    
    if ($tvs_count !== false)
    {
	$sql = 'SELECT COUNT(tv_channel_id) AS total_entries
		FROM ' . TV_CHANNELS_TABLE;
		
	$result = $db->sql_query($sql);
	$tvs_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }

    $sql = "SELECT c.tv_channel_id, c.tv_channel_name, c.tv_channel_thumbnail, c.tv_channel_url_udp, c.tv_channel_url_http, c.tv_channel_enabled, c.tv_channel_order, c.tv_channel_allow_ads, t.translation_title   
	FROM " . TV_CHANNELS_TABLE . " c 
	JOIN " . TV_GROUPINGS_TABLE . " gp ON c.tv_channel_id = gp.tv_channel_id 
	JOIN " . TV_GROUPS_TABLE . " g ON gp.tv_channel_group_id = g.tv_channel_group_id 
	JOIN " . TV_GROUP_TRANSLATIONS_TABLE . " t ON t.tv_channel_group_id = g.tv_channel_group_id 
	WHERE t.language_id= '" . $config['default_language'] . "' 
	ORDER BY c.tv_channel_order";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $temp_id = '';
    $i = 0;
    $ref = 1;
    $tvs_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	if( $row['tv_channel_id'] == $temp_id)
	{
	    $a = $i - $ref;
	    $tvs_data[$a]['group'] = $tvs_data[$a]['group'] . '<br/>' . $row['translation_title'];  
	    
	    $ref++;
	}
	else
	{
	    $tvs_data[$i] = array(
	    'id'		=> $row['tv_channel_id'],
	    'name'		=> $row['tv_channel_name'],
	    'group'		=> $row['translation_title'],
	    'order'		=> $row['tv_channel_order'],
	    'enabled'		=> $row['tv_channel_enabled'],
	    'allow_ads'		=> $row['tv_channel_allow_ads'],
	    'udp'		=> $row['tv_channel_url_udp'],
	    'http'		=> $row['tv_channel_url_http'],
	    'thumbnail'		=> $row['tv_channel_thumbnail'],
	    );
	    
	    $ref = 1;
	
	}
    
	$temp_id = $row['tv_channel_id'];

	$i++; 
    }
    $db->sql_freeresult($result);
    
    //print_r($tvs_data); exit;
    return;
}

function grab_tv_promo(&$tvs_data, &$tvs_count)
{
    global $db, $config;
    
    if ($tvs_count !== false)
    {
	$sql = 'SELECT COUNT(tv_promo_id) AS total_entries
		FROM ' . TV_PROMO_TABLE;
		
	$result = $db->sql_query($sql);
	$tvs_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }

    $sql = "SELECT *
	FROM " . TV_PROMO_TABLE . " t
	ORDER BY t.tv_promo_id";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $temp_id = '';
    $i = 0;
    $ref = 1;
    $tvs_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
		
		$tvs_data[$i] = array(
		'id'		=> $row['tv_promo_id'],
		'title'		=> $row['tv_promo_title'],
		'description'	=> $row['tv_promo_description'],
		'thumbnail'	=> $row['tv_promo_thumbnail'],
		'start'		=> $row['tv_promo_start'],
		'end'		=> $row['tv_promo_end'],
		'default'	=> $row['tv_promo_default'],
		'enabled'	=> $row['tv_promo_enabled'],
		);
		
		$ref = 1;
		
		$temp_id = $row['tv_promo_id'];

		$i++; 
    }
    $db->sql_freeresult($result);
    
    //print_r($tvs_data); exit;
    return;
}

/**
* Grab Movie
*
*/
function grab_movies(&$movies_data, &$movies_count)
{
    global $db, $config;
    
    if ($movies_count !== false)
    {
	$sql = 'SELECT COUNT(movie_id) AS total_entries
		FROM ' . MOVIES_TABLE;
		
	$result = $db->sql_query($sql);
	$movies_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT c.movie_id, c.movie_code, t.translation_title AS movie_title, t.translation_description AS movie_description, c.movie_price, c.movie_casts, c.movie_director, c.movie_thumbnail, c.movie_url, c.movie_trailer, c.movie_enabled, c.movie_allow_ads, tg.translation_title AS group_title 
	FROM " . MOVIES_TABLE . " c 
	JOIN " . MOVIE_TRANSLATIONS_TABLE . " t ON t.movie_id = c.movie_id 
	RIGHT OUTER JOIN " . MOVIE_GROUPINGS_TABLE . " gp ON c.movie_id = gp.movie_id 
	RIGHT OUTER JOIN " . MOVIE_GROUPS_TABLE . " g ON gp.movie_group_id = g.movie_group_id 
	RIGHT OUTER JOIN " . MOVIE_GROUP_TRANSLATIONS_TABLE . " tg ON tg.movie_group_id = g.movie_group_id 
	WHERE t.language_id= '" . $config['default_language'] . "' 
	AND tg.language_id= '" . $config['default_language'] . "' 
	ORDER BY t.translation_title";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $temp_id = '';
    $i = 0;
    $ref = 1;
    $movies_data = array();
    $data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	if( $row['movie_id'] == $temp_id)
	{
	    $a = $i - $ref;
	    $movies_data[$a]['group'] = $movies_data[$a]['group'] . '<br/>' . $row['group_title'];  
	    //$movies_data[$a]['group'] = $movies_data[$a]['group'] . '<br/>' . $row['group_title'];  
	    
	    $ref++;
	}
	else
	{
	    $movies_data[$i] = array(
	    'id'		=> $row['movie_id'],
	    'title'		=> $row['movie_title'],
	    'description'	=> $row['movie_description'],
	    'group'		=> $row['group_title'],
	    'price'		=> $row['movie_price'],
	    'casts'		=> $row['movie_casts'],
	    'enabled'		=> $row['movie_enabled'],
	    'allow_ads'		=> $row['movie_allow_ads'],
	    'url'		=> $row['movie_url'],
	    'trailer'		=> $row['movie_trailer'],
	    'thumbnail'		=> $row['movie_thumbnail'],
	    'director'		=> $row['movie_director'],
	    'code'		=> $row['movie_code'],
	    );
	    
	    $ref = 1;
	
	}
    
	$temp_id = $row['movie_id'];

	$i++; 
    }
    $db->sql_freeresult($result);
    
    //print_r($tvs_data); exit;
    return;  
    
}

/**
* Grab Room Service
*
*/
function grab_services(&$services_data, &$services_count)
{
    global $db, $config;
    
    if ($services_count !== false)
    {
	$sql = 'SELECT COUNT(service_id) AS total_entries
		FROM ' . SERVICES_TABLE;
		
	$result = $db->sql_query($sql);
	$services_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT s.service_id, s.service_code, t.translation_title AS service_name, t.translation_description AS service_description, s.service_price, s.service_order, s.service_thumbnail, s.service_enabled, s.service_allow_ads, tg.translation_title AS group_name 
	FROM " . SERVICES_TABLE . " s 
	JOIN " . SERVICE_TRANSLATIONS_TABLE . " t ON t.service_id = s.service_id 
	JOIN " . SERVICE_GROUPS_TABLE . " g ON g.service_group_id = s.service_group_id 
	JOIN " . SERVICE_GROUP_TRANSLATIONS_TABLE . " tg ON tg.service_group_id = g.service_group_id 
	WHERE t.language_id= '" . $config['default_language'] . "' 
	AND tg.language_id= '" . $config['default_language'] . "' 
	ORDER BY t.translation_title";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $services_data = array();
    $data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$services_data[$i] = array(
	    'id'		=> $row['service_id'],
	    'name'		=> $row['service_name'],
	    'code'		=> $row['service_code'],
	    'description'	=> $row['service_description'],
	    'group'		=> $row['group_name'],
	    'price'		=> $row['service_price'],
	    'order'		=> $row['service_order'],
	    'enabled'		=> $row['service_enabled'],
	    'allow_ads'		=> $row['service_allow_ads'],
	    'thumbnail'		=> $row['service_thumbnail'],
	);
	    
	$i++; 
    }
    $db->sql_freeresult($result);
    
    //print_r($tvs_data); exit;
    return;  
    
}

/**
* Grab Room Spa
*
*/
function grab_spa(&$spa_data, &$spa_count)
{
    global $db, $config;
    
    if ($spa_count !== false)
    {
	$sql = 'SELECT COUNT(spa_id) AS total_entries
		FROM ' . SPAS_TABLE;
		
	$result = $db->sql_query($sql);
	$spa_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT s.spa_id, s.spa_code, t.translation_title AS spa_name, t.translation_description AS spa_description, s.spa_price, s.spa_order, s.spa_thumbnail, s.spa_clip, s.spa_enabled, s.spa_allow_ads, tg.translation_title AS group_name 
	FROM " . SPAS_TABLE . " s 
	JOIN " . SPA_TRANSLATIONS_TABLE . " t ON t.spa_id = s.spa_id 
	JOIN " . SPA_GROUPS_TABLE . " g ON g.spa_group_id = s.spa_group_id 
	JOIN " . SPA_GROUP_TRANSLATIONS_TABLE . " tg ON tg.spa_group_id = g.spa_group_id 
	WHERE t.language_id= '" . $config['default_language'] . "' 
	AND tg.language_id= '" . $config['default_language'] . "' 
	ORDER BY t.translation_title";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $spa_data = array();
    $data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$spa_data[$i] = array(
	    'id'		=> $row['spa_id'],
	    'name'		=> $row['spa_name'],
	    'code'		=> $row['spa_code'],
	    'description'	=> $row['spa_description'],
	    'group'		=> $row['group_name'],
	    'price'		=> $row['spa_price'],
	    'order'		=> $row['spa_order'],
	    'enabled'		=> $row['spa_enabled'],
	    'allow_ads'		=> $row['spa_allow_ads'],
	    'thumbnail'		=> $row['spa_thumbnail'],
	    'clip'		=> $row['spa_clip'],
	);
	    
	$i++; 
    }
    $db->sql_freeresult($result);
    
    //print_r($tvs_data); exit;
    return;  
    
}

/**
* Grab Room Shop
*
*/
function grab_shop(&$shop_data, &$shop_count)
{
    global $db, $config;
    
    if ($shop_count !== false)
    {
	$sql = 'SELECT COUNT(shop_id) AS total_entries
		FROM ' . SHOPS_TABLE;
		
	$result = $db->sql_query($sql);
	$shop_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT s.shop_id, s.shop_code, t.translation_title AS shop_name, t.translation_description AS shop_description, s.shop_price, s.shop_order, s.shop_thumbnail, s.shop_enabled, s.shop_allow_ads, tg.translation_title AS group_name 
	FROM " . SHOPS_TABLE . " s 
	JOIN " . SHOP_TRANSLATIONS_TABLE . " t ON t.shop_id = s.shop_id 
	JOIN " . SHOP_GROUPS_TABLE . " g ON g.shop_group_id = s.shop_group_id 
	JOIN " . SHOP_GROUP_TRANSLATIONS_TABLE . " tg ON tg.shop_group_id = g.shop_group_id 
	WHERE t.language_id= '" . $config['default_language'] . "' 
	AND tg.language_id= '" . $config['default_language'] . "' 
	ORDER BY t.translation_title";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $shop_data = array();
    $data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$shop_data[$i] = array(
	    'id'		=> $row['shop_id'],
	    'name'		=> $row['shop_name'],
	    'code'		=> $row['shop_code'],
	    'description'	=> $row['shop_description'],
	    'group'		=> $row['group_name'],
	    'price'		=> $row['shop_price'],
	    'order'		=> $row['shop_order'],
	    'enabled'		=> $row['shop_enabled'],
	    'allow_ads'		=> $row['shop_allow_ads'],
	    'thumbnail'		=> $row['shop_thumbnail'],
	);
	    
	$i++; 
    }
    $db->sql_freeresult($result);
    
    //print_r($tvs_data); exit;
    return;  
    
}

/**
* Grab Tour
*
*/
function grab_tour(&$tour_data, &$tour_count)
{
    global $db, $config;
    
    if ($tour_count !== false)
    {
	$sql = 'SELECT COUNT(tour_id) AS total_entries
		FROM ' . TOURS_TABLE;
		
	$result = $db->sql_query($sql);
	$tour_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT s.tour_id, s.tour_code, t.translation_title AS tour_name, t.translation_description AS tour_description, s.tour_price, s.tour_order, s.tour_thumbnail, s.tour_clip, s.tour_enabled, s.tour_allow_ads, tg.translation_title AS group_name 
	FROM " . TOURS_TABLE . " s 
	JOIN " . TOUR_TRANSLATIONS_TABLE . " t ON t.tour_id = s.tour_id 
	JOIN " . TOUR_GROUPS_TABLE . " g ON g.tour_group_id = s.tour_group_id 
	JOIN " . TOUR_GROUP_TRANSLATIONS_TABLE . " tg ON tg.tour_group_id = g.tour_group_id 
	WHERE t.language_id= '" . $config['default_language'] . "' 
	AND tg.language_id= '" . $config['default_language'] . "' 
	ORDER BY t.translation_title";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $tour_data = array();
    $data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$tour_data[$i] = array(
	    'id'		=> $row['tour_id'],
	    'name'		=> $row['tour_name'],
	    'code'		=> $row['tour_code'],
	    'description'	=> $row['tour_description'],
	    'group'		=> $row['group_name'],
	    'price'		=> $row['tour_price'],
	    'order'		=> $row['tour_order'],
	    'enabled'		=> $row['tour_enabled'],
	    'allow_ads'		=> $row['tour_allow_ads'],
	    'thumbnail'		=> $row['tour_thumbnail'],
	    'clip'		=> $row['tour_clip'],
	);
	    
	$i++; 
    }
    $db->sql_freeresult($result);
    
    //print_r($tvs_data); exit;
    return;  
    
}
/**
* Grab Directory
*
*/
function grab_directories(&$directories_data, &$directories_count)
{
    global $db, $config;
    
    if ($directories_count !== false)
    {
	$sql = 'SELECT COUNT(directory_id) AS total_entries
		FROM ' . DIRECTORIES_TABLE;
		
	$result = $db->sql_query($sql);
	$directories_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT d.directory_id, d.directory_order, t.translation_title AS directory_title, t.translation_description AS directory_description, d.directory_image, d.directory_image_enabled, d.directory_enabled, d.directory_clip, d.directory_clip_enabled  
	FROM " . DIRECTORIES_TABLE . " d, " . DIRECTORY_TRANSLATIONS_TABLE . " t 
	WHERE t.language_id = '" . $config['default_language'] . "' 
	AND d.directory_id = t.directory_id 
	ORDER BY d.directory_order, t.translation_title";
    //echo $sql; exit;

    $result = $db->sql_query($sql);

    $i = 0;
    $$directories_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$directories_data[$i] = array(
	    'id'		=> $row['directory_id'],
	    'title'		=> $row['directory_title'],
	    'description'	=> $row['directory_description'],
	    'image'		=> $row['directory_image'],
	    'image_enabled'	=> $row['directory_image_enabled'],
	    'clip'		=> $row['directory_clip'],
	    'enabled'		=> $row['directory_enabled'],
	    'clip_enabled'	=> $row['directory_clip_enabled'],
	    'order'		=> $row['directory_order'],
	);

	$i++; 
    }
    $db->sql_freeresult($result);
    
    //print_r($tvs_data); exit;
    return;  
    
}

/**
* Grab Directory Promo
*
*/
function grab_directory_promos(&$directories_data, &$directories_count)
{
    global $db, $config;
    
    if ($directories_count !== false)
    {
	$sql = 'SELECT COUNT(directory_promo_id) AS total_entries
		FROM ' . DIRECTORY_PROMOS_TABLE;
		
	$result = $db->sql_query($sql);
	$directories_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT d.directory_promo_id, d.directory_promo_order, t.translation_title AS directory_promo_title, t.translation_description AS directory_promo_description, d.directory_promo_image, d.directory_promo_image_enabled, d.directory_promo_enabled, d.directory_promo_clip, d.directory_promo_clip_enabled  
	FROM " . DIRECTORY_PROMOS_TABLE . " d, " . DIRECTORY_PROMO_TRANSLATIONS_TABLE . " t 
	WHERE t.language_id = '" . $config['default_language'] . "' 
	AND d.directory_promo_id = t.directory_promo_id 
	ORDER BY d.directory_promo_order, t.translation_title";
    //echo $sql; exit;

    $result = $db->sql_query($sql);

    $i = 0;
    $$directories_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$directories_data[$i] = array(
	    'id'		=> $row['directory_promo_id'],
	    'title'		=> $row['directory_promo_title'],
	    'description'	=> $row['directory_promo_description'],
	    'image'		=> $row['directory_promo_image'],
	    'image_enabled'	=> $row['directory_promo_image_enabled'],
	    'clip'		=> $row['directory_promo_clip'],
	    'enabled'		=> $row['directory_promo_enabled'],
	    'clip_enabled'	=> $row['directory_promo_clip_enabled'],
	    'order'		=> $row['directory_promo_order'],
	);

	$i++; 
    }
    $db->sql_freeresult($result);
    
    //print_r($tvs_data); exit;
    return;  
    
}

/**
* Grab Directory2
*
*/
function grab_directories2(&$directories_data, &$directories_count)
{
    global $db, $config;
    
    if ($directories_count !== false)
    {
	$sql = 'SELECT COUNT(directory2_id) AS total_entries
		FROM ' . DIRECTORIES2_TABLE;
		
	$result = $db->sql_query($sql);
	$directories_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT d.directory2_id, d.directory2_order, t.translation_title AS directory2_title, t.translation_description AS directory2_description, d.directory2_image, d.directory2_image_enabled, d.directory2_enabled, d.directory2_clip, d.directory2_clip_enabled  
	FROM " . DIRECTORIES2_TABLE . " d, " . DIRECTORY2_TRANSLATIONS_TABLE . " t 
	WHERE t.language_id = '" . $config['default_language'] . "' 
	AND d.directory2_id = t.directory2_id 
	ORDER BY d.directory2_order, t.translation_title";
    //echo $sql; exit;

    $result = $db->sql_query($sql);

    $i = 0;
    $$directories_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$directories_data[$i] = array(
	    'id'		=> $row['directory2_id'],
	    'title'		=> $row['directory2_title'],
	    'description'	=> $row['directory2_description'],
	    'image'		=> $row['directory2_image'],
	    'image_enabled'	=> $row['directory2_image_enabled'],
	    'clip'		=> $row['directory2_clip'],
	    'enabled'		=> $row['directory2_enabled'],
	    'clip_enabled'	=> $row['directory2_clip_enabled'],
	    'order'		=> $row['directory2_order'],
	);

	$i++; 
    }
    $db->sql_freeresult($result);
    
    //print_r($tvs_data); exit;
    return;  
    
}

/**
* Grab Directory Grouping
*
*/
function grab_directory_grouping(&$directory_data, &$directory_count, $group)
{
    global $db, $config;
    
	switch($group) {
		case "roomsuite" : 	$table = ROOMSUITES_TABLE;
							$table_translations = ROOMSUITE_TRANSLATIONS_TABLE;
							$prefix = "roomsuites";
							break;
		
		case "resortmap" : $table = RESORTMAPS_TABLE;
							$table_translations = RESORTMAP_TRANSLATIONS_TABLE;
							$prefix = "resortmaps";
							break;

		case "dining" : 	$table = DININGS_TABLE;
							$table_translations = DINING_TRANSLATIONS_TABLE;
							$prefix = "dinings";
							break;

		case "meetingevent" : $table = MEETINGEVENTS_TABLE;
							$table_translations = MEETINGEVENT_TRANSLATIONS_TABLE;
							$prefix = "meetingevents";
							break;

		case "recreational" : $table = RECREATIONALS_TABLE;
							$table_translations = RECREATIONAL_TRANSLATIONS_TABLE;
							$prefix = "recreationals";
							break;

		case "gallery" : $table = GALLERIES_TABLE;
							$table_translations = GALLERY_TRANSLATIONS_TABLE;
							$prefix = "galleries";
							break;
							
		case "contactus" : $table = CONTACTUS_TABLE;
							$table_translations = CONTACTUS_TRANSLATIONS_TABLE;
							$prefix = "contactus";
							break;

		case "inhouse" : $table = INHOUSES_TABLE;
							$table_translations = INHOUSE_TRANSLATIONS_TABLE;
							$prefix = "inhouses";
							break;

		case "publicplace" : $table = PUBLICPLACES_TABLE;
							$table_translations = PUBLICPLACE_TRANSLATIONS_TABLE;
							$prefix = "publicplaces";
							break;

		case "forget" : $table = FORGETS_TABLE;
							$table_translations = FORGET_TRANSLATIONS_TABLE;
							$prefix = "forgets";
							break;

		case "laundry" : $table = LAUNDRY_TABLE;
							$table_translations = LAUNDRY_TRANSLATIONS_TABLE;
							$prefix = "laundry";
							break;

		case "drop_pickup" : $table = DROP_PICKUPS_TABLE;
							$table_translations = DROP_PICKUP_TRANSLATIONS_TABLE;
							$prefix = "drop_pickups";
							break;

		case "business_center" : $table = BUSINESS_CENTERS_TABLE;
							$table_translations = BUSINESS_CENTER_TRANSLATIONS_TABLE;
							$prefix = "business_centers";
							break;

		case "wakeup_call" : $table = WAKEUP_CALLS_TABLE;
							$table_translations = WAKEUP_CALL_TRANSLATIONS_TABLE;
							$prefix = "wakeup_calls";
							break;

		case "car_rental" : $table = CAR_RENTALS_TABLE;
							$table_translations = CAR_RENTAL_TRANSLATIONS_TABLE;
							$prefix = "car_rentals";
							break;

		case "doctor" : $table = DOCTORS_TABLE;
							$table_translations = DOCTOR_TRANSLATIONS_TABLE;
							$prefix = "doctors";
							break;

		case "whatson" : $table = WHATSON_TABLE;
							$table_translations = WHATSON_TRANSLATIONS_TABLE;
							$prefix = "whatson";
							break;
							
		case "interest" : $table = INTERESTS_TABLE;
							$table_translations = INTEREST_TRANSLATIONS_TABLE;
							$prefix = "interest";
							break;
		case "massage" : $table = MASSAGES_TABLE;
							$table_translations = MASSAGE_TRANSLATIONS_TABLE;
							$prefix = "massage";
							break;
	}
	
    if ($directory_count !== false)
    {
	$sql = 'SELECT COUNT('.$prefix.'_id) AS total_entries
		FROM ' . $table;
	
	$result = $db->sql_query($sql);
	$directory_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT d.".$prefix."_id, d.".$prefix."_order, t.translation_title AS ".$prefix."_title, t.translation_description AS ".$prefix."_description, d.".$prefix."_image, d.".$prefix."_image_enabled, d.".$prefix."_enabled, d.".$prefix."_clip, d.".$prefix."_clip_enabled  
	FROM " . $table . " d, " . $table_translations . " t 
	WHERE t.language_id = '" . $config['default_language'] . "' 
	AND d.".$prefix."_id = t.".$prefix."_id 
	ORDER BY d.".$prefix."_order, t.translation_title";
    //echo $sql; exit;

    $result = $db->sql_query($sql);

    $i = 0;
    $directory_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$directory_data[$i] = array(
	    'id'		=> $row[$prefix.'_id'],
	    'title'		=> $row[$prefix.'_title'],
	    'description'	=> $row[$prefix.'_description'],
	    'image'		=> $row[$prefix.'_image'],
	    'image_enabled'	=> $row[$prefix.'_image_enabled'],
	    'clip'		=> $row[$prefix.'_clip'],
	    'enabled'		=> $row[$prefix.'_enabled'],
	    'clip_enabled'	=> $row[$prefix.'_clip_enabled'],
	    'order'		=> $row[$prefix.'_order'],
	);

	$i++; 
    }
    $db->sql_freeresult($result);
    
    //print_r($tvs_data); exit;
    return;  
    
}

/**
* Grab Weathers
*
*/
function grab_weathers(&$weathers_data, &$weathers_count)
{
    global $db, $config;
    
    if ($weathers_count !== false)
    {
	$sql = 'SELECT COUNT(weather_id) AS total_entries
		FROM ' . WEATHER_TABLE;
		
	$result = $db->sql_query($sql);
	$weathers_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT weather_id, weather_city , weather_enabled, weather_country_icon, weather_today_text,
	weather_today_condition, weather_today_icon FROM " . WEATHER_TABLE . 
	" ORDER BY weather_city";
		
    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $weathers_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$weathers_data[$i] = array(
	    'id'		=> $row['weather_id'],
	    'city'		=> $row['weather_city'],
	    'enabled'		=> $row['weather_enabled'],
	    'country_icon'	=> $row['weather_country_icon'],
	    'today_text'	=> $row['weather_today_text'],
	    'today_condition'	=> $row['weather_today_condition'],
	    'today_icon'	=> $row['weather_today_icon'],
	);

	$i++;
    }
    $db->sql_freeresult($result);
    
    return;
}

/**
* Grab Running Text
*
*/
function grab_runningtext(&$runningtext_data, &$runningtext_count)
{
    global $db, $config;
    
    if ($runningtext_count !== false)
    {
	$sql = 'SELECT COUNT(message_id) AS total_entries
		FROM ' . RUNNINGTEXT_TABLE;
		
	$result = $db->sql_query($sql);
	$runningtext_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT r.message_id AS id, r.message_enabled, r.message_global, t.translation_message AS message, r.message_schedule_start,  r.message_schedule_end, r.message_daily, r.message_order
	FROM " . RUNNINGTEXT_TABLE . " r 
	JOIN " . RUNNINGTEXT_TRANSLATIONS_TABLE . " t ON t.message_id = r.message_id
	WHERE t.language_id= '" . $config['default_language'] . "'
	ORDER BY r.message_id";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $runningtext_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$runningtext_data[$i] = array(
	    'id'		=> $row['id'],
	    'message'		=> $row['message'],
	    'enabled'		=> $row['message_enabled'],
	    'global'		=> $row['message_global'],
	    'start'		=> $row['message_schedule_start'],
	    'end'		=> $row['message_schedule_end'],
	    'daily'		=> $row['message_daily'],
		'order'		=> $row['message_order'],
	);
	    
	$sql = 'SELECT room_name FROM ' . ROOMS_TABLE . ' r 
	    JOIN ' . RUNNINGTEXT_GROUPINGS_TABLE . " g ON r.room_id=g.room_id 
	    WHERE g.message_id=" . $row['id'] . ' ORDER BY room_name';
	$result_room = $db->sql_query($sql);
	
	while ($row_room = $db->sql_fetchrow($result_room))
	{
	    $separator = !$runningtext_data[$i]['room']? '' : ', ';
	    $runningtext_data[$i]['room'] .= $separator . $row_room['room_name'];
	}
    
	$db->sql_freeresult($result_room);
	
	$sql = 'SELECT zone_name FROM ' . ZONES_TABLE . ' z 
	    JOIN ' . RUNNINGTEXT_ZONE_GROUPINGS_TABLE . " g ON z.zone_id=g.zone_id 
	    WHERE g.message_id=" . $row['id'] . ' ORDER BY zone_name';
	$result_zone = $db->sql_query($sql);
	
	while ($row_zone = $db->sql_fetchrow($result_zone))
	{
	    $separator = !$runningtext_data[$i]['zone']? '' : ', ';
	    $runningtext_data[$i]['zone'] .= $separator . $row_zone['zone_name'];
	}
    
	$db->sql_freeresult($result_zone);

	$i++; 
    }
    $db->sql_freeresult($result);
    
    return;  
    
}

/**
* Get All of Modules
* 
*/
function grab_all_modules(&$module, &$module_count)
{
    global $db;

    if ($module_count !== false)
    {
	$sql = 'SELECT COUNT(module_detail_id) AS total_entries
		FROM ' . MODULES_VIEW;
	//echo $sql; exit;	
	$result = $db->sql_query($sql);
	$module_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    //echo $module_count; exit;
    $sql = "SELECT module_detail_id, module_detail_name, module_detail_cat_name, module_name 
		FROM " . MODULES_VIEW . " ORDER BY module_name, module_detail_cat_name, module_detail_name";
		
    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $module = array();
	while ($row = $db->sql_fetchrow($result))
	{
	    $module[$i] = array(
		'mid'			=> $row['module_detail_id'],
		'mdetailname'		=> $row['module_detail_name'],
		'mdetailcat'		=> $row['module_detail_cat_name'],
		'mparent'		=> $row['module_name'],
	    );

	    $i++;
	}
	$db->sql_freeresult($result);

	return;

}

/**
* Get All of Users Info
* 
*/
function grab_all_users(&$users, &$users_count)
{
    global $db;

    if ($users_count !== false)
    {
	$sql = 'SELECT COUNT(user_id) AS total_entries
		FROM ' . USERS_TABLE ." WHERE user_enabled = 1";;
	//echo $sql; exit;	
	$result = $db->sql_query($sql);
	$users_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT u.user_id, u.user_name, u.user_fullname, g.user_group_name FROM " . USERS_TABLE . " u, " . USER_GROUPS_TABLE . " 	g WHERE u.user_group_id = g.user_group_id AND u.user_enabled = 1";
    
    //echo $sql; exit;
    $result = $db->sql_query($sql);
  
    $i = 0;
    $users = array();
    while ($row = $db->sql_fetchrow($result))
    {
	$users[$i] = array(
	    'uid'		=> $row['user_id'],
	    'user_name'		=> $row['user_name'],
	    'user_fullname'	=> $row['user_fullname'],
	    'user_group_name'	=> $row['user_group_name'],
	);

	$i++;
    }
    $db->sql_freeresult($result);
    
    //print_r($users);

    return;
}
    
/**
* Get Modules Info
* 
*/
function get_moduleinfo($mid)
{
    global $db;

    $sql = "SELECT module_detail_name, module_detail_cat_name, module_name 
		FROM " . MODULES_VIEW . " WHERE module_detail_id = $mid";
		
    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    
    $userinfo = '';
    
    if(isset($data['module_detail_name']))
    {
	$moduleinfo = $data['module_detail_name'] . " - " . $data['module_detail_cat_name'] . " - " . $data['module_name'] . ' Tab';
    }
    else
    {
	die('Unable to find Module in get_moduleinfo.');
    }

    return $moduleinfo;
}

/**
* Get Priviledges
* 
*/
function grab_priviledges(&$priviledge, $keywords)
{
    global $db;

    $sql = "SELECT module_detail_id, user_id, permission_id, permission_value
	FROM " . PRIVILEDGES_VIEW . $keywords;
		
    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $priviledge = array();
    while ($row = $db->sql_fetchrow($result))
    {
	$priviledge[$i] = array(
	    'puid'	=> $row['user_id'],
	    'mdid'	=> $row['module_detail_id'],
	    'pid'	=> $row['permission_id'],
	    'pvalue'	=> $row['permission_value'],
	);

	$i++;
    }

    $db->sql_freeresult($result);
    
    //print_r($priviledge); 

    return;

}

/**
* View Guests
*
*/
function view_guests(&$guests_data, &$guests_count)
{
    global $db, $config;
    
    if ($guests_count !== false)
    {
	$sql = 'SELECT COUNT(guest_reservation_id) AS total_entries
		FROM ' . GUESTS_TABLE;
		
	$result = $db->sql_query($sql);
	$guests_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT guest_reservation_id, guest_arrival_date, guest_firstname, guest_lastname, guest_fullname, guest_salutation, guest_groupname, room_name, guest_room_share 
	FROM " . GUESTS_TABLE . " ORDER BY room_name";
		
    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $guests_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$guests_data[$i] = array(
	    'resv_id'		=> $row['guest_reservation_id'],
	    'arrival'		=> $row['guest_arrival_date'],
	    'firstname'		=> $row['guest_firstname'],
	    'lastname'		=> $row['guest_lastname'],
	    'fullname'		=> $row['guest_fullname'],
	    'salutation'	=> $row['guest_salutation'],
	    'groupname'		=> $row['guest_groupname'],
	    'room'		=> $row['room_name'],
	    'room_share'	=> $row['guest_room_share'],
	);

	$i++;
    }
    $db->sql_freeresult($result);
    
    return;
}

function set_roomshare($room_name, $old_room="")
{
    global $db;
    
    // Set New Room Status
    $sql = 'SELECT COUNT(guest_reservation_id) AS total_entries
	FROM ' . GUESTS_TABLE . " WHERE room_name='" . $room_name . "'";
    //echo $sql . '<br/><br/>';
    $result = $db->sql_query($sql);
    $guests_count = (int) $db->sql_fetchfield('total_entries');
    $db->sql_freeresult($result);
    
    if ( $guests_count > 1 )
    {
	$sql = "UPDATE " . GUESTS_TABLE . " SET guest_room_share=1" . " WHERE room_name='" . $room_name . "'";
	//echo 'guests_count: ' . $guests_count . '<br/>' . $sql. '<br/>';
    }
    elseif ( $guests_count < 2 )
    {
	$sql = "UPDATE " . GUESTS_TABLE . " SET guest_room_share=0" . " WHERE room_name='" . $room_name . "'";
    }
    $db->sql_query($sql);
    
    // Set Old Room Status
    $sql = 'SELECT COUNT(guest_reservation_id) AS total_entries
	FROM ' . GUESTS_TABLE . " WHERE room_name='" . $old_room . "'";
    $result = $db->sql_query($sql);
    $old_count = (int) $db->sql_fetchfield('total_entries');
    $db->sql_freeresult($result);
    
    if ( $old_count < 2 )
    {
	$sql = "UPDATE " . GUESTS_TABLE . " SET guest_room_share=0" . " WHERE room_name='" . $old_room . "'";
	$db->sql_query($sql);
	//echo 'old_count: ' . $old_count . '<br/>' . $sql; exit;    
    }

    return true;
}

/**
* Generate sort selection fields
*/
function gen_sort_selects(&$limit_days, &$sort_by_text, &$sort_days, &$sort_key, &$sort_dir, &$s_limit_days, &$s_sort_key, &$s_sort_dir, &$u_sort_param, $def_st = false, $def_sk = false, $def_sd = false)
{
	global $adm_lang;

	
	$sort_dir_text = array('a' => $adm_lang['ascending'], 'd' => $adm_lang['descending']);

	$sorts = array(
		'st'	=> array(
			'key'		=> 'sort_days',
			'default'	=> $def_st,
			'options'	=> $limit_days,
			'output'	=> &$s_limit_days,
		),

		'sk'	=> array(
			'key'		=> 'sort_key',
			'default'	=> $def_sk,
			'options'	=> $sort_by_text,
			'output'	=> &$s_sort_key,
		),

		'sd'	=> array(
			'key'		=> 'sort_dir',
			'default'	=> $def_sd,
			'options'	=> $sort_dir_text,
			'output'	=> &$s_sort_dir,
		),
	);
	$u_sort_param  = '';

	foreach ($sorts as $name => $sort_ary)
	{
		$key = $sort_ary['key'];
		$selected = $$sort_ary['key'];

		// Check if the key is selectable. If not, we reset to the default or first key found.
		// This ensures the values are always valid. We also set $sort_dir/sort_key/etc. to the
		// correct value, else the protection is void. ;)
		if (!isset($sort_ary['options'][$selected]))
		{
			if ($sort_ary['default'] !== false)
			{
				$selected = $$key = $sort_ary['default'];
			}
			else
			{
				@reset($sort_ary['options']);
				$selected = $$key = key($sort_ary['options']);
			}
		}

		$sort_ary['output'] = '<select name="' . $name . '" id="' . $name . '">';
		foreach ($sort_ary['options'] as $option => $text)
		{
			$sort_ary['output'] .= '<option value="' . $option . '"' . (($selected == $option) ? ' selected="selected"' : '') . '>' . $text . '</option>';
		}
		$sort_ary['output'] .= '</select>';

		$u_sort_param .= ($selected !== $sort_ary['default']) ? ((strlen($u_sort_param)) ? '&amp;' : '') . "{$name}={$selected}" : '';
	}

	return;
}

function is_image($image)
{
    global $config;

    // Split it into sections to make life easier
    $image_array = explode(".", $image);

    //print_r($image_array); exit;

    // Check filename
    for ($i = 0; $i < sizeof($image_array); $i++) 
    {
	if  (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $image_array[$i])) 
	{
	    //echo 'crotttt'; exit;
	    return false;
	}
    }

    // Check filetype
    $image_array[1] = strtolower($image_array[1]);

    if ( !in_array($image_array[1], $config['image_extensions']) ) return false;

    return true;

}

function generate_lang($field_name, $selected_item = '')
{
	global $db;

	$sql = "SELECT language_id, language_name FROM " . LANGUAGES_TABLE . " WHERE language_enabled = 1 ORDER BY language_name";

	$result = $db->sql_query($sql);
	
	$select_lang = '<select name="' . $field_name . '"><option></option>';

	while ($row = $db->sql_fetchrow($result))
	{
	    $selected = ( $selected_item == $row['language_id'] ) ? ' selected="selected"' : '';
	    $select_lang .= '<option value="' . $row['language_id'] . '" ' . $selected . '>' . $row['language_name'] . '</option>';
			
	}
	
	$db->sql_freeresult($result);
	
	$select_lang .= '</select>';

	return $select_lang;
}

function generate_group($field_name, $selected_item = '')
{
	global $db;

	$sql = "SELECT user_group_id, user_group_name FROM " . USER_GROUPS_TABLE . " WHERE user_group_enabled = 1 ORDER BY user_group_name";

	$result = $db->sql_query($sql);
	
	$select_group = '<select name="' . $field_name . '"><option></option>';

	while ($row = $db->sql_fetchrow($result))
	{
	    $selected = ( $selected_item == $row['user_group_id'] ) ? ' selected="selected"' : '';
	    $select_group .= '<option value="' . $row['user_group_id'] . '" ' . $selected . '>' . $row['user_group_name'] . '</option>';
			
	}
	
	$db->sql_freeresult($result);
	
	$select_group .= '</select>';

	return $select_group;
}

function generate_zone($field_name, $selected_item = '')
{
	global $db;

	$sql = "SELECT zone_id, zone_name FROM " . ZONES_TABLE . " WHERE zone_enabled = 1 ORDER BY zone_name";

	$result = $db->sql_query($sql);
	
	$select_group = '<select name="' . $field_name . '"><option></option>';

	while ($row = $db->sql_fetchrow($result))
	{
	    $selected = ( $selected_item == $row['zone_id'] ) ? ' selected="selected"' : '';
	    $select_group .= '<option value="' . $row['zone_id'] . '" ' . $selected . '>' . $row['zone_name'] . '</option>';
			
	}
	
	$db->sql_freeresult($result);
	
	$select_group .= '</select>';

	return $select_group;
}

/**
* Generate TV Group
*
* Param		$selected_item		array 
*/
function generate_tv_group($field_name, $selected_item = array())
{
	global $db, $config;

	$sql = "SELECT g.tv_channel_group_id, t.translation_title FROM " . TV_GROUPS_TABLE . " g, " . 
	    TV_GROUP_TRANSLATIONS_TABLE . " t 
	    WHERE g.tv_channel_group_id=t.tv_channel_group_id AND g.tv_channel_group_enabled = 1 
	    AND t.language_id = '" . $config['default_language'] . "' ORDER BY t.translation_title";

	$result = $db->sql_query($sql);
	
	$select_group = '<select name="' . $field_name . '" width="25" multiple="multiple" size="10">';

	while ($row = $db->sql_fetchrow($result))
	{
	    $selected = ( in_array($row['tv_channel_group_id'], $selected_item)) ? ' selected="selected"' : '';
	    $select_group .= '<option value="' . $row['tv_channel_group_id'] . '" ' . $selected . '>' . $row['translation_title'] . '</option>';
			
	}
	
	$db->sql_freeresult($result);
	
	$select_group .= '</select>';

	return $select_group;
}

/**
* Generate Movie Genre
*
* Param		$selected_item		array 
*/

function generate_movie_genre($field_name, $selected_item, $group_data)
{
    global $db, $config;

    $sql = "SELECT g.movie_group_id, t.translation_title, gp.movie_id FROM " . MOVIE_GROUPS_TABLE . " g 
	JOIN " . MOVIE_GROUP_TRANSLATIONS_TABLE . " t ON g.movie_group_id=t.movie_group_id 
	LEFT JOIN " . MOVIE_GROUPINGS_TABLE . " gp ON g.movie_group_id=gp.movie_group_id 
	WHERE g.movie_group_enabled = 1 
	AND t.language_id = '" . $config['default_language'] . "' ORDER BY t.translation_title";
	//echo $sql . '<p>' . $selected_item; exit;
	$result = $db->sql_query($sql);
	
	$select_group = '<select name="' . $field_name . '" width="25" multiple="multiple" size="10">';

	while ($row = $db->sql_fetchrow($result))
	{
	    if( $row['movie_id'] == $selected_item )
	    {
		$selected = 'selected="selected"';
		//echo $row['translation_title'] . '-' ;
	    }
	    else
	    {
		$selected = '';
	    }
	    
	    if( $row['translation_title'] !== $old_item )
	    {
		//$selected = ( in_array($row['movie_group_id'], $selected_item)) ? ' selected="selected"' : '';
		$select_group .= '<option value="' . $row['movie_group_id'] . '" ' . $selected . '>' . $row['translation_title'] . '</option>';
		
		$old_item = $row['translation_title'];
	    }
	}
	
	$db->sql_freeresult($result);
	
	$select_group .= '</select>';

    
    
    return $select_group;
}

/**
* Generate Node for Room
*
* Param		$selected_item		array 
*/

function generate_node($field_name, $rid)
{
    global $db, $config;

    $sql = "SELECT node_id, node_name, room_id FROM " . NODES_TABLE . " WHERE room_id = $rid" . 
	   " OR room_id = 0 ORDER BY node_name";

	$result = $db->sql_query($sql);
	
	$select_node = '<select name="' . $field_name . '" width="25" multiple="multiple" size="10">';

	while ($row = $db->sql_fetchrow($result))
	{
		if( $row['room_id'] == $rid )
		{
		    $selected = 'selected="selected"';
		}
		else
		{
		    $selected = '';
		}
	
	    //$selected = ( in_array($row['movie_group_id'], $selected_item)) ? ' selected="selected"' : '';
	    $select_node .= '<option value="' . $row['node_id'] . '" ' . $selected . '>' . $row['node_name'] . '</option>';
			
	}
	
	$db->sql_freeresult($result);
	
	$select_node .= '</select>';

    
    
    return $select_node;
}

function generate_all_node($field_name, $selected_item)
{
    global $db, $config;

    $sql = "SELECT node_id, node_name, room_id FROM " . NODES_TABLE . " ORDER BY node_name";
    
	$result = $db->sql_query($sql);
	
	$select_node = '<select name="' . $field_name . '" width="25" multiple="multiple" size="10">';

    while ($row = $db->sql_fetchrow($result))
	{
        $selected = '';
    
        $sql = "SELECT g.node_target_gate_grouping_id FROM " . NODE_TARGET_GATE_GROUPINGS_TABLE . " g WHERE g.node_id = ".$row['node_id']."";
        
        $result_group = $db->sql_query($sql);
        
        while($row_group = $db->sql_fetchrow($result_group)) {
            
            if( $row_group['node_target_gate_grouping_id'] == $selected_item )
            {
                $selected = 'selected="selected"';
            }
        }
        
	    //$selected = ( in_array($row['movie_group_id'], $selected_item)) ? ' selected="selected"' : '';
	    $select_node .= '<option value="' . $row['node_id'] . '" ' . $selected . '>' . $row['node_name'] . '</option>';
			
	}
    
	$db->sql_freeresult($result);
	
	$select_node .= '</select>';

    
    
    return $select_node;
}

/**
* Generate Node for Room
*
* Param		$selected_item		array 
*/

function generate_room_combo($field_name, $rid)
{
    global $db, $config;

    $sql = "SELECT room_name FROM " . ROOMS_TABLE . " WHERE room_enabled = 1 ORDER BY room_name";

	$result = $db->sql_query($sql);
	
	$select_room = '<select name="' . $field_name . '" >';

	while ($row = $db->sql_fetchrow($result))
	{
		if( $row['room_name'] == $rid )
		{
		    $selected = 'selected="selected"';
		}
		else
		{
		    $selected = '';
		}
	
	    //$selected = ( in_array($row['movie_group_id'], $selected_item)) ? ' selected="selected"' : '';
	    $select_room .= '<option value="' . $row['room_name'] . '" ' . $selected . '>' . $row['room_name'] . '</option>';
			
	}
	
	$db->sql_freeresult($result);
	
	$select_room .= '</select>';
    
    return $select_room;
}

function generate_user_combo($field_name)
{
    global $db;

    $sql = "SELECT u.user_id, u.user_name, u.user_fullname, g.user_group_name FROM " . USERS_TABLE . " u, " . USER_GROUPS_TABLE . " 	g 
	WHERE u.user_group_id = g.user_group_id AND u.user_enabled = 1 
	ORDER BY g.user_group_name, u.user_name";

    $result = $db->sql_query($sql);
	
    $select_user = '<select name="' . $field_name . '"><option></option>';

    while ($row = $db->sql_fetchrow($result))
    {
	//$selected = ( $selected_item == $row['user_group_id'] ) ? ' selected="selected"' : '';
	$select_user .= '<option value="' . $row['user_id'] . '">' . $row['user_name'] . ' - ' . $row['user_fullname'] . ' - ' . $row['user_group_name'] . '</option>';
    }
	
    $db->sql_freeresult($result);
	
    $select_user .= '</select>';

    return $select_user;
}

function generate_guestgroup_combo($field_name, $rid)
{
    global $db, $config;

    $sql = "SELECT guest_groups_code, guest_groups_name FROM " . GUEST_GROUPS_TABLE . " WHERE guest_groups_enabled = 1 ORDER BY guest_groups_name";

	$result = $db->sql_query($sql);
	
	$select_room = '<select name="' . $field_name . '" >';
	$select_room .= '<option value="" ' . $selected . '></option>';
	while ($row = $db->sql_fetchrow($result))
	{
		if( $row['guest_groups_code'] == $rid )
		{
		    $selected = 'selected="selected"';
		}
		else
		{
		    $selected = '';
		}
	
	    //$selected = ( in_array($row['movie_group_id'], $selected_item)) ? ' selected="selected"' : '';
	    $select_room .= '<option value="' . $row['guest_groups_code'] . '" ' . $selected . '>' . $row['guest_groups_name'] . '</option>';
			
	}
	
	$db->sql_freeresult($result);
	
	$select_room .= '</select>';
    
    return $select_room;
}

function generate_menu_groups($field_name, $selected_item)
{
    global $db, $config;

    $sql = "SELECT g.menu_group_id, t.translation_title FROM " . MENU_GROUPS_TABLE . " g, " . 	MENU_GROUP_TRANSLATIONS_TABLE . " t 
	WHERE g.menu_group_id = t.menu_group_id AND g.menu_group_enabled = 1 
	AND t.language_id='" . $config['default_language'] . "'
	ORDER BY t.translation_title";

	//echo $sql; exit;
    $result = $db->sql_query($sql);
	
    $select_group = '<select name="' . $field_name . '"><option></option>';

    while ($row = $db->sql_fetchrow($result))
    {
	if( $row['menu_group_id'] == $selected_item )
	{
	    $selected = 'selected="selected"';
	}
	else
	{
	    $selected = '';
	}
	
	//$selected = ( $selected_item == $row['user_group_id'] ) ? ' selected="selected"' : '';
	$select_group .= '<option value="' . $row['menu_group_id'] . '" ' . $selected . '>' . $row['translation_title'] . '</option>';
    }
	
    $db->sql_freeresult($result);
	
    $select_group .= '</select>';

    return $select_group;
}


function generate_service_groups($field_name, $selected_item)
{
    global $db, $config;

    $sql = "SELECT g.service_group_id, t.translation_title FROM " . SERVICE_GROUPS_TABLE . " g, " . 	SERVICE_GROUP_TRANSLATIONS_TABLE . " t 
	WHERE g.service_group_id = t.service_group_id AND g.service_group_enabled = 1 
	AND t.language_id='" . $config['default_language'] . "'
	ORDER BY t.translation_title";

	//echo $sql; exit;
    $result = $db->sql_query($sql);
	
    $select_service = '<select name="' . $field_name . '"><option></option>';

    while ($row = $db->sql_fetchrow($result))
    {
	if( $row['service_group_id'] == $selected_item )
	{
	    $selected = 'selected="selected"';
	}
	else
	{
	    $selected = '';
	}
	
	//$selected = ( $selected_item == $row['user_group_id'] ) ? ' selected="selected"' : '';
	$select_service .= '<option value="' . $row['service_group_id'] . '" ' . $selected . '>' . $row['translation_title'] . '</option>';
    }
	
    $db->sql_freeresult($result);
	
    $select_service .= '</select>';

    return $select_service;
}

function generate_spa_groups($field_name, $selected_item)
{
    global $db, $config;

    $sql = "SELECT g.spa_group_id, t.translation_title FROM " . SPA_GROUPS_TABLE . " g, " . 	SPA_GROUP_TRANSLATIONS_TABLE . " t 
	WHERE g.spa_group_id = t.spa_group_id AND g.spa_group_enabled = 1 
	AND t.language_id='" . $config['default_language'] . "'
	ORDER BY t.translation_title";

	//echo $sql; exit;
    $result = $db->sql_query($sql);
	
    $select_spa = '<select name="' . $field_name . '"><option></option>';

    while ($row = $db->sql_fetchrow($result))
    {
	if( $row['spa_group_id'] == $selected_item )
	{
	    $selected = 'selected="selected"';
	}
	else
	{
	    $selected = '';
	}
	
	//$selected = ( $selected_item == $row['user_group_id'] ) ? ' selected="selected"' : '';
	$select_spa .= '<option value="' . $row['spa_group_id'] . '" ' . $selected . '>' . $row['translation_title'] . '</option>';
    }
	
    $db->sql_freeresult($result);
	
    $select_spa .= '</select>';

    return $select_spa;
}

function generate_shop_groups($field_name, $selected_item)
{
    global $db, $config;

    $sql = "SELECT g.shop_group_id, t.translation_title FROM " . SHOP_GROUPS_TABLE . " g, " . 	SHOP_GROUP_TRANSLATIONS_TABLE . " t 
	WHERE g.shop_group_id = t.shop_group_id AND g.shop_group_enabled = 1 
	AND t.language_id='" . $config['default_language'] . "'
	ORDER BY t.translation_title";

	//echo $sql; exit;
    $result = $db->sql_query($sql);
	
    $select_shop = '<select name="' . $field_name . '"><option></option>';

    while ($row = $db->sql_fetchrow($result))
    {
	if( $row['shop_group_id'] == $selected_item )
	{
	    $selected = 'selected="selected"';
	}
	else
	{
	    $selected = '';
	}
	
	//$selected = ( $selected_item == $row['user_group_id'] ) ? ' selected="selected"' : '';
	$select_shop .= '<option value="' . $row['shop_group_id'] . '" ' . $selected . '>' . $row['translation_title'] . '</option>';
    }
	
    $db->sql_freeresult($result);
	
    $select_shop .= '</select>';

    return $select_shop;
}

function generate_tour_groups($field_name, $selected_item)
{
    global $db, $config;

    $sql = "SELECT g.tour_group_id, t.translation_title FROM " . TOUR_GROUPS_TABLE . " g, " . 	TOUR_GROUP_TRANSLATIONS_TABLE . " t 
	WHERE g.tour_group_id = t.tour_group_id AND g.tour_group_enabled = 1 
	AND t.language_id='" . $config['default_language'] . "'
	ORDER BY t.translation_title";

	//echo $sql; exit;
    $result = $db->sql_query($sql);
	
    $select_tour = '<select name="' . $field_name . '"><option></option>';

    while ($row = $db->sql_fetchrow($result))
    {
	if( $row['tour_group_id'] == $selected_item )
	{
	    $selected = 'selected="selected"';
	}
	else
	{
	    $selected = '';
	}
	
	//$selected = ( $selected_item == $row['user_group_id'] ) ? ' selected="selected"' : '';
	$select_tour .= '<option value="' . $row['tour_group_id'] . '" ' . $selected . '>' . $row['translation_title'] . '</option>';
    }
	
    $db->sql_freeresult($result);
	
    $select_tour .= '</select>';

    return $select_tour;
}

function generate_module_combo($field_name)
{
    global $db;
    
    $sql = "SELECT module_detail_id, module_detail_name, module_detail_cat_name, module_name 
		FROM " . MODULES_VIEW . " ORDER BY module_name, module_detail_cat_name, module_detail_name";

    $result = $db->sql_query($sql);

    $select_module = '<select name="' . $field_name . '"><option></option>';

    while ($row = $db->sql_fetchrow($result))
    {
	//$selected = ( $selected_item == $row['user_group_id'] ) ? ' selected="selected"' : '';
	$select_module .= '<option value="' . $row['module_detail_id'] . '">' . $row['module_detail_name'] . ' - ' . $row['module_detail_cat_name'] . ' - ' . $row['module_name'] . '</option>';

    }

    $db->sql_freeresult($result);

    $select_module .= '</select>';

    return $select_module;
}

function generate_module_category($field_name, $selected_item = '')
{
    global $db;

    $sql = "SELECT module_detail_cat_id, module_detail_cat_name FROM " . MODULES_DETAIL_CAT_TABLE . "  
	ORDER BY module_detail_cat_name";

    $result = $db->sql_query($sql);
	
    $select_cat = '<select name="' . $field_name . '"><option></option>';

    while ($row = $db->sql_fetchrow($result))
    {
	$selected = ( $selected_item == $row['module_detail_cat_id'] ) ? ' selected="selected"' : '';
	$select_cat .= '<option value="' . $row['module_detail_cat_id'] . '" ' . $selected . '>' . $row['module_detail_cat_name'] . '</option>';
    }
	
    $db->sql_freeresult($result);
	
    $select_cat .= '</select>';

    return $select_cat;
}

function generate_module($field_name, $selected_item = '')
{
    global $db;

    $sql = "SELECT module_id, module_name FROM " . MODULES_TABLE . "  
	WHERE module_enabled = 1  
	ORDER BY module_name";

    $result = $db->sql_query($sql);
	
    $select_module = '<select name="' . $field_name . '"><option></option>';

    while ($row = $db->sql_fetchrow($result))
    {
	$selected = ( $selected_item == $row['module_id'] ) ? ' selected="selected"' : '';
	$select_module .= '<option value="' . $row['module_id'] . '" ' . $selected . '>' . $row['module_name'] . '</option>';
    }
	
    $db->sql_freeresult($result);
	
    $select_module .= '</select>';

    return $select_module;

}

function generate_styles_combo($field_name, $selected_item = '')
{
    global $db;

    $sql = "SELECT style_id, style_name FROM " . STYLES_TABLE . "  
	WHERE style_admin = 0  
	ORDER BY style_name";

    $result = $db->sql_query($sql);
	
    $select_style = '<select name="' . $field_name . '"><option></option>';

    while ($row = $db->sql_fetchrow($result))
    {
	$selected = ( $selected_item == $row['style_id'] ) ? ' selected="selected"' : '';
	$select_style .= '<option value="' . $row['style_id'] . '" ' . $selected . '>' . $row['style_name'] . '</option>';
    }
	
    $db->sql_freeresult($result);
	
    $select_style .= '</select>';

    return $select_style;

}

function generate_runningtext_target($field_name, $selected_item)
{
    global $db, $config;

    //print_r($selected_item); exit;
    $sql = "SELECT r.room_id, r.room_name, g.message_id FROM " . ROOMS_TABLE . " r 
	    LEFT JOIN " . RUNNINGTEXT_GROUPINGS_TABLE . " g ON r.room_id=g.room_id
	    WHERE room_enabled=1 ORDER BY room_name";

    $result = $db->sql_query($sql);
	
	$select_group = '<select name="' . $field_name . '" width="25" multiple="multiple" size="10">';

	while ($row = $db->sql_fetchrow($result))
	{
		if(!empty($selected_item)) {
			$sql2 = "SELECT r.room_id, r.room_name, g.message_id FROM " . ROOMS_TABLE . " r 
		    LEFT JOIN " . RUNNINGTEXT_GROUPINGS_TABLE . " g ON r.room_id=g.room_id
		    WHERE r.room_id = ".$row['room_id']." AND g.message_id = ".$selected_item."";
		    
		    $result2 = $db->sql_query($sql2);
		    $room_id_selected = $db->sql_fetchfield('room_id');

			if( $row['room_id'] == $room_id_selected )
			{
			    $selected = 'selected="selected"';
			    //echo $row['room_name'] . '-';
			    //$tes = 'SELECT-';
			}
			else
			{
			    $selected = '';
			}
	    }
	    
	    if ( $row['room_name'] !== $old_item )
	    {
		//$selected = ( in_array($row['room_id'], $selected_item)) ? ' selected="selected"' : '';
		$select_group .= '<option value="' . $row['room_id'] . '" ' . $selected . '>' . $row['room_name'] . '</option>';
		
		$old_item = $row['room_name'];
	    }

	    
	}
	
	$db->sql_freeresult($result);
	
	$select_group .= '</select>';

      return $select_group;

}

function generate_runningtext_zone_target($field_name, $selected_item)
{
    global $db, $config;

    //print_r($selected_item); exit;
    $sql = "SELECT z.zone_id, z.zone_name FROM " . ZONES_TABLE . " z 
	    WHERE z.zone_enabled=1 ORDER BY z.zone_name";
    //echo $sql; exit;

    $result = $db->sql_query($sql);
	
	$select_zone = '<select name="' . $field_name . '" width="25" multiple="multiple" size="10">';

	while ($row = $db->sql_fetchrow($result))
	{
		if(!empty($selected_item)) {
			$sql2 = "SELECT z.zone_id, z.zone_name, g.message_id FROM " . ZONES_TABLE . " z 
		    LEFT JOIN " . RUNNINGTEXT_ZONE_GROUPINGS_TABLE . " g ON z.zone_id=g.zone_id
		    WHERE z.zone_id = ".$row['zone_id']." AND g.message_id = ".$selected_item."";
		    $result2 = $db->sql_query($sql2);
		    $zone_id_selected = $db->sql_fetchfield('zone_id');

			if( $row['zone_id'] === $zone_id_selected )
			{
			    $selected = 'selected="selected"';
			}
			else
			{
			    $selected = '';
			}
	    }
	    
	    if ( $row['zone_name'] !== $old_item )
	    {
		//$selected = ( in_array($row['room_id'], $selected_item)) ? ' selected="selected"' : '';
		$select_zone .= '<option value="' . $row['zone_id'] . '" ' . $selected . '>' . $row['zone_name'] . '</option>';
		
		$old_item = $row['zone_name'];
	    }

	}
	
	$db->sql_freeresult($result);
	
	$select_zone .= '</select>';

    return $select_zone;

}

function generate_channel_combo($field_name, $tid)
{
    global $db, $config;

    $sql = "SELECT tv_channel_id, tv_channel_name FROM " . TV_CHANNELS_TABLE . " WHERE tv_channel_enabled = 1 ORDER BY tv_channel_name";

	$result = $db->sql_query($sql);
	
	$select_channel = '<select name="' . $field_name . '" id="' . $field_name . '" >';

	while ($row = $db->sql_fetchrow($result))
	{
		if( $row['tv_channel_id'] == $tid )
		{
		    $selected = 'selected="selected"';
		}
		else
		{
		    $selected = '';
		}
	
	    //$selected = ( in_array($row['movie_group_id'], $selected_item)) ? ' selected="selected"' : '';
	    $select_channel .= '<option value="' . $row['tv_channel_id'] . '" ' . $selected . '>' . $row['tv_channel_name'] . '</option>';
			
	}
	
	$db->sql_freeresult($result);
	
	$select_channel .= '</select>';
    
    return $select_channel;
}

function city_availability($city)
{
    global $config;
    
    $city = str_replace(' ', '_', $city);
    $json_string = file_get_contents($config['weather_source'] . $city); 
    $parsed_json = json_decode($json_string); 
    
    $city_short = $parsed_json->{'weather_city'};
    
    if(!empty($city_short))
    {
	return true;
    }
    
    return false;
}

function generate_template($field_name, $selected_item = '')
{
	global $db;

	$sql = "SELECT template_id, template_name FROM " . SIGNAGE_TEMPLATES_TABLE . " WHERE template_enabled = 1 ORDER BY template_name";

	$result = $db->sql_query($sql);
	
	$select_group = '<select name="' . $field_name . '"><option></option>';

	while ($row = $db->sql_fetchrow($result))
	{
	    $selected = ( $selected_item == $row['template_id'] ) ? ' selected="selected"' : '';
	    $select_group .= '<option value="' . $row['template_id'] . '" ' . $selected . '>' . $row['template_name'] . '</option>';
			
	}
	
	$db->sql_freeresult($result);
	
	$select_group .= '</select>';

	return $select_group;
}

function generate_region($field_name, $selected_item = '')
{
	global $db;

	$sql = "SELECT region_id, region_name FROM " . SIGNAGE_REGIONS_TABLE . " WHERE region_enabled = 1 ORDER BY region_name";

	$result = $db->sql_query($sql);
	
	$select_group = '<select id="' . $field_name . '" name="' . $field_name . '"><option></option>';

	while ($row = $db->sql_fetchrow($result))
	{
	    $selected = ( $selected_item == $row['region_id'] ) ? ' selected="selected"' : '';
	    $select_group .= '<option value="' . $row['region_id'] . '" ' . $selected . '>' . $row['region_name'] . '</option>';
			
	}
	
	$db->sql_freeresult($result);
	
	$select_group .= '</select>';

	return $select_group;
}

function generate_region_position($field_name, $selected_item = '')
{
	global $db;

	$select_group = '<select id="' . $field_name . '" name="' . $field_name . '"><option></option>';

	for($i=1; $i<=6; $i++)
	{
	    $selected = ( $selected_item == $i ) ? ' selected="selected"' : '';
	    $select_group .= '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
    
	}
	
	$select_group .= '</select>';

	return $select_group;
}

function generate_zone_multiple($field_name, $selected_item, $table, $field_id)
{
    global $db, $config;

    $sql = "SELECT z.zone_id, z.zone_name FROM " . ZONES_TABLE . " z WHERE z.zone_enabled = 1 ORDER BY z.zone_name";
    
	$result = $db->sql_query($sql);
	
	$select_node = '<select name="' . $field_name . '" width="25" multiple="multiple" size="10">';

	while ($row = $db->sql_fetchrow($result))
	{   
        $selected = '';
        
        $sql = "SELECT g.".$field_id." FROM " . $table . " g WHERE g.zone_id = ".$row['zone_id']."";
        
        $result_group = $db->sql_query($sql);
        
        while($row_group = $db->sql_fetchrow($result_group)) {
            
            if( $row_group[$field_id] == $selected_item )
            {   
                $selected = 'selected="selected"';
                break;
            }
            else
            {
                $selected = '';
            }
            
        }
		
	    $select_node .= '<option value="' . $row['zone_id'] . '" ' . $selected . '>' . $row['zone_name'] . '</option>';
			
	}
	
	$db->sql_freeresult($result);
	
	$select_node .= '</select>';

    return $select_node;
}

function generate_room($field_name, $selected_item, $table, $field_id)
{
    global $db, $config;

    $sql = "SELECT r.room_id, r.room_name FROM " . ROOMS_TABLE . " r WHERE r.room_enabled = 1 ORDER BY r.room_name";

	$result = $db->sql_query($sql);
	
	$select_node = '<select name="' . $field_name . '" width="25" multiple="multiple" size="10">';

	while ($row = $db->sql_fetchrow($result))
	{
        $selected = '';
    
        $sql = "SELECT g.".$field_id." FROM " . $table . " g WHERE g.room_id = ".$row['room_id']."";
        
        $result_group = $db->sql_query($sql);
        
        while($row_group = $db->sql_fetchrow($result_group)) {
            
            if( $row_group[$field_id] == $selected_item )
            {
                $selected = 'selected="selected"';
            }
        }
        
	    //$selected = ( in_array($row['movie_group_id'], $selected_item)) ? ' selected="selected"' : '';
	    $select_node .= '<option value="' . $row['room_id'] . '" ' . $selected . '>' . $row['room_name'] . '</option>';
			
	}
	
	$db->sql_freeresult($result);
	
	$select_node .= '</select>';

    return $select_node;
}

function generate_signage($field_name, $selected_item = '')
{
	global $db;

	$sql = "SELECT signage_id, signage_name FROM " . SIGNAGES_TABLE . " WHERE signage_enabled = 1 ORDER BY signage_name";

	$result = $db->sql_query($sql);
	
	$select_group = '<select id="' . $field_name . '" name="' . $field_name . '"><option></option>';

	while ($row = $db->sql_fetchrow($result))
	{
	    $selected = ( $selected_item == $row['signage_id'] ) ? ' selected="selected"' : '';
	    $select_group .= '<option value="' . $row['signage_id'] . '" ' . $selected . '>' . $row['signage_name'] . '</option>';
			
	}
	
	$db->sql_freeresult($result);
	
	$select_group .= '</select>';

	return $select_group;
}

function generate_playlist($field_name, $selected_item = '', $type_id)
{
	global $db;
    
    if(!empty($type_id)) {
        $qWhere = " AND playlist_type = '".$type_id."' ";
    } else $qWhere = "";
    
	$sql = "SELECT playlist_id, playlist_name FROM " . SIGNAGE_PLAYLIST_TABLE . " WHERE playlist_enabled = 1 ".$qWhere." ORDER BY playlist_name";

	$result = $db->sql_query($sql);
	
	$select_group = '<select id="' . $field_name . '" name="' . $field_name . '" class="playlist"><option></option>';

	while ($row = $db->sql_fetchrow($result))
	{
	    $selected = ( $selected_item == $row['playlist_id'] ) ? ' selected="selected"' : '';
	    $select_group .= '<option value="' . $row['playlist_id'] . '" ' . $selected . '>' . $row['playlist_name'] . '</option>';
			
	}
	
	$db->sql_freeresult($result);
	
	$select_group .= '</select>';

	return $select_group;
}

function generate_region_group($field_name, $selected_item = '')
{
	global $db;

	$sql = "SELECT signage_region_grouping_id, signage_region_grouping_name FROM " . SIGNAGE_REGION_GROUPINGS_TABLE . " ORDER BY signage_region_grouping_name";

	$result = $db->sql_query($sql);
	
	$select_group = '<select id="' . $field_name . '" name="' . $field_name . '"><option></option>';

	while ($row = $db->sql_fetchrow($result))
	{
	    $selected = ( $selected_item == $row['signage_region_grouping_id'] ) ? ' selected="selected"' : '';
	    $select_group .= '<option value="' . $row['signage_region_grouping_id'] . '" ' . $selected . '>' . $row['signage_region_grouping_name'] . '</option>';
			
	}
	
	$db->sql_freeresult($result);
	
	$select_group .= '</select>';

	return $select_group;
}

function generate_ads($field_name, $selected_item = '')
{
	global $db;

	$sql = "SELECT signage_ads_id, signage_ads_name FROM " . SIGNAGE_ADS_TABLE . " WHERE signage_ads_enabled = 1 ORDER BY signage_ads_name";

	$result = $db->sql_query($sql);
	
	$select_group = '<select id="' . $field_name . '" name="' . $field_name . '"><option></option>';

	while ($row = $db->sql_fetchrow($result))
	{
	    $selected = ( $selected_item == $row['signage_ads_id'] ) ? ' selected="selected"' : '';
	    $select_group .= '<option value="' . $row['signage_ads_id'] . '" ' . $selected . '>' . $row['signage_ads_name'] . '</option>';
			
	}
	
	$db->sql_freeresult($result);
	
	$select_group .= '</select>';

	return $select_group;
}

function generate_target_gate($field_name, $selected_item = '')
{
	global $db;

	$sql = "SELECT * FROM ".TARGET_GATES_TABLE." ORDER BY target_gate_name";
	$result = $db->sql_query($sql);
	
	$select_group = '<select name="' . $field_name . '"><option></option>';

	while($row = $db->sql_fetchrow($result))
	{
        $selected = ( $selected_item == $row['target_gate_name'] ) ? ' selected="selected"' : '';
	    $select_group .= '<option value="' . $row['target_gate_name'] . '" ' . $selected . '>' . $row['target_gate_name'] . '</option>';
			
	}
	
	$db->sql_freeresult($result);
	
	$select_group .= '</select>';

	return $select_group;
}

function generate_emergency_type($field_name, $selected_item = '')
{
	global $db;

	$sql = "SELECT emergency_id, emergency_code, emergency_name FROM " . EMERGENCIES_TABLE . " ORDER BY emergency_name";

	$result = $db->sql_query($sql);
	
	$select_group = '<select id="' . $field_name . '" name="' . $field_name . '"><option></option>';

	while ($row = $db->sql_fetchrow($result))
	{
	    $selected = ( $selected_item == $row['emergency_code'] ) ? ' selected="selected"' : '';
	    $select_group .= '<option value="' . $row['emergency_code'] . '" ' . $selected . '>' . $row['emergency_name'] . '</option>';
			
	}
	
	$db->sql_freeresult($result);
	
	$select_group .= '</select>';

	return $select_group;
}

function generate_direction($field_name, $selected_item = '')
{
	global $db, $config;
    
    $directions = $config['direction'];
	
    $select_group = '<select name="' . $field_name . '"><option></option>';

	foreach($directions as $code => $direction)
	{
        $selected = ( $selected_item == $code ) ? ' selected="selected"' : '';
	    $select_group .= '<option value="' . $code . '" ' . $selected . '>' . $direction . '</option>';
			
	}
    $select_group .= '</select>';

	return $select_group;
}

function view_signages(&$signage_data, &$signage_count)
{
    global $db;
    
    if ($signage_count !== false)
    {
	$sql = 'SELECT COUNT(signage_id) AS total_entries
		FROM ' . SIGNAGES_TABLE;
		
	$result = $db->sql_query($sql);
	$signage_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT s.signage_id, s.signage_name, s.signage_description, s.signage_enabled, t.template_name
	  FROM " . SIGNAGES_TABLE . " s  LEFT OUTER JOIN " . SIGNAGE_TEMPLATES_TABLE . " t ON s.template_id = t.template_id
	  ORDER BY s.signage_name";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0; $a = 0;
    $signage_data = array();
    $signage_name = '';
    
    while ($row = $db->sql_fetchrow($result))
    {
        if ( $signage_name !== $row['signage_name'] ) 
        {
            $signage_data[$i] = array(
            'id'		=> $row['signage_id'],
            'name'		=> $row['signage_name'],
            'description'	=> $row['signage_description'],
            'enabled'	=> $row['signage_enabled'],
            'template_name'	=> $row['template_name'],
            );

            $a = 1;
        }
        else
        {
            $signage_data[$i - $a]['template_name'] .= ', ' . $row['template_name'];    
            $a++;
        }
        
        $signage_name = $row['signage_name'];
        
        $sql = 'SELECT zone_name FROM ' . ZONES_TABLE . ' z 
            JOIN ' . SIGNAGE_ZONE_GROUPINGS_TABLE . " g ON z.zone_id=g.zone_id 
            WHERE g.signage_id=" . $row['signage_id'] . ' ORDER BY zone_name';
        $result_zone = $db->sql_query($sql);
        
        while ($row_zone = $db->sql_fetchrow($result_zone))
        {
            $separator = empty($signage_data[$i]['zone'])? '' : ', ';
            $signage_data[$i]['zone'] .= $separator . $row_zone['zone_name'];
        }
        
        $db->sql_freeresult($result_zone);
        
        $sql = 'SELECT room_name FROM ' . ROOMS_TABLE . ' r 
            JOIN ' . SIGNAGE_ROOM_GROUPINGS_TABLE . " g ON r.room_id=g.room_id 
            WHERE g.signage_id=" . $row['signage_id'] . ' ORDER BY room_name';
        $result_room = $db->sql_query($sql);
        
        while ($row_room = $db->sql_fetchrow($result_room))
        {
            $separator = empty($signage_data[$i]['room'])? '' : ', ';
            $signage_data[$i]['room'] .= $separator . $row_room['room_name'];
        }
        
        $db->sql_freeresult($result_room);
        
        $i++;
	
    }
    $db->sql_freeresult($result);

    //print_r($styles_data); exit;
    return;
}

function view_signage_type($field_name, $selected_item, $func='', $url='')
{
	global $config;
    
    $types = $config['signage_type'];
    
    $select_group = '<select id="' . $field_name . '" name="' . $field_name . '"><option></option>';
    
    if($func == "get_content") { 
        $select_group = '<select id="' . $field_name . '" name="' . $field_name . '" onchange="get_content(this.value, \''.$url.'\');"><option></option>';
    }
	
	foreach ($types as $key => $type)
	{
	    $selected = ( $selected_item == $key ) ? ' selected="selected"' : '';
	    $select_group .= '<option value="' . $key . '" ' . $selected . '>' . $type . '</option>';
			
	}
	
	$select_group .= '</select>';

	return $select_group;
}

function view_signage_type_source($field_name, $type_id, $selected_item)
{
    global $db;
    
    $select_node = '<select id="' . $field_name . '" name="' . $field_name . '" class="playlist">';
    
    if($type_id != '') {
        $type = get_playlist_type($type_id);
        
        $sql = "SELECT signage_".$type[1]."_id AS id, signage_".$type[1]."_name AS name, signage_".$type[1]."_file AS file FROM " . $type[0] . " WHERE signage_".$type[1]."_enabled = 1 ";
        
        $result = $db->sql_query($sql);
        
        while ($row = $db->sql_fetchrow($result)) {
            $selected = ( $selected_item == $row['file'] ) ? ' selected="selected"' : '';
            $select_node .= '<option class="'.$type[1].'" value="' . $row['id'] . '" ' . $selected . '>' . $row['name'] . '</option>';
        }
    }
    $select_node .= '</select>';
    
    return $select_node;
}

function view_signage_region(&$region_data, &$region_count)
{
    global $db, $config;
    
    if ($region_count !== false)
    {
	$sql = 'SELECT COUNT(region_id) AS total_entries
		FROM ' . SIGNAGE_REGIONS_TABLE;
		
	$result = $db->sql_query($sql);
	$region_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT region_id, region_name, region_description, region_enabled, region_type, region_position
	  FROM " . SIGNAGE_REGIONS_TABLE . " 
	  ORDER BY region_name";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0; $a = 0;
    $region_data = array();
    $region_name = '';
    
    while ($row = $db->sql_fetchrow($result))
    {   
        foreach($config['signage_type'] as $key => $val) {
            if($row['region_type'] == $key) {
                $type = $val;
                break;
            }
        }
        
        if ( $region_name !== $row['region_name'] ) 
        {
            $region_data[$i] = array(
            'id'		    => $row['region_id'],
            'name'		    => $row['region_name'],
            'description'	=> $row['region_description'],
            'enabled'	    => $row['region_enabled'],
            'region_type'	=> $type,
            'region_position'	=> $row['region_position'],
            );

            $a = 1;
        }
        
        $region_name = $row['region_name'];
        
        $i++;
	
    }
    $db->sql_freeresult($result);

    return;
}


function view_signage_playlist(&$playlist_data, &$playlist_count)
{
    global $db, $config;
    
    if ($playlist_count !== false)
    {
	$sql = 'SELECT COUNT(playlist_id) AS total_entries
		FROM ' . SIGNAGE_PLAYLIST_TABLE;
		
	$result = $db->sql_query($sql);
	$playlist_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT playlist_id, playlist_name, playlist_description, playlist_enabled, playlist_type, playlist_loop, playlist_duration
	  FROM " . SIGNAGE_PLAYLIST_TABLE . " 
	  ORDER BY playlist_name";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0; $a = 0;
    $playlist_data = array();
    $playlist_name = '';
    
    while ($row = $db->sql_fetchrow($result))
    {   
        foreach($config['signage_type'] as $key => $val) {
            if($row['playlist_type'] == $key) {
                $type = $val;
                break;
            }
        }
        
        if ( $playlist_name !== $row['playlist_name'] ) 
        {
            $playlist_data[$i] = array(
            'id'		    => $row['playlist_id'],
            'name'		    => $row['playlist_name'],
            'description'	=> $row['playlist_description'],
            'enabled'	    => $row['playlist_enabled'],
            'type'	        => $type,
            'loop'          => $row['playlist_loop'],
            'duration'      => $row['playlist_duration'],
            );

            $a = 1;
        }
        
        $playlist_name = $row['playlist_name'];
        
        $i++;
	
    }
    $db->sql_freeresult($result);

    return;
}

function generate_playlist_content_all() 
{
    global $db, $config;
    
    foreach($config['signage_type'] as $key => $val) {
        if($key < 5) {
            $type = get_playlist_type($key);
            
            $sql = "SELECT signage_".$type[1]."_id AS id, signage_".$type[1]."_name AS name, signage_".$type[1]."_file AS file FROM " . $type[0] . " WHERE signage_".$type[1]."_enabled = 1 ";
            
            //echo $sql . '<p>';
            $result = $db->sql_query($sql);
            while ($row = $db->sql_fetchrow($result)) {
                $select_node .= '<option class="'.$type[1].'" value="' . $row['id'] . '" >' . $row['name'] . '</option>';
            }
        }
    }
    
    return $select_node;
}

function generate_playlist_content($field_name, $playlist_id, $type_id)
{
    global $db, $config;
    
    $select_node = '<select id="' . $field_name . '" name="' . $field_name . '" width="25" multiple="multiple" size="10" class="playlist">';
    
    if($playlist_id == "" || $type_id == "") {
        $options = generate_playlist_content_all();
        $select_node .= $options;
        
    } else {
        //if($type_id < 5) {
	
            $type = get_playlist_type($type_id);
            
            $sql = "SELECT signage_".$type[1]."_id AS id, signage_".$type[1]."_name AS name, signage_".$type[1]."_file AS file FROM " . $type[0] . " WHERE signage_".$type[1]."_enabled = 1 ORDER BY signage_".$type[1]."_name";
            
            //echo $sql; exit;
            $result = $db->sql_query($sql);
            
            while ($row = $db->sql_fetchrow($result))
            {       
                $sql = "SELECT playlist_content_source FROM ".SIGNAGE_PLAYLIST_CONTENT_TABLE." WHERE playlist_id = ".$playlist_id."";
                $result_content = $db->sql_query($sql);
                
                $sql_count = "SELECT COUNT(*) AS total_entries FROM ".SIGNAGE_PLAYLIST_CONTENT_TABLE." WHERE playlist_id = ".$playlist_id."";
                $result_count = $db->sql_query($sql_count);
                $data_count = (int) $db->sql_fetchfield('total_entries');
                
                if($data_count > 0) {
                    while($row_content = $db->sql_fetchrow($result_content)) {
                        if($row['file'] == $row_content['playlist_content_source']) {
                            $selected = 'selected="selected"';
                            break;
                        } else {
                            $selected = '';
                        }
                    }
                    $select_node .= '<option class="'.$type[1].'" value="' . $row['id'] . '" ' . $selected . '>' . $row['name'] . '</option>';
                } else {
                    $options = generate_playlist_content_all();
                    $select_node .= $options;
                    break;
                }
            }
            //exit;
            $db->sql_freeresult($result);
            $db->sql_freeresult($result_content);
        
        //}
	}
	$select_node .= '</select>';
    
    return $select_node;
}

function generate_popup_promo($field_name, $time, $counter) 
{
	global $db, $config;

	$select_node = '<select name="' . $field_name . '_'.$counter.'"><option></option>';

	$sql = "SELECT * FROM ".POPUP_PROMOS_TABLE." WHERE popup_enabled = 1 ORDER BY popup_title";
	$result = $db->sql_query($sql);
	while($row = $db->sql_fetchrow($result)) {
		$sql2 = "SELECT popup_id FROM ".POPUP_PROMO_SCHEDULE_TABLE." WHERE popup_schedule_time = ".$time."";
		$result2 = $db->sql_query($sql2);
		$popup_id = $db->sql_fetchfield('popup_id');
			
		if($popup_id == $row['popup_id']) {
			$selected = 'selected="selected"';
		} else {
			$selected = '';
		}

		$select_node .= '<option value="'.$row['popup_id'].'" '.$selected.'>'.$row['popup_title'].'</option>';
	}
	$select_node .= '</select>';

	return $select_node;
}

function generate_popup_promo_schedule($field_name) 
{
	global $db, $config;

	$output = '';
	$j=0;
	for($i=$config['min_hour']; $i<=$config['max_hour']; $i++) {
		$time = str_pad($i, 2, "0", STR_PAD_LEFT).":00";
		$mktime = mktime($i, 0, 0, 1, 1, 2015);
		
		$sql = "SELECT popup_schedule_duration FROM ".POPUP_PROMO_SCHEDULE_TABLE." WHERE popup_schedule_time = ".$mktime."";
		$result = $db->sql_query($sql);
		$duration = $db->sql_fetchfield('popup_schedule_duration');
	
		$select_node = generate_popup_promo($field_name, $mktime, $j);
		
		$output .= '<tr>';
		$output .= '<td width="5%">'.$time.'<input type="hidden" name="time[]" value="'.$i.'" /></td>';
		$output .= '<td width="15%">'.$select_node.'</td>';
		$output .= '<td><input type="text" name="duration[]" value="'.$duration.'" size="3" /></td>';
		$output .= '</tr>';

		$j++;
	}
	
	return $output;
}

function view_region_grouping(&$signage_data, &$signage_count)
{
    global $db, $config;
    
    if ($signage_count !== false)
    {
	$sql = 'SELECT COUNT(playlist_id) AS total_entries
		FROM ' . SIGNAGE_REGION_GROUPINGS_TABLE;
		
	$result = $db->sql_query($sql);
	$signage_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT signage_region_grouping_id, signage_name, region_name, playlist_name, default_source, default_type, signage_region_grouping_name, g.playlist_id
	  FROM " . SIGNAGE_REGION_GROUPINGS_TABLE . " g LEFT JOIN ".SIGNAGES_TABLE." s ON g.signage_id = s.signage_id LEFT JOIN ".SIGNAGE_REGIONS_TABLE." r ON g.region_id = r.region_id LEFT JOIN ".SIGNAGE_PLAYLIST_TABLE." p ON g.playlist_id = p.playlist_id
	  ORDER BY signage_region_grouping_name";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0; $a = 0;
    $signage_data = array();
    $signage_name = '';
    
    while ($row = $db->sql_fetchrow($result))
    {   
        foreach($config['signage_type'] as $key => $val) {
            if($row['playlist_type'] == $key) {
                $type = $val;
                break;
            }
        }
        
        if ( $signage_name !== $row['playlist_name'] ) 
        {
            $signage_data[$i] = array(
            'id'		    => $row['signage_region_grouping_id'],
            'signage_name'		    => $row['signage_name'],
            'region_name'		    => $row['region_name'],
            'playlist_name'	=> $row['playlist_name'],
            'default_source'	    => $row['default_source'],
            'default_type'	        => $row['default_type'],
            'name'          => $row['signage_region_grouping_name'],
            'playlist_id'   => $row['playlist_id'],
            );

            $a = 1;
        }
        
        $signage_name = $row['signage_region_grouping_name'];
        
        $i++;
	
    }
    $db->sql_freeresult($result);

    return;
}

function view_content_schedule(&$signage_data, &$signage_count)
{
    global $db, $config;
    
    if ($signage_count !== false)
    {
	$sql = 'SELECT COUNT(playlist_id) AS total_entries
		FROM ' . SIGNAGE_CONTENT_SCHEDULE_TABLE;
		
	$result = $db->sql_query($sql);
	$signage_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT signage_content_schedule_id, signage_content_schedule_name, signage_content_schedule_start, signage_content_schedule_end, signage_content_schedule_enabled, signage_content_schedule_fullscreen, p.playlist_name, g.signage_region_grouping_name
	  FROM " . SIGNAGE_CONTENT_SCHEDULE_TABLE . " s LEFT JOIN ".SIGNAGE_PLAYLIST_TABLE." p ON s.playlist_id = p.playlist_id LEFT JOIN ".SIGNAGE_REGION_GROUPINGS_TABLE." g ON s.signage_region_grouping_id = g.signage_region_grouping_id 
	  ORDER BY signage_content_schedule_name";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0; $a = 0;
    $signage_data = array();
    $signage_name = '';
    
    while ($row = $db->sql_fetchrow($result))
    {   
       
        //if ( $signage_name !== $row['playlist_name'] ) 
        //{
            $signage_data[$i] = array(
            'id'		    => $row['signage_content_schedule_id'],
            'schedule_name'		    => $row['signage_content_schedule_name'],
            'start'		    => $row['signage_content_schedule_start'],
            'end'	=> $row['signage_content_schedule_end'],
            'playlist_name'	    => $row['playlist_name'],
            'region_group_name'	        => $row['signage_region_grouping_name'],
            'enabled'	        => $row['signage_content_schedule_enabled'],
            'fullscreen'        => $row['signage_content_schedule_fullscreen'],
            );

            $a = 1;
        //}
        
        //$signage_name = $row['signage_region_grouping_name'];
        
        $i++;
	
    }
    $db->sql_freeresult($result);

    return;
}

function view_templates(&$signage_data, &$signage_count)
{
    global $db;
    
    if ($signage_count !== false)
    {
	$sql = 'SELECT COUNT(template_id) AS total_entries
		FROM ' . SIGNAGE_TEMPLATES_TABLE;
		
	$result = $db->sql_query($sql);
	$signage_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT template_id, template_name, template_description, template_enabled 
      FROM " . SIGNAGE_TEMPLATES_TABLE . "
	  ORDER BY template_name";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0; $a = 0;
    $signage_data = array();
    $signage_name = '';
    
    while ($row = $db->sql_fetchrow($result))
    {   
        if ( $signage_name !== $row['template_name'] ) 
        {
            $signage_data[$i] = array(
            'id'		=> $row['template_id'],
            'name'		=> $row['template_name'],
            'description'	=> $row['template_description'],
            'enabled'	=> $row['template_enabled'],
            );

            $a = 1;
        }
       
        $signage_name = $row['template_name'];
        
        $i++;
	
    }
    $db->sql_freeresult($result);

    return;
}

function view_ads(&$ads_data, &$ads_count)
{
    global $db;
    
    if ($ads_count !== false)
    {
	$sql = 'SELECT COUNT(signage_ads_id) AS total_entries
		FROM ' . SIGNAGE_ADS_TABLE;
		
	$result = $db->sql_query($sql);
	$ads_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT signage_ads_id, signage_ads_name, signage_ads_cp, signage_ads_phone, signage_ads_email, signage_ads_enabled 
      FROM " . SIGNAGE_ADS_TABLE . "
	  ORDER BY signage_ads_name";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0; $a = 0;
    $ads_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {   
       
        $ads_data[$i] = array(
            'id'		=> $row['signage_ads_id'],
            'name'		=> $row['signage_ads_name'],
            'contact_person'    => $row['signage_ads_cp'],
            'phone'    => $row['signage_ads_phone'],
            'email'    => $row['signage_ads_email'],
            'enabled'	=> $row['signage_ads_enabled'],
        );

        $i++;
	
    }
    $db->sql_freeresult($result);

    return;
}

function view_contents(&$signage_data, &$signage_count, $type_name)
{
    global $db, $config;
    
    $type_arr = array_keys($config['signage_type'], ucfirst($type_name));
    $type_id = $type_arr[0];
    $type = get_playlist_type($type_id);
    
    if ($signage_count !== false)
    {
	$sql = 'SELECT COUNT(signage_'.$type[1].'_id) AS total_entries
		FROM ' . $type[0];
		
	$result = $db->sql_query($sql);
	$signage_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT signage_".$type[1]."_id, signage_".$type[1]."_name, signage_".$type[1]."_file, signage_ads_name, signage_".$type[1]."_enabled 
      FROM " . $type[0] . " s LEFT JOIN ".SIGNAGE_ADS_TABLE." a ON s.signage_ads_id = a.signage_ads_id
	  ORDER BY signage_".$type[1]."_name";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0; 
    $signage_data = array();
    $signage_name = '';
    
    while ($row = $db->sql_fetchrow($result))
    {   
        $signage_data[$i] = array(
        'id'		=> $row['signage_'.$type[1].'_id'],
        'name'		=> $row['signage_'.$type[1].'_name'],
        'file'	    => $row['signage_'.$type[1].'_file'],
        'ads'       => $row['signage_ads_name'],
        'enabled'	=> $row['signage_'.$type[1].'_enabled'],
        );

        $i++;
	
    }
    $db->sql_freeresult($result);

    return;
}

function view_emergency(&$signage_data, &$signage_count)
{
    global $db;
    
    if ($signage_count !== false)
    {
        $sql = 'SELECT COUNT(emergency_id) AS total_entries
            FROM ' . EMERGENCIES_TABLE;
            
        $result = $db->sql_query($sql);
        $signage_count = (int) $db->sql_fetchfield('total_entries');
        $db->sql_freeresult($result);
    }
    
    $sql = "SELECT emergency_id, emergency_code, emergency_name
      FROM ".EMERGENCIES_TABLE."
      ORDER BY emergency_id";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $signage_data = array();
    $signage_name = '';
    
    while ($row = $db->sql_fetchrow($result))
    {          
        $signage_data[$i] = array(
            'id'		            => $row['emergency_id'],
            'emergency_code'		=> $row['emergency_code'],
            'emergency_name'	    => $row['emergency_name'],
        );
        
        $i++;
    }
    $db->sql_freeresult($result);   

    return;
}

function view_target_direction(&$signage_data)
{
    global $db, $config;
    
    $sql = "SELECT node_target_gate_grouping_id, target_gate_name, n.node_name, direction
      FROM " . NODE_TARGET_GATE_GROUPINGS_TABLE . " g JOIN nodes n ON g.node_id = n.node_id";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);
    
    $i = 0;
    $signage_data = array();
    $signage_name = '';
    
    while ($row = $db->sql_fetchrow($result))
    {
        foreach($config['direction'] as $key => $value) {
            if($row['direction'] == $key) {
                $direction = $value;
                break;
            }
        }
        
        $signage_data[$i] = array(
            'id'		            => $row['node_target_gate_grouping_id'],
            'target_gate_name'		=> $row['target_gate_name'],
            'direction'		        => $direction,
        );
        $separator = empty($signage_data[$i]['node'])? '' : ', ';
        $signage_data[$i]['node'] .= $separator . $row['node_name'];
        
        $i++;
    }
    
    $db->sql_freeresult($result);
    
    return;
}

function view_gates(&$signage_data, &$signage_count)
{
    global $db;
    
    if ($signage_count !== false)
    {
	$sql = 'SELECT COUNT(target_gate_id) AS total_entries
		FROM ' . TARGET_GATES_TABLE;
		
	$result = $db->sql_query($sql);
	$signage_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT target_gate_id, target_gate_name, target_gate_description, target_gate_enabled 
      FROM " . TARGET_GATES_TABLE . "
	  ORDER BY target_gate_name";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0; $a = 0;
    $signage_data = array();
    $signage_name = '';
    
    while ($row = $db->sql_fetchrow($result))
    {   
        if ( $signage_name !== $row['target_gate_name'] ) 
        {
            $signage_data[$i] = array(
            'id'		=> $row['target_gate_id'],
            'name'		=> $row['target_gate_name'],
            'description'	=> $row['target_gate_description'],
            'enabled'	=> $row['target_gate_enabled'],
            );

            $a = 1;
        }
       
        $signage_name = $row['target_gate_name'];
        
        $i++;
	
    }
    $db->sql_freeresult($result);

    return;
}

function view_urgency(&$signage_data)
{
    global $db;
    
    $sql = "SELECT signage_urgency_id, signage_urgency_duration, signage_urgency_enabled, emergency_name
      FROM " . SIGNAGE_URGENCIES_TABLE . " u LEFT JOIN ".EMERGENCIES_TABLE." e ON u.emergency_code = e.emergency_code
      WHERE signage_urgency_flag = 'emergency'
      ORDER BY signage_urgency_id";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $signage_data = array();
    $signage_name = '';
    
    while ($row = $db->sql_fetchrow($result))
    {          
        $signage_data[$i] = array(
            'id'		                    => $row['signage_urgency_id'],
            'signage_urgency_enabled'		=> $row['signage_urgency_enabled'],
            'signage_urgency_duration'	    => $row['signage_urgency_duration'],
            'emergency_name'		        => $row['emergency_name'],
        );
        
        $sql = 'SELECT zone_name FROM ' . ZONES_TABLE . ' z 
            JOIN ' . SIGNAGE_URGENCY_ZONE_GROUPINGS_TABLE . " g ON z.zone_id=g.zone_id 
            WHERE g.signage_urgency_id=" . $row['signage_urgency_id'] . ' ORDER BY zone_name';
        $result_zone = $db->sql_query($sql);
        
        while ($row_zone = $db->sql_fetchrow($result_zone))
        {
            $separator = empty($signage_data[$i]['zone'])? '' : ', ';
            $signage_data[$i]['zone'] .= $separator . $row_zone['zone_name'];
        }
        
        $db->sql_freeresult($result_zone);
        
        $sql = 'SELECT r.room_id, room_name FROM ' . ROOMS_TABLE . ' r 
            JOIN ' . SIGNAGE_URGENCY_ROOM_GROUPINGS_TABLE . " g ON r.room_id=g.room_id 
            WHERE g.signage_urgency_id=" . $row['signage_urgency_id'] . ' ORDER BY room_name';
        
        $result_room = $db->sql_query($sql);
        
        while ($row_room = $db->sql_fetchrow($result_room))
        {
            $separator = empty($signage_data[$i]['room'])? '' : ', ';
            $signage_data[$i]['room'] .= $separator . $row_room['room_name'];
            
            $sql = "SELECT n.node_name, t.target_gate_name FROM ".NODE_TARGET_GATE_GROUPINGS_TABLE." t RIGHT JOIN ".NODES_TABLE." n ON t.node_id = n.node_id WHERE n.room_id = ".$row_room['room_id']."";
            
            $result_node = $db->sql_query($sql);
            
            while ($row_node = $db->sql_fetchrow($result_node))
            {
                $separator = empty($signage_data[$i]['node'])? '' : ', <br/>';
                $signage_data[$i]['node'] .= $separator . $row_node['node_name'] . ' (Target gate: ' . $row_node['target_gate_name'].')';
            }
        }
        
        $db->sql_freeresult($result_room);

        $i++;
	
    }
    $db->sql_freeresult($result);   

    return;
}

function view_general(&$signage_data, &$signage_count)
{
    global $db;
    
    if ($signage_count !== false)
    {
	$sql = 'SELECT COUNT(signage_general_id) AS total_entries
		FROM ' . SIGNAGE_GENERALS_TABLE;
		
	$result = $db->sql_query($sql);
	$signage_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT signage_general_id, signage_general_title, signage_general_date, signage_general_remark, signage_general_enabled 
      FROM " . SIGNAGE_GENERALS_TABLE . "
	  ORDER BY signage_general_date";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0; $a = 0;
    $signage_data = array();
    $signage_name = '';
    
    while ($row = $db->sql_fetchrow($result))
    {   
        if ( $signage_name !== $row['signage_general_title'] ) 
        {
            $signage_data[$i] = array(
				'id'			=> $row['signage_general_id'],
				'title'			=> $row['signage_general_title'],
				'date'			=> $row['signage_general_date'],
				'description'	=> $row['signage_general_remark'],
				'enabled'		=> $row['signage_general_enabled'],
            );

            $a = 1;
        }
       
        $signage_name = $row['signage_general_title'];
        
        $i++;
	
    }
    $db->sql_freeresult($result);

    return;
}

function view_signage_skin(&$styles_data, &$styles_count)
{
    global $db;
    
    if ($styles_count !== false)
    {
	$sql = 'SELECT COUNT(template_id) AS total_entries
		FROM ' . SIGNAGE_TEMPLATES_TABLE;
		
	$result = $db->sql_query($sql);
	$styles_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT * FROM " . SIGNAGE_TEMPLATES_TABLE . "
	    ORDER BY template_name";
		
    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $styles_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$styles_data[$i] = array(
	    'id'		=> $row['template_id'],
	    'name'		=> $row['template_name'],
	    'desc'		=> $row['template_description'],
	    'active'	=> $row['template_enabled'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    //print_r($styles_data); exit;
    return;
}

function view_hotspot(&$hotspots_data, &$hotspot_count)
{
    global $db;
    
    if ($hotspot_count !== false)
    {
	$sql = 'SELECT COUNT(hotspot_id) AS total_entries
		FROM ' . HOTSPOTS_TABLE;
		
	$result = $db->sql_query($sql);
	$hotspot_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT h.hotspot_id, h.room_name, h.hotspot_password, h.hotspot_rule 	  
	  FROM " . HOTSPOTS_TABLE . " h
	  ORDER BY h.room_name";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0; $a = 0;
    $hotspots_data = array();
    $room_name = '';
    
    while ($row = $db->sql_fetchrow($result))
    {
	if ( $room_name !== $row['room_name'] ) 
	{
		if(!empty($room_name)) $i++;
		
	    $hotspots_data[$i] = array(
		'id'		=> $row['hotspot_id'],
		'room'		=> $row['room_name'],
	    );
		
		$hotspots_data[$i]['password'][$row['hotspot_rule']] = $row['hotspot_password'];
		
		/*if($row['hotspot_rule'] == 1) {
			$hotspots_data[$i]['password'][1] = $row['hotspot_password'];
		} else if($row['hotspot_rule'] == 2) {
			$hotspots_data[$i]['password'][2] = $row['hotspot_password'];
		} else if($row['hotspot_rule'] == 3) {
			$hotspots_data[$i]['password'][3] = $row['hotspot_password'];
		} else if($row['hotspot_rule'] == 4) {
			$hotspots_data[$i]['password'][4] = $row['hotspot_password'];
		}*/
		
	    $a = 1;
		//$i++;
	}
	else
	{
	    $hotspots_data[$i]['password'][$row['hotspot_rule']] = $row['hotspot_password'];
	    
	    
	}
	
	$room_name = $row['room_name'];
	
	//$i++;
	
    }
    $db->sql_freeresult($result);

    //print_r($hotspots_data); exit;
    return;
}


function get_playlist_type($type_id) {
    global $config;
    
    switch($type_id) {
        case 1  : $table = SIGNAGE_IMAGE_TABLE; $prefix = "image"; break;
        case 2  : $table = SIGNAGE_TEXT_TABLE; $prefix = "text"; break;
        case 3  : $table = SIGNAGE_CLIP_TABLE; $prefix = "clip"; break;
        case 4  : $table = SIGNAGE_RSS_TABLE; $prefix = "rss"; break;
        default : $table = ''; $prefix = ""; break;
    }
    
    $output = array($table, $prefix);
    
    return $output;
}

function generate_currency($field_name, $selected_item = '')
{
	global $db, $config;
    
    $currencies = $config['currency'];
	
    $select_group = '<select name="' . $field_name . '"><option></option>';

	foreach($currencies as $code => $currency)
	{
        $selected = ( $selected_item == $code ) ? ' selected="selected"' : '';
	    $select_group .= '<option value="' . $code . '" ' . $selected . '>' . $currency . '</option>';
			
	}
    $select_group .= '</select>';

	return $select_group;
}





/**
* View music Group
*
*/
function view_music_groups(&$groups_data, &$groups_count)
{
    global $db, $config;
    
    if ($groups_count !== false)
    {
	$sql = 'SELECT COUNT(music_group_id) AS total_entries
		FROM ' . MUSIC_GROUPS_TABLE;
		
	$result = $db->sql_query($sql);
	$groups_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT p.music_group_id, p.music_group_description , p.music_group_enabled, t.translation_title   
	FROM " . MUSIC_GROUPS_TABLE . " p, " . MUSIC_GROUP_TRANSLATIONS_TABLE . " t 
	WHERE p.music_group_id=t.music_group_id AND t.language_id= '" . $config['default_language'] . "' 
	ORDER BY t.translation_title";

    // echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $groups_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$groups_data[$i] = array(
	    'id'		=> $row['music_group_id'],
	    'name'		=> $row['translation_title'],
	    'desc'		=> $row['music_group_description'],
	    'enabled'		=> $row['music_group_enabled'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    return;
}





/**
* Grab music
*
*/
function grab_music(&$music_data, &$music_count)
{
    global $db, $config;
    // echo 'fgdfgdg' . $sql; exit;
    if ($music_count !== false)
    {
	$sql = 'SELECT COUNT(music_id) AS total_entries
		FROM ' . MUSIC_TABLE;
		
	$result = $db->sql_query($sql);
	$music_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
	// echo '<p>' . $result; exit;
    }
    
    $sql = "SELECT c.music_id, c.music_code, t.translation_title AS music_title, t.translation_description AS music_description, c.music_price, c.music_casts, c.music_director, c.music_thumbnail, c.music_url, c.music_trailer, c.music_enabled, c.music_allow_ads, tg.translation_title AS group_title 
	FROM " . MUSIC_TABLE . " c 
	JOIN " . MUSIC_TRANSLATIONS_TABLE . " t ON t.music_id = c.music_id 
	RIGHT OUTER JOIN " . MUSIC_GROUPINGS_TABLE . " gp ON c.music_id = gp.music_id 
	RIGHT OUTER JOIN " . MUSIC_GROUPS_TABLE . " g ON gp.music_group_id = g.music_group_id 
	RIGHT OUTER JOIN " . MUSIC_GROUP_TRANSLATIONS_TABLE . " tg ON tg.music_group_id = g.music_group_id 
	WHERE t.language_id= '" . $config['default_language'] . "' 
	AND tg.language_id= '" . $config['default_language'] . "' 
	ORDER BY t.translation_title";

    // echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $temp_id = '';
    $i = 0;
    $ref = 1;
    $music_data = array();
    $data = array();
    // echo '<p>' . $result; exit;
    while ($row = $db->sql_fetchrow($result))
    {
	if( $row['music_id'] == $temp_id)
	{
	    $a = $i - $ref;
	    $music_data[$a]['group'] = $music_data[$a]['group'] . '<br/>' . $row['group_title'];  
	    //$music_data[$a]['group'] = $music_data[$a]['group'] . '<br/>' . $row['group_title'];  
	    
	    $ref++;
	}
	else
	{
	    $music_data[$i] = array(
	    'id'		=> $row['music_id'],
	    'title'		=> $row['music_title'],
	    'description'	=> $row['music_description'],
	    'group'		=> $row['group_title'],
	    'price'		=> $row['music_price'],
	    'casts'		=> $row['music_casts'],
	    'enabled'		=> $row['music_enabled'],
	    'allow_ads'		=> $row['music_allow_ads'],
	    'url'		=> $row['music_url'],
	    'trailer'		=> $row['music_trailer'],
	    'thumbnail'		=> $row['music_thumbnail'],
	    'director'		=> $row['music_director'],
	    'code'		=> $row['music_code'],
	    );
	    
	    $ref = 1;
	
	}
    
	$temp_id = $row['music_id'];

	$i++; 
    }
    $db->sql_freeresult($result);
    
    // print_r($music_data); exit;
    return;  
    
}



/**
* Generate music Genre
*
* Param		$selected_item		array 
*/

function generate_music_genre($field_name, $selected_item, $group_data)
{
    global $db, $config;

    $sql = "SELECT g.music_group_id, t.translation_title, gp.music_id FROM " . MUSIC_GROUPS_TABLE . " g 
	JOIN " . MUSIC_GROUP_TRANSLATIONS_TABLE . " t ON g.music_group_id=t.music_group_id 
	LEFT JOIN " . MUSIC_GROUPINGS_TABLE . " gp ON g.music_group_id=gp.music_group_id 
	WHERE g.music_group_enabled = 1 
	AND t.language_id = '" . $config['default_language'] . "' ORDER BY t.translation_title";
	//echo $sql . '<p>' . $selected_item; exit;
	$result = $db->sql_query($sql);
	
	$select_group = '<select name="' . $field_name . '" width="25" multiple="multiple" size="10">';

	while ($row = $db->sql_fetchrow($result))
	{
	    if( $row['music_id'] == $selected_item )
	    {
		$selected = 'selected="selected"';
		//echo $row['translation_title'] . '-' ;
	    }
	    else
	    {
		$selected = '';
	    }
	    
	    if( $row['translation_title'] !== $old_item )
	    {
		//$selected = ( in_array($row['music_group_id'], $selected_item)) ? ' selected="selected"' : '';
		$select_group .= '<option value="' . $row['music_group_id'] . '" ' . $selected . '>' . $row['translation_title'] . '</option>';
		
		$old_item = $row['translation_title'];
	    }
	}
	
	$db->sql_freeresult($result);
	
	$select_group .= '</select>';

    
    
    return $select_group;
}


/**
* Grab music background
*
*/
function grab_backgroundmusic(&$music_data, &$music_count)
{
    global $db, $config;
    // echo 'fgdfgdg' . $sql; exit;
    if ($music_count !== false)
    {
	$sql = 'SELECT COUNT(background_music_id) AS total_entries
		FROM ' . BACKGROUND_MUSIC_TABLE;
		
	$result = $db->sql_query($sql);
	$music_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
	// echo '<p>' . $result; exit;
    }
    $sql ="SELECT  b.background_music_id, b.node_id, a.background_music_title, a.background_music_enabled from " . BACKGROUND_MUSIC_TABLE . " a JOIN " . BACKGROUND_MUSIC_GROUPINGS_TABLE . " b ON a.background_music_id = b.background_music_id group by b.background_music_id, b.node_id, a.background_music_title, a.background_music_enabled";
    
    
    // echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);
    // echo '<p>' . $result; exit;
    // $temp_id = '';
    $i = 0;
    $ref = 1;
    $music_data = array();
    $data = array();
    // echo '<p>' . $result; exit;
    while ($row = $db->sql_fetchrow($result))
    {
	    $music_data[$i] = array(
	    'id'		=> $row['background_music_id'],
	    'node'		=> $row['node_id'],
	    'title'	=> $row['background_music_title'],
	    'enabled'		=> $row['background_music_enabled'],
	    );
	    
	    $ref = 1;
	

    
	// $temp_id = $row['music_id'];

	$i++; 
    }
    $db->sql_freeresult($result);
    
    // print_r($music_data); exit;
    return;  
    
}


/**
* Grab Tv
*
*/
function grab_valas(&$valas_data, &$valas_count)
{
    global $db, $config;
    
    if ($valas_count !== false)
    {
	$sql = 'SELECT COUNT(valas_id) AS total_entries
		FROM ' . VALAS_TABLE;
		
	$result = $db->sql_query($sql);
	$valas_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }

    $sql = "SELECT valas_id,valas_nama, valas_jual, valas_beli 
	FROM " . VALAS_TABLE . " 
	ORDER BY valas_id";

    // echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $temp_id = '';
    $i = 0;
    $ref = 1;
    $valas_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	
	    $valas_data[$i] = array(
	    'id'		=> $row['valas_id'],
	    'name'		=> $row['valas_nama'],
	    'jual'		=> $row['valas_jual'],
	    'beli'		=> $row['valas_beli'],

	    );
	    
	
    
	// $temp_id = $row['tv_channel_id'];

	$i++; 
    }
    $db->sql_freeresult($result);
    
    // print_r($valas_data); exit;
    return;
}


/**
* Grab Information
*
*/
function grab_info(&$info_data, &$info_count)
{
    global $db, $config;
    
    if ($info_count !== false)
    {
	$sql = 'SELECT COUNT(info_id) AS total_entries
		FROM ' . INFORMATION_TABLE;
		
	$result = $db->sql_query($sql);
	$info_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }

    $sql = "SELECT info_id,info_nama, info_nomor 
	FROM " . INFORMATION_TABLE . " 
	ORDER BY info_id";

    // echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $temp_id = '';
    $i = 0;
    $ref = 1;
    $info_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	
	    $info_data[$i] = array(
	    'id'		=> $row['info_id'],
	    'name'		=> $row['info_nama'],
	    'nomor'		=> $row['info_nomor'],

	    );
	    
	
    
	// $temp_id = $row['tv_channel_id'];

	$i++; 
    }
    $db->sql_freeresult($result);
    
    // print_r($info_data); exit;
    return;
}

/**
* Generate Node for Device
*
* Param		$selected_item		array 
*/

function generate_node_combo($field_name, $rid,$action)
{
    global $db, $config;
    if($action === 'add')
    {
    	$sql = "SELECT node_id, node_name FROM " . NODES_TABLE . " WHERE node_id not in (select node_id from device) and node_enabled = 1 ORDER BY node_name";
    }elseif ($action === 'update') {
    	$sql = "SELECT node_id, node_name FROM " . NODES_TABLE . " WHERE (node_id not in (select node_id from device) OR node_id = $rid ) AND node_enabled = 1 ORDER BY node_name";
    }

    
    // echo '<p>' . $sql; exit;
	$result = $db->sql_query($sql);
	
	$select_room = '<select name="' . $field_name . '" >';
	while ($row = $db->sql_fetchrow($result))
	{
		if( $row['node_id'] == $rid )
		{
		    $selected = 'selected="selected"';
		}
		else
		{
		    $selected = '';
		}
	
	    //$selected = ( in_array($row['movie_group_id'], $selected_item)) ? ' selected="selected"' : '';
	    $select_room .= '<option value="' . $row['node_id'] . '" ' . $selected . '>' . $row['node_name'] . '</option>';
			
	}
	
	$db->sql_freeresult($result);
	
	$select_room .= '</select>';
    
    return $select_room;
}

/**
* View DEVICE
* 
*/
function view_device(&$device_data, &$device_count)
{
    global $db;
    
    if ($device_count !== false)
    {
	$sql = 'SELECT COUNT(device_id) AS total_entries
		FROM ' . DEVICE_TABLE;
		
	$result = $db->sql_query($sql);
	$device_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }

    $sql ="SELECT  a.device_id, a.device_name, a.device_smartid, a.node_id, a.enabled,a.device_status ,b.node_name from " . DEVICE_TABLE . " a JOIN " . NODES_TABLE . " b ON a.node_id = b.node_id group by  a.device_id, a.device_name, a.device_smartid, a.node_id, a.enabled,a.device_status ,b.node_name";
    
		
    // echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $device_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$device_data[$i] = array(
	    'id'		=> $row['device_id'],
	    'name'		=> $row['device_name'],
	    'smartid'		=> $row['device_smartid'],
	    'node'		=> $row['node_name'],
	    'status'		=> $row['device_status'],
	    'enabled'		=> $row['enabled'],
	);

	$i++;
    }
    $db->sql_freeresult($result);
    // print_r($device_data); exit;
    return;
}


/**
* View Flight Status
*
*/
function view_flight_status(&$flight_status_data, &$flight_status_count)
{
    global $db, $config;
    
    if ($flight_status_count !== false)
    {
	$sql = 'SELECT COUNT(airport_flight_status_id) AS total_entries
		FROM ' . AIRPORT_FLIGHT_STATUS_TABLE;
		
	$result = $db->sql_query($sql);
	$flight_status_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT * FROM " . AIRPORT_FLIGHT_STATUS_TABLE . " ORDER BY airport_flight_status_id";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0;
    $flight_status_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$flight_status_data[$i] = array(
	    'id'	=> $row['airport_flight_status_id'],
	    'remark'	=> $row['airport_flight_status_remark'],
	    'display_on_tv'	=> $row['airport_flight_status_display_on_tv'],
	    'display_mode'	=> $row['airport_flight_status_display_mode'],
	    'priority'	=> $row['airport_flight_status_priority'],
	    'enabled'	=> $row['airport_flight_status_enabled'],
	);

	$i++;
    }
    $db->sql_freeresult($result);

    return;
}

/**
* Generate Display Mode for FIDS
*
*/
function generate_displaymode_combo($field_name, $rid)
{
    global $db, $config;

    $mode = array('none' => 'None', 'popup' => 'Popup', 'fullscreen' => 'Fullscreen', 'runningtext' => 'Runningtext');
	
	$select_room = '<select name="' . $field_name . '" id="' . $field_name . '" >';
	$select_room .= '<option value="" ' . $selected . '></option>';
	foreach($mode as $key => $val)
	{
		if( $key == $rid )
		{
		    $selected = 'selected="selected"';
		}
		else
		{
		    $selected = '';
		}
	
	    //$selected = ( in_array($row['movie_group_id'], $selected_item)) ? ' selected="selected"' : '';
	    $select_room .= '<option value="' . $key . '" ' . $selected . '>' . $val . '</option>';
			
	}
	
	$db->sql_freeresult($result);
	
	$select_room .= '</select>';
    
    return $select_room;
}	

/**
* Generate Time Period for FIDS
*
*/
function generate_displayperiod_combo($field_name, $rid)
{
    global $db, $config;

    $mode = array('time' => 'Based on Time', 'status' => 'Based on Status Changed');
	
	$select_room = '<select name="' . $field_name . '" id="' . $field_name . '" >';
	$select_room .= '<option value="" ' . $selected . '></option>';
	foreach($mode as $key => $val)
	{
		if( $key == $rid )
		{
		    $selected = 'selected="selected"';
		}
		else
		{
		    $selected = '';
		}
	
	    //$selected = ( in_array($row['movie_group_id'], $selected_item)) ? ' selected="selected"' : '';
	    $select_room .= '<option value="' . $key . '" ' . $selected . '>' . $val . '</option>';
			
	}
	
	$db->sql_freeresult($result);
	
	$select_room .= '</select>';
    
    return $select_room;
}	

    
/**
* Generate Node for Room
*
* Param		$selected_item		array 
*/

function background_node($field_name, $rid)
{
    global $db, $config;

    $sql = "SELECT a.node_id, a.node_name, b.background_music_id  FROM " . NODES_TABLE . " a LEFT JOIN ". BACKGROUND_MUSIC_GROUPINGS_TABLE . " b on a.node_id= b.node_id  WHERE a.room_id = $rid" . 
	   " OR a.room_id = 0 ORDER BY a.node_name";

	$result = $db->sql_query($sql);
	
	$select_node = '<select name="' . $field_name . '" width="25" multiple="multiple" size="10">';
// echo $sql;exit();
	while ($row = $db->sql_fetchrow($result))
	{
		if( $row['background_music_id'] == $rid )
		{
		    $selected = 'selected="selected"';
		}
		else
		{
		    $selected = '';
		}
	
	    //$selected = ( in_array($row['movie_group_id'], $selected_item)) ? ' selected="selected"' : '';
	    $select_node .= '<option value="' . $row['node_id'] . '" ' . $selected . '>' . $row['node_name'] . '</option>';
			
	}
	
	$db->sql_freeresult($result);
	
	$select_node .= '</select>';

    
    
    return $select_node;
}

function view_ads_popup(&$ads_data, &$ads_count)
{
    global $db;
    
    if ($ads_count !== false)
    {
	$sql = 'SELECT COUNT(ads_popup_id) AS total_entries
		FROM ' . ADS_POPUPS_TABLE;
		
	$result = $db->sql_query($sql);
	$ads_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT ads_popup_id, ads_popup_name, ads_popup_description, ads_popup_image, ads_popup_enabled
      FROM " . ADS_POPUPS_TABLE . "
	  ORDER BY ads_popup_name";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0; $a = 0;
    $ads_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {   
       
        $ads_data[$i] = array(
            'id'			=> $row['ads_popup_id'],
            'name'			=> $row['ads_popup_name'],
            'description'   => $row['ads_popup_description'],
            'image'    		=> $row['ads_popup_image'],
            'enabled'		=> $row['ads_popup_enabled'],
        );

        $i++;
	
    }
    $db->sql_freeresult($result);

    return;
}

function view_ads_banner(&$ads_data, &$ads_count)
{
    global $db;
    
    if ($ads_count !== false)
    {
	$sql = 'SELECT COUNT(ads_banner_id) AS total_entries
		FROM ' . ADS_BANNERS_TABLE;
		
	$result = $db->sql_query($sql);
	$ads_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT ads_banner_id, ads_banner_name, ads_banner_description, ads_banner_image, ads_banner_enabled
      FROM " . ADS_BANNERS_TABLE . "
	  ORDER BY ads_banner_name";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0; $a = 0;
    $ads_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {   
       
        $ads_data[$i] = array(
            'id'			=> $row['ads_banner_id'],
            'name'			=> $row['ads_banner_name'],
            'description'   => $row['ads_banner_description'],
            'image'    		=> $row['ads_banner_image'],
            'enabled'		=> $row['ads_banner_enabled'],
        );

        $i++;
	
    }
    $db->sql_freeresult($result);

    return;
}

function view_ads_banner_schedule(&$ads_data, &$ads_count)
{
    global $db;
    
    if ($ads_count !== false)
    {
	$sql = 'SELECT COUNT(ads_banner_id) AS total_entries
		FROM ' . ADS_BANNER_SCHEDULES_TABLE;
		
	$result = $db->sql_query($sql);
	$ads_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT ads_banner_schedule_id, ads_banner_name, ads_banner_image, ads_banner_schedule_start, ads_banner_schedule_end, ads_banner_schedule_duration, ads_banner_schedule_enabled, ads_banner_schedule_order
      FROM " . ADS_BANNER_SCHEDULES_TABLE . " s JOIN " . ADS_BANNERS_TABLE . " b ON s.ads_banner_id = b.ads_banner_id
	  ORDER BY ads_banner_name";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0; $a = 0;
    $ads_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    { 
		$zone_name = '';
		$sql_zone = "SELECT zone_name FROM " . ADS_BANNER_ZONE_GROUPINGS_TABLE . " g JOIN " . ZONES_TABLE . " z ON g.zone_id = z.zone_id WHERE ads_banner_schedule_id = ".$row['ads_banner_schedule_id'];
		$result_zone = $db->sql_query($sql_zone);
		while($row_zone = $db->sql_fetchrow($result_zone)) {
			if(!empty($zone_name)) $zone_name .= ', ';
			$zone_name .= $row_zone['zone_name'];
		}
		
		$db->sql_freeresult($result_zone);
       
        $ads_data[$i] = array(
            'id'			=> $row['ads_banner_schedule_id'],
            'name'			=> $row['ads_banner_name'],
            'image'   		=> $row['ads_banner_image'],
            'start'    		=> $row['ads_banner_schedule_start'],
            'end'    		=> $row['ads_banner_schedule_end'],
            'duration'    	=> $row['ads_banner_schedule_duration'],
            'order'    		=> $row['ads_banner_schedule_order'],
            'enabled'		=> $row['ads_banner_schedule_enabled'],
            'zone'			=> $zone_name,
        );

        $i++;
	
    }
    $db->sql_freeresult($result);

    return;
}

function view_ads_home(&$ads_data, &$ads_count)
{
    global $db;
    
    if ($ads_count !== false)
    {
	$sql = 'SELECT COUNT(ads_home_id) AS total_entries
		FROM ' . ADS_HOME_TABLE;
		
	$result = $db->sql_query($sql);
	$ads_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT ads_home_id, ads_home_name, ads_home_description, ads_home_image, ads_home_enabled
      FROM " . ADS_HOME_TABLE . "
	  ORDER BY ads_home_name";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0; $a = 0;
    $ads_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {   
       
        $ads_data[$i] = array(
            'id'			=> $row['ads_home_id'],
            'name'			=> $row['ads_home_name'],
            'description'   => $row['ads_home_description'],
            'image'    		=> $row['ads_home_image'],
            'enabled'		=> $row['ads_home_enabled'],
        );

        $i++;
	
    }
    $db->sql_freeresult($result);

    return;
}

function view_ads_home_schedule(&$ads_data, &$ads_count)
{
    global $db;
    
    if ($ads_count !== false)
    {
	$sql = 'SELECT COUNT(ads_home_id) AS total_entries
		FROM ' . ADS_HOME_SCHEDULES_TABLE;
		
	$result = $db->sql_query($sql);
	$ads_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }
    
    $sql = "SELECT ads_home_schedule_id, ads_home_name, ads_home_image, ads_home_schedule_start, ads_home_schedule_end, ads_home_schedule_duration, ads_home_schedule_enabled, ads_home_schedule_order
      FROM " . ADS_HOME_SCHEDULES_TABLE . " s JOIN " . ADS_HOME_TABLE . " b ON s.ads_home_id = b.ads_home_id
	  ORDER BY ads_home_name";

    //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);

    $i = 0; $a = 0;
    $ads_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    { 
		$zone_name = '';
		$sql_zone = "SELECT zone_name FROM " . ADS_HOME_ZONE_GROUPINGS_TABLE . " g JOIN " . ZONES_TABLE . " z ON g.zone_id = z.zone_id WHERE ads_home_schedule_id = ".$row['ads_home_schedule_id'];
		$result_zone = $db->sql_query($sql_zone);
		while($row_zone = $db->sql_fetchrow($result_zone)) {
			if(!empty($zone_name)) $zone_name .= ', ';
			$zone_name .= $row_zone['zone_name'];
		}
		
		$db->sql_freeresult($result_zone);
       
        $ads_data[$i] = array(
            'id'			=> $row['ads_home_schedule_id'],
            'name'			=> $row['ads_home_name'],
            'image'   		=> $row['ads_home_image'],
            'start'    		=> $row['ads_home_schedule_start'],
            'end'    		=> $row['ads_home_schedule_end'],
            'duration'    	=> $row['ads_home_schedule_duration'],
            'order'    		=> $row['ads_home_schedule_order'],
            'enabled'		=> $row['ads_home_schedule_enabled'],
            'zone'			=> $zone_name,
        );

        $i++;
	
    }
    $db->sql_freeresult($result);

    return;
}

function generate_ads_zone($field_name, $selected_item)
{
    global $db, $config;

    //print_r($selected_item); exit;
    $sql = "SELECT ads_popup_id, ads_popup_name FROM " . ADS_POPUPS_TABLE . " WHERE ads_popup_enabled = 1";
    //echo $sql; exit;

    $result = $db->sql_query($sql);
	
	$select_zone = '<select name="' . $field_name . '"  class="form-control"><option></option>';

	while ($row = $db->sql_fetchrow($result))
	{
		if( $row['ads_popup_id'] === $selected_item )
		{
		    $selected = 'selected="selected"';
		    //echo $row['zone_name'] . '-';
		    //$tes = 'SELECT-';
		}
		else
		{
		    $selected = '';
		}
	    //echo 'master-' . $tes;
	    
	    if ( $row['ads_popup_name'] !== $old_item )
	    {
		//$selected = ( in_array($row['room_id'], $selected_item)) ? ' selected="selected"' : '';
		$select_zone .= '<option value="' . $row['ads_popup_id'] . '" ' . $selected . '>' . $row['ads_popup_name'] . '</option>';
		
		$old_item = $row['ads_popup_name'];
	    }

	}
	
	$db->sql_freeresult($result);
	
	$select_zone .= '</select>';

      return $select_zone;

}

function generate_popup_zone($field_name, $selected_item)
{
    global $db, $config;

    //print_r($selected_item); exit;
    $sql = "SELECT zone_id, zone_name FROM " . ZONES_TABLE . " WHERE zone_enabled =1 ORDER BY zone_name";

    $result = $db->sql_query($sql);
	
	$select_group = '<select name="' . $field_name . '" width="25" multiple="multiple" size="10">';

	while ($row = $db->sql_fetchrow($result))
	{
		if( !empty($selected_item) && in_array($row['zone_id'], $selected_item) )
		{
		    $selected = 'selected="selected"';
		    //echo $row['room_name'] . '-';
		    //$tes = 'SELECT-';
		}
		else
		{
		    $selected = '';
		}
	    //echo 'master-' . $tes;
	    
	    if ( $row['zone_name'] !== $old_item )
	    {
		//$selected = ( in_array($row['room_id'], $selected_item)) ? ' selected="selected"' : '';
		$select_group .= '<option value="' . $row['zone_id'] . '" ' . $selected . '>' . $row['zone_name'] . '</option>';
		
		$old_item = $row['zone_name'];
	    }

	    
	}
	
	$db->sql_freeresult($result);
	
	$select_group .= '</select>';

      return $select_group;

}

function generate_popup_channel($field_name, $selected_item)
{
    global $db, $config;

    //print_r($selected_item); exit;
    $sql = "SELECT tv_channel_id, tv_channel_name FROM " . TV_CHANNELS_TABLE . " WHERE tv_channel_enabled = 1 ORDER BY tv_channel_name";

    $result = $db->sql_query($sql);
	
	$select_group = '<select name="' . $field_name . '" width="25" multiple="multiple" size="10">';

	while ($row = $db->sql_fetchrow($result))
	{
		if( !empty($selected_item) && in_array($row['tv_channel_id'], $selected_item) )
		{
		    $selected = 'selected="selected"';
		    //echo $row['room_name'] . '-';
		    //$tes = 'SELECT-';
		}
		else
		{
		    $selected = '';
		}
	    //echo 'master-' . $tes;
	    
	    if ( $row['tv_channel_name'] !== $old_item )
	    {
		//$selected = ( in_array($row['room_id'], $selected_item)) ? ' selected="selected"' : '';
		$select_group .= '<option value="' . $row['tv_channel_id'] . '" ' . $selected . '>' . $row['tv_channel_name'] . '</option>';
		
		$old_item = $row['tv_channel_name'];
	    }

	    
	}
	
	$db->sql_freeresult($result);
	
	$select_group .= '</select>';

      return $select_group;

}


function view_popup(&$data_popup, &$popup_count, $param)
{
    global $db, $config;

    if ($popup_count !== false)
    {
		$sql = 'SELECT COUNT(ads_popup_id) AS total_entries
		FROM ' . ADS_POPUP_SCHEDULES_TABLE . " GROUP BY ads_popup_id";
		
		$result = $db->sql_query($sql);
		$popup_count = (int) $db->sql_fetchfield('total_entries');
		$db->sql_freeresult($result);
    }
    
    $sql = "SELECT * FROM " . ADS_POPUP_SCHEDULES_TABLE . " WHERE ads_popup_param = '$param' ORDER BY ads_popup_schedule_start";
	//echo '<p>' . $sql; 
	$result = $db->sql_query($sql);
	
	$i = 0;
	$data_popup = array();

	while ($row = $db->sql_fetchrow($result))
	{
		$sql_schedule = "SELECT * FROM " . ADS_POPUPS_TABLE . " WHERE ads_popup_id = ".$row['ads_popup_id']." ";
	    //echo $sql_schedule; 
		$result_schedule = $db->sql_query($sql_schedule);
		$row_schedule = $db->sql_fetchrow($result_schedule);
	    $popup_id = $row_schedule['ads_popup_id'];
	    $popup_name = $row_schedule['ads_popup_name'];
	    $popup_image = $row_schedule['ads_popup_image'];
	    
	    $db->sql_freeresult($result_schedule);

	    $data_popup[$i] = array(
		'id'			=> $row['ads_popup_schedule_id'],
		'name'			=> $popup_name,
		'image'			=> $popup_image,
		'date_start'	=> date("d M Y", $row['ads_popup_schedule_start']),
		'date_end'		=> date("d M Y", $row['ads_popup_schedule_end']),
		'duration'		=> $row['ads_popup_schedule_duration'],
		//'id_schedule'			=> $row['ads_popup_schedule_id'],
		//'id_popup'			=> $schedule_popup_id,
		'time_start'		=> date("H:i", $row['ads_popup_schedule_start']),
	    );

	    $i++;
	}

	$db->sql_freeresult($result);

	//print_r($data_popup); echo ': <p>crottt'; exit;
	return;

}

function generate_banner_zone_grouping($field_name, $selected_item)
{
    global $db, $config;

    //print_r($selected_item); exit;
    $sql = "SELECT zone_id, zone_name FROM " . ZONES_TABLE . " WHERE zone_enabled =1 ";

    $result = $db->sql_query($sql);
	
	$select_group = '<select name="' . $field_name . '" width="25" multiple="multiple" size="10">';

	while ($row = $db->sql_fetchrow($result))
	{
		$sql2 = "SELECT COUNT(*) AS total_data FROM " . ADS_BANNER_ZONE_GROUPINGS_TABLE . " WHERE ads_banner_schedule_id = ".$selected_item." AND zone_id = ".$row['zone_id'];
		$result2 = $db->sql_query($sql2);
		$total_data = $db->sql_fetchfield('total_data');
		
		$db->sql_freeresult($result2);
		
		if( $total_data > 0 )
		{
		    $selected = 'selected="selected"';
		    
		}
		else
		{
		    $selected = '';
		}
	    
	    if ( $row['zone_name'] !== $old_item )
	    {
		//$selected = ( in_array($row['room_id'], $selected_item)) ? ' selected="selected"' : '';
		$select_group .= '<option value="' . $row['zone_id'] . '" ' . $selected . '>' . $row['zone_name'] . '</option>';
		
		$old_item = $row['zone_name'];
	    }

	}
	
	$db->sql_freeresult($result);
	
	$select_group .= '</select>';

    return $select_group;

}

function generate_home_zone_grouping($field_name, $selected_item)
{
    global $db, $config;

    //print_r($selected_item); exit;
    $sql = "SELECT zone_id, zone_name FROM " . ZONES_TABLE . " WHERE zone_enabled =1 ";

    $result = $db->sql_query($sql);
	
	$select_group = '<select name="' . $field_name . '" width="25" multiple="multiple" size="10">';

	while ($row = $db->sql_fetchrow($result))
	{
		$sql2 = "SELECT COUNT(*) AS total_data FROM " . ADS_HOME_ZONE_GROUPINGS_TABLE . " WHERE ads_home_schedule_id = ".$selected_item." AND zone_id = ".$row['zone_id'];
		$result2 = $db->sql_query($sql2);
		$total_data = $db->sql_fetchfield('total_data');
		
		$db->sql_freeresult($result2);
		
		if( $total_data > 0 )
		{
		    $selected = 'selected="selected"';
		    
		}
		else
		{
		    $selected = '';
		}
	    
	    if ( $row['zone_name'] !== $old_item )
	    {
		//$selected = ( in_array($row['room_id'], $selected_item)) ? ' selected="selected"' : '';
		$select_group .= '<option value="' . $row['zone_id'] . '" ' . $selected . '>' . $row['zone_name'] . '</option>';
		
		$old_item = $row['zone_name'];
	    }

	}
	
	$db->sql_freeresult($result);
	
	$select_group .= '</select>';

    return $select_group;

}

function view_time(&$time_data, &$time_count)
{
    global $db, $config;
    
    if ($time_count !== false)
    {
	$sql = 'SELECT COUNT(*) AS total_entries
		FROM ' . ADS_SLOTS_TABLE;
		
	$result = $db->sql_query($sql);
	$time_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
    }

    $sql = "SELECT * FROM " . ADS_SLOTS_TABLE . " ORDER BY ads_slot_time ASC";
		
     //echo '<p>' . $sql; exit;
    $result = $db->sql_query($sql);
    // echo $result;die();
    $i = 0;
    $time_data = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	$time_data[$i] = array(
	    'isi'		=> $row['ads_slot_time'],
	    
	);

	$i++;
    }
    $db->sql_freeresult($result);
    return;
}

function view_ads_logsexport(&$log, &$log_count, $type, $mode='')
{
    global $db, $config;
	
	if ($log_count !== false)
	{
		$sql = "SELECT COUNT(ads_log_id) AS total_entries
			FROM " . ADS_LOGS_TABLE . "
			WHERE ads_log_type = '".$type."'";
		
		if (!empty($keywords))
		{
		    //echo $sql; exit;
		}
			
		$result = $db->sql_query($sql);
		$log_count = (int) $db->sql_fetchfield('total_entries');
		$db->sql_freeresult($result);
	}
	
	switch($type) {
		case 'banner'	: $table = ADS_BANNERS_TABLE; break;
		case 'popup'	: $table = ADS_POPUPS_TABLE; break;
		case 'home'		: $table = ADS_HOME_TABLE; break;
	}
	
	if($mode == "subs") {
		$sql = "SELECT n.room_id, room_name, ads_".$type."_id, COUNT(ads_log_id) AS count_log
			FROM " . ADS_LOGS_TABLE . " l 
			LEFT JOIN " . NODES_TABLE . " n ON l.node_id = n.node_id
			LEFT JOIN " . ROOMS_TABLE . " r ON n.room_id = r.room_id
			WHERE room_enabled = 1 AND ads_".$type."_id IS NOT NULL
			GROUP BY n.room_id ,room_name, ads_".$type."_id
			ORDER BY room_name";
			//echo '<p>' . $sql; exit;
		$result = $db->sql_query($sql);
		$i = 0;
		$log = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$sql = "SELECT ads_".$type."_name AS name FROM ".$table." WHERE ads_".$type."_id = ".$row['ads_'.$type.'_id']."";
			$result2 = $db->sql_query($sql);
			$name = $db->sql_fetchfield('name');
			
			$log[$i] = array(
				'subscriber_name'	=> $row['room_name'],
				'name'			=> $name,
				'count_log'		=> $row['count_log'],
			);

			$i++;
		}
	} else {
		$sql = "SELECT l.ads_".$type."_id, b.ads_".$type."_name, COUNT(ads_log_id) AS count_log
			FROM " . ADS_LOGS_TABLE . " l
			LEFT JOIN " . $table . " b ON l.ads_".$type."_id = b.ads_".$type."_id
			WHERE ads_log_type = '".$type."'
			GROUP BY l.ads_".$type."_id, b.ads_".$type."_name	
			ORDER BY b.ads_".$type."_name ASC";
	
			//echo '<p>' . $sql; exit;
		$result = $db->sql_query($sql);

		$i = 0;
		$log = array();
		while ($row = $db->sql_fetchrow($result))
		{
			
			$log[$i] = array(
				'name'			=> $row['ads_'.$type.'_name'],
				'count_log'		=> $row['count_log'],
			);

			$i++;
		}
	}
	$db->sql_freeresult($result);

	//print_r($session); echo ': <p>crottt'; exit;
	return $offset;

}

function grab_popup_zone($popup_schedule_id) {
	global $db, $config;
	
	$sql = "SELECT zone_name FROM " . ADS_ZONE_GROUPINGS_TABLE . " g JOIN " . ZONES_TABLE . " z ON g.zone_id = z.zone_id WHERE ads_popup_schedule_id = " . $popup_schedule_id;
	$result = $db->sql_query($sql);
	$zone = array();
	while($row = $db->sql_fetchrow($result)) {
		$zone[] = $row['zone_name'];
	}
	
	$popup_zone_data = implode(", ", $zone);
	
	return $popup_zone_data;
}

function grab_popup_channel($popup_schedule_id) {
	global $db, $config;
	
	$sql = "SELECT tv_channel_name FROM " . ADS_CHANNEL_GROUPINGS_TABLE . " g JOIN " . TV_CHANNELS_TABLE . " c ON g.tv_channel_id = c.tv_channel_id WHERE ads_popup_schedule_id = " . $popup_schedule_id;
	$result = $db->sql_query($sql);
	$channel = array();
	while($row = $db->sql_fetchrow($result)) {
		$channel[] = $row['tv_channel_name'];
	}
	
	$popup_channel_data = implode(", ", $channel);
	
	return $popup_channel_data;
}

function generate_ads_banner($field_name, $selected_item)
{
    global $db, $config;

    $sql = "SELECT ads_banner_id, ads_banner_name FROM " . ADS_BANNERS_TABLE . " ";
    $result = $db->sql_query($sql);
	
	$select_ads = '<select name="' . $field_name . '"  class="form-control"><option></option>';

	while ($row = $db->sql_fetchrow($result))
	{
		if( $row['ads_banner_id'] === $selected_item )
		{
		    $selected = 'selected="selected"';
		}
		else
		{
		    $selected = '';
		}
	    
	    if ( $row['ads_banner_name'] !== $old_item )
	    {
		//$selected = ( in_array($row['room_id'], $selected_item)) ? ' selected="selected"' : '';
		$select_ads .= '<option value="' . $row['ads_banner_id'] . '" ' . $selected . '>' . $row['ads_banner_name'] . '</option>';
		
		$old_item = $row['ads_banner_name'];
	    }

	}
	
	$db->sql_freeresult($result);
	
	$select_ads .= '</select>';

      return $select_ads;

}

function generate_ads_home($field_name, $selected_item)
{
    global $db, $config;

    $sql = "SELECT ads_home_id, ads_home_name FROM " . ADS_HOME_TABLE . " ";
    $result = $db->sql_query($sql);
	
	$select_ads = '<select name="' . $field_name . '"  class="form-control"><option></option>';

	while ($row = $db->sql_fetchrow($result))
	{
		if( $row['ads_home_id'] === $selected_item )
		{
		    $selected = 'selected="selected"';
		}
		else
		{
		    $selected = '';
		}
	    
	    if ( $row['ads_home_name'] !== $old_item )
	    {
		//$selected = ( in_array($row['room_id'], $selected_item)) ? ' selected="selected"' : '';
		$select_ads .= '<option value="' . $row['ads_home_id'] . '" ' . $selected . '>' . $row['ads_home_name'] . '</option>';
		
		$old_item = $row['ads_home_name'];
	    }

	}
	
	$db->sql_freeresult($result);
	
	$select_ads .= '</select>';

      return $select_ads;

}

function view_ads_logs(&$log, &$log_count, $type, $mode='')
{
    global $db, $config;
	
	$start_date = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
	$end_date = mktime(23, 59, 59, date("m"), date("d"), date("Y"));
	
	if ($log_count !== false)
	{
		$sql = "SELECT COUNT(ads_log_id) AS total_entries
			FROM " . ADS_LOGS_TABLE . "
			WHERE ads_log_type = '".$type."'";
		
		if (!empty($keywords))
		{
		    //echo $sql; exit;
		}
			
		$result = $db->sql_query($sql);
		$log_count = (int) $db->sql_fetchfield('total_entries');
		$db->sql_freeresult($result);
	}
	
	switch($type) {
		case 'banner'	: $table = ADS_BANNERS_TABLE; break;
		case 'popup'	: $table = ADS_POPUPS_TABLE; break;
		case 'home'		: $table = ADS_HOME_TABLE; break;
	}
	
	if($mode == "subs") {
		$sql = "SELECT n.room_id, room_name, ads_".$type."_id, COUNT(ads_log_id) AS count_log
			FROM " . ADS_LOGS_TABLE . " l 
			LEFT JOIN " . NODES_TABLE . " n ON l.node_id = n.node_id
			LEFT JOIN " . ROOMS_TABLE . " r ON n.room_id = r.room_id
			WHERE room_enabled = 1 AND ads_".$type."_id IS NOT NULL AND ads_log_timestamp BETWEEN  ".$start_date."  AND ".$end_date."
			GROUP BY n.room_id ,room_name, ads_".$type."_id
			ORDER BY room_name";
			//echo '<p>' . $sql; exit;
		$result = $db->sql_query($sql);
		$i = 0;
		$log = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$sql = "SELECT ads_".$type."_name AS name FROM ".$table." WHERE ads_".$type."_id = ".$row['ads_'.$type.'_id']."";
			$result2 = $db->sql_query($sql);
			$name = $db->sql_fetchfield('name');
			
			$log[$i] = array(
				'subscriber_name'	=> $row['room_name'],
				'name'			=> $name,
				'count_log'		=> $row['count_log'],
			);

			$i++;
		}
	} else {
		$sql = "SELECT l.ads_".$type."_id, b.ads_".$type."_name, COUNT(ads_log_id) AS count_log
			FROM " . ADS_LOGS_TABLE . " l
			LEFT JOIN " . $table . " b ON l.ads_".$type."_id = b.ads_".$type."_id
			WHERE ads_log_type = '".$type."' AND ads_log_timestamp BETWEEN  ".$start_date."  AND ".$end_date."
			GROUP BY l.ads_".$type."_id, b.ads_".$type."_name	
			ORDER BY b.ads_".$type."_name ASC";
	
			//echo '<p>' . $sql; exit;
		$result = $db->sql_query($sql);

		$i = 0;
		$log = array();
		while ($row = $db->sql_fetchrow($result))
		{
			
			$log[$i] = array(
				'name'			=> $row['ads_'.$type.'_name'],
				'count_log'		=> $row['count_log'],
			);

			$i++;
		}
	}
	$db->sql_freeresult($result);

	//print_r($session); echo ': <p>crottt'; exit;
	return $offset;

}


?>
