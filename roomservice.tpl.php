<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('header.tpl'); ?>


<!-- Bground Video 
<video autoplay loop id="bgvid">
    <source src="<?php echo (isset($this->_rootref['T_BG_CLIP_PATH'])) ? $this->_rootref['T_BG_CLIP_PATH'] : ''; ?>/wonderful-indonesia-jakarta.mp4" type="video/mp4">
</video>  -->

<div id="divVideoContainer" class="divVideoContainer">
    <video id="media" class="videoControl" loop></video>
</div>
<!--
<div id="apDiv2">
    <video autoplay loop id="home"><source src="../../../../vod/wonderful-indonesia-bali.mp4" type="video/mp4"></video> 
</div>-->
    
<div id="divChannelList">
    <div id="divChannelListItems">
    </div>
</div>

<div id="divCurrentChannelNameContainer">
	<div id="divCurrentCategoryName" style="font-family: <?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>;"><?php echo ((isset($this->_rootref['L_PAGE_TITLE'])) ? $this->_rootref['L_PAGE_TITLE'] : ((isset($user->lang['PAGE_TITLE'])) ? $user->lang['PAGE_TITLE'] : '{ PAGE_TITLE }')); ?></div>
    <div id="divCurrentChannelName" style="font-family: <?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>;"></div>
</div>

<div id="pageTitle" style="font-family: <?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>;">Room Service</div>
<div id="apDiv2"></div>
<div id="apDiv3"></div>

<div id="divDescription" style="font-family: <?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>;"></div>
<div id="divPicture"></div>
<!--<div id="divGradPicture"></div>-->
<!-- -- IF S_MENU_EXIST -- -->
<!--<div id="divPrice"></div>-->
<div id="divOrder"><div id="divBlueCol"></div><?php echo ((isset($this->_rootref['L_PRESS_BLUE_BUTTON'])) ? $this->_rootref['L_PRESS_BLUE_BUTTON'] : ((isset($user->lang['PRESS_BLUE_BUTTON'])) ? $user->lang['PRESS_BLUE_BUTTON'] : '{ PRESS_BLUE_BUTTON }')); ?></div>
<!-- -- ENDIF -- -->

<div id="divControlContainer">
	<!--<div id="divOrder" onclick="media.JS_FullScreen_Function();">
		<?php echo ((isset($this->_rootref['L_CALL_TO_ORDER'])) ? $this->_rootref['L_CALL_TO_ORDER'] : ((isset($user->lang['CALL_TO_ORDER'])) ? $user->lang['CALL_TO_ORDER'] : '{ CALL_TO_ORDER }')); ?>

	</div>-->
	<a id="divBasket" class="fancybox fancybox.iframe"><?php echo ((isset($this->_rootref['L_CALL_TO_ORDER'])) ? $this->_rootref['L_CALL_TO_ORDER'] : ((isset($user->lang['CALL_TO_ORDER'])) ? $user->lang['CALL_TO_ORDER'] : '{ CALL_TO_ORDER }')); ?></a>
</div>

<input type="hidden" name="chIndex" id="chIndex" value="" />
<!--<div id="runningText"><marquee scrollamount="10" loop="" style="width:1280px;">Selamat Datang di Panghegar Hotel</marquee></div>
<div id="runningText">TES DRIVE BWAHAHAHHAHA</div> -->

<?php $this->_tpl_include('footer.tpl'); ?>