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
			  <th>{L_ORDER}</th>
			  <th width="60">{L_THUMBNAIL}</th>
			  <th>{L_NAME}</th>
			  <th>{L_GROUP}</th>
			  <th>{L_PRICE}</th>
			  <th>{L_ENABLED}</th>
			  <!-- IF S_ADD_UPDATE --><th>&nbsp;</th><!-- ENDIF -->
			  <!-- IF S_DELETE --><th>&nbsp;</th><!-- ENDIF -->
			</tr>
			</thead>
			<tbody>
			<!-- IF S_SPAS -->
			  <!-- BEGIN spa -->
			  <!-- IF spa.S_ROW_COUNT is even --><tr class="bg1"><!-- ELSE --><tr class="bg2"><!-- ENDIF -->
			    <td>{spa.ORDER}</td>
			    <td><a href="{spa.U_NAME}"><img src="{spa.THUMBNAIL}" alt="{spa.NAME}" width="60"></a></td>
			    <td><strong><a href="{spa.U_NAME}">{spa.NAME}</a></strong>
				<br/>{spa.DESCRIPTION}</td>
			    <td>{spa.GROUP}<input type="hidden" name="spa_id[]" value="{spa.S_RID}"/></td>
			    <td>{spa.PRICE}</td>
			    <!-- IF S_ADD_UPDATE --><td style="width: 5%" align="center">
			    <input type="checkbox" name="mark_{spa.S_RID}" {spa.V_ENABLED}/><label>&nbsp;</label></td>
			    <!-- ELSE -->
			    <td>{spa.ENABLED}</td>
			    <!-- ENDIF -->
			    <!-- IF S_ADD_UPDATE -->
			    <td style="width: 5%" align="center"><a href="{spa.U_UPDATE}"><img src="{spa.ICON_PATH}/edit.png" alt="{spa.L_UPDATE}" title="{spa.L_UPDATE}" /></a></td>
			    <!-- ENDIF -->
			    <!-- IF S_DELETE -->
			    <td style="width: 5%" align="center"><a href="{spa.U_DELETE}" id="DeleteLink"><img src="{spa.ICON_PATH}/delete.png" alt="{spa.L_DELETE}" title="{spa.L_DELETE}" /></a>
			    </td>
			    <!-- ENDIF -->
			  </tr>
			<!-- END spa -->
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