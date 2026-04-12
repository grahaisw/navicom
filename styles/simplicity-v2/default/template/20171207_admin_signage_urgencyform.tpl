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