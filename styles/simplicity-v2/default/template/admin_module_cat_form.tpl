<!-- INCLUDE admin_header.tpl -->

		    <div id="main">
			<a name="maincontent"></a>
 
			<h1>{MODULE_TITLE}</h1>

			<p>{MODULE_DESC}</p>

			<div class="inner">
			<span class="corners-top2"><span>
			<span class="navigation"><label>{L_LABEL}</label></span></br>

	<form method="post" id="mcp" action="{U_ACTION}">

	<table cellspacing="1">
	<tr>
	    <td width="25%"><label for="name">{L_NAME}:</label></td>
	    <td><input name="name" type="text" id="name" value="{S_NAME}" /></td>
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
d = document.getElementById('name');
d.focus();
d.select();
} catch(e){}
}, 200);
}

wp_attempt_focus();
if(typeof wpOnload=='function')wpOnload();
</script>

<!-- INCLUDE overall_footer.tpl -->