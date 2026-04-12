<?php

echo '00: ' . mktime(00,00,00,0,0,0) . '<br/>';

echo '30: ' . mktime(00,30,00,0,0,0) . '<br/>';

$c = mktime(00,30,00,0,0,0) - mktime(00,00,00,0,0,0);

echo 'selisih: ' . $c . '<br/>';

$pms_config['outlet_id'][0]['table']	= 'SERVICES_TABLE';
$pms_config['outlet_id'][0]['table_t']	= 'SERVICE_TRANSLATIONS_TABLE';
$pms_config['outlet_id'][0]['field_id']		= 'service_id';
$pms_config['outlet_id'][0]['field_code']	= 'service_code';
$pms_config['outlet_id'][0]['field_price']	= 'service_price';
$pms_config['outlet_id'][0]['field_updated']	= 'service_updated';
$pms_config['outlet_id'][1]['table']	= 'SHOPS_TABLE';
$pms_config['outlet_id'][1]['table_t']	= 'SHOP_TRANSLATIONS_TABLE';
$pms_config['outlet_id'][1]['field_id']		= 'shop_id';
$pms_config['outlet_id'][1]['field_code']	= 'shop_code';
$pms_config['outlet_id'][1]['field_price']	= 'shop_price';
$pms_config['outlet_id'][1]['field_updated']	= 'shop_updated';

print_r($pms_config);

//echo '<p>count: ' . count($pms_config['outlet_id']);
echo '<p></p>';

for( $i = 0; $i<2; $i++ )
{
	 $sql = 'SELECT COUNT(' . $pms_config['outlet_id'][$i]['field_id'] . ') AS total_entries
		FROM ' . $pms_config['outlet_id'][$i]['table'] . ' 
		WHERE ' . $pms_config['outlet_id'][$i]['field_updated'] . '=1';
		
		echo $sql . '<p>';
}

?>