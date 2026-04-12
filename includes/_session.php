<?php
/**
*
* includes/session.php
*
* Roberto Tonjaw. Dec 2013
*/

/**
*/

if (!defined('IN_TONJAW'))
{
	die('Hacking Attempt');
}

/**
* Session class
*/
class session
{
    var $browser = '';
    var $forwarded_for = '';
    var $username = '';
    var $usergroup = '';
    var $userid = 0;
    //var $user_priv = '';
    var $data = array();
    var $host = '';
    var $session_id = '';
    var $ip = '';
    var $mac = '';
    var $module = '';
    var $load = 0;
    var $time_now = 0;
    var $need_login = true;
    var $mac_exist = 0;


    /**
    * Start session management
    *
    * This is where all session activity begins. We gather various pieces of
    * information from the client and server. We test to see if a session already
    * exists. If it does, fine and dandy. If it doesn't we'll go on to create a
    * new one ... pretty logical heh? 
    */
    function session_begin($file, $need_login = true)
    {
	global $phpEx, $db, $config, $tonjaw_root_path, $adm_lang;

	
	// Give us some basic information
	$this->time_now			= time();
	$this->update_session_page	= $update_session_page;
	$this->browser			= ($_SERVER['HTTP_USER_AGENT']) ? htmlspecialchars((string) $_SERVER['HTTP_USER_AGENT']) : '';
	 
	 // if no session id is set, redirect to login_box
	 if (defined('NEED_SID') && (!isset($_GET['sid'])) && (!isset($_POST['sid'])) && !defined('IN_FRONTEND'))
	 {
	    login_box('', '', '', true);
	 }

	 
	//Get user's IP
	$this->ip = trim($_SERVER['REMOTE_ADDR']);
	///$this->ip = ($_SERVER['REMOTE_ADDR']) ? (string) $_SERVER['REMOTE_ADDR'] : '';
	//$this->ip = preg_replace('# {2,}#', ' ', str_replace(',', ' ', $this->ip));

	// split the list of IPs
	//$ips = explode(' ', trim($this->ip));

	// Default IP if REMOTE_ADDR is invalid
	//$this->ip = '127.0.0.1';
 // REMOTE MAC ADDRESS IS BYPASSED
 /*
	foreach ($ips as $ip)
	{
	    if (preg_match(get_preg_expression('ipv4'), $ip))
	    {
		$this->ip = $ip;
	    }
	    else if (preg_match(get_preg_expression('ipv6'), $ip))
	    {
		// Quick check for IPv4-mapped address in IPv6
		if (stripos($ip, '::ffff:') === 0)
		{
		    $ipv4 = substr($ip, 7);

		    if (preg_match(get_preg_expression('ipv4'), $ipv4))
		    {
			$ip = $ipv4;
		    }
		}

		$this->ip = $ip;
	    }
	    else
	    {
		// We want to use the last valid address in the chain
		// Leave foreach loop when address is invalid
		break;
	    }
	}

	*/
	
	//echo '<span style="background: #fff">' . $this->ip . '<br/>ips: ' . $_SERVER['REMOTE_ADDR'] . '</span>'; exit;
	$this->mac = get_mac($this->ip);
	$this->get_module($file);
	//echo '<span style="background: #fff">' . $this->ip . ': shit<br/>mac: ' . $this->mac . '</span>'; exit; 
	
	if(defined('IN_FRONTEND'))
	{
	    $this->session_id = md5($this->time_now);
	    
	    // Looking up client mac address
	    $sql = 'SELECT node_id, node_name 
		FROM ' . NODES_TABLE . " 
		WHERE node_mac = '" . $db->sql_escape($this->mac) . "'";
		
	    $result = $db->sql_query($sql);
	    $this->data = $db->sql_fetchrow($result);
	    $db->sql_freeresult($result);
	    
	    if(isset($this->data['node_id']))
	    {
		// MANIPULATE NODE SESSION
		// Check node session in Sessions Table
		$node_id = $this->data['node_id'];
		$this->username = $this->data['node_name'];
		$sql = 'SELECT session_id, session_start 
		    FROM ' . SESSIONS_TABLE . " 
		    WHERE session_node_id = '" . $db->sql_escape($this->data['node_id']) . "'";
		
		$result = $db->sql_query($sql);
		$this->data = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
		
		// Update the session
		$sql_ary = array(
		    'session_id'		=> (string) $this->session_id,
		    'session_start'		=> (int) $this->time_now,
		    'session_time'		=> (int) $this->time_now,
		    'session_browser'		=> (string) trim(substr($this->browser, 0, 149)),
		    'session_ip'		=> (string) $this->ip,
		    'session_mac'		=> (string) $this->mac,
		    'session_module'		=> (string) $this->module,
		    'session_node_id'		=> (int) $node_id,
		    'session_username'		=> (string) $this->username,
		    );
		    
		if(isset($this->data['session_id']))
		{
		    $sql = 'UPDATE ' . SESSIONS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . "
			WHERE session_node_id = '" . $db->sql_escape($node_id) . "'";
		}
		else
		{
		    $sql = 'INSERT INTO ' . SESSIONS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
		}
		    
		$db->sql_query($sql);
		
		$this->mac_exist = 1;
		
		return true;
	    }
	    else
	    {
		//Authenticate's handled by fe_common.php ()
		return true;
	    }

	}
	
	
	//echo $this->module . ': crot'; exit;
	$this->session_id = isset($_GET['sid']) ? $_GET['sid'] :  $_POST['sid'];
	
	$sql = 'SELECT session_id, session_time, session_username, session_user_id  
		FROM ' . SESSIONS_TABLE . " 
		WHERE session_id = '" . $db->sql_escape($this->session_id) . "'";
	$result = $db->sql_query($sql);
	$this->data = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	
	$this->username = $this->data['session_username'];
	$this->userid = $this->data['session_user_id'];
	
	if (!empty($_GET['mode']) && $_GET['mode'] === 'logout')
	{
	    //add_log($adm_lang['logout']);
	    //echo 'ready to destroy, mbah'; exit;
	    return $this->session_kill();
	
	}

	//echo 'mod: ' . $this->module ; exit;
	// Did the session exist in the DB?
	if (isset($this->data['session_id']) && $this->time_now - $this->data['session_time'] < $config['session_length'] )
	{
	    // Update the session
	    $sql_ary = array(
		'session_start'		=> (int) $this->time_now,
		'session_time'		=> (int) $this->time_now,
		'session_browser'	=> (string) trim(substr($this->browser, 0, 149)),
		'session_ip'		=> (string) $this->ip,
		'session_mac'		=> (string) $this->mac,
		'session_module'	=> (string) $this->module,
		);

	    $sql = 'UPDATE ' . SESSIONS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . "
		WHERE session_id = '" . $db->sql_escape($this->session_id) . "'";
			
	    $db->sql_query($sql);
    
	    //$user = $this->data;
	    //add_log($adm_lang['read']);
	    //print_r($user);
	    return true;
	}
	 
	// Authenticate Login input
	if ( !empty($this->session_id) && empty($_GET['sid']))
	{
	    $sql = 'SELECT u.user_id, u.user_name, u.user_fullname, g.user_group_name
		    FROM ' . USERS_TABLE . ' u, ' . USER_GROUPS . " g
		    WHERE u.user_password = '" . $db->sql_escape(md5($_POST['pwd'])) . "'
		    AND u.user_name = '" . $db->sql_escape($_POST['log']) . "' 
		    AND u.user_enabled = 1";
	
	    $result = $db->sql_query($sql);
	    $this->data = $db->sql_fetchrow($result);
	    $db->sql_freeresult($result);
	
	    //echo $sql; exit;
	    if (!empty($this->data['user_id']))
	    {
		//echo 'Auth success ' . $this->data['user_name']; exit;
		$this->session_id = md5($this->time_now);
		$this->username = $this->data['user_name'];
		
		//add_log($adm_lang['login']);
		
		return $this->session_create();
	    
	    }
	    else
	    {
		// Auth fail
		return login_box('', $adm_lang['Error_login'], false, $_POST['log']);
	
	    }

	}
	// Ilegal SID 
	return login_box('', $adm_lang['Error_sid'], false);
    }
    
    /**
    * Create a new session
    *
    * If upon trying to start a session we discover there is nothing existing we
    * jump here. Additionally this method is called directly during login to regenerate
    * the session for the specific user. 
    */
    function session_create()
    {
	global $db, $phpEx, $config;

	// Delete the old session n create a new one
	$sql = 'DELETE FROM ' . SESSIONS_TABLE . "
		WHERE session_user_id = " . (int) $this->data['user_id'];
	$db->sql_query($sql);

	// Create a session
	$sql_ary = array(
	    'session_id'		=> $this->session_id,
	    'session_user_id'		=> (int) $this->data['user_id'],
	    'session_start'		=> (int) $this->time_now,
	    'session_time'		=> (int) $this->time_now,
	    'session_browser'		=> (string) trim(substr($this->browser, 0, 149)),
	    'session_ip'		=> (string) $this->ip,
	    'session_mac'		=> (string) $this->mac,
	    'session_module'		=> (string) $this->module,
	    'session_username'		=> $this->data['user_fullname'] . ', '. $this->data['user_name'],
	    );

	$sql = 'INSERT INTO ' . SESSIONS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	$db->sql_query($sql);

	$db->sql_return_on_error(false);
	
	$this->userid = $this->data['user_id'];

	redirect($config['admin_path'] . 'index.' . $phpEx, $this->session_id);

	return true;

    }
  
    /**
    * Kills a session
    *
    * This method does what it says on the tin. It will delete a pre-existing session.
    */
    function session_kill()
    {
	global $db, $config, $phpEx;

	$sql = 'DELETE FROM ' . SESSIONS_TABLE . "
		WHERE session_id = '" . $db->sql_escape($this->session_id) . "'
		AND session_user_id = " . (int) $this->data['user_id'];
	$db->sql_query($sql);
	
	$sql = 'UPDATE ' . USERS_TABLE . '
		SET user_lastvisit = ' . (int) $this->data['session_time'] . '
		WHERE user_id = ' . (int) $this->data['user_id'];
	$db->sql_query($sql);

	redirect($config['admin_path'] . 'index.' . $phpEx);
	
	return true;
	
	
    }
  
    /**
    * Get Module request. 
    *
    * @param str 		$file	Filename without extension
    */
    function get_module($file)
    {
	global $db;

	$mod = array();
	
	if(defined('IN_FRONTEND'))
	{
	    $sql = "SELECT module_name AS module_detail_name 
	    FROM " . MODULES_TABLE . "
	    WHERE module_file = '" . $db->sql_escape($file) . "'
	    AND module_enabled = 1";
	
	}
	else
	{
	    $sql = "SELECT module_detail_name 
		FROM " . MODULES_DETAIL_TABLE . "
		WHERE module_detail_file = '" . $db->sql_escape($file) . "'
		AND module_detail_enabled = 1";
	}
	
	$result = $db->sql_query($sql);
	$mod = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	

	//echo $mod['module_detail_name'] . ': crotttt<p>'; 
	if (!isset($mod['module_detail_name']) && !defined('IN_FRONTEND'))
	{
	    die('You specified a wrong filename...');
	    
	}
	else
	{
	    // Auth fail
	    $this->module = $mod['module_detail_name'];
	
	}

	return;
    }
  
}



/**
* Base user class
*
* This is the overarching class which contains (through session extend)
* all methods utilised for user functionality during a session.
*
*/
class user extends session
{





}





?>