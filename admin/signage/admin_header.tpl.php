<?php if (!defined('IN_TONJAW')) exit; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo (isset($this->_rootref['S_CONTENT_DIRECTION'])) ? $this->_rootref['S_CONTENT_DIRECTION'] : ''; ?>" lang="<?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>" xml:lang="<?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Language" content="<?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>">
<meta http-equiv="imagetoolbar" content="no">
<?php if ($this->_rootref['S_IN_BUFFERS']) {  ?>

<meta http-equiv="refresh" content="10">
<?php } if ($this->_rootref['S_IN_REALTIME']) {  ?>

<meta http-equiv="refresh" content="20">
<?php } if ($this->_rootref['S_IN_GUEST_MESSAGE']) {  ?>

<meta http-equiv="refresh" content="10">
<?php } ?>

<title><?php echo (isset($this->_rootref['SITENAME'])) ? $this->_rootref['SITENAME'] : ''; ?> &bull; <?php if ($this->_rootref['S_IN_UCP']) {  echo ((isset($this->_rootref['L_UCP'])) ? $this->_rootref['L_UCP'] : ((isset($user->lang['UCP'])) ? $user->lang['UCP'] : '{ UCP }')); ?> &bull; <?php } echo (isset($this->_rootref['PAGE_TITLE'])) ? $this->_rootref['PAGE_TITLE'] : ''; ?></title>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/adm_navicom.css" rel="stylesheet" type="text/css" media="screen">

<script type="text/javascript" language="javascript" src="<?php echo (isset($this->_rootref['T_DATATABLE_PATH'])) ? $this->_rootref['T_DATATABLE_PATH'] : ''; ?>js/jquery.js"></script>

<?php if ($this->_rootref['S_JQUERY_TE']) {  ?>

<!-- <link type="text/css" rel="stylesheet" href="<?php echo (isset($this->_rootref['T_JS_PATH'])) ? $this->_rootref['T_JS_PATH'] : ''; ?>jquery-te-1.4.0.css"> -->
<script type="text/javascript" src="<?php echo (isset($this->_rootref['T_JS_PATH'])) ? $this->_rootref['T_JS_PATH'] : ''; ?>jquery-te-1.4.0.min.js" charset="utf-8"></script>

<?php } if ($this->_rootref['S_MUSIC']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/fileuploader.css" rel="stylesheet" type="text/css">	
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/fileuploader2.js" type="text/javascript"></script>
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
<?php } if ($this->_rootref['S_DATATABLE_NODES']) {  ?>

<style type="text/css" title="currentStyle">
    @import "<?php echo (isset($this->_rootref['T_DATATABLE_PATH'])) ? $this->_rootref['T_DATATABLE_PATH'] : ''; ?>css/demo_page.css";
    @import "<?php echo (isset($this->_rootref['T_DATATABLE_PATH'])) ? $this->_rootref['T_DATATABLE_PATH'] : ''; ?>css/demo_table.css";
</style>
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/fileuploader2.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript" src="<?php echo (isset($this->_rootref['T_DATATABLE_PATH'])) ? $this->_rootref['T_DATATABLE_PATH'] : ''; ?>js/jquery.dataTables.js"></script>
<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/fileuploader.css" rel="stylesheet" type="text/css">	

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
			<?php if ($this->_rootref['S_THIRD_FIELD']) {  ?>

			null,
			<?php } if ($this->_rootref['S_FOURTH_FIELD']) {  ?>

			null,
			<?php } if ($this->_rootref['S_ADD_UPDATE']) {  ?>

			{ "sClass": "center", "bSortable": false },
			<?php } if ($this->_rootref['S_DELETE']) {  ?>

			{ "sClass": "center", "bSortable": false },
			<?php } if ($this->_rootref['S_SEVENTH_FIELD']) {  ?>

			{ "sClass": "center", "bSortable": false },
			<?php } if ($this->_rootref['S_EIGHT_FIELD']) {  ?>

			{ "sClass": "center", "bSortable": false },
			<?php } if ($this->_rootref['S_NINTH_FIELD']) {  ?>

			{ "sClass": "center", "bSortable": false },
			<?php } if ($this->_rootref['S_TENTH_FIELD']) {  ?>

			{ "sClass": "center", "bSortable": false },
			<?php } if ($this->_rootref['S_ELEVENTH_FIELD']) {  ?>

			{ "sClass": "center", "bSortable": false },
			<?php } ?>

		],
		"aaSorting": [[1, 'asc']]
	} );
    } );
</script>
<?php } if ($this->_rootref['S_FACEBOX']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_JS_PATH'])) ? $this->_rootref['T_JS_PATH'] : ''; ?>facebox.css" media="screen" rel="stylesheet" type="text/css" />
<!-- <script src="<?php echo (isset($this->_rootref['T_JS_PATH'])) ? $this->_rootref['T_JS_PATH'] : ''; ?>jquery-1.10.2.min.js" type="text/javascript"></script> -->
<script src="<?php echo (isset($this->_rootref['T_JS_PATH'])) ? $this->_rootref['T_JS_PATH'] : ''; ?>facebox.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : '<?php echo (isset($this->_rootref['T_JS_PATH'])) ? $this->_rootref['T_JS_PATH'] : ''; ?>loading.gif',
        closeImage   : '<?php echo (isset($this->_rootref['T_JS_PATH'])) ? $this->_rootref['T_JS_PATH'] : ''; ?>closelabel.png'
      })
    })
  </script>
<?php } if ($this->_rootref['S_ADS_IMAGE_UPLOADER']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/fileuploader.css" rel="stylesheet" type="text/css">	
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/fileuploader.js" type="text/javascript"></script>
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
<?php } if ($this->_rootref['S_IMAGE_UPLOADER']) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/fileuploader.css" rel="stylesheet" type="text/css">	
<script src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/fileuploader4.js" type="text/javascript"></script>
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
<?php } ?>


</head>

<body class="ltr">

<!--
	Navicom style name: Simplicity (default) 
	Modified by: Navicomers
-->

<div id="wrap">

    <div id="page-header">
	<h1 id="header"><?php echo (isset($this->_rootref['SITE_DESCRIPTION'])) ? $this->_rootref['SITE_DESCRIPTION'] : ''; ?></h1>
	<p><?php echo (isset($this->_rootref['CURRENT_TIME'])) ? $this->_rootref['CURRENT_TIME'] : ''; ?></p>
    </div>

    <div id="page-body">

	<div id="tabs">
	    <ul>
		<ul>
		    <?php $_t_block1_count = (isset($this->_tpldata['t_block1'])) ? sizeof($this->_tpldata['t_block1']) : 0;if ($_t_block1_count) {for ($_t_block1_i = 0; $_t_block1_i < $_t_block1_count; ++$_t_block1_i){$_t_block1_val = &$this->_tpldata['t_block1'][$_t_block1_i]; ?>

			<li<?php if ($_t_block1_val['S_SELECTED']) {  ?> id="activetab"<?php } ?>><a href="<?php echo $_t_block1_val['U_TITLE']; ?>"><span><?php echo $_t_block1_val['L_TITLE']; ?></span></a></li>
		    <?php }} ?>

		</ul>

	    </ul>
	</div>
	
	<div id="acp">
	    <div class="panel">
		<span class="corners-top"><span></span></span>
		<div id="content">
 
		    <div id="toggle">
			<a id="toggle-handle" accesskey="m" title="<?php echo (isset($this->_rootref['HIDE_DISPLAY_SIDE_MENU'])) ? $this->_rootref['HIDE_DISPLAY_SIDE_MENU'] : ''; ?>" onclick="switch_menu(); return false;" href="#"></a>
		    </div>

		    <div id="menu">
			<p><?php echo (isset($this->_rootref['LOGIN_AS'])) ? $this->_rootref['LOGIN_AS'] : ''; ?>:<br><strong><?php echo (isset($this->_rootref['USERNAME'])) ? $this->_rootref['USERNAME'] : ''; ?></strong> [&nbsp;<a href="<?php echo (isset($this->_rootref['U_LOGOUT'])) ? $this->_rootref['U_LOGOUT'] : ''; ?>"><?php echo ((isset($this->_rootref['L_LOGOUT'])) ? $this->_rootref['L_LOGOUT'] : ((isset($user->lang['LOGOUT'])) ? $user->lang['LOGOUT'] : '{ LOGOUT }')); ?></a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
			<ul>
			<?php $_l_block2_count = (isset($this->_tpldata['l_block2'])) ? sizeof($this->_tpldata['l_block2']) : 0;if ($_l_block2_count) {for ($_l_block2_i = 0; $_l_block2_i < $_l_block2_count; ++$_l_block2_i){$_l_block2_val = &$this->_tpldata['l_block2'][$_l_block2_i]; if (sizeof($_l_block2_val['l_block3'])) {  ?>

					<li class="header"><?php echo $_l_block2_val['L_TITLE']; ?></li>
					<?php $this->_tpldata['DEFINE']['.']['LI_USED'] = 1; } $_l_block3_count = (isset($_l_block2_val['l_block3'])) ? sizeof($_l_block2_val['l_block3']) : 0;if ($_l_block3_count) {for ($_l_block3_i = 0; $_l_block3_i < $_l_block3_count; ++$_l_block3_i){$_l_block3_val = &$_l_block2_val['l_block3'][$_l_block3_i]; ?>

						<li<?php if ($_l_block3_val['S_SELECTED']) {  ?> id="activemenu"<?php } ?>><a href="<?php echo $_l_block3_val['U_TITLE']; ?>"><span><?php echo $_l_block3_val['L_TITLE']; ?></span></a></li>
						<?php $this->_tpldata['DEFINE']['.']['LI_USED'] = 1; }} }} ?>

			
			</ul>

		    </div>