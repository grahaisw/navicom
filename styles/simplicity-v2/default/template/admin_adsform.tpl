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
			    <td width="15%"><label>{L_COMPANY_NAME}:</label></td>
			    <td width="85%"><input name="name" type="text" value="{S_COMPANY_NAME}" size="80"/>
			    </td>
			</tr>

			<tr>
			    <td><label>{L_ADDRESS}:</label></td>
			    <td><textarea  name="address" id="address" rows="5" cols="40">
				  {S_ADDRESS}</textarea>
			    </td>
			</tr>
			<tr>
			    <td><label for="node">{L_CONTACT_PERSON}:</label></td>
			    <td><input name="contact_person" type="text" value="{S_CONTACT_PERSON}" size="80"/></td>
			</tr>
			<tr>
			    <td><label for="zone">{L_PHONE}:</label></td>
			    <td><input name="phone" type="text" value="{S_PHONE}" size="80"/></td>
			</tr>
            <tr>
			    <td><label for="zone">{L_EMAIL}:</label></td>
			    <td><input name="email" type="text" value="{S_EMAIL}" size="80"/></td>
			</tr>
			<tr>
			    <td><label for="enabled">{L_ENABLED}:</label></td>
			    <td><input id="enabled" name="enabled_flag" type="checkbox" class="radio" {S_ENABLED}/></td>
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