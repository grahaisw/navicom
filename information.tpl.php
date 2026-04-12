<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('header.tpl'); ?>

<style type="text/css">
	table{
		color: #f4f4f4;
		font-size: 25px;
		width: 100%;
	}
	table th{
		text-align: center;
		background: #806200;
	}
	table td{
		text-align: right;
		background: #161616;
		padding: 3px 10px;
	}
	h1,h2,h3,h4,p{
		padding: 0;
		margin: 0;
	}
	h1{
		font-size: 500px!important;
		
	}
	h2{
		font-size: 25px;
		color: #f00;
		padding-bottom: 10px;

	}
	h3{
		font-size: 20px;
		color: #f4f4f4;
		text-decoration: underline;
	}
	#container{
		width: 90%;
		margin: auto;
		/*background: #f00;*/
	}
	#bingkai{
		padding: 20px;
	}
	.tengah{
		text-align: center!important;
	}
	#kiri{
		float: left;
		margin-right: 50px;
		padding-top: 100px;
	}
	#kotak{

	}
</style>
<div class="title"><!--<h1 style="font-family: <?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>;"><?php echo ((isset($this->_rootref['L_TITLE'])) ? $this->_rootref['L_TITLE'] : ((isset($user->lang['TITLE'])) ? $user->lang['TITLE'] : '{ TITLE }')); ?><h1>--></div>
<!--<div id="divLogo"></div>-->
<?php if ($this->_rootref['S_HOTSPOT']) {  ?>

<!-- <div id="hotspot"><p style="text-align:center;"> <?php echo ((isset($this->_rootref['L_HOTSPOT_INFO'])) ? $this->_rootref['L_HOTSPOT_INFO'] : ((isset($user->lang['HOTSPOT_INFO'])) ? $user->lang['HOTSPOT_INFO'] : '{ HOTSPOT_INFO }')); ?></p> -->
        <!-- <div style="width:79px;display:inline-block;"><?php echo ((isset($this->_rootref['L_HOTSPOT_USER'])) ? $this->_rootref['L_HOTSPOT_USER'] : ((isset($user->lang['HOTSPOT_USER'])) ? $user->lang['HOTSPOT_USER'] : '{ HOTSPOT_USER }')); ?></div><div style="display:inline-block;">: <?php echo (isset($this->_rootref['S_HOTSPOT_USER'])) ? $this->_rootref['S_HOTSPOT_USER'] : ''; ?></div><br> -->
        <!-- <div style="width:79px;display:inline-block;"><?php echo ((isset($this->_rootref['L_HOTSPOT_PWD'])) ? $this->_rootref['L_HOTSPOT_PWD'] : ((isset($user->lang['HOTSPOT_PWD'])) ? $user->lang['HOTSPOT_PWD'] : '{ HOTSPOT_PWD }')); ?></div><div style="display:inline-block;">: <?php echo (isset($this->_rootref['S_HOTSPOT_PWD'])) ? $this->_rootref['S_HOTSPOT_PWD'] : ''; ?></div> -->
<!-- </div> -->


<div id="container">
	<div id="bingkai">
		<div id="kiri">
		<h1><i class="fa fa-phone-square" aria-hidden="true"></i></h1>
		</div>
		<div id="kiri"><br><br><br><br><br>
		<?php if ($this->_rootref['S_INFO']) {  $_info_count = (isset($this->_tpldata['info'])) ? sizeof($this->_tpldata['info']) : 0;if ($_info_count) {for ($_info_i = 0; $_info_i < $_info_count; ++$_info_i){$_info_val = &$this->_tpldata['info'][$_info_i]; ?>

		<div id="kotak">
			<h3><?php echo $_info_val['NAME']; ?></h3>
		<h2><?php echo $_info_val['NOMOR']; ?></h2>
		</div>
		<?php }} } ?>

		</div>
	</div>
</div>
	
<?php } $this->_tpl_include('footer.tpl'); ?>