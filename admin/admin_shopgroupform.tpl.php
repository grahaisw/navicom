<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('admin_header.tpl'); ?>


		    <div id="main">
			<a name="maincontent"></a>
 
			<h1><?php echo (isset($this->_rootref['MODULE_TITLE'])) ? $this->_rootref['MODULE_TITLE'] : ''; ?></h1>

			<p><?php echo (isset($this->_rootref['MODULE_DESC'])) ? $this->_rootref['MODULE_DESC'] : ''; ?></p>

			<div class="inner">

			<span class="corners-top2"><span>
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
			    </td>
			</tr>
			<tr>
			    <td><img src="<?php echo $_lang_val['FLAG_FILE']; ?>" height="15">
				<label><?php echo $_lang_val['L_DESCRIPTION']; ?>:</label></td>
			    <td><textarea name="description_<?php echo $_lang_val['S_LID']; ?>" id="content_<?php echo $_lang_val['S_LID']; ?>">
				  <?php echo $_lang_val['S_DESCRIPTION']; ?></textarea>
				<input type="hidden" name="lang_<?php echo $_lang_val['S_LID']; ?>" value="<?php echo $_lang_val['S_LID']; ?>"/>
				<input type="hidden" name="translation_<?php echo $_lang_val['S_LID']; ?>" value="<?php echo $_lang_val['S_TID']; ?>"/>
			    </td>
			</tr>
			<?php }} ?>

			<tr>
			    <td colspan="2">&nbsp;</td>
			</tr>
			<?php if ($this->_rootref['THUMBNAIL_FILE']) {  ?>

			<tr>
			    <td>&nbsp;</td>
			    <td><img src="<?php echo (isset($this->_rootref['S_THUMBNAIL_FILE'])) ? $this->_rootref['S_THUMBNAIL_FILE'] : ''; ?>" ></dd>
			</tr>
			<?php } ?>

			<tr>
			    <td><label for="thumbnail"><?php echo ((isset($this->_rootref['L_THUMBNAIL'])) ? $this->_rootref['L_THUMBNAIL'] : ((isset($user->lang['THUMBNAIL'])) ? $user->lang['THUMBNAIL'] : '{ THUMBNAIL }')); ?>:</label></td>
			    <td><input type="text" name="thumbnail" class="inputbox autowidth"  value="<?php echo (isset($this->_rootref['S_THUMBNAIL'])) ? $this->_rootref['S_THUMBNAIL'] : ''; ?>"></td>
			</tr>
			<tr>
			    <td><label for="order"><?php echo ((isset($this->_rootref['L_ORDER'])) ? $this->_rootref['L_ORDER'] : ((isset($user->lang['ORDER'])) ? $user->lang['ORDER'] : '{ ORDER }')); ?>:</label></td>
			    <td><input type="text" name="order" value="<?php echo (isset($this->_rootref['S_ORDER'])) ? $this->_rootref['S_ORDER'] : ''; ?>"></td>
			</tr>
			<tr>
			    <td><label for="allow_ads"><?php echo ((isset($this->_rootref['L_ALLOW_ADS'])) ? $this->_rootref['L_ALLOW_ADS'] : ((isset($user->lang['ALLOW_ADS'])) ? $user->lang['ALLOW_ADS'] : '{ ALLOW_ADS }')); ?>:</label></td>
			    <td><input id="allow_ads" name="allow_ads" type="checkbox" class="radio" <?php echo (isset($this->_rootref['S_ALLOW_ADS'])) ? $this->_rootref['S_ALLOW_ADS'] : ''; ?>/><label>&nbsp;</label></td>
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