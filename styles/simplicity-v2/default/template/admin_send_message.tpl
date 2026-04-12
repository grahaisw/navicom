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
    <th>{L_TITLE}</th>
  </tr>
  
</table>

<div class="CSSTableGenerator">
<form action="{U_ACTION}" method="post" id="formOrder" >
<table width="100%" border="0">
    <tr>
	<td align="right">{L_TO}:</td>
	<td>{U_ROOMNAME} - {U_GUESTNAME} [{U_RESV_ID}]</td>
    </tr>
    <tr>
	<td width="25%" align="right">{L_SUBJECT}</td>
	<td width="75%"><input type="text" name="subject" width="200" value="{S_SUBJECT}" autofocus></td>
    </tr>
    <tr>
	<td align="right" valign="top">{L_MESSAGE}</td>
	<td><textarea name="message" cols="60" rows="5">{S_MESSAGE}</textarea>
	{S_FORM_TOKEN}</td>
    </tr>
</table>
<center>

<input type="submit" name="btnSubmit" id="btnSubmit" value="{L_SEND}" onclick="window.opener.location.reload();window.close();" />&nbsp;
<input type="button" name="btnCancel" id="btnCancel" value="{L_CANCEL}" onclick="window.close();"/>
</center>

</form>
</div>

</body>
</html>
