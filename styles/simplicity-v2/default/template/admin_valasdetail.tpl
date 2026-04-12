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
			    <td width="15%"><label>{L_NAME}:</label></td>
			    <td width="85%"><input name="name" type="text" value="{S_NAME}" size="60"/></td>
			</tr>
			<tr>
			    <td><label>{L_JUAL}:</label></td>
			    <td><input name="jual" type="text" value="{S_JUAL}" size="60"/></td>
			</tr>
			<tr>
			    <td><label>{L_BELI}:</label></td>
			    <td><input name="beli" type="text" value="{S_BELI}" size="60"/></td>
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
		<!-- IF S_DETAIL -->
		      <!-- IF S_ADD_UPDATE -->
			    <span class="navigation"><a href="{U_EDIT}" rel="facebox"><img src="{ICON_PATH}/edit.png" alt="{L_EDIT}" title="{L_EDIT}" width="20" />{L_EDIT}</a></span></br>
			<!-- ENDIF -->
			<table cellspacing="1">
			<tr>
			    <td width="15%"><label>{L_NAME}:</label></td>
			    <td width="85%"><strong>{S_NAME}</strong></td>
			</tr>
			<tr>
			    <td><label>{L_JUAL}:</label></td>
			    <td><video width="300" autoplay><source src="{S_JUAL}"></video></td>
			</tr>
			<tr>
			    <td><label>{L_BELI}:</label></td>
			    <td><video width="300" autoplay><source src="{S_BELI}"></video></td>
			</tr>
			
		
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

<!-- INCLUDE overall_footer.tpl -->