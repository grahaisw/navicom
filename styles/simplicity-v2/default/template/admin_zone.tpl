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
			  <th>{L_NAME}</th>
			  <th>{L_DESCRIPTION}</th>
			  <th>{L_ENABLED}</th>
			  <!-- IF S_ADD_UPDATE -->
			  <th>&nbsp;</th>
			  <!-- ENDIF -->
			  <!-- IF S_DELETE --><th>&nbsp;</th><!-- ENDIF -->
			</tr>
			</thead>
			<tbody>
			<!-- IF S_ZONE -->
			  <!-- BEGIN zone -->
			  <!-- IF zone.S_ROW_COUNT is even --><tr class="bg1"><!-- ELSE --><tr class="bg2"><!-- ENDIF -->
			    <td>{zone.NAME}</td>
			    <td>{zone.DESCRIPTION}</td>
			    <!-- IF S_ADD_UPDATE --><td style="width: 5%" align="center">
			    <input type="hidden" name="zid[]" value="{zone.S_ZID}"/>
			    <input type="checkbox" name="mark_{zone.S_ZID}" {zone.V_ENABLED}/><label>&nbsp;</label></td>
			    <td style="width: 5%" align="center"><a href="{zone.U_UPDATE}" rel="facebox"><img src="{zone.ICON_PATH}/edit.png" alt="{zone.L_UPDATE}" title="{zone.L_UPDATE}" /></a></td>
			    <!-- ELSE -->
			    <td>{zone.ENABLED}</td>
			    <!-- ENDIF -->
			    <!-- IF S_DELETE -->
			    <td style="width: 5%" align="center"><a href="{zone.U_DELETE}" id="DeleteLink"><img src="{zone.ICON_PATH}/delete.png" alt="{zone.L_DELETE}" title="{zone.L_DELETE}" /></a></td>
			    <!-- ENDIF -->
			  </tr>
			<!-- END zone -->
			<!-- ELSE -->
			  <tr>
			    <td class="bg1" colspan="<!-- IF S_ADD_UPDATE -->4<!-- ELSE -->2<!-- ENDIF -->" align="center"><span class="gen">{L_NO_ENTRIES}</span></td>
			  </tr>
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