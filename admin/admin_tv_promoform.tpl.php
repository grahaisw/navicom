<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('admin_header.tpl'); ?>

		    <div id="main">
			<a name="maincontent"></a>
 
			<h1><?php echo (isset($this->_rootref['MODULE_TITLE'])) ? $this->_rootref['MODULE_TITLE'] : ''; ?></h1>

			<p><?php echo (isset($this->_rootref['MODULE_DESC'])) ? $this->_rootref['MODULE_DESC'] : ''; ?></p>

			<div class="inner">
			<?php if ($this->_rootref['S_ADD_UPDATE']) {  ?>
			<a href="<?php echo (isset($this->_rootref['U_ADD'])) ? $this->_rootref['U_ADD'] : ''; ?>" rel="facebox"><?php echo ((isset($this->_rootref['L_ADD'])) ? $this->_rootref['L_ADD'] : ((isset($user->lang['ADD'])) ? $user->lang['ADD'] : '{ ADD }')); ?></a>
			<?php } ?>
			<span class="corners-top2"><span>
			<?php if ($this->_rootref['S_FORM']) {  ?>
			<form method="post" id="mcp" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>">
			<table cellspacing="1">
			<tr>
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_TITLE'])) ? $this->_rootref['L_TITLE'] : ((isset($user->lang['TITLE'])) ? $user->lang['TITLE'] : '{ TITLE }')); ?>:</label></td>
			    <td width="85%"><input name="title" type="text" value="<?php echo (isset($this->_rootref['S_TITLE'])) ? $this->_rootref['S_TITLE'] : ''; ?>" size="60"/></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_DESCRIPTION'])) ? $this->_rootref['L_DESCRIPTION'] : ((isset($user->lang['DESCRIPTION'])) ? $user->lang['DESCRIPTION'] : '{ DESCRIPTION }')); ?>:</label></td>
			    <td><input name="description" type="text" value="<?php echo (isset($this->_rootref['S_DESCRIPTION'])) ? $this->_rootref['S_DESCRIPTION'] : ''; ?>" size="60"/></td>
			</tr>
			<?php if ($this->_rootref['THUMBNAIL_FILE']) {  ?>
			<tr>
			    <td>&nbsp;</td>
			    <td><img src="<?php echo (isset($this->_rootref['S_THUMBNAIL_FILE'])) ? $this->_rootref['S_THUMBNAIL_FILE'] : ''; ?>" alt="<?php echo ((isset($this->_rootref['L_TITLE'])) ? $this->_rootref['L_TITLE'] : ((isset($user->lang['TITLE'])) ? $user->lang['TITLE'] : '{ TITLE }')); ?>" height="50"></td>
			</tr>
			<?php } ?>
			<tr>
			    <td><label for="thumbnail"><?php echo ((isset($this->_rootref['L_THUMBNAIL'])) ? $this->_rootref['L_THUMBNAIL'] : ((isset($user->lang['THUMBNAIL'])) ? $user->lang['THUMBNAIL'] : '{ THUMBNAIL }')); ?>:</label></td>
			    <td><input type="text" name="thumbnail" id="thumbnail" value="<?php echo (isset($this->_rootref['S_THUMBNAIL'])) ? $this->_rootref['S_THUMBNAIL'] : ''; ?>" size="50" /></td>
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
			    <td><label for="default"><?php echo ((isset($this->_rootref['L_DEFAULT'])) ? $this->_rootref['L_DEFAULT'] : ((isset($user->lang['DEFAULT'])) ? $user->lang['DEFAULT'] : '{ DEFAULT }')); ?>:</label></td>
			    <td><input id="default" name="default_flag" type="checkbox" class="radio" <?php echo (isset($this->_rootref['S_DEFAULT'])) ? $this->_rootref['S_DEFAULT'] : ''; ?>/><label>&nbsp;</label></td>
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
			<tr>
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_TITLE'])) ? $this->_rootref['L_TITLE'] : ((isset($user->lang['TITLE'])) ? $user->lang['TITLE'] : '{ TITLE }')); ?>:</label></td>
			    <td width="85%"><strong><?php echo (isset($this->_rootref['S_TITLE'])) ? $this->_rootref['S_TITLE'] : ''; ?></strong></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_DESCRIPTION'])) ? $this->_rootref['L_DESCRIPTION'] : ((isset($user->lang['DESCRIPTION'])) ? $user->lang['DESCRIPTION'] : '{ DESCRIPTION }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_DESCRIPTION'])) ? $this->_rootref['S_DESCRIPTION'] : ''; ?></td>
			</tr>
			<?php if ($this->_rootref['THUMBNAIL_FILE']) {  ?>
			<tr>
			    <td>&nbsp;</td>
			    <td><img src="<?php echo (isset($this->_rootref['S_THUMBNAIL_FILE'])) ? $this->_rootref['S_THUMBNAIL_FILE'] : ''; ?>" height="100"></td>
			</tr>
			<?php } ?>
			<tr>
			    <td><label for="thumbnail"><?php echo ((isset($this->_rootref['L_THUMBNAIL'])) ? $this->_rootref['L_THUMBNAIL'] : ((isset($user->lang['THUMBNAIL'])) ? $user->lang['THUMBNAIL'] : '{ THUMBNAIL }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_THUMBNAIL'])) ? $this->_rootref['S_THUMBNAIL'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_START'])) ? $this->_rootref['L_START'] : ((isset($user->lang['START'])) ? $user->lang['START'] : '{ START }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_START'])) ? $this->_rootref['S_START'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_END'])) ? $this->_rootref['L_END'] : ((isset($user->lang['END'])) ? $user->lang['END'] : '{ END }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_END'])) ? $this->_rootref['S_END'] : ''; ?></td>
			</tr>
			<tr>
			    <td><label for="default"><?php echo ((isset($this->_rootref['L_DEFAULT'])) ? $this->_rootref['L_DEFAULT'] : ((isset($user->lang['DEFAULT'])) ? $user->lang['DEFAULT'] : '{ DEFAULT }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_DEFAULT'])) ? $this->_rootref['S_DEFAULT'] : ''; ?></td>
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