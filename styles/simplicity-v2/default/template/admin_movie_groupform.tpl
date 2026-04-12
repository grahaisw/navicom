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
			<!-- BEGIN lang -->
			<tr>
			    <td colspan="2"><label>{lang.LANG_NAME}:</label></td>
			</tr>
			<tr>
			    <td width="15%"><img src="{lang.FLAG_FILE}" height="15">
				<label>{lang.L_TITLE}:</label></td>
			    <td width="85%"><input name="title_{lang.S_LID}" type="text" value="{lang.S_TITLE}" size="60"/>
			    <input type="hidden" name="lang_{lang.S_LID}" value="{lang.S_LID}"/>
			    <input type="hidden" name="translation_{lang.S_LID}" value="{lang.S_TID}"/>
			    </td>
			</tr>
			<!-- END lang-->
			<tr>
			    <td colspan="2">&nbsp;</td>
			</tr>
			<tr>
			    <td><label>{L_DESCRIPTION}:</label></td>
			    <td><textarea  name="description" id="description" rows="5" cols="40">
				  {S_DESCRIPTION}</textarea>

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

<!-- INCLUDE overall_footer.tpl -->