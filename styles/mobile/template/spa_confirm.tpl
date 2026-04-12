<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="{S_CONTENT_DIRECTION}" lang="{S_USER_LANG}" xml:lang="{S_USER_LANG}">
<head>
<link href="{T_THEME_PATH}/jquery.fancybox.css" rel="stylesheet" type="text/css" />
<link href="{T_THEME_PATH}/roomservice.css" rel="stylesheet" type="text/css" />
<link href="{T_THEME_PATH}/pop.css" rel="stylesheet" type="text/css" />
<script src="{T_THEME_PATH}/jquery-1.10.1.min.js"></script>
<script src="{T_THEME_PATH}/jquery.fancybox.js"></script>
<script src="{T_THEME_PATH}/senlei19.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/keycode.js" type="text/javascript" language="javascript"></script>
<script src="{T_THEME_PATH}/order.js" type="text/javascript"></script>

<style type="text/css">
  body{ background: #000 no-repeat center top; 
  background-color: #ccc;
  Height : 350px;
  width     : 800px;
  } 

  #overlay-panel {
		padding: 25px;
  }
  a { color:#999; text-decoration:none; }
  label { display: block; }
  form { margin: 25px; text-align:left }
  form input[type=text] { padding:5px; position:relative;top:0px;border:solid 1px #CCC;}
  form input[type=submit] { padding:5px; position:relative;top:10px;border:solid 1px #CCC;}
  form input[type=button] { padding:5px; position:relative;top:10px;border:solid 1px #CCC;}
  form textarea { padding:5px; width:90%; border:solid 1px #CCC; height:100px;}
  h1 { font-size: 18px; font-family: Arial; font-weight: bold; margin: 10px; }
  .box { width:350px; }

  footer { font-size:12px; }
  form a, footer a { color:#40738d; }
</style>
</head>
<body>
<h1>{L_CONFIRMATION}</h1>
<div style="width:80%">
<form action="{U_ACTION}" method="post" id="formOrder" >
<table style="font-size: 12px; padding: 10px;">
    <tr>
	<td width="20%" align="right">{L_QUANTITY}</td>
	<td width="70%">{S_QUANTITY}</td>
    </tr>
    <tr>
	<td align="right">{L_TERAPHIST}</td>
	<td>{S_TERAPHIST}</td>
    </tr>
    <tr>
	<td align="right"><!--{L_DATETIME}-->&nbsp;</td>
	<td><!-- <input name="datetime" type="text" id="startdatetime" value="{S_START}" placeholder="{L_DATETIME}" /> -->
	{L_DATE}&nbsp;{S_DATE}&nbsp;
	{L_MONTH}&nbsp;{S_MONTH}&nbsp;
	{L_YEAR}&nbsp;{S_YEAR}&nbsp;
	{L_TIME}&nbsp;{S_TIME}&nbsp;
	</td>
    </tr>
    <tr>
	<td align="right">{L_SPECIAL_REQUEST}</td>
	<td><textarea id="info" name="note" rows="1" cols="30" style="width: 280px; height: 60px; resize: none;" placeholder="{L_SPECIAL_REQUEST}" ></textarea>
	</td>
    </tr>
    <tr>
	<td><input type="hidden" name="price" value="{S_PRICE}"/>
	    <input type="hidden" name="code" value="{S_CODE}"/>
	    <input type="hidden" name="item_id" value="{S_ITEM_ID}"/>
	    <input type="hidden" name="gid" value="{S_GID}"/>
	    <input type="hidden" name="mode" value="{S_MODE}"/>
	    <input type="hidden" name="type" value="{S_TYPE}"/>
	</td>
	<td><input class="button green close" type="submit" name="btnSubmit" id="btnSubmit" value="{L_CONFIRM}" />
<input class="button red close" type="button" name="btnCancel" id="btnCancel" value="{L_CANCEL}" onclick="parent.$.fancybox.close();"/>
	</td>
    </tr>
</table>

</form>

</div>

</body>

</html>
