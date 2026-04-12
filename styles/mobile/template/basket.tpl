<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="{S_CONTENT_DIRECTION}" lang="{S_USER_LANG}" xml:lang="{S_USER_LANG}">
<head>
<link href="{T_THEME_PATH}/pop.css" rel="stylesheet" type="text/css" />
<script src="{T_THEME_PATH}/jquery-1.10.1.min.js"></script>
<script src="{T_THEME_PATH}/jquery.fancybox.js"></script>
<script src="{T_THEME_PATH}/senlei19.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/keycode.js" type="text/javascript" language="javascript"></script>
<script src="{T_THEME_PATH}/order.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/senlei19.js" type="text/javascript"></script>

<link rel="stylesheet" href="{T_THEME_PATH}/basket.css" type="text/css"/>	

</head>
<body>


<table width="100%" border="0" class="CSSHeaderTable">
  <tr>
    <th colspan="2">{L_BASKET_ITEM}</th>
  </tr>
  <tr>
    <td width="100">Room</td>
    <td>{L_GUEST_ROOMNAME}</td>
  </tr>
  <tr>
    <td>Guest</td>
    <td>{L_GUEST_NAME}</td>
  </tr>
</table>



<div class="CSSTableGenerator">
<form action="basket2.php{S_KEY}" method="post" id="formOrder" >

<table width="100%" border="0">
  <tr>
    <td width="30">{L_QUANTITY}</td>
    <td>{L_ITEM_SELECTED}</td>
	<td width="61">{L_PRICE}</td>
    <td width="83">{L_DELETE_ITEM}</td>
  </tr>
  
  <!-- BEGIN somerow -->
  <tr>
    <td>{somerow.GUEST_QTY}</td>
    <td style="text-align:left;">{somerow.GUEST_ITEM}</td>
	<td style="text-align:right;">{somerow.GUEST_PRICE_ITEM}</td>
    <td><input type="hidden" name="code" value="{somerow.GUEST_ID}"/>	
	<a href="{somerow.U_DELETE}" id="DeleteLink"><img src="{somerow.ICON_PATH}/delete.png" /></a>
	</td>
  </tr>
  <!-- END somerow -->

  <tr>
    <td colspan="4"><input type="hidden" name="code" value="{GUEST_ROOM}"/>
    <input type="hidden" name="roomname" value="{L_GUEST_ROOMNAME}"/>
    <input type="hidden" name="type" value="{L_TYPE}"/>
	<input class="button green close" type="submit" name="btnSubmit" id="btnSubmit" value="{L_CONFIRM}"  autofocus/>
	<input class="button blue close" type="submit" name="btnClear" id="btnClear" value="{L_CLEAR_FORM}" />
	<input class="button red close" type="button" name="btnCancel" id="btnCancel" value="{L_CONTINUE_SHOP}" onclick="parent.$.fancybox.close();" />
	</td>
  </tr>  
 
</table>
</form>
</div>

</body>
</html>
