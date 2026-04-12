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
    
<div id="divChannelList" style="font-family: jp;">
    <div id="divChannelListItems">
    </div>
</div>

<!--<div id="divCurrentChannelNameContainer">
    <div id="divCurrentChannelName" style="font-family: jp;"></div>
</div>-->

<!-- IF S_HOTSPOT -->
<div id="hotspot"><p style="text-align:center;"> {L_HOTSPOT_INFO}</p>
        <div style="width:79px;display:inline-block;">{L_HOTSPOT_USER}</div><div style="display:inline-block;">: {S_HOTSPOT_USER}</div><br>
        <div style="width:79px;display:inline-block;">{L_HOTSPOT_PWD}</div><div style="display:inline-block;">: {S_HOTSPOT_PWD}</div>
</div>
<!-- ENDIF -->


<div id="pageTitle" style="font-family: {S_USER_LANG};">{L_PAGE_TITLE}</div>
<div id="apDiv2"></div>
<input type="hidden" name="chIndex" id="chIndex" value="" />
<!--<div id="runningText"><marquee scrollamount="10" loop="" style="width:1280px;">Selamat Datang di Panghegar Hotel</marquee></div>
<div id="runningText">TES DRIVE BWAHAHAHHAHA</div> -->

<!-- INCLUDE footer.tpl -->
