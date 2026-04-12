<?php

define('IN_TONJAW', true);

$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
$file = explode('.', substr(strrchr(__FILE__, '/'), 1));

require($tonjaw_root_path . 'common.' . $phpEx);

$a = "只有管理员和版主和用户本人可以查看/填写这个栏目. 如果显示在用户控制面板的选项未启用, 用户将无法看到这个栏目, 并且只能由管理员来修改.";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-us" xml:lang="en-us">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="imagetoolbar" content="no">

<title>{SITENAME} &bull; <!-- IF S_IN_UCP -->{L_UCP} &bull; <!-- ENDIF -->{PAGE_TITLE}</title>
<body>
<?php
echo $a . '<br/>';

$b = utf8_normalize_nfc($a);
echo $b . '<br/>';
echo prepare_message($b);

?>
</body>
</html>