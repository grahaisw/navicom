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
		font-size: 40px!important;
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
		<h1>Valas</h1>
		<table>
		<thead>
			<tr>
				<th>Mata Uang</th>
				<th>Jual</th>
				<th>Beli</th>
			</tr>
		</thead>
		<tbody>
			<?php if ($this->_rootref['S_VALAS']) {  $_valas_count = (isset($this->_tpldata['valas'])) ? sizeof($this->_tpldata['valas']) : 0;if ($_valas_count) {for ($_valas_i = 0; $_valas_i < $_valas_count; ++$_valas_i){$_valas_val = &$this->_tpldata['valas'][$_valas_i]; ?>

			<tr>
				<td class="tengah"><?php echo $_valas_val['NAME']; ?></td>
				<td><?php echo $_valas_val['JUAL']; ?></td>
				<td><?php echo $_valas_val['BELI']; ?></td>
			</tr>
				<?php }} } ?>

		</tbody>
	</table>
	</div>
</div>
	
<?php } $this->_tpl_include('footer.tpl'); ?>