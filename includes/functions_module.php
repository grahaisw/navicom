<?php
/**
*
* includes/functions_module.php
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
* Class handling all types of 'modules' (a future term)
* 
*/
class p_master
{
    var $p_id;
    var $p_name;
    var $p_mode;

    var $user_priviledge = '';
    var $include_path = false;
    var $active_module = false;
    var $active_cat = false;
    var $active_module_name = false;
    var $active_module_desc = false;
    var $module_ary = array();
    var $module_detail_ary = array();
    
    /**
    * Constuctor
    * Set module include path
    */
    function p_master($include_path = false)
    {
	global $tonjaw_root_path, $config;

	$this->include_path = ($include_path !== false) ? $include_path : $tonjaw_root_path . $config['include_path'];

	// Make sure the path ends with /
	if (substr($this->include_path, -1) !== '/')
	    {
		$this->include_path .= '/';
	    }
    }

    /**
    * Set custom include path for modules
    * Schema for inclusion is include_path . modulebase
    *
    * @param string $include_path include path to be used.
    * @access public
    */
    function set_custom_include_path($include_path)
    {
	$this->include_path = $include_path;

	// Make sure the path ends with /
	if (substr($this->include_path, -1) !== '/')
	{
	    $this->include_path .= '/';
	}
    }

    /**
    * List modules
    *
    * This creates a list, stored in $this->module_ary of all available
    * modules for the given class. Additionally $this->module_y_ary 
    * is created with indentation information for displaying 
    * the module list appropriately. Only modules for which
    * the user has access rights are included in these lists.
    */
    function list_modules($file, $id = false, $in_admin = 1)
    {
	global $db, $adm_lang, $session;
    
	// Get modules
	
	$sql = 'SELECT m.module_id, m.module_name, m.module_file, p.permission_value 
		FROM ' . MODULES_TABLE . ' m, ' . PERMISSIONS_TABLE . " p 
		WHERE m.module_in_admin = '" . $db->sql_escape($in_admin) . "'
		AND m.module_enabled = 1 
		AND m.module_id = p.permission_module_id
		AND p.permission_user_id = " . $db->sql_escape($session->userid) . "
		ORDER BY module_order, module_name ASC";
	//echo $sql; exit;
	/*
	$sql = 'SELECT module_id, module_name, module_file, permission_value 
		FROM ' . PRIVILEDGES_VIEW . "  
		WHERE module_in_admin = '" . $db->sql_escape($in_admin) . "'
		AND module_enabled = 1 
		AND user_id = " . $db->sql_escape($session->userid) . "  
		ORDER BY module_order, module_name ASC";
	*/	

	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
	    $this->module_ary[$row['module_id']] = $row;
	}
	$db->sql_freeresult($result);
    
	//print_r($rows); echo '<p>'; echo $rows[5]['module_name'] . ' ' . $rows[5]['permission_value']; exit;
	if (!count($this->module_ary))
	{
	    die($adm_lang['Error_no_module']);
	}
	
	// Set_active module
	$detail = array();
	$sql =  'SELECT module_id, module_detail_id, module_detail_name, c.module_detail_cat_name 
		FROM ' . MODULES_DETAIL_TABLE . ' d, ' . MODULES_DETAIL_CAT_TABLE . " c 
		WHERE d.module_detail_file = '" . $db->sql_escape($file) . "'
		AND d.module_detail_enabled = 1 
		AND d.module_detail_cat_id = c.module_detail_cat_id";
	//echo $sql; exit;
	$result = $db->sql_query($sql);
	$detail = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	if (isset($detail))
	{
	    //echo '<b>Bullseye</b>'; 
	    $this->p_id			= $detail['module_id'];
	    $this->active_module	= $detail['module_detail_id'];
	}
	else
	{
	    die($adm_lang['Error_no_module']);
	}
	/*
	// Set active module
	foreach ($this->module_ary as $row_id => $item_ary)
	{
	    //print_r($item_ary); echo '<br>';

	    // If this is a module and it's selected, active
	    // If this is a category and the module is the first within it, active
	    // If this is a module and no mode selected, select first mode
	    // If no category or module selected, go active for first module in first category
	    if ($item_ary['module_file'] === $file || $item_ary['module_id'] === $id)
	    {
		//echo '<p><b>bullseye</b></p>';
		$this->p_id			= $item_ary['module_id'];
		$this->active_module		= $item_ary['module_id'];

		break;
	    }
	    
	}
	*/
	//echo 'MODULE LIST<p>';
	//print_r($this->module_ary); exit;
	//return $rows;
    }
    
    /**
    * List detail modules
    *
    */
    function list_modules_detail($file, $id = false)
    {
	global $db, $adm_lang, $session;
    
	// Get modules
	/*
	$sql = 'SELECT m.module_detail_id, m.module_detail_name, m.module_detail_desc, m.module_detail_file, 			c.module_detail_cat_name 
		FROM ' . MODULES_DETAIL_TABLE . ' m, ' . MODULES_DETAIL_CAT_TABLE . " c 
		WHERE m.module_id = '" . $db->sql_escape($this->p_id) . "'
		AND m.module_detail_enabled = 1 
		AND m.module_detail_cat_id = c.module_detail_cat_id  
		ORDER BY c.module_detail_cat_id, m.module_detail_name ASC";
	*/
	$sql = 'SELECT module_detail_id, module_detail_name, module_detail_desc, module_detail_file, 					module_detail_cat_name, permission_value 
		FROM ' . PRIVILEDGES_VIEW . "  
		WHERE module_id = '" . $db->sql_escape($this->p_id) . "'
		AND module_detail_enabled = 1 
		AND user_id = " . $db->sql_escape($session->userid) . "  
		ORDER BY module_detail_cat_id, module_detail_name ASC";
		
		//echo $sql; exit;
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
	    $read = (string) $row['permission_value'];
	    
	    //echo 'read: ' . $read . '<br/>';
	    if( $read[0] )
	    {
		$this->module_detail_ary[$row['module_detail_id']] = $row;
	    }
	    //$this->module_detail_ary[$row['module_detail_id']] = $row;
	}
	$db->sql_freeresult($result);// Set active module
	
	foreach ($this->module_detail_ary as $row_id => $cat_ary)
	{
	    //print_r($item_ary); echo '<br>';
	    //echo $cat_ary['module_detail_name'] . ' ' . $cat_ary['module_detail_cat_name'] . '</br>';

	    // If this is a module and it's selected, active
	    // If this is a category and the module is the first within it, active
	    // If this is a module and no mode selected, select first mode
	    // If no category or module selected, go active for first module in first category
	    if ($cat_ary['module_detail_file'] === $file)
	    {
		//echo 'brororororo';
		$this->active_cat	= $cat_ary['module_detail_id'];
		$this->active_module_name = $cat_ary['module_detail_name'];
		$this->active_module_desc = $cat_ary['module_detail_desc'];
		$this->user_priviledge = (string) $cat_ary['permission_value'];
		
		break;
	    }
	   
	    
	}
	//echo 'file:' . $file . '</br>active cat: ' . $this->active_cat; exit;

/*	
	// Set active the module detail
	if (array_key_exists($cat_id, $this->module_detail_ary))
	{
	    $this->active_cat = $cat_id;
	    //echo 'cat_id ada<p>';
	}
	else
	{
	    $this->active_cat = key($this->module_detail_ary);
	    //echo 'cat_id blongggggg<p>';
	}
	print_r($this->module_detail_ary); echo '<p> first key: '; 
	echo key($this->module_detail_ary); echo '<p> first value: ';
	echo reset($this->module_detail_ary); echo '<p> active_cat: ';
	echo $this->active_cat;
	exit;
*/
	//return $rows;
    }

    /**
    * Set active module
    */
    function set_active($file, $id = false, $mode = false)
    {
	$icat = false;
	$this->active_module = false;

	//echo 'in set_active<p>'; print_r($this->module_ary); 
	if (request_var('icat', ''))
	{
	    $icat = $id;
	    $id = request_var('icat', '');
	}

	$category = false;
	foreach ($this->module_ary as $row_id => $item_ary)
	{
	    //print_r($item_ary); echo '<br>';

	    // If this is a module and it's selected, active
	    // If this is a category and the module is the first within it, active
	    // If this is a module and no mode selected, select first mode
	    // If no category or module selected, go active for first module in first category
	    if ($item_ary['module_file'] === $file || $item_ary['module_id'] === $id)
	    {
		$this->p_id			= $item_ary['module_id'];
		$this->active_module		= $item_ary['module_id'];
		$this->active_module_row_id	= $row_id;

		break;
	    }
	    
	}
	//echo '<p> active module: ' . $file . '<br>' . $this->active_module; exit;
    }

    /**
    * Build navigation structure
    */
    function assign_tpl_vars($module_url)
    {
	global $template, $tonjaw_admin_path, $tonjaw_admin_signage_path, $phpEx;

	//$current_id = $right_id = false;

	// Make sure the module_url has a question mark set, effectively determining the delimiter to use
	$delim = (strpos($module_url, '?') === false) ? '?' : '&amp;';

	$current_padding = $current_depth = 0;
	$linear_offset 	= 'l_block1';
	$tabular_offset = 't_block2';

	foreach ($this->module_ary as $row_id => $item_ary)
	{

	    // Select first id we can get
	    if (!$current_id && isset($item_ary['module_id']) || $item_ary['module_id'] == $this->p_id)
	    {
		$current_id = $item_ary['module_id'];
	    }
	    
	    $u_title = append_sid($tonjaw_admin_path . $item_ary['module_file'] . '.' . $phpEx);
	    
	    //$use_tabular_offset = (!$depth) ? 't_block1' : $tabular_offset;
	    $use_tabular_offset = 't_block1';
	    $tpl_ary = array(
		'L_TITLE'	=> $item_ary['module_name'],
		'S_SELECTED'	=> ($item_ary['module_id'] == $this->p_id) ? true : false,
		'U_TITLE'	=> $u_title
	    );

	    $template->assign_block_vars($use_tabular_offset, array_merge($tpl_ary, array_change_key_case($item_ary, CASE_UPPER)));

	    $current_depth = $depth;
	}
	
	// Left menu
	// Detail Cat title
	$detail_cat = ''; //$aaa = 1; $bbb = 1;
	foreach ($this->module_detail_ary as $row_id => $cat_ary)
	{
	    // Get cat 
	    if ($detail_cat !== $cat_ary['module_detail_cat_name'])
	    {
		
		$use_linear_offset2 = 'l_block2';
		
		$tpl_ary = array(
		    'L_TITLE'		=> $cat_ary['module_detail_cat_name'],// . ' ' .$bbb,
		    //'S_SELECTED'	=> ($cat_ary['module_detail_id'] == $this->active_cat) ? true : false,
		    //'U_TITLE'		=> $u_title
		);

		$template->assign_block_vars($use_linear_offset2, array_merge($tpl_ary, array_change_key_case($cat_ary, CASE_UPPER)));
		//$bbb++;
	    }
	    
	    /** ADDED BY AGNES, 17 Jul 14 **/
	    $path = $tonjaw_admin_path;
	    if(preg_match("/signage/i", $cat_ary['module_detail_file'])) {
		$path = $tonjaw_admin_signage_path;
	    }
	    /** END **/

	    $u_title = append_sid($path . $cat_ary['module_detail_file'] . '.' . $phpEx);
	    
	    //$use_tabular_offset = (!$depth) ? 't_block1' : $tabular_offset;
	    $use_linear_offset = 'l_block2.l_block3';
	    $tpl_ary = array(
		'L_TITLE'	=> $cat_ary['module_detail_name'], //. ' ' .$aaa,
		'S_SELECTED'	=> ($cat_ary['module_detail_id'] == $this->active_cat) ? true : false,
		'U_TITLE'	=> $u_title
	    );

	    $template->assign_block_vars($use_linear_offset, array_merge($tpl_ary, array_change_key_case($cat_ary, CASE_UPPER)));

	    //$current_depth = $depth;
	    $detail_cat = $cat_ary['module_detail_cat_name'];
	    //$aaa++;
	}
	
//	print_r($tpl_ary); exit;

    }
    
    



}

?>