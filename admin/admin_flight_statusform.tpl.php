<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('admin_header.tpl'); ?>
<script type="text/javascript">
$(function() {
    $('#DeleteLink').click(function() {
        return confirm('<?php echo ((isset($this->_rootref['L_CONFIRM_DELETE'])) ? $this->_rootref['L_CONFIRM_DELETE'] : ((isset($user->lang['CONFIRM_DELETE'])) ? $user->lang['CONFIRM_DELETE'] : '{ CONFIRM_DELETE }')); ?>');
    });
	
	$('#mcp input[name=display_flag]').on('change', function() {
		var display_flag = $('input[name=display_flag]:checked', '#mcp').val();
		
		if(display_flag) {
			$("#trDisplayMode").show();
			//$("#trDuration").show();
			$("#trDisplayPeriod").show();
			//$("#trEnd").show();
		} else {
			$("#trDisplayMode").hide();
			//$("#trDuration").hide();
			$("#trDisplayPeriod").hide();
			//$("#trEnd").hide();
		}
	});
	
	$('#display_mode').on('change', function() { 
		var display_mode = $('#display_mode').val();
		if(display_mode=="popup" || display_mode=="fullscreen") {
			$("#trDuration").show();
		} else {
			$("#trDuration").hide();
		}
	});
	
	$('#display_period').on('change', function() { 
		var display_period = $('#display_period').val();
		if(display_period=="time") {
			$("#trEnd").show();
		} else {
			$("#trEnd").hide();
		}
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
			<form method="post" id="mcp" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>">
			<table cellspacing="1">
			<tr>
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_REMARK'])) ? $this->_rootref['L_REMARK'] : ((isset($user->lang['REMARK'])) ? $user->lang['REMARK'] : '{ REMARK }')); ?>:</label></td>
			    <td width="85%"><input name="remark" type="text" value="<?php echo (isset($this->_rootref['S_REMARK'])) ? $this->_rootref['S_REMARK'] : ''; ?>"/></td>
			</tr>
			<tr>
			    <td><label><?php echo ((isset($this->_rootref['L_PRIORITY'])) ? $this->_rootref['L_PRIORITY'] : ((isset($user->lang['PRIORITY'])) ? $user->lang['PRIORITY'] : '{ PRIORITY }')); ?>:</label></td>
			    <td><input type="text" name="priority" value="<?php echo (isset($this->_rootref['S_PRIORITY'])) ? $this->_rootref['S_PRIORITY'] : ''; ?>" size="5"></td>
			</tr>
			<tr>
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_DISPLAY_ON_TV'])) ? $this->_rootref['L_DISPLAY_ON_TV'] : ((isset($user->lang['DISPLAY_ON_TV'])) ? $user->lang['DISPLAY_ON_TV'] : '{ DISPLAY_ON_TV }')); ?>:</label></td>
			    <td width="85%"><input id="display" name="display_flag" type="checkbox" class="radio" <?php echo (isset($this->_rootref['V_DISPLAY_ON_TV'])) ? $this->_rootref['V_DISPLAY_ON_TV'] : ''; ?>/><label>&nbsp;</label></td>
			</tr>
			<tr id="trDisplayMode" style="<?php echo (isset($this->_rootref['S_DISPLAY'])) ? $this->_rootref['S_DISPLAY'] : ''; ?>">
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_DISPLAY_MODE'])) ? $this->_rootref['L_DISPLAY_MODE'] : ((isset($user->lang['DISPLAY_MODE'])) ? $user->lang['DISPLAY_MODE'] : '{ DISPLAY_MODE }')); ?>:</label></td>
			    <td width="85%"><?php echo (isset($this->_rootref['S_DISPLAY_MODE'])) ? $this->_rootref['S_DISPLAY_MODE'] : ''; ?></td>
			</tr>
			<tr id="trDuration" style="<?php echo (isset($this->_rootref['S_DISPLAY_3'])) ? $this->_rootref['S_DISPLAY_3'] : ''; ?>">
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_DURATION'])) ? $this->_rootref['L_DURATION'] : ((isset($user->lang['DURATION'])) ? $user->lang['DURATION'] : '{ DURATION }')); ?>:</label></td>
			    <td width="85%"><input name="duration" type="text" id="duration" value="<?php echo (isset($this->_rootref['S_DURATION'])) ? $this->_rootref['S_DURATION'] : ''; ?>" size="5"/>&nbsp;second(s)</td>
			</tr>
			<tr id="trDisplayPeriod" style="<?php echo (isset($this->_rootref['S_DISPLAY'])) ? $this->_rootref['S_DISPLAY'] : ''; ?>">
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_DISPLAY_PERIOD'])) ? $this->_rootref['L_DISPLAY_PERIOD'] : ((isset($user->lang['DISPLAY_PERIOD'])) ? $user->lang['DISPLAY_PERIOD'] : '{ DISPLAY_PERIOD }')); ?>:</label></td>
			    <td width="85%"><?php echo (isset($this->_rootref['S_DISPLAY_PERIOD'])) ? $this->_rootref['S_DISPLAY_PERIOD'] : ''; ?></td>
			</tr>
			<tr id="trEnd" style="<?php echo (isset($this->_rootref['S_DISPLAY_2'])) ? $this->_rootref['S_DISPLAY_2'] : ''; ?>">
			    <td><label><?php echo ((isset($this->_rootref['L_END'])) ? $this->_rootref['L_END'] : ((isset($user->lang['END'])) ? $user->lang['END'] : '{ END }')); ?>:</label></td>
				<td width="85%"><input name="ended_in" type="text" id="ended_in" value="<?php echo (isset($this->_rootref['S_ENDED_IN'])) ? $this->_rootref['S_ENDED_IN'] : ''; ?>" size="5"/>&nbsp;minute(s)</td>
			    <!--<td><input name="end" type="text" id="enddatetime" value="<?php echo (isset($this->_rootref['S_END'])) ? $this->_rootref['S_END'] : ''; ?>"/>
                <input id="pickenddatetime" type="button" value="<?php echo ((isset($this->_rootref['L_PICK'])) ? $this->_rootref['L_PICK'] : ((isset($user->lang['PICK'])) ? $user->lang['PICK'] : '{ PICK }')); ?>"/></td>-->
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