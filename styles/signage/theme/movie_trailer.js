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
    currentPlayingChannelIndex: null
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

/* Channel List Initial creation */
mediaPlayer.prototype.initCreate = function () {
    media.channelObjlen = (media._object.channelListLength > 7) ? 7 : media._object.channelListLength;
    var _div = "";
    for (var i = 0; i < media.channelObjlen; i++) {
        if (i == 0) {
            _div += "<div id='divChannelListItem_" + i + "' cItem='" + i + "' onmouseover='media.JS_MouseOverFunction(this," + i + ")' class='channelFocus spanChannlItem divChannelItems' ><img src='" + channelListArray[i][4] + "' ></div>";
        } else {
            _div += "<div id='divChannelListItem_" + i + "' cItem='" + i + "' onmouseover='media.JS_MouseOverFunction(this," + i + ")' class='spanChannlItem divChannelItems' ><img src='" + channelListArray[i][4] + "' ></div>";
        };
    };
    $(media.channelListObj).html(_div);
    for (var i = 0; i < media.channelObjlen; i++) {
        media.channelListObject[i] = $("#divChannelListItem_" + i);
    };
};

/* Channel List Up Key Handler */
mediaPlayer.prototype.Fn_Up_KeyDownHandler = function () {
    media.navigationChange = false;
    if (media.controlIndex > 0) {
        media._object.Fn_ChannelList_Focus();
        media._object.FN_Control_NonFocus();
    } else {
        media.channelIndex = (media.channelIndex == 0) ? media._object.channelListLength - 1 : media.channelIndex - 1;
        var inc = media.channelIndex - (media.channelIndex % 7);
        if (media.focusIndex == 0) {
            media._object.Fn_ChannelListDataBind(inc);
        };
        media._object.Fn_Focus_NonFocus();
        $(media.ChannelCount).html((media.channelIndex + 1) + "/" + media._object.channelListLength);
        var top = media.channelIndex * media._object.scrolltop;
        top += "px";
        $("#DV_Scrollshaft").css("top", top);
		$("#chIndex").val(media.channelIndex);
    };
    if (channelListArray[media.channelIndex][3] == 0) {
        media._loadEvents = true;
    } else {
        media._loadEvents = false;
    };
};


/* Channel List Down Key Handler */
mediaPlayer.prototype.Fn_Down_KeyDownHandler = function (handler) {
    media.navigationChange = false;
    if (media.controlIndex > 0) {
        media._object.Fn_ChannelList_Focus();
        media._object.FN_Control_NonFocus();
    } else {
        media.channelIndex = (media.channelIndex == media._object.channelListLength - 1) ? 0 : media.channelIndex + 1;
        media._object.Fn_Focus_NonFocus();
        if (media.focusIndex == 0 && handler != "mouse") {
            media._object.Fn_ChannelListDataBind(media.channelIndex);
        };
        $(media.ChannelCount).html((media.channelIndex + 1) + "/" + media._object.channelListLength);
        var top = media.channelIndex * media._object.scrolltop;
        top += "px";
        $("#DV_Scrollshaft").css("top", top);
		$("#chIndex").val(media.channelIndex);
    }
    if (channelListArray[media.channelIndex][3] == 0) {
        media._loadEvents = true;
    } else {
        media._loadEvents = false;
    };
};

/* Channel List Left Key Handler */
mediaPlayer.prototype.Fn_Left_KeyDownHandler = function () {
    media.navigationChange = true;
    if (media.controlIndex == 0) {
        media._object.Fn_ChannelList_NonFocus();
        media.controlIndex = media.videoControlLen + 1;
    };
    if (media.controlIndex == 1) {
        media._object.Fn_Up_KeyDownHandler();
    };
    if (media.controlIndex > 1) {
        media._object.FN_Control_Left_Focus_NonFocus();
    };
};

/* Channel List Right Key Handler */
mediaPlayer.prototype.Fn_Right_KeyDownHandler = function () {
    media.navigationChange = true;
    if (media.controlIndex == 0) {
        media._object.Fn_ChannelList_NonFocus();
        media.controlIndex = 0;
    };
    if (media.controlIndex < media.videoControlLen) {
        media._object.FN_Control_Right_Focus_NonFocus();
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
mediaPlayer.prototype.FN_Control_NonFocus = function () {
    $(media.videoControl).children(":eq(" + (media.controlIndex - 1) + ")").css("background-position", "top");
    media.controlIndex = 0;
};

/* Channel List Data Bind function */
mediaPlayer.prototype.Fn_ChannelListDataBind = function (val) {
    for (var i = 0; i < media.channelObjlen; i++) {
        if (channelListArray[i + val] != undefined) {
            $(media.channelListObject[i]).attr("cItem", (i + val)).html("<img src='" + channelListArray[i + val][4] + "' >");
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

/* HTML5 Video Load SRC and trigger for Event Raising  function */
mediaPlayer.prototype.Fn_PlayLoadSRC = function (sucess) {
    try {
        media._object.playSRC = media.channelIndex;
        media.video.src = channelListArray[media.channelIndex][1];
        media.errorMsg = false;
        media.video.load();
        media.Fn_ClearTimerDisplay();
        $("#divCurrentChannelName,#divCurrentChannelNameFullScreen").html(media.Fn_ValidateChannel(channelListArray[media.channelIndex], true));
	//$("#divPoster").html(channelListArray[media.channelIndex][2]);
	$("#divPoster").html("<img src='" + channelListArray[media.channelIndex][5] + "'>");
	
	$("#divDirector").html(channelListArray[media.channelIndex][7] + ": <br/>" + channelListArray[media.channelIndex][8]);
	$("#divCast").html(channelListArray[media.channelIndex][9] + ": <br/>" + channelListArray[media.channelIndex][10]);
	$("#divMoviePrice").html(channelListArray[media.channelIndex][13] + ": " + channelListArray[media.channelIndex][14] + " " + channelListArray[media.channelIndex][18]);
	$("#divSynopsis").html(channelListArray[media.channelIndex][15] + ": " + channelListArray[media.channelIndex][2]);
	$("#divGenre").html(channelListArray[media.channelIndex][11] + ": " + channelListArray[media.channelIndex][12]);
	
        //$("#divCurrentChannelDescFullScreen").html(channelListArray[media.channelIndex][2]);
	//$("#divCurrentChannelDesc").html(channelListArray[media.channelIndex][2]);
        $(media.mediaPlayIcon).addClass("displayNone");
        $("#divErrorMsg").hide();
        $("#divLoading").removeClass("displayNone");
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
