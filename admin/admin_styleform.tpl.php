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
	<tr>
	    <td><label for="name"><?php echo ((isset($this->_rootref['L_NAME'])) ? $this->_rootref['L_NAME'] : ((isset($user->lang['NAME'])) ? $user->lang['NAME'] : '{ NAME }')); ?>:</label></td>
	    <td><input name="name" type="text" id="name" value="<?php echo (isset($this->_rootref['S_NAME'])) ? $this->_rootref['S_NAME'] : ''; ?>" /></td>
	</tr>
	<tr>
	    <td><label for="description"><?php echo ((isset($this->_rootref['L_DESCRIPTION'])) ? $this->_rootref['L_DESCRIPTION'] : ((isset($user->lang['DESCRIPTION'])) ? $user->lang['DESCRIPTION'] : '{ DESCRIPTION }')); ?>:</label></td>
	    <td><textarea name="description" id="description" rows="5" cols="40"><?php echo (isset($this->_rootref['S_DESCRIPTION'])) ? $this->_rootref['S_DESCRIPTION'] : ''; ?></textarea></td>
	</tr>
	<tr>
	    <td><label for="type"><?php echo ((isset($this->_rootref['L_TYPE'])) ? $this->_rootref['L_TYPE'] : ((isset($user->lang['TYPE'])) ? $user->lang['TYPE'] : '{ TYPE }')); ?>:</label></td>
	    <td><input id="type" name="type_flag" type="checkbox" class="radio" <?php echo (isset($this->_rootref['V_TYPE'])) ? $this->_rootref['V_TYPE'] : ''; ?>/><label>&nbsp;</label></td>
	</tr>
	<tr>
	    <td><label for="active"><?php echo ((isset($this->_rootref['L_ACTIVE'])) ? $this->_rootref['L_ACTIVE'] : ((isset($user->lang['ACTIVE'])) ? $user->lang['ACTIVE'] : '{ ACTIVE }')); ?>:</label></td>
	    <td><input id="active" name="active_flag" type="checkbox" class="radio" <?php echo (isset($this->_rootref['V_ACTIVE'])) ? $this->_rootref['V_ACTIVE'] : ''; ?>/><label>&nbsp;</label></td>
	</tr>
	<tr>
	    <td>&nbsp;</td>
	    <td><p class="submit-buttons">
	<input class="button1" type="submit" id="submit" name="submit" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" />&nbsp;
	</p><?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?></td>
	</tr>
	
	</table>
	</form>
	
    </div>
</div>

<script type="text/javascript">
function wp_attempt_focus(){
setTimeout( function(){ try{
d = document.getElementById('mac');
d.focus();
d.select();
} catch(e){}
}, 200);
}

wp_attempt_focus();
if(typeof wpOnload=='function')wpOnload();
</script>

<?php $this->_tpl_include('overall_footer.tpl'); ?>