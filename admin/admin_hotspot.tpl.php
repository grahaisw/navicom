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

			<table cellspacing="1" class="table1" id="dtable3">
			<thead>
			<tr>
			  <th width="28%"><?php echo ((isset($this->_rootref['L_ROOM'])) ? $this->_rootref['L_ROOM'] : ((isset($user->lang['ROOM'])) ? $user->lang['ROOM'] : '{ ROOM }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_PASSWORD1'])) ? $this->_rootref['L_PASSWORD1'] : ((isset($user->lang['PASSWORD1'])) ? $user->lang['PASSWORD1'] : '{ PASSWORD1 }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_PASSWORD2'])) ? $this->_rootref['L_PASSWORD2'] : ((isset($user->lang['PASSWORD2'])) ? $user->lang['PASSWORD2'] : '{ PASSWORD2 }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_PASSWORD3'])) ? $this->_rootref['L_PASSWORD3'] : ((isset($user->lang['PASSWORD3'])) ? $user->lang['PASSWORD3'] : '{ PASSWORD3 }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_PASSWORD4'])) ? $this->_rootref['L_PASSWORD4'] : ((isset($user->lang['PASSWORD4'])) ? $user->lang['PASSWORD4'] : '{ PASSWORD4 }')); ?></th>
			  <?php if ($this->_rootref['S_ADD_UPDATE']) {  ?><th>&nbsp;</th><?php } if ($this->_rootref['S_DELETE']) {  ?><th>&nbsp;</th><?php } ?>
			</tr>
			</thead>
			<tbody>
			<?php if ($this->_rootref['S_HOTSPOT']) {  $_hotspot_count = (isset($this->_tpldata['hotspot'])) ? sizeof($this->_tpldata['hotspot']) : 0;if ($_hotspot_count) {for ($_hotspot_i = 0; $_hotspot_i < $_hotspot_count; ++$_hotspot_i){$_hotspot_val = &$this->_tpldata['hotspot'][$_hotspot_i]; if (!($_hotspot_val['S_ROW_COUNT'] & 1)  ) {  ?><tr class="bg1"><?php } else { ?><tr class="bg2"><?php } ?>
			    <td><strong><?php echo $_hotspot_val['ROOM']; ?></td>
				<td><?php echo $_hotspot_val['PASSWORD1']; ?></td>
			    <td><?php echo $_hotspot_val['PASSWORD2']; ?></td>
			    <td><?php echo $_hotspot_val['PASSWORD3']; ?></td>
			    <td><?php echo $_hotspot_val['PASSWORD4']; ?></td>
			    <?php if ($this->_rootref['S_ADD_UPDATE']) {  ?>
			    <td style="width: 5%" align="center"><a href="<?php echo $_hotspot_val['U_UPDATE']; ?>"><img src="<?php echo $_hotspot_val['ICON_PATH']; ?>/edit.png" alt="<?php echo $_hotspot_val['L_UPDATE']; ?>" title="<?php echo $_hotspot_val['L_UPDATE']; ?>" /></a></td>
			    <?php } if ($this->_rootref['S_DELETE']) {  ?>
			    <td style="width: 5%" align="center"><a href="<?php echo $_hotspot_val['U_DELETE']; ?>" id="DeleteLink"><img src="<?php echo $_hotspot_val['ICON_PATH']; ?>/delete.png" alt="<?php echo $_hotspot_val['L_DELETE']; ?>" title="<?php echo $_hotspot_val['L_DELETE']; ?>" /></a>
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