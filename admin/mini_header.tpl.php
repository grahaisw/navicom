<?php if (!defined('IN_TONJAW')) exit; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo (isset($this->_rootref['S_CONTENT_DIRECTION'])) ? $this->_rootref['S_CONTENT_DIRECTION'] : ''; ?>" lang="<?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>" xml:lang="<?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="imagetoolbar" content="no">
<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/adm_navicom.css" rel="stylesheet" type="text/css" media="screen">
<?php if ($this->_rootref['S_DATETIME_PICKER']) {  ?>

<link rel="stylesheet" type="text/css" href="<?php echo (isset($this->_rootref['T_JS_PATH'])) ? $this->_rootref['T_JS_PATH'] : ''; ?>jquery.datetimepicker.css"/>
<?php } ?>

</head>
<body class="ltr">

<!--
	Navicom style name: Simplicity (default) 
	Modified by: Roberto Tonjaw
-->
<div id="wrap">
	<h1><?php echo (isset($this->_rootref['PAGE_TITLE'])) ? $this->_rootref['PAGE_TITLE'] : ''; ?></h1>
	</br>
    <div id="window">