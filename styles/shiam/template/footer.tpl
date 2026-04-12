</div>
<!-- EMERGENCY -->
<style>
#emergency {
	width:100%;
	height:100%;
	/*display:none;*/
	top:0;
	position:absolute;
	z-index:120;
}
</style>
<div id="emergency">
	<!--<img src="media/images/signage/emergency.gif" width="100%" height="100%" />
	<div id="emergency_msg" style="width:100%;height:60px;background-color:#fff;color:red;text-align:center;font-size:46px;font-weight:bold;"></div>
	<div id="alert_audio"></div>-->
</div>
<input type="hidden" id="emergency_stop" value="" />
<input type="hidden" id="urgency_id" value="" />

<input type="hidden" id="lang_id" value="{S_USER_LANG}" />
<input type="hidden" id="rText" value="{S_RUNNINGTEXT}" />

<script type="text/javascript" language="javascript" src="{T_JS_PATH}emergency.js"></script>
<script type="text/javascript">
	window.setInterval("checkEmergency()", 5000);
	//window.setInterval("stopEmergency()", 1000);
	window.setInterval("checkRunningtext()", 10000);
	window.setInterval("checkConfig()", 60000);
	window.setInterval("displaytime()", 1000);

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
		           	var rText = '<marquee scrollamount="3" loop="" style="width:1280px;">' + response + '</marquee>';
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
	
	var currenttime = $("#divCurrentTime").val(); 
	var ctime = currenttime.split("/");

	var serverdate = new Date(ctime[0],ctime[1],ctime[2],ctime[3],ctime[4],ctime[5])

	function padlength(what){
		var output = (what.toString().length==1)? "0"+what : what;
		return output;
	}
	
	function displaytime(){ 
		serverdate.setSeconds(serverdate.getSeconds()+1);
		var hour = serverdate.getHours() > 12 ? serverdate.getHours() - 12 : serverdate.getHours();
		//var hour = serverdate.getHours();
		var minute = serverdate.getMinutes();
		var am_pm = serverdate.getHours() >= 12 ? "PM" : "AM";
		
		var timestring = " " + padlength(hour) + "." + padlength(minute) +" " + am_pm;
		$("#clock").html(timestring);
	}

	function checkConfig() {
		$.ajax({
	        url: "ajax.php",
	        cache: false,
	        type: "GET",
	        data: "mod=bldate",
	        success: function(response){   
				if(response != "") {
					//location.href = "http://192.168.0.14/navicom_smi/message.php";
					location.reload();
				}
	        }
	    });
	}
	
	function blinker() {
	    $('#divNewMessage').fadeOut(1000).fadeIn(1000);
	}

	window.setInterval("blinker()", 1000);

	
</script>
<!-- IF S_NEW_MESSAGE --><div id="divNewMessage">{S_NEW_MESSAGE}</div><!-- ENDIF -->
<!-- IF S_SHOW_RUNNINGTEXT -->
<div id="runningText"><marquee scrollamount="3" loop="" style="width:1280px;">{S_RUNNINGTEXT}</marquee></div>
<!-- ENDIF -->
</body>

</html>
