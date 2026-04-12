<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="{S_CONTENT_DIRECTION}" lang="{S_USER_LANG}" xml:lang="{S_USER_LANG}">
<head>
<link href="{T_THEME_PATH}/pop.css" rel="stylesheet" type="text/css" />
<script src="{T_THEME_PATH}/jquery-1.10.1.min.js"></script>
<script src="{T_THEME_PATH}/jquery.fancybox.js"></script>
<!--<script src="{T_THEME_PATH}/senlei19.js" type="text/javascript"></script>-->
<script src="{T_THEME_PATH}/keycode.js" type="text/javascript" language="javascript"></script>
<script src="{T_THEME_PATH}/order.js" type="text/javascript"></script>
<!--<script src="{T_THEME_PATH}/senlei19.js" type="text/javascript"></script>-->

<link href="{T_THEME_PATH}/basket.css" rel="stylesheet" type="text/css" />
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
	var pos = $("#focusPos").val();
	var total_data = $("#total_data").val();
	
	switch (key) { 
		case keyCodes.KEY_back:
			return false;
			//break;
		case keyCodes.KEY_right:
			if(pos == 0) {
				$("#btnClear").focus();
				$("#focusPos").val(1);
			} else if(pos == 1) {
				$("#btnCancel").focus();
				$("#focusPos").val(2);
			} 
			break;
		case keyCodes.KEY_left:
			if(pos == 1) {
					$("#btnSubmit").focus();
					$("#focusPos").val(0);
			} else if(pos == 2) {
					$("#btnClear").focus();
					$("#focusPos").val(1);
			}
			break;
		case keyCodes.KEY_up:
			var selected_row = $("#counter").val();
			if(selected_row > 0) {
				if(selected_row < total_data) {
					var next_row = parseInt(selected_row) + parseInt(1);
					$("#row_"+next_row+" td:last img").css('border','0');
					$("#row_"+next_row+" td:last a").blur();
				}
				$("#row_"+selected_row+" td:last img").css('border','1px dotted #000');
				$("#row_"+selected_row+" td:last a").focus();
				var previous_row = selected_row - 1;
				$("#counter").val(previous_row);
			}
			break;
			
		case keyCodes.KEY_down:
			var previous_row = $("#counter").val();
			if(previous_row < total_data) {
				if(previous_row < total_data) {
					var selected_row = parseInt(previous_row) + parseInt(1);
					$("#row_"+previous_row+" td:last img").css('border','0');
					$("#row_"+previous_row+" td:last a").blur();
					
					
				}
				$("#row_"+selected_row+" td:last img").css('border','1px dotted #000');
				$("#row_"+selected_row+" td:last a").focus();
				$("#counter").val(selected_row);
			}
			break;
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
<form action="basket2.php" method="post" id="formOrder" >

<table width="100%" border="1" class="tbl">
  <tr>
    <td width="30">{L_QUANTITY}</td>
    <td colspan="2">{L_ITEM_SELECTED}</td>
	<td width="150">{L_TOTAL_PRICE} *)</td>
	<!--<td width="120">{L_TOTAL_PRICE}</td>-->
    <td width="100">{L_DELETE_ITEM}</td>
  </tr>
  
  <!-- BEGIN somerow -->
  <tr id="row_{somerow.COUNTER}" class="rowContent">
    <td class="alCenter">{somerow.GUEST_QTY}</td>
    <td colspan="2">{somerow.GUEST_ITEM}</td>
	<td class="alRight">{somerow.GUEST_PRICE_ITEM}</td>
	<!--<td class="alRight">{somerow.GUEST_SUBTOTAL_PRICE_ITEM}</td>-->
    <td class="alCenter"><input type="hidden" name="code" value="{somerow.GUEST_ID}"/>	
	<a href="{somerow.U_DELETE}" id="DeleteLink"><img src="{somerow.ICON_PATH}/delete.png" /></a>
	</td>
  </tr>
  <!-- END somerow -->
	
  <!--<tr>
    <td colspan="3" class="alRight"><strong>{L_SUBTOTAL}</strong></td>
	<td class="alRight">{GUEST_TOTAL_PRICE_ITEM}</td>
    <td class="alCenter"></td>
  </tr>-->
  <!-- IF S_PRICE_NETT -->
  <tr>
    <td colspan="3" class="alRight"><strong>{L_TOTAL}</strong></td>
	<td class="alRight">{GUEST_PRICE_NETT}</td>
    <td class="alCenter"></td>
  </tr>
  <!-- ENDIF -->
</table><br/>  
    <div style="width:400px;display:inline-block;">
	<input type="hidden" name="code" id="code" value="{GUEST_ROOM}"/>
    <input type="hidden" name="roomname" id="roomname" value="{L_GUEST_ROOMNAME}"/>
    <input type="hidden" name="type" id="type" value="{L_TYPE}"/>
	<!-- IF S_CONFIRM -->
	<input class="button green close" type="submit" name="btnSubmit" id="btnSubmit" value="{L_CONFIRM}"  autofocus/>
	<input class="button blue close" type="button" name="btnClear" id="btnClear" value="{L_CLEAR_FORM}" onclick="clearBasket();" />
	<!-- ENDIF -->
	<input class="button red close" type="button" name="btnCancel" id="btnCancel" value="{L_CONTINUE_SHOP}" onclick="parent.$.fancybox.close();" {S_AUTOFOCUS} />
	</div>
	<div style="width:320px;display:inline-block;font-family:Arial;margin-left:20px;font-size:16px;">*) {L_PRICE_NOTE}</div>
  
 <input type="hidden" id="focusPos" name="focusPos" value="0" />
 <input type="hidden" id="total_data" name="total_data" value="{S_TOTAL_DATA}" />
 <input type="hidden" id="counter" name="counter" value="{S_TOTAL_DATA}" />

</form>
</div>

</body>
</html>
