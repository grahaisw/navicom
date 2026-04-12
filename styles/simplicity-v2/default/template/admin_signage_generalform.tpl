<!-- INCLUDE admin_header.tpl -->

		    <div id="main">
			<a name="maincontent"></a>
 
			<h1>{MODULE_TITLE}</h1>

			<p>{MODULE_DESC}</p>

			<div class="inner">
			<!-- IF S_ADD_UPDATE -->
			<a href="{U_ADD}" rel="facebox">{L_ADD}</a>
			<!-- ENDIF -->
			<span class="corners-top2"><span>
			<form method="post" id="mcp" action="{U_ACTION}">
			<table cellspacing="1">
            <tr>
			    <td width="15%"><label>{L_TITLE}:</label></td>
			    <td width="85%"><input id="title" name="title" type="text" value="{S_TITLE}" size="80"/>
			    </td>
			</tr>
			
            <tr>
			    <td><label>{L_DATE}:</label></td>
			    <td><input name="date" type="text" id="startdatetime" value="{S_DATE}"/>
                <input id="pickstartdatetime" type="button" value="{L_PICK}"/></td>
			</tr>
			<tr>
			    <td><label>{L_DESCRIPTION}:</label></td>
			    <td><textarea  name="description" id="description" rows="5" cols="40">
				  {S_DESCRIPTION}</textarea>
			    </td>
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
$(document).ready(function() {
	$("#playlist_id").change(function() {
		var playlist_id = $(this).val();
		
		$.ajax({
			url: "signage_ajax.php",
			cache: false,
			type: "POST",
			data: "mod=schedule&id="+playlist_id,
			success: function(response){   
				if(response == "clip") {
					$("#fullscreen").show();
				} else {
					$("#fullscreen").hide();
				}
			}
		});
	});
});


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
    
<!-- INCLUDE overall_footer.tpl -->