<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="{S_CONTENT_DIRECTION}" lang="{S_USER_LANG}" xml:lang="{S_USER_LANG}">
<head>
<link href="{T_THEME_PATH}/pop.css" rel="stylesheet" type="text/css" />

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
    <th colspan="2">{L_TITLE}</th>
  </tr>
  <!-- IF S_VIEW -->
  <tr>
    <td width="150">{L_GUEST}</td>
    <td>{U_ROOMNAME} - {U_GUESTNAME} [{U_RESV_ID}]</td>
  </tr>
  <tr>
    <td>{L_TIME}</td>
    <td>{U_TIME}</td>
  </tr>
  <!-- ENDIF -->
</table>



<div class="CSSTableGenerator">
<form action="{U_ACTION}" method="post" id="formOrder" >
<!-- IF S_VIEW -->
<table width="100%" border="0">
    <tr class="header">
	<td>{L_CODE}</td>
	<td>{L_ITEM}</td>
	<td>{L_QTY}</td>
	<td>{L_PRICE}</td>
	<!-- IF S_NOT_RECEIVED -->
	<!--<td>{L_EDIT}</td>-->
	<!-- ENDIF -->
	<!-- IF S_DELETE -->
	<td>{L_DELETE}</td>
	<!-- ENDIF -->
    </tr>
  
  <!-- BEGIN buffer -->
    <tr class="item">
	<td>{buffer.U_CODE}</td>
	<td>{buffer.U_ITEM} <br/> {buffer.U_NOTE}</td>
	<td>{buffer.U_QTY}</td>
	<td>{buffer.U_PRICE}</td>
	<!-- IF S_NOT_RECEIVED -->
	<!--<td><a href="{buffer.U_EDIT}"><img src="{buffer.ICON_PATH}/edit.png" /></a>-->
	</td><!-- ENDIF -->
	<!-- IF S_DELETE -->
  <td><a href="{buffer.U_DELETE}"><img src="{buffer.ICON_PATH}/delete.png" /></a>
	</td><!-- ENDIF -->
  </tr>
  <!-- END buffer -->
  <tr class="item">
	<td colspan="3" align="right"><strong>{L_SUBTOTAL}</strong></td>
	<td>{U_PRICE}</td>
	<td></td>
  </tr>
  <tr class="item">
	<td colspan="3" align="right"><strong>{L_TOTAL} (incl. 21% Service &amp; Tax)</strong></td>
	<td>{U_PRICE_NETT}</td>
	<td></td>
  </tr>
</table>
<!-- ENDIF -->

<!-- IF S_APPROVED -->
<p>{L_APPROVE_DECLINE} at {S_RECEIVED_DATE}</p>
<!-- ENDIF -->

<!-- IF S_UPDATE -->
<table width="100%" border="0">
    <tr>
	<td colspan="2">{S_ITEM}</td>
    </tr>
    <tr>
	<td width="30%" align="right">{L_QTY}</td>
	<td width="70%">{S_QTY}</td>
    </tr>
    <tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    </tr>
</table>
<!-- ENDIF -->

<center>
<!-- IF S_NOT_RECEIVED -->
<input type="button" name="btnApprove" id="btnApprove" value="{L_APPROVE}" onclick="window.opener.location.href='{U_APPROVE_URL}';window.close();" />&nbsp;
<!--<input type="button" name="btnDecline" id="btnDecline" value="{L_DECLINE}" onclick="window.opener.location.href='{U_DECLINE_URL}';window.close();" />&nbsp;-->
<!-- ENDIF -->

<!-- IF S_DELETE -->
<input type="button" name="btnDecline" id="btnDecline" value="{L_DECLINE}" onclick="window.opener.location.href='{U_DECLINE_URL}';window.close();" />&nbsp;
<!-- ENDIF -->

<!-- IF S_UPDATE --><input type="submit" name="btnSubmit" id="btnSubmit" value="{L_APPROVE}" />&nbsp;
<input type="button" name="btnCancel" id="btnCancel" value="{L_CANCEL}" onclick="window.location.href='{U_CANCEL_URL}';"/><!-- ENDIF -->
<input class="button red close" type="button" name="btnClose" id="btnClose" value="{L_CLOSE}" onclick="window.close();" />
</center>
 

</form>
</div>

</body>
</html>
