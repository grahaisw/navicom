<!-- INCLUDE admin_header.tpl -->

		    <div id="main">
			<a name="maincontent"></a>
 
			<h1>{MODULE_TITLE}</h1>

			<p>{MODULE_DESC}</p>

			<div class="inner">

			<span class="corners-top2"><span>
      <span class="navigation"><label>{L_LABEL}</label></span></br>
	<form method="post" id="mcp" action="{U_ACTION}" enctype="multipart/form-data">

	<table cellspacing="1">

	<tr>
	    <td width="20%"><label for="lid">{L_ID}:</label></td>
	    <td><input name="lid" type="text" id="lid" value="{S_ID}" maxlength="2" size="2" {S_DISABLED}/></td>
	</tr>
	<tr>
	    <td><label for="name">{L_NAME}:</label></td>
	    <td><input name="name" type="text" id="name" value="{S_NAME}" /></td>
	</tr>
	<!-- IF FLAG_FILE -->
	<tr>
	    <td><label for="flag">{L_FLAG}:</label></td>
	    <td><img src="{FLAG_FILE}" alt="{L_NAME}" height="50"></br><label for="deleted_flag">{L_NOTICE_FLAG}</label></td>
	</tr>
	<!-- ENDIF -->
	<tr>
	    <td><label for="upload">{L_UPLOAD}:</label></td>
	    <td><input type="file" name="uploadfile" id="uploadfile" class="inputbox autowidth" /></td>
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