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
			  <th><?php echo ((isset($this->_rootref['L_FULLNAME'])) ? $this->_rootref['L_FULLNAME'] : ((isset($user->lang['FULLNAME'])) ? $user->lang['FULLNAME'] : '{ FULLNAME }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_NAME'])) ? $this->_rootref['L_NAME'] : ((isset($user->lang['NAME'])) ? $user->lang['NAME'] : '{ NAME }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_GROUPNAME'])) ? $this->_rootref['L_GROUPNAME'] : ((isset($user->lang['GROUPNAME'])) ? $user->lang['GROUPNAME'] : '{ GROUPNAME }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_LAST_VISIT'])) ? $this->_rootref['L_LAST_VISIT'] : ((isset($user->lang['LAST_VISIT'])) ? $user->lang['LAST_VISIT'] : '{ LAST_VISIT }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_ENABLED'])) ? $this->_rootref['L_ENABLED'] : ((isset($user->lang['ENABLED'])) ? $user->lang['ENABLED'] : '{ ENABLED }')); ?></th>
			  <?php if ($this->_rootref['S_ADD_UPDATE']) {  ?><th>&nbsp;</th><?php } if ($this->_rootref['S_DELETE']) {  ?><th>&nbsp;</th><?php } if ($this->_rootref['S_PRIVILEDGE']) {  ?><th>&nbsp;</th><?php } ?>

			</tr>
			</thead>
			<tbody>
			<?php if ($this->_rootref['S_USER']) {  $_user_count = (isset($this->_tpldata['user'])) ? sizeof($this->_tpldata['user']) : 0;if ($_user_count) {for ($_user_i = 0; $_user_i < $_user_count; ++$_user_i){$_user_val = &$this->_tpldata['user'][$_user_i]; if (!($_user_val['S_ROW_COUNT'] & 1)  ) {  ?><tr class="bg1"><?php } else { ?><tr class="bg2"><?php } ?>

			    <td><a href="<?php echo $_user_val['U_DETAIL']; ?>" rel="facebox"><?php echo $_user_val['FULLNAME']; ?></a></td>
			    <td><?php echo $_user_val['NAME']; ?></td>
			    <td><?php echo $_user_val['GROUPNAME']; ?></td>
			    <td><?php echo $_user_val['LAST_VISIT']; ?></td>
			    <?php if ($this->_rootref['S_ADD_UPDATE']) {  ?><td style="width: 5%" align="center">
			    <input type="hidden" name="uid[]" value="<?php echo $_user_val['S_UID']; ?>"/>
			    <input type="checkbox" name="mark_<?php echo $_user_val['S_UID']; ?>" <?php echo $_user_val['V_ENABLED']; ?>/><label>&nbsp;</label></td>
			    <td style="width: 5%" align="center"><a href="<?php echo $_user_val['U_UPDATE']; ?>" rel="facebox"><img src="<?php echo $_user_val['ICON_PATH']; ?>/edit.png" alt="<?php echo $_user_val['L_UPDATE']; ?>" title="<?php echo $_user_val['L_UPDATE']; ?>" /></a></td>
			    <?php } else { ?>

			    <td><?php echo $_user_val['ENABLED']; ?></td>
			    <?php } if ($this->_rootref['S_DELETE']) {  ?>

			    <td style="width: 5%" align="center"><a href="<?php echo $_user_val['U_DELETE']; ?>" id="DeleteLink"><img src="<?php echo $_user_val['ICON_PATH']; ?>/delete.png" alt="<?php echo $_user_val['L_DELETE']; ?>" title="<?php echo $_user_val['L_DELETE']; ?>" /></a></td>
			    <?php } if ($this->_rootref['S_PRIVILEDGE']) {  ?><td><a href="<?php echo $_user_val['U_PRIVILEDGE']; ?>" id="PrivilegeLink"><img src="<?php echo $_user_val['ICON_PATH']; ?>/privileges.png" alt="<?php echo $_user_val['L_PRIVILEDGE']; ?>" title="<?php echo $_user_val['L_PRIVILEDGE']; ?>" /></a></td>
			    <?php } ?>

			  </tr>
			<?php }} } else { ?>

			  <tr>
			    <td class="bg1" colspan="<?php if ($this->_rootref['S_ADD_UPDATE']) {  ?>6<?php } else { ?>4<?php } ?>" align="center"><span class="gen"><?php echo ((isset($this->_rootref['L_NO_ENTRIES'])) ? $this->_rootref['L_NO_ENTRIES'] : ((isset($user->lang['NO_ENTRIES'])) ? $user->lang['NO_ENTRIES'] : '{ NO_ENTRIES }')); ?></span></td>
			  </tr>
			<?php } ?>

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