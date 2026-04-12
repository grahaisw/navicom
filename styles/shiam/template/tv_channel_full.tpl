<!-- INCLUDE header.tpl -->

<input type="hidden" id="divCurrentChannelOrder" value="{S_TV_CHANNEL_ORDER}" />

<!--<div id="divVideoContainer" class="divVideoContainer divVideoContainer_fullScreen">
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
    <video id="media" class="videoControl"></video>
</div>-->

<div id="divChannelCover">	
	<div id="divChannelIndexNO"></div>
	<div id="divChannelIndexIndicator"></div>	
</div>

<video autoplay loop id="media" src="{S_TV_CHANNEL_SOURCE}">
	<!--<source src="{S_TV_CHANNEL_SOURCE}" type="video/mp4">-->
</video>

<!-- INCLUDE footer.tpl -->






