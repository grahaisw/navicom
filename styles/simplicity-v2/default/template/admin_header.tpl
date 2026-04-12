<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="{S_CONTENT_DIRECTION}" lang="{S_USER_LANG}" xml:lang="{S_USER_LANG}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Language" content="{S_USER_LANG}">
<meta http-equiv="imagetoolbar" content="no">
<!-- IF S_IN_BUFFERS -->
<meta http-equiv="refresh" content="10">
<!-- ENDIF -->
<!-- IF S_IN_REALTIME -->
<meta http-equiv="refresh" content="20">
<!-- ENDIF -->
<!-- IF S_IN_GUEST_MESSAGE -->
<meta http-equiv="refresh" content="10">
<!-- ENDIF -->
<title>{SITENAME} &bull; <!-- IF S_IN_UCP -->{L_UCP} &bull; <!-- ENDIF -->{PAGE_TITLE}</title>

<link href="{T_THEME_PATH}/adm_navicom.css" rel="stylesheet" type="text/css" media="screen">

<script type="text/javascript" language="javascript" src="{T_DATATABLE_PATH}js/jquery.js"></script>

<!-- IF S_JQUERY_TE -->
<!-- <link type="text/css" rel="stylesheet" href="{T_JS_PATH}jquery-te-1.4.0.css"> -->
<script type="text/javascript" src="{T_JS_PATH}jquery-te-1.4.0.min.js" charset="utf-8"></script>

<!-- ENDIF -->
<!-- IF S_MUSIC-->
<link href="{T_THEME_PATH}/fileuploader.css" rel="stylesheet" type="text/css">	
<script src="{T_THEME_PATH}/fileuploader2.js" type="text/javascript"></script>
<script> 
	function createUploader(){         
		var uploader = new qq.FileUploader({
			element: document.getElementById('file-uploader-demo1'),
			action: 'upload_vod.php',
			debug: true
		});           
	}
	
	// in your app create uploader as soon as the DOM is ready
	// don't wait for the window to load  
	window.onload = createUploader;     
</script>
<!-- ENDIF -->

<!-- IF S_DATATABLE_NODES -->
<style type="text/css" title="currentStyle">
    @import "{T_DATATABLE_PATH}css/demo_page.css";
    @import "{T_DATATABLE_PATH}css/demo_table.css";
</style>
<script src="{T_THEME_PATH}/fileuploader2.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript" src="{T_DATATABLE_PATH}js/jquery.dataTables.js"></script>
<link href="{T_THEME_PATH}/fileuploader.css" rel="stylesheet" type="text/css">	

<script type="text/javascript" charset="utf-8">
    var oTable;
    
    $(document).ready(function() {
	//$('#dtable').dataTable();
	oTable = $('#dtable').dataTable( {
		"bProcessing": false,
		"bServerSide": false,
		"aoColumns": [
			null,
			null,
			<!-- IF S_THIRD_FIELD -->
			null,
			<!-- ENDIF -->
			<!-- IF S_FOURTH_FIELD -->
			null,
			<!-- ENDIF -->
			
			<!-- IF S_ADD_UPDATE -->
			{ "sClass": "center", "bSortable": false },
			<!-- ENDIF -->
			<!-- IF S_DELETE -->
			{ "sClass": "center", "bSortable": false },
			<!-- ENDIF -->
			<!-- IF S_SEVENTH_FIELD -->
			{ "sClass": "center", "bSortable": false },
			<!-- ENDIF -->
			<!-- IF S_EIGHT_FIELD -->
			{ "sClass": "center", "bSortable": false },
			<!-- ENDIF -->
			<!-- IF S_NINTH_FIELD -->
			{ "sClass": "center", "bSortable": false },
			<!-- ENDIF -->
			<!-- IF S_TENTH_FIELD -->
			{ "sClass": "center", "bSortable": false },
			<!-- ENDIF -->
			<!-- IF S_ELEVENTH_FIELD -->
			{ "sClass": "center", "bSortable": false },
			<!-- ENDIF -->
		],
		"aaSorting": [[1, 'asc']]
	} );
    } );
</script>
<!-- ENDIF -->

<!-- IF S_FACEBOX -->
<link href="{T_JS_PATH}facebox.css" media="screen" rel="stylesheet" type="text/css" />
<!-- <script src="{T_JS_PATH}jquery-1.10.2.min.js" type="text/javascript"></script> -->
<script src="{T_JS_PATH}facebox.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : '{T_JS_PATH}loading.gif',
        closeImage   : '{T_JS_PATH}closelabel.png'
      })
    })
  </script>
<!-- ENDIF -->

<!-- IF S_ADS_IMAGE_UPLOADER -->
<link href="{T_THEME_PATH}/fileuploader.css" rel="stylesheet" type="text/css">	
<script src="{T_THEME_PATH}/fileuploader.js" type="text/javascript"></script>
<script> 
	function createUploader(){            
		var type = $("#ads_type").val();
		
		var uploader = new qq.FileUploader({
			element: document.getElementById('file-uploader-demo1'),
			action: 'upload.php?type=' + type,
			debug: true
		});           
	}
	
	// in your app create uploader as soon as the DOM is ready
	// don't wait for the window to load  
	window.onload = createUploader;     
</script>  
<!-- ENDIF -->

<!-- IF S_IMAGE_UPLOADER -->
<link href="{T_THEME_PATH}/fileuploader.css" rel="stylesheet" type="text/css">	
<script src="{T_THEME_PATH}/fileuploader4.js" type="text/javascript"></script>
<script> 
	function createUploader(){            
		var type = $("#type").val();
		
		var uploader = new qq.FileUploader({
			element: document.getElementById('file-uploader-demo1'),
			action: 'upload_image.php?type=' + type,
			debug: true
		});           
	}
	
	// in your app create uploader as soon as the DOM is ready
	// don't wait for the window to load  
	window.onload = createUploader;     
</script>  
<!-- ENDIF -->

</head>

<body class="ltr">

<!--
	Navicom style name: Simplicity (default) 
	Modified by: Navicomers
-->

<div id="wrap">

    <div id="page-header">
	<h1 id="header">{SITE_DESCRIPTION}</h1>
	<p>{CURRENT_TIME}</p>
    </div>

    <div id="page-body">

	<div id="tabs">
	    <ul>
		<ul>
		    <!-- BEGIN t_block1 -->
			<li<!-- IF t_block1.S_SELECTED --> id="activetab"<!-- ENDIF -->><a href="{t_block1.U_TITLE}"><span>{t_block1.L_TITLE}</span></a></li>
		    <!-- END t_block1 -->
		</ul>

	    </ul>
	</div>
	
	<div id="acp">
	    <div class="panel">
		<span class="corners-top"><span></span></span>
		<div id="content">
 
		    <div id="toggle">
			<a id="toggle-handle" accesskey="m" title="{HIDE_DISPLAY_SIDE_MENU}" onclick="switch_menu(); return false;" href="#"></a>
		    </div>

		    <div id="menu">
			<p>{LOGIN_AS}:<br><strong>{USERNAME}</strong> [&nbsp;<a href="{U_LOGOUT}">{L_LOGOUT}</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
			<ul>
			<!-- BEGIN l_block2 -->
					<!-- IF .l_block2.l_block3 -->
					<li class="header">{l_block1.l_block2.L_TITLE}</li>
					<!-- DEFINE $LI_USED = 1 -->
					<!-- ENDIF -->
	
					<!-- BEGIN l_block3 -->
						<li<!-- IF l_block2.l_block3.S_SELECTED --> id="activemenu"<!-- ENDIF -->><a href="{l_block2.l_block3.U_TITLE}"><span>{l_block2.l_block3.L_TITLE}</span></a></li>
						<!-- DEFINE $LI_USED = 1 -->
					<!-- END l_block3 -->
				<!-- END l_block2 -->
			
			</ul>

		    </div>
