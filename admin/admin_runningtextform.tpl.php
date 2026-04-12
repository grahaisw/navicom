<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('admin_header.tpl'); ?>


		    <div id="main">
			<a name="maincontent"></a>
 
			<h1><?php echo (isset($this->_rootref['MODULE_TITLE'])) ? $this->_rootref['MODULE_TITLE'] : ''; ?></h1>

			<p><?php echo (isset($this->_rootref['MODULE_DESC'])) ? $this->_rootref['MODULE_DESC'] : ''; ?></p>

			<div class="inner">
			<span class="corners-top2"><span>
		<?php if ($this->_rootref['S_FORM']) {  ?>

			<span class="navigation"><label><?php echo ((isset($this->_rootref['L_LABEL'])) ? $this->_rootref['L_LABEL'] : ((isset($user->lang['LABEL'])) ? $user->lang['LABEL'] : '{ LABEL }')); ?></label></span></br>
			<form method="post" id="mcp" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>">
			<table cellspacing="1">
			<?php $_lang_count = (isset($this->_tpldata['lang'])) ? sizeof($this->_tpldata['lang']) : 0;if ($_lang_count) {for ($_lang_i = 0; $_lang_i < $_lang_count; ++$_lang_i){$_lang_val = &$this->_tpldata['lang'][$_lang_i]; ?>

			<tr>
			    <td colspan="2"><label><?php echo $_lang_val['LANG_NAME']; ?>:</label></td>
			</tr>
			<tr>
			    <td width="15%"><img src="<?php echo $_lang_val['FLAG_FILE']; ?>" height="15">
				<label><?php echo $_lang_val['L_TITLE']; ?>:</label></td>
			    <td width="85%"><input name="title_<?php echo $_lang_val['S_LID']; ?>" type="text" value="<?php echo $_lang_val['S_TITLE']; ?>" size="60"/>
			    <input type="hidden" name="lang_<?php echo $_lang_val['S_LID']; ?>" value="<?php echo $_lang_val['S_LID']; ?>"/>
			    <input type="hidden" name="translation_<?php echo $_lang_val['S_LID']; ?>" value="<?php echo $_lang_val['S_MID']; ?>"/>
			    </td>
			</tr>
			<tr>
			    <td><img src="<?php echo $_lang_val['FLAG_FILE']; ?>" height="15">
				<label><?php echo $_lang_val['L_DESCRIPTION']; ?>:</label></td>
			    <td><textarea  name="description_<?php echo $_lang_val['S_LID']; ?>" rows="5" cols="40">
				  <?php echo $_lang_val['S_DESCRIPTION']; ?></textarea>

			    </td>
			</tr>
			<?php }} ?>

			<tr>
			    <td colspan="2">&nbsp;</td>
			</tr>
			<tr>
			    <td><label for="global"><?php echo ((isset($this->_rootref['L_GLOBAL'])) ? $this->_rootref['L_GLOBAL'] : ((isset($user->lang['GLOBAL'])) ? $user->lang['GLOBAL'] : '{ GLOBAL }')); ?>:</label></td>
			    <td><input id="global" name="global_flag" type="checkbox" class="radio" <?php echo (isset($this->_rootref['S_GLOBAL'])) ? $this->_rootref['S_GLOBAL'] : ''; ?>/><label>&nbsp;</label></td>
			</tr>
			<tr>
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_TARGET_ROOM'])) ? $this->_rootref['L_TARGET_ROOM'] : ((isset($user->lang['TARGET_ROOM'])) ? $user->lang['TARGET_ROOM'] : '{ TARGET_ROOM }')); ?>:</label></td>
			    <td width="85%"><?php echo (isset($this->_rootref['S_TARGET_ROOM'])) ? $this->_rootref['S_TARGET_ROOM'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_TARGET_ZONE'])) ? $this->_rootref['L_TARGET_ZONE'] : ((isset($user->lang['TARGET_ZONE'])) ? $user->lang['TARGET_ZONE'] : '{ TARGET_ZONE }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_TARGET_ZONE'])) ? $this->_rootref['S_TARGET_ZONE'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_START'])) ? $this->_rootref['L_START'] : ((isset($user->lang['START'])) ? $user->lang['START'] : '{ START }')); ?>:</label></td>
			    <td><input name="start" type="text" id="startdatetime" value="<?php echo (isset($this->_rootref['S_START'])) ? $this->_rootref['S_START'] : ''; ?>"/>
                <input id="pickstartdatetime" type="button" value="<?php echo ((isset($this->_rootref['L_PICK'])) ? $this->_rootref['L_PICK'] : ((isset($user->lang['PICK'])) ? $user->lang['PICK'] : '{ PICK }')); ?>"/></td>
			</tr>
            <tr>
			    <td><label><?php echo ((isset($this->_rootref['L_END'])) ? $this->_rootref['L_END'] : ((isset($user->lang['END'])) ? $user->lang['END'] : '{ END }')); ?>:</label></td>
			    <td><input name="end" type="text" id="enddatetime" value="<?php echo (isset($this->_rootref['S_END'])) ? $this->_rootref['S_END'] : ''; ?>"/>
                <input id="pickenddatetime" type="button" value="<?php echo ((isset($this->_rootref['L_PICK'])) ? $this->_rootref['L_PICK'] : ((isset($user->lang['PICK'])) ? $user->lang['PICK'] : '{ PICK }')); ?>"/></td>
			</tr>
			<tr>
			    <td><label for="daily"><?php echo ((isset($this->_rootref['L_DAILY'])) ? $this->_rootref['L_DAILY'] : ((isset($user->lang['DAILY'])) ? $user->lang['DAILY'] : '{ DAILY }')); ?>:</label></td>
			    <td><input id="daily" name="daily_flag" type="checkbox" class="radio" <?php echo (isset($this->_rootref['S_DAILY'])) ? $this->_rootref['S_DAILY'] : ''; ?>/><label>&nbsp;</label></td>
			</tr>
			<tr>
			    <td><label for="enabled"><?php echo ((isset($this->_rootref['L_ENABLED'])) ? $this->_rootref['L_ENABLED'] : ((isset($user->lang['ENABLED'])) ? $user->lang['ENABLED'] : '{ ENABLED }')); ?>:</label></td>
			    <td><input id="enabled" name="enabled_flag" type="checkbox" class="radio" <?php echo (isset($this->_rootref['S_ENABLED'])) ? $this->_rootref['S_ENABLED'] : ''; ?>/><label>&nbsp;</label></td>
			</tr>
			<tr>
			    <td><label for="order"><?php echo ((isset($this->_rootref['L_ORDER'])) ? $this->_rootref['L_ORDER'] : ((isset($user->lang['ORDER'])) ? $user->lang['ORDER'] : '{ ORDER }')); ?>:</label></td>
			    <td><input id="order" name="order" type="text" value="<?php echo (isset($this->_rootref['S_ORDER'])) ? $this->_rootref['S_ORDER'] : ''; ?>" size="5" /></td>
			</tr>
			<tr>
			    <td>&nbsp;</td>
			    <td><p class="submit-buttons">
			    <input class="button1" type="submit" id="submit" name="submit" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" />&nbsp;
				</p><?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?></td>
			</tr>

			</table>
			<hr />
			
			</form>
		<?php } if ($this->_rootref['S_DETAIL']) {  if ($this->_rootref['S_ADD_UPDATE']) {  ?>

			    <span class="navigation"><a href="<?php echo (isset($this->_rootref['U_EDIT'])) ? $this->_rootref['U_EDIT'] : ''; ?>" rel="facebox"><img src="<?php echo (isset($this->_rootref['ICON_PATH'])) ? $this->_rootref['ICON_PATH'] : ''; ?>/edit.png" alt="<?php echo ((isset($this->_rootref['L_EDIT'])) ? $this->_rootref['L_EDIT'] : ((isset($user->lang['EDIT'])) ? $user->lang['EDIT'] : '{ EDIT }')); ?>" title="<?php echo ((isset($this->_rootref['L_EDIT'])) ? $this->_rootref['L_EDIT'] : ((isset($user->lang['EDIT'])) ? $user->lang['EDIT'] : '{ EDIT }')); ?>" width="20" /><?php echo ((isset($this->_rootref['L_EDIT'])) ? $this->_rootref['L_EDIT'] : ((isset($user->lang['EDIT'])) ? $user->lang['EDIT'] : '{ EDIT }')); ?></a></span></br>
			<?php } ?>

			<table cellspacing="1">
			<?php $_lang_count = (isset($this->_tpldata['lang'])) ? sizeof($this->_tpldata['lang']) : 0;if ($_lang_count) {for ($_lang_i = 0; $_lang_i < $_lang_count; ++$_lang_i){$_lang_val = &$this->_tpldata['lang'][$_lang_i]; ?>

			<tr>
			    <td colspan="2"><label><?php echo $_lang_val['LANG_NAME']; ?>:</label><img src="<?php echo $_lang_val['FLAG_FILE']; ?>" height="15"></td>
			</tr>
			<tr>
			    <td colspan="2"><label><?php echo $_lang_val['S_TITLE']; ?></label></td>
			</tr>
			<tr>
			    <td colspan="2"><label><?php echo $_lang_val['S_DESCRIPTION']; ?></label></td>
			</tr>
			<tr>
			    <td colspan="2">&nbsp;</td>
			</tr>
			<?php }} ?>

			<tr>
			    <td><label for="global"><?php echo ((isset($this->_rootref['L_GLOBAL'])) ? $this->_rootref['L_GLOBAL'] : ((isset($user->lang['GLOBAL'])) ? $user->lang['GLOBAL'] : '{ GLOBAL }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_GLOBAL'])) ? $this->_rootref['S_GLOBAL'] : ''; ?></td>
			</tr>
			<tr>
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_TARGET_ROOM'])) ? $this->_rootref['L_TARGET_ROOM'] : ((isset($user->lang['TARGET_ROOM'])) ? $user->lang['TARGET_ROOM'] : '{ TARGET_ROOM }')); ?>:</label></td>
			    <td width="85%"><?php echo (isset($this->_rootref['S_TARGET_ROOM'])) ? $this->_rootref['S_TARGET_ROOM'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_TARGET_ZONE'])) ? $this->_rootref['L_TARGET_ZONE'] : ((isset($user->lang['TARGET_ZONE'])) ? $user->lang['TARGET_ZONE'] : '{ TARGET_ZONE }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_TARGET_ZONE'])) ? $this->_rootref['S_TARGET_ZONE'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label for="enabled"><?php echo ((isset($this->_rootref['L_ENABLED'])) ? $this->_rootref['L_ENABLED'] : ((isset($user->lang['ENABLED'])) ? $user->lang['ENABLED'] : '{ ENABLED }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_ENABLED'])) ? $this->_rootref['S_ENABLED'] : ''; ?></td>
			</tr>

			</table>
			<hr />
		<?php } ?>

			</div>
<br />
		    </div>
		 </div>

		 <span class="corners-bottom"><span>
		 
		 <div class="clear"></div>
	    </div>
	</div>

    </div>

<?php $this->_tpl_include('overall_footer.tpl'); ?>