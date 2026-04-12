var doc = document, win = window;

/*Debug Print*/
var debugPrint = {
    console: function (msg, type) {
        if (type == 'e') {
            if (media.exceptionPrintStatus) {
                console.log("Exception Print =====>[" + msg + "]<=====");
            };
        } else {
            if (media.debugPrintStatus) {
                console.log("Console Print =====>[" + msg + "]<=====");
            };
        };
    }
};

var media = {
    channelListObject: [],
    channelIndex: 0,
    focusIndex: 0,
    controlIndex: 0,
    fullScreen: false,
    navigationChange: false,
    sliderTimer: null,
    slide: false,
    errorMsg: false,
    _loadEvents: false,
    seekbarknobmaxpos: 97,
    currentVideoPlay: false,
    currentPlayingChannelIndex: null,
	commitTimer:2000,
	maxentrydigit:4,
	ishttpplaying: 0,
	gantiTimer: 0,
	interval1: 0,
	interval2: 0,
	videopreviousTime: 0,
	autoreplay: 1,
	udpretryTimer: 0,
    lastchannelplayed: 0,
	playafterpressed: 0,
    current_package_id:0, //Add by DR
	timeout1: 0
};


var mediaPlayer = function () { };

/* Channel List Array length  */
mediaPlayer.prototype.playSRC = null;
mediaPlayer.prototype.mediaSkipped = 20;
mediaPlayer.prototype.channelListLength = channelListArray.length;
mediaPlayer.prototype.curdurTimer = null;
mediaPlayer.prototype.mediaplaybackRate = .200;
mediaPlayer.prototype.mediaplaybackRateDisplay = 0;
mediaPlayer.prototype.scrolltop = parseFloat(456 / (channelListArray.length - 1));

/* Channel List Initial creation
mediaPlayer.prototype.initCreate = function () {
    media.channelObjlen = (media._object.channelListLength > 8) ? 8 : media._object.channelListLength;
    var _div = "";
    for (var i = 0; i < media.channelObjlen; i++) {
        if (i == 0) {
            _div += "<div id='divChannelListItem_" + i + "' cItem='" + i + "' onmouseover='media.JS_MouseOverFunction(this," + i + ")' class='channelFocus spanChannlItem divChannelItems' >" + channelListArray[i][0] + "</div>";
        } else {
            _div += "<div id='divChannelListItem_" + i + "' cItem='" + i + "' onmouseover='media.JS_MouseOverFunction(this," + i + ")' class='spanChannlItem divChannelItems' >" + channelListArray[i][0] + "</div>";
        };
    };
    $(media.channelListObj).html(_div);
    for (var i = 0; i < media.channelObjlen; i++) {
        media.channelListObject[i] = $("#divChannelListItem_" + i);
    };
};
*/
/* Channel List Initial creation */
mediaPlayer.prototype.initCreate = function () {
    media.channelObjlen = (media._object.channelListLength > 8) ? 8 : media._object.channelListLength;
    var _div = "";
    for (var i = 0; i < media.channelObjlen; i++) {
        if (i == 0) {
            _div += "<div id='divChannelListItem_" + i + "' cItem='" + i + "' onmouseover='media.JS_MouseOverFunction(this," + i + ")' class='divChannelItems channelFocus' ><span class='spanChannlItem'>" + channelListArray[i][4] + '  ' + channelListArray[i][0] + "</span></div>";
        } else {
            _div += "<div id='divChannelListItem_" + i + "' cItem='" + i + "' onmouseover='media.JS_MouseOverFunction(this," + i + ")' class='divChannelItems' ><span class='spanChannlItem'>" + channelListArray[i][4] + '  ' + channelListArray[i][0] + "</span></div>";
        };
    };
    $(media.channelListObj).html(_div);
    for (var i = 0; i < media.channelObjlen; i++) {
        media.channelListObject[i] = $("#divChannelListItem_" + i);
    };
};

/* Channel List Up Key Handler */
mediaPlayer.prototype.Fn_Left_KeyDownHandler = function () {
    media.navigationChange = false;
    if (media.controlIndex > 0) {
        media._object.Fn_ChannelList_Focus();
        media._object.FN_Control_NonFocus();
    } else {
	//$("#divChannelLayer").addClass("displayNone");
        media.channelIndex = (media.channelIndex == 0) ? media._object.channelListLength - 1 : media.channelIndex - 1;
        var inc = media.channelIndex - (media.channelIndex % 8);
        if (media.focusIndex == 0) {
            media._object.Fn_ChannelListDataBind(inc);
        };
        media._object.Fn_Focus_NonFocus();
        $(media.ChannelCount).html((media.channelIndex + 1) + "/" + media._object.channelListLength);
        var top = media.channelIndex * media._object.scrolltop;
        top += "px";
        $("#DV_Scrollshaft").css("top", top);
		$("#ch_index").val(media.channelIndex % 10);
    };
    /*if (channelListArray[media.channelIndex][3] == 0) {
        media._loadEvents = true;
    } else {
        media._loadEvents = false;
    };*/
};


/* Channel List Down Key Handler */
mediaPlayer.prototype.Fn_Right_KeyDownHandler = function (handler) {
    media.navigationChange = false;
    if (media.controlIndex > 0) {
        media._object.Fn_ChannelList_Focus();
        media._object.FN_Control_NonFocus();
    } else {
	//$("#divChannelLayer").addClass("displayNone");
        media.channelIndex = (media.channelIndex == media._object.channelListLength - 1) ? 0 : media.channelIndex + 1;
        media._object.Fn_Focus_NonFocus();
        if (media.focusIndex == 0 && handler != "mouse") {
            media._object.Fn_ChannelListDataBind(media.channelIndex);
        };
        $(media.ChannelCount).html((media.channelIndex + 1) + "/" + media._object.channelListLength);
        var top = media.channelIndex * media._object.scrolltop;
        top += "px";
        $("#DV_Scrollshaft").css("top", top);
		$("#ch_index").val(media.channelIndex % 10);
    }
    /*if (channelListArray[media.channelIndex][3] == 0) {
        media._loadEvents = true;
    } else {
        media._loadEvents = false;
    };*/
};

/* Channel List Left Key Handler */
mediaPlayer.prototype.Fn_Up_KeyDownHandler = function () {
    media.navigationChange = true;
    if (media.controlIndex == 0) {
        media._object.Fn_ChannelList_NonFocus();
        media.controlIndex = media.videoControlLen + 1;
    };
    if (media.controlIndex == 1) {
        media._object.Fn_Left_KeyDownHandler();
    };
    if (media.controlIndex > 1) {
        media._object.FN_Control_Up_Focus_NonFocus();
    };
};

/* Channel List Right Key Handler */
mediaPlayer.prototype.Fn_Down_KeyDownHandler = function () {
    media.navigationChange = true;
    if (media.controlIndex == 0) {
        media._object.Fn_ChannelList_NonFocus();
        media.controlIndex = 0;
    };
    if (media.controlIndex < media.videoControlLen) {
        media._object.FN_Control_Down_Focus_NonFocus();
    };
};

/* Channel List Left Focus Handler function */
mediaPlayer.prototype.FN_Control_Left_Focus_NonFocus = function () {
    $(media.videoControl).children(":eq(" + (media.controlIndex - 1) + ")").css("background-position", "top");
    media.controlIndex--;
    $(media.videoControl).children(":eq(" + (media.controlIndex - 1) + ")").css("background-position", "bottom");
};

/* Channel List Right Focus Handler function */
mediaPlayer.prototype.FN_Control_Right_Focus_NonFocus = function () {
    $(media.videoControl).children(":eq(" + (media.controlIndex - 1) + ")").css("background-position", "top");
    media.controlIndex++;
    $(media.videoControl).children(":eq(" + (media.controlIndex - 1) + ")").css("background-position", "bottom");
};

/* Channel List Control Non Focus Handler function */
mediaPlayer.prototype.FN_Control_NonFocus = function () { console.log('hmmmmmmmmmmm');
    $(media.videoControl).children(":eq(" + (media.controlIndex - 1) + ")").css("background-position", "top");
    media.controlIndex = 0;
};

/* Channel List Data Bind function 
mediaPlayer.prototype.Fn_ChannelListDataBind = function (val) {
    for (var i = 0; i < media.channelObjlen; i++) {
        if (channelListArray[i + val] != undefined) {
            $(media.channelListObject[i]).attr("cItem", (i + val)).html("" + channelListArray[i + val][0] + "");
        } else {
            $(media.channelListObject[i]).attr("cItem", "").html("");
        };
    };
};
*/
/* Channel List Data Bind function */
mediaPlayer.prototype.Fn_ChannelListDataBind = function (val) {
    for (var i = 0; i < media.channelObjlen; i++) {
        if (channelListArray[i + val] != undefined) {
            $(media.channelListObject[i]).attr("cItem", (i + val)).html("<span class='spanChannlItem'>" + channelListArray[i + val][4] + '  ' + channelListArray[i + val][0] + "</span>");
        } else {
            $(media.channelListObject[i]).attr("cItem", "").html("");
        };
    };
};

/* Channel List Focus and non Focus toggle function */
mediaPlayer.prototype.Fn_Focus_NonFocus = function () {
    $(media.channelListObj).children(":eq(" + media.focusIndex + ")").removeClass("channelFocus");
    media.focusIndex = media.channelIndex % media.channelObjlen;
    $(media.channelListObj).children(":eq(" + media.focusIndex + ")").addClass("channelFocus");
};

/* Channel List Focus  function */
mediaPlayer.prototype.Fn_ChannelList_NonFocus = function () {
    $(media.channelListObj).children(":eq(" + media.focusIndex + ")").css("background-position", "top");
};

/* Channel List Non Focus  function */
mediaPlayer.prototype.Fn_ChannelList_Focus = function () {
    $(media.channelListObj).children(":eq(" + media.focusIndex + ")").css("background-position", "bottom");
};

/* Channel List Video Progress Track Update function */
mediaPlayer.prototype.Fn_VideoProgressTrack = function (val, obj) {
    if (isNaN(val)) {
        var duration = "--:--:--";
    } else if (val == Infinity) {
        var duration = "--:--:--";
    } else {
        var sec = parseInt(val % 60);
        val /= 60;
        var mins = parseInt(val % 60);
        val /= 60;
        var hrs = parseInt(val % 24);

        sec = (isNaN(sec)) ? 0 : sec;
        mins = (isNaN(mins)) ? 0 : mins;
        hrs = (isNaN(hrs)) ? 0 : hrs;

        sec = (sec > 9) ? sec : "0" + sec;
        mins = (mins > 9) ? mins : "0" + mins;
        hrs = (hrs > 9) ? hrs : "0" + hrs;

        var duration = hrs + ":" + mins + ":" + sec;
    };
    if (obj == 0) {
        $("#divProgressDuration,#divProgressDurationFullScreen").html(duration);
    } else {
        $("#divProgressTime,#divProgressTimeFullScreen").html(duration);
        var videoLoadingPercent = (media.Fn_ValidateNaN(media.video.currentTime) / media.Fn_ValidateNaN(media.video.duration)) * 100;
        if (videoLoadingPercent == Infinity) {
            videoLoadingPercent = 0;
        };
        (videoLoadingPercent >= 100) ? 100 : videoLoadingPercent;
        $("#divProgressBarTrack,#divProgressBarTrackFullScreen").css("width", Math.floor(videoLoadingPercent) + "%");
        if (Math.floor(videoLoadingPercent) <= 100) {
            var seekBarKnobMaxPosCalc = parseFloat((Math.floor(videoLoadingPercent) / 100) * media.seekbarknobmaxpos);
            $("#divProgressBarTrack,#divProgressBarTrackFullScreen").css("width", Math.floor(videoLoadingPercent) + "%");
            if (seekBarKnobMaxPosCalc > (media.seekbarknobmaxpos - 1)) {
                seekBarKnobMaxPosCalc = media.seekbarknobmaxpos;
            };
            $("#divTrackShaft,#divTrackShaftFullScreen").css("left", seekBarKnobMaxPosCalc + "%");
        };

        clearTimeout(media._object.curdurTimer);
        media._object.curdurTimer = setTimeout(function () {
            media._object.Fn_VideoProgressTrack(media.video.currentTime, 1);
        }, 1000);
    };
};

/* HTML5 Video Seeking  function */
mediaPlayer.prototype.Fn_Media_seeking = function (val) {
    media.video.playbackRate += val;
};

/* HTML5 Video skip  function */
mediaPlayer.prototype.Fn_Media_skip = function (val) {
    if (val == 0) {
        media.video.currentTime = val;
    }
    else {
        media.video.currentTime += val;
    };
    var videoLoadingPercent = (media.Fn_ValidateNaN(media.video.currentTime) / media.Fn_ValidateNaN(media.video.duration)) * 100;
    if (videoLoadingPercent == Infinity) {
        videoLoadingPercent = 0;
    };
    var seekBarKnobMaxPosCalc = parseFloat((Math.floor(videoLoadingPercent) / 100) * media.seekbarknobmaxpos);
    $("#divProgressBarTrack,#divProgressBarTrackFullScreen").css("width", Math.floor(videoLoadingPercent) + "%");
    if (seekBarKnobMaxPosCalc > (media.seekbarknobmaxpos - 1)) {
        seekBarKnobMaxPosCalc = media.seekbarknobmaxpos;
    };
    $("#divTrackShaft,#divTrackShaftFullScreen").css("left", seekBarKnobMaxPosCalc + "%");
};

mediaPlayer.prototype.autoplayVideo = function (idvideo, channeludp, channelhttp) {
	var video = document.getElementById(idvideo);
	
	video.src = channeludp;
	if (media.ishttpplaying) {
		video.src = channelhttp;
	}
	//video.load();
	//video.play(); 
	media.videopreviousTime = video.currentTime;
}

mediaPlayer.prototype.isVideoPlaying = function () {
    //var video = document.getElementById("media");
    var last_ch_url = $("#last_ch_url").val();
    var source = $("#source").val();
    var str1 = "udp:/";
        
    //document.getElementById("demo").innerHTML = "<span style='color: white; font-size: 50pt'>" + media._object.displayTime() + " - " + media.gantiTimer + " - " + media.ishttpplaying + " - " + media.videopreviousTime + " - " + video.currentTime + "</span>";
        
    if ((media.autoreplay % 30) == 0) {
        if (media.videopreviousTime < media.video.currentTime) { //alert(media.videopreviousTime +" - "+ video.currentTime);
            media.videopreviousTime = media.video.currentTime;
        } else { 
            media.video.src= channelListArray[media.channelIndex][1];
			media.video.play();
			media.videopreviousTime = 0;
            /*video.src = channelListArray[media.channelIndex][14];
            if(source != 'channel') {*/
            /*media._object.sleep(10000);*/
                /*media.videopreviousTime = 0;*/
        }
        //media.autoreplay = 0;
    } 
    
//  if(media.autoreplay >= 21601) {
        if(media.autoreplay >= 900) {
			//document.write('<font color="orange">cek paket</font>');
			//media.video.src= str1.concat("/225.1.2.2:49410");
			media.autoreplay = 1;
			//media.video.play();   
    } else {
        media.autoreplay += 1;
    }
    
}

mediaPlayer.prototype.jeda = function (miliseken) {
	var texts = "";
	for (var i = 0; i < miliseken; i++) {
		texts += i + " ";
	}
}

mediaPlayer.prototype.sleep = function (milliseconds) {
	var start = new Date().getTime();
	for (var i = 0; i < 1e7; i++) {
		if ((new Date().getTime() - start) > milliseconds){
		break;
		}
	}
}

mediaPlayer.prototype.displayTime = function () {
	var str = "";

	var currentTime = new Date()
	var hours = currentTime.getHours()
	var minutes = currentTime.getMinutes()
	var seconds = currentTime.getSeconds()

	if (minutes < 10) {
		minutes = "0" + minutes
	}
	if (seconds < 10) {
		seconds = "0" + seconds
	}
	str += hours + ":" + minutes + ":" + seconds + " ";
	if(hours > 11){
		str += "PM"
	} else {
		str += "AM"
	}
	return str;
}

/* HTML5 Video Load SRC and trigger for Event Raising  function */
mediaPlayer.prototype.Fn_PlayLoadSRC = function (sucess) {
    try {
		clearInterval(media.interval1);

        media.videopreviousTime = 0;
        media.autoreplay = 1;
        media.video.src = channelListArray[media.channelIndex][1];
        media.video.play();

        media.interval1 = setInterval(media._object.isVideoPlaying, 1000);
		
		/*
        media._object.playSRC = media.channelIndex;
        media.video.src = channelListArray[media.channelIndex][1];
		$("#videoSRC").val(channelListArray[media.channelIndex][1]);
		*/
        media.errorMsg = false;
        //media.video.load();
		media.Fn_ClearTimerDisplay();
        $("#divCurrentChannelName,#divCurrentChannelNameFullScreen").html(media.Fn_ValidateChannel(channelListArray[media.channelIndex], true));
        $("#divCurrentChannelDescFullScreen").html(channelListArray[media.channelIndex][2]);
		$("#divCurrentChannelNoFullScreen").html(channelListArray[media.channelIndex][4]);
        $(media.mediaPlayIcon).addClass("displayNone");
        $("#divErrorMsg").hide();
        $("#divLoading").removeClass("displayNone");
		
		
		setTimeout(function () {
			$("#mode").val('fullscreen'); 
			media.JS_FullScreen_Function();
			//media.video.src = channelListArray[media.channelIndex][1];

		}, media.channelListTimeoutValue);
		
		
		$.ajax({
            url: "ajax.php",
            cache: false,
            type: "GET",
            data: "mod=last_url&tv_channel_id=" + channelListArray[media.channelIndex][6],
            success: function(response){
                    //console.log(response);
                }
        }); 
		
        if (channelListArray[media.channelIndex][3] == 0) {
            media._loadEvents = true;
        } else {
            media._loadEvents = false;
        };
		
        sucess;
    } catch (e) {
        debugPrint.console("Exception From Fn_PlayLoadSRC  =====> [" + e + "]<=====");
    };
};

/* HTML5 Video Play  function */
mediaPlayer.prototype.Fn_MediaPlayEvents = function () {
    media.video.play();
    $("#divFullTrickValue").hide();
    $(media.mediaPlayIcon).addClass("displayNone");
    $("#divVideoFullScreenIcons").attr("class", "divVideoFullScreenIconsPlay");
    $("#divPlaying").addClass("pauseIcon").removeClass("playIcon");
    media._object.Fn_VideoProgressTrack(media.video.currentTime, 1);
    $("#divSeekBackDisplay,#divSeekForwardDisplay").hide();
    media.currentVideoPlay = true;
    media.currentPlayingChannelIndex = media.channelIndex;
};

/* HTML5 Video Pause  function */
mediaPlayer.prototype.Fn_MediaPauseEvents = function () {
    media.video.pause();
    clearTimeout(media.sliderTimer);
    $("#divFullTrickValue").hide();
    $(media.mediaPlayIcon).removeClass("displayNone");
    $("#divVideoFullScreenIcons").attr("class", "divVideoFullScreenIconspause");
    $("#divPlaying").addClass("playIcon").removeClass("pauseIcon");
};

/* Clear Media Trickmode Function */
mediaPlayer.prototype.Fn_MediaClearTrickmode = function () {
	media.video.playbackRate = 1;
    media._object.mediaplaybackRateDisplay = 0;
    $("#divFullTrickValue").hide();
    $("#divVideoFullScreenIcons").attr("class", "divVideoFullScreenIconsPlay");
    $("#divSeekBackDisplay,#divSeekForwardDisplay").hide();
    media._object.mediaplaybackRateDisplay = 0;
};


/* HTML5 Video play and pause toggle Function */
mediaPlayer.prototype.Fn_Play_Pause = function () {
    clearTimeout(media._object.curdurTimer); 
    if (media.video.playbackRate == 1) {
        if (media._object.playSRC != media.channelIndex) {
            media._object.Fn_PlayLoadSRC();
        } else {
            if (!media.errorMsg) {
                if (media.video.paused) {
                    media._object.Fn_MediaPlayEvents();
                } else {
                    media._object.Fn_MediaPauseEvents();
                };
            };
        };
    } else {
        if (media._object.playSRC != media.channelIndex) {
            media._object.Fn_PlayLoadSRC(function () {
                media._object.Fn_MediaPlayEvents();
            });
        } else {
            media._object.Fn_MediaClearTrickmode();
        };
    };
};

/* Scroll bar Click Function */
mediaPlayer.prototype.Fn_Click_ScrollBar = function () {
    var y_position = event.layerY;
    y_position -= 44;
    var index = Math.round(y_position / media._object.scrolltop);
    if (Math.floor(media.channelIndex / media.channelObjlen) != Math.floor(index / media.channelObjlen)) {
        var inc = index - (index % media.channelObjlen);
        media._object.Fn_ChannelListDataBind(inc);
    };
    media.channelIndex = (index == -1) ? index : index - 1;
    media._object.Fn_Down_KeyDownHandler("mouse");
};


media._ErrorHandling = function (val) {
    switch (val) {
        case 1:
            return "Video loading aborted";
            break;
        case 2:
            return "Network error";
            break;
        case 3:
            return "Video not properly encoded";
            break;
        case 4:
            return "Video file not found";
            break;
        case 5:
            return "Unsupported video";
            break;
        case 6:
            return "Skin not found";
            break;
        case 7:
            return "SWF file not found";
            break;
        case 8:
            return "Subtitles not found";
            break;
        case 9:
            return "Invalid RTMP URL";
            break;
        case 10:
            return "Unsupported video format";
            break;
        default:
            return "Video not loaded.Try again";
            break;
    };
};

media.Fn_DebugHandling = function (e) {
    debugPrint.console("Event Raised =====> [" + e.type + "]<=====");
};
