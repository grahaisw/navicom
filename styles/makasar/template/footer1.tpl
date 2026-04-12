</div>
<!-- EMERGENCY -->
<style>
#emergency {
	width:100%;
	height:100%;
	display:none;
	top:0;
	position:absolute;
}
</style>
<style style="text/css">
.marquee p {
 position: absolute;
 width: 100%;
 height: 100%;
 margin: 0;
 line-height: 30px;
 text-align: center;
 -moz-transform:translateX(100%);
 -webkit-transform:translateX(100%);	
 transform:translateX(100%);
 -moz-animation: scroll-left 50s linear infinite;
 -webkit-animation: scroll-left 50s linear infinite;
 animation: scroll-left 50s linear infinite;
}
@-moz-keyframes scroll-left {
 0%   { -moz-transform: translateX(100%); }
 100% { -moz-transform: translateX(-100%); }
}
@-webkit-keyframes scroll-left {
 0%   { -webkit-transform: translateX(100%); }
 100% { -webkit-transform: translateX(-100%); }
}
@keyframes scroll-left {
 0%   { 
 -moz-transform: translateX(100%); 
 -webkit-transform: translateX(100%); 
 transform: translateX(100%); 		
 }
 100% { 
 -moz-transform: translateX(-100%); 
 -webkit-transform: translateX(-100%); 
 transform: translateX(-100%); 
 }
}
</style>
<div id="emergency">
	<img src="media/images/signage/emergency.gif" width="100%" height="100%" />
	<div id="emergency_msg" style="width:100%;height:60px;background-color:#fff;color:red;text-align:center;font-size:46px;font-weight:bold;"></div>
</div>
<input type="hidden" id="emergency_stop" value="" />
<input type="hidden" id="urgency_id" value="" />

<input type="hidden" id="lang_id" value="{S_USER_LANG_ID}" />
<input type="hidden" id="rText" value="{S_RUNNINGTEXT}" />

<script type="text/javascript" language="javascript" src="{T_JS_PATH}emergency.js"></script>
<script type="text/javascript">
	//window.setInterval("checkEmergency()", 5000);
	//window.setInterval("stopEmergency()", 1000);
	window.setInterval("checkRunningtext()", 60000);

	function checkRunningtext() {
		var lang_id = $("#lang_id").val();

		$.ajax({
	        url: "ajax.php",
	        cache: false,
	        type: "GET",
	        data: "mod=runningtext&lang=" + lang_id,
	        success: function(response){   console.log(response);
	           	var current = $("#rText").val();
				if(response != "" && response != current) {
		           	var rText = '<marquee scrollamount="7" loop="" style="width:1280px;">' + response + '</marquee>';
		           	$("#runningText").empty();
		           	$("#runningText").append(rText);
					
					$("#rText").val(response);
	           	} else if(response == "") {
					$("#runningText").empty();
					$("#rText").val('');
				}
	        }
	    });
	}
	
	//window.onload("blink()");
	function blinker() {
	    $('#divNewMessage').fadeOut(100).fadeIn(100);
	}

	window.setInterval("blinker()", 1000);

	
</script>
<!-- IF S_NEW_MESSAGE -->
<div id="divNewMessage">{S_NEW_MESSAGE}</div>
<!-- ENDIF -->
<!-- IF S_SHOW_RUNNINGTEXT -->
<!--<div id="runningText"><marquee scrollamount="7" loop="" style="width:1280px;">{S_RUNNINGTEXT}</marquee></div>-->
<div id="runningText" class="marquee" style="width:1280px;height:30px;"><p>{S_RUNNINGTEXT}</p></div>
<!-- ENDIF -->
</body>

</html>
