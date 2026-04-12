<!-- INCLUDE header.tpl -->


    <!-- it works the same with all jquery version from 1.3.1 to 2.0.3 -->
    
    <!-- use jssor.slider.mini.js (39KB) or jssor.sliderc.mini.js (31KB, with caption, no slideshow) or jssor.sliders.mini.js (26KB, no caption, no slideshow) instead for release -->
    <!-- jssor.slider.mini.js = jssor.sliderc.mini.js = jssor.sliders.mini.js = (jssor.core.js + jssor.utils.js + jssor.slider.js) -->
    <script type="text/javascript" src="{T_THEME_PATH}/jssor.core.js"></script>
    <script type="text/javascript" src="{T_THEME_PATH}/jssor.utils.js"></script>
    <script type="text/javascript" src="{T_THEME_PATH}/jssor.slider-weather.js"></script>
    <script>
        jQuery(document).ready(function ($) {
            var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
                $AutoPlayInterval: 4000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 3,                               //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, default value is 3

                $ArrowKeyNavigation: true,                          //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideDuration: 500,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
                //$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                //$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                $SlideSpacing: 0,                                   //[Optional] Space between each slide in pixels, default value is 0
                $DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, direction navigator container, thumbnail navigator container etc).
                $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, default value is 1
                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

                $NavigatorOptions: {                                //[Optional] Options to specify and enable navigator or not
                    $Class: $JssorNavigator$,                       //[Required] Class to create navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $ActionMode: 1,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                    $AutoCenter: 2,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Lanes: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
                    $SpacingX: 10,                                  //[Optional] Horizontal space between each item in pixel, default value is 0
                    $SpacingY: 10,                                  //[Optional] Vertical space between each item in pixel, default value is 0
                    $Orientation: 2                                 //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
                },

                $DirectionNavigatorOptions: {
                    $Class: $JssorDirectionNavigator$,              //[Requried] Class to create direction navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 0                                  //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                },

                $ThumbnailNavigatorOptions: {
                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $ActionMode: 0,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                    $DisableDrag: true,                             //[Optional] Disable drag or not, default value is false
                    $Orientation: 2                                 //[Optional] Orientation to arrange thumbnails, 1 horizental, 2 vertical, default value is 1
                }
            };

            var jssor_slider2 = new $JssorSlider$("slider2_container", options);
            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var parentWidth = jssor_slider2.$Elmt.parentNode.clientWidth;
                if (parentWidth)
                    jssor_slider2.$SetScaleWidth(Math.min(parentWidth, 1200));
                else
                    window.setTimeout(ScaleSlider, 30);
            }

            ScaleSlider();

            if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
                $(window).bind('resize', ScaleSlider);
            }
            //responsive code end
        });
    </script>
    <div style="width:1280px;height:720px;">
    <!-- Jssor Slider Begin -->
    <!-- You can move inline styles (except 'top', 'left', 'width' and 'height') to css file or css block. -->
    <div id="slider2_container" style="position: absolute; top: 180px; left: 70px; width: 1200px; 
        height: 650px; overflow: hidden;">

       

        <!-- Slides Container -->
       <div u="slides" style="cursor: move; position: absolute; left: 10px; top: 20px; width: 600px; height: 400px;
            overflow: hidden; background: #000;">
            <!-- BEGIN directory -->
            <div>
                <img u=image src="{T_MEDIA_IMAGES_PATH}directories/600x400/{directory.S_IMAGE}"/>
                
                <div u="thumb"><h2>{directory.S_TITLE}</h2>
                <span class="sub_container"></span>
                
                </div>
            </div>
            <!-- END directory -->
            
            
        </div>

        <!-- ThumbnailNavigator Skin Begin -->
        <!--
        <div u="thumbnavigator" class="slider2-T" style="position: absolute; top: 232px; left: 21px; width:383px; height:288px; text-align: right; overflow: hidden;">
            <div style="filter: alpha(opacity=60); opacity:0.6; position: absolute; display: block;
                background-color: #52390d; top: 0px; left: 0px; width: 100%; height: 100%; padding: 10px;">
            </div>
            <!-- Thumbnail Item Skin Begin -->
            <!--<div u="slides">
                <div u="prototype" style="POSITION: absolute; WIDTH: 363px; HEIGHT: 288px; TOP: 0; LEFT: 0;">
                    <thumbnailtemplate style="font-family: verdana; font-weight: normal; POSITION: absolute; WIDTH: 100%; HEIGHT: 100%; TOP: 0px; LEFT: 0px; color:#000; line-height: 22px; font-size:14px; padding: 0px;"></thumbnailtemplate>
                </div>
            </div>-->
            <!-- Thumbnail Item Skin End -->
        <!--</div>-->
        
        <!-- ThumbnailNavigator Skin End -->
        
        <!-- Navigator Skin Begin -->
        <!-- jssor slider navigator skin 01 -->
        <style>
            /*
            .jssorn01 div           (normal)
            .jssorn01 div:hover     (normal mouseover)
            .jssorn01 .av           (active)
            .jssorn01 .av:hover     (active mouseover)
            .jssorn01 .dn           (mousedown)
            */
            .jssorn01 div, .jssorn01 div:hover, .jssorn01 .av
            {
                filter: alpha(opacity=70);
                opacity: .7;
                overflow:hidden;
                cursor: pointer;
                /*border: #000 1px solid;*/
            }
            .jssorn01 div { background-color: gray; }
            .jssorn01 div:hover, .jssorn01 .av:hover { background-color: #ab5f1b;} /* #d3d3d3; } */
            .jssorn01 .av { background-color: #fff; }
            .jssorn01 .dn, .jssorn01 .dn:hover { background-color: #555555; }
        </style>
        <!-- navigator container -->
        <!--<div u="navigator" class="jssorn01" style="position: absolute; TOP: 460px; left: 40px;">-->
            <!-- navigator item prototype -->
            <!--<div u="prototype" style="POSITION: absolute; WIDTH: 1px; HEIGHT: 1px; top: 100px;"></div>
        </div>-->
        <!-- Navigator Skin End -->
        
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
        
        <style type="text/css">
    @font-face {
    font-family: myriadpro;
    src: url({T_THEME_PATH}/myriadpro.otf);
    }
    .dir_slider img{
    border: solid 1px red;
    width: 500px;
    height: 300px;
    }
    span.sub_container{
    font-family: myriadpro;
    font-size: 22px;
    font-weight: bold;
    color: #fff;
/*  padding: 10px; */
    }
    h2{
    font-family: myriadpro;
    font-size: 30px;
    font-weight: bold;
    color: #fff;
    }
    .div_desc div{
    position: absolute;
    left: 40px;
    top: 40px;
    width: 300px;
    height: 400px;
    color: red;
    }
    
    </style>
        <!-- Arrow Left -->
        <span u="arrowleft" class="jssord05l" style="width: 40px; height: 40px; bottom: 60px; left: 330px;">
        </span>
        <!-- Arrow Right -->
        <span u="arrowright" class="jssord05r" style="width: 40px; height: 40px; bottom: 60px; right: 330px">
        </span>
        <!-- Direction Navigator Skin End -->
        <a style="display: none" href="http://www.jssor.com">Responsive Slider</a>
        <!-- Trigger -->
    </div>
    </div>
    <!-- Jssor Slider End -->
    <div id="apDiv2">{S_CONTENT}</div>
    <div id="pageTitle">{L_PAGE_TITLE}</div>
    <div id="apDiv5"></div>
    <div id="apDiv6"></div>
    
    <!-- INCLUDE footer.tpl -->