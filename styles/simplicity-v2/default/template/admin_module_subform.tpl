<!-- INCLUDE admin_header.tpl -->

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
	    <td><label for="name">{L_NAME}:</label></td>
	    <td><input name="name" type="text" id="name" value="{S_NAME}" /></td>
	</tr>
	<tr>
	    <td><label for="file">{L_FILE}:</label></td>
	    <td><input name="file" type="text" id="file" value="{S_FILE}" /></td>
	</tr>
	<tr>
	    <td><label for="description">{L_DESCRIPTION}:</label></td>
	    <td><textarea name="description" id="description" rows="2" cols="40">{S_DESCRIPTION}</textarea></td>
	</tr>
	<tr>
	    <td><label for="order">{L_CATEGORY}:</label></td>
	    <td>{S_CATEGORY}</td>
	</tr>
	<tr>
	    <td><label for="in_admin">{L_MODULE}:</label></td>
	    <td>{S_MODULE}</td>
	</tr>
	<tr>
	    <td><label for="enabled">{L_ENABLED}:</label></td>
	    <td><input id="enabled" name="enabled_flag" type="checkbox" class="radio" {V_ENABLED}/><label>&nbsp;</label></td>
	</tr>
	<tr>
	    <td>&nbsp;</td>
	    <td><p class="submit-buttons">
	<input class="button1" type="submit" id="submit" name="submit" value="{L_SUBMIT}" />&nbsp;
	</p></td>
	</tr>
	</table>
	{S_FORM_TOKEN}
	</form>
	<!-- ENDIF -->
	<!-- IF S_DETAIL -->
		  <!-- IF S_ADD_UPDATE -->
			    <span class="navigation"><a href="{U_EDIT}" rel="facebox"><img src="{ICON_PATH}/edit.png" alt="{L_EDIT}" title="{L_EDIT}" width="20" />{L_EDIT}</a></span></br>
			<!-- ENDIF -->
	<table cellspacing="1">
	<tbody>
	    <tr>
		<td>{L_NAME}</td>
		<td>:{S_NAME}</td>
	    </tr>
	    <tr>
		<td>{L_FILE}</td>
		<td>:{S_FILE}</td>
	    </tr>
	    <tr>
		<td>{L_DESCRIPTION}</td>
		<td>:{S_DESCRIPTION}</td>
	    </tr>
	    <tr>
		<td>{L_CATEGORY}</td>
		<td>:{S_CATEGORY}</td>
	    </tr>
	    <tr>
		<td>{L_MODULE}</td>
		<td>:{S_MODULE}</td>
	    </tr>
	    <tr>
		<td>{L_ENABLED}</td>
		<td>:{S_ENABLED}</td>
	    </tr>
	</tbody>
	</table>
<hr />
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
<!-- IF S_FORM -->
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
<!-- ENDIF -->

<!-- INCLUDE overall_footer.tpl -->