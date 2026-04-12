<!-- INCLUDE admin_header.tpl -->
<script type="text/javascript">
$(function() {
    $('#DeleteLink').click(function() {
        return confirm('{L_CONFIRM_DELETE}');
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
 
			<h1>{MODULE_TITLE}</h1>

			<p>{MODULE_DESC}</p>

			<div class="inner">
			
			<span class="corners-top2"><span>
		<!-- IF S_FORM -->
		      <span class="navigation"><label>{L_LABEL}</label></span></br>
			<form method="post" id="mcp" action="{U_ACTION}">
			<table cellspacing="1">
			<tr>
			    <td width="15%"><label>{L_REMARK}:</label></td>
			    <td width="85%"><input name="remark" type="text" value="{S_REMARK}"/></td>
			</tr>
			<tr>
			    <td><label>{L_PRIORITY}:</label></td>
			    <td><input type="text" name="priority" value="{S_PRIORITY}" size="5"></td>
			</tr>
			<tr>
			    <td width="15%"><label>{L_DISPLAY_ON_TV}:</label></td>
			    <td width="85%"><input id="display" name="display_flag" type="checkbox" class="radio" {V_DISPLAY_ON_TV}/><label>&nbsp;</label></td>
			</tr>
			<tr id="trDisplayMode" style="{S_DISPLAY}">
			    <td width="15%"><label>{L_DISPLAY_MODE}:</label></td>
			    <td width="85%">{S_DISPLAY_MODE}</td>
			</tr>
			<tr id="trDuration" style="{S_DISPLAY_3}">
			    <td width="15%"><label>{L_DURATION}:</label></td>
			    <td width="85%"><input name="duration" type="text" id="duration" value="{S_DURATION}" size="5"/>&nbsp;second(s)</td>
			</tr>
			<tr id="trDisplayPeriod" style="{S_DISPLAY}">
			    <td width="15%"><label>{L_DISPLAY_PERIOD}:</label></td>
			    <td width="85%">{S_DISPLAY_PERIOD}</td>
			</tr>
			<tr id="trEnd" style="{S_DISPLAY_2}">
			    <td><label>{L_END}:</label></td>
				<td width="85%"><input name="ended_in" type="text" id="ended_in" value="{S_ENDED_IN}" size="5"/>&nbsp;minute(s)</td>
			    <!--<td><input name="end" type="text" id="enddatetime" value="{S_END}"/>
                <input id="pickenddatetime" type="button" value="{L_PICK}"/></td>-->
			</tr>
			<tr>
			    <td><label for="enabled">{L_ENABLED}:</label></td>
			    <td><input id="enabled" name="enabled_flag" type="checkbox" class="radio" {V_ENABLED}/><label>&nbsp;</label></td>
			</tr>
			<tr>
			    <td>&nbsp;</td>
			    <td><p class="submit-buttons">
			    <input class="button1" type="submit" id="submit" name="submit" value="{L_SUBMIT}" />&nbsp;
				</p>{S_FORM_TOKEN}</td>
			</tr>

			</table>
			
			<hr />
			
			</form>
		<!-- ENDIF -->
		
			</div>
<br />
		    </div>
		 </div>

		 <span class="corners-bottom"><span>
		 
		 <div class="clear"></div>
	    </div>
	</div>

    </div>

<!-- INCLUDE overall_footer.tpl -->