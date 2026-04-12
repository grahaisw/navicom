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
			    <td width="15%"><label>{L_ROOM}:</label></td>
			    <td width="85%"><input name="room" type="text" value="{S_ROOM}" size="10"/></td>
			</tr>
			<tr>
			    <td><label>{L_PASSWORD1}:</label></td>
			    <td><input name="password1" type="text" value="{S_PASSWORD1}" size="10"/></td>
			</tr>
			<tr>
			    <td><label>{L_PASSWORD2}:</label></td>
			    <td><input name="password2" type="text" value="{S_PASSWORD2}" size="10"/></td>
			</tr>
			<tr>
			    <td><label>{L_PASSWORD3}:</label></td>
			    <td><input name="password3" type="text" value="{S_PASSWORD3}" size="10"/></td>
			</tr>
			<tr>
			    <td><label>{L_PASSWORD4}:</label></td>
			    <td><input name="password4" type="text" value="{S_PASSWORD4}" size="10"/></td>
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