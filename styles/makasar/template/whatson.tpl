<!-- INCLUDE header.tpl -->

<!-- Bground Video -->

<!-- IF S_BGROUND_CLIP -->
<video autoplay loop id="bgvid1">
    <source src="{T_BG_CLIP_PATH}" type="video/mp4">
</video> 
<!-- ENDIF -->


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
<!--
<div id="posterLayer1" style="font-family: {S_USER_LANG};">{L_NOTICE}</div>
-->
<!-- <div id=posterLayer></div> -->

<!-- INCLUDE footer.tpl -->
