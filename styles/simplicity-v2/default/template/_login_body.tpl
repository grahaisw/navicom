<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" xml:lang="en-us" lang="en-us"><head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="imagetoolbar" content="no">

<title>{PAGE_TITLE}</title>

<link href="{T_THEME_PATH}/adm_navicom.css" rel="stylesheet" type="text/css" media="screen">
</head>

<body class="ltr">

<div id="wrap">

  <div id="login">
	<h1></h1>
	
  <form name="loginform" id="loginform" action="{S_LOGIN_ACTION}" method="post">
    <p>
      <label for="user_login">{L_USERNAME}<br>
      <input name="log" id="user_login" class="input" value="{L_LOG}" size="20" type="text"></label>
    </p>
    <p>
      <label for="user_pass">{L_PASSWORD}<br>
      <input name="pwd" id="user_pass" class="input" value="" size="20" type="password"></label>
    </p>
    <p class="submit">
      {S_HIDDEN_FIELDS}
      <input name="wp-submit" id="wp-submit" class="button-primary" value="{L_LOGIN}" type="submit">
    </p>
  </form>

      {L_LOGIN_INFO}

<script type="text/javascript">
function wp_attempt_focus(){
setTimeout( function(){ try{
d = document.getElementById('user_login');
d.focus();
d.select();
} catch(e){}
}, 200);
}

wp_attempt_focus();
if(typeof wpOnload=='function')wpOnload();
</script>

    </div>

</div>

<!-- INCLUDE overall_footer.tpl -->
