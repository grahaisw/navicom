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
			<?php if ($this->_rootref['S_ADD_UPDATE']) {  ?>

			    <span class="navigation"><a href="<?php echo (isset($this->_rootref['U_ADD'])) ? $this->_rootref['U_ADD'] : ''; ?>" rel="facebox"><img src="<?php echo (isset($this->_rootref['ICON_PATH'])) ? $this->_rootref['ICON_PATH'] : ''; ?>/add.png" alt="<?php echo ((isset($this->_rootref['L_ADD'])) ? $this->_rootref['L_ADD'] : ((isset($user->lang['ADD'])) ? $user->lang['ADD'] : '{ ADD }')); ?>" title="<?php echo ((isset($this->_rootref['L_ADD'])) ? $this->_rootref['L_ADD'] : ((isset($user->lang['ADD'])) ? $user->lang['ADD'] : '{ ADD }')); ?>" width="20" /><?php echo ((isset($this->_rootref['L_ADD'])) ? $this->_rootref['L_ADD'] : ((isset($user->lang['ADD'])) ? $user->lang['ADD'] : '{ ADD }')); ?></a></span>
			<?php } ?>


			<form method="post" id="mcp" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>">
			    <div class="inner">
			    <span class="corners-top2"><span>

			<table cellspacing="1" class="table1" id="dtable">
			<thead>
			<tr>
			  <th><?php echo ((isset($this->_rootref['L_NAME'])) ? $this->_rootref['L_NAME'] : ((isset($user->lang['NAME'])) ? $user->lang['NAME'] : '{ NAME }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_STYLE'])) ? $this->_rootref['L_STYLE'] : ((isset($user->lang['STYLE'])) ? $user->lang['STYLE'] : '{ STYLE }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_START'])) ? $this->_rootref['L_START'] : ((isset($user->lang['START'])) ? $user->lang['START'] : '{ START }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_END'])) ? $this->_rootref['L_END'] : ((isset($user->lang['END'])) ? $user->lang['END'] : '{ END }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_TARGET'])) ? $this->_rootref['L_TARGET'] : ((isset($user->lang['TARGET'])) ? $user->lang['TARGET'] : '{ TARGET }')); ?></th>
			  <?php if ($this->_rootref['S_ADD_UPDATE']) {  ?>

			  <th><?php echo ((isset($this->_rootref['L_ENABLED'])) ? $this->_rootref['L_ENABLED'] : ((isset($user->lang['ENABLED'])) ? $user->lang['ENABLED'] : '{ ENABLED }')); ?></th>
			  <th>&nbsp;</th>
			  <?php } if ($this->_rootref['S_DELETE']) {  ?><th>&nbsp;</th><?php } ?>

			</tr>
			</thead>
			<tbody>
			<?php if ($this->_rootref['S_SCHEDULE']) {  $_schedule_count = (isset($this->_tpldata['schedule'])) ? sizeof($this->_tpldata['schedule']) : 0;if ($_schedule_count) {for ($_schedule_i = 0; $_schedule_i < $_schedule_count; ++$_schedule_i){$_schedule_val = &$this->_tpldata['schedule'][$_schedule_i]; if (!($_schedule_val['S_ROW_COUNT'] & 1)  ) {  ?><tr class="bg1"><?php } else { ?><tr class="bg2"><?php } ?>

			    <td><?php echo $_schedule_val['NAME']; ?></td>
			    <td><?php echo $_schedule_val['STYLE']; ?></td>
			    <td><?php echo $_schedule_val['START']; ?></td>
			    <td><?php echo $_schedule_val['END']; ?></td>
			    <td><?php echo $_schedule_val['TARGET']; ?>

			    <input type="hidden" name="schedule_id[]" value="<?php echo $_schedule_val['S_NID']; ?>"/></td>
			    <?php if ($this->_rootref['S_ADD_UPDATE']) {  ?><td style="width: 5%" align="center">
			    <input type="checkbox" name="mark_<?php echo $_schedule_val['S_NID']; ?>" <?php echo $_schedule_val['V_ENABLED']; ?>/><label>&nbsp;</label></td>
			    <td style="width: 5%" align="center"><a href="<?php echo $_schedule_val['U_UPDATE']; ?>" rel="facebox"><img src="<?php echo $_schedule_val['ICON_PATH']; ?>/edit.png" alt="<?php echo $_schedule_val['L_UPDATE']; ?>" title="<?php echo $_schedule_val['L_UPDATE']; ?>" /></a></td>
			    <?php } else { ?>

			    <td><?php echo $_schedule_val['ENABLED']; ?></td>
			    <?php } if ($this->_rootref['S_DELETE']) {  ?>

			    <td style="width: 5%" align="center"><a href="<?php echo $_schedule_val['U_DELETE']; ?>" id="DeleteLink"><img src="<?php echo $_schedule_val['ICON_PATH']; ?>/delete.png" alt="<?php echo $_schedule_val['L_DELETE']; ?>" title="<?php echo $_schedule_val['L_DELETE']; ?>" /></a></td>
			    <?php } ?>

			  </tr>
			<?php }} } ?>

			</tbody>
			</table>
			<?php if ($this->_rootref['S_ADD_UPDATE']) {  ?>

			<fieldset class="display-options">
			    <input class="button2" type="submit" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" name="submit" />
			    <?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?>

			</fieldset>
			<?php } ?>

			<hr />

			</div>
</form>
<br />
		    </div>
		 </div>

		 <span class="corners-bottom"><span>
		 
		 <div class="clear"></div>
	    </div>
	</div>

    </div>

<?php $this->_tpl_include('overall_footer.tpl'); ?>