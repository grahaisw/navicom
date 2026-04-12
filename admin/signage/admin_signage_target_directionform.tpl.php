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
			    <td><label for="zone"><?php echo ((isset($this->_rootref['L_NODE'])) ? $this->_rootref['L_NODE'] : ((isset($user->lang['NODE'])) ? $user->lang['NODE'] : '{ NODE }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_NODE'])) ? $this->_rootref['S_NODE'] : ''; ?></td>
			</tr>
            <tr>
			    <td width="15%"><label for="node"><?php echo ((isset($this->_rootref['L_TARGET_GATE'])) ? $this->_rootref['L_TARGET_GATE'] : ((isset($user->lang['TARGET_GATE'])) ? $user->lang['TARGET_GATE'] : '{ TARGET_GATE }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_TARGET_GATE'])) ? $this->_rootref['S_TARGET_GATE'] : ''; ?></td>
			</tr>
            <!--<tr>
			    <td><label for="zone"><?php echo ((isset($this->_rootref['L_ROOMS'])) ? $this->_rootref['L_ROOMS'] : ((isset($user->lang['ROOMS'])) ? $user->lang['ROOMS'] : '{ ROOMS }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_ROOMS'])) ? $this->_rootref['S_ROOMS'] : ''; ?></td>
			</tr>-->
			<tr>
			    <td><label for="zone"><?php echo ((isset($this->_rootref['L_DIRECTION'])) ? $this->_rootref['L_DIRECTION'] : ((isset($user->lang['DIRECTION'])) ? $user->lang['DIRECTION'] : '{ DIRECTION }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_DIRECTION'])) ? $this->_rootref['S_DIRECTION'] : ''; ?></td>
			</tr>
            <!--<tr>
			    <td><label for="enabled"><?php echo ((isset($this->_rootref['L_ENABLED'])) ? $this->_rootref['L_ENABLED'] : ((isset($user->lang['ENABLED'])) ? $user->lang['ENABLED'] : '{ ENABLED }')); ?>:</label></td>
			    <td><input id="enabled" name="enabled_flag" type="checkbox" class="radio" <?php echo (isset($this->_rootref['S_ENABLED'])) ? $this->_rootref['S_ENABLED'] : ''; ?>/></td>
			</tr>-->
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