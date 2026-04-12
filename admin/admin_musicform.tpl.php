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
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_DIRECTOR'])) ? $this->_rootref['L_DIRECTOR'] : ((isset($user->lang['DIRECTOR'])) ? $user->lang['DIRECTOR'] : '{ DIRECTOR }')); ?>:</label></td>
			    <td width="85%"><input name="director" type="text" value="<?php echo (isset($this->_rootref['S_DIRECTOR'])) ? $this->_rootref['S_DIRECTOR'] : ''; ?>" size="60"/></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_CASTS'])) ? $this->_rootref['L_CASTS'] : ((isset($user->lang['CASTS'])) ? $user->lang['CASTS'] : '{ CASTS }')); ?>:</label></td>
			    <td><input name="casts" type="text" value="<?php echo (isset($this->_rootref['S_CASTS'])) ? $this->_rootref['S_CASTS'] : ''; ?>" size="60"/></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_URL'])) ? $this->_rootref['L_URL'] : ((isset($user->lang['URL'])) ? $user->lang['URL'] : '{ URL }')); ?>:</label></td>
			    <td><input name="url" id="url" type="text" value="<?php echo (isset($this->_rootref['S_URL'])) ? $this->_rootref['S_URL'] : ''; ?>" size="40" style="margin-top:10px;" />
					<div id="file-uploader-demo1" style="width:100px; display:inline-block; vertical-align:top; line-height:18px; padding-top:10px;"></div>
					<input type="hidden" id="source" name="source" value="" />
					<input type="hidden" name="tid" id="tid" value="" /></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_TRAILER'])) ? $this->_rootref['L_TRAILER'] : ((isset($user->lang['TRAILER'])) ? $user->lang['TRAILER'] : '{ TRAILER }')); ?>:</label></td>
			    <td><input name="trailer" type="text" value="<?php echo (isset($this->_rootref['S_TRAILER'])) ? $this->_rootref['S_TRAILER'] : ''; ?>" size="60"/></td>
			</tr>
			<?php if ($this->_rootref['POSTER_FILE']) {  ?>

			<tr>
			    <td>&nbsp;</td>
			    <td><img src="<?php echo (isset($this->_rootref['S_POSTER_FILE'])) ? $this->_rootref['S_POSTER_FILE'] : ''; ?>" height="50"></td>
			</tr>
			<?php } ?>

			<tr>
			    <td><label for="thumbnail"><?php echo ((isset($this->_rootref['L_THUMBNAIL'])) ? $this->_rootref['L_THUMBNAIL'] : ((isset($user->lang['THUMBNAIL'])) ? $user->lang['THUMBNAIL'] : '{ THUMBNAIL }')); ?>:</label></td>
			    <td><input type="text" name="thumbnail" id="thumbnail" value="<?php echo (isset($this->_rootref['S_THUMBNAIL'])) ? $this->_rootref['S_THUMBNAIL'] : ''; ?>" size="60"/></td>
			</tr>
			
			<tr>
			    <td><label for="genre"><?php echo ((isset($this->_rootref['L_GENRE'])) ? $this->_rootref['L_GENRE'] : ((isset($user->lang['GENRE'])) ? $user->lang['GENRE'] : '{ GENRE }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_GENRE'])) ? $this->_rootref['S_GENRE'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_CODE'])) ? $this->_rootref['L_CODE'] : ((isset($user->lang['CODE'])) ? $user->lang['CODE'] : '{ CODE }')); ?>:</label></td>
			    <td><input name="code" id="code" type="text" value="<?php echo (isset($this->_rootref['S_CODE'])) ? $this->_rootref['S_CODE'] : ''; ?>" size="20"/></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_PRICE'])) ? $this->_rootref['L_PRICE'] : ((isset($user->lang['PRICE'])) ? $user->lang['PRICE'] : '{ PRICE }')); ?>:</label></td>
			    <td><input name="price" id="price" type="text" value="<?php echo (isset($this->_rootref['S_PRICE'])) ? $this->_rootref['S_PRICE'] : ''; ?>" size="20"/></td>
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
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_DIRECTOR'])) ? $this->_rootref['L_DIRECTOR'] : ((isset($user->lang['DIRECTOR'])) ? $user->lang['DIRECTOR'] : '{ DIRECTOR }')); ?>:</label></td>
			    <td width="85%"><?php echo (isset($this->_rootref['S_DIRECTOR'])) ? $this->_rootref['S_DIRECTOR'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_CASTS'])) ? $this->_rootref['L_CASTS'] : ((isset($user->lang['CASTS'])) ? $user->lang['CASTS'] : '{ CASTS }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_CASTS'])) ? $this->_rootref['S_CASTS'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_URL'])) ? $this->_rootref['L_URL'] : ((isset($user->lang['URL'])) ? $user->lang['URL'] : '{ URL }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_URL'])) ? $this->_rootref['S_URL'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_TRAILER'])) ? $this->_rootref['L_TRAILER'] : ((isset($user->lang['TRAILER'])) ? $user->lang['TRAILER'] : '{ TRAILER }')); ?>:</label></td>
			    <td><video width="300" autoplay><source src="<?php echo (isset($this->_rootref['S_TRAILER'])) ? $this->_rootref['S_TRAILER'] : ''; ?>"></video></td>
			</tr>
			<tr>
			    <td><?php echo ((isset($this->_rootref['L_POSTER'])) ? $this->_rootref['L_POSTER'] : ((isset($user->lang['POSTER'])) ? $user->lang['POSTER'] : '{ POSTER }')); ?>:</td>
			    <?php if ($this->_rootref['POSTER_FILE']) {  ?>

			    <td><img src="<?php echo (isset($this->_rootref['S_POSTER_FILE'])) ? $this->_rootref['S_POSTER_FILE'] : ''; ?>" height="50"></td>
			    <?php } else { ?>

			    <td>n/a</td>
			    <?php } ?>

			</tr>
			<tr>
			    <td><label for="genre"><?php echo ((isset($this->_rootref['L_GENRE'])) ? $this->_rootref['L_GENRE'] : ((isset($user->lang['GENRE'])) ? $user->lang['GENRE'] : '{ GENRE }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_GENRE'])) ? $this->_rootref['S_GENRE'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_CODE'])) ? $this->_rootref['L_CODE'] : ((isset($user->lang['CODE'])) ? $user->lang['CODE'] : '{ CODE }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_CODE'])) ? $this->_rootref['S_CODE'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_PRICE'])) ? $this->_rootref['L_PRICE'] : ((isset($user->lang['PRICE'])) ? $user->lang['PRICE'] : '{ PRICE }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_PRICE'])) ? $this->_rootref['S_PRICE'] : ''; ?></td>
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