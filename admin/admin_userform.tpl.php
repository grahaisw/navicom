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
	    <td><label for="name"><?php echo ((isset($this->_rootref['L_USERNAME'])) ? $this->_rootref['L_USERNAME'] : ((isset($user->lang['USERNAME'])) ? $user->lang['USERNAME'] : '{ USERNAME }')); ?>:</label></td>
	    <td><input name="name" type="text" id="name" value="<?php echo (isset($this->_rootref['S_NAME'])) ? $this->_rootref['S_NAME'] : ''; ?>" /></td>
	</tr>
	<tr>
	    <td><label for="fullname"><?php echo ((isset($this->_rootref['L_FULLNAME'])) ? $this->_rootref['L_FULLNAME'] : ((isset($user->lang['FULLNAME'])) ? $user->lang['FULLNAME'] : '{ FULLNAME }')); ?>:</label></td>
	    <td><input name="fullname" type="text" id="fullname" value="<?php echo (isset($this->_rootref['S_FULLNAME'])) ? $this->_rootref['S_FULLNAME'] : ''; ?>" /></td>
	</tr>
	<tr>
	    <td><label for="password"><?php echo ((isset($this->_rootref['L_PASSWORD'])) ? $this->_rootref['L_PASSWORD'] : ((isset($user->lang['PASSWORD'])) ? $user->lang['PASSWORD'] : '{ PASSWORD }')); ?>:</label></td>
	    <td><input type="password" name="password" id="password" /></td>
	</tr>
	<tr>
	    <td><label for="confirm"><?php echo ((isset($this->_rootref['L_CONFIRM'])) ? $this->_rootref['L_CONFIRM'] : ((isset($user->lang['CONFIRM'])) ? $user->lang['CONFIRM'] : '{ CONFIRM }')); ?>:</label></td>
	    <td><input type="password" name="confirm" id="confirm" width="40"/></td>
	</tr>
	<tr>
	    <td><label for="description"><?php echo ((isset($this->_rootref['L_DESCRIPTION'])) ? $this->_rootref['L_DESCRIPTION'] : ((isset($user->lang['DESCRIPTION'])) ? $user->lang['DESCRIPTION'] : '{ DESCRIPTION }')); ?>:</label></td>
	    <td><textarea name="description" id="description" rows="2" cols="40"><?php echo (isset($this->_rootref['S_DESCRIPTION'])) ? $this->_rootref['S_DESCRIPTION'] : ''; ?></textarea></td>
	</tr>
	<tr>
	    <td><label for="language"><?php echo ((isset($this->_rootref['L_LANGUAGE'])) ? $this->_rootref['L_LANGUAGE'] : ((isset($user->lang['LANGUAGE'])) ? $user->lang['LANGUAGE'] : '{ LANGUAGE }')); ?>:</label></td>
	    <td><?php echo (isset($this->_rootref['S_LANGUAGE'])) ? $this->_rootref['S_LANGUAGE'] : ''; ?></td>
	</tr>
	<tr>
	    <td><label for="group"><?php echo ((isset($this->_rootref['L_GROUPNAME'])) ? $this->_rootref['L_GROUPNAME'] : ((isset($user->lang['GROUPNAME'])) ? $user->lang['GROUPNAME'] : '{ GROUPNAME }')); ?>:</label></td>
	    <td><?php echo (isset($this->_rootref['S_GROUPNAME'])) ? $this->_rootref['S_GROUPNAME'] : ''; ?></td>
	</tr>
	<tr>
	    <td><label for="enabled"><?php echo ((isset($this->_rootref['L_ENABLED'])) ? $this->_rootref['L_ENABLED'] : ((isset($user->lang['ENABLED'])) ? $user->lang['ENABLED'] : '{ ENABLED }')); ?>:</label></td>
	    <td><input id="enabled" name="enabled_flag" type="checkbox" class="radio" <?php echo (isset($this->_rootref['V_ENABLED'])) ? $this->_rootref['V_ENABLED'] : ''; ?>/><label>&nbsp;</label></td>
	</tr>
	<tr>
	    <td>&nbsp;</td>
	    <td><p class="submit-buttons">
	<input class="button1" type="submit" id="submit" name="submit" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" />&nbsp;
	</p></td>
	</tr>
	</table>
	<?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?>

	</form>
	<?php } if ($this->_rootref['S_DETAIL']) {  if ($this->_rootref['S_ADD_UPDATE']) {  ?>

			    <span class="navigation"><a href="<?php echo (isset($this->_rootref['U_EDIT'])) ? $this->_rootref['U_EDIT'] : ''; ?>" rel="facebox"><img src="<?php echo (isset($this->_rootref['ICON_PATH'])) ? $this->_rootref['ICON_PATH'] : ''; ?>/edit.png" alt="<?php echo ((isset($this->_rootref['L_EDIT'])) ? $this->_rootref['L_EDIT'] : ((isset($user->lang['EDIT'])) ? $user->lang['EDIT'] : '{ EDIT }')); ?>" title="<?php echo ((isset($this->_rootref['L_EDIT'])) ? $this->_rootref['L_EDIT'] : ((isset($user->lang['EDIT'])) ? $user->lang['EDIT'] : '{ EDIT }')); ?>" width="20" /><?php echo ((isset($this->_rootref['L_EDIT'])) ? $this->_rootref['L_EDIT'] : ((isset($user->lang['EDIT'])) ? $user->lang['EDIT'] : '{ EDIT }')); ?></a></span></br>
			<?php } ?>

	<table cellspacing="1">
	<tbody>
	    <tr>
		<td><?php echo ((isset($this->_rootref['L_FULLNAME'])) ? $this->_rootref['L_FULLNAME'] : ((isset($user->lang['FULLNAME'])) ? $user->lang['FULLNAME'] : '{ FULLNAME }')); ?></td>
		<td>:<?php echo (isset($this->_rootref['S_FULLNAME'])) ? $this->_rootref['S_FULLNAME'] : ''; ?></td>
	    </tr>
	    <tr>
		<td><?php echo ((isset($this->_rootref['L_USERNAME'])) ? $this->_rootref['L_USERNAME'] : ((isset($user->lang['USERNAME'])) ? $user->lang['USERNAME'] : '{ USERNAME }')); ?></td>
		<td>:<?php echo (isset($this->_rootref['S_USERNAME'])) ? $this->_rootref['S_USERNAME'] : ''; ?></td>
	    </tr>
	    <tr>
		<td><?php echo ((isset($this->_rootref['L_GROUPNAME'])) ? $this->_rootref['L_GROUPNAME'] : ((isset($user->lang['GROUPNAME'])) ? $user->lang['GROUPNAME'] : '{ GROUPNAME }')); ?></td>
		<td>:<?php echo (isset($this->_rootref['S_GROUPNAME'])) ? $this->_rootref['S_GROUPNAME'] : ''; ?></td>
	    </tr>
	    <tr>
		<td><?php echo ((isset($this->_rootref['L_LASTVISIT'])) ? $this->_rootref['L_LASTVISIT'] : ((isset($user->lang['LASTVISIT'])) ? $user->lang['LASTVISIT'] : '{ LASTVISIT }')); ?></td>
		<td>:<?php echo (isset($this->_rootref['S_LASTVISIT'])) ? $this->_rootref['S_LASTVISIT'] : ''; ?></td>
	    </tr>
	    <tr>
		<td><?php echo ((isset($this->_rootref['L_DESCRIPTION'])) ? $this->_rootref['L_DESCRIPTION'] : ((isset($user->lang['DESCRIPTION'])) ? $user->lang['DESCRIPTION'] : '{ DESCRIPTION }')); ?></td>
		<td>:<?php echo (isset($this->_rootref['S_DESCRIPTION'])) ? $this->_rootref['S_DESCRIPTION'] : ''; ?></td>
	    </tr>
	    <tr>
		<td><?php echo ((isset($this->_rootref['L_LANGUAGE'])) ? $this->_rootref['L_LANGUAGE'] : ((isset($user->lang['LANGUAGE'])) ? $user->lang['LANGUAGE'] : '{ LANGUAGE }')); ?></td>
		<td>:<?php echo (isset($this->_rootref['S_LANGUAGE'])) ? $this->_rootref['S_LANGUAGE'] : ''; ?></td>
	    </tr>
	    <tr>
		<td><?php echo ((isset($this->_rootref['L_ENABLED'])) ? $this->_rootref['L_ENABLED'] : ((isset($user->lang['ENABLED'])) ? $user->lang['ENABLED'] : '{ ENABLED }')); ?></td>
		<td>:<?php echo (isset($this->_rootref['S_ENABLED'])) ? $this->_rootref['S_ENABLED'] : ''; ?></td>
	    </tr>
	</tbody>
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

<?php if ($this->_rootref['S_FORM']) {  ?>

<script type="text/javascript">
function wp_attempt_focus(){
setTimeout( function(){ try{
d = document.getElementById('name');
d.focus();
d.select();
} catch(e){}
}, 200);
}

wp_attempt_focus();
if(typeof wpOnload=='function')wpOnload();
</script>
<?php } $this->_tpl_include('overall_footer.tpl'); ?>