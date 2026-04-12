<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('admin_header.tpl'); ?>

<script type="text/javascript">
$(function() {
    $('#DeleteLink').click(function() {
        return confirm('<?php echo ((isset($this->_rootref['L_CONFIRM_DELETE'])) ? $this->_rootref['L_CONFIRM_DELETE'] : ((isset($user->lang['CONFIRM_DELETE'])) ? $user->lang['CONFIRM_DELETE'] : '{ CONFIRM_DELETE }')); ?>');
    });
});

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
			  <th width="20%"><?php echo ((isset($this->_rootref['L_DATETIME'])) ? $this->_rootref['L_DATETIME'] : ((isset($user->lang['DATETIME'])) ? $user->lang['DATETIME'] : '{ DATETIME }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_ROOM'])) ? $this->_rootref['L_ROOM'] : ((isset($user->lang['ROOM'])) ? $user->lang['ROOM'] : '{ ROOM }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_SUBJECT'])) ? $this->_rootref['L_SUBJECT'] : ((isset($user->lang['SUBJECT'])) ? $user->lang['SUBJECT'] : '{ SUBJECT }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_CONTENT'])) ? $this->_rootref['L_CONTENT'] : ((isset($user->lang['CONTENT'])) ? $user->lang['CONTENT'] : '{ CONTENT }')); ?></th>
			  <th>&nbsp;</th>
			  <?php if ($this->_rootref['S_DELETE']) {  ?><th>&nbsp;</th><?php } ?>

			</tr>
			</thead>
			<tbody>
			<?php if ($this->_rootref['S_GUEST_MESSAGE']) {  $_message_count = (isset($this->_tpldata['message'])) ? sizeof($this->_tpldata['message']) : 0;if ($_message_count) {for ($_message_i = 0; $_message_i < $_message_count; ++$_message_i){$_message_val = &$this->_tpldata['message'][$_message_i]; if (!($_message_val['S_ROW_COUNT'] & 1)  ) {  ?><tr class="bg1"><?php } else { ?><tr class="bg2"><?php } ?>

			    <td><?php echo $_message_val['DATETIME']; ?></td>
			    <td><?php echo $_message_val['ROOM']; ?></td>
			    <td><?php echo $_message_val['SUBJECT']; ?></td>
			    <td><?php echo $_message_val['CONTENT']; ?></td>
			    
			    <?php if ($_message_val['S_NOT_READ']) {  ?>

			    <td style="width: 5%" align="center">
				<a href="<?php echo $_message_val['U_READ']; ?>" rel="facebox" id="ProcessLink"><img src="<?php echo $_message_val['ICON_PATH']; ?>/process-accept.png" alt="<?php echo $_message_val['L_READ']; ?>" title="<?php echo $_message_val['L_READ']; ?>" /></a></td>
			    <?php } else { ?>

			    <td><?php echo $_message_val['READ']; ?></td>
			    <?php } if ($this->_rootref['S_DELETE']) {  ?>

			    <td style="width: 5%" align="center">
				<a href="<?php echo $_message_val['U_DELETE']; ?>" id="DeleteLink"><img src="<?php echo $_message_val['ICON_PATH']; ?>/delete.png" alt="<?php echo $_messagee_val['L_DELETE']; ?>" title="<?php echo $_message_val['L_DELETE']; ?>" /></a>
			    <input type="hidden" name="message_id[]" value="<?php echo $_message_val['S_MID']; ?>"/></td>
			    <?php } ?>

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

		  <audio autoplay>
		      <source src="<?php echo (isset($this->_rootref['T_MEDIA_AUDIO_PATH'])) ? $this->_rootref['T_MEDIA_AUDIO_PATH'] : ''; ?>a1.mp3" type="audio/mpeg">
		      Your browser does not support the audio element.
		  </audio> 
		 <?php } ?>

		 </div>
	    </div>
	</div>

    </div>

<?php $this->_tpl_include('overall_footer.tpl'); ?>