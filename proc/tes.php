<?php
$myFile = "testFile.txt";
$fh = fopen($myFile, 'a+') or die("can't open file");
$stringData = "Ini tulisan pertaman";
fwrite($fh, $stringData);
$stringData = "Ini tulisan keduan";
fwrite($fh, $stringData);
fclose($fh);
?>
