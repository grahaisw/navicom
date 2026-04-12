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
			  <th><?php echo ((isset($this->_rootref['L_MODULE'])) ? $this->_rootref['L_MODULE'] : ((isset($user->lang['MODULE'])) ? $user->lang['MODULE'] : '{ MODULE }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_CATEGORY'])) ? $this->_rootref['L_CATEGORY'] : ((isset($user->lang['CATEGORY'])) ? $user->lang['CATEGORY'] : '{ CATEGORY }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_NAME'])) ? $this->_rootref['L_NAME'] : ((isset($user->lang['NAME'])) ? $user->lang['NAME'] : '{ NAME }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_ENABLED'])) ? $this->_rootref['L_ENABLED'] : ((isset($user->lang['ENABLED'])) ? $user->lang['ENABLED'] : '{ ENABLED }')); ?></th>
			  <?php if ($this->_rootref['S_ADD_UPDATE']) {  ?><th>&nbsp;</th><?php } if ($this->_rootref['S_DELETE']) {  ?><th>&nbsp;</th><?php } ?>

			</tr>
			</thead>
			<tbody>
			<?php if ($this->_rootref['S_MODULE']) {  $_module_count = (isset($this->_tpldata['module'])) ? sizeof($this->_tpldata['module']) : 0;if ($_module_count) {for ($_module_i = 0; $_module_i < $_module_count; ++$_module_i){$_module_val = &$this->_tpldata['module'][$_module_i]; if (!($_module_val['S_ROW_COUNT'] & 1)  ) {  ?><tr class="bg1"><?php } else { ?><tr class="bg2"><?php } ?>

			    <td><?php echo $_module_val['MODULE']; ?></a></td>
			    <td><?php echo $_module_val['CATEGORY']; ?></a></td>
			    <td><a href="<?php echo $_module_val['U_DETAIL']; ?>" rel="facebox"><?php echo $_module_val['NAME']; ?></a></td>
			    <?php if ($this->_rootref['S_ADD_UPDATE']) {  ?>

			    <td style="width: 5%" align="center">
			    <input type="hidden" name="mid[]" value="<?php echo $_module_val['S_MID']; ?>"/>
			    <input type="checkbox" name="enabled_<?php echo $_module_val['S_MID']; ?>" <?php echo $_module_val['V_ENABLED']; ?>/><label>&nbsp;</label></td>
			    <?php } else { ?>

			    <td><?php echo $_module_val['ENABLED']; ?></td>
			    <?php } if ($this->_rootref['S_ADD_UPDATE']) {  ?>

			    <td style="width: 5%" align="center"><a href="<?php echo $_module_val['U_UPDATE']; ?>" rel="facebox"><img src="<?php echo $_module_val['ICON_PATH']; ?>/edit.png" alt="<?php echo $_module_val['L_UPDATE']; ?>" title="<?php echo $_module_val['L_UPDATE']; ?>" /></a></td>
			    <?php } if ($this->_rootref['S_DELETE']) {  ?>

			    <td><a href="<?php echo $_module_val['U_DELETE']; ?>" id="DeleteLink"><img src="<?php echo $_module_val['ICON_PATH']; ?>/delete.png" alt="<?php echo $_module_val['L_DELETE']; ?>" title="<?php echo $_module_val['L_DELETE']; ?>" /></a></td>
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

<?php $this->_tpl_include('overall_footer.tpl'); ?>?