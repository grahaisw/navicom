<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="{S_CONTENT_DIRECTION}" lang="{S_USER_LANG}" xml:lang="{S_USER_LANG}">
<head>
<link href="{T_THEME_PATH}/pop.css" rel="stylesheet" type="text/css" />
<script src="{T_THEME_PATH}/jquery-1.10.1.min.js"></script>
<script src="{T_THEME_PATH}/jquery.fancybox.js"></script>
<script src="{T_THEME_PATH}/keycode.js" type="text/javascript" language="javascript"></script>
<script src="{T_THEME_PATH}/order.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/senlei19.js" type="text/javascript"></script>
<script type="text/javascript">
	jQuery(document).ready(function ($) {
		var defaults = {
			width     : 600,
		}
	});	
		
	$(document).keydown(function(e) {
		var key = e.keyCode;
		switch (key) { 
			case keyCodes.KEY_red:
				sss_js_keyboardDisplayInlineFunction();
				break;
			
			case keyCodes.KEY_back:
				return false;
				//break;
			case keyCodes.KEY_down:
				$("#btnSubmit").focus();
				break;
			case keyCodes.KEY_right:
                                $("#btnCancel").focus();
                                break;
			case keyCodes.KEY_left:
                                $("#btnSubmit").focus();
                                break;
			case keyCodes.KEY_up:
                                $("#password").focus();
				sss_js_keyboardDisplayInlineFunction();
                                break;
		}
	});	
		
	
</script>
<link rel="stylesheet" href="{T_THEME_PATH}/basket.css" type="text/css"/>	
<style type="text/css">
body{ background: #000 no-repeat center top; 
  background-color: #ccc;
  height : 400px;
  width  : 800px;
  } 

  #overlay-panel {
		padding: 25px;
  }
  a { color:#999; text-decoration:none; }
  label { display: block; }
  form { margin: 45px 25px; text-align:left }
  form input[type=text] { padding:5px; position:relative;top:0px;border:solid 1px #CCC;}
  form input[type=submit] { padding:2px; position:relative;top:10px;border:solid 1px #CCC;}
  form input[type=button] { padding:2px; position:relative;top:10px;border:solid 1px #CCC;}
  form textarea { padding:5px; width:90%; border:solid 1px #CCC; height:100px;}
  h1 { font-size: 30px; font-family: Arial; font-weight: bold; margin: 30px; }
  .box { width:350px; }

  footer { font-size:12px; }
  form a, footer a { color:#40738d; }
  
</style>
</head>
<body>

<!--<div class="CSSTableGenerator">-->
<!-- IF S_PASSWORD -->
<h1>{L_CONFIRMATION}</h1>
<form action="{U_ACTION}" method="post" id="formOrder" >
<table style="font-size: 20px; padding: 10px; margin-top:30px; width:80%">
<tr>
	<td width="20%" align="right" autofocus>{L_PASSWORD}</td>
	<td width="80%"><input type="password" id="password" name="password" autofocus placeholder="{L_PASSWORD}" size="20"/></td>
</tr>
<tr>
	<td></td>
	<td>
		<input class="button green close" type="submit" name="btnSubmit" id="btnSubmit" value="{L_CONFIRM}" />
		<input class="button red close" type="button" name="btnCancel" id="btnCancel" value="{L_CANCEL}" onclick="parent.$.fancybox.close();"/>
	</td>
</tr>
<!--<tr>
	<td></td>
	<td><div style="font-size:14px;margin-top:15px;">*) Press <font color="red">red</font> button to enter your password</div></td>
</tr>-->
</table>
<input type="hidden" name="roomname" value="{L_GUEST_ROOMNAME}"/>
<input type="hidden" name="type" value="{L_TYPE}"/>
</form>
<!-- ENDIF -->

<!-- IF S_VERIFY_PASSWORD -->
<div align="center" style="font-size:26px;margin-top:50px">Pesanan Anda Telah Dikirim Ke Sistem <br/>Terima Kasih</div>
<div style="font-size:20px;position:relative;top:20px;left:370px"><input class="button green close" type="submit" name="clearbasket" id="btnSubmit" autofocus value="OK" onclick="parent.$.fancybox.close();"  /></div>
<!-- ENDIF -->



<!--</div>-->

</body>
</html>
