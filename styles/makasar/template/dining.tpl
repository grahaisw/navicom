<!-- INCLUDE header.tpl -->

    <!-- it works the same with all jquery version from 1.3.1 to 2.0.3 -->
    <script type="text/javascript" src="./styles/santika/theme/jquery-2.1.0.min.js"></script>
    <!-- use jssor.slider.mini.js (39KB) or jssor.sliderc.mini.js (31KB, with caption, no slideshow) or jssor.sliders.mini.js (26KB, no caption, no slideshow) instead for release -->
    <!-- jssor.slider.mini.js = jssor.sliderc.mini.js = jssor.sliders.mini.js = (jssor.core.js + jssor.utils.js + jssor.slider.js)  -->
    
    <script type="text/javascript" src="{T_THEME_PATH}/njssor.core.js"></script>
    <script type="text/javascript" src="{T_THEME_PATH}/njssor.utils.js"></script>
    <script type="text/javascript" src="{T_THEME_PATH}/njssor.slider.js"></script>
    <script>
        jQuery(document).ready(function ($) {
            var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlayInterval: 4000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 3,                                   //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, default value is 3

                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideDuration: 800,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
                //$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                //$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                $SlideSpacing: 0, 					                //[Optional] Space between each slide in pixels, default value is 0
                $DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, direction navigator container, thumbnail navigator container etc).
                $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, default value is 1
                $DragOrientation: 1,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

                $DirectionNavigatorOptions: {                       //[Optional] Options to specify and enable direction navigator or not
                    $Class: $JssorDirectionNavigator$,              //[Requried] Class to create direction navigator instance
                    $ChanceToShow: 1,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 2,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
                },

                $ThumbnailNavigatorOptions: {
                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always

                    $ActionMode: 1,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                    $AutoCenter: 0,                                 //[Optional] Auto center thumbnail items in the thumbnail navigator container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 3
                    $Lanes: 1,                                      //[Optional] Specify lanes to arrange thumbnails, default value is 1
                    $SpacingX: 3,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                    $SpacingY: 3,                                   //[Optional] Vertical space between each thumbnail in pixel, default value is 0
                    $DisplayPieces: 9,                              //[Optional] Number of pieces to display, default value is 1
                    $ParkingPosition: 260,                          //[Optional] The offset position to park thumbnail
                    $Orientation: 1,                                //[Optional] Orientation to arrange thumbnails, 1 horizental, 2 vertical, default value is 1
                    $DisableDrag: false                            //[Optional] Disable drag or not, default value is false
                }
            };

            var jssor_slider1 = new $JssorSlider$("slider1_container", options);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var bodyWidth = document.body.clientWidth;
                if (bodyWidth)
                    jssor_slider1.$SetScaleWidth(Math.min(bodyWidth, 1280));
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
    <div style="position: relative; top: 150px; width: 100%; overflow: hidden;">
        <div style="position: relative; left: 50%; width: 5000px; text-align: center; margin-left: -2500px;">
            <!-- Jssor Slider Begin -->
            <div id="slider1_container" style="position: relative; margin: 0 auto;
                top: 0px; left: 0px; width: 1280px; height: 400px;">
                <!-- Loading Screen -->
                <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                    <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block;
                        top: 0px; left: 0px; width: 100%; height: 100%;">
                    </div>
                    <div style="position: absolute; display: block; background: url(../img/loading.gif) no-repeat center center;
                        top: 0px; left: 0px; width: 100%; height: 100%;">
                    </div>
                </div>
                <!-- Slides Container -->
                <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1280px;
                    height: 500px; overflow: hidden;">
                    
                    <!-- BEGIN directory -->
                    <div>
                        <div style="position: absolute; width: 580px; height: 300px; top: 10px; left: 60px;
                            text-align: left; line-height: 1.8em; font-size: 12px;font-family: navicom-normal, jp, cn, kr;">
                            <br />
                            <span style="display: block; line-height: 1em; text-transform: uppercase; font-size: 52px;
                                color: #333;">{directory.S_TITLE}</span>
                            <br />
                            <span style="display: block; line-height: 1.1em; font-size: 1.5em; color: #333;">{directory.S_CONTENT}</span>
                            <br />
                        </div>
                        <img src="{T_MEDIA_IMAGES_PATH}directories/dinings/600x400/{directory.S_IMAGE}" style="position: absolute; left: 650px; top:-40px;" />
                    </div>
                    
                    <!-- END directory -->
                </div>
                <!-- Direction Navigator Skin Begin -->
                <style>
                    /* jssor slider direction navigator skin 07 css */
                    /*
                    .jssord07l              (normal)
                    .jssord07r              (normal)
                    .jssord07l:hover        (normal mouseover)
                    .jssord07r:hover        (normal mouseover)
                    .jssord07ldn            (mousedown)
                    .jssord07rdn            (mousedown)
                    */
                    .jssord07l, .jssord07r, .jssord07ldn, .jssord07rdn
                    {
                        position: absolute;
                        cursor: pointer;
                        display: block;
                        background: url(../img/d07.png) no-repeat;
                        overflow: hidden;
                    }
                    .jssord07l
                    {
                        background-position: -5px -35px;
                    }
                    .jssord07r
                    {
                        background-position: -65px -35px;
                    }
                    .jssord07l:hover
                    {
                        background-position: -125px -35px;
                    }
                    .jssord07r:hover
                    {
                        background-position: -185px -35px;
                    }
                    .jssord07ldn
                    {
                        background-position: -245px -35px;
                    }
                    .jssord07rdn
                    {
                        background-position: -305px -35px;
                    }
			#divWidget{display:none}
                </style>
                <!-- Arrow Left -->
                <span u="arrowleft" class="jssord07l" style="width: 1px; height: 1px; top: 123px;
                    left: 8px;"></span>
                <!-- Arrow Right -->
                <span u="arrowright" class="jssord07r" style="width: 1px; height: 1px; top: 123px;
                    right: 8px"></span>
                <!-- Direction Navigator Skin End -->
                <!-- ThumbnailNavigator Skin Begin -->
                <div u="thumbnavigator" class="jssort04" style="position: absolute; width: 600px;
                    height: 1px; right: 0px; bottom: 0px;">
                    <!-- Thumbnail Item Skin Begin -->
                    <style>
                        /* jssor slider thumbnail navigator skin 04 css */
                        /*
                        .jssort04 .p            (normal)
                        .jssort04 .p:hover      (normal mouseover)
                        .jssort04 .pav          (active)
                        .jssort04 .pav:hover    (active mouseover)
                        .jssort04 .pdn          (mousedown)
                        */
                        .jssort04 .w, .jssort04 .pav:hover .w
                        {
                            position: absolute;
                            width: 1px;
                            height: 1px;
                            border: #000 1px solid;
                        }
                        * html .jssort04 .w
                        {
                            width: /**/ 1px;
                            height: /**/ 1px;
                        }
                        .jssort04 .pdn .w, .jssort04 .pav .w
                        {
                            border-style: solid;
                        }
                        .jssort04 .c
                        {
                            width: 1px;
                            height: 1px;
                            filter: alpha(opacity=45);
                            opacity: .45;
                            transition: opacity .6s;
                            -moz-transition: opacity .6s;
                            -webkit-transition: opacity .6s;
                            -o-transition: opacity .6s;
                        }
                        .jssort04 .p:hover .c, .jssort04 .pav .c
                        {
                            filter: alpha(opacity=0);
                            opacity: 0;
                        }
                        .jssort04 .p:hover .c
                        {
                            transition: none;
                            -moz-transition: none;
                            -webkit-transition: none;
                            -o-transition: none;
                        }
                    </style>
                    <div u="slides" style="bottom: 0px; right: 30px;">
                        <div u="prototype" class="p" style="position: absolute; width: 1px; height: 1px; top: 0; left: 0;">
                            <div class="w">
                                <thumbnailtemplate style="width: 100%; height: 100%; border: none; position: absolute; top: 0; left: 0;"></thumbnailtemplate>
                            </div>
                            <div class="c" style="position: absolute; background-color: #000; top: 0; left: 0">
                            </div>
                        </div>
                    </div>
                    <!-- Thumbnail Item Skin End -->
                </div>
                <!-- ThumbnailNavigator Skin End -->
                <a style="display: none" href="http://www.jssor.com">Responsive Slider</a>
            </div>
            <!-- Jssor Slider End -->
        </div>
    </div>

    <!-- INCLUDE footer.tpl -->
