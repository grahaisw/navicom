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
			    <td><label>{L_REGION_GROUP_NAME}:</label></td>
			    <td>{S_REGION_GROUP_NAME}</td>
			</tr>
			<tr>
			    <td width="15%"><label>{L_NAME}:</label></td>
			    <td width="85%"><input id="name" name="name" type="text" value="{S_NAME}" size="80"/>
			    </td>
			</tr>
			
            <tr>
			    <td><label>{L_START}:</label></td>
			    <td><input name="start" type="text" id="startdatetime" value="{S_START}"/>
                <input id="pickstartdatetime" type="button" value="{L_PICK}"/></td>
			</tr>
            <tr>
			    <td><label>{L_END}:</label></td>
			    <td><input name="end" type="text" id="enddatetime" value="{S_END}"/>
                <input id="pickenddatetime" type="button" value="{L_PICK}"/></td>
			</tr>
			<tr>
			    <td><label>{L_PLAYLIST}:</label></td>
			    <td>{S_PLAYLIST}</td>
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