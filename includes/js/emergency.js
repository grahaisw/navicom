function checkEmergency() {
    $.ajax({
        url: "emergency_ajax.php",
        cache: false,
        type: "GET",
        data: "mod=urgency",
        success: function(response){  
            if(response != '') {
				console.log(response);
				var str = '[' + response + ']';
				var obj = JSON.parse(str);
				var total_data = obj.length;
				
				for(var i=0; i<total_data; i++) {
					var flag = obj[i].flag;
					var enabled = obj[i].enabled;
					var stoptime = obj[i].stoptime;
					var display = obj[i].display;
					var duration = obj[i].duration * 1000;
					
					if(flag == "emergency") {
						if(enabled == 1) {
							var emergency_stop = $("#emergency_stop").val();
							if(emergency_stop == "") {
								$("#nonemergency").hide();
								$("#emergency").show();
								$("#emergency_stop").val(stoptime);
								$("#urgency_id").val(obj[i].id);
								$("#emergency_msg").html(obj[i].message);
				
								window.setTimeout("stopEmergency()", duration);
							}
						} else {
							$("#emergency").hide();
							$("#nonemergency").show();
							$("#emergency_stop").val("");
						}
					} 
				}
			}
              
        }
    });
}

function stopEmergency() {
    var current = getCurrentDatetime('detail');
    var stoptime = $("#emergency_stop").val();
    var id = $("#urgency_id").val();
    
   // if(current == stoptime) {
        $.ajax({
            url: "emergency_ajax.php",
            cache: false,
            type: "GET",
            data: "mod=urgencystop&id=" + id,
            success: function(response){
                $("#emergency").hide();
                $("#nonemergency").show();
                $("#emergency_stop").val("");
				$("#urgency_id").val("");
				
            }
        });
    //}
}

function getCurrentDatetime(mod) {
    var dt = new Date();
	
    var y = dt.getFullYear();
    var m = parseInt(dt.getMonth()) + 1;
    var d = dt.getDate();
    var h = dt.getHours();
    var i = dt.getMinutes();
    var s = dt.getSeconds();
    
    if(m < 10) m = "0" + m;
    if(d < 10) d = "0" + d;
    if(h < 10) h = "0" + h;
    if(i < 10) i = "0" + i;
    if(s < 10) s = "0" + s;
    
    if(mod == 'detail') {    
        var current = y + "-" + m + "-" + d + " " + h + ":" + i + ":" + s;
    } else if(mod == 'clock') {
        var current = h + ":" + i + ":" + s;
    } else {
        var current = y + "-" + m + "-" + d + " " + h + ":" + i;
    }
	
	return current;
}
