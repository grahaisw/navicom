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
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_EMERGENCY_CODE'])) ? $this->_rootref['L_EMERGENCY_CODE'] : ((isset($user->lang['EMERGENCY_CODE'])) ? $user->lang['EMERGENCY_CODE'] : '{ EMERGENCY_CODE }')); ?>:</label></td>
			    <td width="85%"><input name="code" type="text" value="<?php echo (isset($this->_rootref['S_EMERGENCY_CODE'])) ? $this->_rootref['S_EMERGENCY_CODE'] : ''; ?>" size="80"/>
			    </td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_EMERGENCY_NAME'])) ? $this->_rootref['L_EMERGENCY_NAME'] : ((isset($user->lang['EMERGENCY_NAME'])) ? $user->lang['EMERGENCY_NAME'] : '{ EMERGENCY_NAME }')); ?>:</label></td>
			    <td><input name="name" type="text" value="<?php echo (isset($this->_rootref['S_EMERGENCY_NAME'])) ? $this->_rootref['S_EMERGENCY_NAME'] : ''; ?>" size="80"/>
			    </td>
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
			    <td><label for="global"><?php echo ((isset($this->_rootref['L_EMERGENCY_CODE'])) ? $this->_rootref['L_EMERGENCY_CODE'] : ((isset($user->lang['EMERGENCY_CODE'])) ? $user->lang['EMERGENCY_CODE'] : '{ EMERGENCY_CODE }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_EMERGENCY_CODE'])) ? $this->_rootref['S_EMERGENCY_CODE'] : ''; ?></td>
			</tr>
			<tr>
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_EMERGENCY_NAME'])) ? $this->_rootref['L_EMERGENCY_NAME'] : ((isset($user->lang['EMERGENCY_NAME'])) ? $user->lang['EMERGENCY_NAME'] : '{ EMERGENCY_NAME }')); ?>:</label></td>
			    <td width="85%"><?php echo (isset($this->_rootref['S_EMERGENCY_NAME'])) ? $this->_rootref['S_EMERGENCY_NAME'] : ''; ?></td>
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