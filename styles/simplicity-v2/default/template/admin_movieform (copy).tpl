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
			    <input type="hidden" name="translation_{lang.S_LID}" value="{lang.S_MID}"/>
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
			<tr>
			    <td width="15%"><label>{L_DIRECTOR}:</label></td>
			    <td width="85%"><input name="director" type="text" value="{S_DIRECTOR}" size="60"/></td>
			</tr>
			<tr>
			    <td><label>{L_CASTS}:</label></td>
			    <td><input name="casts" type="text" value="{S_CASTS}" size="60"/></td>
			</tr>
			<tr>
			    <td><label>{L_URL}:</label></td>
			    <td><input name="url" type="text" value="{S_URL}" size="60"/></td>
			</tr>
			<tr>
			    <td><label>{L_TRAILER}:</label></td>
			    <td><input name="trailer" type="text" value="{S_TRAILER}" size="60"/></td>
			</tr>
			<!-- IF POSTER_FILE -->
			<tr>
			    <td>&nbsp;</td>
			    <td><img src="{S_POSTER_FILE}" height="50"></td>
			</tr>
			<!-- ENDIF -->
			<tr>
			    <td><label for="thumbnail">{L_THUMBNAIL}:</label></td>
			    <td><input type="text" name="thumbnail" id="thumbnail" value="{S_THUMBNAIL}" size="60"/></td>
			</tr>
			
			<tr>
			    <td><label for="genre">{L_GENRE}:</label></td>
			    <td>{S_GENRE}</td>
			</tr>
			<tr>
			    <td><label>{L_CODE}:</label></td>
			    <td><input name="code" id="code" type="text" value="{S_CODE}" size="20"/></td>
			</tr>
			<tr>
			    <td><label>{L_PRICE}:</label></td>
			    <td><input name="price" id="price" type="text" value="{S_PRICE}" size="20"/></td>
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
			    <td colspan="2"><label>{lang.S_TITLE}</label></td>
			</tr>
			<tr>
			    <td colspan="2"><label>{lang.S_DESCRIPTION}</label></td>
			</tr>
			<tr>
			    <td colspan="2">&nbsp;</td>
			</tr>
			<!-- END lang -->

			<tr>
			    <td width="15%"><label>{L_DIRECTOR}:</label></td>
			    <td width="85%">{S_DIRECTOR}</td>
			</tr>
			<tr>
			    <td><label>{L_CASTS}:</label></td>
			    <td>{S_CASTS}</td>
			</tr>
			<tr>
			    <td><label>{L_URL}:</label></td>
			    <td>{S_URL}</td>
			</tr>
			<tr>
			    <td><label>{L_TRAILER}:</label></td>
			    <td><video width="300" autoplay><source src="{S_TRAILER}"></video></td>
			</tr>
			<tr>
			    <td>{L_POSTER}:</td>
			    <!-- IF POSTER_FILE -->
			    <td><img src="{S_POSTER_FILE}" height="50"></td>
			    <!-- ELSE -->
			    <td>n/a</td>
			    <!-- ENDIF -->
			</tr>
			<tr>
			    <td><label for="genre">{L_GENRE}:</label></td>
			    <td>{S_GENRE}</td>
			</tr>
			<tr>
			    <td><label>{L_CODE}:</label></td>
			    <td>{S_CODE}</td>
			</tr>
			<tr>
			    <td><label>{L_PRICE}:</label></td>
			    <td>{S_PRICE}</td>
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