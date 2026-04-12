<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('admin_header.tpl'); ?>

<script type="text/javascript">
$(function() {
    $('#DeleteLink').click(function() {
        return confirm('<?php echo ((isset($this->_rootref['L_CONFIRM_DELETE'])) ? $this->_rootref['L_CONFIRM_DELETE'] : ((isset($user->lang['CONFIRM_DELETE'])) ? $user->lang['CONFIRM_DELETE'] : '{ CONFIRM_DELETE }')); ?>');
    });
});

</script>
	
		    <div id="main">
			<a name="maincontent"></a>
 
			<h1><?php echo (isset($this->_rootref['MODULE_TITLE'])) ? $this->_rootref['MODULE_TITLE'] : ''; ?></h1>

			<p><?php echo (isset($this->_rootref['MODULE_DESC'])) ? $this->_rootref['MODULE_DESC'] : ''; ?></p>

			<div class="inner">
			
			<span class="corners-top2"><span>
		<?php if ($this->_rootref['S_FORM']) {  ?>

		      <span class="navigation"><label><?php echo ((isset($this->_rootref['L_LABEL'])) ? $this->_rootref['L_LABEL'] : ((isset($user->lang['LABEL'])) ? $user->lang['LABEL'] : '{ LABEL }')); ?></label></span></br>
			<form method="post" id="mcp" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>" enctype="multipart/form-data">
			<table cellspacing="1">
			<tr>
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_CITY'])) ? $this->_rootref['L_CITY'] : ((isset($user->lang['CITY'])) ? $user->lang['CITY'] : '{ CITY }')); ?>:</label></td>
			    <td width="85%"><input name="city" type="text" value="<?php echo (isset($this->_rootref['S_CITY'])) ? $this->_rootref['S_CITY'] : ''; ?>" size="80"/></td>
			</tr>
			<?php if ($this->_rootref['CITY_ICON_FILE']) {  ?>

			<tr>
			    <td>&nbsp;</td>
			    <td><img src="<?php echo (isset($this->_rootref['S_CITY_ICON_FILE'])) ? $this->_rootref['S_CITY_ICON_FILE'] : ''; ?>" ></br></dd>
			</tr>
			<?php } ?>

			<tr>
			    <td><label for="city_icon"><?php echo ((isset($this->_rootref['L_CITY_ICON'])) ? $this->_rootref['L_CITY_ICON'] : ((isset($user->lang['CITY_ICON'])) ? $user->lang['CITY_ICON'] : '{ CITY_ICON }')); ?>:</label></td>
			    <td><input type="file" name="uploadfile" id="uploadfile" class="inputbox autowidth"  value="<?php echo (isset($this->_rootref['S_CITY_ICON'])) ? $this->_rootref['S_CITY_ICON'] : ''; ?>"> <br/><label><?php echo ((isset($this->_rootref['L_NOTICE_CITY_ICON'])) ? $this->_rootref['L_NOTICE_CITY_ICON'] : ((isset($user->lang['NOTICE_CITY_ICON'])) ? $user->lang['NOTICE_CITY_ICON'] : '{ NOTICE_CITY_ICON }')); ?></label></td>
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
		<?php } if ($this->_rootref['S_DETAIL']) {  if ($this->_rootref['S_ADD_UPDATE']) {  ?>

			    <span class="navigation"><a href="<?php echo (isset($this->_rootref['U_EDIT'])) ? $this->_rootref['U_EDIT'] : ''; ?>" rel="facebox"><img src="<?php echo (isset($this->_rootref['ICON_PATH'])) ? $this->_rootref['ICON_PATH'] : ''; ?>/edit.png" alt="<?php echo ((isset($this->_rootref['L_EDIT'])) ? $this->_rootref['L_EDIT'] : ((isset($user->lang['EDIT'])) ? $user->lang['EDIT'] : '{ EDIT }')); ?>" title="<?php echo ((isset($this->_rootref['L_EDIT'])) ? $this->_rootref['L_EDIT'] : ((isset($user->lang['EDIT'])) ? $user->lang['EDIT'] : '{ EDIT }')); ?>" width="20" /><?php echo ((isset($this->_rootref['L_EDIT'])) ? $this->_rootref['L_EDIT'] : ((isset($user->lang['EDIT'])) ? $user->lang['EDIT'] : '{ EDIT }')); ?></a></span></br>
			<?php } ?>

		    <table cellspacing="1">
			<tr>
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_CITY'])) ? $this->_rootref['L_CITY'] : ((isset($user->lang['CITY'])) ? $user->lang['CITY'] : '{ CITY }')); ?>:</label></td>
			    <td width="85%"><label><?php echo (isset($this->_rootref['S_CITY'])) ? $this->_rootref['S_CITY'] : ''; ?></label></td>
			</tr>
			<?php if ($this->_rootref['CITY_ICON_FILE']) {  ?>

			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_CITY_ICON'])) ? $this->_rootref['L_CITY_ICON'] : ((isset($user->lang['CITY_ICON'])) ? $user->lang['CITY_ICON'] : '{ CITY_ICON }')); ?></label></td>
			    <td><img src="<?php echo (isset($this->_rootref['S_CITY_ICON_FILE'])) ? $this->_rootref['S_CITY_ICON_FILE'] : ''; ?>" ></br></dd>
			</tr>
			<?php } ?>

			<tr>
			    <td><label for="enabled"><?php echo ((isset($this->_rootref['L_ENABLED'])) ? $this->_rootref['L_ENABLED'] : ((isset($user->lang['ENABLED'])) ? $user->lang['ENABLED'] : '{ ENABLED }')); ?>:</label></td>
			    <td><label><?php echo (isset($this->_rootref['S_ENABLED'])) ? $this->_rootref['S_ENABLED'] : ''; ?></label></td>
			</tr>
			<?php if ($this->_rootref['CITY_FULL']) {  ?>

			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_CITY_FULL'])) ? $this->_rootref['L_CITY_FULL'] : ((isset($user->lang['CITY_FULL'])) ? $user->lang['CITY_FULL'] : '{ CITY_FULL }')); ?></label></td>
			    <td><label><?php echo (isset($this->_rootref['S_CITY_FULL'])) ? $this->_rootref['S_CITY_FULL'] : ''; ?></label></td>
			</tr>
			<tr>
			    <td colspan="2"><label><strong><?php echo ((isset($this->_rootref['L_FORECAST'])) ? $this->_rootref['L_FORECAST'] : ((isset($user->lang['FORECAST'])) ? $user->lang['FORECAST'] : '{ FORECAST }')); ?></strong></label></td>
			</tr>
			<tr>
			    <td><strong><?php echo (isset($this->_rootref['S_TODAY_TEXT'])) ? $this->_rootref['S_TODAY_TEXT'] : ''; ?></strong></td>
			    <td><img src="<?php echo (isset($this->_rootref['S_TODAY_ICON'])) ? $this->_rootref['S_TODAY_ICON'] : ''; ?>"/><br/>
			    H:<?php echo (isset($this->_rootref['S_TODAY_TEMP_H'])) ? $this->_rootref['S_TODAY_TEMP_H'] : ''; ?>&deg;C - L:<?php echo (isset($this->_rootref['S_TODAY_TEMP_L'])) ? $this->_rootref['S_TODAY_TEMP_L'] : ''; ?>&deg;C</td>
			</tr>
			<tr>
			    <td><strong><?php echo (isset($this->_rootref['S_DAY1_TEXT'])) ? $this->_rootref['S_DAY1_TEXT'] : ''; ?></strong></td>
			    <td><img src="<?php echo (isset($this->_rootref['S_DAY1_ICON'])) ? $this->_rootref['S_DAY1_ICON'] : ''; ?>"/><br/>
			    H:<?php echo (isset($this->_rootref['S_DAY1_TEMP_H'])) ? $this->_rootref['S_DAY1_TEMP_H'] : ''; ?>&deg;C - L:<?php echo (isset($this->_rootref['S_DAY1_TEMP_L'])) ? $this->_rootref['S_DAY1_TEMP_L'] : ''; ?>&deg;C</td>
			</tr>
			<tr>
			    <td><strong><?php echo (isset($this->_rootref['S_DAY2_TEXT'])) ? $this->_rootref['S_DAY2_TEXT'] : ''; ?></strong></td>
			    <td><img src="<?php echo (isset($this->_rootref['S_DAY2_ICON'])) ? $this->_rootref['S_DAY2_ICON'] : ''; ?>"/><br/>
			    H:<?php echo (isset($this->_rootref['S_DAY2_TEMP_H'])) ? $this->_rootref['S_DAY2_TEMP_H'] : ''; ?>&deg;C - L:<?php echo (isset($this->_rootref['S_DAY2_TEMP_L'])) ? $this->_rootref['S_DAY2_TEMP_L'] : ''; ?>&deg;C</td>
			</tr>
			<tr>
			    <td><strong><?php echo (isset($this->_rootref['S_DAY3_TEXT'])) ? $this->_rootref['S_DAY3_TEXT'] : ''; ?></strong></td>
			    <td><img src="<?php echo (isset($this->_rootref['S_DAY3_ICON'])) ? $this->_rootref['S_DAY3_ICON'] : ''; ?>"/><br/>
			    H:<?php echo (isset($this->_rootref['S_DAY3_TEMP_H'])) ? $this->_rootref['S_DAY3_TEMP_H'] : ''; ?>&deg;C - L:<?php echo (isset($this->_rootref['S_DAY3_TEMP_L'])) ? $this->_rootref['S_DAY3_TEMP_L'] : ''; ?>&deg;C</td>
			</tr>

			<?php } ?>

			
		    </table>
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