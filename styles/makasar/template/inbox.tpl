<!-- INCLUDE header.tpl -->

<!-- Bground Video 
<video autoplay loop id="bgvid">
    <source src="{T_BG_CLIP_PATH}/wonderful-indonesia-jakarta.mp4" type="video/mp4">
</video>  -->
<div id="pageTitle">{L_PAGE_TITLE}</div>
<div id="apDiv2"></div>
<div id="apDiv3"></div>
<div id="divContentBox">
    <div id="divFrom">From:</div>
    <div id="divTime">Date:</div>
    <div id="divContent"></div>
</div>
<div id="mainDiv">
    <div id="divSafeContainer">
	<div id="divChannelList">
	    <div id="divChannelListHeader">
		<div id="divFieldHeader">
		    <span class="spanChannlHeader">{L_DATE}</span>
		    <span class="spanChannlHeader2">{L_FROM}</span>
<!--		    <span class="spanChannlHeader3">{L_CONTENT}</span> -->
		</div>
	    </div>
	    <div id="divChannelListItems"></div>
	    <div id="divChannelListScrollBar" style="position:relative;left:490px">
		<div id="DV_Scrolluparrow" onclick="media._object.Fn_Up_KeyDownHandler();"></div>
		<div id="DV_Scrollprogress" onclick="media._object.Fn_Click_ScrollBar();">
		    <div id="DV_Scrollshaft"></div>
		</div>
		<div id="DV_Scrolldownarrow" onclick="media._object.Fn_Down_KeyDownHandler();"></div>
	    </div>
	</div>
	<div id="divVideoContainer" class="divVideoContainer" style="position:relative;left:1980px">
	    <video id="media" class="videoControl" loop></video>
	</div>
    </div>
</div>

<!-- INCLUDE footer.tpl -->