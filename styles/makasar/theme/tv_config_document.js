/* HTML 5 Video Configuration File */

/* video skip divide value */
media.mediaSkipDivide = 10;

/*  video banner timeout value  */
media.bannerTimeoutValue = 5000;

media.channelListTimeoutValue = 3000;

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
    
    
    media.video.addEventListener("playing", function (e) {
        media.Fn_DebugHandling(e);
        media._object.Fn_MediaPlayEvents();
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

if(channelListArray.length == 0) {
    channelListArray[media.channelIndex] = 0;
}

var init = function () {
    media.channelListObj = $("#divChannelListItems");
    media.channelListObjCategory = $("#divChannelListItemsCategory");
    media.divVideoContainer = $("#divVideoContainer");
    media.video = doc.getElementById("media");
    media.videoControl = $("#divControlContainer");
    media.ChannelCount = $("#divChannelCount");
    media.mediaPlayIcon = $("#mediaPlayIcon");
    media.videoControlLen = $(media.videoControl).children().length;
    media.controlLength = media.videoControl.children().length;
    $(media.ChannelCount).html((media.channelIndex + 1) + "/" + media._object.channelListLength);
    $("#divCurrentChannelName,#divCurrentChannelNameFullScreen").html(media.Fn_ValidateChannel(channelListArray[media.channelIndex], true));
    $("#divCurrentChannelDescFullScreen").html(channelListArray[media.channelIndex][2]);
    
    $("#divCurrentChannelNoFullScreen").html(channelListArray[media.channelIndex][4]);
    //$("#divCurrentEpgTimeFullScreen").html(channelListArray[media.channelIndex][6]);
    //$("#divCurrentEpgProgramFullScreen").html(channelListArray[media.channelIndex][7]);
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
    var source = 'channel';
    debugPrint.console("**************media.handler*****************[" + key + "]***********************************");
    e.preventDefault(); e.stopPropagation();
    
    switch (key) {
        /*case keyCodes.KEY_left:
            var active = $("#active").val();
            var ch_index = $("#ch_index").val();
            
            if(active == "category") {
                $("#divChannelLayerCategory").addClass('displayNone');
                $("#divChannelListItemsCategory").html('');
                $("#divChannelListItems").children().eq(ch_index).addClass('channelFocus');
                $("#active").val('');
                $("#index_category").val(0);
                $("#gt").remove();
                media.focusCategoryIndex = 0;
                media.channelCategoryIndex = 0;
            } else {
                media._object.Fn_Up_KeyDownHandler();
                if (media.fullScreen) {
                    media._object.Fn_Right_KeyDownHandler();
                    media._object.Fn_Play_Pause(source);
                };
            }
            break;
        case keyCodes.KEY_right:
            media._object.Fn_Down_KeyDownHandler();
            if (media.fullScreen) {
                media._object.Fn_Left_KeyDownHandler();
                media._object.Fn_Play_Pause(source);
            };
            break;*/
        case keyCodes.KEY_up:
            var mode = $("#mode").val();
            var active = $("#active").val();
            
            if(active == "category") {
                media._object.Fn_Left_KeyDownHandler_Category();
            } else {
                $("#active").val("");
                $("#verify_password").val('');
                
                if (mode == 'nonfullscreen') {
                    media._object.Fn_Left_KeyDownHandler();
                    media._object.Fn_Play_Pause(source);
                    
                } else {
                    media._object.Fn_Right_KeyDownHandler();
                    media._object.Fn_Play_Pause(source);
                    //$("#divCurrentChannelAds").html('');
                    //media.JS_AdsBanner_Function(channelListArray[media.channelIndex][8]);
                    //media.JS_EpgInfo_Function(channelListArray[media.channelIndex][8]);
		   $("#divCurrentChannelNoFullScreen").html(channelListArray[media.channelIndex][4]);
                }; 
                
                media.JS_SliderFunction(); 
            }
            break;
        case keyCodes.KEY_down:
            var mode = $("#mode").val();
            var active = $("#active").val();
            
            
            if(active == "category") {
                media._object.Fn_Right_KeyDownHandler_Category();
            } else {
                $("#active").val("");
                $("#verify_password").val('');
                
                if (mode == 'nonfullscreen') {
                    media._object.Fn_Right_KeyDownHandler();
                    media._object.Fn_Play_Pause(source);
                    
                } else {
                    media._object.Fn_Left_KeyDownHandler();
                    media._object.Fn_Play_Pause(source);
                    //$("#divCurrentChannelAds").html('');
                    //media.JS_AdsBanner_Function(channelListArray[media.channelIndex][8]);
                    //media.JS_EpgInfo_Function(channelListArray[media.channelIndex][8]);
		   $("#divCurrentChannelNoFullScreen").html(channelListArray[media.channelIndex][4]);
                }; 
                
                media.JS_SliderFunction(); 
            }
            break;
        case keyCodes.KEY_enter:
            if(channelListArray.length > 0) {
                var tv_channel_id = channelListArray[media.channelIndex][8];
                var pwd_plock = channelListArray[media.channelIndex][10];
            }
            var mode = $("#mode").val();
            var active = $("#active").val();
            
            var pwd = $("#password").html();
            var index_category = $("#index_category").val();
            
            if(mode == 'fullscreen') {
                
                $("#mode").val('nonfullscreen');
                media.JS_FullScreen_Function();
                
            } else {
                $("#mode").val('fullscreen');
                media.JS_FullScreen_Function();
                
            }
        
            break;
        case keyCodes.KEY_play:
            if (media.fullScreen) { media.JS_SliderFunction(); };
            //media.JS_PlayPause_Function();
            break;
        case keyCodes.KEY_CHup:
            //$("#verify_password").val('');
            media._object.Fn_Right_KeyDownHandler();
            media._object.Fn_Play_Pause(source);
                $("#divCurrentChannelNoFullScreen").html(channelListArray[media.channelIndex][4]);
            media.JS_SliderFunction(); 
            
            break;
        case keyCodes.KEY_CHdown:
            //$("#verify_password").val('');
            media._object.Fn_Left_KeyDownHandler();
            media._object.Fn_Play_Pause(source);
                $("#divCurrentChannelNoFullScreen").html(channelListArray[media.channelIndex][4]);
            media.JS_SliderFunction(); 
            
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
            location.href= 'index.php';
            break;
        case keyCodes.KEY_exit:
        case keyCodes.KEY_BackSpace:
            location.href= 'index.php';
            break;
        /*case keyCodes.KEY_yellow:
            
        case keyCodes.KEY_blue:
            
        case keyCodes.KEY_green:
            
        case keyCodes.KEY_red:
        */
        case keyCodes.KEY_home:
            location.href= 'index.php';
            break;
        /*case keyCodes.KEY_tv:
            location.href= 'tv_channel.php';
            break;
        case keyCodes.KEY_vod:
            location.href= 'vod.php';
            break;
        case keyCodes.KEY_fnb:
            location.href= 'roomservice.php';
            break;*/
        case keyCodes.KEY_0: 
        case keyCodes.KEY_1: 
        case keyCodes.KEY_2:
        case keyCodes.KEY_3:
        case keyCodes.KEY_4:
        case keyCodes.KEY_5:
        case keyCodes.KEY_6:
        case keyCodes.KEY_7:
        case keyCodes.KEY_8:
        case keyCodes.KEY_9:
            
            var value = NUMERIC_KeyTable[key];
            media.JS_ChannelSwitchByOrder(key);
            
            break;
    };
    //}
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
    media._object.FN_Control_NonFocus();
    media.controlIndex = 0;
    //media._object.Fn_ChannelList_Focus();
    $(media.divVideoContainer).toggleClass("divVideoContainer_fullScreen");
    $(media.video).toggleClass("videoControl_fullScreen");
    $(media.mediaPlayIcon).toggleClass("mediaPlayIcon_fullScreen");
    //$("#apDiv2").toggleClass("hide");
    $("#apDiv2").css("z-index", "1");
    $("#divCurrentChannelNameContainer").css("z-index", "2");
    $("#logoPlay").toggleClass("displayNone");
	$("#divCurrentChannelNoFullScreen").html(channelListArray[media.channelIndex][4]);
    
    var mode = $("#mode").val(); 
    if(mode == "fullscreen") {
        $("#divChannelList").addClass("displayNone");
        $("#divChannelListHeader").addClass("displayNone");
        $("#divChannelListFooter").addClass("displayNone");
        $("#divChannelLayer").addClass("displayNone");
        $("#divFullScreenControl,#divSeekControls").removeClass("displayNone");
        /*
		$("#divParentalLockText").addClass("displayNone");
        $("#divGenreText").addClass("displayNone");
        $("#divFavoriteText").addClass("displayNone");
        $("#divMailText").addClass("displayNone");
        $("#divCurrentChannelAds").html('');
        */
		//media.JS_AdsBanner_Function(channelListArray[media.channelIndex][8]);
        //media.JS_EpgInfo_Function(channelListArray[media.channelIndex][8]);
    } else if(mode == "nonfullscreen") {
        $("#divChannelList").removeClass("displayNone");
        $("#divChannelListHeader").removeClass("displayNone");
        $("#divChannelListFooter").removeClass("displayNone");
        $("#divChannelLayer").removeClass("displayNone");
        $("#divFullScreenControl,#divSeekControls").addClass("displayNone");
        /*$("#divParentalLockText").removeClass("displayNone");
        $("#divGenreText").removeClass("displayNone");
        $("#divFavoriteText").removeClass("displayNone");
        $("#divMailText").removeClass("displayNone");
		*/
    }
    
    /*
    $("#divChannelListHeader").toggleClass("displayNone");
    $("#divChannelListFooter").toggleClass("displayNone");
    $("#divChannelLayer").toggleClass("displayNone");
    $("#divFullScreenControl,#divSeekControls").toggleClass("displayNone");
    */
    //$("#divChannelScrambledBground,#divChannelScrambled").toggleClass("displayNone");
    //$("#divParentalLockBground,#divParentalPassword").toggleClass("displayNone");
    
/*     $("#divControlContainer,#divCurrentChannelNameContainer").toggleClass("displayNone");
    $("#divErrorMsg").toggleClass("divErrorMsg_Full");
    $("#divLoading").toggleClass("divLoading_Full"); 
    $("#divChannelList,#divChannelListItems").toggleClass("displayNone"); */
    media.JS_SliderFunction();
    media.fullScreen = (media.fullScreen) ? false : true;
 
    /*$.ajax({
            url: "ajax.php",
            cache: false,
            type: "GET",
            data: "mod=last_channel&tv_channel_id=" + channelListArray[media.channelIndex][8],
            success: function(response){
                    console.log(response);
                }
        });
*/
    // Subscribed Channel
    if (channelListArray[media.channelIndex][13] == 0) {
        $("#divChannelScrambledBground,#divChannelScrambled").removeClass("displayNone");
    } else {
        $("#divChannelScrambledBground,#divChannelScrambled").addClass("displayNone");
    };
    
    var verified = $("#verify_password").val();
    if (channelListArray[media.channelIndex][9] == 1 && verified != 1) {
        $("#divParentalLockBground").toggleClass("displayNone");
        $("#divParentalLock").toggleClass("displayNone");
        $("#active").val("parental");
        
    } else {
        $("#divParentalLockBground").addClass("displayNone");
        $("#divParentalLock").addClass("displayNone");
        $("#active").val("");
    };
};

media.JS_ChannelCategory_Function = function (response) {
    var _div = ""; 
    var id = Array();
    var name = Array();
    var channelListCategoryArray = Array();
    
    $("#divChannelListItems").children().removeClass('channelFocus');
    $("#active").val("category");
    
    var category = response.split(";"); 
    
    for(var i=0; i<category.length; i++) {
        var category_data = category[i].split(","); 
        for(var j=0; j<category_data.length; j++) {
            if(j == 0) {
                id[i] = category_data[j];
            } else if(j == 1) {
                name[i] = category_data[j];
            }
        }
        
        channelListCategoryArray.push(category_data);  
        
        if (i == 0) {
            _div += "<div id='divChannelListItemCategory_" + i + "' cItem='" + i + "' onmouseover='media.JS_MouseOverFunction(this," + i + ")' class='divChannelItemsCategory channelCategoryFocus' ><span class='spanChannlItem'>" + channelListCategoryArray[i][1] + "</span></div>";
        } else {
            _div += "<div id='divChannelListItemCategory_" + i + "' cItem='" + i + "' onmouseover='media.JS_MouseOverFunction(this," + i + ")' class='divChannelItemsCategory' ><span class='spanChannlItem'>" + channelListCategoryArray[i][1] + "</span></div>";
        };
        
    }
    
    $("#total_category").val(category.length);
    
    $("#divChannelListItemsCategory").html(_div);
    for (var i = 0; i < category.length; i++) {
        media.channelListCategoryObject[i] = $("#divChannelListItemCategory_" + i);
    };
}

media.JS_ParentalLock_Function = function () {
    var pwd = $("#password").html();
    $("#active").val("toggle_parental");
    $("#divParentalLock").addClass("displayNone");
    $("#divToggleParentalLock").removeClass("displayNone");
    
    if(channelListArray[media.channelIndex][10] == "") {
        $("#divToggleTitle").html("Enter Password");
    } else {
        $("#divToggleTitle").html("Remove Parental Lock");
    }
    
    if (channelListArray[media.channelIndex][9] == 0) {
        $("#divParentalLockBground").addClass("displayNone");
        //$("#divParentalLock").addClass("displayNone");
        
    } 
}

media.JS_UpdateParentalLock_Function = function (tv_channel_id, password) { 
    $.ajax({
        url: "ajax.php",
        cache: false,
        type: "GET",
        data: "mod=parental_lock&tv_channel_id=" + tv_channel_id + "&pwd=" + password,
        success: function(response){ //alert(response);
                location.href = "tv_channel.php";
            }
    });
}

media.JS_SavePasswordParentalLock_Function = function (tv_channel_id, password) {   
    $.ajax({
        url: "ajax.php",
        cache: false,
        type: "GET",
        data: "mod=parental_lock_password&tv_channel_id=" + tv_channel_id + "&pwd=" + password,
        success: function(response){ //alert(response);
                location.href = "tv_channel.php";
            }
    });
}

media.JS_AdsBanner_Function = function (tv_channel_id) {    
    var order = $("#banner_order").val();
    //order = parseInt(order) + parseInt(1);
    
    $.ajax({
        url: "ajax.php",
        cache: false,
        type: "GET",
        data: "mod=banner&order=" + order + "&tv_channel_id=" + tv_channel_id,
        success: function(response){ console.log(response);
                if(response != "") {
                    var str = response.split("|");
                    var duration = str[0];
                    var img = str[1];
                    var next_order = str[2];
                    
                    $("#divCurrentChannelAds").html('<img src="'+img+'" width="150px" height="150px">');
                    order = next_order;
                    $("#banner_order").val(order);
                
                } else {
                    $("#banner_order").val(1);
                }
            }
    });
}

media.JS_EpgInfo_Function = function (tv_channel_id) {  
    $.ajax({
        url: "ajax.php",
        cache: false,
        type: "GET",
        data: "mod=refresh_epg_on_channel&tv_channel_id=" + tv_channel_id,
        success: function(response){  //alert(response);
                var str = response.split(",");
                
                $("#divCurrentEpgProgramFullScreen").html(str[0]);
                $("#divCurrentEpgTimeFullScreen").html(str[1]);
                
            }
    });
}

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
    $("#divFullScreenControl").stop().animate({ top: "450px" }, "fast");
    $("#divChannelListHeader").stop().animate({ left: "30px" }, "fast");
    $("#divChannelList").stop().animate({ left: "40px" }, "fast");
	 media.slide = true;
};

/* Slider Info Banner Close Function */
media.JS_SliderClose = function () {
    $("#divFullScreenControl").stop().animate({ top: "720px" }, "fast");
    $("#divChannelListHeader").stop().animate({ left: "-790px" }, "fast");
    $("#divChannelList").stop().animate({ left: "-790px" }, "fast");
     $("#divChannelListFooter").stop().animate({ left: "-790px" }, "fast");
	$("#divChannelLayer").stop().animate({ left: "-790px" }, "fast");	
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

/* Method for accessing DOM element based on the active mode(fullscreen/channellist)*/
media.Fn_GetActiveAttr = function() {
    var wrapperObj = undefined;
    var conentObj = undefined;
    var indicatorObj = undefined;
    wrapperObj = $("#divChannelCover");
    conentObj = $("#divChannelIndexNO");
    indicatorObj = $("#divChannelIndexIndicator");
    return { W: wrapperObj, C: conentObj, I: indicatorObj };
}
/* Method for numeric validation of channels switching*/
media.JS_NumericValidation = function(key, last_order) {
    var Obj = media.Fn_GetActiveAttr();
    var index = NUMERIC_KeyTable[key]; /*Defined in the keycodes.js file*/
    var value = Obj.C.text();

    value = (value == "") ? "" : value;
    value = value + index;  
    var xlength = media.maxentrydigit; /*Maximum digits*/;
    if (Number(value) == 0) {
        media.Fn_IndexInvalidMsg()
        return 0;
    }
    if (value.toString().length <= xlength) {
        Obj.W.show();
        Obj.C.text(value);
        Obj.I.hide();
    }
    else {
        media.Fn_IndexInvalidMsg()
        return 0;
    }   
    
    var total_array = media._object.channelListLength; 
    //if (Number(value) <= media._object.channelListLength) {
    if (Number(value) <= last_order) {
        return Number(value);
    }
    else {
        media.Fn_IndexInvalidMsg();
        return 0;
    }
    return 0;

}
/* Method for displaying invalid messages*/
media.Fn_IndexInvalidMsg = function() {
    var Obj = media.Fn_GetActiveAttr();
    Obj.W.show();
    Obj.C.text("");
    Obj.I.show();
    clearTimeout(media.TimerEntry);
    media.TimerEntry = setTimeout(function() { Obj.W.hide() }, 2000);
}
/* Method for disposing the direct entry literals*/
media.JS_DisposeDirectEntry = function() {
    var Obj = media.Fn_GetActiveAttr();
    clearTimeout(media.TimerEntry);
    Obj.W.hide();
    Obj.I.hide();
}
/* Method for Channels Switching
Argument - Keycode
Note - Respective digits for keycode mapped in the literal 'NUMERIC_KeyTable'
in the file keycodes.js
*/

media.JS_ChannelSwitchByOrder = function(key) { 
    clearTimeout(media.TimerEntry); 
    var source = 'channel';
    var total_array = media._object.channelListLength - 1; 
    var last_order = channelListArray[total_array][4];
    //console.log('arr: '+channelListArray[total_array][4]);
    var order = media.JS_NumericValidation(key, last_order);    //console.log(order);
    if (order) {
        index = media.JS_SearchIndexByOrder(order); 
        media.TimerEntry = setTimeout(function() {  
            if (Number(index) != media.channelIndex) {  
                var serlength = media._object.channelListLength;
                var pageIndex = index / media.channelObjlen;
                pageIndex = parseInt(pageIndex) * media.channelObjlen;
                media._object.Fn_ChannelListDataBind(pageIndex);
                media.channelIndex = index;
                media._object.Fn_Focus_NonFocus();
                $(media.ChannelCount).html((media.channelIndex + 1) + "/" + media._object.channelListLength);
                var top = media.channelIndex * media._object.scrolltop;
                top += "px"; $("#DV_Scrollshaft").css("top", top);
                if (channelListArray[media.channelIndex][3] == 0) {
                    media._loadEvents = true;
                } else { media._loadEvents = false; };
            }
            if (media.fullScreen) {
                /* Fullscreen Mode*/
                media.JS_SliderFunction();

            };
            media._object.Fn_Play_Pause(source);
            var Obj = media.Fn_GetActiveAttr();
            Obj.W.hide();
            Obj.C.text("");

        }, media.commitTimer);
    }

}

media.JS_SearchIndexByOrder = function(order) {
    var currentOrder = $("#divCurrentChannelOrder").val();
    var serlength = media._object.channelListLength;
    for(var i=0; i<serlength; i++) {
        if(channelListArray[i][4] == order) {
            var index = i;
            $("#divCurrentChannelOrder").val(order);
        }
    }
    
    return index;
}
