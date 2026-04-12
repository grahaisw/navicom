<!-- INCLUDE admin_header.tpl -->
	
		    <div id="main">
			<a name="maincontent"></a>
 
			<h1>{MODULE_TITLE}</h1>

			<p>{MODULE_DESC}</p>

			<form method="post" id="mcp" action="{U_ACTION}">
			    <div class="inner">
			    <strong>{L_USER}</strong>
			    <span class="corners-top2"><span>

			<table cellspacing="1" class="table1" id="dtable">
			<thead>
			<tr>
			  <th>{L_NAME1}</th>
			  <th>{L_NAME2}</th>
			  <th>{L_NAME3}</th>
			  <th>{L_READ}</th>  
			  <th>{L_UPDATE}</th>
			  <th>{L_DELETE}</th>
			</tr>
			</thead>
			<tbody>
			<!-- IF S_PRIVILEDGE -->
			  <!-- BEGIN priviledge -->
			  <!-- IF priviledge.S_ROW_COUNT is even --><tr class="bg1"><!-- ELSE --><tr class="bg2"><!-- ENDIF -->
			    <td>{priviledge.NAME1}</td>
			    <td>{priviledge.NAME2}</td>
			    <td><a href="{priviledge.U_NAME3}">{priviledge.NAME3}</a></td>
			    <!-- IF S_ADD_UPDATE -->
			    <td style="width: 5%" align="center">
				<input type="hidden" name="module_id[]" value="{priviledge.S_MID}"/>
				<input type="checkbox" name="read_{priviledge.S_MID}" {priviledge.V_RID}/><label>&nbsp;</label></td>
			    <td style="width: 5%" align="center">
				<input type="hidden" name="priv_id[]" value="{priviledge.S_PID}"/>
				<input type="checkbox" name="edit_{priviledge.S_MID}" {priviledge.V_EID}/><label>&nbsp;</label></td>
			    <td style="width: 5%" align="center">
				<input type="checkbox" name="delete_{priviledge.S_MID}" {priviledge.V_DID}/><label>&nbsp;</label></td>
			    <!-- ELSE -->
			    <td style="width: 5%" align="center">{priviledge.READ}</td>
			    <td style="width: 5%" align="center">{priviledge.UPDATE}</td>
			    <td style="width: 5%" align="center">{priviledge.DELETE}</td>
			    <!-- ENDIF -->
			    </tr>
			<!-- END priviledge -->
			<!-- ENDIF -->
			</tbody>
			</table>
			<!-- IF S_ADD_UPDATE -->
			<fieldset class="display-options">
			    <input class="button2" type="submit" value="{L_SUBMIT}" name="submit" />
			    {S_FORM_TOKEN}
			</fieldset>
			<!-- ENDIF -->
			<hr />

			</div>
</form>
<br />
		    </div>
		 </div>

		 <span class="corners-bottom"><span>
		 
		 <div class="clear"></div>
	    </div>
	</div>

    </div>

<!-- INCLUDE overall_footer.tpl -->