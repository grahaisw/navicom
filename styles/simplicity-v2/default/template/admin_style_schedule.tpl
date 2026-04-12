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
			  <th>{L_STYLE}</th>
			  <th>{L_START}</th>
			  <th>{L_END}</th>
			  <th>{L_TARGET}</th>
			  <!-- IF S_ADD_UPDATE -->
			  <th>{L_ENABLED}</th>
			  <th>&nbsp;</th>
			  <!-- ENDIF -->
			  <!-- IF S_DELETE --><th>&nbsp;</th><!-- ENDIF -->
			</tr>
			</thead>
			<tbody>
			<!-- IF S_SCHEDULE -->
			  <!-- BEGIN schedule -->
			  <!-- IF schedule.S_ROW_COUNT is even --><tr class="bg1"><!-- ELSE --><tr class="bg2"><!-- ENDIF -->
			    <td>{schedule.NAME}</td>
			    <td>{schedule.STYLE}</td>
			    <td>{schedule.START}</td>
			    <td>{schedule.END}</td>
			    <td>{schedule.TARGET}
			    <input type="hidden" name="schedule_id[]" value="{schedule.S_NID}"/></td>
			    <!-- IF S_ADD_UPDATE --><td style="width: 5%" align="center">
			    <input type="checkbox" name="mark_{schedule.S_NID}" {schedule.V_ENABLED}/><label>&nbsp;</label></td>
			    <td style="width: 5%" align="center"><a href="{schedule.U_UPDATE}" rel="facebox"><img src="{schedule.ICON_PATH}/edit.png" alt="{schedule.L_UPDATE}" title="{schedule.L_UPDATE}" /></a></td>
			    <!-- ELSE -->
			    <td>{schedule.ENABLED}</td>
			    <!-- ENDIF -->
			    <!-- IF S_DELETE -->
			    <td style="width: 5%" align="center"><a href="{schedule.U_DELETE}" id="DeleteLink"><img src="{schedule.ICON_PATH}/delete.png" alt="{schedule.L_DELETE}" title="{schedule.L_DELETE}" /></a></td>
			    <!-- ENDIF -->
			  </tr>
			<!-- END schedule -->
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