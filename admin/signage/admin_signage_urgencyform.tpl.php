<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('admin_header.tpl'); ?>

		    <div id="main">
			<a name="maincontent"></a>
 
			<h1><?php echo (isset($this->_rootref['MODULE_TITLE'])) ? $this->_rootref['MODULE_TITLE'] : ''; ?></h1>

			<p><?php echo (isset($this->_rootref['MODULE_DESC'])) ? $this->_rootref['MODULE_DESC'] : ''; ?></p>

			<div class="inner">
	
			<span class="corners-top2"><span>
            <?php if ($this->_rootref['S_FORM']) {  ?>
			<form method="post" id="mcp" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>">
			<table cellspacing="1">
			<?php $_lang_count = (isset($this->_tpldata['lang'])) ? sizeof($this->_tpldata['lang']) : 0;if ($_lang_count) {for ($_lang_i = 0; $_lang_i < $_lang_count; ++$_lang_i){$_lang_val = &$this->_tpldata['lang'][$_lang_i]; ?>
			<tr>
			    <td width="15%"><img src="<?php echo $_lang_val['FLAG_FILE']; ?>" height="15">
				<label><?php echo $_lang_val['L_TITLE']; ?>:</label></td>
			    <td width="85%"><input name="title_<?php echo $_lang_val['S_LID']; ?>" type="text" value="<?php echo $_lang_val['S_TITLE']; ?>" size="60"/>
			    <input type="hidden" name="lang_<?php echo $_lang_val['S_LID']; ?>" value="<?php echo $_lang_val['S_LID']; ?>"/>
			    <input type="hidden" name="translation_<?php echo $_lang_val['S_LID']; ?>" value="<?php echo $_lang_val['S_RID']; ?>"/>
			    </td>
			</tr>
			<tr>
			    <td><img src="<?php echo $_lang_val['FLAG_FILE']; ?>" height="15">
				<label><?php echo $_lang_val['L_DESCRIPTION']; ?>:</label></td>
			    <td><textarea  name="description_<?php echo $_lang_val['S_LID']; ?>" rows="5" cols="40">
				  <?php echo $_lang_val['S_DESCRIPTION']; ?></textarea>

			    </td>
			</tr>
			<?php }} if ($this->_rootref['THUMBNAIL_FILE']) {  ?>
			<!-- <tr>
			    <td>&nbsp;</td>
			    <td><img src="<?php echo (isset($this->_rootref['S_THUMBNAIL_FILE'])) ? $this->_rootref['S_THUMBNAIL_FILE'] : ''; ?>" height="50"></td>
			</tr> -->
			<?php } ?>
			<!-- <tr>
				
			    <td><label for="thumbnail"><?php echo ((isset($this->_rootref['L_THUMBNAIL'])) ? $this->_rootref['L_THUMBNAIL'] : ((isset($user->lang['THUMBNAIL'])) ? $user->lang['THUMBNAIL'] : '{ THUMBNAIL }')); ?>:</label></td>
			    <td><input type="text" name="thumbnail" id="thumbnail"  value="<?php echo (isset($this->_rootref['S_THUMBNAIL'])) ? $this->_rootref['S_THUMBNAIL'] : ''; ?>" size="60"/>
			    <div id="file-uploader-demo1" style="width:100px; display:inline-block; vertical-align:top; line-height:18px; margin-left:5px;"></div>&nbsp;(600x400 pixel, format: jpg/png/gif)</td>
			</tr> -->	
			<tr>
			    <td><label for="node"><?php echo ((isset($this->_rootref['L_EMERGENCY_TYPE'])) ? $this->_rootref['L_EMERGENCY_TYPE'] : ((isset($user->lang['EMERGENCY_TYPE'])) ? $user->lang['EMERGENCY_TYPE'] : '{ EMERGENCY_TYPE }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_EMERGENCY_TYPE'])) ? $this->_rootref['S_EMERGENCY_TYPE'] : ''; ?></td>
			</tr>
            <!--<tr>
			    <td><label for="node"><?php echo ((isset($this->_rootref['L_TARGET_GATE'])) ? $this->_rootref['L_TARGET_GATE'] : ((isset($user->lang['TARGET_GATE'])) ? $user->lang['TARGET_GATE'] : '{ TARGET_GATE }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_TARGET_GATE'])) ? $this->_rootref['S_TARGET_GATE'] : ''; ?></td>
			</tr>-->
			<tr>
			    <td><label for="zone"><?php echo ((isset($this->_rootref['L_ZONE'])) ? $this->_rootref['L_ZONE'] : ((isset($user->lang['ZONE'])) ? $user->lang['ZONE'] : '{ ZONE }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_ZONE'])) ? $this->_rootref['S_ZONE'] : ''; ?></td>
			</tr>
            <tr>
			    <td><label for="zone"><?php echo ((isset($this->_rootref['L_ROOMS'])) ? $this->_rootref['L_ROOMS'] : ((isset($user->lang['ROOMS'])) ? $user->lang['ROOMS'] : '{ ROOMS }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_ROOMS'])) ? $this->_rootref['S_ROOMS'] : ''; ?></td>
			</tr>
            <tr>
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_DURATION'])) ? $this->_rootref['L_DURATION'] : ((isset($user->lang['DURATION'])) ? $user->lang['DURATION'] : '{ DURATION }')); ?>:</label></td>
			    <td width="85%"><input name="duration" type="text" value="<?php echo (isset($this->_rootref['S_DURATION'])) ? $this->_rootref['S_DURATION'] : ''; ?>" size="5"/> second
			    </td>
			</tr>
			<tr>
			    <td><label for="enabled"><?php echo ((isset($this->_rootref['L_ENABLED'])) ? $this->_rootref['L_ENABLED'] : ((isset($user->lang['ENABLED'])) ? $user->lang['ENABLED'] : '{ ENABLED }')); ?>:</label></td>
			    <td><input id="enabled" name="enabled_flag" type="checkbox" class="radio" <?php echo (isset($this->_rootref['S_ENABLED'])) ? $this->_rootref['S_ENABLED'] : ''; ?>/><label>&nbsp;</label></td>
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
            <?php } if ($this->_rootref['S_DETAIL']) {  ?>
			<table cellspacing="1">
			<tr>
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_DURATION'])) ? $this->_rootref['L_DURATION'] : ((isset($user->lang['DURATION'])) ? $user->lang['DURATION'] : '{ DURATION }')); ?>:</label></td>
			    <td width="85%"><input name="duration" type="text" value="<?php echo (isset($this->_rootref['S_DURATION'])) ? $this->_rootref['S_DURATION'] : ''; ?>" size="5"/> second
			    </td>
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