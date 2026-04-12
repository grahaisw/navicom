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
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_NAME'])) ? $this->_rootref['L_NAME'] : ((isset($user->lang['NAME'])) ? $user->lang['NAME'] : '{ NAME }')); ?>:</label></td>
			    <td width="85%"><input name="name" type="text" value="<?php echo (isset($this->_rootref['S_NAME'])) ? $this->_rootref['S_NAME'] : ''; ?>" size="60"/></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_JUAL'])) ? $this->_rootref['L_JUAL'] : ((isset($user->lang['JUAL'])) ? $user->lang['JUAL'] : '{ JUAL }')); ?>:</label></td>
			    <td><input name="jual" type="text" value="<?php echo (isset($this->_rootref['S_JUAL'])) ? $this->_rootref['S_JUAL'] : ''; ?>" size="60"/></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_BELI'])) ? $this->_rootref['L_BELI'] : ((isset($user->lang['BELI'])) ? $user->lang['BELI'] : '{ BELI }')); ?>:</label></td>
			    <td><input name="beli" type="text" value="<?php echo (isset($this->_rootref['S_BELI'])) ? $this->_rootref['S_BELI'] : ''; ?>" size="60"/></td>
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
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_NAME'])) ? $this->_rootref['L_NAME'] : ((isset($user->lang['NAME'])) ? $user->lang['NAME'] : '{ NAME }')); ?>:</label></td>
			    <td width="85%"><strong><?php echo (isset($this->_rootref['S_NAME'])) ? $this->_rootref['S_NAME'] : ''; ?></strong></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_JUAL'])) ? $this->_rootref['L_JUAL'] : ((isset($user->lang['JUAL'])) ? $user->lang['JUAL'] : '{ JUAL }')); ?>:</label></td>
			    <td><video width="300" autoplay><source src="<?php echo (isset($this->_rootref['S_JUAL'])) ? $this->_rootref['S_JUAL'] : ''; ?>"></video></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_BELI'])) ? $this->_rootref['L_BELI'] : ((isset($user->lang['BELI'])) ? $user->lang['BELI'] : '{ BELI }')); ?>:</label></td>
			    <td><video width="300" autoplay><source src="<?php echo (isset($this->_rootref['S_BELI'])) ? $this->_rootref['S_BELI'] : ''; ?>"></video></td>
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