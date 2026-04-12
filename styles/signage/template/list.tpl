<style>
#_region1 {
    width:832px;
    height:180px;
    display:block;
    position:absolute;
    top:0;
    /*background-color:red;*/
}
.marq {
    /*padding:0 20px 20px 20px;*/
    color:#fff;
    font-size:20px;
}   
.marq th {
    background-color:red;
	text-align:left;
}
#emergency {
    width:1280px;
    height:600px;
    display:none;
    top:0;
    position:absolute;
}
#region1 {
    width:1280px;
    height:700px;
    top:0;
    position:absolute;
}
</style>
<p id="sql" style="color:#fff"></p>

<input type="hidden" id="region1_type" value="{S_TYPE_1}" />
<input type="hidden" id="region1_header" value="{S_HEADER_1}" />

<!-- SIGNAGE REGIONS -->
<div id="nonrunningtext">
	<div id="region1">
		<input type="hidden" id="region1_content" value="{S_CONTENT_1}" />
		<input type="hidden" id="region1_content_duration" value="{S_DURATION_1}" />
		<input type="hidden" id="region1_schedule" value="" />
		<input type="hidden" id="region1_schedule_stop" value="" />
		<input type="hidden" id="region1_schedule_duration" value="" />
		<input type="hidden" id="region1_counter" value="" />
		<input type="hidden" id="region1_data" value="" />
		<input type="hidden" id="region1_dataCount" value="" /> 
	</div>
</div>

<!-- EMERGENCY -->
<div id="emergency">
    <img src="media/images/signage/emergency.gif" width="100%" height="100%" />
	<div id="emergency_msg" style="width:100%;height:60px;background-color:#fff;color:red;text-align:center;font-size:46px;font-weight:bold;"></div>
</div>

<input type="hidden" id="emergency_stop" value="" />
<input type="hidden" id="urgency_id" value="" />

<script>
var total_region = 1;
var video_region = 0;
var runningtext_region = 0;
var start = 0;
var is_fullscreen = 0;
var myVar, myVar1, myVar2, myVar3, myVar4, myVar5, myFIDS;
</script>
<script type="text/javascript" language="javascript" src="{T_JS_PATH}signage.js"></script>
