<!-- INCLUDE header.tpl -->

<!-- Bground Video 
<video autoplay loop id="bgvid">
    <source src="{T_BG_CLIP_PATH}/wonderful-indonesia-jakarta.mp4" type="video/mp4">
</video>  -->

<div id="divVideoContainer" class="divVideoContainer">
    <video id="media" class="videoControl" loop></video>
</div>
<!--
<div id="apDiv2">
    <video autoplay loop id="home"><source src="../../../../vod/wonderful-indonesia-bali.mp4" type="video/mp4"></video> 
</div>-->
    
<div id="divChannelList">
    <div id="divChannelListItems">
    </div>
</div>

<div id="divCurrentChannelNameContainer">
	<!--<div id="divCurrentCategoryName" style="font-family: {S_USER_LANG};">{L_PAGE_TITLE}</div>-->
    <div id="divCurrentChannelName" style="font-family: {S_USER_LANG};"></div>
</div>

<div id="pageTitle" style="font-family: {S_USER_LANG};">{L_PAGE_TITLE_UP}</div>
<div id="apDiv2"></div>
<div id="apDiv3"></div>

<div id="divDescription" style="font-family: {S_USER_LANG};"></div>
<div id="divPicture"></div>
<div id="divGradPicture"></div>
<!-- -- IF S_MENU_EXIST -- -->
<div id="divPrice"></div>
<!--<div id="divOrder"><div id="divBlueCol"></div>{L_PRESS_BLUE_BUTTON}</div>-->
<!-- -- ENDIF -- -->

<div id="divControlContainer">
	<!--<div id="divOrder" onclick="media.JS_FullScreen_Function();">
		{L_CALL_TO_ORDER}
	</div>-->
<!--	<a id="divBasket" class="fancybox fancybox.iframe">{L_CALL_TO_ORDER}</a>-->
</div>

<input type="hidden" name="chIndex" id="chIndex" value="" />
<input type="hidden" name="resvID" id="resvID" value="{S_RESV_ID}" />
<!--<div id="runningText"><marquee scrollamount="10" loop="" style="width:1280px;">Selamat Datang di Panghegar Hotel</marquee></div>
<div id="runningText">TES DRIVE BWAHAHAHHAHA</div> -->

<!-- INCLUDE footer.tpl -->
