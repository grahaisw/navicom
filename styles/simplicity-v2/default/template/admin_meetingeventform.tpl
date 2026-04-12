<!-- INCLUDE admin_header.tpl -->
<script type="text/javascript">
$(function() {
    $('#DeleteLink').click(function() {
        return confirm('{L_CONFIRM_DELETE}');
    });
});

</script>
	
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
				<label>{lang.TITLE}:</label></td>
			    <td width="85%"><input name="title_{lang.S_LID}" type="text" value="{lang.S_TITLE}" size="60"/></td>
			</tr>
			<tr>
			    <td><img src="{lang.FLAG_FILE}" height="15">
				<label>{lang.CONTENT}:</label></td>
			    <td><textarea name="content_{lang.S_LID}" id="content_{lang.S_LID}">
				  {lang.S_CONTENT}</textarea>
				<input type="hidden" name="lang_{lang.S_LID}" value="{lang.S_LID}"/>
				<input type="hidden" name="translation_{lang.S_LID}" value="{lang.S_DID}"/>
			    </td>
			</tr>
			<!-- END lang -->
			<!-- IF THUMBNAIL_FILE -->
			<tr>
			    <td>&nbsp;</td>
			    <td><img src="{S_THUMBNAIL_FILE}" ></br><label>{L_NOTICE_THUMBNAIL}</label></dd>
			</tr>
			<!-- ENDIF -->
			<tr>
			    <td><label for="thumbnail">{L_THUMBNAIL}:</label></td>
			    <td><input type="text" name="image" class="inputbox autowidth"  value="{S_THUMBNAIL}"><br/>
			    <input id="thumbnail_enabled" name="thumbnail_enabled" type="checkbox" class="radio" {V_THUMBNAIL_ENABLED}/><label>{L_THUMBNAIL_ENABLED}</label></td>
			</tr>
			<!-- IF CLIP_FILE -->
			<tr>
			    <td>&nbsp;</td>
			    <td><video width="200" autoplay><source src="{S_CLIP_FILE}" type="video/mp4"></video></br><label>{L_NOTICE_THUMBNAIL}</label></dd>
			</tr>
			<!-- ENDIF -->
			<tr>
			    <td><label for="clip">{L_CLIP_FILE}:</label></td>
			    <td><input name="clip" type="text" id="clip" size="60" value="{S_CLIP}" /><br/>
			    <input id="clip_enabled" name="clip_enabled" type="checkbox" class="radio" {V_CLIP_ENABLED}/><label>{L_CLIP_ENABLED}</label></td> 
			</tr>
			<tr>
			    <td><label for="enabled">{L_ENABLED}:</label></td>
			    <td><input id="enabled" name="enabled_flag" type="checkbox" class="radio" {V_ENABLED}/><label>&nbsp;</label></td>
			</tr>
			<tr>
			    <td><label for="order">{L_ORDER}:</label></td>
			    <td><input id="order" name="order" type="text" value="{S_ORDER}"/></td>
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
			    <td colspan="2"><label>{lang.TITLE}</label></td>
			</tr>
			<tr>
			    <td colspan="2"><label>{lang.CONTENT}</label></td>
			</tr>
			<tr>
			    <td colspan="2">&nbsp;</td>
			</tr>
			<!-- END lang -->
			<!-- IF THUMBNAIL_FILE -->
			<tr>
			    <td><label>{L_THUMBNAIL_FILE}</label></td>
			    <td><img src="{S_THUMBNAIL_FILE}" ></br></dd>
			</tr>
			<tr>
			    <td><label for="thumbnail_enabled">{L_THUMBNAIL_ENABLED}:</label></td>
			    <td><label>{S_THUMBNAIL_ENABLED}</label></td>
			</tr>
			<!-- ENDIF -->
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
			    <td width="10%"><label for="enabled">{L_ENABLED}:</label></td>
			    <td width="90%"><label>{S_ENABLED}</label></td>
			</tr>
			<tr>
			    <td width="10%"><label for="order">{L_ORDER}:</label></td>
			    <td width="90%"><label>{S_ORDER}</label></td>
			</tr>
		    </table>
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