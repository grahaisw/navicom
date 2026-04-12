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
  form { margin: 25px; text-align:left; font-size:14px; }
  form input[type=text] { padding:5px; position:relative;top:0px;border:solid 1px #CCC;}
  form input[type=submit] { padding:5px; position:relative;top:10px;border:solid 1px #CCC;}
  form input[type=button] { padding:5px; position:relative;top:10px;border:solid 1px #CCC;}
  form textarea { padding:5px; width:90%; border:solid 1px #CCC; height:100px;}
  h1 { font-size: 24px; font-family: Arial; font-weight: bold; margin: 10px; }
  .box { width:350px; }

  footer { font-size:12px; }
  form a, footer a { color:#40738d; }
  
	table, th, td {
    border: 0px solid black;
    border-collapse: collapse;
	}
	th, td { padding: 5px;}
	
</style>
</head>
<body>


<form action="basket.php?o=1" method="post" id="formOrder" >
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <!-- BEGIN somerow -->
  <tr>
    <td>{somerow.GUEST_QTY}</td>
    <td>{somerow.GUEST_ITEM}</td>
    <td><input type="hidden" name="code" value="{somerow.GUEST_ID}"/>
	<a href="{somerow.U_DELETE}" id="DeleteLink"><img src="{somerow.ICON_PATH}/delete.png" /></a>
	</td>
  </tr>
  <!-- END somerow -->

  <tr>
    <td colspan="3"><input type="hidden" name="code" value="{GUEST_ROOM}"/>
	<input class="button green close" type="submit" name="btnSubmit" id="btnSubmit" value="{L_CONFIRM}" />
	<input class="button blue close" type="submit" name="btnClear" id="btnClear" value="{L_CLEAR_FORM}" />
	<input class="button red close" type="button" name="btnCancel" id="btnCancel" value="{L_CANCEL}" />
	</td>
  </tr>  
 
</table>
</form>

</body>
</html>
