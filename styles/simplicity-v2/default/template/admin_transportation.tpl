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
			  <th width="130">{L_THUMBNAIL}</th>
			  <th>{L_NAME}</th>
			  <th>{L_ENABLED}</th>
			  <!-- IF S_ADD_UPDATE --><th>&nbsp;</th><!-- ENDIF -->
			  <!-- IF S_DELETE --><th>&nbsp;</th><!-- ENDIF -->
			</tr>
			</thead>
			<tbody>
			<!-- IF S_TRANSPORTATIONS -->
			  <!-- BEGIN transportation -->
			  <!-- IF transportation.S_ROW_COUNT is even --><tr class="bg1"><!-- ELSE --><tr class="bg2"><!-- ENDIF -->
			    <td><img src="{transportation.THUMBNAIL}" alt="{transportation.NAME}" width="60"></td>
			    <td><strong>{transportation.NAME}</strong><br/>{transportation.DESCRIPTION}
			    <input type="hidden" name="transportation_id[]" value="{transportation.S_GID}"/></td>
			    <!-- IF S_ADD_UPDATE --><td style="width: 5%" align="center">
			    <input type="checkbox" name="mark_{transportation.S_GID}" {transportation.V_ENABLED}/><label>&nbsp;</label></td>
			    <!-- ELSE -->
			    <td>{transportation.ENABLED}</td>
			    <!-- ENDIF -->
			    <!-- IF S_ADD_UPDATE -->
			    <td style="width: 5%" align="center"><a href="{transportation.U_UPDATE}" rel="facebox"><img src="{transportation.ICON_PATH}/edit.png" alt="{transportation.L_UPDATE}" title="{transportation.L_UPDATE}" /></a></td>
			    <!-- ENDIF -->
			    <!-- IF S_DELETE -->
			    <td style="width: 5%" align="center"><a href="{transportation.U_DELETE}" id="DeleteLink"><img src="{transportation.ICON_PATH}/delete.png" alt="{transportation.L_DELETE}" title="{transportation.L_DELETE}" /></a>
			    </td>
			    <!-- ENDIF -->
			  </tr>
			<!-- END transportation -->
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