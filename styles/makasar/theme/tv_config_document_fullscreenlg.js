/* HTML 5 Video Configuration File */

/* video skip divide value */
media.mediaSkipDivide = 10;

/*  video banner timeout value  */
media.bannerTimeoutValue = 5000;

/*  Enable / Disable Print Variables  */
media.exceptionPrintStatus = false;
media.debugPrintStatus = false;
media.enableVideoListener = false;

/* document.js */

$(doc).ready(function () {
    media._object = new mediaPlayer();
    init();

    /*  HTML 5 Video Event Handlers 
    Name        : "loadedmetadata"
    Description : Loaded Meta data about the current source binded video file
    Function    : Hide the loading and error message icon and Calculate mediaSkipped Calculation And video file duration formation And trigger video duration Update timer
    Ready API   : duration,currentTime */
    media.video.addEventListener("loadedmetadata", function (e) {
        media.Fn_DebugHandling(e);
        $("#divErrorMsg").hide();
        media.errorMsg = false;
        media._object.Fn_VideoProgressTrack(media.video.duration, 0);
        media._object.mediaSkipped = Math.floor(media.Fn_ValidateNaN(media.video.duration) / media.mediaSkipDivide);
        $("#divLoading").addClass("displayNone");
    }, false);

    /*  HTML 5 Video Event Handlers 
    Name        : "loadeddata"
    Description : Loaded video data file 
    Function    : Hide the loading and error message icon */
    media.video.addEventListener("loadeddata", function (e) {
        media.Fn_DebugHandling(e);
        media.errorMsg = false;
        $("#divErrorMsg").hide();
        $("#divLoading").addClass("displayNone");
    }, false);

    /*  HTML 5 Video Event Handlers 
    Name        : "canplay"
    Description : This video eligible to play  
    Function    : play the current Source binded Video file */
    media.video.addEventListener("canplay", function (e) {
        media.Fn_DebugHandling(e);
        media._object.Fn_MediaPlayEvents();
    }, false);

    /*  HTML 5 Video Event Handlers 
    Name        : "ended"
    Description : Current video ended successfully   
    Function    : Reset User Interface Current time and Total duration display */
    media.video.addEventListener("ended", function (e) {
        media.Fn_DebugHandling(e);
        Js_Fn_Ended();
        media.video.currentTime = 0;
        if (media.fullScreen) { media.JS_FullScreen_Function(); };
    }, false);

    /*  HTML 5 Video Event Handlers 
    Name        : "ended"
    Description : This Event throws error multiple error types       
    1.   "Video loading aborted" 
    2.   "Network error"
    3.   "Video not properly encoded"
    4.   "Video file not found"
    5.   "Unsupported video"
    6.  "Skin not found"
    7.  "SWF file not found"
    8.   "Subtitles not found"
    9.   "Invalid RTMP URL"
    10.   "Unsupported video format" 
    Function    : Display the error Message to user  */
    media.video.addEventListener("error", function (e) {
        media.Fn_DebugHandling(e);
        media.errorMsg = true;
        $("#divLoading").addClass("displayNone");
        media._object.Fn_VideoProgressTrack(media.video.duration, 0);
        $("#divErrorMsg").show().html(media._ErrorHandling(e.target.error.code));
        Js_Fn_Ended();
    }, true);

    doc.addEventListener("keydown", media.handler, false);

    /*  HTML 5 Video Event Handlers */
    if (media.enableVideoListener) {
        media.video.addEventListener("waiting", function (e) { media.Fn_DebugHandling(e); }, false);
        media.video.addEventListener("seeking", function (e) { media.Fn_DebugHandling(e); }, false);
        media.video.addEventListener("seeked", function (e) { media.Fn_DebugHandling(e); }, false);
        media.video.addEventListener("loadstart", function (e) { media.Fn_DebugHandling(e); });
        media.video.addEventListener("progress", function (e) { media.Fn_DebugHandling(e); });
        media.video.addEventListener("suspend", function (e) { media.Fn_DebugHandling(e); });
        media.video.addEventListener("abort", function (e) { media.Fn_DebugHandling(e); });
        media.video.addEventListener("emptied", function (e) { media.Fn_DebugHandling(e); });
        media.video.addEventListener("stalled", function (e) { media.Fn_DebugHandling(e); });
        media.video.addEventListener("canplaythrough", function (e) { media.Fn_DebugHandling(e); });
        media.video.addEventListener("playing", function (e) { media.Fn_DebugHandling(e); });
        media.video.addEventListener("durationchange", function (e) { media.Fn_DebugHandling(e); });
        media.video.addEventListener("timeupdate", function (e) { media.Fn_DebugHandling(e); });
        media.video.addEventListener("play", function (e) { media.Fn_DebugHandling(e); });
        media.video.addEventListener("pause", function (e) { media.Fn_DebugHandling(e); });
        media.video.addEventListener("ratechange", function (e) { media.Fn_DebugHandling(e); });
        media.video.addEventListener("volumechange", function (e) { media.Fn_DebugHandling(e); });
    };
});

var init = function () {
    media.channelListObj = $("#divChannelListItems");
    media.divVideoContainer = $("#divVideoContainer");
    media.video = doc.getElementById("media");
    media.videoControl = $("#divControlContainer");
    media.ChannelCount = $("#divChannelCount");
    media.mediaPlayIcon = $("#mediaPlayIcon");
    media.videoControlLen = $(media.videoControl).children().length;
    media.controlLength = media.videoControl.children().length;
    $(media.ChannelCount).html((media.channelIndex + 1) + "/" + media._object.channelListLength);
	media.channelIndex = $("#divCurrentChannelOrder").val();
    $("#divCurrentChannelName,#divCurrentChannelNameFullScreen").html(media.Fn_ValidateChannel(channelListArray[media.channelIndex], true));
    $("#divCurrentChannelDescFullScreen").html(channelListArray[media.channelIndex][2]);
    media._object.initCreate();
};

/* NaN (Not a Number) Validation Function  */
media.Fn_ValidateNaN = function (org) {
    if (!isNaN(org)) {
        return org;
    } else {
        return 0;
    };
};

/* Channel Name Validation function */
media.Fn_ValidateChannel = function (name, back) {
    if (back) {
        if (name[3] == 0) {
            return name[0];
        } else {
            return name[0];
        };
    } else {
        if (name[3] == 0) {
            return "(Media File) " + name[0];
        } else {
            return "(Streaming File) " + name[0];
        };
    };
};

/* This Function Clear Timer Display in User Interface  */
media.Fn_ClearTimerDisplay = function () {
    $("#divProgressDuration,#divProgressDurationFullScreen").html("00:00:00");
    $("#divProgressTime,#divProgressTimeFullScreen").html("00:00:00");
    $("#divProgressBarTrack,#divProgressBarTrackFullScreen").css("width", "0%");
    $("#divSeekBackDisplay,#divSeekForwardDisplay").hide();
    $("#divTrackShaft,#divTrackShaftFullScreen").css("left", "0%");
};

/* This Function Clear Timers After Raised "ended" Event   */
var Js_Fn_Ended = function () {
    media.Fn_ClearTimerDisplay();
    $("#divPlaying").addClass("playIcon").removeClass("pauseIcon");
    if (!media.errorMsg) { $(media.mediaPlayIcon).removeClass("displayNone"); };
    clearTimeout(media._object.curdurTimer);
    media.currentVideoPlay = false;
};

/* "keydown" Event Handler   */
media.handler = function (e) {
    var key = e.keyCode;
    debugPrint.console("**************media.handler*****************[" + key + "]***********************************");
    e.preventDefault(); e.stopPropagation();
    switch (key) {
        case keyCodes.KEY_up:
            media._object.Fn_Up_KeyDownHandler();
            //media._object.Fn_Play_Pause();
            if (media.fullScreen) {
                media._object.Fn_Right_KeyDownHandler();
                media._object.Fn_Play_Pause();
            };
            break;
        case keyCodes.KEY_down:
            media._object.Fn_Down_KeyDownHandler();
            //media._object.Fn_Play_Pause();
            if (media.fullScreen) {
                media._object.Fn_Left_KeyDownHandler();
                media._object.Fn_Play_Pause();
            };
            break;
        case keyCodes.KEY_left:
            if (!media.fullScreen) {
                media._object.Fn_Left_KeyDownHandler();
                media._object.Fn_Play_Pause();
            } else {
                var ch = $("#divCurrentChannelOrder").val();
				var gid = $("#gid").val();
				if(ch == 0) {
					ch = media._object.channelListLength - 1;
				} else {
					ch--;
				}
				location.href= 'tv_channel_fullscreenlg.php?ch=' + ch + '&gid=' + gid;
				//media.JS_SliderFunction(); 
				media._object.Fn_Left_KeyDownHandler();
				media._object.Fn_Play_Pause();
			};
            break;
        case keyCodes.KEY_right:
            if (!media.fullScreen) {
                media._object.Fn_Right_KeyDownHandler();
                media._object.Fn_Play_Pause();
            } else {
                var ch = $("#divCurrentChannelOrder").val();
				var gid = $("#gid").val();
				if(ch == (media._object.channelListLength - 1)) {
					ch = 0;
				} else {
					ch++;
				}
				location.href= 'tv_channel_fullscreenlg.php?ch=' + ch + '&gid=' + gid;
				//media.JS_SliderFunction(); 
				media._object.Fn_Right_KeyDownHandler();
				media._object.Fn_Play_Pause();
            };
            break;
        case keyCodes.KEY_enter:
			location.href='tv_channel.php';	
			//media.JS_FullScreen_Function();
			break;
        case keyCodes.KEY_play:
            if (media.fullScreen) { media.JS_SliderFunction(); };
            //media.JS_PlayPause_Function();
            break;
	 case keyCodes.KEY_CHup:
            var ch = $("#divCurrentChannelOrder").val();
			var gid = $("#gid").val();
			if(ch == (media._object.channelListLength - 1)) {
				ch = 0;
			} else {
				ch++;
			}
			location.href= 'tv_channel_fullscreenlg.php?ch=' + ch + '&gid=' + gid;
			media._object.Fn_Right_KeyDownHandler();
            media._object.Fn_Play_Pause();
            if (media.fullScreen) {
                media.JS_SliderFunction();
                media._object.Fn_Play_Pause();
            };
            break;
        case keyCodes.KEY_CHdown:
			var ch = $("#divCurrentChannelOrder").val();
			var gid = $("#gid").val();
			if(ch == 0) {
				ch = media._object.channelListLength - 1;
			} else {
				ch--;
			}		
			location.href= 'tv_channel_fullscreenlg.php?ch=' + ch + '&gid=' + gid;
            media._object.Fn_Left_KeyDownHandler();
            media._object.Fn_Play_Pause();
            if (media.fullScreen) {
                media.JS_SliderFunction();
                media._object.Fn_Play_Pause();
            };
            break;
        case keyCodes.KEY_rewind:
            if (media.fullScreen) { media.JS_SliderFunction(); };
            media.JS_TrickModeBackward_Function();
            break;
        case keyCodes.KEY_fastFwd:
            if (media.fullScreen) { media.JS_SliderFunction(); };
            media.JS_TrickModeForward_Function();
            break;
        case keyCodes.KEY_stop:
            if (media.fullScreen) { media.JS_SliderFunction(); };
            media._object.playSRC = null;
            media.JS_Stop_Function();
            break;
        case keyCodes.KEY_back:
			hcap.channel.stopCurrentChannel({
			 "onSuccess":function() {
				 console.log("onSuccess");
			 }, 
			 "onFailure":function(f) {
				 console.log("onFailure : errorMessage = " + f.errorMessage);
			 }
			});
			location.href= 'tv_channel.php';
            break;
        case keyCodes.KEY_exit:
        case keyCodes.KEY_BackSpace:
            if (media.fullScreen) { media.JS_SliderFunction(); media.JS_FullScreen_Function(); };
            break;
        case keyCodes.KEY_blue:
		case keyCodes.KEY_green:
			location.href= 'vod.php';
            break;
		case keyCodes.KEY_yellow:
            location.href= 'roomservice.php';
            break;
		case keyCodes.KEY_red:
			location.href= 'tv_channel.php';
            break;
		case keyCodes.KEY_home:
			location.href= 'index.php?menu=1';
            break;
		case keyCodes.KEY_tv:
			location.href= 'tv_channel.php';
            break;
		case keyCodes.KEY_vod:
			location.href= 'vod.php';
            break;
		case keyCodes.KEY_fnb:
			location.href= 'roomservice.php';
            break;
    };
};

/* Key Based Video Controls Operation */
media.JS_keyNavifation_Function = function () {
    switch (media.controlIndex) {
        case 1:
            media.JS_FullScreen_Function();
            media.navigationChange = false;
            break;
        case 2:
            media._object.Fn_MediaClearTrickmode();
            if (media.fullScreen) { media.JS_SliderFunction(); };
            media.JS_SeekBackward_Function();
            break;
        case 3:
            if (media.fullScreen) { media.JS_SliderFunction(); };
            media.JS_TrickModeBackward_Function();
            break;
        case 4:
            media._object.Fn_Play_Pause();
            break;
        case 5:
            if (media.fullScreen) { media.JS_SliderFunction(); };
            media.JS_TrickModeForward_Function();
            break;
        case 6:
            media._object.Fn_MediaClearTrickmode();
            if (media.fullScreen) { media.JS_SliderFunction(); };
            media.JS_SeekForward_Function();
            break;
        case 7:
            media._object.playSRC = null;
            media.JS_Stop_Function();
            break;
    };
};

/* Full Screen Functionality */
media.JS_FullScreen_Function = function () {
    //media._object.Fn_Play_Pause();
    media._object.FN_Control_NonFocus();
    media.controlIndex = 0;
    media._object.Fn_ChannelList_Focus();
    $(media.divVideoContainer).toggleClass("divVideoContainer_fullScreen");
    $(media.video).toggleClass("videoControl_fullScreen");
    $(media.mediaPlayIcon).toggleClass("mediaPlayIcon_fullScreen");
    //$("#apDiv2").toggleClass("hide");
    $("#apDiv2").css("z-index", "1");
    $("#divCurrentChannelNameContainer").css("z-index", "2");
/*     $("#divControlContainer,#divCurrentChannelNameContainer").toggleClass("displayNone");
    $("#divFullScreenControl,#divSeekControls").toggleClass("displayNone");
    $("#divErrorMsg").toggleClass("divErrorMsg_Full");
    $("#divLoading").toggleClass("divLoading_Full"); 
    $("#divChannelList,#divChannelListItems").toggleClass("displayNone"); */
    media.JS_SliderFunction();
    media.fullScreen = (media.fullScreen) ? false : true;
};

/* HTML5 Video Seek Backward Functionality */
media.JS_SeekBackward_Function = function () {
    if (media._loadEvents && media.currentVideoPlay) {
        media._object.Fn_Media_skip(-(media._object.mediaSkipped));
    }
};

/* HTML5 Video Seek Forward Functionality */
media.JS_SeekForward_Function = function () {
    if (media._loadEvents && media.currentVideoPlay) {
        media._object.Fn_Media_skip(media._object.mediaSkipped);
    }
};

/* HTML5 Video Trick Backward Functionality */
media.JS_TrickModeBackward_Function = function () {
    if (media.video.currentTime > 0 && media._loadEvents && media.currentVideoPlay) {
        $("#divVideoFullScreenIcons").attr("class", "divVideoFullScreenIconsfb");
        if (media.video.playbackRate <= 1) {
            if (media._object.mediaplaybackRateDisplay < 64) {
                media._object.mediaplaybackRateDisplay = media._object.mediaplaybackRateDisplay;
                media._object.Fn_Media_seeking(-(media._object.mediaplaybackRate));
            } else {
                media._object.mediaplaybackRateDisplay = 0;
                media.video.playbackRate = 1;
                media._object.Fn_Media_seeking(-(media._object.mediaplaybackRate));
            };

            if (media._object.mediaplaybackRateDisplay == 0) {
                media._object.mediaplaybackRateDisplay = 2;
            } else {
                media._object.mediaplaybackRateDisplay = media._object.mediaplaybackRateDisplay * 2;
            };

            $("#divFullTrickValue,#divSeekBackDisplay").show().html(media._object.mediaplaybackRateDisplay + "x");
            $("#divSeekForwardDisplay").hide();
        } else {
            media.video.playbackRate = 1;
            media._object.mediaplaybackRateDisplay = 2;
            media._object.Fn_Media_seeking(-(media._object.mediaplaybackRate));
            $("#divFullTrickValue,#divSeekBackDisplay").show().html(media._object.mediaplaybackRateDisplay + "x");
            $("#divSeekForwardDisplay").hide();
        };
    };
};

/* HTML5 Video Trick Forward Functionality */
media.JS_TrickModeForward_Function = function () {
    if (media.video.currentTime > 0 && media._loadEvents && media.currentVideoPlay) {
        $("#divVideoFullScreenIcons").attr("class", "divVideoFullScreenIconsff");
        if (media.video.playbackRate >= 1) {
            if (media._object.mediaplaybackRateDisplay < 64) {
                media._object.mediaplaybackRateDisplay = media._object.mediaplaybackRateDisplay;
                media._object.Fn_Media_seeking(media._object.mediaplaybackRate);
            }
            else {
                media._object.mediaplaybackRateDisplay = 0;
                media.video.playbackRate = 1;
                media._object.Fn_Media_seeking(media._object.mediaplaybackRate);
            };
            if (media._object.mediaplaybackRateDisplay == 0) {
                media._object.mediaplaybackRateDisplay = 2;
            } else {
                media._object.mediaplaybackRateDisplay = media._object.mediaplaybackRateDisplay * 2;
            };
            $("#divFullTrickValue,#divSeekForwardDisplay").show().html(media._object.mediaplaybackRateDisplay + "x");
            $("#divSeekBackDisplay").hide();

        } else {
            media.video.playbackRate = 1;
            media._object.mediaplaybackRateDisplay = 2;
            media._object.Fn_Media_seeking(media._object.mediaplaybackRate);
            $("#divFullTrickValue,#divSeekForwardDisplay").show().html(media._object.mediaplaybackRateDisplay + "x");
            $("#divSeekBackDisplay").hide();
        };
    };
};

/* HTML5 Video toggle Key Based and Remote key Functionality */
media.JS_PlayPause_Function = function () {
    if (!media.navigationChange) {
        media._object.Fn_Play_Pause();
    } else {
        $("#divSeekBackDisplay,#divSeekForwardDisplay").hide();
        media.JS_keyNavifation_Function();
    };
};

/* HTML5 Video toggle Key Based Functionality */
media.JS_Stop_Function = function () {
    if (media.video.currentTime != 0) {
        media.video.pause();
        $("#divFullTrickValue").hide();
        $("#divVideoFullScreenIcons").attr("class", "divVideoFullScreenIconsPlay");
        Js_Fn_Ended();
        media.video.currentTime = 0;
    };
};

/*  Slider Info Banner Opener and Clear Timer Function */
media.JS_SliderFunction = function () {
    media.JS_SliderOpen();
    clearTimeout(media.sliderTimer);
    media.sliderTimer = setTimeout(function () {
        media.JS_SliderClose();
    }, media.bannerTimeoutValue);
};

/* Slider Info Banner Open Function */
media.JS_SliderOpen = function () {
    //$("#divFullScreenControl").stop().animate({ top: "570px" }, "fast");
    //$("#divFullScreenControl").css("top","570px");
    media.slide = true;
};

/* Slider Info Banner Close Function */
media.JS_SliderClose = function () {
    $("#divFullScreenControl").stop().animate({ top: "720px" }, "fast");
    media.slide = false;
};

/* Slider Info Banner toggle open and close */
media.JS_info_Function = function () {
    if (media.slide) {
        media.JS_SliderClose();
    } else {
        media.JS_SliderOpen();
    };
};

/* Empty Mouse over Function (Used in Future) */
media.JS_MouseOverFunction = function (obj, val) { 
media.JS_PlayPause_Function();
}; 
