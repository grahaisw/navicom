<?php if (!defined('IN_TONJAW')) exit; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo (isset($this->_rootref['S_CONTENT_DIRECTION'])) ? $this->_rootref['S_CONTENT_DIRECTION'] : ''; ?>" lang="<?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>" xml:lang="<?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>">
<head>
<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/pop.css" rel="stylesheet" type="text/css" />
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jquery-1.10.1.min.js"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jquery.fancybox.js"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/senlei19.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/keycode.js" type="text/javascript" language="javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/order.js" type="text/javascript"></script>
<!--<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/senlei19.js" type="text/javascript"></script>-->

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/basket.css" rel="stylesheet" type="text/css" />
<style>
.CSSHeaderTable td {
	font-size:16px;
}
.CSSTableGenerator td {
	font-size:16px;
}
.tbl .alCenter {
	text-align:center;
}
.tbl .alRight {
	text-align:right;
}
</style>
<script>
$(document).keydown(function(e) {
	var key = e.keyCode;
	switch (key) { 
		case keyCodes.KEY_back:
			return false;
			//break;
	}
});

function clearBasket() {
	var id = $("#code").val();
	var room = $("#roomname").val();
	
	$.ajax({
		url: "ajax.php",
		cache: false,
		type: "GET",
		data: "mod=clearbasket&resv_id=" + id + "&room=" + room,
		success: function(response){ 
			parent.$.fancybox.open({
				href : 'basket1.php?mode=view&type=F' ,
				type : 'iframe',
				padding : 5
			});
		}
	});
}
</script>

</head>
<body id="basketpage">


<table width="100%" border="0" class="CSSHeaderTable">
  <tr>
    <th colspan="2"><?php echo ((isset($this->_rootref['L_BASKET_ITEM'])) ? $this->_rootref['L_BASKET_ITEM'] : ((isset($user->lang['BASKET_ITEM'])) ? $user->lang['BASKET_ITEM'] : '{ BASKET_ITEM }')); ?></th>
  </tr>
  <tr>
    <td width="100">Room</td>
    <td><?php echo ((isset($this->_rootref['L_GUEST_ROOMNAME'])) ? $this->_rootref['L_GUEST_ROOMNAME'] : ((isset($user->lang['GUEST_ROOMNAME'])) ? $user->lang['GUEST_ROOMNAME'] : '{ GUEST_ROOMNAME }')); ?></td>
  </tr>
  <tr>
    <td>Guest</td>
    <td><?php echo ((isset($this->_rootref['L_GUEST_NAME'])) ? $this->_rootref['L_GUEST_NAME'] : ((isset($user->lang['GUEST_NAME'])) ? $user->lang['GUEST_NAME'] : '{ GUEST_NAME }')); ?></td>
  </tr>
</table>



<div class="CSSTableGenerator">
<form action="basket2.php" method="post" id="formOrder" >

<table width="100%" border="1" class="tbl">
  <tr>
    <td width="30"><?php echo ((isset($this->_rootref['L_QUANTITY'])) ? $this->_rootref['L_QUANTITY'] : ((isset($user->lang['QUANTITY'])) ? $user->lang['QUANTITY'] : '{ QUANTITY }')); ?></td>
    <td colspan="2"><?php echo ((isset($this->_rootref['L_ITEM_SELECTED'])) ? $this->_rootref['L_ITEM_SELECTED'] : ((isset($user->lang['ITEM_SELECTED'])) ? $user->lang['ITEM_SELECTED'] : '{ ITEM_SELECTED }')); ?></td>
	<td width="150"><?php echo ((isset($this->_rootref['L_TOTAL_PRICE'])) ? $this->_rootref['L_TOTAL_PRICE'] : ((isset($user->lang['TOTAL_PRICE'])) ? $user->lang['TOTAL_PRICE'] : '{ TOTAL_PRICE }')); ?> *)</td>
	<!--<td width="120"><?php echo ((isset($this->_rootref['L_TOTAL_PRICE'])) ? $this->_rootref['L_TOTAL_PRICE'] : ((isset($user->lang['TOTAL_PRICE'])) ? $user->lang['TOTAL_PRICE'] : '{ TOTAL_PRICE }')); ?></td>-->
    <td width="100"><?php echo ((isset($this->_rootref['L_DELETE_ITEM'])) ? $this->_rootref['L_DELETE_ITEM'] : ((isset($user->lang['DELETE_ITEM'])) ? $user->lang['DELETE_ITEM'] : '{ DELETE_ITEM }')); ?></td>
  </tr>
  
  <?php $_somerow_count = (isset($this->_tpldata['somerow'])) ? sizeof($this->_tpldata['somerow']) : 0;if ($_somerow_count) {for ($_somerow_i = 0; $_somerow_i < $_somerow_count; ++$_somerow_i){$_somerow_val = &$this->_tpldata['somerow'][$_somerow_i]; ?>
  <tr>
    <td class="alCenter"><?php echo $_somerow_val['GUEST_QTY']; ?></td>
    <td colspan="2"><?php echo $_somerow_val['GUEST_ITEM']; ?></td>
	<td class="alRight"><?php echo $_somerow_val['GUEST_PRICE_ITEM']; ?></td>
	<!--<td class="alRight"><?php echo $_somerow_val['GUEST_SUBTOTAL_PRICE_ITEM']; ?></td>-->
    <td class="alCenter"><input type="hidden" name="code" value="<?php echo $_somerow_val['GUEST_ID']; ?>"/>	
	<a href="<?php echo $_somerow_val['U_DELETE']; ?>" id="DeleteLink"><img src="<?php echo $_somerow_val['ICON_PATH']; ?>/delete.png" /></a>
	</td>
  </tr>
  <?php }} ?>
	
  <!--<tr>
    <td colspan="3" class="alRight"><strong><?php echo ((isset($this->_rootref['L_SUBTOTAL'])) ? $this->_rootref['L_SUBTOTAL'] : ((isset($user->lang['SUBTOTAL'])) ? $user->lang['SUBTOTAL'] : '{ SUBTOTAL }')); ?></strong></td>
	<td class="alRight"><?php echo (isset($this->_rootref['GUEST_TOTAL_PRICE_ITEM'])) ? $this->_rootref['GUEST_TOTAL_PRICE_ITEM'] : ''; ?></td>
    <td class="alCenter"></td>
  </tr>-->
  <?php if ($this->_rootref['S_PRICE_NETT']) {  ?>
  <tr>
    <td colspan="3" class="alRight"><strong><?php echo ((isset($this->_rootref['L_TOTAL'])) ? $this->_rootref['L_TOTAL'] : ((isset($user->lang['TOTAL'])) ? $user->lang['TOTAL'] : '{ TOTAL }')); ?></strong></td>
	<td class="alRight"><?php echo (isset($this->_rootref['GUEST_PRICE_NETT'])) ? $this->_rootref['GUEST_PRICE_NETT'] : ''; ?></td>
    <td class="alCenter"></td>
  </tr>
  <?php } ?>
</table><br/>  
    <div style="width:400px;display:inline-block;">
	<input type="hidden" name="code" id="code" value="<?php echo (isset($this->_rootref['GUEST_ROOM'])) ? $this->_rootref['GUEST_ROOM'] : ''; ?>"/>
    <input type="hidden" name="roomname" id="roomname" value="<?php echo ((isset($this->_rootref['L_GUEST_ROOMNAME'])) ? $this->_rootref['L_GUEST_ROOMNAME'] : ((isset($user->lang['GUEST_ROOMNAME'])) ? $user->lang['GUEST_ROOMNAME'] : '{ GUEST_ROOMNAME }')); ?>"/>
    <input type="hidden" name="type" id="type" value="<?php echo ((isset($this->_rootref['L_TYPE'])) ? $this->_rootref['L_TYPE'] : ((isset($user->lang['TYPE'])) ? $user->lang['TYPE'] : '{ TYPE }')); ?>"/>
	<?php if ($this->_rootref['S_CONFIRM']) {  ?>
	<input class="button green close" type="submit" name="btnSubmit" id="btnSubmit" value="<?php echo ((isset($this->_rootref['L_CONFIRM'])) ? $this->_rootref['L_CONFIRM'] : ((isset($user->lang['CONFIRM'])) ? $user->lang['CONFIRM'] : '{ CONFIRM }')); ?>"  autofocus/>
	<input class="button blue close" type="button" name="btnClear" id="btnClear" value="<?php echo ((isset($this->_rootref['L_CLEAR_FORM'])) ? $this->_rootref['L_CLEAR_FORM'] : ((isset($user->lang['CLEAR_FORM'])) ? $user->lang['CLEAR_FORM'] : '{ CLEAR_FORM }')); ?>" onclick="clearBasket();" />
	<?php } ?>
	<input class="button red close" type="button" name="btnCancel" id="btnCancel" value="<?php echo ((isset($this->_rootref['L_CONTINUE_SHOP'])) ? $this->_rootref['L_CONTINUE_SHOP'] : ((isset($user->lang['CONTINUE_SHOP'])) ? $user->lang['CONTINUE_SHOP'] : '{ CONTINUE_SHOP }')); ?>" onclick="parent.$.fancybox.close();" <?php echo (isset($this->_rootref['S_AUTOFOCUS'])) ? $this->_rootref['S_AUTOFOCUS'] : ''; ?> />
	</div>
	<div style="width:320px;display:inline-block;font-family:Arial;margin-left:20px;font-size:16px;">*) <?php echo ((isset($this->_rootref['L_PRICE_NOTE'])) ? $this->_rootref['L_PRICE_NOTE'] : ((isset($user->lang['PRICE_NOTE'])) ? $user->lang['PRICE_NOTE'] : '{ PRICE_NOTE }')); ?></div>
  
 

</form>
</div>

</body>
</html>