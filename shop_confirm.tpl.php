<?php if (!defined('IN_TONJAW')) exit; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo (isset($this->_rootref['S_CONTENT_DIRECTION'])) ? $this->_rootref['S_CONTENT_DIRECTION'] : ''; ?>" lang="<?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>" xml:lang="<?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>">
<head>
<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/pop.css" rel="stylesheet" type="text/css" />
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jquery-1.10.1.min.js"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jquery.fancybox.js"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/senlei19.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/keycode.js" type="text/javascript" language="javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/order.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/senlei19.js" type="text/javascript"></script>
<style type="text/css">
  body{ background: #000 no-repeat center top; 
  background-color: #ccc;
  Height : 405px;
  width     : 803px;
  } 

  #overlay-panel {
		padding: 25px;
  }
  a { color:#999; text-decoration:none; }
  label { display: block; }
  form { margin: 45px 25px; text-align:left }
  form input[type=text] { padding:5px; position:relative;top:0px;border:solid 1px #CCC;}
  form input[type=submit] { padding:2px; position:relative;top:10px;border:solid 1px #CCC;}
  form input[type=button] { padding:2px; position:relative;top:10px;border:solid 1px #CCC;}
  form textarea { padding:5px; width:90%; border:solid 1px #CCC; height:100px;}
  h1 { font-size: 30px; font-family: Arial; font-weight: bold; margin: 10px; }
  .box { width:350px; }

  footer { font-size:12px; }
  form a, footer a { color:#40738d; }
</style>
</head>
<body>
<h1><?php echo ((isset($this->_rootref['L_CONFIRMATION'])) ? $this->_rootref['L_CONFIRMATION'] : ((isset($user->lang['CONFIRMATION'])) ? $user->lang['CONFIRMATION'] : '{ CONFIRMATION }')); ?></h1>
<div>
<form action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>" method="post" id="formOrder" >
<table style="font-size: 20px; padding: 10px;">
    <tr>
	<td width="30%" align="right"><?php echo ((isset($this->_rootref['L_PASSWORD'])) ? $this->_rootref['L_PASSWORD'] : ((isset($user->lang['PASSWORD'])) ? $user->lang['PASSWORD'] : '{ PASSWORD }')); ?></td>
	<td width="70%"><input type="password" id="password" name="password" placeholder="<?php echo ((isset($this->_rootref['L_PASSWORD'])) ? $this->_rootref['L_PASSWORD'] : ((isset($user->lang['PASSWORD'])) ? $user->lang['PASSWORD'] : '{ PASSWORD }')); ?>" autofocus size="20"/></td>
    </tr>
    <tr>
	<td align="right"><?php echo ((isset($this->_rootref['L_QUANTITY'])) ? $this->_rootref['L_QUANTITY'] : ((isset($user->lang['QUANTITY'])) ? $user->lang['QUANTITY'] : '{ QUANTITY }')); ?></td>
	<td><?php echo (isset($this->_rootref['S_QUANTITY'])) ? $this->_rootref['S_QUANTITY'] : ''; ?></td>
    </tr>
    <tr>
	<td align="right"><?php echo ((isset($this->_rootref['L_SPECIAL_REQUEST'])) ? $this->_rootref['L_SPECIAL_REQUEST'] : ((isset($user->lang['SPECIAL_REQUEST'])) ? $user->lang['SPECIAL_REQUEST'] : '{ SPECIAL_REQUEST }')); ?></td>
	<td><textarea id="info" name="note" rows="1" cols="30" style="width: 480px; height: 60px; resize: none;" placeholder="<?php echo ((isset($this->_rootref['L_SPECIAL_REQUEST'])) ? $this->_rootref['L_SPECIAL_REQUEST'] : ((isset($user->lang['SPECIAL_REQUEST'])) ? $user->lang['SPECIAL_REQUEST'] : '{ SPECIAL_REQUEST }')); ?>" ><?php echo (isset($this->_rootref['S_NOTE'])) ? $this->_rootref['S_NOTE'] : ''; ?></textarea>
	</td>
    </tr>
    <tr>
	<td><input type="hidden" name="price" value="<?php echo (isset($this->_rootref['S_PRICE'])) ? $this->_rootref['S_PRICE'] : ''; ?>"/>
	    <input type="hidden" name="code" value="<?php echo (isset($this->_rootref['S_CODE'])) ? $this->_rootref['S_CODE'] : ''; ?>"/>
	    <input type="hidden" name="item_id" value="<?php echo (isset($this->_rootref['S_ITEM_ID'])) ? $this->_rootref['S_ITEM_ID'] : ''; ?>"/>
	    <input type="hidden" name="gid" value="<?php echo (isset($this->_rootref['S_GID'])) ? $this->_rootref['S_GID'] : ''; ?>"/>
	    <input type="hidden" name="mode" value="<?php echo (isset($this->_rootref['S_MODE'])) ? $this->_rootref['S_MODE'] : ''; ?>"/>
	    <input type="hidden" name="type" value="<?php echo (isset($this->_rootref['S_TYPE'])) ? $this->_rootref['S_TYPE'] : ''; ?>"/>
	</td>
	<td><input class="button green close" type="submit" name="btnSubmit" id="btnSubmit" value="<?php echo ((isset($this->_rootref['L_CONFIRM'])) ? $this->_rootref['L_CONFIRM'] : ((isset($user->lang['CONFIRM'])) ? $user->lang['CONFIRM'] : '{ CONFIRM }')); ?>" />
<input class="button red close" type="button" name="btnCancel" id="btnCancel" value="<?php echo ((isset($this->_rootref['L_CANCEL'])) ? $this->_rootref['L_CANCEL'] : ((isset($user->lang['CANCEL'])) ? $user->lang['CANCEL'] : '{ CANCEL }')); ?>" onclick="parent.$.fancybox.close();"/>
	</td>
    </tr>
</table>


<!--
<p style="font-size: 14px;text-align: left;">
</p>
<p style="font-size: 14px;text-align: left;"><br/>
<input type="text" id="quantity" name="qty" placeholder="<?php echo ((isset($this->_rootref['L_QUANTITY'])) ? $this->_rootref['L_QUANTITY'] : ((isset($user->lang['QUANTITY'])) ? $user->lang['QUANTITY'] : '{ QUANTITY }')); ?>" /></p></br>
<p style="font-size: 12px;">
<textarea id="info" name="note" rows="1" cols="30" style="width: 730px; height: 91px; resize: none;" placeholder="<?php echo ((isset($this->_rootref['L_SPECIAL_REQUEST'])) ? $this->_rootref['L_SPECIAL_REQUEST'] : ((isset($user->lang['SPECIAL_REQUEST'])) ? $user->lang['SPECIAL_REQUEST'] : '{ SPECIAL_REQUEST }')); ?>" ></textarea>
<input type="hidden" name="price" value="<?php echo (isset($this->_rootref['S_PRICE'])) ? $this->_rootref['S_PRICE'] : ''; ?>"/>
<input type="hidden" name="code" value="<?php echo (isset($this->_rootref['S_CODE'])) ? $this->_rootref['S_CODE'] : ''; ?>"/>
<input type="hidden" name="item_id" value="<?php echo (isset($this->_rootref['S_ITEM_ID'])) ? $this->_rootref['S_ITEM_ID'] : ''; ?>"/>
<input type="hidden" name="gid" value="<?php echo (isset($this->_rootref['S_GID'])) ? $this->_rootref['S_GID'] : ''; ?>"/>
<input type="hidden" name="mode" value="<?php echo (isset($this->_rootref['S_MODE'])) ? $this->_rootref['S_MODE'] : ''; ?>"/>
<input type="hidden" name="type" value="<?php echo (isset($this->_rootref['S_TYPE'])) ? $this->_rootref['S_TYPE'] : ''; ?>"/>

<input class="button green close" type="submit" name="btnSubmit" id="btnSubmit" value="<?php echo ((isset($this->_rootref['L_CONFIRM'])) ? $this->_rootref['L_CONFIRM'] : ((isset($user->lang['CONFIRM'])) ? $user->lang['CONFIRM'] : '{ CONFIRM }')); ?>" />
<input class="button red close" type="button" name="btnCancel" id="btnCancel" value="<?php echo ((isset($this->_rootref['L_CANCEL'])) ? $this->_rootref['L_CANCEL'] : ((isset($user->lang['CANCEL'])) ? $user->lang['CANCEL'] : '{ CANCEL }')); ?>" onclick="parent.$.fancybox.close();"/>
-->
</form>
</div>
</body>
</html>