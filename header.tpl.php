<?php if (!defined('IN_TONJAW')) exit; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo (isset($this->_rootref['S_CONTENT_DIRECTION'])) ? $this->_rootref['S_CONTENT_DIRECTION'] : ''; ?>" lang="<?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>" xml:lang="<?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Language" content="<?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>">
<meta http-equiv="imagetoolbar" content="no">
<meta http-equiv="expires" content="0">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo (isset($this->_rootref['SITENAME'])) ? $this->_rootref['SITENAME'] : ''; ?></title>

<script type="text/javascript" language="javascript" src="<?php echo (isset($this->_rootref['T_JS_PATH'])) ? $this->_rootref['T_JS_PATH'] : ''; ?>jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo (isset($this->_rootref['T_JS_PATH'])) ? $this->_rootref['T_JS_PATH'] : ''; ?>utils.js"></script>

<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/keycode.js" type="text/javascript" language="javascript"></script>
<!--<script type="text/javascript" src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jquery-2.1.0.min.js"></script>-->

<style type="text/css" media="screen">
    #runningText {
	position: absolute;
	top: 660px;
	background: #000;
	color: #fff;
	font-size: 24px;
	overflow: hidden;
	z-index: 101;
    }
    
    @font-face {
	font-family: navicom-light;
	src: url(<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/FuturaStd-Light.otf);
    }
    
    @font-face {
	font-family: navicom-normal;
	src: url(<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/FuturaStd-Book.otf);
    }
    
    @font-face {
	font-family: navicom-strong;
	src: url(<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/FuturaStd-Heavy.otf);
    }
    
    #divNewMessage{
	position: absolute;
	right: 25px;
	top: 15px;
	color: #fff;
	width: auto;
	height: 25px;
	z-index: 300;
	text-align: right;
	padding:2px;
	background-color:#866A43;
    }
    
    #posterLayer{
	position:absolute;
	left:0px;
	top: 10px; /* top:233px; */
	width:1280px;
	height:85px;
    /*    padding: 20px; */
	/*z-index:2; 
	opacity: 0.7;
	border-bottom: solid 1px #d39a00;
	background-color: #fff; */
	color: #000;
	display: none;
    }
    
    #divLogo {
	position: absolute;
	top: 0px;
	left: 33px;
	width: 183px;
	height: 183px;

	z-index: 50;
	opacity: .9;
    }
	
	@font-face {
	 font-family: 'jp';
	 src: url(<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/hiragino.ttf);
	 }
	  
	 @font-face {
	 font-family: 'cn';
	 src: url(<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/heitiSC.ttf);
	 }
	 
	 @font-face {
	 font-family: 'kr';
	 src: url(<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/senkor.ttf);
	 }
	 
	body {
    font-family: navicom-normal, jp, cn, kr;
	}
	div {
    font-family: navicom-normal, jp, cn, kr;
	}
	h1 {
    font-family: navicom-normal, jp, cn, kr;
	}
	h2 {
    font-family: navicom-normal, jp, cn, kr;
	}
#divWidget {
	position: absolute;
    top:35px;
    right: 30px;
    /*background-color: #fff;*/
    width: 250px;
    height: 80px;
    opacity: 0.7;
}

#divWeather {
	width: 120px;
    height: 80px;
	/*background-color: green;*/
	float:left;
}

#divDate {
	width: 120px;
    height: 20px;
	/*background-color: red;*/
	float:right;
	color:#fff;
	text-align:center;
}

#divClock {
	width: 120px;
    height: 60px;
	/*background-color: blue;*/
	float:right;
	color:#fff;
	font-size:34px;
	text-align:center;
}

#icon {
	background: url('../../../media/images/weathers/256x256/weather.gif') 80px 75px;
}
</style>
<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />


<?php if ($this->_rootref['S_HOME']) {  ?>

<meta http-equiv="refresh" content="5; url=tv_channel.php?" />
<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/home.css" rel="stylesheet" type="text/css" />
<script>
   $(document).keydown(function(e) {
      var key = e.keyCode;
      switch (key) {
                case keyCodes.KEY_home:
                        location.href= 'index.php?menu=1';
                        break;
                 case keyCodes.KEY_back:
//                        window.history.go(-1);
			location.href= 'index.php';
         		break;
      }
  });
</script>

<?php } if ($this->_rootref['S_HOME_GROUP']) {  ?>

<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/hcap.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/log.js" type="text/javascript"></script>
<script type="text/javascript">
    var channelListArray = [
        <?php $_menu_count = (isset($this->_tpldata['menu'])) ? sizeof($this->_tpldata['menu']) : 0;if ($_menu_count) {for ($_menu_i = 0; $_menu_i < $_menu_count; ++$_menu_i){$_menu_val = &$this->_tpldata['menu'][$_menu_i]; ?>

/*      ["<?php echo $_menu_val['S_MENU_TITLE']; ?>", "<?php echo $_menu_val['S_MENU_DESCRIPTION1']; ?>","<?php echo $_menu_val['S_MENU_DESCRIPTION2']; ?>", 0,
        "<?php echo (isset($this->_rootref['T_IMAGESET_PATH'])) ? $this->_rootref['T_IMAGESET_PATH'] : ''; ?>/160x160/<?php echo $_menu_val['S_MENU_THUMBNAIL']; ?>", "<?php echo $_menu_val['S_MENU_URL']; ?>", "<?php echo $_menu_val['S_ID']; ?>"],*/
        ["<?php echo $_menu_val['S_MENU_TITLE']; ?>", "<?php echo $_menu_val['S_MENU_DESCRIPTION1']; ?>","<?php echo $_menu_val['S_MENU_DESCRIPTION2']; ?>", 0,
        "<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/menus/160x160/<?php echo $_menu_val['S_MENU_THUMBNAIL']; ?>", "<?php echo $_menu_val['S_MENU_URL']; ?>", "<?php echo $_menu_val['S_ID']; ?>"],
        <?php }} ?>


    ];
</script>

<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/home.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/home_config_document.js" type="text/javascript"></script>
<script type="text/javascript">
    window.onload = function () {
        //hcap.channel.stopCurrentChannel();
        //media._object.Fn_Play_Pause();
        media._object.Fn_Right_KeyDownHandler();
        //media._object.Fn_Right_KeyDownHandler();
        media._object.Fn_Left_KeyDownHandler();
        timeDisplay.dtetimer();

        divChannelListObj = doc.getElementById("channelList");
        divChannelListObj.appendChild(initCreate());

        currentChannelDisplayObj = doc.getElementById("currentChannelDisplay");
        currentChannelDisplayObj.innerHTML = (channelIndex + 1) + "/" + maxChannel;

        channelNameObj = doc.getElementsByName("channelName");
        infoPlayChanobj = doc.getElementById("nowPlayingChannel");
        divChandescobj = doc.getElementById("channelDesc");
        footerObj = doc.getElementById("footer");
        //playButObj = doc.getElementById("playBut");
        video = doc.getElementById("media");
        video.pause();
        doc.addEventListener("keydown", navigation, true);

    }
</script>
<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/home.css" rel="stylesheet" type="text/css" />
<script>
   $(document).keydown(function(e) {
      var key = e.keyCode;
      switch (key) { 
		case keyCodes.KEY_home:
			location.href= 'index.php?menu=1';
			break;
		 case keyCodes.KEY_back:
			//window.history.go(-1);
			 location.href= 'index.php?menu=1';
		         break; 
     }
   
});
</script>
<style type="text/css">
  body{ background: #fff url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground.jpg) no-repeat center top; }
  #divWidget{display: none;}
</style>
<?php } if ($this->_rootref['S_HOME']) {  ?>

<script type="text/javascript">
    var channelListArray = [  
	<?php $_menu_count = (isset($this->_tpldata['menu'])) ? sizeof($this->_tpldata['menu']) : 0;if ($_menu_count) {for ($_menu_i = 0; $_menu_i < $_menu_count; ++$_menu_i){$_menu_val = &$this->_tpldata['menu'][$_menu_i]; ?>

/*	["<?php echo $_menu_val['S_MENU_TITLE']; ?>", "<?php echo $_menu_val['S_MENU_DESCRIPTION1']; ?>","<?php echo $_menu_val['S_MENU_DESCRIPTION2']; ?>", 0, 
	"<?php echo (isset($this->_rootref['T_IMAGESET_PATH'])) ? $this->_rootref['T_IMAGESET_PATH'] : ''; ?>/160x160/<?php echo $_menu_val['S_MENU_THUMBNAIL']; ?>", "<?php echo $_menu_val['S_MENU_URL']; ?>", "<?php echo $_menu_val['S_ID']; ?>"],*/
	["<?php echo $_menu_val['S_MENU_TITLE']; ?>", "<?php echo $_menu_val['S_MENU_DESCRIPTION1']; ?>","<?php echo $_menu_val['S_MENU_DESCRIPTION2']; ?>", 0, 
	"<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/menus/160x160/<?php echo $_menu_val['S_MENU_THUMBNAIL']; ?>", "<?php echo $_menu_val['S_MENU_URL']; ?>", "<?php echo $_menu_val['S_ID']; ?>"],
	<?php }} ?>


    ];
</script>

<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/home.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/home_config_document.js" type="text/javascript"></script>

<script type="text/javascript">
    window.onload = function () {
	//hcap.channel.stopCurrentChannel();
	//media._object.Fn_Play_Pause();
	media._object.Fn_Right_KeyDownHandler();
	//media._object.Fn_Right_KeyDownHandler();
	media._object.Fn_Left_KeyDownHandler();
	timeDisplay.dtetimer();

	divChannelListObj = doc.getElementById("channelList");
	divChannelListObj.appendChild(initCreate());

	currentChannelDisplayObj = doc.getElementById("currentChannelDisplay");
	currentChannelDisplayObj.innerHTML = (channelIndex + 1) + "/" + maxChannel;

	channelNameObj = doc.getElementsByName("channelName");
	infoPlayChanobj = doc.getElementById("nowPlayingChannel");
	divChandescobj = doc.getElementById("channelDesc");
	footerObj = doc.getElementById("footer");
	//playButObj = doc.getElementById("playBut");
	video = doc.getElementById("media");
	video.pause();
	doc.addEventListener("keydown", navigation, true);

    }
</script>
<!--
<script>
   $(document).keydown(function(e) {
      var key = e.keyCode;
      switch (key) {
          case keyCodes.KEY_back:
               location.href= 'index.php?menu=1';
          break;
      }
  });
</script>
-->
<style type="text/css">
  body{ background: #fff url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground.jpg) no-repeat center top; } 
  #divWidget{display: none;}
</style>

<?php } if ($this->_rootref['S_TV_CHANNEL_GROUP']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/tv_channel_groups.css" rel="stylesheet" type="text/css" />
<!-- <script src="<?php echo (isset($this->_rootref['T_JS_PATH'])) ? $this->_rootref['T_JS_PATH'] : ''; ?>jquery.js" type="text/javascript"></script>
<script src="../theme/_channeldb.js" type="text/javascript"></script> -->
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/hcap.js" type="text/javascript"></script> 
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/log.js" type="text/javascript"></script>
<script type="text/javascript">
    var channelListArray = [  
	<?php echo (isset($this->_rootref['S_GROUPMOVIE'])) ? $this->_rootref['S_GROUPMOVIE'] : ''; ?>

	<?php $_group_count = (isset($this->_tpldata['group'])) ? sizeof($this->_tpldata['group']) : 0;if ($_group_count) {for ($_group_i = 0; $_group_i < $_group_count; ++$_group_i){$_group_val = &$this->_tpldata['group'][$_group_i]; ?>

	["<?php echo $_group_val['S_CAT_TITLE']; ?>", "<?php echo $_group_val['S_URL']; ?>","<?php echo (isset($this->_rootref['T_MEDIA_IMAGE_TV_PATH'])) ? $this->_rootref['T_MEDIA_IMAGE_TV_PATH'] : ''; ?>group/<?php echo $_group_val['S_THUMBNAIL']; ?>.png", 0, "<?php echo $_group_val['S_CAT_URL']; ?>"],
	<?php }} ?>

	["Wonderful Indonesia", "225.1.1.37","./media/images/tv/group/wi.png", 0, "./wi.php"],
    ];
</script>
<!--
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/keycode.js" type="text/javascript"></script>-->
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/tv_channel_groups.js" type="text/javascript"></script> 
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/tv_groups_config_document.js" type="text/javascript"></script> 
<script type="text/javascript">
    window.onload = function () {

	media._object.Fn_Play_Pause();
	media._object.Fn_Right_KeyDownHandler();
	media._object.Fn_Left_KeyDownHandler();
	timeDisplay.dtetimer();

	divChannelListObj = doc.getElementById("channelList");
	divChannelListObj.appendChild(initCreate());

	currentChannelDisplayObj = doc.getElementById("currentChannelDisplay");
	currentChannelDisplayObj.innerHTML = (channelIndex + 1) + "/" + maxChannel;

	channelNameObj = doc.getElementsByName("channelName");
	infoPlayChanobj = doc.getElementById("nowPlayingChannel");
	divChandescobj = doc.getElementById("channelDesc");
	footerObj = doc.getElementById("footer");
	//playButObj = doc.getElementById("playBut");
	video = doc.getElementById("media");
	doc.addEventListener("keydown", navigation, true);
    }

	var color_key_result= $SystemSetting.Set_Color_Key(0.7,34,34,34);
</script>

<script>
   $(document).keydown(function(e) {
      var key = e.keyCode;
      switch (key) {
	   case keyCodes.KEY_home:
               location.href = 'index.php?menu=1';
          break;
          /*case keyCodes.KEY_back:
		var page = $("#currentPage").val();
               location.href = 'index.php?' + page + '&menu=1';
          break;*/
      }
  });
</script>

<style type="text/css">
  body{ background:#000 url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground-channel.jpg) no-repeat center top; } 
  #divWidget{display:none}
</style>
<?php } if ($this->_rootref['S_TV_CHANNEL']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/tv_channels.css" rel="stylesheet" type="text/css" />
<!--<script src="../theme/_channeldb.js" type="text/javascript"></script> -->
<script type="text/javascript">
    var channelListArray = [  
	<?php $_channel_count = (isset($this->_tpldata['channel'])) ? sizeof($this->_tpldata['channel']) : 0;if ($_channel_count) {for ($_channel_i = 0; $_channel_i < $_channel_count; ++$_channel_i){$_channel_val = &$this->_tpldata['channel'][$_channel_i]; ?>

	["<?php echo $_channel_val['S_TITLE']; ?>", "<?php echo $_channel_val['S_URL']; ?>","<?php echo (isset($this->_rootref['T_MEDIA_IMAGE_TV_PATH'])) ? $this->_rootref['T_MEDIA_IMAGE_TV_PATH'] : ''; ?>160x160/<?php echo $_channel_val['S_THUMBNAIL']; ?>", 0, "<?php echo $_channel_val['S_ORDER']; ?>", "<?php echo $_channel_val['S_INDEX']; ?>", "<?php echo $_channel_val['S_ID']; ?>"],
	<?php }} ?>

    ];
</script>
<!--
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/keycode.js" type="text/javascript"></script>-->
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/tv_channels.js" type="text/javascript"></script> 
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/tv_config_document.js" type="text/javascript"></script>
<script type="text/javascript">
    window.onload = function () {
		
    var ch_index = doc.getElementById("ch_index").value;
	for(var i=0; i<=ch_index; i++) { 
		media._object.Fn_Play_Pause();
	   	media._object.Fn_Right_KeyDownHandler();	
	}

	media._object.Fn_Left_KeyDownHandler();
	timeDisplay.dtetimer();

	divChannelListObj = doc.getElementById("channelList");
	divChannelListObj.appendChild(initCreate());

	currentChannelDisplayObj = doc.getElementById("currentChannelDisplay");
	currentChannelDisplayObj.innerHTML = (channelIndex + 1) + "/" + maxChannel;

	channelNameObj = doc.getElementsByName("channelName");
	infoPlayChanobj = doc.getElementById("nowPlayingChannel");
	divChandescobj = doc.getElementById("channelDesc");
	footerObj = doc.getElementById("footer");
	//playButObj = doc.getElementById("playBut");
	video = doc.getElementById("media");
	doc.addEventListener("keydown", navigation, true);
    }

	var color_key_result= $SystemSetting.Set_Color_Key(0.7,34,34,34);
	
	setTimeout(function () {
		media.JS_FullScreen_Function();
		  // media.video.src = channelListArray[media.channelIndex][6];
		}, 5000);
	
	
</script>

<style type="text/css">
  body{ background:#000 url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>bground/<?php echo (isset($this->_rootref['S_BGROUND_CH'])) ? $this->_rootref['S_BGROUND_CH'] : ''; ?>) no-repeat center top; } 
  #divWidget{display:none}
</style>

<?php } if ($this->_rootref['S_TV_CHANNEL_FULLSCREENLG']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/tv_channels_fullscreenlg.css" rel="stylesheet" type="text/css" />
<!-- <script src="<?php echo (isset($this->_rootref['T_JS_PATH'])) ? $this->_rootref['T_JS_PATH'] : ''; ?>jquery.js" type="text/javascript"></script>
<script src="../theme/_channeldb.js" type="text/javascript"></script> -->
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/hcap.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/log.js" type="text/javascript"></script>
<script type="text/javascript">
    var channelListArray = [
        <?php $_channel_count = (isset($this->_tpldata['channel'])) ? sizeof($this->_tpldata['channel']) : 0;if ($_channel_count) {for ($_channel_i = 0; $_channel_i < $_channel_count; ++$_channel_i){$_channel_val = &$this->_tpldata['channel'][$_channel_i]; ?>

        ["<?php echo $_channel_val['S_TITLE']; ?>", "<?php echo $_channel_val['S_URL']; ?>","<?php echo (isset($this->_rootref['T_MEDIA_IMAGE_TV_PATH'])) ? $this->_rootref['T_MEDIA_IMAGE_TV_PATH'] : ''; ?>160x160/<?php echo $_channel_val['S_THUMBNAIL']; ?>", 0, "<?php echo $_channel_val['S_ORDER']; ?>", "<?php echo $_channel_val['S_INDEX']; ?>"],
        <?php }} ?>

    ];

function test_page(url) {
    document.location = url;
}

function channelChangedEventListener(eChCh) {
        console.log("channelChangedEventListener - param.result = " + eChCh.result);
        console.log("channelChangedEventListener - param.errorMessage = " + eChCh.errorMessage);
}
</script>
<!--
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/keycode.js" type="text/javascript"></script>-->
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/tv_channels_fullscreenlg.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/tv_config_document_fullscreenlg.js" type="text/javascript"></script>
<script type="text/javascript">
    window.onload = function () { 
        $("#divLogo").css('top', '-2000px');
	$("#posterLayer").css('top', '-2000px');
	media._object.Fn_Play_Pause();
        media.JS_FullScreen_Function();
		media._object.Fn_Right_KeyDownHandler();
        media._object.Fn_Left_KeyDownHandler();
        timeDisplay.dtetimer();

        divChannelListObj = doc.getElementById("channelList");
        divChannelListObj.appendChild(initCreate());

        currentChannelDisplayObj = doc.getElementById("currentChannelDisplay");
        currentChannelDisplayObj.innerHTML = (channelIndex + 1) + "/" + maxChannel;

        channelNameObj = doc.getElementsByName("channelName");
        infoPlayChanobj = doc.getElementById("nowPlayingChannel");
        divChandescobj = doc.getElementById("channelDesc");
        footerObj = doc.getElementById("footer");
        //playButObj = doc.getElementById("playBut");
        video = doc.getElementById("media");
        doc.addEventListener("keydown", navigation, true);
    }
</script>

<style type="text/css">
  /*body{ background:#000 url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground-channel.jpg) no-repeat center top; }*/
  body{ background:#000; }
</style>

<?php } if ($this->_rootref['S_TV_CHANNEL_FULL']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/tv_channels.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    window.onload = function () {
		video = doc.getElementById("media");	
    }

	var color_key_result= $SystemSetting.Set_Color_Key(0.7,34,34,34);
</script>
<script type="text/javascript">
    var channelListArray = [  
	<?php $_channel_count = (isset($this->_tpldata['channel'])) ? sizeof($this->_tpldata['channel']) : 0;if ($_channel_count) {for ($_channel_i = 0; $_channel_i < $_channel_count; ++$_channel_i){$_channel_val = &$this->_tpldata['channel'][$_channel_i]; ?>

	["<?php echo $_channel_val['S_TITLE']; ?>", "<?php echo $_channel_val['S_URL']; ?>","<?php echo (isset($this->_rootref['T_MEDIA_IMAGE_TV_PATH'])) ? $this->_rootref['T_MEDIA_IMAGE_TV_PATH'] : ''; ?>/b-n-w/<?php echo $_channel_val['S_THUMBNAIL']; ?>", 0, "<?php echo $_channel_val['S_ORDER']; ?>", "<?php echo $_channel_val['S_ID']; ?>"],
	<?php }} ?>

    ];
</script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/tv_channels_full.js" type="text/javascript"></script> 
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/tv_full_config_document.js" type="text/javascript"></script> 
<style type="text/css">
video#media {
    position: fixed; right: 0; bottom: 0;
    min-width: 100%; min-height: 100%;
    width: auto; height: auto; z-index: 100;
    background: #000;
    background-size: cover;
}
body {
    overflow: hidden;
	background:#000 url(<?php echo (isset($this->_rootref['T_IMAGESET_PATH'])) ? $this->_rootref['T_IMAGESET_PATH'] : ''; ?>/bground-polos_high.jpg) no-repeat center top; } 
}
#divLogo {
	display: none;
}
</style>
<?php } if ($this->_rootref['S_MOVIES']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/movie_trailer.css" rel="stylesheet" type="text/css" />
<!--<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/hcap.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/log.js" type="text/javascript"></script>
<script>
hcap.channel.stopCurrentChannel({
     "onSuccess":function() {
         console.log("onSuccess");
     }, 
     "onFailure":function(f) {
         console.log("onFailure : errorMessage = " + f.errorMessage);
     }
});
</script>-->
<script type="text/javascript">
    var channelListArray = [  
	<?php $_movie_count = (isset($this->_tpldata['movie'])) ? sizeof($this->_tpldata['movie']) : 0;if ($_movie_count) {for ($_movie_i = 0; $_movie_i < $_movie_count; ++$_movie_i){$_movie_val = &$this->_tpldata['movie'][$_movie_i]; ?>

	["<?php echo $_movie_val['S_TITLE']; ?>", //0
	"<?php echo $_movie_val['S_TRAILER']; ?>", //1
	"<?php echo $_movie_val['S_DESCRIPTION']; ?>", //2 
	0, //3
	"<?php echo (isset($this->_rootref['T_MEDIA_IMAGE_MOVIE_PATH'])) ? $this->_rootref['T_MEDIA_IMAGE_MOVIE_PATH'] : ''; ?>160x160/<?php echo $_movie_val['S_THUMBNAIL']; ?>.png", //4
	"<?php echo (isset($this->_rootref['T_MEDIA_IMAGE_MOVIE_PATH'])) ? $this->_rootref['T_MEDIA_IMAGE_MOVIE_PATH'] : ''; ?>200x280/<?php echo $_movie_val['S_THUMBNAIL']; ?>.jpg",  //5
	"<?php echo $_movie_val['S_ID']; ?>", //6
	// "{movie.'S_FULL_MOVIE}",
	"<?php echo $_movie_val['L_DIRECTOR']; ?>", //7
	"<?php echo $_movie_val['S_DIRECTOR']; ?>", //8
	"<?php echo $_movie_val['L_CASTS']; ?>", //9
	"<?php echo $_movie_val['S_CASTS']; ?>",  //10
	"<?php echo $_movie_val['L_GENRE']; ?>", //11
	"<?php echo $_movie_val['S_GENRE']; ?>", //12
	"<?php echo $_movie_val['L_PRICE']; ?>", //13
	"<?php echo $_movie_val['S_PRICE']; ?>", //14
	"<?php echo $_movie_val['L_DESCRIPTION']; ?>", //15
	"<?php echo $_movie_val['S_CODE']; ?>", //16
	"<?php echo $_movie_val['S_QTY']; ?>", //17
	"<?php echo $_movie_val['L_CURRENCY']; ?>"], //18
	<?php }} ?>

    ];
</script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/movie_trailer.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/movie_config_document.js" type="text/javascript"></script>

<script type="text/javascript">
    window.onload = function () {
	//doc.getElementById("HomeClip").pause();

	media._object.Fn_Play_Pause();
	media._object.Fn_Right_KeyDownHandler();
	media._object.Fn_Left_KeyDownHandler();
	timeDisplay.dtetimer();

	divChannelListObj = doc.getElementById("channelList");
	divChannelListObj.appendChild(initCreate());

	currentChannelDisplayObj = doc.getElementById("currentChannelDisplay");
	currentChannelDisplayObj.innerHTML = (channelIndex + 1) + "/" + maxChannel;

	channelNameObj = doc.getElementsByName("channelName");
	infoPlayChanobj = doc.getElementById("nowPlayingChannel");
	divChandescobj = doc.getElementById("channelDesc");
	footerObj = doc.getElementById("footer");
	//playButObj = doc.getElementById("playBut");
	video = doc.getElementById("media2");
	doc.addEventListener("keydown", navigation, true);
    }

	var color_key_result= $SystemSetting.Set_Color_Key(0.7,34,34,34);
	
</script>

<script>
   $(document).keydown(function(e) {
      var key = e.keyCode;
      switch (key) {
          case keyCodes.KEY_back:
             //window.history.go(-1);
	     var page = $("#currentPage").val();
	     location.href = 'index.php?' + page + '&menu=1';
          break;
      }
  });
</script>

<style type="text/css">
  body{ background: #fff url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground.jpg) no-repeat center top; } 
  #divWidget{display:none}
</style>
<?php } if ($this->_rootref['S_VOD_FULL']) {  ?>

<style type="text/css">
video#bgvid {
    position: fixed; right: 0; bottom: 0;
    min-width: 100%; min-height: 100%;
    width: auto; height: auto; z-index: 100;
    background: #000;
    background-size: cover;
}
body {
    overflow: hidden;
/*    background: #000 url(<?php echo (isset($this->_rootref['T_IMAGESET_PATH'])) ? $this->_rootref['T_IMAGESET_PATH'] : ''; ?>/bground-panghegar.jpg) top no-repeat; */
}
#divWidget{display:none}
</style>
<script>
   $(document).keydown(function(e) {
      var key = e.keyCode;
      switch (key) {
      	case keyCodes.KEY_back:
               window.history.go(-1);
          break;
      }
  });
</script>
<?php } if ($this->_rootref['S_MUSIC']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/movie_trailer.css" rel="stylesheet" type="text/css" />
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/hcap.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/log.js" type="text/javascript"></script>
<script type="text/javascript">
    var channelListArray = [  
	<?php $_music_count = (isset($this->_tpldata['music'])) ? sizeof($this->_tpldata['music']) : 0;if ($_music_count) {for ($_music_i = 0; $_music_i < $_music_count; ++$_music_i){$_music_val = &$this->_tpldata['music'][$_music_i]; ?>

	["<?php echo $_music_val['S_TITLE']; ?>", //0
	"<?php echo $_music_val['S_TRAILER']; ?>", //1
	"<?php echo $_music_val['S_DESCRIPTION']; ?>", //2 
	0, //3
	"{T_MEDIA_IMAGE_music_PATH}160x160/<?php echo $_music_val['S_THUMBNAIL']; ?>.png", //4
	"{T_MEDIA_IMAGE_music_PATH}200x280/<?php echo $_music_val['S_THUMBNAIL']; ?>.jpg",  //5
	"<?php echo $_music_val['S_ID']; ?>", //6
	// "{music.'S_FULL_music}",
	"<?php echo $_music_val['L_DIRECTOR']; ?>", //7
	"<?php echo $_music_val['S_DIRECTOR']; ?>", //8
	"<?php echo $_music_val['L_CASTS']; ?>", //9
	"<?php echo $_music_val['S_CASTS']; ?>",  //10
	"<?php echo $_music_val['L_GENRE']; ?>", //11
	"<?php echo $_music_val['S_GENRE']; ?>", //12
	"<?php echo $_music_val['L_PRICE']; ?>", //13
	"<?php echo $_music_val['S_PRICE']; ?>", //14
	"<?php echo $_music_val['L_DESCRIPTION']; ?>", //15
	"<?php echo $_music_val['S_CODE']; ?>", //16
	"<?php echo $_music_val['S_QTY']; ?>", //17
	"<?php echo $_music_val['L_CURRENCY']; ?>"], //18
	<?php }} ?>

    ];
</script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/movie_trailer.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/movie_config_document.js" type="text/javascript"></script>

<script type="text/javascript">
    window.onload = function () {
	//doc.getElementById("HomeClip").pause();

	media._object.Fn_Play_Pause();
	media._object.Fn_Right_KeyDownHandler();
	media._object.Fn_Left_KeyDownHandler();
	timeDisplay.dtetimer();

	divChannelListObj = doc.getElementById("channelList");
	divChannelListObj.appendChild(initCreate());

	currentChannelDisplayObj = doc.getElementById("currentChannelDisplay");
	currentChannelDisplayObj.innerHTML = (channelIndex + 1) + "/" + maxChannel;

	channelNameObj = doc.getElementsByName("channelName");
	infoPlayChanobj = doc.getElementById("nowPlayingChannel");
	divChandescobj = doc.getElementById("channelDesc");
	footerObj = doc.getElementById("footer");
	//playButObj = doc.getElementById("playBut");
	video = doc.getElementById("media2");
	doc.addEventListener("keydown", navigation, true);
    }
</script>

<script>
   $(document).keydown(function(e) {
      var key = e.keyCode;
      switch (key) {
          case keyCodes.KEY_back:
             //window.history.go(-1);
	     var page = $("#currentPage").val();
	     location.href = 'index.php?' + page + '&menu=1';
          break;
      }
  });
</script>

<style type="text/css">
  body{ background: #fff url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground.jpg) no-repeat center top; } 
  #divWidget{display:none}
</style>
<?php } if ($this->_rootref['S_DIRECTORY']) {  ?>

<!-- <script src="<?php echo (isset($this->_rootref['T_JS_PATH'])) ? $this->_rootref['T_JS_PATH'] : ''; ?>jquery.js" type="text/javascript"></script> 
<link rel="stylesheet" href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/directory.css">-->
<style type="text/css" media="screen">
body {
    background: #fff url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/<?php echo (isset($this->_rootref['S_BGROUND_IMAGE'])) ? $this->_rootref['S_BGROUND_IMAGE'] : ''; ?>) no-repeat;
    font-family: navicom-normal, jp, cn, kr;
    margin: 0px;
    padding: 0px;
    overflow: hidden;
}

#apDiv2 {
	position:absolute;
	left:220px;
	top:20px;
	width:180px;
	height: 152px;
	z-index:500;
	/*opacity: .8;
	border: 1px solid #7c5b04;*/
	
}
</style>

<!-- <script src="<?php echo (isset($this->_rootref['T_JS_PATH'])) ? $this->_rootref['T_JS_PATH'] : ''; ?>jquery.js" type="text/javascript"></script> -->
<link rel="stylesheet" href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/directory.css">
<!--
<script type="text/javascript" src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jssor.core.js"></script>
<script type="text/javascript" src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jssor.utils.js"></script>-->
<!--<script type="text/javascript" src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jssor.slider-weather.js"></script>-->
<script type="text/javascript" src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jssor.slider.js"></script>
-->
<?php } if ($this->_rootref['S_DIRECTORY_PROMO']) {  ?>

<!-- <script src="<?php echo (isset($this->_rootref['T_JS_PATH'])) ? $this->_rootref['T_JS_PATH'] : ''; ?>jquery.js" type="text/javascript"></script> 
<link rel="stylesheet" href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/directory.css">-->
<style type="text/css" media="screen">
body {
    background: #fff url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/<?php echo (isset($this->_rootref['S_BGROUND_IMAGE'])) ? $this->_rootref['S_BGROUND_IMAGE'] : ''; ?>) no-repeat;
    font-family: navicom-normal, jp, cn, kr;
    margin: 0px;
    padding: 0px;
    overflow: hidden;
}

#apDiv2 {
	position:absolute;
	left:120px;
	top:40px;
	width:180px;
	height: 152px;
	z-index:92;
	/*opacity: .8;
	border: 1px solid #7c5b04;*/
	background: url(<?php echo (isset($this->_rootref['T_IMAGESET_PATH'])) ? $this->_rootref['T_IMAGESET_PATH'] : ''; ?>/logo-black.png) top no-repeat; 
}
</style>

<!-- <script src="<?php echo (isset($this->_rootref['T_JS_PATH'])) ? $this->_rootref['T_JS_PATH'] : ''; ?>jquery.js" type="text/javascript"></script> -->
<link rel="stylesheet" href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/directory.css">
<!--
<script type="text/javascript" src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jssor.core.js"></script>
<script type="text/javascript" src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jssor.utils.js"></script>-->
<!--<script type="text/javascript" src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jssor.slider-weather.js"></script>-->
<script type="text/javascript" src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jssor.slider.js"></script>
-->
<?php } if ($this->_rootref['S_WEATHER']) {  ?>

<!--<link rel="stylesheet" href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/weather.css">
 <script src="<?php echo (isset($this->_rootref['T_JS_PATH'])) ? $this->_rootref['T_JS_PATH'] : ''; ?>jquery.js" type="text/javascript"></script> -->
<style type="text/css" media="screen">
body {
    background: #000 url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/<?php echo (isset($this->_rootref['S_BGROUND_IMAGE'])) ? $this->_rootref['S_BGROUND_IMAGE'] : ''; ?>) top no-repeat;
    
    font-family: navicom-normal, jp, cn, kr;
    color: #fff;
    margin: 0px;
    padding: 0px;
    overflow: hidden;
}
#divWidget{display: none;}

#apDiv2 {
	position:absolute;
	left:1018px;
	top:510px;
	width:180px;
	height: 152px;
	z-index:92;
	opacity: .8;
/*	border: 1px solid #7c5b04;*/
	background: url(<?php echo (isset($this->_rootref['T_IMAGESET_PATH'])) ? $this->_rootref['T_IMAGESET_PATH'] : ''; ?>/logo-white.png) top no-repeat;
}
</style>
<?php } if ($this->_rootref['S_REMOTE']) {  ?>

<style type="text/css">
    body {
	background: #000 url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>remote/<?php echo (isset($this->_rootref['S_LANG'])) ? $this->_rootref['S_LANG'] : ''; ?>/bground-remote.jpg) no-repeat top; 
	font-family: navicom-normal, jp, cn, kr;
	margin: 0px;
	padding: 0px;
	overflow: hidden;
    }
    div.title {
	position: absolute;
	width: 800px;
	left: 290px;
	top: 20px;
    }
    
    h1 {
	color: #7c5b04;
	font-size: 34px;
	font-weight: bold;
	font-family: navicom-normal, jp, cn, kr;
    }
	#divLogo {
	position: absolute;
	top: 0px;
	left: 33px;
	width: 183px;
	height: 183px;
	display: none;
	z-index: 10;
	opacity: .9;
    }
    #hotspot {
    position: absolute;
    top:120px;
    left: 1030px;
    color: #fff;
    width: 170px;
    height: 120px;
    padding: 5px 20px;
    opacity: 0.7;
    }
</style>
<script>
   $(document).keydown(function(e) {
      var key = e.keyCode;
      switch (key) { 
      case keyCodes.KEY_back:
		location.href= 'index.php?menu=1';
         break;
      /*case keyCodes.KEY_blue:
		case keyCodes.KEY_green:
			location.href= 'vod.php';
         break;
		case keyCodes.KEY_yellow:
         location.href= 'inbox.php';
         break;
		case keyCodes.KEY_red:
			location.href= 'tv_channel.php';
         break;
		case keyCodes.KEY_tv:
			location.href= 'tv_channel.php';
         break;
		case keyCodes.KEY_vod:
			location.href= 'vod.php';
         break;
		case keyCodes.KEY_fnb:
			location.href= 'roomservice.php';
         break;
         */   
      }
  });
</script>
<?php } if ($this->_rootref['S_VALAS']) {  ?>

<style type="text/css">
    body{ background: #fff url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground.jpg) no-repeat center top; } 
  #divWidget{display:none}
    div.title {
	position: absolute;
	width: 800px;
	left: 290px;
	top: 20px;
    }
    
    h1 {
	color: #7c5b04;
	font-size: 34px;
	font-weight: bold;
	font-family: navicom-normal, jp, cn, kr;
    }
	#divLogo {
	position: absolute;
	top: 0px;
	left: 33px;
	width: 183px;
	height: 183px;
	display: none;
	z-index: 10;
	opacity: .9;
    }
    #hotspot {
    position: absolute;
    top:120px;
    left: 1030px;
    color: #fff;
    width: 170px;
    height: 120px;
    padding: 5px 20px;
    opacity: 0.7;
    }
</style>
<script>
   $(document).keydown(function(e) {
      var key = e.keyCode;
      switch (key) { 
      case keyCodes.KEY_back:
		location.href= 'index.php?menu=1';
         break;
      /*case keyCodes.KEY_blue:
		case keyCodes.KEY_green:
			location.href= 'vod.php';
         break;
		case keyCodes.KEY_yellow:
         location.href= 'inbox.php';
         break;
		case keyCodes.KEY_red:
			location.href= 'tv_channel.php';
         break;
		case keyCodes.KEY_tv:
			location.href= 'tv_channel.php';
         break;
		case keyCodes.KEY_vod:
			location.href= 'vod.php';
         break;
		case keyCodes.KEY_fnb:
			location.href= 'roomservice.php';
         break;
         */   
      }
  });
</script>
<?php } if ($this->_rootref['S_INFO']) {  ?>

<style type="text/css">
    body{ background: #fff url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground.jpg) no-repeat center top; } 
  #divWidget{display:none}
    div.title {
	position: absolute;
	width: 800px;
	left: 290px;
	top: 20px;
    }
    
    h1 {
	color: #7c5b04;
	font-size: 34px;
	font-weight: bold;
	font-family: navicom-normal, jp, cn, kr;
    }
	#divLogo {
	position: absolute;
	top: 0px;
	left: 33px;
	width: 183px;
	height: 183px;
	display: none;
	z-index: 10;
	opacity: .9;
    }
    #hotspot {
    position: absolute;
    top:120px;
    left: 1030px;
    color: #fff;
    width: 170px;
    height: 120px;
    padding: 5px 20px;
    opacity: 0.7;
    }
</style>
<script>
   $(document).keydown(function(e) {
      var key = e.keyCode;
      switch (key) { 
      case keyCodes.KEY_back:
		location.href= 'index.php?menu=1';
         break;
      /*case keyCodes.KEY_blue:
		case keyCodes.KEY_green:
			location.href= 'vod.php';
         break;
		case keyCodes.KEY_yellow:
         location.href= 'inbox.php';
         break;
		case keyCodes.KEY_red:
			location.href= 'tv_channel.php';
         break;
		case keyCodes.KEY_tv:
			location.href= 'tv_channel.php';
         break;
		case keyCodes.KEY_vod:
			location.href= 'vod.php';
         break;
		case keyCodes.KEY_fnb:
			location.href= 'roomservice.php';
         break;
         */   
      }
  });
</script>
<?php } if ($this->_rootref['S_LOCK']) {  ?>

<meta http-equiv="refresh" content="5;url=index.php">
<script type="text/javascript">
    var channelListArray = [  
	["", "","", 0],
    ];
</script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/keycode-unlock.js" type="text/javascript" language="javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/lock.js" type="text/javascript" language="javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/utils.js" type="text/javascript" language="javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/lock_config_document.js" type="text/javascript" language="javascript"></script>
<style type="text/css">
    body {
	background: #000; 
	font-family: navicom-normal, jp, cn, kr;
	margin: 0px;
	padding: 0px;
	overflow: hidden;
    }
    div.bground {
	position: absolute;
	width: 1280px;
	height: 720px;
	left: 0px;
	top: 0px;
	z-index:0;
	opacity: .5;
	background: url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground.jpg) no-repeat center; 
    }
    
    div.title {
	position: absolute;
	width: 180px;
	height: 180px;
	left: 550px;
	top: 400px;
	z-index: 10;
	background: url(<?php echo (isset($this->_rootref['T_IMAGESET_PATH'])) ? $this->_rootref['T_IMAGESET_PATH'] : ''; ?>/lock.png) no-repeat center; 
    }
    h1 {
	color: #7c5b04;
	font-size: 34px;
	font-weight: bold;
	font-family: navicom-normal, jp, cn, kr;
    }
	
#divChannelCover
{
    position: absolute;
    width: 110px;
    height: 40px;
    left: 574px;
    top: 572px;
    color: white;
    font-size: 28px;
    background-image: url(<?php echo (isset($this->_rootref['T_IMAGESET_PATH'])) ? $this->_rootref['T_IMAGESET_PATH'] : ''; ?>/directentrybox.png);
    background-size: 110px 40px;
    z-index: 22;
    display: block;
}


#divChannelIndexNO
{
    position: relative;
    float: left;
    width: 110px;
    height: 40px;
    line-height: 40px;
    overflow: hidden;
    letter-spacing: 10px;
    text-align: right;
    left: 4px;
}

#divChannelIndexIndicator
{
    position: absolute;
    width: 30px;
    height: 30px;
    left: 110px;
    top: 6px;
    display: none;
    background-image: url(<?php echo (isset($this->_rootref['T_IMAGESET_PATH'])) ? $this->_rootref['T_IMAGESET_PATH'] : ''; ?>/invalid.png);
    background-size: 30px 30px;
}
</style>
<!--<script>
(function(){
    fxm.keycombination = {
        timer: null,
        timerDelay: 1000, // 1 Second
        keyCombination: null,
        startTimer: function(){
            if(this.timer) {
                clearTimeout(this.timer);
            }
            this.timer = setTimeout('fxm.keycombination.clear()', this.timerDelay);
        },

        clear: function (){
            this.keyCombination = null;
        },

        check: function(key){
            if(!this.keyCombination){
                this.keyCombination = String.fromCharCode(key);
            } else {
                this.keyCombination += String.fromCharCode(key);
            }

            if(this.callback && typeof(this.callback) == 'function') this.callback(String(this.keyCombination));
            else this.clear();

            this.startTimer();
        },

        callback: null
    };
    fxm.keycombination.constructor.prototype = new fxm.object;
})();

</script>-->
<script>
<script type='text/javascript'>
      function KeyPress(e) {
      var evtobj = window.event? event : e
      if (evtobj.keyCode == 90 && evtobj.ctrlKey) alert("Ctrl+z");
	 }
document.onkeydown = KeyPress;
    </script>
</script>
<?php } if ($this->_rootref['S_LANGUAGE']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/language.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<?php $_language_count = (isset($this->_tpldata['language'])) ? sizeof($this->_tpldata['language']) : 0;if ($_language_count) {for ($_language_i = 0; $_language_i < $_language_count; ++$_language_i){$_language_val = &$this->_tpldata['language'][$_language_i]; ?>

	["<?php echo $_language_val['S_TITLE']; ?>", "<?php echo $_language_val['S_DESCRIPTION1']; ?>","<?php echo $_language_val['S_DESCRIPTION2']; ?>", 0, 
	"<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/flags/160x160/<?php echo $_language_val['S_FLAG']; ?>", "<?php echo $_language_val['S_URL']; ?>", "<?php echo $_language_val['S_ID']; ?>"],
	<?php }} ?>


    ];
</script>

<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/language.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/language_config_document.js" type="text/javascript"></script>

<script type="text/javascript">
    window.onload = function () {
	media._object.Fn_Play_Pause();
	media._object.Fn_Right_KeyDownHandler();
	media._object.Fn_Left_KeyDownHandler();
	timeDisplay.dtetimer();

	divChannelListObj = doc.getElementById("channelList");
	divChannelListObj.appendChild(initCreate());

	currentChannelDisplayObj = doc.getElementById("currentChannelDisplay");
	currentChannelDisplayObj.innerHTML = (channelIndex + 1) + "/" + maxChannel;

	channelNameObj = doc.getElementsByName("channelName");
	infoPlayChanobj = doc.getElementById("nowPlayingChannel");
	divChandescobj = doc.getElementById("channelDesc");
	footerObj = doc.getElementById("footer");
	//playButObj = doc.getElementById("playBut");
	video = doc.getElementById("media");
	doc.addEventListener("keydown", navigation, true);
    }
</script>

<script>
   $(document).keydown(function(e) {
      var key = e.keyCode;
      switch (key) {
          case keyCodes.KEY_back:
               location.href= 'index.php?menu=1';
          break;
      }
  });
</script>

<style type="text/css">
  body { 
      background: #fff url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground-channel.jpg) no-repeat center top; 
      margin: 0px;
      padding: 0px;
  } 
</style>

<?php } if ($this->_rootref['S_ROOMSERVICE_CATEGORY']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/roomservice_category.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<?php $_category_count = (isset($this->_tpldata['category'])) ? sizeof($this->_tpldata['category']) : 0;if ($_category_count) {for ($_category_i = 0; $_category_i < $_category_count; ++$_category_i){$_category_val = &$this->_tpldata['category'][$_category_i]; ?>

	["<?php echo $_category_val['S_CAT_TITLE']; ?>", "<?php echo $_category_val['S_CAT_URL']; ?>","<?php echo $_category_val['S_DESCRIPTION']; ?>", 0, 
	"<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/fnb/160x160/<?php echo $_category_val['S_THUMBNAIL']; ?>.png", "<?php echo (isset($this->_rootref['T_MEDIA_IMAGE_FNB_PATH'])) ? $this->_rootref['T_MEDIA_IMAGE_FNB_PATH'] : ''; ?>600x400/<?php echo $_category_val['S_THUMBNAIL']; ?>.jpg", "<?php echo (isset($this->_rootref['T_MEDIA_IMAGE_FNB_PATH'])) ? $this->_rootref['T_MEDIA_IMAGE_FNB_PATH'] : ''; ?>680x124/<?php echo $_category_val['S_THUMBNAIL']; ?>.jpg",
	"<?php echo (isset($this->_rootref['T_MEDIA_CLIP_PATH'])) ? $this->_rootref['T_MEDIA_CLIP_PATH'] : ''; ?>roomservice/<?php echo $_category_val['S_CLIP']; ?>"], 
	<?php }} ?>


    ];
</script>

<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/roomservice_category.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/roomservice_category_config_document.js" type="text/javascript"></script>

<script type="text/javascript">
    window.onload = function () {
	media._object.Fn_Play_Pause();
	media._object.Fn_Right_KeyDownHandler();
	media._object.Fn_Left_KeyDownHandler();
	timeDisplay.dtetimer();

	divChannelListObj = doc.getElementById("channelList");
	divChannelListObj.appendChild(initCreate());

	currentChannelDisplayObj = doc.getElementById("currentChannelDisplay");
	currentChannelDisplayObj.innerHTML = (channelIndex + 1) + "/" + maxChannel;

	channelNameObj = doc.getElementsByName("channelName");
	infoPlayChanobj = doc.getElementById("nowPlayingChannel");
	divChandescobj = doc.getElementById("channelDesc");
	footerObj = doc.getElementById("footer");
	//playButObj = doc.getElementById("playBut");
	video = doc.getElementById("media");
	doc.addEventListener("keydown", navigation, true);
    }
</script>

<script>
   $(document).keydown(function(e) {
      var key = e.keyCode;
      switch (key) {
          case keyCodes.KEY_back:
               window.history.go(-1);
          break;
      }
  });
</script>

<style type="text/css">
  body{ background: #000 url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground-fnb.jpg) no-repeat center top; } 
  #divLogo {
        display: none;
}
#divWidget{display:none}
</style>

<?php } if ($this->_rootref['S_ROOMSERVICE']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jquery.fancybox.css" rel="stylesheet" type="text/css" />
<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/roomservice.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<?php $_roomservice_count = (isset($this->_tpldata['roomservice'])) ? sizeof($this->_tpldata['roomservice']) : 0;if ($_roomservice_count) {for ($_roomservice_i = 0; $_roomservice_i < $_roomservice_count; ++$_roomservice_i){$_roomservice_val = &$this->_tpldata['roomservice'][$_roomservice_i]; ?>

	["<?php echo $_roomservice_val['S_TITLE']; ?>", 
	"<?php echo $_roomservice_val['S_URL']; ?>",
	"<?php echo $_roomservice_val['S_DESCRIPTION']; ?>", 
	0, 
	"<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/fnb/160x160/<?php echo $_roomservice_val['S_THUMBNAIL']; ?>.png",
	"<?php echo (isset($this->_rootref['T_MEDIA_IMAGE_FNB_PATH'])) ? $this->_rootref['T_MEDIA_IMAGE_FNB_PATH'] : ''; ?>600x400/<?php echo $_roomservice_val['S_THUMBNAIL']; ?>.jpg",
	"<?php echo (isset($this->_rootref['T_MEDIA_IMAGE_FNB_CAT_PATH'])) ? $this->_rootref['T_MEDIA_IMAGE_FNB_CAT_PATH'] : ''; ?>680x124/<?php echo (isset($this->_rootref['S_GRADIENT_THUMBNAIL'])) ? $this->_rootref['S_GRADIENT_THUMBNAIL'] : ''; ?>.jpg", 
	"<?php echo $_roomservice_val['S_PRICE']; ?>",
	"<?php echo $_roomservice_val['S_CODE']; ?>", 
	"<?php echo $_roomservice_val['S_QTY']; ?>", 
	"<?php echo $_roomservice_val['L_CURRENCY']; ?>", 
	"<?php echo $_roomservice_val['L_PRICE']; ?>",
	"<?php echo $_roomservice_val['S_SERVICE_ID']; ?>",
	"<?php echo $_roomservice_val['S_GID']; ?>",
	"<?php echo $_roomservice_val['S_MODE']; ?>",
	"<?php echo $_roomservice_val['S_TAXINFO']; ?>"],
	<?php }} ?>


    ];
</script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jquery-1.10.1.min.js"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jquery.fancybox.js"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/roomservice.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/roomservice_config_document.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/senlei19.js" type="text/javascript"></script>

<script type="text/javascript">
    window.onload = function () {
	media._object.Fn_Play_Pause();
	media._object.Fn_Right_KeyDownHandler();
	media._object.Fn_Left_KeyDownHandler();
	timeDisplay.dtetimer();

	divChannelListObj = doc.getElementById("channelList");
	divChannelListObj.appendChild(initCreate());

	currentChannelDisplayObj = doc.getElementById("currentChannelDisplay");
	currentChannelDisplayObj.innerHTML = (channelIndex + 1) + "/" + maxChannel;

	channelNameObj = doc.getElementsByName("channelName");
	infoPlayChanobj = doc.getElementById("nowPlayingChannel");
	divChandescobj = doc.getElementById("channelDesc");
	footerObj = doc.getElementById("footer");
	//playButObj = doc.getElementById("playBut");
	video = doc.getElementById("media");
	doc.addEventListener("keydown", navigation, true);
    }
	$(document).ready(function() {
			$('.fancybox').fancybox();
		});
</script>

<script>
   $(document).keydown(function(e) {
      var key = e.keyCode;
      switch (key) {
          case keyCodes.KEY_back:
               window.history.go(-1);
          break;
      }
  });
</script>

<style type="text/css">
  body{ background: #000 url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground-fnb.jpg) no-repeat center top; } 
  #divLogo {
        display: none;
}
#divWidget{display:none}
</style>
<?php } if ($this->_rootref['S_SHOP_CATEGORY']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/shop_category.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<?php $_category_count = (isset($this->_tpldata['category'])) ? sizeof($this->_tpldata['category']) : 0;if ($_category_count) {for ($_category_i = 0; $_category_i < $_category_count; ++$_category_i){$_category_val = &$this->_tpldata['category'][$_category_i]; ?>

	["<?php echo $_category_val['S_CAT_TITLE']; ?>", "<?php echo $_category_val['S_CAT_URL']; ?>","<?php echo $_category_val['S_DESCRIPTION']; ?>", 0, 
	"<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/shop/160x160/<?php echo $_category_val['S_THUMBNAIL']; ?>.png", "<?php echo (isset($this->_rootref['T_MEDIA_IMAGE_SHOP_PATH'])) ? $this->_rootref['T_MEDIA_IMAGE_SHOP_PATH'] : ''; ?>600x400/<?php echo $_category_val['S_THUMBNAIL']; ?>.jpg", "<?php echo (isset($this->_rootref['T_MEDIA_IMAGE_SHOP_PATH'])) ? $this->_rootref['T_MEDIA_IMAGE_SHOP_PATH'] : ''; ?>680x124/<?php echo $_category_val['S_THUMBNAIL']; ?>.jpg",
	"<?php echo (isset($this->_rootref['T_MEDIA_CLIP_PATH'])) ? $this->_rootref['T_MEDIA_CLIP_PATH'] : ''; ?>shop/<?php echo $_category_val['S_CLIP']; ?>"], 
	<?php }} ?>


    ];
</script>

<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/shop_category.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/shop_category_config_document.js" type="text/javascript"></script>

<script type="text/javascript">
    window.onload = function () {
	media._object.Fn_Play_Pause();
	media._object.Fn_Right_KeyDownHandler();
	media._object.Fn_Left_KeyDownHandler();
	timeDisplay.dtetimer();

	divChannelListObj = doc.getElementById("channelList");
	divChannelListObj.appendChild(initCreate());

	currentChannelDisplayObj = doc.getElementById("currentChannelDisplay");
	currentChannelDisplayObj.innerHTML = (channelIndex + 1) + "/" + maxChannel;

	channelNameObj = doc.getElementsByName("channelName");
	infoPlayChanobj = doc.getElementById("nowPlayingChannel");
	divChandescobj = doc.getElementById("channelDesc");
	footerObj = doc.getElementById("footer");
	//playButObj = doc.getElementById("playBut");
	video = doc.getElementById("media");
	doc.addEventListener("keydown", navigation, true);
    }
</script>

<style type="text/css">
  body{ background: #000 url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground.jpg) no-repeat center top; } 
</style>

<?php } if ($this->_rootref['S_SHOP']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jquery.fancybox.css" rel="stylesheet" type="text/css" />
<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/shop.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<?php $_shop_count = (isset($this->_tpldata['shop'])) ? sizeof($this->_tpldata['shop']) : 0;if ($_shop_count) {for ($_shop_i = 0; $_shop_i < $_shop_count; ++$_shop_i){$_shop_val = &$this->_tpldata['shop'][$_shop_i]; ?>

	["<?php echo $_shop_val['S_TITLE']; ?>", 
	"<?php echo $_shop_val['S_URL']; ?>",
	"<?php echo $_shop_val['S_DESCRIPTION']; ?>", 
	0, 
	"<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/shop/160x160/<?php echo $_shop_val['S_THUMBNAIL']; ?>.png",
	"<?php echo (isset($this->_rootref['T_MEDIA_IMAGE_SHOP_PATH'])) ? $this->_rootref['T_MEDIA_IMAGE_SHOP_PATH'] : ''; ?>600x400/<?php echo $_shop_val['S_THUMBNAIL']; ?>.jpg",
	"<?php echo (isset($this->_rootref['T_MEDIA_IMAGE_SHOP_CAT_PATH'])) ? $this->_rootref['T_MEDIA_IMAGE_SHOP_CAT_PATH'] : ''; ?>680x124/<?php echo (isset($this->_rootref['S_GRADIENT_THUMBNAIL'])) ? $this->_rootref['S_GRADIENT_THUMBNAIL'] : ''; ?>.jpg", 
	"<?php echo $_shop_val['S_PRICE']; ?>",
	"<?php echo $_shop_val['S_CODE']; ?>", 
	"<?php echo $_shop_val['S_QTY']; ?>", 
	"<?php echo $_shop_val['L_CURRENCY']; ?>", 
	"<?php echo $_shop_val['L_PRICE']; ?>",
	"<?php echo $_shop_val['S_SERVICE_ID']; ?>",
	"<?php echo $_shop_val['S_GID']; ?>",
	"<?php echo $_shop_val['S_MODE']; ?>"],
	<?php }} ?>


    ];
</script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jquery-1.10.1.min.js"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jquery.fancybox.js"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/shop.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/shop_config_document.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/senlei19.js" type="text/javascript"></script>

<script type="text/javascript">
    window.onload = function () {
	media._object.Fn_Play_Pause();
	media._object.Fn_Right_KeyDownHandler();
	media._object.Fn_Left_KeyDownHandler();
	timeDisplay.dtetimer();

	divChannelListObj = doc.getElementById("channelList");
	divChannelListObj.appendChild(initCreate());

	currentChannelDisplayObj = doc.getElementById("currentChannelDisplay");
	currentChannelDisplayObj.innerHTML = (channelIndex + 1) + "/" + maxChannel;

	channelNameObj = doc.getElementsByName("channelName");
	infoPlayChanobj = doc.getElementById("nowPlayingChannel");
	divChandescobj = doc.getElementById("channelDesc");
	footerObj = doc.getElementById("footer");
	//playButObj = doc.getElementById("playBut");
	video = doc.getElementById("media");
	doc.addEventListener("keydown", navigation, true);
    }
	$(document).ready(function() {
			$('.fancybox').fancybox();
		});
</script>

<style type="text/css">
  body{ background: #000 url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground.jpg) no-repeat center top; } 
</style>
<?php } if ($this->_rootref['S_SPA_CATEGORY']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/spa_category.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<?php $_category_count = (isset($this->_tpldata['category'])) ? sizeof($this->_tpldata['category']) : 0;if ($_category_count) {for ($_category_i = 0; $_category_i < $_category_count; ++$_category_i){$_category_val = &$this->_tpldata['category'][$_category_i]; ?>

	["<?php echo $_category_val['S_CAT_TITLE']; ?>", "<?php echo $_category_val['S_CAT_URL']; ?>","<?php echo $_category_val['S_DESCRIPTION']; ?>", 0, 
	"<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/spa/160x160/<?php echo $_category_val['S_THUMBNAIL']; ?>.png", "<?php echo (isset($this->_rootref['T_MEDIA_IMAGE_SPA_PATH'])) ? $this->_rootref['T_MEDIA_IMAGE_SPA_PATH'] : ''; ?>600x400/<?php echo $_category_val['S_THUMBNAIL']; ?>.jpg", "<?php echo (isset($this->_rootref['T_MEDIA_IMAGE_SPA_PATH'])) ? $this->_rootref['T_MEDIA_IMAGE_SPA_PATH'] : ''; ?>680x124/<?php echo $_category_val['S_THUMBNAIL']; ?>.jpg",
	"<?php echo (isset($this->_rootref['T_MEDIA_CLIP_PATH'])) ? $this->_rootref['T_MEDIA_CLIP_PATH'] : ''; ?>spa/<?php echo $_category_val['S_SPA_CLIP']; ?>"], 
	<?php }} ?>


    ];
</script>

<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/spa_category.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/spa_category_config_document.js" type="text/javascript"></script>

<script type="text/javascript">
    window.onload = function () {
	media._object.Fn_Play_Pause();
	media._object.Fn_Right_KeyDownHandler();
	media._object.Fn_Left_KeyDownHandler();
	timeDisplay.dtetimer();

	divChannelListObj = doc.getElementById("channelList");
	divChannelListObj.appendChild(initCreate());

	currentChannelDisplayObj = doc.getElementById("currentChannelDisplay");
	currentChannelDisplayObj.innerHTML = (channelIndex + 1) + "/" + maxChannel;

	channelNameObj = doc.getElementsByName("channelName");
	infoPlayChanobj = doc.getElementById("nowPlayingChannel");
	divChandescobj = doc.getElementById("channelDesc");
	footerObj = doc.getElementById("footer");
	//playButObj = doc.getElementById("playBut");
	video = doc.getElementById("media");
	doc.addEventListener("keydown", navigation, true);
    }
</script>

<style type="text/css">
  body{ background: #000 url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground.jpg) no-repeat center top; } 
</style>

<?php } if ($this->_rootref['S_SPA']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jquery.fancybox.css" rel="stylesheet" type="text/css" />
<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/spa.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<?php $_spa_count = (isset($this->_tpldata['spa'])) ? sizeof($this->_tpldata['spa']) : 0;if ($_spa_count) {for ($_spa_i = 0; $_spa_i < $_spa_count; ++$_spa_i){$_spa_val = &$this->_tpldata['spa'][$_spa_i]; ?>

	["<?php echo $_spa_val['S_TITLE']; ?>", 
	"<?php echo $_spa_val['S_URL']; ?>",
	"<?php echo $_spa_val['S_DESCRIPTION']; ?>", 
	0, 
	"<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/spa/160x160/<?php echo $_spa_val['S_THUMBNAIL']; ?>.png",
	"<?php echo (isset($this->_rootref['T_MEDIA_IMAGE_SPA_PATH'])) ? $this->_rootref['T_MEDIA_IMAGE_SPA_PATH'] : ''; ?>600x400/<?php echo $_spa_val['S_THUMBNAIL']; ?>.jpg",
	"<?php echo (isset($this->_rootref['T_MEDIA_IMAGE_SPA_CAT_PATH'])) ? $this->_rootref['T_MEDIA_IMAGE_SPA_CAT_PATH'] : ''; ?>680x124/<?php echo (isset($this->_rootref['S_GRADIENT_THUMBNAIL'])) ? $this->_rootref['S_GRADIENT_THUMBNAIL'] : ''; ?>.jpg", 
	"<?php echo $_spa_val['S_PRICE']; ?>",
	"<?php echo $_spa_val['S_CODE']; ?>", 
	"<?php echo $_spa_val['S_QTY']; ?>", 
	"<?php echo $_spa_val['L_CURRENCY']; ?>", 
	"<?php echo $_spa_val['L_PRICE']; ?>",
	"<?php echo $_spa_val['S_SERVICE_ID']; ?>",
	"<?php echo $_spa_val['S_GID']; ?>",
	"<?php echo $_spa_val['S_MODE']; ?>",
	"<?php echo (isset($this->_rootref['T_MEDIA_CLIP_PATH'])) ? $this->_rootref['T_MEDIA_CLIP_PATH'] : ''; ?>spa/<?php echo $_spa_val['S_SPA_CLIP']; ?>"],
	<?php }} ?>


    ];
</script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jquery-1.10.1.min.js"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jquery.fancybox.js"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/spa.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/spa_config_document.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/senlei19.js" type="text/javascript"></script>

<script type="text/javascript">
    window.onload = function () {
	media._object.Fn_Play_Pause();
	media._object.Fn_Right_KeyDownHandler();
	media._object.Fn_Left_KeyDownHandler();
	timeDisplay.dtetimer();

	divChannelListObj = doc.getElementById("channelList");
	divChannelListObj.appendChild(initCreate());

	currentChannelDisplayObj = doc.getElementById("currentChannelDisplay");
	currentChannelDisplayObj.innerHTML = (channelIndex + 1) + "/" + maxChannel;

	channelNameObj = doc.getElementsByName("channelName");
	infoPlayChanobj = doc.getElementById("nowPlayingChannel");
	divChandescobj = doc.getElementById("channelDesc");
	footerObj = doc.getElementById("footer");
	//playButObj = doc.getElementById("playBut");
	video = doc.getElementById("media");
	doc.addEventListener("keydown", navigation, true);
    }
	$(document).ready(function() {
			$('.fancybox').fancybox();
		});
</script>

<style type="text/css">
  body{ background: #000 url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground.jpg) no-repeat center top; } 
</style>
<?php } if ($this->_rootref['S_TOUR_CATEGORY']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/tour_category.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<?php $_category_count = (isset($this->_tpldata['category'])) ? sizeof($this->_tpldata['category']) : 0;if ($_category_count) {for ($_category_i = 0; $_category_i < $_category_count; ++$_category_i){$_category_val = &$this->_tpldata['category'][$_category_i]; ?>

	["<?php echo $_category_val['S_CAT_TITLE']; ?>", "<?php echo $_category_val['S_CAT_URL']; ?>","<?php echo $_category_val['S_DESCRIPTION']; ?>", 0, 
	"<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/tour/160x160/<?php echo $_category_val['S_THUMBNAIL']; ?>.png", "<?php echo (isset($this->_rootref['T_MEDIA_IMAGE_TOUR_PATH'])) ? $this->_rootref['T_MEDIA_IMAGE_TOUR_PATH'] : ''; ?>600x400/<?php echo $_category_val['S_THUMBNAIL']; ?>.jpg", "<?php echo (isset($this->_rootref['T_MEDIA_IMAGE_TOUR_PATH'])) ? $this->_rootref['T_MEDIA_IMAGE_TOUR_PATH'] : ''; ?>680x124/<?php echo $_category_val['S_THUMBNAIL']; ?>.jpg",
	"<?php echo (isset($this->_rootref['T_MEDIA_CLIP_PATH'])) ? $this->_rootref['T_MEDIA_CLIP_PATH'] : ''; ?>tour/<?php echo $_category_val['S_TOUR_CLIP']; ?>"], 
	<?php }} ?>


    ];
</script>

<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/tour_category.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/tour_category_config_document.js" type="text/javascript"></script>

<script type="text/javascript">
    window.onload = function () {
	media._object.Fn_Play_Pause();
	media._object.Fn_Right_KeyDownHandler();
	media._object.Fn_Left_KeyDownHandler();
	timeDisplay.dtetimer();

	divChannelListObj = doc.getElementById("channelList");
	divChannelListObj.appendChild(initCreate());

	currentChannelDisplayObj = doc.getElementById("currentChannelDisplay");
	currentChannelDisplayObj.innerHTML = (channelIndex + 1) + "/" + maxChannel;

	channelNameObj = doc.getElementsByName("channelName");
	infoPlayChanobj = doc.getElementById("nowPlayingChannel");
	divChandescobj = doc.getElementById("channelDesc");
	footerObj = doc.getElementById("footer");
	//playButObj = doc.getElementById("playBut");
	video = doc.getElementById("media");
	doc.addEventListener("keydown", navigation, true);
    }
</script>

<style type="text/css">
  body{ background: #000 url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground.jpg) no-repeat center top; } 
</style>

<?php } if ($this->_rootref['S_TOUR']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jquery.fancybox.css" rel="stylesheet" type="text/css" />
<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/tour.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<?php $_tour_count = (isset($this->_tpldata['tour'])) ? sizeof($this->_tpldata['tour']) : 0;if ($_tour_count) {for ($_tour_i = 0; $_tour_i < $_tour_count; ++$_tour_i){$_tour_val = &$this->_tpldata['tour'][$_tour_i]; ?>

	["<?php echo $_tour_val['S_TITLE']; ?>", 
	"<?php echo $_tour_val['S_URL']; ?>",
	"<?php echo $_tour_val['S_DESCRIPTION']; ?>", 
	0, 
	"<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/tour/160x160/<?php echo $_tour_val['S_THUMBNAIL']; ?>.png",
	"<?php echo (isset($this->_rootref['T_MEDIA_IMAGE_TOUR_PATH'])) ? $this->_rootref['T_MEDIA_IMAGE_TOUR_PATH'] : ''; ?>600x400/<?php echo $_tour_val['S_THUMBNAIL']; ?>.jpg",
	"<?php echo (isset($this->_rootref['T_MEDIA_IMAGE_TOUR_CAT_PATH'])) ? $this->_rootref['T_MEDIA_IMAGE_TOUR_CAT_PATH'] : ''; ?>680x124/<?php echo (isset($this->_rootref['S_GRADIENT_THUMBNAIL'])) ? $this->_rootref['S_GRADIENT_THUMBNAIL'] : ''; ?>.jpg", 
	"<?php echo $_tour_val['S_PRICE']; ?>",
	"<?php echo $_tour_val['S_CODE']; ?>", 
	"<?php echo $_tour_val['S_QTY']; ?>", 
	"<?php echo $_tour_val['L_CURRENCY']; ?>", 
	"<?php echo $_tour_val['L_PRICE']; ?>",
	"<?php echo $_tour_val['S_SERVICE_ID']; ?>",
	"<?php echo $_tour_val['S_GID']; ?>",
	"<?php echo $_tour_val['S_MODE']; ?>",
	"<?php echo (isset($this->_rootref['T_MEDIA_CLIP_PATH'])) ? $this->_rootref['T_MEDIA_CLIP_PATH'] : ''; ?>tour/<?php echo $_tour_val['S_TOUR_CLIP']; ?>"],
	<?php }} ?>


    ];
</script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jquery-1.10.1.min.js"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jquery.fancybox.js"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/tour.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/tour_config_document.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/senlei19.js" type="text/javascript"></script>

<script type="text/javascript">
    window.onload = function () {
	media._object.Fn_Play_Pause();
	media._object.Fn_Right_KeyDownHandler();
	media._object.Fn_Left_KeyDownHandler();
	timeDisplay.dtetimer();

	divChannelListObj = doc.getElementById("channelList");
	divChannelListObj.appendChild(initCreate());

	currentChannelDisplayObj = doc.getElementById("currentChannelDisplay");
	currentChannelDisplayObj.innerHTML = (channelIndex + 1) + "/" + maxChannel;

	channelNameObj = doc.getElementsByName("channelName");
	infoPlayChanobj = doc.getElementById("nowPlayingChannel");
	divChandescobj = doc.getElementById("channelDesc");
	footerObj = doc.getElementById("footer");
	//playButObj = doc.getElementById("playBut");
	video = doc.getElementById("media");
	doc.addEventListener("keydown", navigation, true);
    }
	$(document).ready(function() {
			$('.fancybox').fancybox();
		});
</script>

<style type="text/css">
  body{ background: #000 url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground.jpg) no-repeat center top; } 
</style>
<?php } if ($this->_rootref['S_BASKET']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jquery.fancybox.css" rel="stylesheet" type="text/css" />
<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/basket.css" rel="stylesheet" type="text/css" />

<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jquery-1.10.1.min.js"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/jquery.fancybox.js"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/roomservice.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/roomservice_basket_config_document.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/senlei19.js" type="text/javascript"></script>

<script type="text/javascript">
    window.onload = function () {
	media._object.Fn_Play_Pause();
	media._object.Fn_Right_KeyDownHandler();
	media._object.Fn_Left_KeyDownHandler();
	timeDisplay.dtetimer();

	divChannelListObj = doc.getElementById("channelList");
	divChannelListObj.appendChild(initCreate());

	currentChannelDisplayObj = doc.getElementById("currentChannelDisplay");
	currentChannelDisplayObj.innerHTML = (channelIndex + 1) + "/" + maxChannel;

	channelNameObj = doc.getElementsByName("channelName");
	infoPlayChanobj = doc.getElementById("nowPlayingChannel");
	divChandescobj = doc.getElementById("channelDesc");
	footerObj = doc.getElementById("footer");
	//playButObj = doc.getElementById("playBut");
	video = doc.getElementById("media");
	doc.addEventListener("keydown", navigation, true);
    }
	$(document).ready(function() {
			$('.fancybox').fancybox();
		});
</script>

<style type="text/css">
  body{ background: #000 url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground.jpg) no-repeat center top; } 
</style>

<?php } if ($this->_rootref['S_VIEWBILL']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/viewbill.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<?php $_viewbill_count = (isset($this->_tpldata['viewbill'])) ? sizeof($this->_tpldata['viewbill']) : 0;if ($_viewbill_count) {for ($_viewbill_i = 0; $_viewbill_i < $_viewbill_count; ++$_viewbill_i){$_viewbill_val = &$this->_tpldata['viewbill'][$_viewbill_i]; ?>

	["<?php echo $_viewbill_val['S_DATE']; ?>", "<?php echo $_viewbill_val['S_TITLE']; ?>","<?php echo $_viewbill_val['S_PRICE']; ?>", 0, 
	"<?php echo $_viewbill_val['S_NO']; ?>"],  
	<?php }} ?>


    ];
</script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/viewbill.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/viewbill_config_document.js" type="text/javascript"></script>
<script type="text/javascript">
    window.onload = function () {
	media._object.Fn_Play_Pause();
	media._object.Fn_Right_KeyDownHandler();
	media._object.Fn_Left_KeyDownHandler();
	timeDisplay.dtetimer();

	divChannelListObj = doc.getElementById("channelList");
	divChannelListObj.appendChild(initCreate());

	currentChannelDisplayObj = doc.getElementById("currentChannelDisplay");
	currentChannelDisplayObj.innerHTML = (channelIndex + 1) + "/" + maxChannel;

	channelNameObj = doc.getElementsByName("channelName");
	infoPlayChanobj = doc.getElementById("nowPlayingChannel");
	divChandescobj = doc.getElementById("channelDesc");
	footerObj = doc.getElementById("footer");
	//playButObj = doc.getElementById("playBut");
	video = doc.getElementById("media");
	doc.addEventListener("keydown", navigation, true);
    }
</script>

<script>
   $(document).keydown(function(e) {
      var key = e.keyCode;
      var page = $("#currentPage").val();

      switch (key) {
                case keyCodes.KEY_home:
                        location.href= 'index.php?menu=1';
                        break;
               case keyCodes.KEY_back:
                         //location.href= 'index.php';
			//window.history.back();
			location.href = 'index.php?' + page + '&menu=1';
                        break;
      }
  });
</script>

<style type="text/css">
  body{ background: #000 url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground.jpg) no-repeat center top; } 
  #divWidget{display:none}
</style>

<?php } if ($this->_rootref['S_VIEWORDER']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/vieworder.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<?php $_vieworder_count = (isset($this->_tpldata['vieworder'])) ? sizeof($this->_tpldata['vieworder']) : 0;if ($_vieworder_count) {for ($_vieworder_i = 0; $_vieworder_i < $_vieworder_count; ++$_vieworder_i){$_vieworder_val = &$this->_tpldata['vieworder'][$_vieworder_i]; ?>

	["<?php echo $_vieworder_val['S_DATE']; ?>", "<?php echo $_vieworder_val['S_ITEM']; ?>","<?php echo $_vieworder_val['S_QTY']; ?>", 0, 
	"<?php echo $_vieworder_val['S_NO']; ?>", "<?php echo $_vieworder_val['S_NOTE']; ?>"],  
	<?php }} ?>


    ];
</script>

<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/vieworder.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/vieworder_config_document.js" type="text/javascript"></script>
<script type="text/javascript">
    window.onload = function () {
	media._object.Fn_Play_Pause();
	media._object.Fn_Right_KeyDownHandler();
	media._object.Fn_Left_KeyDownHandler();
	timeDisplay.dtetimer();

	divChannelListObj = doc.getElementById("channelList");
	divChannelListObj.appendChild(initCreate());

	currentChannelDisplayObj = doc.getElementById("currentChannelDisplay");
	currentChannelDisplayObj.innerHTML = (channelIndex + 1) + "/" + maxChannel;

	channelNameObj = doc.getElementsByName("channelName");
	infoPlayChanobj = doc.getElementById("nowPlayingChannel");
	divChandescobj = doc.getElementById("channelDesc");
	footerObj = doc.getElementById("footer");
	//playButObj = doc.getElementById("playBut");
	video = doc.getElementById("media");
	doc.addEventListener("keydown", navigation, true);
    }
</script>

<style type="text/css">
  body{ background: #000 url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground.jpg) no-repeat center top; } 
</style>

<?php } if ($this->_rootref['S_INBOX']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/inbox.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<?php $_inbox_count = (isset($this->_tpldata['inbox'])) ? sizeof($this->_tpldata['inbox']) : 0;if ($_inbox_count) {for ($_inbox_i = 0; $_inbox_i < $_inbox_count; ++$_inbox_i){$_inbox_val = &$this->_tpldata['inbox'][$_inbox_i]; ?>

	["<?php echo $_inbox_val['S_DATE']; ?>", "<?php echo $_inbox_val['S_FROM']; ?>","<?php echo $_inbox_val['S_CONTENT']; ?>", 0, 
	"<?php echo $_inbox_val['S_NO']; ?>", "<?php echo $_inbox_val['S_TIME']; ?>"],
	<?php }} ?>

    ];
</script>

<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/inbox.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/inbox_config_document.js" type="text/javascript"></script>
<script type="text/javascript">
    window.onload = function () {
	//$("#divNewMessage").css();
	media._object.Fn_Play_Pause();
	media._object.Fn_Right_KeyDownHandler();
	media._object.Fn_Left_KeyDownHandler();
	timeDisplay.dtetimer();

	divChannelListObj = doc.getElementById("channelList");
	divChannelListObj.appendChild(initCreate());

	currentChannelDisplayObj = doc.getElementById("currentChannelDisplay");
	currentChannelDisplayObj.innerHTML = (channelIndex + 1) + "/" + maxChannel;

	channelNameObj = doc.getElementsByName("channelName");
	infoPlayChanobj = doc.getElementById("nowPlayingChannel");
	divChandescobj = doc.getElementById("channelDesc");
	footerObj = doc.getElementById("footer");
	//playButObj = doc.getElementById("playBut");
	video = doc.getElementById("media");
	doc.addEventListener("keydown", navigation, true);
    }
</script>

<script>
   $(document).keydown(function(e) {
      var key = e.keyCode;
      switch (key) {
          case keyCodes.KEY_back:
		var page = $("#currentPage").val();
           	location.href = 'index.php?' + page + '&menu=1';
          break;
      }
  });
</script>

<style type="text/css">
  body{ background: #000 url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground.jpg) no-repeat center top; } 
</style>

<?php } if ($this->_rootref['S_CONNECTIVITY']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/connectivity.css" rel="stylesheet" type="text/css" />
<!--<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/connectivity_config_document.js" type="text/javascript"></script>-->
<style type="text/css">
  body{ background: #fff url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground.jpg) no-repeat center top; } 
</style>
<script>
   $(document).keydown(function(e) {
      var key = e.keyCode;
      switch (key) { 
	      case keyCodes.KEY_back:
			location.href= 'index.php';
        		 break;
      case keyCodes.KEY_blue:
		case keyCodes.KEY_green:
			location.href= 'vod.php';
		         break;
		case keyCodes.KEY_yellow:
		         location.href= 'inbox.php';
		         break;
		case keyCodes.KEY_red:
			location.href= 'tv_channel.php';
		         break;
		case keyCodes.KEY_home:
			location.href= 'index.php';
		         break;
		case keyCodes.KEY_tv:
			location.href= 'tv_channel.php';
		         break;
		case keyCodes.KEY_vod:
			location.href= 'vod.php';
		         break;
		case keyCodes.KEY_fnb:
			location.href= 'roomservice.php';
         break;   
      }
  });
</script>
<?php } if ($this->_rootref['S_ROOM_UPDATE']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/room_update.css" rel="stylesheet" type="text/css" />
<!--<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/connectivity_config_document.js" type="text/javascript"></script>-->
<style type="text/css">
  body{ 
      background: #000 url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground.jpg) no-repeat center top; 
      margin: 0px;
      padding: 0px;
      overflow: hidden;
  } 
</style>
<script>
   $(document).keydown(function(e) {
      var key = e.keyCode;
      switch (key) { 
      case keyCodes.KEY_back:
			location.href= 'index.php';
         break; 
/*      case keyCodes.KEY_blue:
		case keyCodes.KEY_green:
			location.href= 'vod.php';
         break;
		case keyCodes.KEY_yellow:
         location.href= 'inbox.php';
         break;
		case keyCodes.KEY_red:
			location.href= 'tv_channel.php';
         break;
		case keyCodes.KEY_home:
			location.href= 'index.php';
         break;
		case keyCodes.KEY_tv:
			location.href= 'tv_channel.php';
         break;
		case keyCodes.KEY_vod:
			location.href= 'vod.php';
         break;
		case keyCodes.KEY_fnb:
			location.href= 'roomservice.php';
         break;*/   
      }
  });
</script>
<?php } if ($this->_rootref['S_FLIGHT']) {  ?>

<meta http-equiv="refresh" content="120">
<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/flight.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<?php $_flight_count = (isset($this->_tpldata['flight'])) ? sizeof($this->_tpldata['flight']) : 0;if ($_flight_count) {for ($_flight_i = 0; $_flight_i < $_flight_count; ++$_flight_i){$_flight_val = &$this->_tpldata['flight'][$_flight_i]; ?>

	["<?php echo $_flight_val['S_AIRLINE']; ?>", 
	"<?php echo $_flight_val['S_FLIGHT']; ?>",
	"<?php echo $_flight_val['S_ORIGIN_DESTINATION']; ?>", 
	0, 
	"<?php echo $_flight_val['S_SCHEDULE']; ?>",
	"<?php echo $_flight_val['S_TERMINAL']; ?>", 
	"<?php echo $_flight_val['S_GATE']; ?>", 
	"<?php echo $_flight_val['S_REMARK']; ?>", 
	"<?php echo $_flight_val['S_TOGGLE_TYPE']; ?>"],
	<?php }} ?>


    ];
</script>

<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/flight.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/flight_config_document.js" type="text/javascript"></script>
<script type="text/javascript">
    window.onload = function () {
	media._object.Fn_Play_Pause();
	media._object.Fn_Right_KeyDownHandler();
	media._object.Fn_Left_KeyDownHandler();
	timeDisplay.dtetimer();

	divChannelListObj = doc.getElementById("channelList");
	divChannelListObj.appendChild(initCreate());

	currentChannelDisplayObj = doc.getElementById("currentChannelDisplay");
	currentChannelDisplayObj.innerHTML = (channelIndex + 1) + "/" + maxChannel;

	channelNameObj = doc.getElementsByName("channelName");
	infoPlayChanobj = doc.getElementById("nowPlayingChannel");
	divChandescobj = doc.getElementById("channelDesc");
	footerObj = doc.getElementById("footer");
	//playButObj = doc.getElementById("playBut");
	video = doc.getElementById("media");
	doc.addEventListener("keydown", navigation, true);
    }
</script>

<style type="text/css">
  body{ 
      background: #000 url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground.jpg) no-repeat center top; 
      margin: 0px;
      padding: 0px;
      } 
	#divWidget{display: none;}
</style>

<?php } if ($this->_rootref['S_WELCOME']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/welcome.css" rel="stylesheet" type="text/css" />
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/hcap.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/log.js" type="text/javascript"></script>
<script>
hcap.channel.stopCurrentChannel({
     "onSuccess":function() {
         console.log("onSuccess");
     }, 
     "onFailure":function(f) {
         console.log("onFailure : errorMessage = " + f.errorMessage);
     }
});
</script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/welcome.js" type="text/javascript"></script> 
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/welcome_config_document.js" type="text/javascript"></script> 
<script type="text/javascript">
    window.onload = function () {
	//media._object.Fn_Play_Pause();
	/*media._object.Fn_Right_KeyDownHandler();
	media._object.Fn_Left_KeyDownHandler();
	timeDisplay.dtetimer();

	divChannelListObj = doc.getElementById("channelList");
	divChannelListObj.appendChild(initCreate());

	currentChannelDisplayObj = doc.getElementById("currentChannelDisplay");
	currentChannelDisplayObj.innerHTML = (channelIndex + 1) + "/" + maxChannel;

	channelNameObj = doc.getElementsByName("channelName");
	infoPlayChanobj = doc.getElementById("nowPlayingChannel");
	divChandescobj = doc.getElementById("channelDesc");
	footerObj = doc.getElementById("footer");
	//playButObj = doc.getElementById("playBut");
	*/
	video = doc.getElementById("HomeClip");
	//doc.addEventListener("keydown", navigation, true);
    }

function test_page(url) {
    document.location = url;
}

function channelChangedEventListener(eChCh) {
        console.log("channelChangedEventListener - param.result = " + eChCh.result);
        console.log("channelChangedEventListener - param.errorMessage = " + eChCh.errorMessage);
}

</script>
<script>
    $(document).keydown(function(e) {
	var key = e.keyCode;
	switch (key) { 
	    case keyCodes.KEY_enter:
		location.href= '<?php echo (isset($this->_rootref['S_HOME_MENU_URL'])) ? $this->_rootref['S_HOME_MENU_URL'] : ''; ?>';
		break;    

	    case keyCodes.KEY_red:
		location.href= 'guestgroup.php';
		break;
	}
    });
</script>

<style type="text/css">
  body{ background: #000 url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground-welcome.jpg) no-repeat center top; } 
  #divWidget{display:none}
</style>
<?php } if ($this->_rootref['S_WI']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/wi.css" rel="stylesheet" type="text/css" />
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/hcap.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/log.js" type="text/javascript"></script>
<script>
var param = {
                        "channelType":hcap.channel.ChannelType.IP,
                        "ip":"225.1.1.37",
                        "port":1234,
                        "ipBroadcastType":hcap.channel.IpBroadcastType.UDP
                };

                hcap.channel.requestChangeCurrentChannel(param);

hcap.video.setVideoSize({
                "x":0,
                "y":0,
                "width":1280,
                "height":720,
                 "onSuccess":function() {
                        console.log("onSuccess");
                },
                "onFailure":function(f) {
                        console.log("onFailure : errorMessage = " + f.errorMessage);
                }
        });
</script>
<script type="text/javascript">
    window.onload = function () {

    }

function test_page(url) {
    document.location = url;
}

function channelChangedEventListener(eChCh) {
        console.log("channelChangedEventListener - param.result = " + eChCh.result);
        console.log("channelChangedEventListener - param.errorMessage = " + eChCh.errorMessage);
		}

</script>
<script>
    $(document).keydown(function(e) {
        var key = e.keyCode;
        switch (key) {
            case keyCodes.KEY_enter:
                location.href= 'tv_channel.php?group_id=9&menu=1';
                break;
            case keyCodes.KEY_back:
                location.href= 'tv_channel.php?group_id=9&menu=1';
                break;
           case keyCodes.KEY_home:
                location.href= 'index.php?menu=1';
                break;
        }
    });
</script>

<style type="text/css">
  /*body{ background: #000 url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground-welcome1.jpg) no-repeat center top; }*/
  #divWidget{display:none}
</style>
<?php } if ($this->_rootref['S_GM']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/wi.css" rel="stylesheet" type="text/css" />
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/hcap.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/log.js" type="text/javascript"></script>
<script>
var param = {
                        "channelType":hcap.channel.ChannelType.IP,
                        "ip":"225.1.1.5",
                        "port":1234,
                        "ipBroadcastType":hcap.channel.IpBroadcastType.UDP
                };

                hcap.channel.requestChangeCurrentChannel(param);

hcap.video.setVideoSize({
                "x":0,
                "y":0,
                "width":1280,
                "height":720,
                 "onSuccess":function() {
                        console.log("onSuccess");
                },
                "onFailure":function(f) {
                        console.log("onFailure : errorMessage = " + f.errorMessage);
                }
        });
</script>
<script type="text/javascript">
    window.onload = function () {

    }

function test_page(url) {
    document.location = url;
}

function channelChangedEventListener(eChCh) {
        console.log("channelChangedEventListener - param.result = " + eChCh.result);
        console.log("channelChangedEventListener - param.errorMessage = " + eChCh.errorMessage);
		}

</script>
<script>
    $(document).keydown(function(e) {
        var key = e.keyCode;
        switch (key) {
            /*case keyCodes.KEY_enter:
                location.href= 'tv_channel.php?group_id=9&menu=1';
                break;*/
            case keyCodes.KEY_back:
                 window.history.go(-1);
                break;
           case keyCodes.KEY_home:
                location.href= 'index.php?menu=1';
                break;
        }
    });
</script>

<style type="text/css">
  /*body{ background: #000 url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground-welcome1.jpg) no-repeat center top; }*/
  #divWidget{display:none}
</style>
<?php } if ($this->_rootref['S_WHATSON']) {  ?>

<!--<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/whatson.css" rel="stylesheet" type="text/css" />-->
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/hcap.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/log.js" type="text/javascript"></script>
<script>
var param = {
                        "channelType":hcap.channel.ChannelType.IP,
                        "ip":"224.2.2.55",
                        "port":1234,
                        "ipBroadcastType":hcap.channel.IpBroadcastType.UDP
                };

                hcap.channel.requestChangeCurrentChannel(param);

hcap.video.setVideoSize({
                "x":0,
                "y":0,
                "width":1280,
                "height":720,
                 "onSuccess":function() {

                        console.log("onSuccess");
                },
                "onFailure":function(f) {
                        console.log("onFailure : errorMessage = " + f.errorMessage);
                }
        });
</script>
<script type="text/javascript">
    window.onload = function () {

    }

function test_page(url) {
    document.location = url;
}

function channelChangedEventListener(eChCh) {
        console.log("channelChangedEventListener - param.result = " + eChCh.result);
        console.log("channelChangedEventListener - param.errorMessage = " + eChCh.errorMessage);
                }

</script>
<script>
    $(document).keydown(function(e) {
        var key = e.keyCode;
        switch (key) {
            /*case keyCodes.KEY_enter:
                location.href= 'tv_channel.php?group_id=9&menu=1';
                break;*/
            case keyCodes.KEY_back:
                location.href= 'index.php?menu=1';
                break;
           case keyCodes.KEY_home:
                location.href= 'index.php?menu=1';
                break;
        }
    });
</script>

<style type="text/css">
  /*body{ background: #000 url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground-welcome1.jpg) no-repeat center top; }*/
  #divWidget{display:none}
</style>
<?php } if ($this->_rootref['S_VIDEO']) {  ?>

<!--<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/whatson.css" rel="stylesheet" type="text/css" />-->
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/hcap.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/log.js" type="text/javascript"></script>
<script>
var param = {
                        "channelType":hcap.channel.ChannelType.IP,
                        "<?php echo (isset($this->_rootref['S_VIDEO'])) ? $this->_rootref['S_VIDEO'] : ''; ?>",
                        "port":1234,
                        "ipBroadcastType":hcap.channel.IpBroadcastType.UDP
                };

                hcap.channel.requestChangeCurrentChannel(param);

hcap.video.setVideoSize({
                "x":0,
                "y":0,
                "width":1280,
                "height":720,
                 "onSuccess":function() {

                        console.log("onSuccess");
                },
                "onFailure":function(f) {
                        console.log("onFailure : errorMessage = " + f.errorMessage);
                }
        });
</script>
<script type="text/javascript">
    window.onload = function () {

    }

function test_page(url) {
    document.location = url;
}

function channelChangedEventListener(eChCh) {
        console.log("channelChangedEventListener - param.result = " + eChCh.result);
        console.log("channelChangedEventListener - param.errorMessage = " + eChCh.errorMessage);
                }

</script>
<script>
    $(document).keydown(function(e) {
        var key = e.keyCode;
        switch (key) {
            /*case keyCodes.KEY_enter:
                location.href= 'tv_channel.php?group_id=9&menu=1';
                break;*/
            case keyCodes.KEY_back:
                location.href= 'index.php?menu=1';
                break;
           case keyCodes.KEY_home:
                location.href= 'index.php?menu=1';
                break;
        }
    });
</script>

<style type="text/css">
  /*body{ background: #000 url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground-welcome1.jpg) no-repeat center top; }*/
  #divWidget{display:none}
</style>
<?php } if ($this->_rootref['S_SENDMESSAGE']) {  ?>

<link rel="stylesheet" type="text/css" href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/sendmessage.css" />
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/sendmessage.js" type="text/javascript" language="javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/senlei19-sendmessage.js" type="text/javascript"></script>
<style type="text/css" media="screen">
body {
    background: #000 url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground.jpg) no-repeat center top; 
    margin: 0px;
    padding: 0px;
    font: 100%/1.4 navicom-normal;
    overflow: hidden;
}
#divWidget{display: none;}
</style>
<?php } if ($this->_rootref['S_FULLSCREEN_GROUP']) {  ?>

<style type="text/css" media="screen">
body {
    /*background: #fff url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground-dir.jpg) no-repeat;*/
    font-family: navicom-normal, jp, cn, kr;
    margin: 0px;
    padding: 0px;
    overflow: hidden;
}

#apDiv2 {
        color:#fff;
        width:400px;
        height:200px;
        position:absolute;
        top:260px;
        left:810px;
        font-size:22px;
}
#pageTitle {
    position: absolute;
    top: 70px;
    font-size: 44px;
    font-weight: bold;
    text-align: right;
    font-family: navicom-normal, jp, cn, kr;
    color: yellow; /*#7c5b04; */
    /*background: #140905;*/
        right:40px;
        padding-top:5px;
}
#apDiv5 {
        position: absolute;
    top: 70px;
    height: 63px;
    width: 400px;
    font-size: 44px;
    font-weight: bold;
    text-align: right;
    font-family: navicom-normal, jp, cn, kr;
    color: yellow; /*#7c5b04; */
    background: #000;
    z-index: 4;
        right:30px;
        opacity: 0.1;
        padding-right: 10px;
}

#apDiv6 {
        width:610px;
        height:410px;
        position:absolute;
        top:193px;
        left:73px;
        border:2px solid #774F26;
        border-radius:5px;
}
#divLogo {
        display: none;
}
#divWidget{display:none}
</style>
<link rel="stylesheet" href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/fitness.css">
<script>
   $(document).keydown(function(e) {
      var key = e.keyCode;
      var page = $("#currentPage").val();

      switch (key) {
                case keyCodes.KEY_home:
                        location.href= 'index.php?menu=1';
                        break;
               case keyCodes.KEY_back:
                        location.href = 'index.php?menu=1';
//                        window.history.go(-1);
                         break;
                /*case keyCodes.KEY_0:
                        location.href='index.php?' + page + '&menu=1';
                        break;*/
      }
  });
</script>
<?php } if ($this->_rootref['S_ROOMSUITES']) {  ?>

<style type="text/css" media="screen">
body {
    background: #fff url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground-dir.jpg) no-repeat;
    font-family: navicom-normal, jp, cn, kr;
    margin: 0px;
    padding: 0px;
    overflow: hidden;
}
#divWidget{display: none;}

#apDiv2 {
	color:#fff;
	width:400px;
	height:200px;
	position:absolute;
	top:260px;
	left:810px;
	font-size:22px;
}
#pageTitle {
    position: absolute;
    top: 70px;
    font-size: 44px;
    font-weight: bold;
    text-align: right;
    font-family: navicom-normal, jp, cn, kr;
    color: yellow; /*#7c5b04; */
    /*background: #140905;*/
	right:40px;
	padding-top:5px;
}

#apDiv5 {
	position: absolute;
    top: 70px;
    height: 63px;
    width: 400px;
    font-size: 44px;
    font-weight: bold;
    text-align: right;
    font-family: navicom-normal, jp, cn, kr;
    color: yellow; /*#7c5b04; */
    background: #000;
    z-index: 4;
	right:30px;
	opacity: 0.1;
	padding-right: 10px;
}

#apDiv6 {
	width:610px;
	height:410px;
	position:absolute;
	top:193px;
	left:73px;
	border:2px solid #774F26;
	border-radius:5px;
}
#divLogo {
	display: none;
}
#divWidget{display:none}
</style>
<link rel="stylesheet" href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/fitness.css">
<script>
   $(document).keydown(function(e) {
      var key = e.keyCode;
      var page = $("#currentPage").val();
      
      switch (key) {
                case keyCodes.KEY_home:
                        location.href= 'index.php?menu=1';
                        break;
               case keyCodes.KEY_back:
			location.href = 'index.php?' + page + '&menu=1';
//                        window.history.go(-1);
		         break;
		/*case keyCodes.KEY_0:
			location.href='index.php?' + page + '&menu=1';
			break;*/
      }		
  });
</script>
<?php } if ($this->_rootref['S_INHOUSE']) {  ?>

<style type="text/css" media="screen">
body {
    background: #fff url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground.jpg) no-repeat;
    font-family: navicom-normal, jp, cn, kr;
    margin: 0px;
    padding: 0px;
    overflow: hidden;
}

#apDiv2 {
	color:#fff;
	width:400px;
	height:200px;
	position:absolute;
	top:260px;
	left:810px;
	font-size:22px;
}
#pageTitle {
    position: absolute;
    top: 70px;
    font-size: 44px;
    font-weight: bold;
    text-align: right;
    font-family: navicom-normal, jp, cn, kr;
    color: yellow; /*#7c5b04; */
    /*background: #140905;*/
	right:40px;
	padding-top:5px;
}

#apDiv5 {
	position: absolute;
    top: 70px;
    height: 63px;
    width: 400px;
    font-size: 44px;
    font-weight: bold;
    text-align: right;
    font-family: navicom-normal, jp, cn, kr;
    color: yellow; /*#7c5b04; */
    background: #000;
    z-index: 4;
	right:30px;
	opacity: 0.1;
	padding-right: 10px;
}

#apDiv6 {
	width:1093px;
	height:720px;
	position:absolute;
	top:0px;
	left:26px;
	border:2px solid #774F26;
	border-radius:5px;
}
#divLogo {
	display: none;
}
</style>
<link rel="stylesheet" href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/fitness.css">
<script>
   $(document).keydown(function(e) {
      var key = e.keyCode;
      switch (key) {
                case keyCodes.KEY_home:
                        location.href= 'index.php?menu=1';
                        break;
               case keyCodes.KEY_back:
                        //window.history.go(-1);
			 var page = $("#currentPage").val();
                        location.href = 'index.php?' + page + '&menu=1';
         break;
      }
  });
</script>


<?php } if ($this->_rootref['S_DIGITALSIGNAGE']) {  ?>

<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/hcap.js" type="text/javascript"></script>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/log.js" type="text/javascript"></script>
<script>
hcap.channel.stopCurrentChannel({
     "onSuccess":function() {
         console.log("onSuccess");
     }, 
     "onFailure":function(f) {
         console.log("onFailure : errorMessage = " + f.errorMessage);
     }
});

function test_page(url) {
    document.location = url;
}

function channelChangedEventListener(eChCh) {
        console.log("channelChangedEventListener - param.result = " + eChCh.result);
        console.log("channelChangedEventListener - param.errorMessage = " + eChCh.errorMessage);
}

</script>

<?php } if ($this->_rootref['S_IMAGE_GROUP']) {  ?>

<style type="text/css" media="screen">
body {
    background: #fff url(<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>/bground/bground-group.jpg) no-repeat;
    font-family: navicom-normal, jp, cn, kr;
    margin: 0px;
    padding: 0px;
    overflow: hidden;
}
#divLogo {
	display: none;
}
#divWidget{display:none}
</style>
<link rel="stylesheet" href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/fitness.css">
<script>
   $(document).keydown(function(e) {
      var key = e.keyCode;
      var page = $("#currentPage").val();
      
      switch (key) {
                case keyCodes.KEY_home:
                        location.href= 'index.php?menu=1';
                        break;
               case keyCodes.KEY_back:
			location.href = 'index.php?menu=1';
//                        window.history.go(-1);
		         break;
		/*case keyCodes.KEY_0:
			location.href='index.php?' + page + '&menu=1';
			break;*/
      }		
  });
</script>
<?php } ?>


<!--<style>
	@font-face {
	 font-family: 'jp';
	 src: url(<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/hiragino.ttf);
	 }
	  
	 @font-face {
	 font-family: 'cn';
	 src: url(<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/heitiSC.ttf);
	 }
	 
	 @font-face {
	 font-family: 'kr';
	 src: url(<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/AppleGothic.ttf);
	 }
	 
	 body {
    font-family: <?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>;
	}
	div {
    font-family: <?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>;
	}
	h2 {
    font-family: <?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>;
	}
</style>-->
<script>
   $(document).keydown(function(e) {
      var key = e.keyCode;
      switch (key) { 
		case keyCodes.KEY_home:
			location.href= 'index.php?menu=1';
			break;
/*		 case keyCodes.KEY_back:
			window.history.go(-1);
  		        break;
		case keyCodes.461:
			window.history.go(-1);
			break;*/
/*		case keyCodes.KEY_blue:
			location.href= 'vod.php';
         		break;
		case keyCodes.KEY_fnb:
			location.href= 'roomservice.php';
			break; */
		/*case keyCodes.KEY_green:*/	  
		case keyCodes.KEY_yellow:
	                location.href= 'inbox.php';
			break;  
		case keyCodes.KEY_blue:
                        location.href= 'inbox.php';
                        break;
      }
  });

/*
function keyCode(event) {
    var x = event.keyCode;
    if (x == 461) {
        window.history.go(-1);
    }
}
*/
</script>
</head>

<body id="b1" class="ltr" <?php echo (isset($this->_rootref['S_ONMOUSEDOWN'])) ? $this->_rootref['S_ONMOUSEDOWN'] : ''; ?>>

<div id="nonemergency">
	<div id="posterLayer"></div>
	<!--<div id="divLogo"><img src="<?php echo (isset($this->_rootref['T_IMAGESET_PATH'])) ? $this->_rootref['T_IMAGESET_PATH'] : ''; ?>/logo.jpg" height="183px" width="183px"></div>-->
<input type="hidden" name="idx" id="idx" value="" />
<input type="hidden" name="currentPage" id="currentPage" value="<?php echo (isset($this->_rootref['S_CURRENT_PAGE'])) ? $this->_rootref['S_CURRENT_PAGE'] : ''; ?>" />
<div id="divWidget">
	<div id="divWeather">
		<div style="text-align:right;font-size:16px;color:#fff;"><?php echo (isset($this->_rootref['S_WIDGET_CITY'])) ? $this->_rootref['S_WIDGET_CITY'] : ''; ?></div>
		<img src="<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>#divWidget{display: none;}/256x256/<?php echo (isset($this->_rootref['S_WIDGET_ICON'])) ? $this->_rootref['S_WIDGET_ICON'] : ''; ?>.png" width="60" style="margin:-17px 0 0 3px;" />
		<div style="float:right;margin:13px 10px 0 0;font-size:16px;color:#fff;"><?php echo (isset($this->_rootref['S_WIDGET_TEMP'])) ? $this->_rootref['S_WIDGET_TEMP'] : ''; ?>&deg;C</div></div>
	<div id="divDate"><?php echo (isset($this->_rootref['S_WIDGET_DATE'])) ? $this->_rootref['S_WIDGET_DATE'] : ''; ?></div>
	<div id="divClock"></div>
	<input type="hidden" id="divCurrentTime" value="<?php echo (isset($this->_rootref['S_CURRENT_TIME'])) ? $this->_rootref['S_CURRENT_TIME'] : ''; ?>" />
</div>
<script>
var currenttime = $("#divCurrentTime").val();
var ctime = currenttime.split("/"); console.log(ctime[0]);

var serverdate = new Date(ctime[0],ctime[1],ctime[2],ctime[3],ctime[4],ctime[5])

function padlength(what){
        var output = (what.toString().length==1)? "0"+what : what;
        return output;
}

function displaytime(){
        serverdate.setSeconds(serverdate.getSeconds()+1);
        var timestring = padlength(serverdate.getHours())+":"+padlength(serverdate.getMinutes());//+":"+padlength(serverdate.getSeconds());
        $("#divClock").html(timestring);
}

var myVar = setInterval(function(){displaytime()}, 1000)

</script>