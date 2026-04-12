<!-- INCLUDE admin_header.tpl -->
<script type="text/javascript">
$(function() {
    $('#DeleteLink').click(function() {
        return confirm('{L_CONFIRM_DELETE}');
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
		      <!--<span class="navigation"><label>{L_LABEL}</label></span></br>-->
			<form method="post" id="mcp" action="{U_ACTION}">
			<table cellspacing="1">
			{S_CONTENT}
			
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
		<!-- IF S_DETAIL -->
		    <!-- IF S_ADD_UPDATE -->
			    <span class="navigation"><a href="{U_EDIT}" rel="facebox"><img src="{ICON_PATH}/edit.png" alt="{L_EDIT}" title="{L_EDIT}" width="20" />{L_EDIT}</a></span></br>
			<!-- ENDIF -->
		    <table cellspacing="1">
			<tr>
			    <td width="15%"><label>{L_TITLE}:</label></td>
			    <td width="85%"><label>{S_TITLE}</label></td>
			</tr>
			<tr>
			    <td><label>{L_DESCRIPTION}:</label></td>
			    <td><label>{S_DESCRIPTION}</label></td>
			</tr>
			<tr>
			    <td><label>{L_IMAGE}:</label></td>
			    <td><label>{S_IMAGE}</label></td>
			</tr>
			<tr>
			    <td><label for="enabled">{L_ENABLED}:</label></td>
			    <td><label>{S_ENABLED}</label></td>
			</tr>
			
		    </table>
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