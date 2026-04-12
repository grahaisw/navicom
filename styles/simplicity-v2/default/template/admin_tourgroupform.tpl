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
			    </td>
			</tr>
			<tr>
			    <td><img src="{lang.FLAG_FILE}" height="15">
				<label>{lang.L_DESCRIPTION}:</label></td>
			    <td><textarea name="description_{lang.S_LID}" id="content_{lang.S_LID}">
				  {lang.S_DESCRIPTION}</textarea>
				<input type="hidden" name="lang_{lang.S_LID}" value="{lang.S_LID}"/>
				<input type="hidden" name="translation_{lang.S_LID}" value="{lang.S_TID}"/>
			    </td>
			</tr>
			<!-- END lang-->
			<tr>
			    <td colspan="2">&nbsp;</td>
			</tr>
			<!-- IF THUMBNAIL_FILE -->
			<tr>
			    <td>&nbsp;</td>
			    <td><img src="{S_THUMBNAIL_FILE}" ></dd>
			</tr>
			<!-- ENDIF -->
			<tr>
			    <td><label for="thumbnail">{L_THUMBNAIL}:</label></td>
			    <td><input type="text" name="thumbnail" class="inputbox autowidth"  value="{S_THUMBNAIL}"></td>
			</tr>
			<tr>
			    <td><label for="order">{L_ORDER}:</label></td>
			    <td><input type="text" name="order" value="{S_ORDER}"></td>
			</tr>
			<tr>
			    <td><label for="allow_ads">{L_ALLOW_ADS}:</label></td>
			    <td><input id="allow_ads" name="allow_ads" type="checkbox" class="radio" {S_ALLOW_ADS}/><label>&nbsp;</label></td>
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