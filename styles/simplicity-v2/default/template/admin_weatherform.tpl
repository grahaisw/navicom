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
			<form method="post" id="mcp" action="{U_ACTION}" enctype="multipart/form-data">
			<table cellspacing="1">
			<tr>
			    <td width="15%"><label>{L_CITY}:</label></td>
			    <td width="85%"><input name="city" type="text" value="{S_CITY}" size="80"/></td>
			</tr>
			<!-- IF CITY_ICON_FILE -->
			<tr>
			    <td>&nbsp;</td>
			    <td><img src="{S_CITY_ICON_FILE}" ></br></dd>
			</tr>
			<!-- ENDIF -->
			<tr>
			    <td><label for="city_icon">{L_CITY_ICON}:</label></td>
			    <td><input type="file" name="uploadfile" id="uploadfile" class="inputbox autowidth"  value="{S_CITY_ICON}"> <br/><label>{L_NOTICE_CITY_ICON}</label></td>
			</tr>
			<tr>
			    <td><label for="enabled">{L_ENABLED}:</label></td>
			    <td><input id="enabled" name="enabled_flag" type="checkbox" class="radio" {V_ENABLED}/><label>&nbsp;</label></td>
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
			    <td width="15%"><label>{L_CITY}:</label></td>
			    <td width="85%"><label>{S_CITY}</label></td>
			</tr>
			<!-- IF CITY_ICON_FILE -->
			<tr>
			    <td><label>{L_CITY_ICON}</label></td>
			    <td><img src="{S_CITY_ICON_FILE}" ></br></dd>
			</tr>
			<!-- ENDIF -->
			<tr>
			    <td><label for="enabled">{L_ENABLED}:</label></td>
			    <td><label>{S_ENABLED}</label></td>
			</tr>
			<!-- IF CITY_FULL -->
			<tr>
			    <td><label>{L_CITY_FULL}</label></td>
			    <td><label>{S_CITY_FULL}</label></td>
			</tr>
			<tr>
			    <td colspan="2"><label><strong>{L_FORECAST}</strong></label></td>
			</tr>
			<tr>
			    <td><strong>{S_TODAY_TEXT}</strong></td>
			    <td><img src="{S_TODAY_ICON}"/><br/>
			    H:{S_TODAY_TEMP_H}&deg;C - L:{S_TODAY_TEMP_L}&deg;C</td>
			</tr>
			<tr>
			    <td><strong>{S_DAY1_TEXT}</strong></td>
			    <td><img src="{S_DAY1_ICON}"/><br/>
			    H:{S_DAY1_TEMP_H}&deg;C - L:{S_DAY1_TEMP_L}&deg;C</td>
			</tr>
			<tr>
			    <td><strong>{S_DAY2_TEXT}</strong></td>
			    <td><img src="{S_DAY2_ICON}"/><br/>
			    H:{S_DAY2_TEMP_H}&deg;C - L:{S_DAY2_TEMP_L}&deg;C</td>
			</tr>
			<tr>
			    <td><strong>{S_DAY3_TEXT}</strong></td>
			    <td><img src="{S_DAY3_ICON}"/><br/>
			    H:{S_DAY3_TEMP_H}&deg;C - L:{S_DAY3_TEMP_L}&deg;C</td>
			</tr>

			<!-- ENDIF -->
			
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