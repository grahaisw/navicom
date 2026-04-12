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
			<tr>
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_ROOM'])) ? $this->_rootref['L_ROOM'] : ((isset($user->lang['ROOM'])) ? $user->lang['ROOM'] : '{ ROOM }')); ?>:</label></td>
			    <td width="85%"><input name="room" type="text" value="<?php echo (isset($this->_rootref['S_ROOM'])) ? $this->_rootref['S_ROOM'] : ''; ?>" size="10"/></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_PASSWORD1'])) ? $this->_rootref['L_PASSWORD1'] : ((isset($user->lang['PASSWORD1'])) ? $user->lang['PASSWORD1'] : '{ PASSWORD1 }')); ?>:</label></td>
			    <td><input name="password1" type="text" value="<?php echo (isset($this->_rootref['S_PASSWORD1'])) ? $this->_rootref['S_PASSWORD1'] : ''; ?>" size="10"/></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_PASSWORD2'])) ? $this->_rootref['L_PASSWORD2'] : ((isset($user->lang['PASSWORD2'])) ? $user->lang['PASSWORD2'] : '{ PASSWORD2 }')); ?>:</label></td>
			    <td><input name="password2" type="text" value="<?php echo (isset($this->_rootref['S_PASSWORD2'])) ? $this->_rootref['S_PASSWORD2'] : ''; ?>" size="10"/></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_PASSWORD3'])) ? $this->_rootref['L_PASSWORD3'] : ((isset($user->lang['PASSWORD3'])) ? $user->lang['PASSWORD3'] : '{ PASSWORD3 }')); ?>:</label></td>
			    <td><input name="password3" type="text" value="<?php echo (isset($this->_rootref['S_PASSWORD3'])) ? $this->_rootref['S_PASSWORD3'] : ''; ?>" size="10"/></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_PASSWORD4'])) ? $this->_rootref['L_PASSWORD4'] : ((isset($user->lang['PASSWORD4'])) ? $user->lang['PASSWORD4'] : '{ PASSWORD4 }')); ?>:</label></td>
			    <td><input name="password4" type="text" value="<?php echo (isset($this->_rootref['S_PASSWORD4'])) ? $this->_rootref['S_PASSWORD4'] : ''; ?>" size="10"/></td>
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