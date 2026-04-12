<!-- INCLUDE admin_header.tpl -->

		    <div id="main">
			<a name="maincontent"></a>
 
			<h1>{MODULE_TITLE}</h1>

			<p>{MODULE_DESC}</p>

			<div class="inner">
	
			<span class="corners-top2"><span>
            <!-- IF S_FORM -->
			<form method="post" id="mcp" action="{U_ACTION}">
			<table cellspacing="1">
			<!-- BEGIN lang -->
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
			<!-- IF THUMBNAIL_FILE -->
			<!-- <tr>
			    <td>&nbsp;</td>
			    <td><img src="{S_THUMBNAIL_FILE}" height="50"></td>
			</tr> -->
			<!-- ENDIF -->
			<!-- <tr>
				
			    <td><label for="thumbnail">{L_THUMBNAIL}:</label></td>
			    <td><input type="text" name="thumbnail" id="thumbnail"  value="{S_THUMBNAIL}" size="60"/>
			    <div id="file-uploader-demo1" style="width:100px; display:inline-block; vertical-align:top; line-height:18px; margin-left:5px;"></div>&nbsp;(600x400 pixel, format: jpg/png/gif)</td>
			</tr> -->	
			<tr>
			    <td><label for="node">{L_EMERGENCY_TYPE}:</label></td>
			    <td>{S_EMERGENCY_TYPE}</td>
			</tr>
            <!--<tr>
			    <td><label for="node">{L_TARGET_GATE}:</label></td>
			    <td>{S_TARGET_GATE}</td>
			</tr>-->
			<tr>
			    <td><label for="zone">{L_ZONE}:</label></td>
			    <td>{S_ZONE}</td>
			</tr>
            <tr>
			    <td><label for="zone">{L_ROOMS}:</label></td>
			    <td>{S_ROOMS}</td>
			</tr>
            <tr>
			    <td width="15%"><label>{L_DURATION}:</label></td>
			    <td width="85%"><input name="duration" type="text" value="{S_DURATION}" size="5"/> second
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
            <!-- ENDIF -->
            <!-- IF S_DETAIL -->
			<table cellspacing="1">
			<tr>
			    <td width="15%"><label>{L_DURATION}:</label></td>
			    <td width="85%"><input name="duration" type="text" value="{S_DURATION}" size="5"/> second
			    </td>
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