<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('header.tpl'); ?>


<!-- Bground Video 
<video autoplay loop id="bgvid">
    <source src="<?php echo (isset($this->_rootref['T_BG_CLIP_PATH'])) ? $this->_rootref['T_BG_CLIP_PATH'] : ''; ?>/wonderful-indonesia-jakarta.mp4" type="video/mp4">
</video>  -->
<div id="pageTitle"><?php echo ((isset($this->_rootref['L_PAGE_TITLE'])) ? $this->_rootref['L_PAGE_TITLE'] : ((isset($user->lang['PAGE_TITLE'])) ? $user->lang['PAGE_TITLE'] : '{ PAGE_TITLE }')); ?></div>
<div id="apDiv2"></div>
<div id="apDiv3"></div>

<div id="mainDiv">
    <div id="divSafeContainer">
	<div id="divChannelList">
	    <div id="divChannelListHeader">
		<div id="divFieldHeader">
		    <span class="spanChannlHeader"><?php echo ((isset($this->_rootref['L_DATE'])) ? $this->_rootref['L_DATE'] : ((isset($user->lang['DATE'])) ? $user->lang['DATE'] : '{ DATE }')); ?></span>
		    <span class="spanChannlHeader2"><?php echo ((isset($this->_rootref['L_ITEM'])) ? $this->_rootref['L_ITEM'] : ((isset($user->lang['ITEM'])) ? $user->lang['ITEM'] : '{ ITEM }')); ?></span>
		    <span class="spanChannlHeader3"><?php echo ((isset($this->_rootref['L_QTY'])) ? $this->_rootref['L_QTY'] : ((isset($user->lang['QTY'])) ? $user->lang['QTY'] : '{ QTY }')); ?></span>
		    <span class="spanChannlHeader4"><?php echo ((isset($this->_rootref['L_NOTE'])) ? $this->_rootref['L_NOTE'] : ((isset($user->lang['NOTE'])) ? $user->lang['NOTE'] : '{ NOTE }')); ?></span>
		</div>
<!--		<div id="divFieldFooter">
		    <span class="spanChannlFooter2"><?php echo ((isset($this->_rootref['L_TOTAL_AMOUNT'])) ? $this->_rootref['L_TOTAL_AMOUNT'] : ((isset($user->lang['TOTAL_AMOUNT'])) ? $user->lang['TOTAL_AMOUNT'] : '{ TOTAL_AMOUNT }')); ?></span>
		    <span class="spanChannlFooter3"><?php echo (isset($this->_rootref['S_TOTAL_AMOUNT'])) ? $this->_rootref['S_TOTAL_AMOUNT'] : ''; ?></span></div> -->
		<div id="divChannelCount">0/0</div>
	    </div>
	    <div id="divChannelListItems"></div>
	    <div id="divChannelListScrollBar" style="position:relative;left:1185px">
		<div id="DV_Scrolluparrow" onclick="media._object.Fn_Up_KeyDownHandler();"></div>
		<div id="DV_Scrollprogress" onclick="media._object.Fn_Click_ScrollBar();">
		    <div id="DV_Scrollshaft"></div>
		</div>
		<div id="DV_Scrolldownarrow" onclick="media._object.Fn_Down_KeyDownHandler();"></div>
	    </div>
	</div>
	<div id="divVideoContainer" class="divVideoContainer" style="position:relative;left:1980px">
	    <video id="media" class="videoControl"></video>
	</div>
    </div>
</div>

<input type="hidden" name="chIndex" id="chIndex" value="" />
<?php $this->_tpl_include('footer.tpl'); ?>