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
    <th colspan="2"><?php echo ((isset($this->_rootref['L_TITLE'])) ? $this->_rootref['L_TITLE'] : ((isset($user->lang['TITLE'])) ? $user->lang['TITLE'] : '{ TITLE }')); ?></th>
  </tr>
  <?php if ($this->_rootref['S_VIEW']) {  ?>

  <tr>
    <td width="150"><?php echo ((isset($this->_rootref['L_GUEST'])) ? $this->_rootref['L_GUEST'] : ((isset($user->lang['GUEST'])) ? $user->lang['GUEST'] : '{ GUEST }')); ?></td>
    <td><?php echo (isset($this->_rootref['U_ROOMNAME'])) ? $this->_rootref['U_ROOMNAME'] : ''; ?> - <?php echo (isset($this->_rootref['U_GUESTNAME'])) ? $this->_rootref['U_GUESTNAME'] : ''; ?> [<?php echo (isset($this->_rootref['U_RESV_ID'])) ? $this->_rootref['U_RESV_ID'] : ''; ?>]</td>
  </tr>
  <tr>
    <td><?php echo ((isset($this->_rootref['L_TIME'])) ? $this->_rootref['L_TIME'] : ((isset($user->lang['TIME'])) ? $user->lang['TIME'] : '{ TIME }')); ?></td>
    <td><?php echo (isset($this->_rootref['U_TIME'])) ? $this->_rootref['U_TIME'] : ''; ?></td>
  </tr>
  <?php } ?>

</table>



<div class="CSSTableGenerator">
<form action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>" method="post" id="formOrder" >
<?php if ($this->_rootref['S_VIEW']) {  ?>

<table width="100%" border="0">
    <tr class="header">
	<td><?php echo ((isset($this->_rootref['L_CODE'])) ? $this->_rootref['L_CODE'] : ((isset($user->lang['CODE'])) ? $user->lang['CODE'] : '{ CODE }')); ?></td>
	<td><?php echo ((isset($this->_rootref['L_ITEM'])) ? $this->_rootref['L_ITEM'] : ((isset($user->lang['ITEM'])) ? $user->lang['ITEM'] : '{ ITEM }')); ?></td>
	<td><?php echo ((isset($this->_rootref['L_QTY'])) ? $this->_rootref['L_QTY'] : ((isset($user->lang['QTY'])) ? $user->lang['QTY'] : '{ QTY }')); ?></td>
	<td><?php echo ((isset($this->_rootref['L_PRICE'])) ? $this->_rootref['L_PRICE'] : ((isset($user->lang['PRICE'])) ? $user->lang['PRICE'] : '{ PRICE }')); ?></td>
	<?php if ($this->_rootref['S_NOT_RECEIVED']) {  ?>

	<!--<td><?php echo ((isset($this->_rootref['L_EDIT'])) ? $this->_rootref['L_EDIT'] : ((isset($user->lang['EDIT'])) ? $user->lang['EDIT'] : '{ EDIT }')); ?></td>-->
	<?php } if ($this->_rootref['S_DELETE']) {  ?>

	<td><?php echo ((isset($this->_rootref['L_DELETE'])) ? $this->_rootref['L_DELETE'] : ((isset($user->lang['DELETE'])) ? $user->lang['DELETE'] : '{ DELETE }')); ?></td>
	<?php } ?>

    </tr>
  
  <?php $_buffer_count = (isset($this->_tpldata['buffer'])) ? sizeof($this->_tpldata['buffer']) : 0;if ($_buffer_count) {for ($_buffer_i = 0; $_buffer_i < $_buffer_count; ++$_buffer_i){$_buffer_val = &$this->_tpldata['buffer'][$_buffer_i]; ?>

    <tr class="item">
	<td><?php echo $_buffer_val['U_CODE']; ?></td>
	<td><?php echo $_buffer_val['U_ITEM']; ?> <br/> <?php echo $_buffer_val['U_NOTE']; ?></td>
	<td><?php echo $_buffer_val['U_QTY']; ?></td>
	<td><?php echo $_buffer_val['U_PRICE']; ?></td>
	<?php if ($this->_rootref['S_NOT_RECEIVED']) {  ?>

	<!--<td><a href="<?php echo $_buffer_val['U_EDIT']; ?>"><img src="<?php echo $_buffer_val['ICON_PATH']; ?>/edit.png" /></a>-->
	</td><?php } if ($this->_rootref['S_DELETE']) {  ?>

  <td><a href="<?php echo $_buffer_val['U_DELETE']; ?>"><img src="<?php echo $_buffer_val['ICON_PATH']; ?>/delete.png" /></a>
	</td><?php } ?>

  </tr>
  <?php }} ?>

  <tr class="item">
	<td colspan="3" align="right"><strong><?php echo ((isset($this->_rootref['L_SUBTOTAL'])) ? $this->_rootref['L_SUBTOTAL'] : ((isset($user->lang['SUBTOTAL'])) ? $user->lang['SUBTOTAL'] : '{ SUBTOTAL }')); ?></strong></td>
	<td><?php echo (isset($this->_rootref['U_PRICE'])) ? $this->_rootref['U_PRICE'] : ''; ?></td>
	<td></td>
  </tr>
  <tr class="item">
	<td colspan="3" align="right"><strong><?php echo ((isset($this->_rootref['L_TOTAL'])) ? $this->_rootref['L_TOTAL'] : ((isset($user->lang['TOTAL'])) ? $user->lang['TOTAL'] : '{ TOTAL }')); ?> (incl. 21% Service &amp; Tax)</strong></td>
	<td><?php echo (isset($this->_rootref['U_PRICE_NETT'])) ? $this->_rootref['U_PRICE_NETT'] : ''; ?></td>
	<td></td>
  </tr>
</table>
<?php } if ($this->_rootref['S_APPROVED']) {  ?>

<p><?php echo ((isset($this->_rootref['L_APPROVE_DECLINE'])) ? $this->_rootref['L_APPROVE_DECLINE'] : ((isset($user->lang['APPROVE_DECLINE'])) ? $user->lang['APPROVE_DECLINE'] : '{ APPROVE_DECLINE }')); ?> at <?php echo (isset($this->_rootref['S_RECEIVED_DATE'])) ? $this->_rootref['S_RECEIVED_DATE'] : ''; ?></p>
<?php } if ($this->_rootref['S_UPDATE']) {  ?>

<table width="100%" border="0">
    <tr>
	<td colspan="2"><?php echo (isset($this->_rootref['S_ITEM'])) ? $this->_rootref['S_ITEM'] : ''; ?></td>
    </tr>
    <tr>
	<td width="30%" align="right"><?php echo ((isset($this->_rootref['L_QTY'])) ? $this->_rootref['L_QTY'] : ((isset($user->lang['QTY'])) ? $user->lang['QTY'] : '{ QTY }')); ?></td>
	<td width="70%"><?php echo (isset($this->_rootref['S_QTY'])) ? $this->_rootref['S_QTY'] : ''; ?></td>
    </tr>
    <tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    </tr>
</table>
<?php } ?>


<center>
<?php if ($this->_rootref['S_NOT_RECEIVED']) {  ?>

<input type="button" name="btnApprove" id="btnApprove" value="<?php echo ((isset($this->_rootref['L_APPROVE'])) ? $this->_rootref['L_APPROVE'] : ((isset($user->lang['APPROVE'])) ? $user->lang['APPROVE'] : '{ APPROVE }')); ?>" onclick="window.opener.location.href='<?php echo (isset($this->_rootref['U_APPROVE_URL'])) ? $this->_rootref['U_APPROVE_URL'] : ''; ?>';window.close();" />&nbsp;
<!--<input type="button" name="btnDecline" id="btnDecline" value="<?php echo ((isset($this->_rootref['L_DECLINE'])) ? $this->_rootref['L_DECLINE'] : ((isset($user->lang['DECLINE'])) ? $user->lang['DECLINE'] : '{ DECLINE }')); ?>" onclick="window.opener.location.href='<?php echo (isset($this->_rootref['U_DECLINE_URL'])) ? $this->_rootref['U_DECLINE_URL'] : ''; ?>';window.close();" />&nbsp;-->
<?php } if ($this->_rootref['S_DELETE']) {  ?>

<input type="button" name="btnDecline" id="btnDecline" value="<?php echo ((isset($this->_rootref['L_DECLINE'])) ? $this->_rootref['L_DECLINE'] : ((isset($user->lang['DECLINE'])) ? $user->lang['DECLINE'] : '{ DECLINE }')); ?>" onclick="window.opener.location.href='<?php echo (isset($this->_rootref['U_DECLINE_URL'])) ? $this->_rootref['U_DECLINE_URL'] : ''; ?>';window.close();" />&nbsp;
<?php } if ($this->_rootref['S_UPDATE']) {  ?><input type="submit" name="btnSubmit" id="btnSubmit" value="<?php echo ((isset($this->_rootref['L_APPROVE'])) ? $this->_rootref['L_APPROVE'] : ((isset($user->lang['APPROVE'])) ? $user->lang['APPROVE'] : '{ APPROVE }')); ?>" />&nbsp;
<input type="button" name="btnCancel" id="btnCancel" value="<?php echo ((isset($this->_rootref['L_CANCEL'])) ? $this->_rootref['L_CANCEL'] : ((isset($user->lang['CANCEL'])) ? $user->lang['CANCEL'] : '{ CANCEL }')); ?>" onclick="window.location.href='<?php echo (isset($this->_rootref['U_CANCEL_URL'])) ? $this->_rootref['U_CANCEL_URL'] : ''; ?>';"/><?php } ?>

<input class="button red close" type="button" name="btnClose" id="btnClose" value="<?php echo ((isset($this->_rootref['L_CLOSE'])) ? $this->_rootref['L_CLOSE'] : ((isset($user->lang['CLOSE'])) ? $user->lang['CLOSE'] : '{ CLOSE }')); ?>" onclick="window.close();" />
</center>
 

</form>
</div>

</body>
</html>