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
			    <td><label><?php echo ((isset($this->_rootref['L_REGION_GROUP_NAME'])) ? $this->_rootref['L_REGION_GROUP_NAME'] : ((isset($user->lang['REGION_GROUP_NAME'])) ? $user->lang['REGION_GROUP_NAME'] : '{ REGION_GROUP_NAME }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_REGION_GROUP_NAME'])) ? $this->_rootref['S_REGION_GROUP_NAME'] : ''; ?></td>
			</tr>
			<tr>
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_NAME'])) ? $this->_rootref['L_NAME'] : ((isset($user->lang['NAME'])) ? $user->lang['NAME'] : '{ NAME }')); ?>:</label></td>
			    <td width="85%"><input id="name" name="name" type="text" value="<?php echo (isset($this->_rootref['S_NAME'])) ? $this->_rootref['S_NAME'] : ''; ?>" size="80"/>
			    </td>
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
			    <td><label><?php echo ((isset($this->_rootref['L_PLAYLIST'])) ? $this->_rootref['L_PLAYLIST'] : ((isset($user->lang['PLAYLIST'])) ? $user->lang['PLAYLIST'] : '{ PLAYLIST }')); ?>:</label></td>
			    <td><?php echo (isset($this->_rootref['S_PLAYLIST'])) ? $this->_rootref['S_PLAYLIST'] : ''; ?></td>
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