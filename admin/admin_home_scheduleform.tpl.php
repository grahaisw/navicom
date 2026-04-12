<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('admin_header.tpl'); ?>

<!--<style type="text/css">
	th,td{
		text-align: center;
	}
	.table-bordered{
		border:1px solid #f00!important;
	}
	.table{
		border-style: 1px solid #444;
	}


</style>-->
	
		    <div id="main">
			<a name="maincontent"></a>
 
			<h1><?php echo (isset($this->_rootref['MODULE_TITLE'])) ? $this->_rootref['MODULE_TITLE'] : ''; ?> Detail</h1>
			<br><br>

			<form method="post" id="mcp" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>">
			<table cellspacing="1">
			<tr>
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_START'])) ? $this->_rootref['L_START'] : ((isset($user->lang['START'])) ? $user->lang['START'] : '{ START }')); ?>:</label></td>
			    <td width="85%"><input type="text" class="form-control" name="start" id="startdatetime" value="<?php echo (isset($this->_rootref['S_START'])) ? $this->_rootref['S_START'] : ''; ?>">
			    </td>
			</tr>
			<tr>
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_END'])) ? $this->_rootref['L_END'] : ((isset($user->lang['END'])) ? $user->lang['END'] : '{ END }')); ?>:</label></td>
			    <td width="85%"><input type="text" class="form-control" name="end" id="enddatetime" value="<?php echo (isset($this->_rootref['S_END'])) ? $this->_rootref['S_END'] : ''; ?>" >
			    </td>
			</tr>
			<tr>
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_BANNER'])) ? $this->_rootref['L_BANNER'] : ((isset($user->lang['BANNER'])) ? $user->lang['BANNER'] : '{ BANNER }')); ?>:</label></td>
			    <td width="85%"><?php echo (isset($this->_rootref['S_BANNER'])) ? $this->_rootref['S_BANNER'] : ''; ?>
			    </td>
			</tr>
			<!--<tr>
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_DURATION'])) ? $this->_rootref['L_DURATION'] : ((isset($user->lang['DURATION'])) ? $user->lang['DURATION'] : '{ DURATION }')); ?>:</label></td>
			    <td width="85%"><input name="duration" type="text" value="<?php echo (isset($this->_rootref['S_DURATION'])) ? $this->_rootref['S_DURATION'] : ''; ?>" size="5"/>
			    </td>
			</tr>-->
			<tr>
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_ZONE'])) ? $this->_rootref['L_ZONE'] : ((isset($user->lang['ZONE'])) ? $user->lang['ZONE'] : '{ ZONE }')); ?>:</label></td>
			    <td width="85%"><?php echo (isset($this->_rootref['S_ZONE'])) ? $this->_rootref['S_ZONE'] : ''; ?>
			    </td>
			</tr>
			<tr>
			    <td width="15%"><label><?php echo ((isset($this->_rootref['L_ORDER'])) ? $this->_rootref['L_ORDER'] : ((isset($user->lang['ORDER'])) ? $user->lang['ORDER'] : '{ ORDER }')); ?>:</label></td>
			    <td width="85%"><input name="order" type="text" value="<?php echo (isset($this->_rootref['S_ORDER'])) ? $this->_rootref['S_ORDER'] : ''; ?>" size="5"/>
			    </td>
			</tr>
			<tr>
			    <td><label for="enabled"><?php echo ((isset($this->_rootref['L_ENABLED'])) ? $this->_rootref['L_ENABLED'] : ((isset($user->lang['ENABLED'])) ? $user->lang['ENABLED'] : '{ ENABLED }')); ?>:</label></td>
			    <td><input id="enabled" name="enabled_flag" type="checkbox" class="radio" <?php echo (isset($this->_rootref['S_ENABLED'])) ? $this->_rootref['S_ENABLED'] : ''; ?>/><label>&nbsp;</label></td>
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

<br />
		    </div>
		 </div>

		 <span class="corners-bottom"><span>
		 
		 <div class="clear"></div>
	    </div>
	</div>

    </div>

<script type="text/javascript" language="javascript" src="./../includes/js/jquery.js"></script>
<script src="./../includes/js/jquery.datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="./../includes/js/jquery.datetimepicker.css"/>
<script>
$('#startdatetime').datetimepicker();
$('#enddatetime').datetimepicker();

	/*$('#startdatetime').datetimepicker({
		format:'Y/m/d',
		timepicker:false,
	});
	$('#enddatetime').datetimepicker({
		format:'Y/m/d',
		timepicker:false,
	});*/

</script>
<?php $this->_tpl_include('overall_footer.tpl'); ?>