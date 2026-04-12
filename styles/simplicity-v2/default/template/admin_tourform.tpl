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
			<!-- BEGIN lang -->
			<tr>
			    <td colspan="2"><label>{lang.LANG_NAME}:</label></td>
			</tr>
			<tr>
			    <td width="15%"><img src="{lang.FLAG_FILE}" height="15">
				<label>{lang.L_TITLE}:</label></td>
			    <td width="85%"><input name="title_{lang.S_LID}" type="text" value="{lang.S_TITLE}" size="60"/>
			    <input type="hidden" name="lang_{lang.S_LID}" value="{lang.S_LID}"/>
			    <input type="hidden" name="translation_{lang.S_LID}" value="{lang.S_RID}"/>
			    </td>
			</tr>
			<tr>
			    <td><img src="{lang.FLAG_FILE}" height="15">
				<label>{lang.L_DESCRIPTION}:</label></td>
			    <td><textarea  name="description_{lang.S_LID}" rows="5" cols="40">
				  {lang.S_DESCRIPTION}</textarea>

			    </td>
			</tr>
			<!-- END lang-->
			<tr>
			    <td colspan="2">&nbsp;</td>
			</tr>

			<!-- IF THUMBNAIL_FILE -->
			<tr>
			    <td>&nbsp;</td>
			    <td><img src="{S_THUMBNAIL_FILE}" height="50"></td>
			</tr>
			<!-- ENDIF -->
			<tr>
			    <td><label for="thumbnail">{L_THUMBNAIL}:</label></td>
			    <td><input type="text" name="thumbnail" id="thumbnail" value="{S_THUMBNAIL}" size="60"/></td>
			</tr>
			<!-- IF CLIP_FILE -->
			<tr>
			    <td>&nbsp;</td>
			    <td><video width="200" autoplay><source src="{S_CLIP_FILE}" type="video/mp4"></video></br><label>{L_NOTICE_CLIP}</label></dd>
			</tr>
			<!-- ENDIF -->
			<tr>
			    <td><label for="clip">{L_CLIP_FILE}:</label></td>
			    <td><input name="clip" type="text" id="clip" size="60" value="{S_CLIP}" /></td> 
			</tr>
			<tr>
			    <td><label for="genre">{L_GROUP}:</label></td>
			    <td>{S_GROUP}</td>
			</tr>
			<tr>
			    <td><label>{L_CODE}:</label></td>
			    <td><input name="code" id="code" type="text" value="{S_CODE}" size="20"/></td>
			</tr>
			<tr>
			    <td><label>{L_CURRENCY}:</label></td>
			    <td>{S_CURRENCY}</td>
			</tr>
			<tr>
			    <td><label>{L_PRICE}:</label></td>
			    <td><input name="price" id="price" type="text" value="{S_PRICE}" size="20"/> <b>POS Price {S_POS_PRICE}</a></td>
			</tr>
			<tr>
			    <td><label>{L_ORDER}:</label></td>
			    <td><input name="order" type="text" value="{S_ORDER}" size="10"/></td>
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
			<!-- BEGIN lang -->
			<tr>
			    <td colspan="2"><label>{lang.LANG_NAME}:</label><img src="{lang.FLAG_FILE}" height="15"></td>
			</tr>
			<tr>
			    <td colspan="2"><label>{lang.S_TITLE}</label>, <b>POS Name: {lang.S_POS_NAME}</b></td>
			</tr>
			<tr>
			    <td colspan="2"><label>{lang.S_DESCRIPTION}</label></td>
			</tr>
			<tr>
			    <td colspan="2">&nbsp;</td>
			</tr>
			<!-- END lang -->

			<tr>
			    <td>{L_THUMBNAIL}:</td>
			    <!-- IF THUMBNAIL_FILE -->
			    <td><img src="{S_THUMBNAIL_FILE}" height="50"></td>
			    <!-- ELSE -->
			    <td>n/a</td>
			    <!-- ENDIF -->
			</tr>
			<!-- IF CLIP_FILE -->
			<tr>
			    <td><label>{L_CLIP_FILE}</label></td>
			    <td><video width="200" autoplay><source src="{S_CLIP_FILE}" type="video/mp4"></video></dd>
			</tr>
			<tr>
			    <td><label for="clip_enabled">{L_CLIP_ENABLED}:</label></td>
			    <td><label>{S_CLIP_ENABLED}</label></td>
			</tr>
			<!-- ENDIF -->
			<tr>
			    <td width="15%"><label for="genre">{L_GROUP}:</label></td>
			    <td width="85%">{S_GROUP}</td>
			</tr>
			<tr>
			    <td><label>{L_CODE}:</label></td>
			    <td>{S_CODE}</td>
			</tr>
			<tr>
			    <td><label>{L_CURRENCY}:</label></td>
			    <td>{S_CURRENCY}</td>
			</tr>
			<tr>
			    <td><label>{L_PRICE}:</label></td>
			    <td>{S_PRICE}, <b>POS Price: {S_POS_PRICE}</b></td>
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