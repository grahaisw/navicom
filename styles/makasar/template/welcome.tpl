<!-- INCLUDE header.tpl -->

<!-- Bground Video -->

<!-- IF S_BGROUND_CLIP -->
<video autoplay loop id="bgvid">
    <source src="{T_BG_CLIP_PATH}" type="video/mp4">
</video> 
<!-- ENDIF -->


<div id="divHomeClip">
    <video autoplay loop width="700" id="HomeClip"></video>
</div>

<div id="apDiv2"></div>
 <div id="apDiv3" style="font-family: {S_USER_LANG};"></div>
<div id="apDiv4" style="font-family: {S_USER_LANG};">
  <span align="center"><h3><strong>{S_WELCOME_TITLE}</strong><!--{S_GUEST_NAME}--></h3></span>
  <p>{S_WELCOME_CONTENT}</p>
</div>

<div id="greetings">{S_WELCOME_TITLE}</strong></br>{S_GUEST_NAME}</div>
<!--
<div id="divWidget" align="right">
	<div id="divWeather">
		<div style="text-align:right;font-size:16px;color:#fff;"><span style="font-size:20px;">{S_WIDGET_CITY}</span><br/>Bali, Indonesia</div>
		<img src="{T_MEDIA_IMAGES_PATH}weathers/256x256/{S_WIDGET_ICON}.png" width="70" style="margin:-55px 0 0 3px; float:left" />
	</div>
	<div id="divDate">{S_WIDGET_DATE}</div><br/>
	<div style="float:right;margin:13px 10px 0 0;font-size:20px;color:#fff;">{S_WIDGET_TEMP}°C</div>
	<div id="divClock"></div>
	<input type="hidden" id="divCurrentTime" value="{S_CURRENT_TIME}" />
</div>
-->
<!-- IF S_HOTSPOT -->
<!--<div id="hotspot"><p style="text-align:left;margin:0;"> {L_HOTSPOT_INFO}</p>
	<div style="width:79px;display:inline-block;">{L_HOTSPOT_USER}</div><div style="display:inline-block;">: {S_HOTSPOT_USER}</div><br>
	<div style="width:79px;display:inline-block;">{L_HOTSPOT_PWD}</div><div style="display:inline-block;">: {S_HOTSPOT_PWD}</div>
</div>-->
<!-- ENDIF -->

<div id="posterLayer1" style="font-family: {S_USER_LANG};">{L_NOTICE}</div>
<!-- IF S_GROUP -->
<div id="groupButton" style="{S_DISPLAY_GROUP}" >{L_PRESS}&nbsp;<img src="{T_IMAGESET_PATH}/{S_GROUP_BUTTON}">&nbsp;{L_TOGOTO}&nbsp;{S_GROUP_NAME}</div>
<!-- ENDIF -->
<!-- <div id=posterLayer></div> -->
<!--<div id="runningText"><marquee scrollamount="10" loop="" style="width:1280px;">Selamat Datang di Panghegar Hotel</marquee></div>
<div id="runningText">TES DRIVE BWAHAHAHHAHA</div> -->

<!-- INCLUDE footer.tpl -->
