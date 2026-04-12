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
			  <th>{L_DEVICE_NAME}</th>
			  <th>{L_DEVICE_ID}</th>
			  <th>{L_NODE}</th>
			  <th>{L_STATUS}</th>
			  <th>{L_ENABLED}</th>
			  <!-- IF S_ADD_UPDATE --><th>&nbsp;</th><!-- ENDIF -->
			  <!-- IF S_DELETE --><th>&nbsp;</th><!-- ENDIF -->
			</tr>
			</thead>
			<tbody>
			<!-- IF S_DEVICE -->
			  <!-- BEGIN device -->
			  <!-- IF device.S_ROW_COUNT is even --><tr class="bg1"><!-- ELSE --><tr class="bg2"><!-- ENDIF -->
			    <td>{device.NAME}</a></td>
			    <td>{device.DEVICE_ID}</a></td>
			    <td>{device.NODE}</td>
			    <td>{device.STATUS}</td>
			    <!-- IF S_ADD_UPDATE -->
			    <td style="width: 5%" align="center">
			    <input type="hidden" name="mid[]" value="{device.S_MID}"/>
			    <input type="checkbox" name="enabled_{device.S_MID}" {device.V_ENABLED}/><label>&nbsp;</label></td>
			    <!-- ELSE -->
			    <td>{device.ENABLED}</td>
			    <!-- ENDIF -->
			    <!-- IF S_ADD_UPDATE -->
			    <td style="width: 5%" align="center"><a href="{device.U_UPDATE}" rel="facebox"><img src="{device.ICON_PATH}/edit.png" alt="{device.L_UPDATE}" title="{device.L_UPDATE}" /></a></td>
			    <!-- ENDIF -->
			    <!-- IF S_DELETE -->
			    <td><a href="{device.U_DELETE}" id="DeleteLink"><img src="{device.ICON_PATH}/delete.png" alt="{device.L_DELETE}" title="{device.L_DELETE}" /></a></td>
			    <!-- ENDIF -->
			  </tr>
			<!-- END device -->
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

<!-- INCLUDE overall_footer.tpl -->?