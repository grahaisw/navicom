<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('admin_header.tpl'); ?>


		    <div id="main">
			<a name="maincontent"></a>
 
			<h1><?php echo (isset($this->_rootref['MODULE_TITLE'])) ? $this->_rootref['MODULE_TITLE'] : ''; ?></h1>

			<p><?php echo (isset($this->_rootref['MODULE_DESC'])) ? $this->_rootref['MODULE_DESC'] : ''; ?></p>

			<div class="inner">

			<span class="corners-top2"><span>
      <span class="navigation"><label><?php echo ((isset($this->_rootref['L_LABEL'])) ? $this->_rootref['L_LABEL'] : ((isset($user->lang['LABEL'])) ? $user->lang['LABEL'] : '{ LABEL }')); ?></label></span></br>
	<form method="post" id="mcp" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>" enctype="multipart/form-data">

	<table cellspacing="1">

	<tr>
	    <td width="20%"><label for="lid"><?php echo ((isset($this->_rootref['L_ID'])) ? $this->_rootref['L_ID'] : ((isset($user->lang['ID'])) ? $user->lang['ID'] : '{ ID }')); ?>:</label></td>
	    <td><input name="lid" type="text" id="lid" value="<?php echo (isset($this->_rootref['S_ID'])) ? $this->_rootref['S_ID'] : ''; ?>" maxlength="2" size="2" <?php echo (isset($this->_rootref['S_DISABLED'])) ? $this->_rootref['S_DISABLED'] : ''; ?>/></td>
	</tr>
	<tr>
	    <td><label for="name"><?php echo ((isset($this->_rootref['L_NAME'])) ? $this->_rootref['L_NAME'] : ((isset($user->lang['NAME'])) ? $user->lang['NAME'] : '{ NAME }')); ?>:</label></td>
	    <td><input name="name" type="text" id="name" value="<?php echo (isset($this->_rootref['S_NAME'])) ? $this->_rootref['S_NAME'] : ''; ?>" /></td>
	</tr>
	<?php if ($this->_rootref['FLAG_FILE']) {  ?>

	<tr>
	    <td><label for="flag"><?php echo ((isset($this->_rootref['L_FLAG'])) ? $this->_rootref['L_FLAG'] : ((isset($user->lang['FLAG'])) ? $user->lang['FLAG'] : '{ FLAG }')); ?>:</label></td>
	    <td><img src="<?php echo (isset($this->_rootref['FLAG_FILE'])) ? $this->_rootref['FLAG_FILE'] : ''; ?>" alt="<?php echo ((isset($this->_rootref['L_NAME'])) ? $this->_rootref['L_NAME'] : ((isset($user->lang['NAME'])) ? $user->lang['NAME'] : '{ NAME }')); ?>" height="50"></br><label for="deleted_flag"><?php echo ((isset($this->_rootref['L_NOTICE_FLAG'])) ? $this->_rootref['L_NOTICE_FLAG'] : ((isset($user->lang['NOTICE_FLAG'])) ? $user->lang['NOTICE_FLAG'] : '{ NOTICE_FLAG }')); ?></label></td>
	</tr>
	<?php } ?>

	<tr>
	    <td><label for="upload"><?php echo ((isset($this->_rootref['L_UPLOAD'])) ? $this->_rootref['L_UPLOAD'] : ((isset($user->lang['UPLOAD'])) ? $user->lang['UPLOAD'] : '{ UPLOAD }')); ?>:</label></td>
	    <td><input type="file" name="uploadfile" id="uploadfile" class="inputbox autowidth" /></td>
	</tr>
	<tr>
	    <td><label for="enabled"><?php echo ((isset($this->_rootref['L_ENABLED'])) ? $this->_rootref['L_ENABLED'] : ((isset($user->lang['ENABLED'])) ? $user->lang['ENABLED'] : '{ ENABLED }')); ?>:</label></td>
	    <td><input id="enabled" name="enabled_flag" type="checkbox" class="radio" <?php echo (isset($this->_rootref['V_ENABLED'])) ? $this->_rootref['V_ENABLED'] : ''; ?>/><label>&nbsp;</label></td>
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