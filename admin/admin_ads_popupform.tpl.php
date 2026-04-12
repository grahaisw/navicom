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
			<form method="post" id="mcp" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>">
			<table cellspacing="1">
			<tr>
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_POPUP_NAME'])) ? $this->_rootref['L_POPUP_NAME'] : ((isset($user->lang['POPUP_NAME'])) ? $user->lang['POPUP_NAME'] : '{ POPUP_NAME }')); ?>:</label></td>
			    <td width="85%"><input name="name" type="text" value="<?php echo (isset($this->_rootref['S_POPUP_NAME'])) ? $this->_rootref['S_POPUP_NAME'] : ''; ?>" size="40"/>
			    </td>
			</tr>

			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_POPUP_DESCRIPTION'])) ? $this->_rootref['L_POPUP_DESCRIPTION'] : ((isset($user->lang['POPUP_DESCRIPTION'])) ? $user->lang['POPUP_DESCRIPTION'] : '{ POPUP_DESCRIPTION }')); ?>:</label></td>
			    <td><textarea  name="description" id="description" rows="5" cols="40">
				  <?php echo (isset($this->_rootref['S_POPUP_DESCRIPTION'])) ? $this->_rootref['S_POPUP_DESCRIPTION'] : ''; ?></textarea>
			    </td>
			</tr>
			<tr>
			    <td><label for="node"><?php echo ((isset($this->_rootref['L_IMAGE'])) ? $this->_rootref['L_IMAGE'] : ((isset($user->lang['IMAGE'])) ? $user->lang['IMAGE'] : '{ IMAGE }')); ?>:</label></td>
			    <td><input id="image" name="image" type="text" value="<?php echo (isset($this->_rootref['S_IMAGE'])) ? $this->_rootref['S_IMAGE'] : ''; ?>" size="40"/><div id="file-uploader-demo1" style="width:100px; display:inline-block; vertical-align:top; line-height:18px; margin-left:5px;"></div>&nbsp; (dimension: 420 pixel x 400 pixel, format: jpg/png/gif)</td>
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
			<input type="hidden" id="ads_type" value="<?php echo (isset($this->_rootref['S_TYPE'])) ? $this->_rootref['S_TYPE'] : ''; ?>" />
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