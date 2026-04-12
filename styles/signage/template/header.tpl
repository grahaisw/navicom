<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="{S_CONTENT_DIRECTION}" lang="{S_USER_LANG}" xml:lang="{S_USER_LANG}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Language" content="{S_USER_LANG}">
<meta http-equiv="imagetoolbar" content="no">
<meta http-equiv="expires" content="0">
<meta name="viewport" content="width=device-width">
<title>{SITENAME}</title>

<script type="text/javascript" language="javascript" src="{T_JS_PATH}utils.js"></script>
<script type="text/javascript" language="javascript" src="{T_JS_PATH}jquery.js"></script>
<script src="{T_THEME_PATH}/keycode.js" type="text/javascript" language="javascript"></script>

<style type="text/css" media="screen">
    #runningText {
	position: absolute;
	top: 685px;
	background: rgba(0, 0, 0, 0.6);
	color: #fff;
	font-size: 24px;
	overflow: hidden;
    }
    
    @font-face {
	font-family: pristina;
	src: url({T_THEME_PATH}/pristina.ttf);
    }
    
    @font-face {
	font-family: myriadpro;
	src: url({T_THEME_PATH}/myriadpro.otf);
    }
</style>

<!-- IF S_DIGITALSIGNAGE -->
<!-- <script src="{T_JS_PATH}clock.js" type="text/javascript"></script> -->
<script src="{T_JS_PATH}moment.js" type="text/javascript"></script> 
<!-- <link rel="stylesheet" href="{T_THEME_PATH}/directory.css">-->
<style type="text/css" media="screen">
body {
    /*background: #000 url({T_IMAGESET_PATH}/{S_BGROUND_FILE}); */
    background: #000 url({T_IMAGESET_PATH}/dinner-regent.jpg);
    overflow: hidden;
}

#transparent {
    position: absolute;
    top: 0px;
    left: 0px;
    width: 1280px;
    height: 720px;
    z-index: -10;
    /*background: url({T_IMAGESET_PATH}/{S_TRANSPARENT_FILE});*/
    background: url({T_IMAGESET_PATH}/bg-opacity1.png);
}

#hotel-logo {
    position: absolute;
    width: 180px;
    height: 100px;
    z-index: 10;
    top: 592px;
/*    border: solid 1px #fff; */
    background: url({T_IMAGESET_PATH}/{S_LOGO_FILE});
}

#template {
    width:1280px;
    height:720px;
    top:0;
    left:0;
    position:absolute;
}

<!--#wrap { position:relative; width:100%; height:165px; background: #fff; text-align:left; overflow:hidden; padding-top:27px;}
#wrap img.time { float:left; }
#wrap #cover { position:absolute; top:0; left:0; width:680px; height:140px; background:url(fade.png) repeat-x; }
*html body #wrap #cover { width:0px; height:0px; }-->
</style>

<!-- <script src="{T_JS_PATH}jquery.js" type="text/javascript"></script> -->
<link rel="stylesheet" href="{T_THEME_PATH}/directory.css">
<!-- ENDIF -->


</head>

<body id="b1" class="ltr" {S_ONMOUSEDOWN}>
<div id="transparent"></div><div id="hotel-logo"></div>