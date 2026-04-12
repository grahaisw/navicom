<!DOCTYPE html>
<html lang="{S_USER_LANG}">
<head>
    <meta charset="utf-8" />
    <meta name="author" content="Script Tutorials" />
    <meta name="description" content="{SITENAME}">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
    <title>{SITENAME}</title>

	<script src="{T_THEME_PATH}/jquery-1.10.2.min.js"></script>
	
	<!-- css stylesheets -->
	<link href="{T_THEME_PATH}/bootstrap.min.css" rel="stylesheet">
	<link href="{T_THEME_PATH}/style.css" rel="stylesheet">
	
	<script src="{T_THEME_PATH}/bootstrap.min.js"></script>
	<script type="text/javascript" src="{T_THEME_PATH}/jssor.core.js"></script>
	<script type="text/javascript" src="{T_THEME_PATH}/jssor.utils.js"></script>
	<script type="text/javascript" src="{T_THEME_PATH}/jssor.slider.js"></script>
	
	
    
	<script>
		jssor_slider1_starter = function (containerId) {

			var _SlideshowTransitions = [
			//Fade in L
				{$Duration: 1200, $During: { $Left: [0.3, 0.7] }, $FlyDirection: 1, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
			//Fade out R
				, { $Duration: 1200, $SlideOut: true, $FlyDirection: 2, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
			//Fade in R
				, { $Duration: 1200, $During: { $Left: [0.3, 0.7] }, $FlyDirection: 2, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
			//Fade out L
				, { $Duration: 1200, $SlideOut: true, $FlyDirection: 1, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }

			//Fade in T
				, { $Duration: 1200, $During: { $Top: [0.3, 0.7] }, $FlyDirection: 4, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
			//Fade out B
				, { $Duration: 1200, $SlideOut: true, $FlyDirection: 8, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
			//Fade in B
				, { $Duration: 1200, $During: { $Top: [0.3, 0.7] }, $FlyDirection: 8, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
			//Fade out T
				, { $Duration: 1200, $SlideOut: true, $FlyDirection: 4, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }

			//Fade in LR
				, { $Duration: 1200, $Cols: 2, $During: { $Left: [0.3, 0.7] }, $FlyDirection: 1, $ChessMode: { $Column: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
			//Fade out LR
				, { $Duration: 1200, $Cols: 2, $SlideOut: true, $FlyDirection: 1, $ChessMode: { $Column: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
			//Fade in TB
				, { $Duration: 1200, $Rows: 2, $During: { $Top: [0.3, 0.7] }, $FlyDirection: 4, $ChessMode: { $Row: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
			//Fade out TB
				, { $Duration: 1200, $Rows: 2, $SlideOut: true, $FlyDirection: 4, $ChessMode: { $Row: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }

			//Fade in LR Chess
				, { $Duration: 1200, $Cols: 2, $During: { $Top: [0.3, 0.7] }, $FlyDirection: 4, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
			//Fade out LR Chess
				, { $Duration: 1200, $Cols: 2, $SlideOut: true, $FlyDirection: 8, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
			//Fade in TB Chess
				, { $Duration: 1200, $Rows: 2, $During: { $Left: [0.3, 0.7] }, $FlyDirection: 1, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
			//Fade out TB Chess
				, { $Duration: 1200, $Rows: 2, $SlideOut: true, $FlyDirection: 2, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }

			//Fade in Corners
				, { $Duration: 1200, $Cols: 2, $Rows: 2, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $FlyDirection: 5, $ChessMode: { $Column: 3, $Row: 12 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $ScaleVertical: 0.3, $Opacity: 2 }
			//Fade out Corners
				, { $Duration: 1200, $Cols: 2, $Rows: 2, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $SlideOut: true, $FlyDirection: 5, $ChessMode: { $Column: 3, $Row: 12 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $ScaleVertical: 0.3, $Opacity: 2 }

			//Fade Clip in H
				, { $Duration: 1200, $Delay: 20, $Clip: 3, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
			//Fade Clip out H
				, { $Duration: 1200, $Delay: 20, $Clip: 3, $SlideOut: true, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseOutCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
			//Fade Clip in V
				, { $Duration: 1200, $Delay: 20, $Clip: 12, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
			//Fade Clip out V
				, { $Duration: 1200, $Delay: 20, $Clip: 12, $SlideOut: true, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseOutCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
				];

			var options = {
                $AutoPlay: false,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlayInterval: 1500,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 3,                                //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, default value is 3

                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideDuration: 800,                                //Specifies default duration (swipe) for slide in milliseconds

                $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
                    $Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
                    $Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
                    $TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
                    $ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
                },

                $DirectionNavigatorOptions: {                       //[Optional] Options to specify and enable direction navigator or not
                    $Class: $JssorDirectionNavigator$,              //[Requried] Class to create direction navigator instance
                    $ChanceToShow: 1                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                },

                $ThumbnailNavigatorOptions: {                       //[Optional] Options to specify and enable thumbnail navigator or not
                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always

                    $ActionMode: 1,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                    $SpacingX: 6,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                    $DisplayPieces: 10,                             //[Optional] Number of pieces to display, default value is 1
                    $ParkingPosition: 360                          //[Optional] The offset position to park thumbnail
                }
            };

			var jssor_slider1 = new $JssorSlider$(containerId, options);
			//responsive code begin
			//you can remove responsive code if you don't want the slider scales while window resizes
			function ScaleSlider() {
				var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
				if (parentWidth)
					jssor_slider1.$SetScaleWidth(Math.max(Math.min(parentWidth, 800), 300));
				else
					$JssorUtils$.$Delay(ScaleSlider, 30);
			}

			//ScaleSlider();
			$JssorUtils$.$AddEvent(window, "load", ScaleSlider);

			if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
				$JssorUtils$.$OnWindowResize(window, ScaleSlider);
			}
			//responsive code end
		};
	</script>
	
	<script  type="text/javascript">
	function go(url) {
		location.href = url;
	}
	function hideAddressBar(){
	    if(document.documentElement.scrollHeight<window.outerHeight/window.devicePixelRatio)
		document.documentElement.style.height=(window.outerHeight/window.devicePixelRatio)+'px';
		setTimeout(window.scrollTo(1,1),0);
	}

	  window.addEventListener("load",function(){hideAddressBar();});
	  window.addEventListener("orientationchange",function(){hideAddressBar();});
    
	</script>
	
	<!-- IF S_TV_CHANNEL -->
	<script type="text/javascript" src="{T_THEME_PATH}/html5gallery.js"></script>
	<!-- ENDIF -->
	
	<!-- IF S_MOVIES -->
	<script type="text/javascript" src="{T_THEME_PATH}/html5gallery.js"></script>
	<!-- ENDIF -->

	<!-- IF S_DIRECTORY -->
	<link rel="stylesheet" href="{T_THEME_PATH}/pgwslider.css" type="text/css" />
	<script src="{T_THEME_PATH}/pgwslider.min.js"></script>
	
	<script type="text/javascript">
	    $(document).ready(function() {
		$('.pgwSlider').pgwSlider();
	    });
	</script>
	
	<!-- ENDIF -->
	
	<!-- IF S_WEATHER -->
	<script type="text/javascript" src="{T_THEME_PATH}/jssor.core.js"></script>
	<script type="text/javascript" src="{T_THEME_PATH}/jssor.utils.js"></script>
	<script type="text/javascript" src="{T_THEME_PATH}/jssor.slider.js"></script>
	<!-- ENDIF -->
	
	<!-- IF S_INBOX -->
	<link rel="stylesheet" href="{T_THEME_PATH}/zebra_accordion.css" type="text/css" />
	<script src="{T_THEME_PATH}/zebra_accordion.js"></script>
	
	<script type="text/javascript">
	    $(document).ready(function() {
		var myAccordion = new $.Zebra_Accordion($('.Zebra_Accordion'));
	    });
	</script>
	
	<style type="text/css" media="screen">
	    #sendMessage {
		background: #333; 
		margin-left: 50px;
		text-align: right;
		padding: 10px;
		width: 200px;
		font-weight: bold;
		font-size: 18px;
	    }
	</style>
	
	<!-- ENDIF -->
	
	<!-- IF S_VIEWBILL -->
	<link rel="stylesheet" href="{T_THEME_PATH}/viewbill.css" type="text/css" />
	<!-- ENDIF -->
	
	<!-- IF S_SENDMESSAGE -->
	<link rel="stylesheet" type="text/css" href="{T_THEME_PATH}/sendmessage.css" />
	<!-- ENDIF -->
	
	<!-- IF S_ROOMSERVICE_CATEGORY -->
	<style>
		.row a{
			text-decoration:none;
			font-weight:bold;
		}
	</style>
	<!-- ENDIF -->
	
	<!-- IF S_ROOMSERVICE -->
	<script type="text/javascript" src="{T_THEME_PATH}/jssor.core.js"></script>
	<script type="text/javascript" src="{T_THEME_PATH}/jssor.utils.js"></script>
	<script type="text/javascript" src="{T_THEME_PATH}/jssor.slider.js"></script>
	<!-- ENDIF -->
	
	<!-- IF S_LANGUAGE -->
	<style type="text/css">
		.row a{
			text-decoration:none;
		}
	</style>
	<!-- ENDIF -->
	
	<!-- IF S_TOUR_CATEGORY -->
	<style>
		.row a{
			text-decoration:none;
			font-weight:bold;
		}
	</style>
	<!-- ENDIF -->
	
	<!-- IF S_TOUR -->
	<script type="text/javascript" src="{T_THEME_PATH}/jssor.core.js"></script>
	<script type="text/javascript" src="{T_THEME_PATH}/jssor.utils.js"></script>
	<script type="text/javascript" src="{T_THEME_PATH}/jssor.slider.js"></script>
	<!-- ENDIF -->
	
	<!-- IF S_SHOP_CATEGORY -->
	<style>
		.row a{
			text-decoration:none;
			font-weight:bold;
		}
	</style>
	<!-- ENDIF -->
	
	<!-- IF S_SHOP -->
	<script type="text/javascript" src="{T_THEME_PATH}/jssor.core.js"></script>
	<script type="text/javascript" src="{T_THEME_PATH}/jssor.utils.js"></script>
	<script type="text/javascript" src="{T_THEME_PATH}/jssor.slider.js"></script>
	<!-- ENDIF -->
	
	<!-- IF S_SPA_CATEGORY -->
	<style>
		.row a{
			text-decoration:none;
			font-weight:bold;
		}
	</style>
	<!-- ENDIF -->
	
	<!-- IF S_SPA -->
	<script type="text/javascript" src="{T_THEME_PATH}/jssor.core.js"></script>
	<script type="text/javascript" src="{T_THEME_PATH}/jssor.utils.js"></script>
	<script type="text/javascript" src="{T_THEME_PATH}/jssor.slider.js"></script>
	<!-- ENDIF -->
    
</head>
<body id="body">


    <!-- fixed navigation bar -->
    <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#b-menu-1">
            <span class="sr-only"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">{L_ROOM}: {S_ROOM} - {S_GUEST}</a>
        </div>
		<div id="slider1_container" style="position: relative; top: 0px; right: -20px; width: 800px;
        height: 100px; background: #222; overflow: hidden; float:right;">

        <!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 800px; height: 356px; overflow: hidden;">
            <!-- BEGIN menu -->
			<div>
                <img u="thumb" src="{T_IMAGESET_PATH}/60x60/{menu.S_MENU_THUMBNAIL}" onclick="go('{menu.S_MENU_URL}')" />
            </div>
            <!-- END menu -->
        </div>
        
        <!-- Direction Navigator Skin Begin -->
        <style>
            /* jssor slider direction navigator skin 05 css */
            /*
            .jssord05l              (normal)
            .jssord05r              (normal)
            .jssord05l:hover        (normal mouseover)
            .jssord05r:hover        (normal mouseover)
            .jssord05ldn            (mousedown)
            .jssord05rdn            (mousedown)
            */
            .jssord05l, .jssord05r, .jssord05ldn, .jssord05rdn
            {
            	position: absolute;
            	cursor: pointer;
            	display: block;
                background: url(../img/d17.png) no-repeat;
                overflow:hidden;
            }
            .jssord05l { background-position: -10px -40px; }
            .jssord05r { background-position: -70px -40px; }
            .jssord05l:hover { background-position: -130px -40px; }
            .jssord05r:hover { background-position: -190px -40px; }
            .jssord05ldn { background-position: -250px -40px; }
            .jssord05rdn { background-position: -310px -40px; }
        </style>
        <!-- Arrow Left -->
        <span u="arrowleft" class="jssord05l" style="width: 40px; height: 40px; top: 158px; left: 8px;">
        </span>
        <!-- Arrow Right -->
        <span u="arrowright" class="jssord05r" style="width: 40px; height: 40px; top: 158px; right: 8px">
        </span>
        <!-- Direction Navigator Skin End -->
        
        <!-- Thumbnail Navigator Skin Begin -->
        <div u="thumbnavigator" class="jssort01" style="position: absolute; width: 800px; height: 100px; left:0px; bottom: 0px;">
        
            <!-- Thumbnail Item Skin Begin -->
            <style>
                /* jssor slider thumbnail navigator skin 01 css */
                /*
                .jssort01 .p           (normal)
                .jssort01 .p:hover     (normal mouseover)
                .jssort01 .pav           (active)
                .jssort01 .pav:hover     (active mouseover)
                .jssort01 .pdn           (mousedown)
                */
                .jssort01 .w
                {
                    position: absolute;
                    top: 0px;
                    left: 0px;
                    width: 100%;
                    height: 100%;
                }
                .jssort01 .c
                {
                    position: absolute;
                    top: 0px;
                    left: 0px;
                    width: 70px;
                    height: 70px;
                    /*border: #000 2px solid;*/
                }
                .jssort01 .p:hover .c, .jssort01 .pav:hover .c, .jssort01 .pav .c 
                {
                	background: url(../img/t01.png) center center;
                	border-width: 0px;
                    top: 2px;
                    left: 2px;
                    width: 70px;
                    height: 70px;
                }
                .jssort01 .p:hover .c, .jssort01 .pav:hover .c
                {
                    top: 0px;
                    left: 0px;
                    width: 72px;
                    height: 72px;
                    /*border: #fff 1px solid;*/
                }
            </style>
            <div u="slides" style="cursor: move;">
                <div u="prototype" class="p" style="position: absolute; width: 74px; height: 74px; top: 0; left: 0;">
                    <div class=w><thumbnailtemplate style=" width: 100%; height: 100%; border: none;position:absolute; top: 0; left: 0;"></thumbnailtemplate></div>
                    <div class=c>
                    </div>
                </div>
            </div>
            <!-- Thumbnail Item Skin End -->
        </div>
        <!-- Thumbnail Navigator Skin End -->
        
        <!-- Trigger -->
        <script>
            jssor_slider1_starter('slider1_container');
        </script>
    </div>
		
      </div> <!-- /.container -->
    </div> <!-- /.navbar -->

<br/><br/><br/><br/><br/><br/>