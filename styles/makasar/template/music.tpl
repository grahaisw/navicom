<!-- INCLUDE header.tpl -->

<!-- <body onmousedown="return false;"> -->
<!-- video start-->
<!-- <div id="apDiv1">Div1 -->
<div id="divVideoContainer" class="divVideoContainer">
    <div id="mediaPlayIcon" class="mediaPlayIcon">
    </div>
    <div id="divSeekControls">
	<div id="divSeekBackDisplay" class="seekingIconssb displayNone" style="background-image: url({T_IMAGESET_PATH}/ssb.png);">
	0x</div>
	<div id="divSeekForwardDisplay" class="seekingIconssf displayNone" style="background-image: url({T_IMAGESET_PATH}/ssf.png);">
	0x</div>
    </div>
    <div id="divLoading" class="divLoading displayNone">
	<img alt="Loading..." src="{T_IMAGESET_PATH}/loading.gif" />
    </div>
    <video id="media2" class="videoControl" preload="auto" autoplay loop></video>
</div>
<!-- </div> -->
<!-- video end -->
<div id="apDiv3"></div>
<div id="apDiv4"></div>
<!-- begin menu -->
<!-- <div id="apDiv5" style="text-align:center"> -->
<div id="divChannelList">
    <div id="divChannelListItems">
    </div>
</div>
<div id="divCurrentChannelNameContainer" style="font-family: {S_USER_LANG};">
    <div id="divCurrentChannelName" style="font-family: {S_USER_LANG};"></div>
    <div id="divGenre" style="font-family: {S_USER_LANG};"></div>
</div>
<div id="divDescriptionContainer">
    <div id="divPoster"></div>
    <!-- <div id="divMoviePrice"></div> -->
    <div id="divDirector"></div>
    <!-- <div id="divCast"></div> -->
    <div id="divSynopsis"></div>
</div>
<div id="divControlContainer">
	<div id="divOrder" onclick="media.JS_FullScreen_Function();">
	{L_BUY_TO_WATCH}
	</div>
</div>
<!-- </div> -->
<!-- end menu -->
<div id="backin" style="z-index: 92; position: absolute; width: 100%; height: 100%;"><img style="width: 20%; text-align: center; z-index: 92; margin-left: 500px; margin-top:200px;" src="{T_IMAGESET_PATH}/wall.png"></div>

<!-- fullscreen start-->

<div id="divFullScreenControl" class="displayNone">
    <div id="divVideoFullScreenIcons" class="divVideoFullScreenIconsPlay">
    </div>
    <div id="divFullTrickValue">
    </div>
    <div style="display: none;" id="divCurrentChannelNameFullScreen">
    </div>
    <div id="divVideoTrackerFullScreen">
	<div id="divProgressTimeFullScreen">
	00:00:00</div>
	<div id="divProgressBarFullScreen">
	    <div style="position: absolute; width: 100%; height: 6px; background-image: url({T_IMAGESET_PATH}/bigprogress.png);">
	    </div>
	    <div id="divProgressBarTrackFullScreen" style="position: absolute; width: 0%; height: 6px;
                            background-image: url({T_IMAGESET_PATH}/smallProgressfocus.png);">
	    </div>
	    <div id="divTrackShaftFullScreen" style="position: absolute; width: 45px; height: 24px;
                            top: -9px; left: 0%; background-image: url({T_IMAGESET_PATH}/fullshaft.png);">
	    </div>
	</div>
	<div id="divProgressDurationFullScreen">
	    00:00:00</div>
    </div>
    <div id="divCurrentChannelDescFullScreen">
    </div>
    <div id="divInfoTxt">
	Press <span style="color:blue;"> Blue Key </span> to Hide/Show
    </div>
</div>
<!-- fullscreen end -->
<input type="hidden" name="chIndex" id="chIndex" value="0" />

<!-- INCLUDE footer.tpl -->
