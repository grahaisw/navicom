
<html xmlns="http://www.w3.org/1999/xhtml" dir="{S_CONTENT_DIRECTION}" lang="{S_USER_LANG}" xml:lang="{S_USER_LANG}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Language" content="{S_USER_LANG}">
<meta http-equiv="imagetoolbar" content="no">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="expires" content="0">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{SITENAME}</title>

<script type="text/javascript" language="javascript" src="{T_JS_PATH}utils.js"></script>
<script type="text/javascript" language="javascript" src="{T_JS_PATH}jquery.js"></script>
<script src="{T_THEME_PATH}/keycode.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" src="{T_THEME_PATH}/jquery-2.1.0.min.js"></script>

<style type="text/css" media="screen">
    #runningText {
	position: absolute;
	top: 687px;
	background: rgba(0, 0, 0, 0.6);
	color: #fff;
	font-size: 24px;
	overflow: hidden;
	z-index: 101;
    }
    
    @font-face {
	font-family: navicom-light;
	src: url({T_THEME_PATH}/FuturaStd-Light.otf);
    }
    
    @font-face {
	font-family: navicom-normal;
	src: url({T_THEME_PATH}/FuturaStd-Book.otf);
    }
    
    @font-face {
	font-family: navicom-strong;
	src: url({T_THEME_PATH}/FuturaStd-Heavy.otf);
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
	 src: url({T_THEME_PATH}/hiragino.ttf);
	 }
	  
	 @font-face {
	 font-family: 'cn';
	 src: url({T_THEME_PATH}/heitiSC.ttf);
	 }
	 
	 @font-face {
	 font-family: 'kr';
	 src: url({T_THEME_PATH}/senkor.ttf);
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


<!-- IF S_HOME -->
<link href="{T_THEME_PATH}/home.css" rel="stylesheet" type="text/css" />
<script>
   $(document).keydown(function(e) {
      var key = e.keyCode;
      switch (key) {
                case keyCodes.KEY_home:
                        location.href= 'index.php?menu=1';
                        break;
                 case keyCodes.KEY_back:
//                        window.history.go(-1);
			location.href= 'index.php?menu=1';
         break;
      }
  });
</script>

<!-- ENDIF -->
<!-- IF S_HOME_GROUP -->
<link href="{T_THEME_PATH}/home_group.css" rel="stylesheet" type="text/css" />
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
<!-- ENDIF -->
<!-- IF S_HOME -->
<script src="{T_THEME_PATH}/hcap.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/log.js" type="text/javascript"></script>
<script type="text/javascript">
    var channelListArray = [  
	<!-- BEGIN menu -->
/*	["{menu.S_MENU_TITLE}", "{menu.S_MENU_DESCRIPTION1}","{menu.S_MENU_DESCRIPTION2}", 0, 
	"{T_IMAGESET_PATH}/160x160/{menu.S_MENU_THUMBNAIL}", "{menu.S_MENU_URL}", "{menu.S_ID}"],*/
	["{menu.S_MENU_TITLE}", "{menu.S_MENU_DESCRIPTION1}","{menu.S_MENU_DESCRIPTION2}", 0, 
	"{T_MEDIA_IMAGES_PATH}/menus/160x160/{menu.S_MENU_THUMBNAIL}", "{menu.S_MENU_URL}", "{menu.S_ID}"],
	<!-- END menu -->

    ];
</script>

<script src="{T_THEME_PATH}/home.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/home_config_document.js" type="text/javascript"></script>

<script type="text/javascript">
    window.onload = function () {
	hcap.channel.stopCurrentChannel();
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
  body{ background: #fff url({T_MEDIA_IMAGES_PATH}/bground/bground-channel.jpg) no-repeat center top; } 
  #divWidget{top:125px;}
</style>

<!-- ENDIF -->

<!-- IF S_TV_CHANNEL_GROUP -->
<link href="{T_THEME_PATH}/tv_channel_groups.css" rel="stylesheet" type="text/css" />
<!-- <script src="{T_JS_PATH}jquery.js" type="text/javascript"></script>
<script src="../theme/_channeldb.js" type="text/javascript"></script> -->
<script src="{T_THEME_PATH}/hcap.js" type="text/javascript"></script> 
<script src="{T_THEME_PATH}/log.js" type="text/javascript"></script>
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
  body{ background:#000 url({T_MEDIA_IMAGES_PATH}/bground/bground-channel.jpg) no-repeat center top; } 
  #divWidget{display:none}
</style>
<!-- ENDIF -->


<!-- IF S_TV_CHANNEL -->
<link href="{T_THEME_PATH}/tv_channels.css" rel="stylesheet" type="text/css" />
<script src="{T_JS_PATH}jquery.js" type="text/javascript"></script>
<script src="{T_JS_PATH}utils.js" type="text/javascript"></script>
<!--<script src="../theme/_channeldb.js" type="text/javascript"></script> -->
<script src="{T_THEME_PATH}/hcap.js" type="text/javascript"></script> 
<script src="{T_THEME_PATH}/log.js" type="text/javascript"></script>
<script type="text/javascript">
    var channelListArray = [  
	<!-- BEGIN channel -->
	["{channel.S_TITLE}", "{channel.S_URL}","{T_MEDIA_IMAGE_TV_PATH}160x160/{channel.S_THUMBNAIL}", 0, "{channel.S_ORDER}", "{channel.S_INDEX}", "{channel.S_ID}"],
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
</script>

<script>
   $(document).keydown(function(e) {
      var key = e.keyCode;
      switch (key) {
          case keyCodes.KEY_back:
               location.href= 'tv_channel.php?&group_id=9';
          break;
      }
  });
</script>

<style type="text/css">
  body{ background:#000 url({T_MEDIA_IMAGES_PATH}/bground/bground-channel.jpg) no-repeat center top; } 
  #divWidget{display:none}
</style>

<!-- ENDIF -->

<!-- IF S_TV_CHANNEL_FULLSCREENLG -->
<link href="{T_THEME_PATH}/tv_channels_fullscreenlg.css" rel="stylesheet" type="text/css" />
<!-- <script src="{T_JS_PATH}jquery.js" type="text/javascript"></script>
<script src="../theme/_channeldb.js" type="text/javascript"></script> -->
<script src="{T_THEME_PATH}/hcap.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/log.js" type="text/javascript"></script>
<script type="text/javascript">
    var channelListArray = [
        <!-- BEGIN channel -->
        ["{channel.S_TITLE}", "{channel.S_URL}","{T_MEDIA_IMAGE_TV_PATH}160x160/{channel.S_THUMBNAIL}", 0, "{channel.S_ORDER}", "{channel.S_INDEX}"],
        <!-- END channel -->
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
<script src="{T_THEME_PATH}/keycode.js" type="text/javascript"></script>-->
<script src="{T_THEME_PATH}/tv_channels_fullscreenlg.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/tv_config_document_fullscreenlg.js" type="text/javascript"></script>
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
  /*body{ background:#000 url({T_MEDIA_IMAGES_PATH}/bground/bground-channel.jpg) no-repeat center top; }*/
  body{ background:#000; }
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
	["{channel.S_TITLE}", "{channel.S_URL}","{T_MEDIA_IMAGE_TV_PATH}/b-n-w/{channel.S_THUMBNAIL}", 0, "{channel.S_ORDER}", "{channel.S_ID}"],
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
	background:#000 url({T_IMAGESET_PATH}/bground-polos_high.jpg) no-repeat center top; } 
}
#divLogo {
	display: none;
}
</style>
<!-- ENDIF -->

<!-- IF S_MOVIES -->
<link href="{T_THEME_PATH}/movie_trailer.css" rel="stylesheet" type="text/css" />
<script src="{T_THEME_PATH}/hcap.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/log.js" type="text/javascript"></script>
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
  body{ background: #fff url({T_MEDIA_IMAGES_PATH}/bground/bground-movie.jpg) no-repeat center top; } 
  #divWidget{display:none}
</style>
<!-- ENDIF -->

<!-- IF S_VOD_FULL -->
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
/*    background: #000 url({T_IMAGESET_PATH}/bground-panghegar.jpg) top no-repeat; */
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
<!-- ENDIF -->

<!-- IF S_DIRECTORY -->
<!-- <script src="{T_JS_PATH}jquery.js" type="text/javascript"></script> 
<link rel="stylesheet" href="{T_THEME_PATH}/directory.css">-->
<style type="text/css" media="screen">
body {
    background: #fff url({T_MEDIA_IMAGES_PATH}/bground/{S_BGROUND_IMAGE}) no-repeat;
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
	border: 1px solid #7c5b04;
	background: url({T_IMAGESET_PATH}/logo-black.png) top no-repeat; */
}
</style>

<!-- <script src="{T_JS_PATH}jquery.js" type="text/javascript"></script> -->
<link rel="stylesheet" href="{T_THEME_PATH}/directory.css">
<!--
<script type="text/javascript" src="{T_THEME_PATH}/jssor.core.js"></script>
<script type="text/javascript" src="{T_THEME_PATH}/jssor.utils.js"></script>
<!--<script type="text/javascript" src="{T_THEME_PATH}/jssor.slider-weather.js"></script>-->
<script type="text/javascript" src="{T_THEME_PATH}/jssor.slider.js"></script>
-->
<!-- ENDIF -->

<!-- IF S_DIRECTORY_PROMO -->
<!-- <script src="{T_JS_PATH}jquery.js" type="text/javascript"></script> 
<link rel="stylesheet" href="{T_THEME_PATH}/directory.css">-->
<style type="text/css" media="screen">
body {
    background: #fff url({T_MEDIA_IMAGES_PATH}/bground/{S_BGROUND_IMAGE}) no-repeat;
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
	background: url({T_IMAGESET_PATH}/logo-black.png) top no-repeat; 
}
</style>

<!-- <script src="{T_JS_PATH}jquery.js" type="text/javascript"></script> -->
<link rel="stylesheet" href="{T_THEME_PATH}/directory.css">
<!--
<script type="text/javascript" src="{T_THEME_PATH}/jssor.core.js"></script>
<script type="text/javascript" src="{T_THEME_PATH}/jssor.utils.js"></script>
<!--<script type="text/javascript" src="{T_THEME_PATH}/jssor.slider-weather.js"></script>-->
<script type="text/javascript" src="{T_THEME_PATH}/jssor.slider.js"></script>
-->
<!-- ENDIF -->

<!-- IF S_WEATHER -->
<!--<link rel="stylesheet" href="{T_THEME_PATH}/weather.css">
 <script src="{T_JS_PATH}jquery.js" type="text/javascript"></script> -->
<style type="text/css" media="screen">
body {
    background: #000 url({T_MEDIA_IMAGES_PATH}/bground/{S_BGROUND_IMAGE}) top no-repeat;
    
    font-family: navicom-normal, jp, cn, kr;
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
<!-- ENDIF -->

<!-- IF S_REMOTE -->
<style type="text/css">
    body {
	background: #000 url({T_MEDIA_IMAGES_PATH}/bground/bground-remote.jpg) no-repeat top; 
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
<!-- ENDIF -->

<!-- IF S_LOCK -->
<meta http-equiv="refresh" content="5;url=index.php">
<script type="text/javascript">
    var channelListArray = [  
	["", "","", 0],
    ];
</script>
<script src="{T_THEME_PATH}/keycode-unlock.js" type="text/javascript" language="javascript"></script>
<script src="{T_THEME_PATH}/lock.js" type="text/javascript" language="javascript"></script>
<script src="{T_THEME_PATH}/utils.js" type="text/javascript" language="javascript"></script>
<script src="{T_THEME_PATH}/lock_config_document.js" type="text/javascript" language="javascript"></script>
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
	background: url({T_MEDIA_IMAGES_PATH}/bground/bground.jpg) no-repeat center; 
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
    background-image: url({T_IMAGESET_PATH}/directentrybox.png);
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
    background-image: url({T_IMAGESET_PATH}/invalid.png);
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
      background: #fff url({T_MEDIA_IMAGES_PATH}/bground/bground-channel.jpg) no-repeat center top; 
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
  body{ background: #000 url({T_MEDIA_IMAGES_PATH}/bground/bground-fnb.jpg) no-repeat center top; } 
  #divLogo {
        display: none;
}
#divWidget{display:none}
</style>

<!-- ENDIF -->

<!-- IF S_ROOMSERVICE -->
<link href="{T_THEME_PATH}/jquery.fancybox.css" rel="stylesheet" type="text/css" />
<link href="{T_THEME_PATH}/roomservice.css" rel="stylesheet" type="text/css" />
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
	"{roomservice.S_MODE}",
	"{roomservice.S_TAXINFO}"],
	<!-- END roomservice -->

    ];
</script>
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
  body{ background: #000 url({T_MEDIA_IMAGES_PATH}/bground/bground-fnb.jpg) no-repeat center top; } 
  #divLogo {
        display: none;
}
#divWidget{display:none}
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
  body{ background: #000 url({T_MEDIA_IMAGES_PATH}/bground/bground.jpg) no-repeat center top; } 
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
  body{ background: #000 url({T_MEDIA_IMAGES_PATH}/bground/bground.jpg) no-repeat center top; } 
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
  body{ background: #000 url({T_MEDIA_IMAGES_PATH}/bground/bground.jpg) no-repeat center top; } 
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
  body{ background: #000 url({T_MEDIA_IMAGES_PATH}/bground/bground.jpg) no-repeat center top; } 
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
  body{ background: #000 url({T_MEDIA_IMAGES_PATH}/bground/bground.jpg) no-repeat center top; } 
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
  body{ background: #000 url({T_MEDIA_IMAGES_PATH}/bground/bground.jpg) no-repeat center top; } 
</style>
<!-- ENDIF -->

<!-- IF S_BASKET -->
<link href="{T_THEME_PATH}/jquery.fancybox.css" rel="stylesheet" type="text/css" />
<link href="{T_THEME_PATH}/basket.css" rel="stylesheet" type="text/css" />

<script src="{T_THEME_PATH}/jquery-1.10.1.min.js"></script>
<script src="{T_THEME_PATH}/jquery.fancybox.js"></script>
<script src="{T_THEME_PATH}/roomservice.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/roomservice_basket_config_document.js" type="text/javascript"></script>
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
  body{ background: #000 url({T_MEDIA_IMAGES_PATH}/bground/bground.jpg) no-repeat center top; } 
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
  body{ background: #000 url({T_MEDIA_IMAGES_PATH}/bground/bground.jpg) no-repeat center top; } 
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
  body{ background: #000 url({T_MEDIA_IMAGES_PATH}/bground/bground.jpg) no-repeat center top; } 
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
               window.history.go(-1);
          break;
      }
  });
</script>

<style type="text/css">
  body{ background: #000 url({T_MEDIA_IMAGES_PATH}/bground/bground.jpg) no-repeat center top; } 
</style>

<!-- ENDIF -->

<!-- IF S_CONNECTIVITY -->
<link href="{T_THEME_PATH}/connectivity.css" rel="stylesheet" type="text/css" />
<!--<script src="{T_THEME_PATH}/connectivity_config_document.js" type="text/javascript"></script>-->
<style type="text/css">
  body{ background: #fff url({T_MEDIA_IMAGES_PATH}/bground/bground.jpg) no-repeat center top; } 
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
<!-- ENDIF -->

<!-- IF S_ROOM_UPDATE -->
<link href="{T_THEME_PATH}/room_update.css" rel="stylesheet" type="text/css" />
<!--<script src="{T_THEME_PATH}/connectivity_config_document.js" type="text/javascript"></script>-->
<style type="text/css">
  body{ 
      background: #000 url({T_MEDIA_IMAGES_PATH}/bground/bground.jpg) no-repeat center top; 
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
<script src="{T_THEME_PATH}/hcap.js" type="text/javascript"></script>
<script src="{T_THEME_PATH}/log.js" type="text/javascript"></script>
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
  body{ background: #000 url({T_MEDIA_IMAGES_PATH}/bground/bground-welcome.jpg) no-repeat center top; } 
  #divWidget{display:none}
</style>
<!-- ENDIF -->

<!-- IF S_SENDMESSAGE -->
<link rel="stylesheet" type="text/css" href="{T_THEME_PATH}/sendmessage.css" />
<script src="{T_THEME_PATH}/sendmessage.js" type="text/javascript" language="javascript"></script>
<script src="{T_THEME_PATH}/senlei19-sendmessage.js" type="text/javascript"></script>
<style type="text/css" media="screen">
body {
    background: #000 url({T_MEDIA_IMAGES_PATH}/bground/bground.jpg) no-repeat center top; 
    margin: 0px;
    padding: 0px;
    font: 100%/1.4 navicom-normal;
    overflow: hidden;
}
</style>
<!-- ENDIF -->

<!-- IF S_ROOMSUITES -->
<style type="text/css" media="screen">
body {
    background: #fff url({T_MEDIA_IMAGES_PATH}/bground/bground-dir.jpg) no-repeat;
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
<link rel="stylesheet" href="{T_THEME_PATH}/fitness.css">
<script>
   $(document).keydown(function(e) {
      var key = e.keyCode;
      switch (key) {
                case keyCodes.KEY_home:
                        location.href= 'index.php?menu=1';
                        break;
               case keyCodes.KEY_back:
			var page = $("#currentPage").val();
                        window.history.go(-1);
         break;
      }
  });
</script>
<!-- ENDIF -->

<!-- IF S_INHOUSE -->
<style type="text/css" media="screen">
body {
    background: #fff url({T_MEDIA_IMAGES_PATH}/bground/bground.jpg) no-repeat;
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
<link rel="stylesheet" href="{T_THEME_PATH}/fitness.css">
<script>
   $(document).keydown(function(e) {
      var key = e.keyCode;
      switch (key) {
                case keyCodes.KEY_home:
                        location.href= 'index.php?menu=1';
                        break;
               case keyCodes.KEY_back:
                        window.history.go(-1);
         break;
      }
  });
</script>


<!-- ENDIF -->
<!--<style>
	@font-face {
	 font-family: 'jp';
	 src: url({T_THEME_PATH}/hiragino.ttf);
	 }
	  
	 @font-face {
	 font-family: 'cn';
	 src: url({T_THEME_PATH}/heitiSC.ttf);
	 }
	 
	 @font-face {
	 font-family: 'kr';
	 src: url({T_THEME_PATH}/AppleGothic.ttf);
	 }
	 
	 body {
    font-family: {S_USER_LANG};
	}
	div {
    font-family: {S_USER_LANG};
	}
	h2 {
    font-family: {S_USER_LANG};
	}
</style>-->
<script>
   $(document).keydown(function(e) {
      var key = e.keyCode;
      switch (key) { 
		case keyCodes.KEY_home:
			location.href= 'index.php?menu=1';
			break;
		 case keyCodes.KEY_back:
			window.history.go(-1);
         break;
		case keyCodes.461:
			window.history.go(-1);
			break;
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
      }
  });
</script>
<script>
window.addEventListener("keydown", keysPressed, false);
window.addEventListener("keyup", keysReleased, false);
 
var keys = [];
 
function keysPressed(e) {
    keys[e.keyCode] = true;
    /*if (keys[166] && keys[49] && keys[57] && keys[13] && keys[406]) {
        location.href= 'tv_channel_hk.php';
    } */   
    if (keys[404]) {
        location.href= 'roomupdate.php';
        e.preventDefault(); 
    }
}
function keysReleased(e) {
    keys[e.keyCode] = false;
}
/* var currenttime = $("#divCurrentTime").val();
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

var myVar = setInterval(function(){displaytime()}, 1000); */
</script>
</head>

<body id="b1" class="ltr" {S_ONMOUSEDOWN}>

<div id="nonemergency">
	<div id="posterLayer"></div>
	<!--<div id="divLogo"><img src="{T_IMAGESET_PATH}/logo.jpg" height="183px" width="183px"></div>-->
<input type="hidden" name="idx" id="idx" value="" />
<input type="hidden" name="currentPage" id="currentPage" value="{S_CURRENT_PAGE}" />
<div id="divWidget">
	<div id="divWeather">
		<div style="text-align:right;font-size:16px;color:#fff;">{S_WIDGET_CITY}</div>
		<img src="{T_MEDIA_IMAGES_PATH}weathers/256x256/{S_WIDGET_ICON}.png" width="60" style="margin:-17px 0 0 3px;" />
		<div style="float:right;margin:13px 10px 0 0;font-size:16px;color:#fff;">{S_WIDGET_TEMP}&deg;C</div></div>
	<div id="divDate">{S_WIDGET_DATE}</div>
	<div id="divClock"></div>
	<input type="hidden" id="divCurrentTime" value="{S_CURRENT_TIME}" />
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
