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
			<?php }} ?>

			<tr>
			    <td colspan="2">&nbsp;</td>
			</tr>

			<?php if ($this->_rootref['THUMBNAIL_FILE']) {  ?>

			<tr>
			    <td>&nbsp;</td>
			    <td><img src="<?php echo (isset($this->_rootref['S_THUMBNAIL_FILE'])) ? $this->_rootref['S_THUMBNAIL_FILE'] : ''; ?>" height="50"></td>
			</tr>
			<?php } ?>

			<tr>
			    <td><label for="thumbnail"><?php echo ((isset($this->_rootref['L_THUMBNAIL'])) ? $this->_rootref['L_THUMBNAIL'] : ((isset($user->lang['THUMBNAIL'])) ? $user->lang['THUMBNAIL'] : '{ THUMBNAIL }')); ?>:</label></td>
			    <td><input type="text" name="thumbnail" id="thumbnail" value="<?php echo (isset($this->_rootref['S_THUMBNAIL'])) ? $this->_rootref['S_THUMBNAIL'] : ''; ?>" size="60"/></td>
			</tr>
			<?php if ($this->_rootref['CLIP_FILE']) {  ?>

			<tr>
			    <td>&nbsp;</td>
			    <td><video width="200" autoplay><source src="<?php echo (isset($this->_rootref['S_CLIP_FILE'])) ? $this->_rootref['S_CLIP_FILE'] : ''; ?>" type="video/mp4"></video></br><label><?php echo ((isset($this->_rootref['L_NOTICE_CLIP'])) ? $this->_rootref['L_NOTICE_CLIP'] : ((isset($user->lang['NOTICE_CLIP'])) ? $user->lang['NOTICE_CLIP'] : '{ NOTICE_CLIP }')); ?></label></dd>
			</tr>
			<?php } ?>

			<tr>
			    <td><label for="clip"><?php echo ((isset($this->_rootref['L_CLIP_FILE'])) ? $this->_rootref['L_CLIP_FILE'] : ((isset($user->lang['CLIP_FILE'])) ? $user->lang['CLIP_FILE'] : '{ CLIP_FILE }')); ?>:</label></td>
			    <td><input name="clip" type="text" id="clip" size="60" value="<?php echo (isset($this->_rootref['S_CLIP'])) ? $this->_rootref['S_CLIP'] : ''; ?>" /></td> 
			</tr>
			<tr>
			    <td><label for="genre"><?php echo ((isset($this->_rootref['L_GROUP'])) ? $this->_rootref['L_GROUP'] : ((isset($user->lang['GROUP'])) ? $user->lang['GROUP'] : '{ GROUP }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_GROUP'])) ? $this->_rootref['S_GROUP'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_CODE'])) ? $this->_rootref['L_CODE'] : ((isset($user->lang['CODE'])) ? $user->lang['CODE'] : '{ CODE }')); ?>:</label></td>
			    <td><input name="code" id="code" type="text" value="<?php echo (isset($this->_rootref['S_CODE'])) ? $this->_rootref['S_CODE'] : ''; ?>" size="20"/></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_CURRENCY'])) ? $this->_rootref['L_CURRENCY'] : ((isset($user->lang['CURRENCY'])) ? $user->lang['CURRENCY'] : '{ CURRENCY }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_CURRENCY'])) ? $this->_rootref['S_CURRENCY'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_PRICE'])) ? $this->_rootref['L_PRICE'] : ((isset($user->lang['PRICE'])) ? $user->lang['PRICE'] : '{ PRICE }')); ?>:</label></td>
			    <td><input name="price" id="price" type="text" value="<?php echo (isset($this->_rootref['S_PRICE'])) ? $this->_rootref['S_PRICE'] : ''; ?>" size="20"/> <b>POS Price <?php echo (isset($this->_rootref['S_POS_PRICE'])) ? $this->_rootref['S_POS_PRICE'] : ''; ?></a></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_ORDER'])) ? $this->_rootref['L_ORDER'] : ((isset($user->lang['ORDER'])) ? $user->lang['ORDER'] : '{ ORDER }')); ?>:</label></td>
			    <td><input name="order" type="text" value="<?php echo (isset($this->_rootref['S_ORDER'])) ? $this->_rootref['S_ORDER'] : ''; ?>" size="10"/></td>
			</tr>
			<tr>
			    <td><label for="allow_ads"><?php echo ((isset($this->_rootref['L_ALLOW_ADS'])) ? $this->_rootref['L_ALLOW_ADS'] : ((isset($user->lang['ALLOW_ADS'])) ? $user->lang['ALLOW_ADS'] : '{ ALLOW_ADS }')); ?>:</label></td>
			    <td><input id="allow_ads" name="allow_ads_flag" type="checkbox" class="radio" <?php echo (isset($this->_rootref['S_ALLOW_ADS'])) ? $this->_rootref['S_ALLOW_ADS'] : ''; ?>/><label>&nbsp;</label></td>
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
		<?php } if ($this->_rootref['S_DETAIL']) {  if ($this->_rootref['S_ADD_UPDATE']) {  ?>

			    <span class="navigation"><a href="<?php echo (isset($this->_rootref['U_EDIT'])) ? $this->_rootref['U_EDIT'] : ''; ?>" rel="facebox"><img src="<?php echo (isset($this->_rootref['ICON_PATH'])) ? $this->_rootref['ICON_PATH'] : ''; ?>/edit.png" alt="<?php echo ((isset($this->_rootref['L_EDIT'])) ? $this->_rootref['L_EDIT'] : ((isset($user->lang['EDIT'])) ? $user->lang['EDIT'] : '{ EDIT }')); ?>" title="<?php echo ((isset($this->_rootref['L_EDIT'])) ? $this->_rootref['L_EDIT'] : ((isset($user->lang['EDIT'])) ? $user->lang['EDIT'] : '{ EDIT }')); ?>" width="20" /><?php echo ((isset($this->_rootref['L_EDIT'])) ? $this->_rootref['L_EDIT'] : ((isset($user->lang['EDIT'])) ? $user->lang['EDIT'] : '{ EDIT }')); ?></a></span></br>
			<?php } ?>

			<table cellspacing="1">
			<?php $_lang_count = (isset($this->_tpldata['lang'])) ? sizeof($this->_tpldata['lang']) : 0;if ($_lang_count) {for ($_lang_i = 0; $_lang_i < $_lang_count; ++$_lang_i){$_lang_val = &$this->_tpldata['lang'][$_lang_i]; ?>

			<tr>
			    <td colspan="2"><label><?php echo $_lang_val['LANG_NAME']; ?>:</label><img src="<?php echo $_lang_val['FLAG_FILE']; ?>" height="15"></td>
			</tr>
			<tr>
			    <td colspan="2"><label><?php echo $_lang_val['S_TITLE']; ?></label>, <b>POS Name: <?php echo $_lang_val['S_POS_NAME']; ?></b></td>
			</tr>
			<tr>
			    <td colspan="2"><label><?php echo $_lang_val['S_DESCRIPTION']; ?></label></td>
			</tr>
			<tr>
			    <td colspan="2">&nbsp;</td>
			</tr>
			<?php }} ?>


			<tr>
			    <td><?php echo ((isset($this->_rootref['L_THUMBNAIL'])) ? $this->_rootref['L_THUMBNAIL'] : ((isset($user->lang['THUMBNAIL'])) ? $user->lang['THUMBNAIL'] : '{ THUMBNAIL }')); ?>:</td>
			    <?php if ($this->_rootref['THUMBNAIL_FILE']) {  ?>

			    <td><img src="<?php echo (isset($this->_rootref['S_THUMBNAIL_FILE'])) ? $this->_rootref['S_THUMBNAIL_FILE'] : ''; ?>" height="50"></td>
			    <?php } else { ?>

			    <td>n/a</td>
			    <?php } ?>

			</tr>
			<?php if ($this->_rootref['CLIP_FILE']) {  ?>

			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_CLIP_FILE'])) ? $this->_rootref['L_CLIP_FILE'] : ((isset($user->lang['CLIP_FILE'])) ? $user->lang['CLIP_FILE'] : '{ CLIP_FILE }')); ?></label></td>
			    <td><video width="200" autoplay><source src="<?php echo (isset($this->_rootref['S_CLIP_FILE'])) ? $this->_rootref['S_CLIP_FILE'] : ''; ?>" type="video/mp4"></video></dd>
			</tr>
			<tr>
			    <td><label for="clip_enabled"><?php echo ((isset($this->_rootref['L_CLIP_ENABLED'])) ? $this->_rootref['L_CLIP_ENABLED'] : ((isset($user->lang['CLIP_ENABLED'])) ? $user->lang['CLIP_ENABLED'] : '{ CLIP_ENABLED }')); ?>:</label></td>
			    <td><label><?php echo (isset($this->_rootref['S_CLIP_ENABLED'])) ? $this->_rootref['S_CLIP_ENABLED'] : ''; ?></label></td>
			</tr>
			<?php } ?>

			<tr>
			    <td width="15%"><label for="genre"><?php echo ((isset($this->_rootref['L_GROUP'])) ? $this->_rootref['L_GROUP'] : ((isset($user->lang['GROUP'])) ? $user->lang['GROUP'] : '{ GROUP }')); ?>:</label></td>
			    <td width="85%"><?php echo (isset($this->_rootref['S_GROUP'])) ? $this->_rootref['S_GROUP'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_CODE'])) ? $this->_rootref['L_CODE'] : ((isset($user->lang['CODE'])) ? $user->lang['CODE'] : '{ CODE }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_CODE'])) ? $this->_rootref['S_CODE'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_CURRENCY'])) ? $this->_rootref['L_CURRENCY'] : ((isset($user->lang['CURRENCY'])) ? $user->lang['CURRENCY'] : '{ CURRENCY }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_CURRENCY'])) ? $this->_rootref['S_CURRENCY'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_PRICE'])) ? $this->_rootref['L_PRICE'] : ((isset($user->lang['PRICE'])) ? $user->lang['PRICE'] : '{ PRICE }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_PRICE'])) ? $this->_rootref['S_PRICE'] : ''; ?>, <b>POS Price: <?php echo (isset($this->_rootref['S_POS_PRICE'])) ? $this->_rootref['S_POS_PRICE'] : ''; ?></b></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_ORDER'])) ? $this->_rootref['L_ORDER'] : ((isset($user->lang['ORDER'])) ? $user->lang['ORDER'] : '{ ORDER }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_ORDER'])) ? $this->_rootref['S_ORDER'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label for="allow_ads"><?php echo ((isset($this->_rootref['L_ALLOW_ADS'])) ? $this->_rootref['L_ALLOW_ADS'] : ((isset($user->lang['ALLOW_ADS'])) ? $user->lang['ALLOW_ADS'] : '{ ALLOW_ADS }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_ALLOW_ADS'])) ? $this->_rootref['S_ALLOW_ADS'] : ''; ?></td>
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