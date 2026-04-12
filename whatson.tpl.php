<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('header.tpl'); ?><!-- Bground Video --><?php if ($this->_rootref['S_BGROUND_CLIP']) {  ?>

<video autoplay loop id="bgvid1">
    <source src="<?php echo (isset($this->_rootref['T_BG_CLIP_PATH'])) ? $this->_rootref['T_BG_CLIP_PATH'] : ''; ?>" type="video/mp4">
</video> 
<?php } ?>



<!--
<div id="divWidget" align="right">
	<div id="divWeather">
		<div style="text-align:right;font-size:16px;color:#fff;"><span style="font-size:20px;"><?php echo (isset($this->_rootref['S_WIDGET_CITY'])) ? $this->_rootref['S_WIDGET_CITY'] : ''; ?></span><br/>Bali, Indonesia</div>
		<img src="<?php echo (isset($this->_rootref['T_MEDIA_IMAGES_PATH'])) ? $this->_rootref['T_MEDIA_IMAGES_PATH'] : ''; ?>weathers/256x256/<?php echo (isset($this->_rootref['S_WIDGET_ICON'])) ? $this->_rootref['S_WIDGET_ICON'] : ''; ?>.png" width="70" style="margin:-55px 0 0 3px; float:left" />
	</div>
	<div id="divDate"><?php echo (isset($this->_rootref['S_WIDGET_DATE'])) ? $this->_rootref['S_WIDGET_DATE'] : ''; ?></div><br/>
	<div style="float:right;margin:13px 10px 0 0;font-size:20px;color:#fff;"><?php echo (isset($this->_rootref['S_WIDGET_TEMP'])) ? $this->_rootref['S_WIDGET_TEMP'] : ''; ?>°C</div>
	<div id="divClock"></div>
	<input type="hidden" id="divCurrentTime" value="<?php echo (isset($this->_rootref['S_CURRENT_TIME'])) ? $this->_rootref['S_CURRENT_TIME'] : ''; ?>" />
</div>
-->
<?php if ($this->_rootref['S_HOTSPOT']) {  ?>

<!--<div id="hotspot"><p style="text-align:left;margin:0;"> <?php echo ((isset($this->_rootref['L_HOTSPOT_INFO'])) ? $this->_rootref['L_HOTSPOT_INFO'] : ((isset($user->lang['HOTSPOT_INFO'])) ? $user->lang['HOTSPOT_INFO'] : '{ HOTSPOT_INFO }')); ?></p>
	<div style="width:79px;display:inline-block;"><?php echo ((isset($this->_rootref['L_HOTSPOT_USER'])) ? $this->_rootref['L_HOTSPOT_USER'] : ((isset($user->lang['HOTSPOT_USER'])) ? $user->lang['HOTSPOT_USER'] : '{ HOTSPOT_USER }')); ?></div><div style="display:inline-block;">: <?php echo (isset($this->_rootref['S_HOTSPOT_USER'])) ? $this->_rootref['S_HOTSPOT_USER'] : ''; ?></div><br>
	<div style="width:79px;display:inline-block;"><?php echo ((isset($this->_rootref['L_HOTSPOT_PWD'])) ? $this->_rootref['L_HOTSPOT_PWD'] : ((isset($user->lang['HOTSPOT_PWD'])) ? $user->lang['HOTSPOT_PWD'] : '{ HOTSPOT_PWD }')); ?></div><div style="display:inline-block;">: <?php echo (isset($this->_rootref['S_HOTSPOT_PWD'])) ? $this->_rootref['S_HOTSPOT_PWD'] : ''; ?></div>
</div>-->
<?php } ?>

<!--
<div id="posterLayer1" style="font-family: <?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>;"><?php echo ((isset($this->_rootref['L_NOTICE'])) ? $this->_rootref['L_NOTICE'] : ((isset($user->lang['NOTICE'])) ? $user->lang['NOTICE'] : '{ NOTICE }')); ?></div>
-->
<!-- <div id=posterLayer></div> -->

<?php $this->_tpl_include('footer.tpl'); ?>