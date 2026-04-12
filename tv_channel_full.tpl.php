<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('header.tpl'); ?>

<meta http-equiv="Cache-control" content="no-cache">
<input type="hidden" id="divCurrentChannelOrder" value="<?php echo (isset($this->_rootref['S_TV_CHANNEL_ORDER'])) ? $this->_rootref['S_TV_CHANNEL_ORDER'] : ''; ?>" />
<input type="hidden" id="divCurrentChannelIndex" value="<?php echo (isset($this->_rootref['S_TV_CHANNEL_INDEX'])) ? $this->_rootref['S_TV_CHANNEL_INDEX'] : ''; ?>" />
<input type="hidden" name="gid" id="gid" value="<?php echo (isset($this->_rootref['S_GID'])) ? $this->_rootref['S_GID'] : ''; ?>" />

<!--<div id="divVideoContainer" class="divVideoContainer divVideoContainer_fullScreen">
    <div id="mediaPlayIcon" class="mediaPlayIcon">
    </div>
    <div id="divSeekControls">
	<div id="divSeekBackDisplay" class="seekingIconssb displayNone" style="background-image: url(<?php echo (isset($this->_rootref['T_IMAGESET_PATH'])) ? $this->_rootref['T_IMAGESET_PATH'] : ''; ?>/ssb.png);">
	0x</div>
	<div id="divSeekForwardDisplay" class="seekingIconssf displayNone" style="background-image: url(<?php echo (isset($this->_rootref['T_IMAGESET_PATH'])) ? $this->_rootref['T_IMAGESET_PATH'] : ''; ?>/ssf.png);">
	0x</div>
    </div>
    <div id="divLoading" class="divLoading displayNone">
	<img alt="Loading..." src="<?php echo (isset($this->_rootref['T_IMAGESET_PATH'])) ? $this->_rootref['T_IMAGESET_PATH'] : ''; ?>/loading.gif" />
    </div>
    <video id="media" class="videoControl"></video>
</div>-->

<div id="divChannelCover">	
	<div id="divChannelIndexNO"></div>
	<div id="divChannelIndexIndicator"></div>	
</div>

<video autoplay loop id="media" src="<?php echo (isset($this->_rootref['S_TV_CHANNEL_SOURCE'])) ? $this->_rootref['S_TV_CHANNEL_SOURCE'] : ''; ?>">
	<!--<source src="<?php echo (isset($this->_rootref['S_TV_CHANNEL_SOURCE'])) ? $this->_rootref['S_TV_CHANNEL_SOURCE'] : ''; ?>" type="video/mp4">-->
</video>


<div id="divPopup">
	<!--<img id="popupImg" src="" width="420" height="400">-->
</div>
<input type="hidden" id="stop" value="" />

<script type="text/javascript">
	window.setInterval("checkPopupPromo()", 60000);
	//window.setInterval("hidePopupPromo()", 1000);

	function checkPopupPromo() {
		$.ajax({
	        url: "ajax.php",
	        cache: false,
	        type: "GET",
	        data: "mod=popup",
	        success: function(response){   console.log(response);
	           	var str = response.split("|");
	           	var id = str[0];
	           	var duration = parseInt(str[1]) * 1000;
	           	var image = str[2];
	           	var stoptime = str[3];

	           	$("#stop").val(stoptime);
	           	
	           	if(id != "") {
		        	$("#divPopup").append('<img id="popupImg" src="'+image+'" width="420" height="400">');
					window.setTimeout("hidePopupPromo()", duration);
	           	}
	        }
	    });
	}

	function hidePopupPromo() {
		$("#divPopup").empty();
		
	}

</script>

<?php $this->_tpl_include('footer.tpl'); ?>