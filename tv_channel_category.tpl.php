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
    <!--<div id="divLoading" class="divLoading displayNone">
	<img alt="Loading..." src="<?php echo (isset($this->_rootref['T_IMAGESET_PATH'])) ? $this->_rootref['T_IMAGESET_PATH'] : ''; ?>/loading.gif" />
    </div>-->
    <video id="media" class="videoControl"></video>
</div>
<!-- </div> -->
<!-- video end --><?php if ($this->_rootref['PROMO_DISPLAY']) {  ?>

<div id="divPromoContainer">
    <h3><?php echo (isset($this->_rootref['S_PROMO_TITLE'])) ? $this->_rootref['S_PROMO_TITLE'] : ''; ?></h3>
    <div id=divPromo>
	<img src="<?php echo (isset($this->_rootref['S_PROMO_IMAGE'])) ? $this->_rootref['S_PROMO_IMAGE'] : ''; ?>" /><br/>
	<?php echo (isset($this->_rootref['S_PROMO_DESCRIPTION'])) ? $this->_rootref['S_PROMO_DESCRIPTION'] : ''; ?>

    </div>
</div>
<?php } ?>


<div id="apDiv3"></div>
<!-- <div id="apDiv4"><a href="./tv_channel_kategori.php" class="fancybox fancybox.iframe">Test</a></div> -->
<!-- begin menu -->
<!-- <div id="apDiv5" style="text-align:center"> -->
<div id="divChannelList">
    <div id="divChannelListItems">
    </div>
</div>
<div id="divCurrentChannelNameContainer">
    <div id="divCurrentChannelName"></div>
</div>
<!-- </div> -->
<!-- end menu -->
<div id="apDiv6"></div>
<div id="posterLayer"></div>
<div id="divLogo"><!--<img src="<?php echo (isset($this->_rootref['T_IMAGESET_PATH'])) ? $this->_rootref['T_IMAGESET_PATH'] : ''; ?>/logo-small.png" height="85px">--></div>
<!-- fullscreen start-->
<div id="divFullScreenControl" class="displayNone">
    <div id="divVideoFullScreenIcons" class="divVideoFullScreenIconsPlay">
    </div>
    <div id="divFullTrickValue">
    </div>
    <div id="divCurrentChannelNameFullScreen">
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
    </div>
</div>
<!-- fullscreen end -->

<script>
//window.setInterval("checkPromo('scheduled_promo')", 10000);

function checkPromo(mod) {
	$.ajax({
        url: "ajax.php",
        cache: false,
        type: "GET",
        data: "mod=" + mod,
        success: function(response){   
            if(response != "") {
                var promo_image = response;
				$("#divPromo img").attr("src", promo_image);
            } else {
				checkPromo('promo');
			}	 
        }
    });
}
</script>

<?php $this->_tpl_include('footer.tpl'); ?>