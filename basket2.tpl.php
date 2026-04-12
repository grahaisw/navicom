<?php if (!defined('IN_TONJAW')) exit; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo (isset($this->_rootref['S_CONTENT_DIRECTION'])) ? $this->_rootref['S_CONTENT_DIRECTION'] : ''; ?>" lang="<?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>" xml:lang="<?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>">
<head>
<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/pop.css" rel="stylesheet" type="text/css" />
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jquery-1.10.1.min.js"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jquery.fancybox.js"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/keycode.js" type="text/javascript" language="javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/order.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/senlei19.js" type="text/javascript"></script>
<script type="text/javascript">
	jQuery(document).ready(function ($) {
		var defaults = {
			width     : 600,
		}
	});	
		
	$(document).keydown(function(e) {
		var key = e.keyCode;
		switch (key) { 
			case keyCodes.KEY_red:
				sss_js_keyboardDisplayInlineFunction();
				break;
			
			case keyCodes.KEY_back:
				return false;
				//break;
		}
	});	
		
	
</script>
<link rel="stylesheet" href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/basket.css" type="text/css"/>	
<style type="text/css">
body{ background: #000 no-repeat center top; 
  background-color: #ccc;
  height : 400px;
  width  : 800px;
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
  h1 { font-size: 30px; font-family: Arial; font-weight: bold; margin: 30px; }
  .box { width:350px; }

  footer { font-size:12px; }
  form a, footer a { color:#40738d; }
  
</style>
</head>
<body>

<!--<div class="CSSTableGenerator">-->
<?php if ($this->_rootref['S_PASSWORD']) {  ?>
<h1><?php echo ((isset($this->_rootref['L_CONFIRMATION'])) ? $this->_rootref['L_CONFIRMATION'] : ((isset($user->lang['CONFIRMATION'])) ? $user->lang['CONFIRMATION'] : '{ CONFIRMATION }')); ?></h1>
<form action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>" method="post" id="formOrder" >
<table style="font-size: 20px; padding: 10px; margin-top:30px; width:80%">
<tr>
	<td width="20%" align="right" autofocus><?php echo ((isset($this->_rootref['L_PASSWORD'])) ? $this->_rootref['L_PASSWORD'] : ((isset($user->lang['PASSWORD'])) ? $user->lang['PASSWORD'] : '{ PASSWORD }')); ?></td>
	<td width="80%"><input type="password" id="password" name="password" autofocus placeholder="<?php echo ((isset($this->_rootref['L_PASSWORD'])) ? $this->_rootref['L_PASSWORD'] : ((isset($user->lang['PASSWORD'])) ? $user->lang['PASSWORD'] : '{ PASSWORD }')); ?>" size="20"/></td>
</tr>
<tr>
	<td></td>
	<td>
		<input class="button green close" type="submit" name="btnSubmit" id="btnSubmit" value="<?php echo ((isset($this->_rootref['L_CONFIRM'])) ? $this->_rootref['L_CONFIRM'] : ((isset($user->lang['CONFIRM'])) ? $user->lang['CONFIRM'] : '{ CONFIRM }')); ?>" />
		<input class="button red close" type="button" name="btnCancel" id="btnCancel" value="<?php echo ((isset($this->_rootref['L_CANCEL'])) ? $this->_rootref['L_CANCEL'] : ((isset($user->lang['CANCEL'])) ? $user->lang['CANCEL'] : '{ CANCEL }')); ?>" onclick="parent.$.fancybox.close();"/>
	</td>
</tr>
<tr>
	<td></td>
	<td><div style="font-size:14px;margin-top:15px;">*) Press <font color="red">red</font> button to enter your password</div></td>
</tr>
</table>
<input type="hidden" name="roomname" value="<?php echo ((isset($this->_rootref['L_GUEST_ROOMNAME'])) ? $this->_rootref['L_GUEST_ROOMNAME'] : ((isset($user->lang['GUEST_ROOMNAME'])) ? $user->lang['GUEST_ROOMNAME'] : '{ GUEST_ROOMNAME }')); ?>"/>
<input type="hidden" name="type" value="<?php echo ((isset($this->_rootref['L_TYPE'])) ? $this->_rootref['L_TYPE'] : ((isset($user->lang['TYPE'])) ? $user->lang['TYPE'] : '{ TYPE }')); ?>"/>
</form>
<?php } if ($this->_rootref['S_VERIFY_PASSWORD']) {  ?>
<div align="center" style="font-size:26px;margin-top:50px">Pesanan Anda Telah Dikirim Ke Sistem <br/>Terima Kasih</div>
<div style="font-size:20px;position:relative;top:20px;left:370px"><input class="button green close" type="submit" name="clearbasket" id="btnSubmit" autofocus value="OK" onclick="parent.$.fancybox.close();"  /></div>
<?php } ?>



<!--</div>-->

</body>
</html>