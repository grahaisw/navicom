<?php if (!defined('IN_TONJAW')) exit; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo (isset($this->_rootref['S_CONTENT_DIRECTION'])) ? $this->_rootref['S_CONTENT_DIRECTION'] : ''; ?>" lang="<?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>" xml:lang="<?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>">
<head>
<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/pop.css" rel="stylesheet" type="text/css" />
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jquery-1.10.1.min.js"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jquery.fancybox.js"></script>
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
  h1 { font-size: 30px; font-family: <?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>; font-weight: bold; margin: 10px; }
  .box { width:350px; }

  footer { font-size:12px; }
  form a, footer a { color:#40738d; }
  @font-face {
	 font-family: 'jp';
	 src: url(<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/hiragino.ttf);
	 }
	  
	 @font-face {
	 font-family: 'cn';
	 src: url(<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/heitiSC.ttf);
	 }
	 
	 @font-face {
	 font-family: 'kr';
	 src: url(<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/AppleGothic.ttf);
	 }
	 
	 body {
    font-family: <?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>;
	}
	div {
    font-family: <?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>;
	}
	h1 {
    font-family: <?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>;
	}
	h2 {
    font-family: <?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>;
	}
</style>
</head>
<body>
<h1 style="font-family: <?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>;"><?php echo ((isset($this->_rootref['L_CONFIRMATION'])) ? $this->_rootref['L_CONFIRMATION'] : ((isset($user->lang['CONFIRMATION'])) ? $user->lang['CONFIRMATION'] : '{ CONFIRMATION }')); ?></h1>
<div>
<form action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>" method="post" id="formOrder" >
<table style="font-size: 20px; padding: 10px;">
    <tr>
	<td width="30%" align="right"><?php echo ((isset($this->_rootref['L_QUANTITY'])) ? $this->_rootref['L_QUANTITY'] : ((isset($user->lang['QUANTITY'])) ? $user->lang['QUANTITY'] : '{ QUANTITY }')); ?></td>
	<td width="70%"><?php echo (isset($this->_rootref['S_QUANTITY'])) ? $this->_rootref['S_QUANTITY'] : ''; ?></td>
    </tr>
    <tr>
	<td align="right"><?php echo ((isset($this->_rootref['L_TRANSPORTATION'])) ? $this->_rootref['L_TRANSPORTATION'] : ((isset($user->lang['TRANSPORTATION'])) ? $user->lang['TRANSPORTATION'] : '{ TRANSPORTATION }')); ?></td>
	<td><?php echo (isset($this->_rootref['S_TRANSPORTATION'])) ? $this->_rootref['S_TRANSPORTATION'] : ''; ?></td>
    </tr>
    <tr>
	<td align="right"><!--<?php echo ((isset($this->_rootref['L_DATETIME'])) ? $this->_rootref['L_DATETIME'] : ((isset($user->lang['DATETIME'])) ? $user->lang['DATETIME'] : '{ DATETIME }')); ?>-->&nbsp;</td>
	<td><!-- <input name="datetime" type="text" id="startdatetime" value="<?php echo (isset($this->_rootref['S_START'])) ? $this->_rootref['S_START'] : ''; ?>" placeholder="<?php echo ((isset($this->_rootref['L_DATETIME'])) ? $this->_rootref['L_DATETIME'] : ((isset($user->lang['DATETIME'])) ? $user->lang['DATETIME'] : '{ DATETIME }')); ?>" /> -->
	<?php echo ((isset($this->_rootref['L_DATE'])) ? $this->_rootref['L_DATE'] : ((isset($user->lang['DATE'])) ? $user->lang['DATE'] : '{ DATE }')); ?>&nbsp;<?php echo (isset($this->_rootref['S_DATE'])) ? $this->_rootref['S_DATE'] : ''; ?>&nbsp;
	<?php echo ((isset($this->_rootref['L_MONTH'])) ? $this->_rootref['L_MONTH'] : ((isset($user->lang['MONTH'])) ? $user->lang['MONTH'] : '{ MONTH }')); ?>&nbsp;<?php echo (isset($this->_rootref['S_MONTH'])) ? $this->_rootref['S_MONTH'] : ''; ?>&nbsp;
	<?php echo ((isset($this->_rootref['L_YEAR'])) ? $this->_rootref['L_YEAR'] : ((isset($user->lang['YEAR'])) ? $user->lang['YEAR'] : '{ YEAR }')); ?>&nbsp;<?php echo (isset($this->_rootref['S_YEAR'])) ? $this->_rootref['S_YEAR'] : ''; ?>&nbsp;
	<?php echo ((isset($this->_rootref['L_TIME'])) ? $this->_rootref['L_TIME'] : ((isset($user->lang['TIME'])) ? $user->lang['TIME'] : '{ TIME }')); ?>&nbsp;<?php echo (isset($this->_rootref['S_TIME'])) ? $this->_rootref['S_TIME'] : ''; ?>&nbsp;
	</td>
    </tr>
    <tr>
	<td align="right"><?php echo ((isset($this->_rootref['L_SPECIAL_REQUEST'])) ? $this->_rootref['L_SPECIAL_REQUEST'] : ((isset($user->lang['SPECIAL_REQUEST'])) ? $user->lang['SPECIAL_REQUEST'] : '{ SPECIAL_REQUEST }')); ?></td>
	<td><textarea id="info" name="note" rows="1" cols="30" style="width: 480px; height: 60px; resize: none;" placeholder="<?php echo ((isset($this->_rootref['L_SPECIAL_REQUEST'])) ? $this->_rootref['L_SPECIAL_REQUEST'] : ((isset($user->lang['SPECIAL_REQUEST'])) ? $user->lang['SPECIAL_REQUEST'] : '{ SPECIAL_REQUEST }')); ?>" ></textarea>
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


</form>

</div>

</body>
</html>