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
  h1 { font-size: 24px; font-family: Arial; font-weight: bold; margin: 10px; }
  .box { width:350px; }

  footer { font-size:12px; }
  form a, footer a { color:#40738d; }
</style>
</head>
<body>
<!--
<div class="divNotification"><center>
	<h1>{L_MESSAGE}</h1>
	<span class="spanNotification">{S_MESSAGE}
	<p>
	<input class="button green big close" type="submit" name="clearbasket" id="btnSubmit" value="OK" onclick="parent.$.fancybox.close();" ></p></span>
    </center></div>
</div>
-->
<h1>{L_MESSAGE}</h1>
<div>
<br/>
<form action="{U_ACTION}" method="post" id="formOrder" >
<table style="font-size: 14px; padding: 10px;" width="100%">
    <tr>
	<td colspan="2" align="center">{L_MESSAGE}</td>
    </tr>
    <tr>
	<td colspan="2" align="center"><span class="spanNotification">{S_MESSAGE}</span></td>
    </tr>
	<td width="45%"></td>
	<td width="55%"><br/><p><input class="button green big close" type="submit" name="clearbasket" id="btnSubmit" value="OK" onclick="parent.$.fancybox.close();" >
	</p></td>
    </tr>
</table>
</form>
</div>





</body>
</html>