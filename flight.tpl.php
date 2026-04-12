<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('header.tpl'); ?>

<div id="pageTitle"><?php echo ((isset($this->_rootref['L_SUBTITLE'])) ? $this->_rootref['L_SUBTITLE'] : ((isset($user->lang['SUBTITLE'])) ? $user->lang['SUBTITLE'] : '{ SUBTITLE }')); ?></div>
<div id="apDiv2"></div>
<div id="apDiv3"></div>
<div id="AirportTitle"><?php echo ((isset($this->_rootref['L_PAGE_TITLE'])) ? $this->_rootref['L_PAGE_TITLE'] : ((isset($user->lang['PAGE_TITLE'])) ? $user->lang['PAGE_TITLE'] : '{ PAGE_TITLE }')); ?></div>

<?php if ($this->_rootref['S_FIDS']) {  ?>
<div id="divLastupdate" name="Graha"><?php echo ((isset($this->_rootref['L_LASTUPDATE'])) ? $this->_rootref['L_LASTUPDATE'] : ((isset($user->lang['LASTUPDATE'])) ? $user->lang['LASTUPDATE'] : '{ LASTUPDATE }')); ?>: <?php echo (isset($this->_rootref['S_LASTUPDATE'])) ? $this->_rootref['S_LASTUPDATE'] : ''; ?>, <?php echo (isset($this->_rootref['S_SOURCE'])) ? $this->_rootref['S_SOURCE'] : ''; ?></div>
<div id="mainDiv">
    <div id="divSafeContainer">
	<div id="divChannelList">
	    <div id="divChannelListHeader">
		<div id="divFieldHeader">
		    <span class="spanChannlHeader"><?php echo ((isset($this->_rootref['L_AIRLINE'])) ? $this->_rootref['L_AIRLINE'] : ((isset($user->lang['AIRLINE'])) ? $user->lang['AIRLINE'] : '{ AIRLINE }')); ?> TEST</span>
		    <span class="spanChannlHeader2"><?php echo ((isset($this->_rootref['L_FLIGHT'])) ? $this->_rootref['L_FLIGHT'] : ((isset($user->lang['FLIGHT'])) ? $user->lang['FLIGHT'] : '{ FLIGHT }')); ?></span>
		    <span class="spanChannlHeader3"><?php echo ((isset($this->_rootref['L_ORIGIN_DESTINATION'])) ? $this->_rootref['L_ORIGIN_DESTINATION'] : ((isset($user->lang['ORIGIN_DESTINATION'])) ? $user->lang['ORIGIN_DESTINATION'] : '{ ORIGIN_DESTINATION }')); ?></span> 
		    <span class="spanChannlHeader4"><?php echo ((isset($this->_rootref['L_SCHEDULE'])) ? $this->_rootref['L_SCHEDULE'] : ((isset($user->lang['SCHEDULE'])) ? $user->lang['SCHEDULE'] : '{ SCHEDULE }')); ?></span> 
		    <span class="spanChannlHeader5"><?php echo ((isset($this->_rootref['L_GATE'])) ? $this->_rootref['L_GATE'] : ((isset($user->lang['GATE'])) ? $user->lang['GATE'] : '{ GATE }')); ?></span> 
		    <span class="spanChannlHeader6"><?php echo ((isset($this->_rootref['L_REMARK'])) ? $this->_rootref['L_REMARK'] : ((isset($user->lang['REMARK'])) ? $user->lang['REMARK'] : '{ REMARK }')); ?></span> 
		</div>
	    </div>
	    <div id="divChannelListItems">
	        <span class="spanChannlHeader"><?php echo ((isset($this->_rootref['L_AIRLINE'])) ? $this->_rootref['L_AIRLINE'] : ((isset($user->lang['AIRLINE'])) ? $user->lang['AIRLINE'] : '{ AIRLINE }')); ?> TEST</span>
            <span class="spanChannlHeader2"><?php echo ((isset($this->_rootref['L_FLIGHT'])) ? $this->_rootref['L_FLIGHT'] : ((isset($user->lang['FLIGHT'])) ? $user->lang['FLIGHT'] : '{ FLIGHT }')); ?></span>
            <span class="spanChannlHeader3"><?php echo ((isset($this->_rootref['L_ORIGIN_DESTINATION'])) ? $this->_rootref['L_ORIGIN_DESTINATION'] : ((isset($user->lang['ORIGIN_DESTINATION'])) ? $user->lang['ORIGIN_DESTINATION'] : '{ ORIGIN_DESTINATION }')); ?></span>
            <span class="spanChannlHeader4"><?php echo ((isset($this->_rootref['L_SCHEDULE'])) ? $this->_rootref['L_SCHEDULE'] : ((isset($user->lang['SCHEDULE'])) ? $user->lang['SCHEDULE'] : '{ SCHEDULE }')); ?></span>
            <span class="spanChannlHeader5"><?php echo ((isset($this->_rootref['L_GATE'])) ? $this->_rootref['L_GATE'] : ((isset($user->lang['GATE'])) ? $user->lang['GATE'] : '{ GATE }')); ?></span> 
            <span class="spanChannlHeader6"><?php echo ((isset($this->_rootref['L_REMARK'])) ? $this->_rootref['L_REMARK'] : ((isset($user->lang['REMARK'])) ? $user->lang['REMARK'] : '{ REMARK }')); ?></span>
	    </div>
	    <div id="divChannelListScrollBar" style="position:relative;left:1060px">
		<div id="DV_Scrolluparrow" onclick="media._object.Fn_Up_KeyDownHandler();"></div>
		<div id="DV_Scrollprogress" onclick="media._object.Fn_Click_ScrollBar();">
		    <div id="DV_Scrollshaft"></div>
		</div>
		<div id="DV_Scrolldownarrow" onclick="media._object.Fn_Down_KeyDownHandler();"></div>
	    </div>
	</div>
	<div id="divVideoContainer" class="divVideoContainer" style="position:relative;left:1980px">
	    <video id="media" class="videoControl" loop></video>
	</div>
	
    </div>
</div>
<div id="flight"><a id="change" name="change" href="<?php echo (isset($this->_rootref['S_URL'])) ? $this->_rootref['S_URL'] : ''; ?>"><?php echo ((isset($this->_rootref['L_TOGGLE'])) ? $this->_rootref['L_TOGGLE'] : ((isset($user->lang['TOGGLE'])) ? $user->lang['TOGGLE'] : '{ TOGGLE }')); ?></a></div>
<?php } ?>
<div id="divVideoContainer" class="divVideoContainer">
    <audio id="media" class="videoControl" loop autoplay src="<?php echo (isset($this->_rootref['S_MB'])) ? $this->_rootref['S_MB'] : ''; ?>"></audio>
</div>
<?php if ($this->_rootref['S_SELECT']) {  ?>
<div id="mainDiv">
    <div id="divSafeContainer1">
	<?php $_airport_count = (isset($this->_tpldata['airport'])) ? sizeof($this->_tpldata['airport']) : 0;if ($_airport_count) {for ($_airport_i = 0; $_airport_i < $_airport_count; ++$_airport_i){$_airport_val = &$this->_tpldata['airport'][$_airport_i]; ?>
	<div class="flight1"><a id="change" href="<?php echo $_airport_val['S_URL']; ?>"><?php echo $_airport_val['S_AIRPORT_CODE']; ?> <?php echo $_airport_val['S_AIRPORT_NAME']; ?></a> </div><br/>
	<?php }} ?>
    </div>
</div>
<?php } $this->_tpl_include('footer.tpl'); ?>