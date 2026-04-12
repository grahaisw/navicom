<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>{PAGE_TITLE}</title>
  <link rel="stylesheet" href="{T_THEME_PATH}/login.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
  <section class="container">
    <div class="login">
      <center><h1>{FORM_TITLE}</h1></center>
      <form name="loginform" id="loginform" method="post" action="{S_LOGIN_ACTION}">
        <p><input type="text" id="user_login" name="log" value="{L_LOG}" placeholder="{L_USERNAME}"></p>
        <p><input type="password" name="pwd" value="" placeholder="{L_PASSWORD}"></p>
        <p class="remember_me">
          <label>
            <p>{L_LOGIN_INFO}</p>
          </label>
        </p>
        <p class="submit">{S_HIDDEN_FIELDS}<input type="submit" name="wp-submit" value="{L_LOGIN}"></p>
      </form>
    </div>
    
  </section>

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

</body>
</html>