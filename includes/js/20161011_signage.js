for(var i=2; i<=total_region; i++) {   
    playlist('default', i);
}

window.setInterval("checkDefault()", 10000);
window.setInterval("checkPlaylist()", 15000);
window.setInterval("stopPlaylist()", 14000);
//window.setInterval("checkEmergency()", 5000);
//window.setInterval("stopEmergency()", 1000);

function playlist(data, region, is_fullscreen) {  
    var region_type = getRegionType(region);
    
    if(region_type == "clip") {	
        // ambil data
        var videoSource = getContent(data, region);
        
        var i = 0;
        var videoCount = videoSource.length; 
        
        $("#region"+region+"_counter").val(i);
        $("#region"+region+"_data").val(data);
        $("#region"+region+"_dataCount").val(videoCount);
        
		$("#myVideo").remove();
		
		// play video
		if(is_fullscreen == 1) {
			$("#nonrunningtext").hide();
			$("#fullscreen").show();
			$("#fullscreen").append('<video id="myVideo" width="100%" height="100%" autoplay="true" preload="auto" src="'+videoSource[i]+'"></video>');
		} else {
			$("#fullscreen").hide();
			$("#nonrunningtext").show();
			$("#region"+region).append('<video id="myVideo" width="100%" height="100%" autoplay="true" preload="auto" src="'+videoSource[i]+'"></video>');
		}
		
        // catat log
        var log = addLog(videoSource[i],data);
        
        // jika video/clip selesai (durasi habis)
        document.getElementById('myVideo').addEventListener('ended', function() { handler(region) }, false);
        
    } else if(region_type == "text") {
        // ambil data
        var contentSource = getContent(data, region);
        var dataCount = contentSource.length; 
        var media_path = getMediaPath(region_type);
        
        $("#region"+region+"_counter").val(start);
        $("#region"+region+"_data").val(data);
        $("#region"+region+"_dataCount").val(dataCount);
        
        var text = contentSource.join(' <img src="' + media_path + 'separator.png" height="20" style="margin:0 15px" /> ');
        $("#region"+region+" marquee").remove();
        $("#region"+region).append('<marquee scrollamount="10" loop="" scrolldelay="3">'+text+'</marquee>');
        
        // catat log
        for(var i=0; i<dataCount; i++) {
            var log = addLog(contentSource[i],data);
        }
        
    } else if(region_type == "rss") {
        // ambil data
        var contentSource = getContent(data, region);
        var dataCount = contentSource.length; 
        
        $("#region"+region+"_counter").val(start);
        $("#region"+region+"_data").val(data);
        $("#region"+region+"_dataCount").val(dataCount);
        
        $("#region"+region+"_isi").remove();
        
        //$("#region"+region).append('<p id="region'+region+'_isi" class="marq"><marquee scrollamount="3" loop="" scrolldelay="3" direction="up" style="height:100%">'+contentSource[start]+'</marquee></p>');
        
        //$("#region"+region).append('<table id="region'+region+'_isi" class="marq" width="100%" border="0" cellspacing="0" cellpadding="2"><thead><th>Airline</th><th>Flight</th><th>Destination</th><th>Scheduled Time</th><th>Terminal</th><th>Gate</th><th>Remarks</th></thead><tbody id="tab_content">'+contentSource[start]+'</tbody></table>');
		
		$("#region"+region).append('<table id="region'+region+'_isi" class="marq" width="100%" border="0" cellspacing="0" cellpadding="2"><thead>');
		
		var head = $("#region"+region+"_header").val();
		var header = head.split("|");
		for(var i=0; i<header.length; i++) {
			$("#region"+region+"_isi").append('<th>'+header[i]+'</th>');
		}
		$("#region"+region+"_isi").append('</thead><tbody id="tab_content">'+contentSource[start]+'</tbody></table>');
        
        myFIDS = setInterval("slidemessage("+region+")", 5000);
        
    } else if(region_type == "clock") {	
        var current_day = moment().format('dddd'); 
        var current_date = moment().format('MMM Do, YYYY'); 
		var current_time = getCurrentDatetime('clock');
        
        $("#region"+region+"_isi").remove();
        
        $("#region"+region).append('<div id="region'+region+'_isi" style="text-align:center;background-color:#000;color:#fff;opacity:1;margin:0px;padding:0px;height:100%;font-family:Arial;font-weight:bold;border:1px solid #333;"><p style="font-size:40px;margin:0;padding:40px 40px 0 0;text-align:right;">'+ current_day +'<br/>' + current_date + '</p><p id="time" style="font-size:100px;margin-top:30px;">' + current_time + '</p></div>');
        
        var myVar = setInterval(function(){myTimer()}, 1000);

        function myTimer() {
            var d = new Date();
            var t = getCurrentDatetime('clock');
            document.getElementById("time").innerHTML = t;
        }
        
    } else if(region_type == "image") {
        // ambil data
        var contentSource = getContent(data, region);
        
        if(data == "default") var duration = $("#region"+region+"_content_duration").val();
        else var duration = $("#region"+region+"_schedule_duration").val();
        
        var imageCount = contentSource.length;
        
        $("#region"+region+"_counter").val(start);
        $("#region"+region+"_data").val(data);
        $("#region"+region+"_dataCount").val(imageCount);
        $("#region"+region+"_isi").remove();
        
        $("#region"+region).append('<img id="region'+region+'_isi" src="'+contentSource[start]+'" width="100%" height="100%" style="margin-top:0" />');
        
        // catat log
        var log = addLog(contentSource[start],data);
        
        if(duration > 0) {  // jika content image adalah playlist, maka jalankan fungsi imageSwap()
            window['myVar'+region] = setInterval("imageSwap("+region+")", duration);
        }
        
    }     
}

function handler(region) {
    myHandler(region);
}

function myHandler(region) {
    var i = $("#region"+region+"_counter").val();
    var videoCount = $("#region"+region+"_dataCount").val();
    
    if(i < (videoCount-1)){
        i++;
    }
    else if(i == (videoCount-1)){
        i = 0;
    }
    
    $("#region"+region+"_counter").val(i);
    videoPlay(i, region);
}

function videoPlay(videoNum, region) {   
    var data = $("#region"+region+"_data").val();
    
    var videoSource = getContent(data, region);
    
    // catat log
    var log = addLog(videoSource[videoNum],'');
    
    document.getElementById("myVideo").setAttribute("src",videoSource[videoNum]);
    //document.getElementById("myVideo").load();
    document.getElementById("myVideo").play();
}

function imageSwap(region) {  
    var data = $("#region"+region+"_data").val();
    var duration = $("#region"+region+"_schedule_duration").val();
    var i = $("#region"+region+"_counter").val();
    var imageCount = $("#region"+region+"_dataCount").val();
    
    var contentSource = getContent(data, region);
    
    if(i < (imageCount-1)){
        i++;
    }
    else if(i == (imageCount-1)){
        i = 0;      
    }
    
    $("#region"+region+"_counter").val(i);
    $("#region"+region+" img").attr("src", contentSource[i]);
    
    // catat log
    var log = addLog(contentSource[i],'');
}

function slidemessage(region){ 
    var data = $("#region"+region+"_data").val();
    var i = $("#region"+region+"_counter").val();
    var dataCount = $("#region"+region+"_dataCount").val();
    
    var contentSource = getContent(data, region);
    
    if (i < (dataCount-1)) {
        i++;
    } else if(i == (dataCount-1)) {
        i = 0
    }    
    
    $("#region"+region+"_counter").val(i);
    $("#tab_content").html(contentSource[i]);
    
}

function getContent(data, region) {
    var region_type = $("#region"+region+"_type").val();
    var media_path = getMediaPath(region_type);
    
    if(data == "default") {
        var con = $("#region"+region+"_content").val(); 
    } else {
        var con = data; 
    }
    
    var contentSource = new Array();
    
    if(con.indexOf("|") > -1) { // jika ada lebih dari 1 source, delimited by pipe (|)
        var content = con.split("|"); 
        var count = content.length;
        
        for(var j=0; j<count; j++) {
            if(region_type == "clip" || region_type == "image") {
                contentSource[j] = media_path + content[j];
            } else {
                contentSource[j]= content[j];
            }
        }
    } else {
        if(region_type == "clip" || region_type == "image") {
            contentSource[0] = media_path + con;
        } else {
            contentSource[0]= con;
        } 
    }
    
    
    return contentSource;
}

function checkDefault() {
    $.ajax({
        url: "signage_ajax.php",
        cache: false,
        type: "GET",
        data: "mod=default",
        success: function(response){   
            if(response != "") {
                var content = response.split(";"); 
                
                for(var i=0; i<content.length; i++) {
                    var content_data = content[i].split("^"); 
                    var default_source = content_data[0];
                    var region = content_data[1];
                    var duration = content_data[2];
                    var region_type = content_data[3];
					var region_header = content_data[4];
                    
                    var running_content = $("#region"+region+"_content").val();
                    
                    if(default_source != running_content) { 
                        $("#region"+region+"_content").val(default_source);
                        $("#region"+region+"_content_duration").val(duration);
                        $("#region"+region+"_type").val(region_type);
						$("#region"+region+"_header").val(region_header);
                        
                        clearInterval(myFIDS);
                        playlist(default_source, region);
                    }
                    
                }
            }
        }
    });
}

function checkPlaylist() {
    $.ajax({
        url: "signage_ajax.php",
        cache: false,
        type: "GET",
        data: "mod=playlist",
        success: function(response){   
            //$("#sql").html(response);
            var content = response.split(";");  
            if(response != "") {
                for(var i=0; i<content.length; i++) {   
                    var content_data = content[i].split("^");                
                    var source = content_data[0];
                    var end = content_data[1];
                    var region = content_data[2];
                    var duration = content_data[3];
					var is_fullscreen = content_data[4];
                    
                    var running_schedule = $("#region"+region+"_schedule").val();
                    var schedule_stop = $("#region"+region+"_schedule_stop").val();
                    
                    if(source != running_schedule) {
                        $("#region"+region+"_schedule").val(source);
						$("#region"+region+"_schedule_stop").val(end);
						$("#region"+region+"_schedule_duration").val(duration);
						
                        playlist(source, region, is_fullscreen);
                    }
                    
                }
            }
        }
    });
}

function stopPlaylist() {
    var current = getCurrentDatetime('');
    
    for(var i=2; i<=total_region; i++) {
        var schedule_stop = $("#region"+i+"_schedule_stop").val();
        if(schedule_stop != "") {
            if(schedule_stop.indexOf("|") > -1) {
                var stop = schedule_stop.split("|");
                stop = stop[0];
            } else {
                var stop = schedule_stop;
            }
            
            if(current == stop) {    
                if(i == video_region) {	
                    document.getElementById("myVideo").pause();
                }
                $("#region"+i+"_schedule").val('');
                $("#region"+i+"_schedule_stop").val('');
                $("#region"+i+"_schedule_duration").val('');
                
                clearInterval(window['myVar'+i]);
                playlist('default', i);
            }
        }
    }
}

function addLog(source,data) {
    /*if(data != "default") { // jika yg running adalah scheduled playlist (bukan default), maka log baru dicatat
        $.ajax({
            url: "signage_log.php",
            cache: false,
            type: "GET",
            data: "mod=log&src=" + source,
            success: function(response){   
                return response;
            }
        });
    }*/
}

function checkEmergency() {
    $.ajax({
        url: "signage_ajax.php",
        cache: false,
        type: "GET",
        data: "mod=urgency",
        success: function(response){  
            var str = '[' + response + ']';
            var obj = JSON.parse(str);
            var total_data = obj.length;
            
            for(var i=0; i<total_data; i++) {
                var flag = obj[i].flag;
                var enabled = obj[i].enabled;
                var stoptime = obj[i].stoptime;
				var display = obj[i].display;
                
                if(flag == "emergency") {
                    if(enabled == 1) {
                        var emergency_stop = $("#emergency_stop").val();
                        if(emergency_stop == "") {
							$("#nonrunningtext").hide();
							$("#fids").hide();
							$("#emergency").show();
							$("#emergency_stop").val(stoptime);
							$("#urgency_id").val(obj[i].id);
							$("#emergency_msg").html(obj[i].message);
                        }
                    } else {
                        $("#emergency").hide();
                        $("#nonrunningtext").show();
                        $("#emergency_stop").val("");
                    }
                } else if(flag == "fids") {
                    if(enabled == 1) {
                        var urgency_stop = $("#emergency_stop").val();
                        if(urgency_stop == "") {
                            if(display == "full") {
								$("#nonrunningtext").hide();
								$("#emergency").hide();
								$("#fids").show();
								$("#emergency_stop").val(stoptime);
							
								$("#airline img").attr("src",obj[i].airline);
								$("#flight_number").html(obj[i].flight_number);
								$("#destination").html(obj[i].destination);
								$("#dep_gate").html(obj[i].gate);
								$("#dep_time").html(obj[i].time);
								$("#message").html(obj[i].message);
								$("#urgency_id").val(obj[i].id);
								
							} else if(display == "text") {
								$("#emergency_stop").val(stoptime);
								$("#urgency_id").val(obj[i].id);
								
								var str = obj[i].flight_number + ' - ' + obj[i].destination + ' - ' + obj[i].gate + ' - ' + obj[i].time + ' - ' + obj[i].message;
								
								playlist(str, runningtext_region);
							}
                        }    
                        var next_counter = parseInt(i) + 1;
                        
                        if(next_counter < total_data) {
                            $("#fids_queue").empty();
                                
                            var queue_data = queue_data + '<tr height="80">' + 
                                '<td align="center" width="10" style="vertical-align:top;font-size:20px;">'+obj[next_counter].time+'</td>' +
                                '<td align="left" width="100" style="vertical-align:top;font-size:20px;">'+obj[next_counter].flight_number+' <br/>'+obj[next_counter].destination+'</td>' + 
                                '<td align="right" width="20" style="vertical-align:top;font-size:18px;">'+obj[next_counter].message+'</td>' +
                            '</tr>';
                           
                            $("#fids_queue").append(queue_data);
                           
                        }
                        
                        var current_day = moment().format('dddd'); 
                        var current_date = moment().format('MMM Do, YYYY'); 
                        
                        $("#fids_date").html(current_day + '<br/>' + current_date);
                        
                        var fidsClock = setInterval(function(){fidsTimer()}, 1000);

                        function fidsTimer() {
                            var d = new Date();
                            var t = getCurrentDatetime('clock');
                            
                            $("#fids_time").html(t);
                        }
                        
                    } else {
                        $("#fids").hide();
                        $("#nonrunningtext").show();
                        $("#emergency_stop").val("");
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
    
    if(current == stoptime) {
        $.ajax({
            url: "signage_ajax.php",
            cache: false,
            type: "GET",
            data: "mod=urgencystop&id=" + id,
            success: function(response){
                $("#emergency").hide();
                $("#fids").hide();
                $("#nonrunningtext").show();
                $("#emergency_stop").val("");
				$("#urgency_id").val("");
				
				if(response == "text") { // jika running text
					playlist('default', runningtext_region);
				}
            }
        });
    }
}

function getRegionType(region) {
    var region_type = $("#region"+region+"_type").val();
    
    return region_type;
}

function getMediaPath(region_type) {
    switch(region_type) {
        case "image" : var media_path = 'media/images/signage/'; break;
        case "clip" : var media_path = 'media/clips/signage/'; break;
        case "text" : var media_path = 'media/text/signage/'; break;
        case "rss" : var media_path = 'media/rss/signage/'; break;
    }
    
    return media_path;
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
