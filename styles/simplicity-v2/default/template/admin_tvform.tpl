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
			    <td><label>{L_URL_UDP}:</label></td>
			    <td><input name="url_udp" type="text" value="{S_URL_UDP}" size="60"/></td>
			</tr>
			<tr>
			    <td><label>{L_URL_HTTP}:</label></td>
			    <td><input name="url_http" type="text" value="{S_URL_HTTP}" size="60"/></td>
			</tr>
			<!-- IF THUMBNAIL_FILE -->
			<tr>
			    <td>&nbsp;</td>
			    <td><img src="{S_THUMBNAIL_FILE}" alt="{L_NAME}" height="50"></td>
			</tr>
			<!-- ENDIF -->
			<tr>
			    <td><label for="thumbnail">{L_THUMBNAIL}:</label></td>
			    <td><input type="text" name="thumbnail" id="thumbnail" value="{S_THUMBNAIL}" size="50" /></td>
			</tr>
			<tr>
			    <td><label for="group">{L_GROUPNAME}:</label></td>
			    <td>{S_GROUPNAME}</td>
			</tr>
			<tr>
			    <td><label>{L_ORDER}:</label></td>
			    <td><input name="order" type="text" value="{S_ORDER}" maxlength="3" size="5"/></td>
			</tr>
			<tr>
			    <td><label for="allow_ads">{L_ALLOW_ADS}:</label></td>
			    <td><input id="allow_ads" name="allow_ads_flag" type="checkbox" class="radio" {S_ALLOW_ADS}/><label>&nbsp;</label></td>
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
			    <td width="15%"><label>{L_NAME}:</label></td>
			    <td width="85%"><strong>{S_NAME}</strong></td>
			</tr>
			<tr>
			    <td><label>{L_URL_UDP}:</label></td>
			    <td><video width="300" autoplay><source src="{S_URL_UDP}"></video></td>
			</tr>
			<tr>
			    <td><label>{L_URL_HTTP}:</label></td>
			    <td><video width="300" autoplay><source src="{S_URL_HTTP}"></video></td>
			</tr>
			<!-- IF THUMBNAIL_FILE -->
			<tr>
			    <td>&nbsp;</td>
			    <td><img src="{S_THUMBNAIL_FILE}" ></td>
			</tr>
			<!-- ENDIF -->
			<tr>
			    <td><label for="thumbnail">{L_THUMBNAIL}:</label></td>
			    <td>{S_THUMBNAIL}</td>
			</tr>
			<tr>
			    <td><label for="group">{L_GROUPNAME}:</label></td>
			    <td>{S_GROUPNAME}</td>
			</tr>
			<tr>
			    <td><label>{L_ORDER}:</label></td>
			    <td>{S_ORDER}</td>
			</tr>
			<tr>
			    <td><label for="allow_ads">{L_ALLOW_ADS}:</label></td>
			    <td>{S_ALLOW_ADS}</td>
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