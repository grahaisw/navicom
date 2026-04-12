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
			    <td width="15%"><label>{L_POPUP_NAME}:</label></td>
			    <td width="85%"><input name="name" type="text" value="{S_POPUP_NAME}" size="40"/>
			    </td>
			</tr>

			<tr>
			    <td><label>{L_POPUP_DESCRIPTION}:</label></td>
			    <td><textarea  name="description" id="description" rows="5" cols="40">
				  {S_POPUP_DESCRIPTION}</textarea>
			    </td>
			</tr>
			<tr>
			    <td><label for="node">{L_IMAGE}:</label></td>
			    <td><input id="image" name="image" type="text" value="{S_IMAGE}" size="40"/><div id="file-uploader-demo1" style="width:100px; display:inline-block; vertical-align:top; line-height:18px; margin-left:5px;"></div>&nbsp; (dimension: 420 pixel x 400 pixel, format: jpg/png/gif)</td>
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
			<input type="hidden" id="ads_type" value="{S_TYPE}" />
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