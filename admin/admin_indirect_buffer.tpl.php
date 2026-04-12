<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('admin_header.tpl'); ?>


<script type="text/javascript">
$(function() {
    $('#ProcessLink').click(function() {
	return confirm('<?php echo ((isset($this->_rootref['L_CONFIRM_PROCESS'])) ? $this->_rootref['L_CONFIRM_PROCESS'] : ((isset($user->lang['CONFIRM_PROCESS'])) ? $user->lang['CONFIRM_PROCESS'] : '{ CONFIRM_PROCESS }')); ?>');
    });
});

function PopupCenter(url, title, w, h) {
    // Fixes dual-screen position                         Most browsers      Firefox
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

    width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

    // Puts focus on the newWindow
    if (window.focus) {
        newWindow.focus();
    }
}


</script>




		    <div id="main">
			<a name="maincontent"></a>
 
			<h1><?php echo (isset($this->_rootref['MODULE_TITLE'])) ? $this->_rootref['MODULE_TITLE'] : ''; ?></h1>

			<p><?php echo (isset($this->_rootref['MODULE_DESC'])) ? $this->_rootref['MODULE_DESC'] : ''; ?></p>

			<form method="post" id="mcp" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>">
			    <div class="inner">
			    <?php if ($this->_rootref['S_ADD_UPDATE']) {  ?>

			    <!-- <a href="<?php echo (isset($this->_rootref['U_ADD'])) ? $this->_rootref['U_ADD'] : ''; ?>" rel="facebox"><?php echo ((isset($this->_rootref['L_ADD'])) ? $this->_rootref['L_ADD'] : ((isset($user->lang['ADD'])) ? $user->lang['ADD'] : '{ ADD }')); ?></a> -->
			    <?php } ?>

			    <span class="corners-top2"><span>

			<table cellspacing="1" class="table1" id="dtable">
			<thead>
			<tr>
			  <th><?php echo ((isset($this->_rootref['L_DATETIME'])) ? $this->_rootref['L_DATETIME'] : ((isset($user->lang['DATETIME'])) ? $user->lang['DATETIME'] : '{ DATETIME }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_ROOM'])) ? $this->_rootref['L_ROOM'] : ((isset($user->lang['ROOM'])) ? $user->lang['ROOM'] : '{ ROOM }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_NAME'])) ? $this->_rootref['L_NAME'] : ((isset($user->lang['NAME'])) ? $user->lang['NAME'] : '{ NAME }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_ITEM'])) ? $this->_rootref['L_ITEM'] : ((isset($user->lang['ITEM'])) ? $user->lang['ITEM'] : '{ ITEM }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_DECLINED'])) ? $this->_rootref['L_DECLINED'] : ((isset($user->lang['DECLINED'])) ? $user->lang['DECLINED'] : '{ DECLINED }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_RECEIVED'])) ? $this->_rootref['L_RECEIVED'] : ((isset($user->lang['RECEIVED'])) ? $user->lang['RECEIVED'] : '{ RECEIVED }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_APPROVED'])) ? $this->_rootref['L_APPROVED'] : ((isset($user->lang['APPROVED'])) ? $user->lang['APPROVED'] : '{ APPROVED }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_DELETE'])) ? $this->_rootref['L_DELETE'] : ((isset($user->lang['DELETE'])) ? $user->lang['DELETE'] : '{ DELETE }')); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php if ($this->_rootref['S_BUFFERS']) {  $_buffer_count = (isset($this->_tpldata['buffer'])) ? sizeof($this->_tpldata['buffer']) : 0;if ($_buffer_count) {for ($_buffer_i = 0; $_buffer_i < $_buffer_count; ++$_buffer_i){$_buffer_val = &$this->_tpldata['buffer'][$_buffer_i]; if (!($_buffer_val['S_ROW_COUNT'] & 1)  ) {  ?><tr class="bg1" valign="top"><?php } else { ?><tr  valign="top" class="bg2"><?php } ?>

			    <td><?php echo $_buffer_val['DATETIME']; ?></td>
			    <td><b><?php echo $_buffer_val['ROOM']; ?></b></td>
			    <td><?php echo $_buffer_val['RESV_ID']; ?> <br/><b><?php echo $_buffer_val['NAME']; ?></b></td>
			    <td><b><?php echo $_buffer_val['ITEM']; ?></b><p>
			    <?php echo ((isset($this->_rootref['L_DATETIME'])) ? $this->_rootref['L_DATETIME'] : ((isset($user->lang['DATETIME'])) ? $user->lang['DATETIME'] : '{ DATETIME }')); ?>: <b><?php echo $_buffer_val['TIME']; ?></b><br/>
			    <?php echo ((isset($this->_rootref['L_QTY'])) ? $this->_rootref['L_QTY'] : ((isset($user->lang['QTY'])) ? $user->lang['QTY'] : '{ QTY }')); ?>: <b><?php echo $_buffer_val['QTY']; ?></b><br/>
			    <?php echo ((isset($this->_rootref['L_CAR_TERAPHIST'])) ? $this->_rootref['L_CAR_TERAPHIST'] : ((isset($user->lang['CAR_TERAPHIST'])) ? $user->lang['CAR_TERAPHIST'] : '{ CAR_TERAPHIST }')); ?>: <b><?php echo $_buffer_val['CAR_TERAPHIST']; ?></b><br/>
			    <?php echo ((isset($this->_rootref['L_NOTE'])) ? $this->_rootref['L_NOTE'] : ((isset($user->lang['NOTE'])) ? $user->lang['NOTE'] : '{ NOTE }')); ?>: <b><?php echo $_buffer_val['NOTE']; ?></b><br/>
			    </p></td>
			    <td style="width: 5%" align="center">
				<?php if ($_buffer_val['S_NOT_RECEIVED']) {  ?>

				<a href="<?php echo $_buffer_val['U_DECLINED']; ?>" rel="facebox" id="ProcessLink"><img src="<?php echo $_buffer_val['ICON_PATH']; ?>/details_close.png" alt="<?php echo $_buffer_val['L_DECLINED']; ?>" title="<?php echo $_buffer_val['L_DECLINED']; ?>" /></a>
				<?php } else { ?>

				<?php echo $_buffer_val['DECLINED']; ?>

				<?php } ?>

			    </td>
			    <td style="width: 5%" align="center">
				<input type="hidden" name="buffer_id[]" value="<?php echo $_buffer_val['S_NID']; ?>"/>
				<?php if ($_buffer_val['S_NOT_RECEIVED']) {  ?>

				<a href="<?php echo $_buffer_val['U_RECEIVED']; ?>" rel="facebox" id="ProcessLink"><img src="<?php echo $_buffer_val['ICON_PATH']; ?>/process-accept.png" alt="<?php echo $_buffer_val['L_RECEIVED']; ?>" title="<?php echo $_buffer_val['L_RECEIVED']; ?>" /></a>
				<?php } else { ?>

				<?php echo $_buffer_val['RECEIVED']; ?>

				<?php } ?>

			    </td>
			    <?php if ($_buffer_val['S_NOT_APPROVED']) {  ?>

			    <td style="width: 5%; color:#DF0101;" align="center">
			    <?php } else { ?>

			    <td style="width: 5%; color:#04B404;" align="center">
			    <?php } ?>

				<?php echo $_buffer_val['APPROVED']; ?>

			    </td>
			    
			    <td><?php if ($this->_rootref['S_ADD_UPDATE']) {  ?>

			    
			    <a href="<?php echo $_buffer_val['U_DELETE']; ?>"><img src="<?php echo $_buffer_val['ICON_PATH']; ?>/delete.png" alt="<?php echo $_buffer_val['L_DELETE']; ?>" title="<?php echo $_buffer_val['L_DELETE']; ?>" /></a>

			    <?php } else { ?>

			    &nbsp;
			    <?php } ?></td>
			  </tr>
			<?php }} } ?>

			</tbody>
			</table>
			<hr />

			</div>
</form>
<br />
<center><img src="<?php echo (isset($this->_rootref['T_JS_PATH'])) ? $this->_rootref['T_JS_PATH'] : ''; ?>loading.gif" id="loading" style="display:none;" /></center>
		    </div>
		 </div>

		 <span class="corners-bottom"><span>
		 
		 <div class="clear">
		 <?php if ($this->_rootref['S_SOUND']) {  ?>

		 <!--
		  <audio autoplay>
		      <source src="<?php echo (isset($this->_rootref['T_MEDIA_AUDIO_PATH'])) ? $this->_rootref['T_MEDIA_AUDIO_PATH'] : ''; ?>a1.mp3" type="audio/mpeg">
		      Your browser does not support the audio element.
		  </audio>
		  -->
		 <?php } ?>

		 </div>
	    </div>
	</div>

    </div>

<?php $this->_tpl_include('overall_footer.tpl'); ?>