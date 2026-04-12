<!-- INCLUDE header.tpl -->

<!-- Bground Video 
<video autoplay loop id="bgvid">
    <source src="{T_BG_CLIP_PATH}/wonderful-indonesia-jakarta.mp4" type="video/mp4">
</video>  -->
<div id="pageTitle">{L_PAGE_TITLE}</div>
<div id="apDiv2"></div>
<div id="apDiv3"></div>

<div id="mainDiv">
    <div id="divSafeContainer">
	<!-- IF S_VIEWBILL_EMPTY -->
	<div id="divMessage">{S_MESSAGE}</div>
	<!-- ENDIF -->
	
	<!-- IF S_VIEWBILL_EXIST -->
	<div id="divChannelList">
	    <div id="divChannelListHeader">
		<div id="divFieldHeader">
		    <span class="spanChannlHeader">{L_DATE}</span>
		    <span class="spanChannlHeader2">{L_ITEM}</span>
		    <span class="spanChannlHeader3">{L_AMOUNT}</span>
		</div>
		<div id="divFieldFooter">
		    <span class="spanChannlFooter2">{L_TOTAL_AMOUNT}</span>
		    <span class="spanChannlFooter3">{S_TOTAL_AMOUNT}</span></div>
		<div id="divChannelCount">0/0</div>
	    </div>
	    <div id="divChannelListItems"></div>
	    <div id="divChannelListScrollBar" style="position:relative;left:970px">
		<div id="DV_Scrolluparrow" onclick="media._object.Fn_Up_KeyDownHandler();"></div>
		<div id="DV_Scrollprogress" onclick="media._object.Fn_Click_ScrollBar();">
		    <div id="DV_Scrollshaft"></div>
		</div>
		<div id="DV_Scrolldownarrow" onclick="media._object.Fn_Down_KeyDownHandler();"></div>
	    </div>
	</div>
	<div id="divVideoContainer" class="divVideoContainer" style="position:relative;left:1980px">
	    <video id="media" class="videoControl"></video>
	</div>
	
	<!-- ENDIF -->
    </div>
</div>

<input type="hidden" name="chIndex" id="chIndex" value="" />
<!-- INCLUDE footer.tpl -->
