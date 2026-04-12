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

			<form method="post" id="mcp" action="{U_ACTION}">
			    <div class="inner">
			    <!-- IF S_ADD_UPDATE -->
			    <span class="navigation"><a href="{U_ADD}" rel="facebox"><img src="{ICON_PATH}/add.png" alt="{L_ADD}" title="{L_ADD}" width="20" />{L_ADD}</a></span>
			    <!-- ENDIF -->
			    <span class="corners-top2"><span>

			<table cellspacing="1" class="table1" id="dtable">
			<thead>
			<tr>
			  <th>{L_NAME}</th>
			  <th>{L_DESCRIPTION}</th>
              <th>{L_TEMPLATE}</th>
              <th>{L_ZONES}</th>
              <th>{L_ROOMS}</th>
              <th>{L_ENABLED}</th>
			  <!-- IF S_ADD_UPDATE --><th>&nbsp;</th><!-- ENDIF -->
			  <!-- IF S_DELETE --><th>&nbsp;</th><!-- ENDIF -->
			</tr>
			</thead>
			<tbody>
			<!-- IF S_SIGNAGES -->
			  <!-- BEGIN signage -->
			  <!-- IF signage.S_ROW_COUNT is even --><tr class="bg1"><!-- ELSE --><tr class="bg2"><!-- ENDIF -->
			    <td>{signage.NAME}</td>
			    <td>{signage.DESCRIPTION}<input type="hidden" name="signage_id[]" value="{signage.S_RID}"/></td>
                <td>{signage.TEMPLATE}</td>
                <td>{signage.ZONES}</td>
                <td>{signage.ROOMS}</td>
			    <!-- IF S_ADD_UPDATE --><td style="width: 5%" align="center">
			    <input type="checkbox" name="mark_{signage.S_RID}" {signage.V_ENABLED}/><label>&nbsp;</label></td>
			    <!-- ELSE -->
			    <td>{signage.ENABLED}</td>
			    <!-- ENDIF -->
			    <!-- IF S_ADD_UPDATE -->
			    <td style="width: 5%" align="center"><a href="{signage.U_UPDATE}" rel="facebox"><img src="{signage.ICON_PATH}/edit.png" alt="{signage.L_UPDATE}" title="{signage.L_UPDATE}" /></a></td>
			    <!-- ENDIF -->
			    <!-- IF S_DELETE -->
			    <td style="width: 5%" align="center"><a href="{signage.U_DELETE}" id="DeleteLink"><img src="{signage.ICON_PATH}/delete.png" alt="{signage.L_DELETE}" title="{signage.L_DELETE}" /></a>
			    </td>
			    <!-- ENDIF -->
			  </tr>
			<!-- END signage -->
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