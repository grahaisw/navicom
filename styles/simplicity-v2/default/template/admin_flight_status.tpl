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
			<!-- IF S_ADD_UPDATE -->
			    <span class="navigation"><a href="{U_ADD}" rel="facebox"><img src="{ICON_PATH}/add.png" alt="{L_ADD}" title="{L_ADD}" width="20" />{L_ADD}</a></span>
			<!-- ENDIF -->

			<form method="post" id="mcp" action="{U_ACTION}">
			    <div class="inner">
			    <span class="corners-top2"><span>

			<table cellspacing="1" class="table1" id="dtable">
			<thead>
			<tr>
			  <th>{L_PRIORITY}</th>
			  <th>{L_REMARK}</th>
			  <th>{L_DISPLAY_ON_TV}</th>
			  <th>{L_DISPLAY_MODE}</th>
			  <th>{L_ENABLED}</th>
			  <!-- IF S_ADD_UPDATE --><th>&nbsp;</th><!-- ENDIF -->
			  <!-- IF S_DELETE --><th>&nbsp;</th><!-- ENDIF -->
			</tr>
			</thead>
			<tbody>
			<!-- IF S_AIRPORTS -->
			  <!-- BEGIN airport -->
			  <!-- IF airport.S_ROW_COUNT is even --><tr class="bg1"><!-- ELSE --><tr class="bg2"><!-- ENDIF -->
			    <td style="width: 15%">{airport.PRIORITY}</td>
			    <td><strong>{airport.REMARK}</strong></td>
			    <td>{airport.DISPLAY_ON_TV}</td>
			    <td>{airport.DISPLAY_MODE}</td>
			    <!-- IF S_ADD_UPDATE --><td style="width: 5%" align="center">
			    <input type="checkbox" name="mark_{airport.S_AID}" {airport.V_ENABLED}/><label>&nbsp;</label></td>
			    <!-- ELSE -->
			    <td>{airport.ENABLED}</td>
			    <!-- ENDIF -->
			    <!-- IF S_ADD_UPDATE -->
			    <td style="width: 5%" align="center"><a href="{airport.U_UPDATE}" rel="facebox"><img src="{airport.ICON_PATH}/edit.png" alt="{airport.L_UPDATE}" title="{airport.L_UPDATE}" /></a></td>
			    <!-- ENDIF -->
			    <!-- IF S_DELETE -->
			    <td style="width: 5%" align="center"><a href="{airport.U_DELETE}" id="DeleteLink"><img src="{airport.ICON_PATH}/delete.png" alt="{airport.L_DELETE}" title="{airport.L_DELETE}" /></a>
			    </td>
			    <!-- ENDIF -->
			  </tr>
			<!-- END airport -->
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