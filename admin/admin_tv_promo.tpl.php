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
			  <th><?php echo ((isset($this->_rootref['L_TITLE'])) ? $this->_rootref['L_TITLE'] : ((isset($user->lang['TITLE'])) ? $user->lang['TITLE'] : '{ TITLE }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_DESCRIPTION'])) ? $this->_rootref['L_DESCRIPTION'] : ((isset($user->lang['DESCRIPTION'])) ? $user->lang['DESCRIPTION'] : '{ DESCRIPTION }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_THUMBNAIL'])) ? $this->_rootref['L_THUMBNAIL'] : ((isset($user->lang['THUMBNAIL'])) ? $user->lang['THUMBNAIL'] : '{ THUMBNAIL }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_START'])) ? $this->_rootref['L_START'] : ((isset($user->lang['START'])) ? $user->lang['START'] : '{ START }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_END'])) ? $this->_rootref['L_END'] : ((isset($user->lang['END'])) ? $user->lang['END'] : '{ END }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_DEFAULT'])) ? $this->_rootref['L_DEFAULT'] : ((isset($user->lang['DEFAULT'])) ? $user->lang['DEFAULT'] : '{ DEFAULT }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_ENABLED'])) ? $this->_rootref['L_ENABLED'] : ((isset($user->lang['ENABLED'])) ? $user->lang['ENABLED'] : '{ ENABLED }')); ?></th>
			  <?php if ($this->_rootref['S_ADD_UPDATE']) {  ?><th>&nbsp;</th><?php } if ($this->_rootref['S_DELETE']) {  ?><th>&nbsp;</th><?php } ?>
			</tr>
			</thead>
			<tbody>
			<?php if ($this->_rootref['S_TVS']) {  $_tv_count = (isset($this->_tpldata['tv'])) ? sizeof($this->_tpldata['tv']) : 0;if ($_tv_count) {for ($_tv_i = 0; $_tv_i < $_tv_count; ++$_tv_i){$_tv_val = &$this->_tpldata['tv'][$_tv_i]; if (!($_tv_val['S_ROW_COUNT'] & 1)  ) {  ?><tr class="bg1"><?php } else { ?><tr class="bg2"><?php } ?>
			    <td><strong><a href="<?php echo $_tv_val['U_NAME']; ?>"><?php echo $_tv_val['TITLE']; ?></a></strong></td>
			    <td><?php echo $_tv_val['DESCRIPTION']; ?><input type="hidden" name="promo_id[]" value="<?php echo $_tv_val['S_TID']; ?>"/></td>
				<td><a href="<?php echo $_tv_val['U_TITLE']; ?>"><img src="<?php echo $_tv_val['THUMBNAIL']; ?>" alt="<?php echo $_tv_val['TITLE']; ?>" height="60"></a></td>
			    <td><?php echo $_tv_val['START']; ?></td>
				<td><?php echo $_tv_val['END']; ?></td>
			    <?php if ($this->_rootref['S_ADD_UPDATE']) {  ?><td style="width: 5%" align="center">
			    <input type="checkbox" name="def_<?php echo $_tv_val['S_TID']; ?>" <?php echo $_tv_val['V_DEFAULT']; ?>/><label>&nbsp;</label></td>
			    <?php } else { ?>
			    <td><?php echo $_tv_val['DEFAULT']; ?></td>
			    <?php } if ($this->_rootref['S_ADD_UPDATE']) {  ?><td style="width: 5%" align="center">
			    <input type="checkbox" name="mark_<?php echo $_tv_val['S_TID']; ?>" <?php echo $_tv_val['V_ENABLED']; ?>/><label>&nbsp;</label></td>
			    <?php } else { ?>
			    <td><?php echo $_tv_val['ENABLED']; ?></td>
			    <?php } if ($this->_rootref['S_ADD_UPDATE']) {  ?>
			    <td style="width: 5%" align="center"><a href="<?php echo $_tv_val['U_UPDATE']; ?>"><img src="<?php echo $_tv_val['ICON_PATH']; ?>/edit.png" alt="<?php echo $_tv_val['L_UPDATE']; ?>" title="<?php echo $_tv_val['L_UPDATE']; ?>" /></a></td>
			    <?php } if ($this->_rootref['S_DELETE']) {  ?>
			    <td style="width: 5%" align="center"><a href="<?php echo $_tv_val['U_DELETE']; ?>" id="DeleteLink"><img src="<?php echo $_tv_val['ICON_PATH']; ?>/delete.png" alt="<?php echo $_tv_val['L_DELETE']; ?>" title="<?php echo $_tv_val['L_DELETE']; ?>" /></a>
			    </td>
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