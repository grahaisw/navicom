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
    
	<script  type="text/javascript">
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
	
	<!-- ENDIF -->
	
	<!-- IF S_VIEWBILL -->
	<link rel="stylesheet" href="{T_THEME_PATH}/viewbill.css" type="text/css" />
	<!-- ENDIF -->
    
</head>
<body id="body">

    <!-- modal box -->
    <div class="modal fade" id="my-modal-box" tabindex="-1" role="dialog" aria-labelledby="my-modal-box-l" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <div class="modal-title" id="my-modal-box-l"></div>
          </div><!-- /.modal-header -->
          <div class="modal-body"></div>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4dbfb1915f17d240"></script>
          </div><!-- /.modal-body -->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

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
        <div class="collapse navbar-collapse" id="b-menu-1">
          <ul class="nav navbar-nav navbar-right">
	      <!-- BEGIN menu -->
	      <li class="active"><a href="{menu.S_MENU_URL}"><img src="{T_IMAGESET_PATH}/60x60/{menu.S_MENU_THUMBNAIL}"></a></li>
	      <!-- END menu -->
          </ul>
        </div> <!-- /.nav-collapse -->
      </div> <!-- /.container -->
    </div> <!-- /.navbar -->

    
<br/><br/><br/><br/><br/><br/>