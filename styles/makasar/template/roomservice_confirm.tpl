<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="{S_CONTENT_DIRECTION}" lang="{S_USER_LANG}" xml:lang="{S_USER_LANG}">
<head>
<link href="{T_THEME_PATH}/pop.css" rel="stylesheet" type="text/css" />
<script src="{T_THEME_PATH}/jquery-1.10.1.min.js"></script>
<script src="{T_THEME_PATH}/jquery.fancybox.js"></script>
<script src="{T_THEME_PATH}/keycode.js" type="text/javascript" language="javascript"></script>
<script src="{T_THEME_PATH}/order.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/senlei19.js" type="text/javascript"></script>
<script>
$(document).keydown(function(e) {
	var key = e.keyCode;
	switch (key) { 
		/*case keyCodes.KEY_red:
			$("#info").focus();
			sss_js_keyboardDisplayInlineFunction();
			break;
		case keyCodes.KEY_enter:
			if($("#qty").focus()) {
				$("#info").blur();
				$("#info").focus();
                        	sss_js_keyboardDisplayInlineFunction();
			}
			break;*/
		case keyCodes.KEY_back:
			parent.$.fancybox.close();
			break;
		case keyCodes.KEY_down:
			/*if($("#qty").focus()) {
				$("#info").focus();
				sss_js_keyboardDisplayInlineFunction();
			} else*/ if($("#qty").focus()) {
				$("#btnSubmit").focus();
			}
			break;
		case keyCodes.KEY_right:
			if($("#btnSubmit").focus()) {
				$("#btnCancel").focus();
			}
			break;
		case keyCodes.KEY_left:
			if($("#btnCancel").focus()) {
                                $("#btnSubmit").focus();
                        }
                        break;
		case keyCodes.KEY_up:
                        if($("#btnCancel").focus() || $("#btnSubmit").focus()) {
                                $("#qty").focus();
                        } /*else if($("#info").focus()) {
				$("#qty").focus();
			}*/
                        break;
	}
});
</script>
<style type="text/css">
  body{ background: #000 no-repeat center top; 
  background-color: #ccc;
  height : 400px;
  width     : 803px;
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
<h1>{L_CONFIRMATION}</h1>
<div>
<form action="{U_ACTION}" method="post" id="formOrder" >
<table style="font-size: 20px; padding: 10px;">
    <!--<tr>
	<td width="30%" align="right" autofocus>{L_PASSWORD}</td>
	<td width="70%"><input type="password" id="password" name="password" autofocus="true" placeholder="{L_PASSWORD}" size="20"/></td>
    </tr>-->
    <tr>
	<td align="right">{L_QUANTITY}</td>
	<!--<td>{S_QUANTITY}</td>-->
	<td><input type="text" id="qty" name="qty" value="" autofocus /></td>
    </tr>
<!--    <tr>
	<td align="right">{L_SPECIAL_REQUEST} *)</td>
	<td><textarea id="info" name="note" type="text" rows="1" cols="30" style="width: 480px; height: 60px; resize: none;" placeholder="{L_SPECIAL_REQUEST}" >{S_NOTE}</textarea>
	</td>
    </tr>-->
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
<!--	<tr><td></td><td><div style="font-size:14px;margin-top:15px;">*) Press <font color="red">red</font> button to enter your special request</div></td></tr>-->
</table>

<script>
$("#formOrder > select").focus();
</script>

<!--
<p style="font-size: 14px;text-align: left;">
</p>
<p style="font-size: 14px;text-align: left;"><br/>
<input type="text" id="quantity" name="qty" placeholder="{L_QUANTITY}" /></p></br>
<p style="font-size: 12px;">
<textarea id="info" name="note" type="text" rows="1" cols="30" style="width: 730px; height: 91px; resize: none;" placeholder="{L_SPECIAL_REQUEST}" ></textarea>
<input type="hidden" name="price" value="{S_PRICE}"/>
<input type="hidden" name="code" value="{S_CODE}"/>
<input type="hidden" name="item_id" value="{S_ITEM_ID}"/>
<input type="hidden" name="gid" value="{S_GID}"/>
<input type="hidden" name="mode" value="{S_MODE}"/>
<input type="hidden" name="type" value="{S_TYPE}"/>

<input class="button green close" type="submit" name="btnSubmit" id="btnSubmit" value="{L_CONFIRM}" />
<input class="button red close" type="button" name="btnCancel" id="btnCancel" value="{L_CANCEL}" onclick="parent.$.fancybox.close();"/>
-->
</form>

</div>

</body>
</html>
