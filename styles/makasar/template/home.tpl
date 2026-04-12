<!-- INCLUDE header.tpl -->
<!--
<div id="divWidget">
	<div id="divWeather">
		<div style="text-align:right;font-size:16px;color:#fff;">{S_WIDGET_CITY}</div>
		<img src="{T_MEDIA_IMAGES_PATH}weathers/256x256/{S_WIDGET_ICON}.png" width="60" style="margin:-17px 0 0 3px;" />
		<div style="float:right;margin:13px 10px 0 0;font-size:16px;color:#fff;">{S_WIDGET_TEMP}°C</div></div>
	<div id="divDate">{S_WIDGET_DATE}</div>
	<div id="divClock"></div>
	<input type="hidden" id="divCurrentTime" value="{S_CURRENT_TIME}" />
</div>
-->
<script>
var currenttime = $("#divCurrentTime").val();
var ctime = currenttime.split("/");

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

var myVar = setInterval(function(){displaytime()}, 1000);
/*window.onload=function(){
	setInterval("displaytime()", 1000);
}*/

</script>

<!-- IF S_BGROUND_CLIP -->
<video autoplay loop id="bgvid">
    <source src="{T_BG_CLIP_PATH}" type="video/mp4">
</video>
<!-- ENDIF -->

 <div id="divVideoContainer" class="divVideoContainer">
    <video id="media" class="videoControl" style="display:none; "  autoplay loop src="{S_MB}"></video>
</div>
<!--
<div id="apDiv2">
    <video autoplay loop id="home"><source src="../../../../vod/wonderful-indonesia-bali.mp4" type="video/mp4"></video> 
</div>-->
<!-- 
<div id="apDiv3">
   <p>{S_WELCOME_CONTENT}</p>
</div>
-->
<div id="divChannelList">
    <div id="divChannelListItems">
    </div>
</div>
<!--
<div id="divCurrentChannelNameContainer">
    <div id="divCurrentChannelName"></div>
</div> -->

<div id="posterLayer"></div>
<div id="divLogo"><img src="{T_IMAGESET_PATH}/sh.png" height="100px"></div>
<div id="welcomeText" style="font-family: {S_USER_LANG};">{S_WELCOME_TITLE} {S_GUEST_NAME}</div>
<!--<div id="guestName">{S_GUEST_NAME}</div>-->
<!-- IF S_QR_CODE --><div id="apDiv4"><img src="{L_QR_IMAGE}" width="100%"></div><!-- ENDIF -->

<!-- IF S_HOTSPOT -->
<!-- <div id="hotspot"><p style="text-align:center;"> {L_HOTSPOT_INFO}</p>
	<div style="width:79px;display:inline-block;">{L_HOTSPOT_USER}</div><div style="display:inline-block;">: {S_HOTSPOT_USER}</div><br>
	<div style="width:79px;display:inline-block;">{L_HOTSPOT_PWD}</div><div style="display:inline-block;">: {S_HOTSPOT_PWD}</div>
</div> -->
<!-- ENDIF -->

<input type="hidden" name="chIndex" id="chIndex" value="0" />
<!--
<div class="divEmpatLima">
    <button type="button" class="btnRed"></button> TV  &nbsp;<button type="button" class="btnGreen"></button> Movie&nbsp;<button type="button" class="btnYellow"></button> Room Service
</div>
-->

<script type="text/javascript">
//window.setInterval("checkMusicBackground()", 5000);

function checkMusicBackground() {
	var ch_index = $("#ch_index").val();
	var tv_channel_id = channelListArray[media.channelIndex][8];
	
	$.ajax({
		url: "ajax.php",
		cache: false,
		type: "GET",
		data: "mod=music_background",
		success: function(response){   
			var str = response.split("|");
			var duration = parseInt(str[0]) * 1000;
			var image = str[1];
			
			if(image != '') {
				$("#divPopup").append('<img id="popupImg" src="'+image+'" width="420" height="400">');
				window.setTimeout("hideAdsPopup()", duration);
			}
		}
	});
}

function hideAdsPopup() {
	$("#divPopup").empty();
	
}
</script>


<!-- INCLUDE footer.tpl -->
