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
			  <th><?php echo ((isset($this->_rootref['L_DESCRIPTION'])) ? $this->_rootref['L_DESCRIPTION'] : ((isset($user->lang['DESCRIPTION'])) ? $user->lang['DESCRIPTION'] : '{ DESCRIPTION }')); ?></th>
              <th><?php echo ((isset($this->_rootref['L_TYPE'])) ? $this->_rootref['L_TYPE'] : ((isset($user->lang['TYPE'])) ? $user->lang['TYPE'] : '{ TYPE }')); ?></th>
              <!--<th><?php echo ((isset($this->_rootref['L_DURATION'])) ? $this->_rootref['L_DURATION'] : ((isset($user->lang['DURATION'])) ? $user->lang['DURATION'] : '{ DURATION }')); ?></th>-->
              <th><?php echo ((isset($this->_rootref['L_ENABLED'])) ? $this->_rootref['L_ENABLED'] : ((isset($user->lang['ENABLED'])) ? $user->lang['ENABLED'] : '{ ENABLED }')); ?></th>
              <!--<th><?php echo ((isset($this->_rootref['L_LOOP'])) ? $this->_rootref['L_LOOP'] : ((isset($user->lang['LOOP'])) ? $user->lang['LOOP'] : '{ LOOP }')); ?></th>-->
              <?php if ($this->_rootref['S_ADD_UPDATE']) {  ?><th>&nbsp;</th><?php } if ($this->_rootref['S_DELETE']) {  ?><th>&nbsp;</th><?php } ?>
			</tr>
			</thead>
			<tbody>
			<?php if ($this->_rootref['S_SIGNAGES']) {  $_signage_count = (isset($this->_tpldata['signage'])) ? sizeof($this->_tpldata['signage']) : 0;if ($_signage_count) {for ($_signage_i = 0; $_signage_i < $_signage_count; ++$_signage_i){$_signage_val = &$this->_tpldata['signage'][$_signage_i]; if (!($_signage_val['S_ROW_COUNT'] & 1)  ) {  ?><tr class="bg1"><?php } else { ?><tr class="bg2"><?php } ?>
			    <td><strong><a href="<?php echo $_signage_val['U_DETAIL']; ?>"><?php echo $_signage_val['NAME']; ?></a></strong></td>
			    <td><?php echo $_signage_val['DESCRIPTION']; ?> <input type="hidden" name="playlist_id[]" value="<?php echo $_signage_val['S_RID']; ?>"/></td>
                <td><?php echo $_signage_val['TYPE']; ?></td>
				
                <!--<td><?php echo $_signage_val['DURATION']; ?></td>-->
			    <?php if ($this->_rootref['S_ADD_UPDATE']) {  ?><td style="width: 5%" align="center">
			    <input type="checkbox" name="mark_<?php echo $_signage_val['S_RID']; ?>" <?php echo $_signage_val['V_ENABLED']; ?>/><label>&nbsp;</label></td>
			    <?php } else { ?>
			    <td><?php echo $_signage_val['ENABLED']; ?></td>
			    <?php } if ($this->_rootref['S_ADD_UPDATE']) {  ?><!--<td style="width: 5%" align="center">
			    <input type="checkbox" name="mark_<?php echo $_signage_val['S_RID']; ?>" <?php echo $_signage_val['V_LOOP']; ?>/></td>-->
			    <?php } else { ?>
			    <!--<td><?php echo $_signage_val['LOOP']; ?></td>-->
			    <?php } if ($this->_rootref['S_ADD_UPDATE']) {  ?>
			    <td style="width: 5%" align="center"><a href="<?php echo $_signage_val['U_UPDATE']; ?>" rel="facebox"><img src="<?php echo $_signage_val['ICON_PATH']; ?>/edit.png" alt="<?php echo $_signage_val['L_UPDATE']; ?>" title="<?php echo $_signage_val['L_UPDATE']; ?>" /></a></td>
			    <?php } if ($this->_rootref['S_DELETE']) {  ?>
			    <td style="width: 5%" align="center"><a href="<?php echo $_signage_val['U_DELETE']; ?>" id="DeleteLink"><img src="<?php echo $_signage_val['ICON_PATH']; ?>/delete.png" alt="<?php echo $_signage_val['L_DELETE']; ?>" title="<?php echo $_signage_val['L_DELETE']; ?>" /></a>
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