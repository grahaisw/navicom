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

/* Fullscreen */
#flightFullscreen {
	position:absolute;
	top:0;
	left:0;
	width:100%;
	height:100%;
	background-color:#000;
	color:#fff;
	opacity:0.8;
	display:none;
	z-index:102;
}
#flightGateFullscreen {
	font-size:80px;
	text-align:center;
	position:absolute;
	top:40px;
	left:100px;
	width:400px;
}
#flightLogoFullscreen {
	position:absolute;
	top:40px;
	right:100px;
}
#flightNoFullscreen {
	font-size:80px;
	font-weight:bold;
	position:absolute;
	left:420px;
	top:220px;
}
#flightTimeFullscreen {
	font-size:60px;
	position:absolute;
	left:180px;
	top:225px;
}
#flightCityFullscreen {
	font-size:50px;
	position:absolute;
	left:420px;
	top:340px;
}
#flightRemarkFullscreen {
	font-size:80px;
	text-align:center;
	position:relative;
	top:530px;
	background-color:red;
}

/* Fullscreen Left */
#flightFullscreenLeft {
	position:absolute;
	top:0;
	left:0;
	width:60%;
	height:100%;
	background-color:#000;
	color:#fff;
	opacity:0.8;
	display:none;
	z-index:102;
}
#flightGateFullscreenLeft {
	font-size:80px;
	text-align:left;
	position:absolute;
	top:40px;
	left:40px;
	width:400px;
}
#flightLogoFullscreenLeft {
	position:absolute;
	top:40px;
	right:30px;
}
#flightNoFullscreenLeft {
	font-size:80px;
	font-weight:bold;
	position:absolute;
	left:260px;
	top:220px;
}
#flightTimeFullscreenLeft {
	font-size:60px;
	position:absolute;
	left:40px;
	top:225px;
}
#flightCityFullscreenLeft {
	font-size:50px;
	position:absolute;
	left:260px;
	top:340px;
}
#flightRemarkFullscreenLeft {
	font-size:80px;
	text-align:center;
	position:relative;
	top:530px;
	background-color:red;
}

/* Single Popup */
#flight {
	position:absolute;
	top:0;
	right:0;
	width:40%;
	height:100%;
	background-color:#000;
	color:#fff;
	opacity:0.8;
	display:none;
	z-index:102;
}
#flightGate {
	font-size:50px;
	text-align:center;
	position:absolute;
	top:40px;
	right:280px;
	width:220px;
}
#flightLogo {
	position:absolute;
	top:0;
	right:0;
}
#flightNo {
	font-size:50px;
	font-weight:bold;
	position:absolute;
	left:150px;
	top:180px;
}
#flightTime {
	font-size:40px;
	position:absolute;
	left:15px;
	top:185px;
}
#flightCity {
	font-size:30px;
	position:absolute;
	left:150px;
	top:240px;
}
#flightRemark {
	font-size:50px;
	text-align:center;
	position:relative;
	top:330px;
	background-color:#089108;
}

/* Priority 1 */
#flight1 {
	position:absolute;
	top:0;
	right:0;
	width:40%;
	height:50%;
	background-color:#000;
	color:#fff;
	opacity:0.8;
	display:none;
	z-index:102;
}
#flightGate1 {
	font-size:40px;
	text-align:center;
	position:absolute;
	top:40px;
	right:280px;
	width:220px;
}
#flightLogo1 {
	position:absolute;
	top:0;
	right:0;
}
#flightNo1 {
	font-size:40px;
	font-weight:bold;
	position:absolute;
	left:150px;
	top:130px;
}
#flightTime1 {
	font-size:30px;
	position:absolute;
	left:15px;
	top:135px;
}
#flightCity1 {
	font-size:20px;
	position:absolute;
	left:150px;
	top:180px;
}
#flightRemark1 {
	font-size:40px;
	text-align:center;
	position:relative;
	top:250px;
	background-color:#089108;
}

/* Priority 2 */
#flight2 {
	position:absolute;
	top:350px;
	right:0;
	width:40%;
	height:50%;
	background-color:#000;
	color:#fff;
	opacity:0.8;
	display:none;
	z-index:102;
	border-top:1px solid #fff;
}
#flightGate2 {
	font-size:40px;
	text-align:center;
	position:absolute;
	top:40px;
	right:280px;
	width:220px;
}
#flightLogo2 {
	position:absolute;
	top:0;
	right:0;
}
#flightNo2 {
	font-size:40px;
	font-weight:bold;
	position:absolute;
	left:150px;
	top:130px;
}
#flightTime2 {
	font-size:30px;
	position:absolute;
	left:15px;
	top:135px;
}
#flightCity2 {
	font-size:20px;
	position:absolute;
	left:150px;
	top:180px;
}
#flightRemark2 {
	font-size:40px;
	text-align:center;
	position:relative;
	top:250px;
	background-color:#1343c6;
}
</style>
<div id="emergency">
	<img src="media/images/signage/emergency.gif" width="100%" height="100%" />
	<div id="emergency_msg" style="width:100%;height:60px;background-color:#fff;color:red;text-align:center;font-size:46px;font-weight:bold;"></div>
</div>

<div id="flightFullscreen">
	<div id="flightLogoFullscreen"><img src="" width="280" /></div>
	<div id="flightGateFullscreen"></div>
	<div id="flightNoFullscreen"></div>
	<div id="flightCityFullscreen"></div>
	<div id="flightTimeFullscreen"></div>
	<div id="flightRemarkFullscreen"></div>
</div>
<div id="flightFullscreenLeft">
	<div id="flightLogoFullscreenLeft"><img src="" width="280" /></div>
	<div id="flightGateFullscreenLeft"></div>
	<div id="flightNoFullscreenLeft"></div>
	<div id="flightCityFullscreenLeft"></div>
	<div id="flightTimeFullscreenLeft"></div>
	<div id="flightRemarkFullscreenLeft"></div>
</div>

<div id="flight">
	<div id="flightLogo"><img src="" width="220" /></div>
	<div id="flightGate"></div>
	<div id="flightNo"></div>
	<div id="flightCity"></div>
	<div id="flightTime"></div>
	<div id="flightRemark"></div>
</div>

<div id="flight1">
	<div id="flightLogo1"><img src="" width="220" /></div>
	<div id="flightGate1"></div>
	<div id="flightNo1"></div>
	<div id="flightCity1"></div>
	<div id="flightTime1"></div>
	<div id="flightRemark1"></div>
</div>
<div id="flight2">
	<div id="flightLogo2"><img src="" width="220" /></div>
	<div id="flightGate2"></div>
	<div id="flightNo2"></div>
	<div id="flightCity2"></div>
	<div id="flightTime2"></div>
	<div id="flightRemark2"></div>
</div>

<input type="hidden" id="emergency_stop" value="" />
<input type="hidden" id="urgency_id" value="" />
<input type="hidden" id="status" value="" />

<input type="hidden" id="lang_id" value="{S_USER_LANG_ID}" />
<input type="hidden" id="rText" value="" />

<script type="text/javascript" language="javascript" src="{T_JS_PATH}emergency.js"></script>
<script type="text/javascript">
	//window.setInterval("checkEmergency()", 5000);
	//window.setInterval("stopEmergency()", 1000);
	window.setInterval("checkRunningtext()", 60000);
	window.setInterval("checkFlightStatus()", 25000);

	function checkRunningtext() {
		var lang_id = $("#lang_id").val();

		$.ajax({
	        url: "ajax.php",
	        cache: false,
	        type: "GET",
	        data: "mod=runningtext&lang=" + lang_id,
	        success: function(response){   
				var response = response.replace(/(\r\n|\n|\r)/gm,"");
	           	var current = $("#rText").val(); 
				if(response != "" && response != current) { //alert(response + ' ... ' +current);
					var rText = '<marquee scrollamount="4" loop="" style="width:1280px;">' + response + '</marquee>';
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
	
	function checkFlightStatus() {
		$.ajax({
	        url: "ajax.php",
	        cache: false,
	        type: "GET",
	        data: "mod=flight_status",
	        success: function(response){ console.log(response);
	           	if(response != "") {
		           	var str = response.split("|");
					if(str.length == 1) { 
						var data = str[0].split(";");
						var mode = data[0].replace(/(\r\n|\n|\r)/gm,"");
						
						if(mode != "runningtext") {
						
							var flight_no = data[1];
							var remark = data[2];
							var priority = data[3];
							var gate = data[4];
							var time = data[5];
							var city = data[6];
							var logo = data[7];
							var duration = data[8] * 1000;
							
							if(mode == "popup") {
								$("#flight").css('display','block');
								$("#flightLogo img").attr('src', logo);
								$("#flightGate").html(gate);
								$("#flightNo").html(flight_no);
								$("#flightCity").html(city);
								$("#flightTime").html(time);
								$("#flightRemark").html(remark);
								document.getElementById('media').pause();
								
								/*if(priority == 1) {
									$("#flightRemark").css('background-color', '#089108');
								}*/
								
								window.setTimeout("hideFlightStatus('flight')", duration);
								window.setTimeout("document.getElementById('media').play()", duration);
								
							} else if(mode == "fullscreen") {
								$("#flightFullscreen").css('display','block');
								$("#flightLogoFullscreen img").attr('src', logo);
								$("#flightGateFullscreen").html(gate);
								$("#flightNoFullscreen").html(flight_no);
								$("#flightCityFullscreen").html(city);
								$("#flightTimeFullscreen").html(time);
								$("#flightRemarkFullscreen").html(remark);
								if(remark == "Boarding" || remark == "Second Call") {
                                                                        $("#flightRemarkFullscreen").css('background-color','yellow');
                                                                        $("#flightFullscreen").css('color','#000');
                                                                        $("#flightFullscreen").css('background-color','#fff');
                                                                } else if(remark == "Change Gate") {
                                                                        $("#flightRemarkFullscreen").css('background-color','green');
                                                                        //$("#flightFullscreen").css('color','#0');
                                                                        //$("#flightFullscreen").css('background-color','#fff');
                                                                }
								document.getElementById('media').pause();
								
								window.setTimeout("hideFlightStatus('flightFullscreen')", duration);
								window.setTimeout("document.getElementById('media').play()", duration);
							}
						
						}
						
					} else { 
						//var current_fullscreen = $("#status").val();
						for(var i=0; i<str.length; i++) {
							var j = i+1;
							var data = str[i].split(";");
							var mode = data[0].replace(/(\r\n|\n|\r)/gm,"");
							var flight_no = data[1];
							var remark = data[2];
							var priority = data[3];
							var gate = data[4];
							var time = data[5];
							var city = data[6];
							var logo = data[7];
							var duration = data[8] * 1000;
							
							if(mode == "popup") {
								$("#flight"+j).css('display','block');
								$("#flightLogo"+j+" img").attr('src', logo);
								$("#flightGate"+j).html(gate);
								$("#flightNo"+j).html(flight_no);
								$("#flightCity"+j).html(city);
								$("#flightTime"+j).html(time);
								$("#flightRemark"+j).html(remark);
								document.getElementById('media').pause();
								
								window.setTimeout("hideFlightStatus('flights')", duration);
								window.setTimeout("document.getElementById('media').play()", duration);
							} else if(mode == "fullscreen") {
								//if(current_fullscreen != flight_no) {
			
								
								$("#flightFullscreen").css('display','block');
								$("#flightLogoFullscreen img").attr('src', logo);
								$("#flightGateFullscreen").html(gate);
								$("#flightNoFullscreen").html(flight_no);
								$("#flightCityFullscreen").html(city);
								$("#flightTimeFullscreen").html(time);
								$("#flightRemarkFullscreen").html(remark);
								if(remark == "Boarding" || remark == "Second Call") {
									$("#flightRemarkFullscreen").css('background-color','yellow');
									$("#flightFullscreen").css('color','#000');
									$("#flightFullscreen").css('background-color','#fff');
								} else if(remark == "Change Gate") {
									$("#flightRemarkFullscreen").css('background-color','green');
                                                                        $("#flightFullscreen").css('color','#fff');
                                                                        $("#flightFullscreen").css('background-color','#000');
								} else if(remark == "Last Call") {
									$("#flightRemarkFullscreen").css('background-color','!important#f00');
									$("#flightFullscreen").css('color','#fff');
									$("#flightFullscreen").css('background-color','#000');
								}
								//$("#status").val(flight_no);
								document.getElementById('media').pause();
								
								window.setTimeout("hideFlightStatus('flightFullscreen')", duration);
								window.setTimeout("document.getElementById('media').play()", duration);
								//}
							}
							
						}
					}
	           	} 
	        }
	    });
	}i
	
	function hideFlightStatus(id) {
		if(id == 'flights') {
			$("#flight1").hide();
			$("#flight2").hide();
		} else {
			$("#"+id).hide();
		}
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
<div id="runningText"><marquee scrollamount="2" loop="" style="width:1280px;">{S_RUNNINGTEXT}</marquee></div>
<!-- ENDIF -->
</body>

</html>
