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
			  <th><?php echo ((isset($this->_rootref['L_ID'])) ? $this->_rootref['L_ID'] : ((isset($user->lang['ID'])) ? $user->lang['ID'] : '{ ID }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_NAME'])) ? $this->_rootref['L_NAME'] : ((isset($user->lang['NAME'])) ? $user->lang['NAME'] : '{ NAME }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_FLAG'])) ? $this->_rootref['L_FLAG'] : ((isset($user->lang['FLAG'])) ? $user->lang['FLAG'] : '{ FLAG }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_ENABLED'])) ? $this->_rootref['L_ENABLED'] : ((isset($user->lang['ENABLED'])) ? $user->lang['ENABLED'] : '{ ENABLED }')); ?></th>
			  <th><?php echo ((isset($this->_rootref['L_EXIST'])) ? $this->_rootref['L_EXIST'] : ((isset($user->lang['EXIST'])) ? $user->lang['EXIST'] : '{ EXIST }')); ?></th>
			  <?php if ($this->_rootref['S_DELETE']) {  ?><th>&nbsp;</th><?php } ?>

			</tr>
			</thead>
			<tbody>
			<?php if ($this->_rootref['S_LANG']) {  $_lang_count = (isset($this->_tpldata['lang'])) ? sizeof($this->_tpldata['lang']) : 0;if ($_lang_count) {for ($_lang_i = 0; $_lang_i < $_lang_count; ++$_lang_i){$_lang_val = &$this->_tpldata['lang'][$_lang_i]; if (!($_lang_val['S_ROW_COUNT'] & 1)  ) {  ?><tr class="bg1"><?php } else { ?><tr class="bg2"><?php } ?>

			    <td><?php echo $_lang_val['ID']; ?></td>
			    <td><?php echo $_lang_val['NAME']; ?></td>
			    <td><img src="<?php echo $_lang_val['FLAG_FILE']; ?>" alt="<?php echo $_lang_val['NAME']; ?>" height="15"></td>
			    <?php if ($this->_rootref['S_ADD_UPDATE']) {  ?><td style="width: 5%" align="center">
			    <input type="hidden" name="lid[]" value="<?php echo $_lang_val['S_LID']; ?>"/>
			    <input type="checkbox" name="mark_<?php echo $_lang_val['S_LID']; ?>" <?php echo $_lang_val['V_ENABLED']; ?>/><label>&nbsp;</label></td>
			    <?php } else { ?>

			    <td><?php echo $_lang_val['ENABLED']; ?></td>
			    <?php } ?>

			    <td><?php echo $_lang_val['EXIST']; ?></td>
			    <?php if ($this->_rootref['S_DELETE']) {  ?>

			    <td style="width: 10%" align="center"><a href="<?php echo $_lang_val['U_UPDATE']; ?>" rel="facebox"><img src="<?php echo $_lang_val['ICON_PATH']; ?>/edit.png" alt="<?php echo $_lang_val['L_UPDATE']; ?>" title="<?php echo $_lang_val['L_UPDATE']; ?>" /></a>&nbsp;<a href="<?php echo $_lang_val['U_DELETE']; ?>" id="DeleteLink"><img src="<?php echo $_lang_val['ICON_PATH']; ?>/delete.png" alt="<?php echo $_lang_val['L_DELETE']; ?>" title="<?php echo $_lang_val['L_DELETE']; ?>" /></a></td>
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