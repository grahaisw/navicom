<?php
/*
$xmlDoc = new DOMDocument();
//$xmlDoc->load("http://api.wunderground.com/api/6fb5732bbca00ff8/geolookup/conditions/forecast/q/Indonesia/Banda_Aceh.xml");
$xmlDoc->load("sample1.xml");
$x = $xmlDoc->documentElement;
foreach ($x->childNodes AS $item) {
  print $item->nodeName . " = " . $item->nodeValue . "<br>";
}
*/
$xml=simplexml_load_file("sample1.xml");
echo $xml->to . "<br>";
echo $xml->from . "<br>";
echo $xml->heading . "<br>";
echo $xml->family->istri;

?> 
