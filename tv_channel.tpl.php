<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('header.tpl'); ?>


<!-- <body onmousedown="return false;"> -->
<!-- video start-->
<!-- <div id="apDiv1">Div1 -->
<div id="divVideoContainer" class="divVideoContainer">
    <div id="mediaPlayIcon" class="mediaPlayIcon">
    </div>
    <div id="divSeekControls">
	<div id="divSeekBackDisplay" class="seekingIconssb displayNone" style="background-image: url(<?php echo (isset($this->_rootref['T_IMAGESET_PATH'])) ? $this->_rootref['T_IMAGESET_PATH'] : ''; ?>/ssb.png);">
	0x</div>
	<div id="divSeekForwardDisplay" class="seekingIconssf displayNone" style="background-image: url(<?php echo (isset($this->_rootref['T_IMAGESET_PATH'])) ? $this->_rootref['T_IMAGESET_PATH'] : ''; ?>/ssf.png);">
	0x</div>
    </div>
    <div id="divLoading" class="divLoading displayNone">
	<!--<img alt="Loading..." src="<?php echo (isset($this->_rootref['T_IMAGESET_PATH'])) ? $this->_rootref['T_IMAGESET_PATH'] : ''; ?>/loading.gif" />-->
    </div>
    <video id="media" class="videoControl"></video>
    <!--<embed type="application/x-vlc-plugin"
         name="video2" id="media" class="videoControl"
         autoplay="yes" loop="yes" hidden="no" width="100%" height="100%"
         src="" />-->
</div>
<input type="hidden" id="videoSRC" value="" />
<!-- </div> -->
<!-- video end -->
<!--<div id="apDiv2"></div>
<div id="apDiv3"></div>
<div id="apDiv4"></div>-->
<!-- begin menu -->
<!-- <div id="apDiv5" style="text-align:center"> -->
<div id="divChannelListHeader"><?php echo (isset($this->_rootref['S_GROUP_TITLE'])) ? $this->_rootref['S_GROUP_TITLE'] : ''; ?></div>
<div id="divChannelList">
    <div id="divChannelListItems">
    </div>
</div>
<div id="divChannelListFooter"></div>
<div id="divChannelLayer"></div>

<div id="divChannelListCategory">
    <div id="divChannelListItemsCategory">
    </div>
</div>
<div id="divChannelLayerCategory" class="displayNone"></div>
<!--
<div id="divFavoriteText">Favorite</div>
<div id="divMailText">Mail</div>
<div id="divParentalLockText">Parental lock</div>
<div id="divGenreText">Genre</div>
-->

<!--
<div id="divCurrentChannelNameContainer">
    <div id="divCurrentChannelName"></div>
</div>
-->
<div id="divChannelCover">	
	<div id="divChannelIndexNO"></div>
	<div id="divChannelIndexIndicator"></div>	
</div>

<input type="hidden" id="ch_index" name="ch_index" value="<?php echo (isset($this->_rootref['S_GUEST_LAST_CHANNEL'])) ? $this->_rootref['S_GUEST_LAST_CHANNEL'] : ''; ?>" />
<input type="hidden" id="mode" name="mode" value="nonfullscreen" />
<input type="hidden" id="verify_password" name="verify_password" value="<?php echo (isset($this->_rootref['S_TV_CHANNEL_VERIFIED'])) ? $this->_rootref['S_TV_CHANNEL_VERIFIED'] : ''; ?>" />
<input type="hidden" id="active" name="active" value="" />
<input type="hidden" id="bumper" name="bumper" value="" />
<input type="hidden" id="total_category" name="total_category" value="" />
<input type="hidden" id="index_category" name="index_category" value="<?php echo (isset($this->_rootref['S_GID'])) ? $this->_rootref['S_GID'] : ''; ?>" />
<input type="hidden" id="banner_order" name="banner_order" value="1" />
<input type="hidden" id="change_channel_log" name="change_channel_log" value="0" />


<!--
<div id="divInfoTxt">
	Press <span style="color:blue;"> OK </span> To Full Screen
</div>
-->
<!-- </div> -->
<!-- end menu --><!-- fullscreen start-->
<div id="divLogo"><img src="<?php echo (isset($this->_rootref['T_IMAGESET_PATH'])) ? $this->_rootref['T_IMAGESET_PATH'] : ''; ?>/sh.png" height="100px"></div>
<div id="divFullScreenControl" class="displayNone">
    <!--<div style="position: absolute; color: #fff; left:40px; top:20px; height: 20px; font-size: 22px;">All Channel</div>-->
    
    <div id="divCurrentChannelNameFullScreen"></div>
    <div id="divCurrentChannelNoFullScreen"></div>
    <div id="divCurrentEpgTimeFullScreen" style="position: absolute; color: #f36e21; left:40px; height: 35px; font-size: 22px;"></div>
    <!--<div id="divCurrentEpgTimeFullScreen"></div>-->
    <div id="divCurrentEpgProgramFullScreen"></div>
    <div id="divCurrentChannelAds"></div>
    <!--
    <div id="divVideoFullScreenIcons" class="divVideoFullScreenIconsPlay">
    </div>
    <div id="divFullTrickValue">
    </div>
    
    <div id="divVideoTrackerFullScreen"> 
	<div id="divProgressTimeFullScreen">
	00:00:00</div>
	<div id="divProgressBarFullScreen">
	    <div style="position: absolute; width: 100%; height: 6px; background-image: url(<?php echo (isset($this->_rootref['T_IMAGESET_PATH'])) ? $this->_rootref['T_IMAGESET_PATH'] : ''; ?>/bigprogress.png);">
	    </div>
	    <div id="divProgressBarTrackFullScreen" style="position: absolute; width: 0%; height: 6px;
                            background-image: url(<?php echo (isset($this->_rootref['T_IMAGESET_PATH'])) ? $this->_rootref['T_IMAGESET_PATH'] : ''; ?>/smallProgressfocus.png);">
	    </div>
	    <div id="divTrackShaftFullScreen" style="position: absolute; width: 45px; height: 24px;
                            top: -9px; left: 0%; background-image: url(<?php echo (isset($this->_rootref['T_IMAGESET_PATH'])) ? $this->_rootref['T_IMAGESET_PATH'] : ''; ?>/fullshaft.png);">
	    </div>
	</div>
	<div id="divProgressDurationFullScreen">
	    00:00:00</div> 
    </div>
    <div id="divCurrentChannelDescFullScreen">
    </div>
    <div id="divInfoTxt">
	Press <span style="color:blue;"> Blue Key </span> to Hide/Show
    </div>-->


</div>
<!--
<div id="divChannelScrambledBground" class="displayNone"></div>
<div id="divChannelScrambled" class="displayNone">
    <div id="divChannelScrambledMessage"><?php echo ((isset($this->_rootref['L_SCRAMBLED_MESSAGE'])) ? $this->_rootref['L_SCRAMBLED_MESSAGE'] : ((isset($user->lang['SCRAMBLED_MESSAGE'])) ? $user->lang['SCRAMBLED_MESSAGE'] : '{ SCRAMBLED_MESSAGE }')); ?><div id="divCsContact"><?php echo ((isset($this->_rootref['L_CS_CONTACT'])) ? $this->_rootref['L_CS_CONTACT'] : ((isset($user->lang['CS_CONTACT'])) ? $user->lang['CS_CONTACT'] : '{ CS_CONTACT }')); ?></div></div>    
</div>

<div id="divChannelBumperBground" class="displayNone"></div>
<div id="divChannelBumper" class="displayNone">
        
</div>

<div id="divParentalLockBground" class="displayNone"></div>
<div id="divParentalLock" class="displayNone">
	<h1><div id="divTitle" style="width:100%; text-align:center; color:#000;"><?php echo ((isset($this->_rootref['L_ENTER_PASSWORD'])) ? $this->_rootref['L_ENTER_PASSWORD'] : ((isset($user->lang['ENTER_PASSWORD'])) ? $user->lang['ENTER_PASSWORD'] : '{ ENTER_PASSWORD }')); ?></div></h1>
	<div>
	
	<table style="font-size: 20px; padding: 10px; width:100%;">
		<tr>
			
			<td colspan="2" align="center"><div id="divPassword" style="width:230px;height:40px;background-color:#fff;color:#000;font-size:30px;padding-top:8px;"></div></td>
		</tr>
	</table>
	</div>
</div>
<div id="divToggleParentalLock" class="displayNone">
	<h1><div id="divToggleTitle" style="width:100%; text-align:center; color:#000;"></div></h1>
	<div>
	<table style="font-size: 20px; padding: 10px; width:100%;">
		<tr>
			<td colspan="2" align="center"><div id="divTogglePassword" style="width:230px;height:40px;background-color:#fff;color:#000;font-size:30px;padding-top:8px;"></div></td>
		</tr>
	</table>
	</div>
</div>

<div id="password" style="width:230px;height:40px;top:-720px;position:absolute;"></div>
<div id="msg" style="width:530px;height:60px;top:220px;position:absolute;left:450px;z-index: 100;font-size: 22px;text-align: center;padding-top: 25px;font-weight:bold;"></div>
-->
<div id="divPopup">
	<!--<img id="popupImg" src="" width="420" height="400">-->
</div>

<!--<div id="logoPlay" class="displayNone">
     <img src="<?php echo (isset($this->_rootref['T_IMAGESET_PATH'])) ? $this->_rootref['T_IMAGESET_PATH'] : ''; ?>/logo-play.png"/>
</div>-->
<!-- fullscreen end -->

<script type="text/javascript">
//window.setInterval("checkAdsPopup()", 10000);

function checkAdsPopup() {
	var ch_index = $("#ch_index").val();
	var tv_channel_id = channelListArray[media.channelIndex][6];
	
	$.ajax({
		url: "ajax.php",
		cache: false,
		type: "GET",
		data: "mod=popup&tv_channel_id=" + tv_channel_id,
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

<?php $this->_tpl_include('footer.tpl'); ?>