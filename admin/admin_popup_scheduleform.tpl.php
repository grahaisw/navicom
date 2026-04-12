<?php if (!defined('IN_TONJAW')) exit; $this->_tpl_include('admin_header.tpl'); ?>


<style type="text/css">



</style>
	
		    <div id="main">
			<a name="maincontent"></a>
 
			<h1><?php echo (isset($this->_rootref['MODULE_TITLE'])) ? $this->_rootref['MODULE_TITLE'] : ''; ?> Detail</h1>
			<br><br>

			<form class="form-horizontal" method="post" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>">
			<table cellspacing="1">
			<input type="hidden" name="time" value="<?php echo ((isset($this->_rootref['L_ADDRESS'])) ? $this->_rootref['L_ADDRESS'] : ((isset($user->lang['ADDRESS'])) ? $user->lang['ADDRESS'] : '{ ADDRESS }')); ?>">
			<tr>
			    <td width="15%"><label>Start:</label></td>
			    <td width="85%"><input type="text" name="start" id="startdatetime" value="<?php echo (isset($this->_rootref['S_START'])) ? $this->_rootref['S_START'] : ''; ?>" size="40"/>
			    </td>
			</tr>

			<tr>
			    <td width="15%"><label>End:</label></td>
			    <td width="85%"><input type="text" name="end" id="enddatetime" value="<?php echo (isset($this->_rootref['S_END'])) ? $this->_rootref['S_END'] : ''; ?>" size="40"/>
			    </td>
			</tr>

			<tr>
			    <td width="15%"><label>Popup:</label></td>
			    <td width="85%"><?php echo (isset($this->_rootref['S_TARGET_ZONE'])) ? $this->_rootref['S_TARGET_ZONE'] : ''; ?>

			    </td>
			</tr>

			<tr>
			    <td width="15%"><label>Duration:</label></td>
			    <td width="85%"><input type="text" name="duration" placeholder="Second" value="<?php echo (isset($this->_rootref['S_DUR'])) ? $this->_rootref['S_DUR'] : ''; ?>" size="5"/>
			    </td>
			</tr>

			<tr>
			    <td width="15%"><label>Zone:</label></td>
			    <td width="85%"><?php echo (isset($this->_rootref['S_TARGET_ROOM'])) ? $this->_rootref['S_TARGET_ROOM'] : ''; ?>

			    </td>
			</tr>

			<tr>
			    <td width="15%"><label>Channel:</label></td>
			    <td width="85%"><?php echo (isset($this->_rootref['S_TARGET_CHANNEL'])) ? $this->_rootref['S_TARGET_CHANNEL'] : ''; ?>

			    </td>
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
</form>
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
$('#packageexpdate').datetimepicker();

var alacarte_count = $('#alacarte_count').val();
for(var i=0; i<alacarte_count; i++) {
	$('#expdate_' + i).datetimepicker();
}

//$('#startdatetime').datetimepicker({value:'2015/04/15 05:03',step:10});
/*    
var logic = function( currentDateTime ){
    if( currentDateTime.getDay()==6 ){
	this.setOptions({
	minTime:'11:00'
    });
    }else
	this.setOptions({
	minTime:'8:00'
    });
};
*/
// $('#pickstartdatetime').click(function(){
// 	$('#startdatetime').datetimepicker('show');
// });
// $('#pickenddatetime').click(function(){
// 	$('#enddatetime').datetimepicker('show');
// });

// $('#pickpackageexpdate').click(function(){
// 	$('#packageexpdate').datetimepicker('show');
// });

	$('#startdatetime').datetimepicker({
		format:'Y/m/d',
		timepicker:false,
	});
	$('#enddatetime').datetimepicker({
		format:'Y/m/d',
		timepicker:false,
	});

</script>
<?php $this->_tpl_include('overall_footer.tpl'); ?>