<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>{LOGIN_TITLE}</title>
	<meta name='robots' content='noindex,nofollow' />
</head>
<body class="login login-action-login wp-core-ui">
	<div id="login">
		<h1><a href="http://wordpress.org/" title="Powered by WordPress">{LOGIN_TITLE}</a></h1>
	
<form name="loginform" id="loginform" action="http://localhost/~tonjaw/wordpress/wp-login.php" method="post">
	<p>
		<label for="user_login">{LOGIN_USERNAME}<br />
		<input type="text" name="log" id="user_login" class="input" value="" size="20" /></label>
	</p>
	<p>
		<label for="user_pass">{LOGIN_PASSWORD}<br />
		<input type="password" name="pwd" id="user_pass" class="input" value="" size="20" /></label>
	</p>
		<p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever"  /> </label></p>
	<p class="submit">
		<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="{LOGIN_SUBMIT}" />
		<input type="hidden" name="redirect_to" value="http://localhost/~tonjaw/wordpress/wp-admin/" />
		<input type="hidden" name="testcookie" value="1" />
	</p>
</form>

<p id="nav">
	<a href="http://localhost/~tonjaw/wordpress/wp-login.php?action=lostpassword" title="Password Lost and Found">Lost your password?</a>
</p>

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

	<p id="backtoblog"><a href="http://localhost/~tonjaw/wordpress/" title="Are you lost?">&larr; Back to Testing Wordpress 3.7.1</a></p>
	
	</div>

		<div class="clear"></div>

<!-- INCLUDE overall_footer.tpl -->