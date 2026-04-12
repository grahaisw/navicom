<?php if (!defined('IN_TONJAW')) exit; ?><!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php echo (isset($this->_rootref['PAGE_TITLE'])) ? $this->_rootref['PAGE_TITLE'] : ''; ?></title>
  <link rel="stylesheet" href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/login.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
  <section class="container">
    <div class="login">
      <center><h1><?php echo (isset($this->_rootref['FORM_TITLE'])) ? $this->_rootref['FORM_TITLE'] : ''; ?></h1></center>
      <form name="loginform" id="loginform" method="post" action="<?php echo (isset($this->_rootref['S_LOGIN_ACTION'])) ? $this->_rootref['S_LOGIN_ACTION'] : ''; ?>">
        <p><input type="text" id="user_login" name="log" value="<?php echo ((isset($this->_rootref['L_LOG'])) ? $this->_rootref['L_LOG'] : ((isset($user->lang['LOG'])) ? $user->lang['LOG'] : '{ LOG }')); ?>" placeholder="<?php echo ((isset($this->_rootref['L_USERNAME'])) ? $this->_rootref['L_USERNAME'] : ((isset($user->lang['USERNAME'])) ? $user->lang['USERNAME'] : '{ USERNAME }')); ?>"></p>
        <p><input type="password" name="pwd" value="" placeholder="<?php echo ((isset($this->_rootref['L_PASSWORD'])) ? $this->_rootref['L_PASSWORD'] : ((isset($user->lang['PASSWORD'])) ? $user->lang['PASSWORD'] : '{ PASSWORD }')); ?>"></p>
        <p class="remember_me">
          <label>
            <p><?php echo ((isset($this->_rootref['L_LOGIN_INFO'])) ? $this->_rootref['L_LOGIN_INFO'] : ((isset($user->lang['LOGIN_INFO'])) ? $user->lang['LOGIN_INFO'] : '{ LOGIN_INFO }')); ?></p>
          </label>
        </p>
        <p class="submit"><?php echo (isset($this->_rootref['S_HIDDEN_FIELDS'])) ? $this->_rootref['S_HIDDEN_FIELDS'] : ''; ?><input type="submit" name="wp-submit" value="<?php echo ((isset($this->_rootref['L_LOGIN'])) ? $this->_rootref['L_LOGIN'] : ((isset($user->lang['LOGIN'])) ? $user->lang['LOGIN'] : '{ LOGIN }')); ?>"></p>
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