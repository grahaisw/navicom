<!-- INCLUDE header.tpl -->

<!-- IF S_BGROUND_CLIP -->
<video autoplay loop id="bgvid">
    <source src="{T_BG_CLIP_PATH}" type="video/mp4">
</video>
<!-- ENDIF -->
<div id="divVideoContainer" class="divVideoContainer">
    <video id="media" class="videoControl" loop></video>
</div>
<!--
<div id="apDiv2">
    <video autoplay loop id="home"><source src="../../../../vod/wonderful-indonesia-bali.mp4" type="video/mp4"></video> 
</div>-->
 
<div id="apDiv3"></div>

<div id="divChannelList">
    <div id="divChannelListItems">
    </div>
</div>
<!--
<div id="divCurrentChannelNameContainer">
    <div id="divCurrentChannelName"></div>
</div> -->

<!--<div id="posterLayer"></div>-->
<!--<div id="divLogo"></div>
<div id="welcomeText">{S_WELCOME_TITLE}</div>
<div id="guestName">{S_GUEST_NAME}</div>
-->
<!-- IF S_QR_CODE --><div id="apDiv4"><img src="{L_QR_IMAGE}" width="100%"></div><!-- ENDIF -->

<input type="hidden" name="chIndex" id="chIndex" value="" />
<!--<div id="runningText"><marquee scrollamount="10" loop="" style="width:1280px;">Selamat Datang di Panghegar Hotel</marquee></div>
<div id="runningText">TES DRIVE BWAHAHAHHAHA</div> -->
<!--<div class="divEmpatLima">
    <button type="button" class="btnRed"></button> TV  &nbsp;<button type="button" class="btnGreen"></button> Movie&nbsp;<button type="button" class="btnYellow"></button> Room Service
</div>-->

<!-- INCLUDE footer.tpl -->
