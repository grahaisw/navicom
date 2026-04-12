<!-- INCLUDE admin_header.tpl -->

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
 
			<h1>{MODULE_TITLE} Detail</h1>
			<br><br>

			<form method="post" id="mcp" action="{U_ACTION}">
			<table cellspacing="1">
			<tr>
			    <td width="15%"><label>{L_START}:</label></td>
			    <td width="85%"><input type="text" class="form-control" name="start" id="startdatetime" value="{S_START}">
			    </td>
			</tr>
			<tr>
			    <td width="15%"><label>{L_END}:</label></td>
			    <td width="85%"><input type="text" class="form-control" name="end" id="enddatetime" value="{S_END}" >
			    </td>
			</tr>
			<tr>
			    <td width="15%"><label>{L_BANNER}:</label></td>
			    <td width="85%">{S_BANNER}
			    </td>
			</tr>
			<!--<tr>
			    <td width="15%"><label>{L_DURATION}:</label></td>
			    <td width="85%"><input name="duration" type="text" value="{S_DURATION}" size="5"/>
			    </td>
			</tr>-->
			<tr>
			    <td width="15%"><label>{L_ZONE}:</label></td>
			    <td width="85%">{S_ZONE}
			    </td>
			</tr>
			<tr>
			    <td width="15%"><label>{L_ORDER}:</label></td>
			    <td width="85%"><input name="order" type="text" value="{S_ORDER}" size="5"/>
			    </td>
			</tr>
			<tr>
			    <td><label for="enabled">{L_ENABLED}:</label></td>
			    <td><input id="enabled" name="enabled_flag" type="checkbox" class="radio" {S_ENABLED}/><label>&nbsp;</label></td>
			</tr>
			<tr>
			    <td>&nbsp;</td>
			    <td><p class="submit-buttons">
			    <input class="button1" type="submit" id="submit" name="submit" value="{L_SUBMIT}" />&nbsp;
				</p>{S_FORM_TOKEN}</td>
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
<!-- INCLUDE overall_footer.tpl -->