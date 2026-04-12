<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="{S_CONTENT_DIRECTION}" lang="{S_USER_LANG}" xml:lang="{S_USER_LANG}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Language" content="{S_USER_LANG}">
<meta http-equiv="imagetoolbar" content="no">
<meta http-equiv="expires" content="0">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{SITENAME}</title>

<script type="text/javascript" language="javascript" src="{T_JS_PATH}utils.js"></script>
<script type="text/javascript" language="javascript" src="{T_JS_PATH}jquery.js"></script>
<script src="{T_THEME_PATH}/keycode.js" type="text/javascript" language="javascript"></script>

<style type="text/css" media="screen">
    #runningText {
	position: absolute;
	top: 678px;
	background: rgba(0, 0, 0, 0.6);
	color: #fff;
	font-size: 24px;
	overflow: hidden;
	z-index:30;
    }
    
    @font-face {
	font-family: pristina;
	src: url({T_THEME_PATH}/pristina.ttf);
    }
    
    @font-face {
	font-family: myriadpro;
	src: url({T_THEME_PATH}/myriadpro.otf);
    }
    
    #divNewMessage{
	position: absolute;
	right: 20px;
	top: 5px;
	color: #ffff66;
	width: 400px;
	height: 60px;
	z-index: 300;
	text-align: right;
    }
</style>

<!-- IF S_HOME -->
<meta http-equiv="refresh" content="5; url=tv_channel.php" />
<link href="{T_THEME_PATH}/home.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<!-- BEGIN menu -->
/*	["{menu.S_MENU_TITLE}", "{menu.S_MENU_DESCRIPTION1}","{menu.S_MENU_DESCRIPTION2}", 0, 
	"{T_IMAGESET_PATH}/160x160/{menu.S_MENU_THUMBNAIL}", "{menu.S_MENU_URL}", "{menu.S_ID}"],*/
	["{menu.S_MENU_TITLE}", "{menu.S_MENU_DESCRIPTION1}","{menu.S_MENU_DESCRIPTION2}", 0, 
	"{T_MEDIA_IMAGES_PATH}/menus/160x160/{menu.S_MENU_THUMBNAIL}", "{menu.S_MENU_URL}", "{menu.S_ID}"],
	<!-- END menu -->

    ];

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

<script src="{T_THEME_PATH}/home.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/home_config_document.js" type="text/javascript"></script>

<script type="text/javascript">
    window.onload = function () {
	media._object.Fn_Play_Pause();
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
	doc.addEventListener("keydown", navigation, true);
	//blink();
    }
</script>

<style type="text/css">
	body{ background: #fff url({T_MEDIA_IMAGES_PATH}/bground/bground.jpg) no-repeat center top; } 
 
	#date {
		position: absolute;
		top: 20px;
		left: 860px;
		width: 300px;
		height: 80px;
		font-size: 16px;
		font-weight: bold;
		font-family: 'Trebuchet MS';
		color: #fff;
		z-index: 6;
	}
	#time {
		position: absolute;
		top: 20px;
		left: 1090px;
		width: 300px;
		height: 80px;
		font-size: 16px;
		font-weight: bold;
		font-family: 'Trebuchet MS';
		color: #fff;
		z-index: 6;
	}
</style>

<!-- ENDIF -->

<!-- IF S_TV_CHANNEL_GROUP -->
<link href="{T_THEME_PATH}/tv_channel_groups.css" rel="stylesheet" type="text/css" />
<!-- <script src="{T_JS_PATH}jquery.js" type="text/javascript"></script>
<script src="../theme/_channeldb.js" type="text/javascript"></script> -->
<script type="text/javascript">
    var channelListArray = [  
	<!-- BEGIN group -->
	["{group.S_CAT_TITLE}", "{group.S_URL}","{T_MEDIA_IMAGE_TV_PATH}group/{group.S_THUMBNAIL}.png", 0, "{group.S_CAT_URL}"],
	<!-- END group -->
    ];
</script>
<!--
<script src="{T_THEME_PATH}/keycode.js" type="text/javascript"></script>-->
<script src="{T_THEME_PATH}/tv_channel_groups.js" type="text/javascript"></script> 
<script src="{T_THEME_PATH}/tv_groups_config_document.js" type="text/javascript"></script> 
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
  body{ background:#000 url({T_MEDIA_IMAGES_PATH}/bground/bground.jpg) no-repeat center top; } 
</style>
<!-- ENDIF -->


<!-- IF S_TV_CHANNEL -->
<link href="{T_THEME_PATH}/tv_channels.css" rel="stylesheet" type="text/css" />
<!-- <script src="{T_JS_PATH}jquery.js" type="text/javascript"></script>
<script src="../theme/_channeldb.js" type="text/javascript"></script> -->
<script type="text/javascript">
    var channelListArray = [  
	<!-- BEGIN channel -->
	["{channel.S_TITLE}", "{channel.S_URL}","{T_MEDIA_IMAGE_TV_PATH}160x160/{channel.S_THUMBNAIL}", 0, "{channel.S_ORDER}"],
	<!-- END channel -->
    ];
</script>
<!--
<script src="{T_THEME_PATH}/keycode.js" type="text/javascript"></script>-->
<script src="{T_THEME_PATH}/tv_channels.js" type="text/javascript"></script> 
<script src="{T_THEME_PATH}/tv_config_document.js" type="text/javascript"></script> 
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

	 setTimeout(function () {
                media.JS_FullScreen_Function();
                  // media.video.src = channelListArray[media.channelIndex][6];
                }, 5000);
</script>

<style type="text/css">
	body{ background:#000 url({T_MEDIA_IMAGES_PATH}bground/bground.jpg) no-repeat center top; } 
	#date {
		position: absolute;
		top: 20px;
		left: 860px;
		width: 300px;
		height: 80px;
		font-size: 16px;
		font-weight: bold;
		font-family: 'Trebuchet MS';
		color: #fff;
		z-index: 6;
	}
	#time {
		position: absolute;
		top: 20px;
		left: 1090px;
		width: 300px;
		height: 80px;
		font-size: 16px;
		font-weight: bold;
		font-family: 'Trebuchet MS';
		color: #fff;
		z-index: 6;
	}
	}
</style>

<!-- ENDIF -->

<!-- IF S_TV_CHANNEL_FULL -->
<link href="{T_THEME_PATH}/tv_channels.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    window.onload = function () {
		video = doc.getElementById("media");	
    }
</script>
<script type="text/javascript">
    var channelListArray = [  
	<!-- BEGIN channel -->
	["{channel.S_TITLE}", "{channel.S_URL}","{T_MEDIA_IMAGE_TV_PATH}/b-n-w/{channel.S_THUMBNAIL}", 0, "{channel.S_ORDER}"],
	<!-- END channel -->
    ];
</script>
<script src="{T_THEME_PATH}/tv_channels_full.js" type="text/javascript"></script> 
<script src="{T_THEME_PATH}/tv_full_config_document.js" type="text/javascript"></script> 
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
	background:#000 url({T_IMAGESET_PATH}/bground.jpg) no-repeat center top; } 
}
</style>
<!-- ENDIF -->

<!-- IF S_MOVIES -->
<link href="{T_THEME_PATH}/movie_trailer.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<!-- BEGIN movie -->
	["{movie.S_TITLE}", //0
	"{movie.S_TRAILER}", //1
	"{movie.S_DESCRIPTION}", //2 
	0, //3
	"{T_MEDIA_IMAGE_MOVIE_PATH}160x160/{movie.S_THUMBNAIL}.png", //4
	"{T_MEDIA_IMAGE_MOVIE_PATH}200x280/{movie.S_THUMBNAIL}.jpg",  //5
	"{movie.S_ID}", //6
	// "{movie.'S_FULL_MOVIE}",
	"{movie.L_DIRECTOR}", //7
	"{movie.S_DIRECTOR}", //8
	"{movie.L_CASTS}", //9
	"{movie.S_CASTS}",  //10
	"{movie.L_GENRE}", //11
	"{movie.S_GENRE}", //12
	"{movie.L_PRICE}", //13
	"{movie.S_PRICE}", //14
	"{movie.L_DESCRIPTION}", //15
	"{movie.S_CODE}", //16
	"{movie.S_QTY}", //17
	"{movie.L_CURRENCY}"], //18
	<!-- END movie -->
    ];
</script>
<script src="{T_THEME_PATH}/movie_trailer.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/movie_config_document.js" type="text/javascript"></script>

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
  body{ background: #fff url({T_MEDIA_IMAGES_PATH}bground/bground.jpg) no-repeat center top; } */
</style>
<!-- ENDIF -->

<!-- IF S_VOD_FULL -->
<style type="text/css">
video#bgvid {
    position: fixed; right: 0; bottom: 0;
    min-width: 100%; min-height: 100%;
    width: auto; height: auto; z-index: -1;
    background: #000;
    background-size: cover;
}
#runningText {
	height:60px;
	position:relative;
	left:-10px;
	width:103%;
	top:675px;
}
body {
    overflow: hidden;
/*    background: #000 url({T_IMAGESET_PATH}/bground-panghegar.jpg) top no-repeat; */
}
</style>
<!-- ENDIF -->

<!-- IF S_DIRECTORY -->
<!-- <script src="{T_JS_PATH}jquery.js" type="text/javascript"></script> 
<link rel="stylesheet" href="{T_THEME_PATH}/directory.css">-->
<style type="text/css" media="screen">
body {
    background: #fff url({T_MEDIA_IMAGES_PATH}/bground/bground.jpg) no-repeat;
    font-family: Arial;
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
	background: url({T_IMAGESET_PATH}/logo-black.png) top no-repeat; 
}

#date {
	position: absolute;
	top: 20px;
	left: 860px;
	width: 300px;
	height: 80px;
	font-size: 16px;
	font-weight: bold;
	font-family: 'Trebuchet MS';
	color: #fff;
	z-index: 6;
}
#time {
	position: absolute;
	top: 20px;
	left: 1090px;
	width: 300px;
	height: 80px;
	font-size: 16px;
	font-weight: bold;
	font-family: 'Trebuchet MS';
	color: #fff;
	z-index: 6;
}
</style>

<!-- <script src="{T_JS_PATH}jquery.js" type="text/javascript"></script> -->
<link rel="stylesheet" href="{T_THEME_PATH}/directory.css">
<!--<script src="{T_THEME_PATH}/directory.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/directory_config_document.js" type="text/javascript"></script>-->
<script type="text/javascript">
	/*window.onload = function () {
		var newVideo = document.getElementById('media'); alert('b'+newVideo.src);
		newVideo.play();
		newVideo.addEventListener('ended', function() { alert('a');
			this.currentTime = 0;
			this.play();
		}, false);

		
	}*/
	
	var color_key_result= $SystemSetting.Set_Color_Key(1,34,34,34);
	
	$(document).keydown(function(e) {
      var key = e.keyCode;
      switch (key) { 
		case keyCodes.KEY_back:
			location.href= 'index.php';
			break;
      
		case keyCodes.KEY_home:
			location.href= 'index.php';
			break;
		    
      }
  });
</script>
<!--
<script type="text/javascript" src="{T_THEME_PATH}/jssor.core.js"></script>
<script type="text/javascript" src="{T_THEME_PATH}/jssor.utils.js"></script>
<script type="text/javascript" src="{T_THEME_PATH}/jssor.slider.js"></script>
-->
<!-- ENDIF -->

<!-- IF S_DIRECTORY_PROMO -->
<!-- <script src="{T_JS_PATH}jquery.js" type="text/javascript"></script> 
<link rel="stylesheet" href="{T_THEME_PATH}/directory.css">-->
<style type="text/css" media="screen">
body {
    background: #fff url({T_MEDIA_IMAGES_PATH}/bground/promo.jpg) no-repeat;
    font-family: Arial;
    margin: 0px;
    padding: 0px;
    overflow: hidden;
/*    background: #000 url({T_IMAGESET_PATH}/bground-panghegar.jpg) top no-repeat; */
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
	background: url({T_IMAGESET_PATH}/logo-black.png) top no-repeat; 
}
</style>

<!-- <script src="{T_JS_PATH}jquery.js" type="text/javascript"></script> -->
<link rel="stylesheet" href="{T_THEME_PATH}/directory.css">
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
         location.href= 'roomservice.php';
         break;
		case keyCodes.KEY_red:
			location.href= 'tv_channel.php';
         break;
		case keyCodes.KEY_home:
			location.href= 'index.php';
         break;
		    
      }
  });
</script>
<!-- ENDIF -->

<!-- IF S_DIRECTORY2 -->
<!-- <script src="{T_JS_PATH}jquery.js" type="text/javascript"></script> 
<link rel="stylesheet" href="{T_THEME_PATH}/directory.css">-->
<style type="text/css" media="screen">
body {
    background: #fff url({T_MEDIA_IMAGES_PATH}/bground/bground-dir.jpg) no-repeat;
    font-family: Arial;
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
	background: url({T_IMAGESET_PATH}/logo-black.png) top no-repeat; 
}
</style>

<!-- <script src="{T_JS_PATH}jquery.js" type="text/javascript"></script> -->
<link rel="stylesheet" href="{T_THEME_PATH}/directory2.css">
<!--
<script type="text/javascript" src="{T_THEME_PATH}/jssor.core.js"></script>
<script type="text/javascript" src="{T_THEME_PATH}/jssor.utils.js"></script>
<script type="text/javascript" src="{T_THEME_PATH}/jssor.slider.js"></script>
-->
<!-- ENDIF -->

<!-- IF S_WEATHER -->
<!--<link rel="stylesheet" href="{T_THEME_PATH}/weather.css">
 <script src="{T_JS_PATH}jquery.js" type="text/javascript"></script> -->
<style type="text/css" media="screen">
body {
    background: #000 url({T_MEDIA_IMAGES_PATH}/bground/bground.jpg) top no-repeat;
    
    font-family: Arial;
    color: #fff;
    margin: 0px;
    padding: 0px;
    overflow: hidden;
}

#apDiv2 {
	position:absolute;
	left:1018px;
	top:510px;
	width:180px;
	height: 152px;
	z-index:92;
	opacity: .8;
/*	border: 1px solid #7c5b04;*/
	background: url({T_IMAGESET_PATH}/logo-white.png) top no-repeat;
}
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
         location.href= 'roomservice.php';
         break;
		case keyCodes.KEY_red:
			location.href= 'tv_channel.php';
         break;
		case keyCodes.KEY_home:
			location.href= 'index.php';
         break;
		    
      }
  });
</script>
<!-- ENDIF -->

<!-- IF S_REMOTE -->
<style type="text/css">
    body {
	background: #000 url({T_MEDIA_IMAGES_PATH}/bground/bground-remote.jpg) no-repeat top; 
	font-family: Arial;
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
    #divLogo {
    position: absolute;
    top: 50px;
    left: 1000px;
    width: 180px;
    height: 152px;
    background: url({T_IMAGESET_PATH}/logo-white.png) top no-repeat;
/*    border: 0px solid #7c5b04; */
    z-index: 10;
    /*opacity: .9;*/
}
    h1 {
	color: #7c5b04;
	font-size: 34px;
	font-weight: bold;
	font-family: Myriad Pro, Arial, Verdana;
    }
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
         location.href= 'roomservice.php';
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
<!-- ENDIF -->

<!-- IF S_EASTJAVA -->
<style type="text/css" media="screen">
body {
    background: #fff url({T_MEDIA_IMAGES_PATH}/bground/bground-dir.jpg) no-repeat;
    font-family: Arial;
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
	background: url({T_IMAGESET_PATH}/logo-black.png) top no-repeat; 
}
</style>

<!-- <script src="{T_JS_PATH}jquery.js" type="text/javascript"></script> -->
<link rel="stylesheet" href="{T_THEME_PATH}/directory.css">
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
         location.href= 'roomservice.php';
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
<!-- ENDIF -->

<!-- IF S_LOCK -->
<style type="text/css">
    body {
	background: #000; 
	font-family: Arial;
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
	opacity: .7;
	background: url({T_MEDIA_IMAGES_PATH}/bground/gds-sore.jpg) no-repeat center; 
    }
    
    div.title {
	position: absolute;
	width: 180px;
	height: 180px;
	left: 550px;
	top: 400px;
	z-index: 10;
	background: url({T_IMAGESET_PATH}/lock.png) no-repeat center; 
    }
    h1 {
	color: #7c5b04;
	font-size: 34px;
	font-weight: bold;
	font-family: Myriad Pro, Arial, Verdana;
    }
</style>
<!-- ENDIF -->

<!-- IF S_LANGUAGE -->
<link href="{T_THEME_PATH}/language.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<!-- BEGIN language -->
	["{language.S_TITLE}", "{language.S_DESCRIPTION1}","{language.S_DESCRIPTION2}", 0, 
	"{T_MEDIA_IMAGES_PATH}/flags/160x160/{language.S_FLAG}", "{language.S_URL}", "{language.S_ID}"],
	<!-- END language -->

    ];
</script>

<script src="{T_THEME_PATH}/language.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/language_config_document.js" type="text/javascript"></script>

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
  body { 
      background: #fff url({T_MEDIA_IMAGES_PATH}/bground/lobby-gds2.jpg) no-repeat center top; 
      margin: 0px;
      padding: 0px;
  } 
</style>

<!-- ENDIF -->

<!-- IF S_ROOMSERVICE_CATEGORY -->
<link href="{T_THEME_PATH}/roomservice_category.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<!-- BEGIN category -->
	["{category.S_CAT_TITLE}", "{category.S_CAT_URL}","{category.S_DESCRIPTION}", 0, 
	"{T_MEDIA_IMAGES_PATH}/fnb/160x160/{category.S_THUMBNAIL}.png", "{T_MEDIA_IMAGE_FNB_PATH}600x400/{category.S_THUMBNAIL}.jpg", "{T_MEDIA_IMAGE_FNB_PATH}680x124/{category.S_THUMBNAIL}.jpg",
	"{T_MEDIA_CLIP_PATH}roomservice/{category.S_CLIP}"], 
	<!-- END category -->

    ];
</script>

<script src="{T_THEME_PATH}/roomservice_category.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/roomservice_category_config_document.js" type="text/javascript"></script>

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
  /*body{ background: #000 url({T_IMAGESET_PATH}/bground-fnb-cat.jpg) no-repeat center top; } */
  body{ background: #000 url({T_MEDIA_IMAGES_PATH}/bground/restaurant.jpg) no-repeat center top; } 
</style>

<!-- ENDIF -->

<!-- IF S_ROOMSERVICE -->
<link href="{T_THEME_PATH}/jquery.fancybox.css" rel="stylesheet" type="text/css" />
<link href="{T_THEME_PATH}/roomservice2.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<!-- BEGIN roomservice -->
	["{roomservice.S_TITLE}", 
	"{roomservice.S_URL}",
	"{roomservice.S_DESCRIPTION}", 
	0, 
	"{T_MEDIA_IMAGES_PATH}/fnb/160x160/{roomservice.S_THUMBNAIL}.png",
	"{T_MEDIA_IMAGE_FNB_PATH}600x400/{roomservice.S_THUMBNAIL}.jpg",
	"{T_MEDIA_IMAGE_FNB_CAT_PATH}680x124/{S_GRADIENT_THUMBNAIL}.jpg", 
	"{roomservice.S_PRICE}",
	"{roomservice.S_CODE}", 
	"{roomservice.S_QTY}", 
	"{roomservice.L_CURRENCY}", 
	"{roomservice.L_PRICE}",
	"{roomservice.S_SERVICE_ID}",
	"{roomservice.S_GID}",
	"{roomservice.S_MODE}"],
	<!-- END roomservice -->

    ];
</script>
<script src="{T_THEME_PATH}/jquery-1.10.1.min.js"></script>
<script src="{T_THEME_PATH}/jquery.fancybox.js"></script>
<script src="{T_THEME_PATH}/roomservice2.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/roomservice2_config_document.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/senlei19.js" type="text/javascript"></script>

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
  /*body{ background: #000 url({T_IMAGESET_PATH}/bground-fnb-cat.jpg) no-repeat center top; } */
  body{ background: #000 url({T_MEDIA_IMAGES_PATH}/bground/fruit-basket.jpg) no-repeat center top; } 
</style>
<!-- ENDIF -->

<!-- IF S_SHOP_CATEGORY -->
<link href="{T_THEME_PATH}/shop_category.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<!-- BEGIN category -->
	["{category.S_CAT_TITLE}", "{category.S_CAT_URL}","{category.S_DESCRIPTION}", 0, 
	"{T_MEDIA_IMAGES_PATH}/shop/160x160/{category.S_THUMBNAIL}.png", "{T_MEDIA_IMAGE_SHOP_PATH}600x400/{category.S_THUMBNAIL}.jpg", "{T_MEDIA_IMAGE_SHOP_PATH}680x124/{category.S_THUMBNAIL}.jpg",
	"{T_MEDIA_CLIP_PATH}shop/{category.S_CLIP}"], 
	<!-- END category -->

    ];
</script>

<script src="{T_THEME_PATH}/shop_category.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/shop_category_config_document.js" type="text/javascript"></script>

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
  /*body{ background: #000 url({T_IMAGESET_PATH}/bground-fnb-cat.jpg) no-repeat center top; } */
  body{ background: #000 url({T_MEDIA_IMAGES_PATH}/bground/lobby2.jpg) no-repeat center top; } 
</style>

<!-- ENDIF -->

<!-- IF S_SHOP -->
<link href="{T_THEME_PATH}/jquery.fancybox.css" rel="stylesheet" type="text/css" />
<link href="{T_THEME_PATH}/shop.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<!-- BEGIN shop -->
	["{shop.S_TITLE}", 
	"{shop.S_URL}",
	"{shop.S_DESCRIPTION}", 
	0, 
	"{T_MEDIA_IMAGES_PATH}/shop/160x160/{shop.S_THUMBNAIL}.png",
	"{T_MEDIA_IMAGE_SHOP_PATH}600x400/{shop.S_THUMBNAIL}.jpg",
	"{T_MEDIA_IMAGE_SHOP_CAT_PATH}680x124/{S_GRADIENT_THUMBNAIL}.jpg", 
	"{shop.S_PRICE}",
	"{shop.S_CODE}", 
	"{shop.S_QTY}", 
	"{shop.L_CURRENCY}", 
	"{shop.L_PRICE}",
	"{shop.S_SERVICE_ID}",
	"{shop.S_GID}",
	"{shop.S_MODE}"],
	<!-- END shop -->

    ];
</script>
<script src="{T_THEME_PATH}/jquery-1.10.1.min.js"></script>
<script src="{T_THEME_PATH}/jquery.fancybox.js"></script>
<script src="{T_THEME_PATH}/shop.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/shop_config_document.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/senlei19.js" type="text/javascript"></script>

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
  /*body{ background: #000 url({T_IMAGESET_PATH}/bground-fnb-cat.jpg) no-repeat center top; } */
  body{ background: #000 url({T_MEDIA_IMAGES_PATH}/bground/lobby2.jpg) no-repeat center top; } 
</style>
<!-- ENDIF -->


<!-- IF S_SPA_CATEGORY -->
<link href="{T_THEME_PATH}/spa_category.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<!-- BEGIN category -->
	["{category.S_CAT_TITLE}", "{category.S_CAT_URL}","{category.S_DESCRIPTION}", 0, 
	"{T_MEDIA_IMAGES_PATH}/spa/160x160/{category.S_THUMBNAIL}.png", "{T_MEDIA_IMAGE_SPA_PATH}600x400/{category.S_THUMBNAIL}.jpg", "{T_MEDIA_IMAGE_SPA_PATH}680x124/{category.S_THUMBNAIL}.jpg",
	"{T_MEDIA_CLIP_PATH}spa/{category.S_SPA_CLIP}"], 
	<!-- END category -->

    ];
</script>

<script src="{T_THEME_PATH}/spa_category.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/spa_category_config_document.js" type="text/javascript"></script>

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
  /*body{ background: #000 url({T_IMAGESET_PATH}/bground-fnb-cat.jpg) no-repeat center top; } */
  body{ background: #000 url({T_MEDIA_IMAGES_PATH}/bground/spa.jpg) no-repeat center top; } 
</style>

<!-- ENDIF -->

<!-- IF S_SPA -->
<link href="{T_THEME_PATH}/jquery.fancybox.css" rel="stylesheet" type="text/css" />
<link href="{T_THEME_PATH}/spa.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<!-- BEGIN spa -->
	["{spa.S_TITLE}", 
	"{spa.S_URL}",
	"{spa.S_DESCRIPTION}", 
	0, 
	"{T_MEDIA_IMAGES_PATH}/spa/160x160/{spa.S_THUMBNAIL}.png",
	"{T_MEDIA_IMAGE_SPA_PATH}600x400/{spa.S_THUMBNAIL}.jpg",
	"{T_MEDIA_IMAGE_SPA_CAT_PATH}680x124/{S_GRADIENT_THUMBNAIL}.jpg", 
	"{spa.S_PRICE}",
	"{spa.S_CODE}", 
	"{spa.S_QTY}", 
	"{spa.L_CURRENCY}", 
	"{spa.L_PRICE}",
	"{spa.S_SERVICE_ID}",
	"{spa.S_GID}",
	"{spa.S_MODE}",
	"{T_MEDIA_CLIP_PATH}spa/{spa.S_SPA_CLIP}"],
	<!-- END spa -->

    ];
</script>
<script src="{T_THEME_PATH}/jquery-1.10.1.min.js"></script>
<script src="{T_THEME_PATH}/jquery.fancybox.js"></script>
<script src="{T_THEME_PATH}/spa.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/spa_config_document.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/senlei19.js" type="text/javascript"></script>

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
  /*body{ background: #000 url({T_IMAGESET_PATH}/bground-fnb-cat.jpg) no-repeat center top; } */
  body{ background: #000 url({T_MEDIA_IMAGES_PATH}/bground/spa.jpg) no-repeat center top; } 
</style>
<!-- ENDIF -->

<!-- IF S_TOUR_CATEGORY -->
<link href="{T_THEME_PATH}/tour_category.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<!-- BEGIN category -->
	["{category.S_CAT_TITLE}", "{category.S_CAT_URL}","{category.S_DESCRIPTION}", 0, 
	"{T_MEDIA_IMAGES_PATH}/tour/160x160/{category.S_THUMBNAIL}.png", "{T_MEDIA_IMAGE_TOUR_PATH}600x400/{category.S_THUMBNAIL}.jpg", "{T_MEDIA_IMAGE_TOUR_PATH}680x124/{category.S_THUMBNAIL}.jpg",
	"{T_MEDIA_CLIP_PATH}tour/{category.S_TOUR_CLIP}"], 
	<!-- END category -->

    ];
</script>

<script src="{T_THEME_PATH}/tour_category.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/tour_category_config_document.js" type="text/javascript"></script>

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
  /*body{ background: #000 url({T_IMAGESET_PATH}/bground-fnb-cat.jpg) no-repeat center top; } */
  body{ background: #000 url({T_MEDIA_IMAGES_PATH}/bground//lobby.jpg) no-repeat center top; } 
</style>

<!-- ENDIF -->


<!-- IF S_TOUR -->
<link href="{T_THEME_PATH}/jquery.fancybox.css" rel="stylesheet" type="text/css" />
<link href="{T_THEME_PATH}/tour.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<!-- BEGIN tour -->
	["{tour.S_TITLE}", 
	"{tour.S_URL}",
	"{tour.S_DESCRIPTION}", 
	0, 
	"{T_MEDIA_IMAGES_PATH}/tour/160x160/{tour.S_THUMBNAIL}.png",
	"{T_MEDIA_IMAGE_TOUR_PATH}600x400/{tour.S_THUMBNAIL}.jpg",
	"{T_MEDIA_IMAGE_TOUR_CAT_PATH}680x124/{S_GRADIENT_THUMBNAIL}.jpg", 
	"{tour.S_PRICE}",
	"{tour.S_CODE}", 
	"{tour.S_QTY}", 
	"{tour.L_CURRENCY}", 
	"{tour.L_PRICE}",
	"{tour.S_SERVICE_ID}",
	"{tour.S_GID}",
	"{tour.S_MODE}",
	"{T_MEDIA_CLIP_PATH}tour/{tour.S_TOUR_CLIP}"],
	<!-- END tour -->

    ];
</script>
<script src="{T_THEME_PATH}/jquery-1.10.1.min.js"></script>
<script src="{T_THEME_PATH}/jquery.fancybox.js"></script>
<script src="{T_THEME_PATH}/tour.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/tour_config_document.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/senlei19.js" type="text/javascript"></script>

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
  /*body{ background: #000 url({T_IMAGESET_PATH}/bground-fnb-cat.jpg) no-repeat center top; } */
  body{ background: #000 url({T_MEDIA_IMAGES_PATH}/bground/lobby.jpg) no-repeat center top; } 
</style>
<!-- ENDIF -->

<!-- IF S_BASKET -->
<link href="{T_THEME_PATH}/jquery.fancybox.css" rel="stylesheet" type="text/css" />
<link href="{T_THEME_PATH}/basket.css" rel="stylesheet" type="text/css" />

<script src="{T_THEME_PATH}/jquery-1.10.1.min.js"></script>
<script src="{T_THEME_PATH}/jquery.fancybox.js"></script>
<script src="{T_THEME_PATH}/roomservice.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/roomservice_config_document.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/senlei19.js" type="text/javascript"></script>

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
  /*body{ background: #000 url({T_IMAGESET_PATH}/bground-fnb-cat.jpg) no-repeat center top; } */
  body{ background: #000 url({T_MEDIA_IMAGES_PATH}/bground/batik.jpg) no-repeat center top; } 
</style>

<!-- ENDIF -->
<!-- IF S_VIEWBILL -->
<link href="{T_THEME_PATH}/viewbill.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<!-- BEGIN viewbill -->
	["{viewbill.S_DATE}", "{viewbill.S_TITLE}","{viewbill.S_PRICE}", 0, 
	"{viewbill.S_NO}"],  
	<!-- END viewbill -->

    ];
</script>

<script src="{T_THEME_PATH}/viewbill.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/viewbill_config_document.js" type="text/javascript"></script>
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
  /*body{ background: #000 url({T_IMAGESET_PATH}/bground-fnb-cat.jpg) no-repeat center top; } */
  body{ background: #000 url({T_MEDIA_IMAGES_PATH}/bground/lobby.jpg) no-repeat center top; } 
</style>

<!-- ENDIF -->

<!-- IF S_VIEWORDER -->
<link href="{T_THEME_PATH}/vieworder.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<!-- BEGIN vieworder -->
	["{vieworder.S_DATE}", "{vieworder.S_ITEM}","{vieworder.S_QTY}", 0, 
	"{vieworder.S_NO}", "{vieworder.S_NOTE}"],  
	<!-- END vieworder -->

    ];
</script>

<script src="{T_THEME_PATH}/vieworder.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/vieworder_config_document.js" type="text/javascript"></script>
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
  /*body{ background: #000 url({T_IMAGESET_PATH}/bground-fnb-cat.jpg) no-repeat center top; } */
  body{ background: #000 url({T_MEDIA_IMAGES_PATH}/bground/lobby.jpg) no-repeat center top; } 
</style>

<!-- ENDIF -->


<!-- IF S_INBOX -->
<link href="{T_THEME_PATH}/inbox.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<!-- BEGIN inbox -->
	["{inbox.S_DATE}", "{inbox.S_FROM}","{inbox.S_CONTENT}", 0, 
	"{inbox.S_NO}", "{inbox.S_TIME}"],
	<!-- END inbox -->
    ];
</script>

<script src="{T_THEME_PATH}/inbox.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/inbox_config_document.js" type="text/javascript"></script>
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
  /*body{ background: #000 url({T_IMAGESET_PATH}/bground-fnb-cat.jpg) no-repeat center top; } */
  body{ background: #000 url({T_MEDIA_IMAGES_PATH}/bground/gds-sore.jpg) no-repeat center top; } 
</style>

<!-- ENDIF -->

<!-- IF S_CONNECTIVITY -->
<link href="{T_THEME_PATH}/connectivity.css" rel="stylesheet" type="text/css" />
<!--<script src="{T_THEME_PATH}/connectivity_config_document.js" type="text/javascript"></script>-->
<style type="text/css">
  /*body{ background: #000 url({T_IMAGESET_PATH}/bground-fnb-cat.jpg) no-repeat center top; } */
  body{ background: #000 url({T_MEDIA_IMAGES_PATH}/bground/gds-sore.jpg) no-repeat center top; } 
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
         location.href= 'roomservice.php';
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
<!-- ENDIF -->

<!-- IF S_ROOM_UPDATE -->
<link href="{T_THEME_PATH}/room_update.css" rel="stylesheet" type="text/css" />
<!--<script src="{T_THEME_PATH}/connectivity_config_document.js" type="text/javascript"></script>-->
<style type="text/css">
  body{ 
      background: #000 url({T_MEDIA_IMAGES_PATH}/bground/batik.jpg) no-repeat center top; 
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
      case keyCodes.KEY_blue:
		case keyCodes.KEY_green:
			location.href= 'vod.php';
         break;
		case keyCodes.KEY_yellow:
         location.href= 'roomservice.php';
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
<!-- ENDIF -->

<!-- IF S_FLIGHT -->
<link href="{T_THEME_PATH}/flight.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var channelListArray = [  
	<!-- BEGIN flight -->
	["{flight.S_AIRLINE}", 
	"{flight.S_FLIGHT}",
	"{flight.S_ORIGIN_DESTINATION}", 
	0, 
	"{flight.S_SCHEDULE}",
	"{flight.S_TERMINAL}", 
	"{flight.S_GATE}", 
	"{flight.S_REMARK}", 
	"{flight.S_TOGGLE_TYPE}"],
	<!-- END flight -->

    ];
</script>

<script src="{T_THEME_PATH}/flight.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/flight_config_document.js" type="text/javascript"></script>
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
      background: #000 url({T_MEDIA_IMAGES_PATH}/bground/bground.jpg) no-repeat center top; 
      margin: 0px;
      padding: 0px;
      } 
</style>

<!-- ENDIF -->

<!-- IF S_WELCOME -->
<link href="{T_THEME_PATH}/welcome.css" rel="stylesheet" type="text/css" />

<script>
    $(document).keydown(function(e) {
	var key = e.keyCode;
	switch (key) { 
	    case keyCodes.KEY_enter:
		location.href= '{S_HOME_MENU_URL}';
		break;    
	}
    });
</script>

<style type="text/css">
  body{ background: #000 url({T_MEDIA_IMAGES_PATH}/bground/bground.jpg) no-repeat center top; } 
</style>
<!-- ENDIF -->

<!-- IF S_SENDMESSAGE -->
<link rel="stylesheet" type="text/css" href="{T_THEME_PATH}/sendmessage.css" />
<script src="{T_THEME_PATH}/sendmessage.js" type="text/javascript" language="javascript"></script>
<script src="{T_THEME_PATH}/senlei19-sendmessage.js" type="text/javascript"></script>
<style type="text/css" media="screen">
body {
    background: #000 url({T_MEDIA_IMAGES_PATH}/bground/lobby.jpg) no-repeat center top; 
    margin: 0px;
    padding: 0px;
    font: 100%/1.4 Verdana, Arial, Helvetica, sans-serif;
    overflow: hidden;
}
</style>
<!-- ENDIF -->

<!--<style>
	#date {
		position: absolute;
		top: 20px;
		left: 860px;
		width: 300px;
		height: 80px;
		font-size: 16px;
		font-weight: bold;
		font-family: 'Trebuchet MS';
		color: #000;
		z-index: 6;
	}
	#time {
		position: absolute;
		top: 20px;
		left: 1090px;
		width: 300px;
		height: 80px;
		font-size: 16px;
		font-weight: bold;
		font-family: 'Trebuchet MS';
		color: #000;
		z-index: 6;
	}
</style>-->

</head>

<body id="b1" class="ltr" {S_ONMOUSEDOWN}>

<div id="nonemergency">
	<div id="widget">
		<div id="date">{S_DATE}</div>
		<div id="time"><span id="clock"></span></div>
	</div>
<input type="hidden" id="divCurrentTime" value="{S_CURRENT_TIME}" />
<input type="hidden" id="currentPage" value="{S_CURRENT_PAGE}" />
