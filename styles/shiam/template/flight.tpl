<!-- INCLUDE header.tpl -->

<div id="pageTitle">{L_SUBTITLE}</div>
<div id="apDiv2"></div>
<div id="apDiv3"></div>
<div id="AirportTitle">{L_PAGE_TITLE}</div>

<!-- IF S_FIDS -->
<div id="divLastupdate">{L_LASTUPDATE}: {S_LASTUPDATE}, {S_SOURCE}</div>
<div id="mainDiv">
    <div id="divSafeContainer">
	<div id="divChannelList">
	    <div id="divChannelListHeader">
		<div id="divFieldHeader">
		    <span class="spanChannlHeader">{L_AIRLINE}</span>
		    <span class="spanChannlHeader2">{L_FLIGHT}</span>
		    <span class="spanChannlHeader3">{L_ORIGIN_DESTINATION}</span> 
		    <span class="spanChannlHeader4">{L_SCHEDULE}</span> 
		    <span class="spanChannlHeader5">{L_GATE}</span> 
		    <span class="spanChannlHeader6">{L_REMARK}</span> 
		</div>
	    </div>
	    <div id="divChannelListItems"></div>
	    <div id="divChannelListScrollBar" style="position:relative;left:1060px">
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
<div id="flight"><a id="change" name="change" href="{S_URL}">{L_TOGGLE}</a></div>
<!-- ENDIF -->

<!-- IF S_SELECT -->
<div id="mainDiv">
    <div id="divSafeContainer1">
	<!-- BEGIN airport -->
	<div class="flight1"><a id="change" href="{airport.S_URL}">{airport.S_AIRPORT_CODE} {airport.S_AIRPORT_NAME}</a> </div><br/>
	<!-- END airport -->
    </div>
</div>
<!-- ENDIF -->

<!-- INCLUDE footer.tpl -->