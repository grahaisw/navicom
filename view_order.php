<?php
/**
*
* view_order.php
*
* Roberto Tonjaw. Mar 2015
*/

/**
*/

//header('location: main.php');
//exit;

define('IN_TONJAW', true);
define('NEED_SID', true);
define('IN_FRONTEND', true);

$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : './';
$phpEx = substr(strrchr( $_SERVER['PHP_SELF'], '.'), 1);
$file = explode('.', substr(strrchr( $_SERVER['PHP_SELF'], '/'), 1));
$page = $file[0] . '.' . $phpEx;

// Include files
require($tonjaw_root_path . 'common.' . $phpEx);
require($tonjaw_root_path . 'fe_common.' . $phpEx);

//Get Guests Names
$guests_name = array();
$guests_name = get_guests_data($session->mac); //echo 'mac: ' . $guests_name; exit;

$guest_orders = array();

// Retrieve from Guest Services Table

if( !$config['view_orders_all'] )
{
    $service_filter = ' AND s.guest_service_approved=1 ';
    $order_filter = ' AND guest_order_approved=1 ';
}


$sql = "SELECT s.guest_service_id AS id, 
	s.guest_service_received AS received, 
	s.guest_service_approved AS approved, 
	s.guest_service_received_date AS received_date, 
	s.guest_service_type AS type, 
	d.guest_service_code AS code, 
	d.guest_service_item AS item, 
	d.guest_service_qty AS qty, 
	d.guest_service_note AS note 
    FROM " . GUEST_SERVICES_TABLE . " s, " . GUEST_SERVICES_DETAIL_TABLE . " d 
    WHERE s.guest_service_id=d.guest_service_id AND s.guest_reservation_id= " . $guests_name[0]['resv_id'] . $service_filter . " ORDER BY s.guest_service_id DESC";

$result1 = $db->sql_query($sql);
$i = 0;

while ($row = $db->sql_fetchrow($result1))
{
    $guest_orders[$i] = array(
	'id'		=> $row['id'],
	'received'	=> $row['received'],
	'received_date'	=> $row['received_date'],
	'approved'	=> $row['approved'],
	'type'		=> $row['type'],
	'code'		=> $row['code'],
	'item'		=> $row['item'],
	//'price'		=> $row['price'],
	'qty'		=> $row['qty'],
	'note'		=> $row['note'],
	//'equip'		=> $row['equip'],
	//'time'		=> $row['time'],
    );

    $i++;
}

$db->sql_freeresult($result1);


// Retrieve from Outlet Indirect Buffer

$sql = "SELECT guest_order_received AS received,
	guest_order_received_date AS received_date,
	guest_order_approved AS approved,
	guest_order_type AS type,
	guest_order_code AS code,
	guest_order_item AS item,
	guest_order_qty AS qty,
	guest_order_note AS note,
	guest_order_time AS time,
	guest_order_equip AS equip
    FROM " . OUTLET_INDIRECT_BUFFER_TABLE . " WHERE guest_reservation_id=" . $guests_name[0]['resv_id'] . $order_filter . " ORDER BY outlet_indirect_buffer_id DESC";
//echo $sql; exit;
$result1 = $db->sql_query($sql);

while ($row = $db->sql_fetchrow($result1))
{
    switch($row['type'])
    {
	case $config['tour_buffer_type']:
	    $s_equip = $lang['transportation'];
	    //$type = $lang['tour'];
	    break;
	    
	case $config['spa_buffer_type']:
	    $s_equip = $lang['teraphist'];
	    break;
    }
    
    $row['note'] .= ' - ' . $row['equip'] . ' - ' . date($config['default_dateformat'], $row['time']);

    $guest_orders[$i] = array(
	'id'		=> $row['id'],
	'received'	=> $row['received'],
	'received_date'	=> $row['received_date'],
	'approved'	=> $row['approved'],
	'type'		=> $row['type'],
	'code'		=> $row['code'],
	'item'		=> $row['item'],
	//'price'		=> $row['price'],
	'qty'		=> $row['qty'],
	'note'		=> $row['note'],
	//'equip'		=> $row['equip'],
	//'time'		=> $row['time'],
    );

    $i++;
}

$db->sql_freeresult($result1);

// Desc Sort by date
foreach ($guest_orders as $key => $row) {
   $tgl[$key] = $row[0];
}
array_multisort($tgl, SORT_DESC, $guest_orders);

// Generate the page
$template->set_template();
//page_header($lang_id);
page_header($lang_id, $page);

$i = 1;
foreach ($guest_orders as $row)
{
    $template->assign_block_vars('vieworder', array(
	'S_NO'		=> $i,
	'S_DATE'	=> date($config['vieworder_dateformat'], $row['received_date']),
	'S_CODE'	=> $row['code'],
	'S_ITEM'	=> $row['item'],
	'S_QTY'		=> $row['qty'],
	'S_NOTE'	=> $row['note'],
	//'S_PRICE'	=> $row['price'],
    ));

	$i++;
}

$template->assign_vars(array(
    'L_NOTICE'		=> '',
    'L_PAGE_TITLE'	=> $lang['view_my_orders'],
    'S_VIEWORDER'	=> '1',
    'S_ONMOUSEDOWN'	=> "",
    'T_BG_CLIP_PATH'	=> $config['vod_server'] . $config['vod_path'],
    'L_DATE'		=> $lang['date'],
    'L_CODE'		=> $lang['code'],
    'L_ITEM'		=> $lang['item'],
    'L_QTY'		=> $lang['qty'],
    'L_NOTE'		=> $lang['note'],
    'L_PRICE'		=> $lang['price'],
    'S_HOME_MENU_URL'	=> $tonjaw_root_path . 'index.php?menu=' . $config['home_menu_value'],
));


$template->set_filenames(array(
    'body' => 'vieworders.tpl',
));

//add_log($adm_lang['read']);
page_footer();


?>