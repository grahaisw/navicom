<style>
#fids_region1 {
    width:981px;
    height:780px;
    display:block;
    position:absolute;
    top:0;
    color:#fff;
    /*background-color:red;*/
}
#region2 {
    width:836px;
    height:506px;
    display:block;
    position:absolute;
    top:180px;
    background-color:blue;
}
#fids_region2 {
    width:300px;
    height:440px;
    position:absolute;
    top:0;
    right:0;
    border: 1px solid #fff;
    background-color:#000;
}
#fids_region3 {
    width:300px;
    height:245px;
    position:absolute;
    top:440px;
    right:0;
    color:#fff;
    border: 1px solid #fff;
    background-color:#000;
}
#region4 p {
    padding:0 20px 20px 20px;
    /*width:100%;*/
    font-size:20px;
}   
#region5 {
    width:1280px;
    height:30px;
    padding-top:3px;
    position:absolute;
    bottom:0;
    font-size:22px;
    color:#fff;
    background-color:gray;
}
#emergency {
    width:1280px;
    height:700px;
    display:none;
    top:0;
    position:absolute;
}

</style>
<p id="sql" style="color:#fff"></p>
<div id="fids">
    <div id="fids_region1">
        <div style="width:420px;height:200px;display:inline-block;">
            <img src="media/images/signage/logo_garuda.png" width="100%" height="100%" />
        </div>
        <div align="center" style="width:550px;height:200px;display:inline-block;position:absolute;top:0;padding-top:50px;font-family:Arial;font-size:106px;">
            GA 7211
        </div>
        <div style="width:100%;height:120px;margin-top:10px;font-family:Arial;font-size:96px;">
            Kuala Lumpur
        </div>
        <div style="width:100%;height:120px;margin-top:20px;font-family:Arial;font-size:80px;">
            <div style="float:left;">Gate 10</div>
            <div style="float:right;padding:0 15px;">10:55</div>
        </div>
        <div align="center" style="width:100%;height:120px;margin-top:10px;font-family:Arial;font-size:96px;background-color:red;">
            LAST CALL
        </div>
    </div>
    <div id="fids_region2">
        <table style="color:#fff;width:100%;margin-top:20px;font-family:Arial" cellspacing="0" cellpadding="2" border="0">
        <tr height="80">
            <td align="center" width="10" style="vertical-align:top;font-size:20px;">11:30</td>
            <td align="left" width="100" style="vertical-align:top;font-size:20px;">GA 831 <br/>Kuala Lumpur</td>
            <td align="right" width="20" style="vertical-align:top;font-size:18px;">Boarding</td>
        </tr>
        <tr height="80">
            <td align="center" width="10" style="vertical-align:top;font-size:20px;">11:40</td>
            <td align="left" width="100" style="vertical-align:top;font-size:20px;">GA 720 <br/>Banjarmasin</td>
            <td align="right" width="20" style="vertical-align:top;font-size:18px;">Gate Open</td>
        </tr>
        </table>
    </div>
    <div id="fids_region3">
        
    </div>
</div>
<div id="emergency">
    <input type="hidden" id="emergency_stop" value="" />
    <img src="media/images/signage/emergency.gif" width="100%" height="100%" />
</div>
<div id="region5">
    <input type="hidden" id="region5_content" value="{S_CONTENT_5}" />
    <input type="hidden" id="region5_content_duration" value="{S_DURATION_5}" />
    <input type="hidden" id="region5_schedule" value="" />
    <input type="hidden" id="region5_schedule_stop" value="" />
    <input type="hidden" id="region5_schedule_duration" value="" />
    <input type="hidden" id="region5_counter" value="" />
    <input type="hidden" id="region5_data" value="" />
    <input type="hidden" id="region5_dataCount" value="" />
    <marquee scrollamount="10" loop="" scrolldelay="3"></marquee>
</div>

<script>
/*
Region 1,3,4 => Image
Region 2 => Clip
Region 5 => Running text
*/
var total_region = 5;
var video_region = 2;
var start = 0;
var myVar, myVar1, myVar2, myVar3, myVar4, myVar5;

for(var i=1; i<=total_region; i++) {
    //playlist('default', i);
}

//window.setInterval("checkDefault()", 10000);
//window.setInterval("checkPlaylist()", 15000);
//window.setInterval("stopPlaylist()", 14000);
//window.setInterval("checkEmergency()", 5000);
//window.setInterval("stopEmergency()", 1000);

function playlist(data, region) {  
    if(region == 2) {
        // ambil data
        var videoSource = getContent(data, region);
        
        var i = 0;
        var videoCount = videoSource.length; 
        
        $("#region2_counter").val(i);
        $("#region2_data").val(data);
        $("#region2_videoCount").val(videoCount);
        
        // catat log
        var log = addLog(videoSource[i],data);
        
        // play video
        document.getElementById("myVideo").setAttribute("src",videoSource[i]);     
        // jika video/clip selesai (durasi habis)
        document.getElementById('myVideo').addEventListener('ended',myHandler,false);
        
    } else if(region == 5) {
        // ambil data
        var contentSource = getContent(data, region);
        var dataCount = contentSource.length; 
        
        $("#region"+region+"_counter").val(start);
        $("#region"+region+"_data").val(data);
        $("#region"+region+"_dataCount").val(dataCount);
        
        var text = contentSource.join(" -- ");
        $("#region"+region+" marquee").remove();
        $("#region"+region).append('<marquee scrollamount="10" loop="" scrolldelay="3">'+text+'</marquee>');
        
        // catat log
        for(var i=0; i<dataCount; i++) {
            var log = addLog(contentSource[i],data);
        }
        
    } else {
        // ambil data
        var contentSource = getContent(data, region);
        
        if(data == "default") var duration = $("#region"+region+"_content_duration").val();
        else var duration = $("#region"+region+"_schedule_duration").val();
        
        var imageCount = contentSource.length; 
        
        $("#region"+region+"_counter").val(start);
        $("#region"+region+"_data").val(data);
        $("#region"+region+"_imageCount").val(imageCount);
        
        if(region == 4) {  
            $("#region"+region+" marquee").html(contentSource[start]);
            
        } else {
            $("#region"+region+" img").attr("src", contentSource[start]);
        }
        
        // catat log
        var log = addLog(contentSource[start],data);
        
        if(duration > 0) {  // jika content image adalah playlist, maka jalankan fungsi imageSwap()
            window['myVar'+region] = setInterval("imageSwap("+region+")", duration);
        } 
    }
    
}

function imageSwap(region) {  
    var data = $("#region"+region+"_data").val();
    var duration = $("#region"+region+"_schedule_duration").val();
    var i = $("#region"+region+"_counter").val();
    var imageCount = $("#region"+region+"_imageCount").val();
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

function videoPlay(videoNum) {   
    var data = $("#region2_data").val();
    var videoSource = getContent(data, video_region);
    
    // catat log
    var log = addLog(videoSource[videoNum],'');
    
    document.getElementById("myVideo").setAttribute("src",videoSource[videoNum]);
    //document.getElementById("myVideo").load();
    document.getElementById("myVideo").play();
}

function myHandler() {
    var i = $("#region2_counter").val();
    var videoCount = $("#region2_videoCount").val();
    
    if(i < (videoCount-1)){
        i++;
    }
    else if(i == (videoCount-1)){
        i = 0;
    }
    
    $("#region2_counter").val(i);
    videoPlay(i);
}

function getContent(data, region) {
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
            if(region == 2) {
                contentSource[j]='media/clips/signage/' + content[j];
            } else if(region == 5) {
                contentSource[j]= content[j];
            } else {
                contentSource[j]='media/images/signage/' + content[j];
            }
        }
    } else {
        if(region == 2) {
            contentSource[0]='media/clips/signage/' + con;
        } else if(region == 4 || region == 5) {
            contentSource[0]= con;
        } else {
            contentSource[0]='media/images/signage/' + con;
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
                    
                    var running_content = $("#region"+region+"_content").val();
                    
                    if(default_source != running_content) {
                        $("#region"+region+"_content").val(default_source);
                        $("#region"+region+"_content_duration").val(duration);
                        
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
                    
                    var running_schedule = $("#region"+region+"_schedule").val();
                    var schedule_stop = $("#region"+region+"_schedule_stop").val();
                    
                    if(source != running_schedule) {
                        $("#region"+region+"_schedule").val(source);
                        $("#region"+region+"_schedule_stop").val(end);
                        $("#region"+region+"_schedule_duration").val(duration);
                        
                        playlist(source, region);
                    }
                    
                }
            }
        }
    });
}

function stopPlaylist() {
    var current = getCurrentDatetime('');
    
    for(var i=1; i<=total_region; i++) {
        var schedule_stop = $("#region"+i+"_schedule_stop").val();
        if(schedule_stop != "") {
            if(schedule_stop.indexOf("|") > -1) {
                var stop = schedule_stop.split("|");
                stop = stop[0];
            } else {
                var stop = schedule_stop;
            }
            
            if(current == stop) {    
                if(i == 2) {
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
        data: "mod=emergency",
        success: function(response){   
            var str = response.split(";");
            var flag = str[0];
            var stoptime = str[1];
            
            if(flag == 1) {
                var emergency_stop = $("#emergency_stop").val();
                if(emergency_stop == "") {
                    $("#nonrunningtext").hide();
                    $("#emergency").show();
                    $("#emergency_stop").val(stoptime);
                }
            } else {
                $("#emergency").hide();
                $("#nonrunningtext").show();
                $("#emergency_stop").val("");
            }
        }
    });
}

function stopEmergency() {
    var current = getCurrentDatetime('detail');
    var stoptime = $("#emergency_stop").val();
    
    if(current == stoptime) {
        $.ajax({
            url: "signage_ajax.php",
            cache: false,
            type: "GET",
            data: "mod=emergencystop",
            success: function(response){   
                $("#emergency").hide();
                $("#nonrunningtext").show();
                $("#emergency_stop").val("");
            }
        });
    }
}

function getCurrentDatetime(mod) {
    var dt = new Date();
    
    var y = dt.getFullYear();
    var m = parseInt(dt.getMonth()) + 1;
    var d = dt.getDate();
    var h = dt.getHours();
    var i = dt.getMinutes();
    
    if(m < 10) m = "0" + m;
    if(d < 10) d = "0" + d;
    if(h < 10) h = "0" + h;
    if(i < 10) i = "0" + i;
    
    var current = y + "-" + m + "-" + d + " " + h + ":" + i;
    
    if(mod == 'detail') {
        var s = dt.getSeconds();
        if(s < 10) s = "0" + s;
        current = current + ":" + s;
    }
    
    return current;
}
</script>
