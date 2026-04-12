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
			<!-- IF S_FORM -->
			<form method="post" id="mcp" action="{U_ACTION}">
			<table cellspacing="1">
			<tr>
			    <td width="15%"><label>{L_TITLE}:</label></td>
			    <td width="85%"><input name="title" type="text" value="{S_TITLE}" size="60"/></td>
			</tr>
			<tr>
			    <td><label>{L_DESCRIPTION}:</label></td>
			    <td><input name="description" type="text" value="{S_DESCRIPTION}" size="60"/></td>
			</tr>
			<!-- IF THUMBNAIL_FILE -->
			<tr>
			    <td>&nbsp;</td>
			    <td><img src="{S_THUMBNAIL_FILE}" alt="{L_TITLE}" height="50"></td>
			</tr>
			<!-- ENDIF -->
			<tr>
			    <td><label for="thumbnail">{L_THUMBNAIL}:</label></td>
			    <td><input type="text" name="thumbnail" id="thumbnail" value="{S_THUMBNAIL}" size="50" /></td>
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
			    <td><label for="default">{L_DEFAULT}:</label></td>
			    <td><input id="default" name="default_flag" type="checkbox" class="radio" {S_DEFAULT}/><label>&nbsp;</label></td>
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
		<!-- ENDIF -->
		<!-- IF S_DETAIL -->
		      <!-- IF S_ADD_UPDATE -->
			    <span class="navigation"><a href="{U_EDIT}" rel="facebox"><img src="{ICON_PATH}/edit.png" alt="{L_EDIT}" title="{L_EDIT}" width="20" />{L_EDIT}</a></span></br>
			<!-- ENDIF -->
			<table cellspacing="1">
			<tr>
			    <td width="15%"><label>{L_TITLE}:</label></td>
			    <td width="85%"><strong>{S_TITLE}</strong></td>
			</tr>
			<tr>
			    <td><label>{L_DESCRIPTION}:</label></td>
			    <td>{S_DESCRIPTION}</td>
			</tr>
			<!-- IF THUMBNAIL_FILE -->
			<tr>
			    <td>&nbsp;</td>
			    <td><img src="{S_THUMBNAIL_FILE}" height="100"></td>
			</tr>
			<!-- ENDIF -->
			<tr>
			    <td><label for="thumbnail">{L_THUMBNAIL}:</label></td>
			    <td>{S_THUMBNAIL}</td>
			</tr>
			<tr>
			    <td><label>{L_START}:</label></td>
			    <td>{S_START}</td>
			</tr>
			<tr>
			    <td><label>{L_END}:</label></td>
			    <td>{S_END}</td>
			</tr>
			<tr>
			    <td><label for="default">{L_DEFAULT}:</label></td>
			    <td>{S_DEFAULT}</td>
			</tr>
			<tr>
			    <td><label for="enabled">{L_ENABLED}:</label></td>
			    <td>{S_ENABLED}</td>
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