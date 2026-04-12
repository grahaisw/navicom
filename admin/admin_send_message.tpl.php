<?php if (!defined('IN_TONJAW')) exit; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo (isset($this->_rootref['S_CONTENT_DIRECTION'])) ? $this->_rootref['S_CONTENT_DIRECTION'] : ''; ?>" lang="<?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>" xml:lang="<?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>">
<head>
<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/pop.css" rel="stylesheet" type="text/css" />

<style type="text/css" title="currentStyle">
body {
    background: #CCCFD3;
    color: #000;
    font-family: Verdana, Arial;
    margin: 0px;
}
table {
    padding: 10px;
}
td {
    padding: 5px;
}
.header {
    background: #666;
    color: #fff;
}
.item {
    background: #eee;
}

</style>


</head>
<body>


<table width="100%" border="0" class="CSSHeaderTable">
  <tr>
    <th><?php echo ((isset($this->_rootref['L_TITLE'])) ? $this->_rootref['L_TITLE'] : ((isset($user->lang['TITLE'])) ? $user->lang['TITLE'] : '{ TITLE }')); ?></th>
  </tr>
  
</table>

<div class="CSSTableGenerator">
<form action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>" method="post" id="formOrder" >
<table width="100%" border="0">
    <tr>
	<td align="right"><?php echo ((isset($this->_rootref['L_TO'])) ? $this->_rootref['L_TO'] : ((isset($user->lang['TO'])) ? $user->lang['TO'] : '{ TO }')); ?>:</td>
	<td><?php echo (isset($this->_rootref['U_ROOMNAME'])) ? $this->_rootref['U_ROOMNAME'] : ''; ?> - <?php echo (isset($this->_rootref['U_GUESTNAME'])) ? $this->_rootref['U_GUESTNAME'] : ''; ?> [<?php echo (isset($this->_rootref['U_RESV_ID'])) ? $this->_rootref['U_RESV_ID'] : ''; ?>]</td>
    </tr>
    <tr>
	<td width="25%" align="right"><?php echo ((isset($this->_rootref['L_SUBJECT'])) ? $this->_rootref['L_SUBJECT'] : ((isset($user->lang['SUBJECT'])) ? $user->lang['SUBJECT'] : '{ SUBJECT }')); ?></td>
	<td width="75%"><input type="text" name="subject" width="200" value="<?php echo (isset($this->_rootref['S_SUBJECT'])) ? $this->_rootref['S_SUBJECT'] : ''; ?>" autofocus></td>
    </tr>
    <tr>
	<td align="right" valign="top"><?php echo ((isset($this->_rootref['L_MESSAGE'])) ? $this->_rootref['L_MESSAGE'] : ((isset($user->lang['MESSAGE'])) ? $user->lang['MESSAGE'] : '{ MESSAGE }')); ?></td>
	<td><textarea name="message" cols="60" rows="5"><?php echo (isset($this->_rootref['S_MESSAGE'])) ? $this->_rootref['S_MESSAGE'] : ''; ?></textarea>
	<?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?></td>
    </tr>
</table>
<center>

<input type="submit" name="btnSubmit" id="btnSubmit" value="<?php echo ((isset($this->_rootref['L_SEND'])) ? $this->_rootref['L_SEND'] : ((isset($user->lang['SEND'])) ? $user->lang['SEND'] : '{ SEND }')); ?>" onclick="window.opener.location.reload();window.close();" />&nbsp;
<input type="button" name="btnCancel" id="btnCancel" value="<?php echo ((isset($this->_rootref['L_CANCEL'])) ? $this->_rootref['L_CANCEL'] : ((isset($user->lang['CANCEL'])) ? $user->lang['CANCEL'] : '{ CANCEL }')); ?>" onclick="window.close();"/>
</center>

</form>
</div>

</body>
</html>